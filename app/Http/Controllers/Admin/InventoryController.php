<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Patient;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Inventory::latest();

        if ($category = $request->input('category')) {
            $query->where('category', $category);
        }

        if ($search = $request->input('search')) {
            $query->where('item_name', 'like', "%{$search}%")
                  ->orWhere('item_code', 'like', "%{$search}%");
        }

        $inventories = $query->paginate(15);
        $lowStockCount = Inventory::whereColumn('quantity', '<=', 'reorder_level')->count();

        return view('admin.inventories.index', compact('inventories', 'lowStockCount'));
    }

    public function create()
    {
        $itemCode = 'ITM-' . rand(1000, 9999);
        return view('admin.inventories.create', compact('itemCode'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_code' => 'required|unique:inventories,item_code',
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $item = Inventory::create($validated);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Stock item added successfully: ' . $item->item_name);
    }

    public function edit(Inventory $inventory)
    {
        return view('admin.inventories.edit', compact('inventory'));
    }

    public function update(Request $request, Inventory $inventory)
    {
        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'category' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'reorder_level' => 'required|integer|min:0',
            'unit_price' => 'required|numeric|min:0',
            'supplier' => 'nullable|string|max:255',
            'expiry_date' => 'nullable|date',
            'notes' => 'nullable|string',
        ]);

        $inventory->update($validated);

        return redirect()->route('admin.inventories.index')
            ->with('success', 'Stock item updated successfully.');
    }

    public function destroy(Inventory $inventory)
    {
        $inventory->delete();
        return redirect()->route('admin.inventories.index')
            ->with('success', 'Item deleted from inventory.');
    }

    /**
     * Pharmacy POS Counter Selling View
     */
    public function pos()
    {
        $medicines = Inventory::where('quantity', '>', 0)->orderBy('item_name')->get();
        $patients = Patient::latest()->get();
        $pharmacyInvoiceNo = 'PHARM-' . date('Y') . '-' . str_pad(Invoice::count() + 1, 4, '0', STR_PAD_LEFT);

        return view('admin.inventories.pos', compact('medicines', 'patients', 'pharmacyInvoiceNo'));
    }

    /**
     * Complete Pharmacy Sale & Auto Deduct Inventory Stock
     */
    public function sell(Request $request)
    {
        $request->validate([
            'invoice_no' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'paid_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
        ]);

        DB::beginTransaction();
        try {
            $invoiceItems = [];
            $subtotal = 0;

            foreach ($request->items as $saleItem) {
                $inventory = Inventory::findOrFail($saleItem['inventory_id']);

                if ($inventory->quantity < $saleItem['quantity']) {
                    return back()->with('error', "Insufficient stock for {$inventory->item_name}. Available: {$inventory->quantity}");
                }

                // Deduct inventory quantity automatically
                $inventory->decrement('quantity', $saleItem['quantity']);

                $lineTotal = $inventory->unit_price * $saleItem['quantity'];
                $subtotal += $lineTotal;

                $invoiceItems[] = [
                    'description' => "{$inventory->item_name} ({$saleItem['quantity']} units @ ৳{$inventory->unit_price})",
                    'amount' => $lineTotal,
                ];
            }

            $discount = (float) ($request->discount ?? 0);
            $totalAmount = max(0, $subtotal - $discount);
            $paidAmount = (float) $request->paid_amount;
            $dueAmount = max(0, $totalAmount - $paidAmount);
            $status = $dueAmount <= 0 ? 'paid' : ($paidAmount > 0 ? 'partial' : 'unpaid');

            $invoice = Invoice::create([
                'invoice_no' => $request->invoice_no,
                'patient_id' => $request->patient_id ?: null,
                'items' => $invoiceItems,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total_amount' => $totalAmount,
                'paid_amount' => $paidAmount,
                'due_amount' => $dueAmount,
                'payment_method' => $request->payment_method,
                'status' => $status,
                'notes' => 'Pharmacy Counter Sales Bill (Auto Stock Deducted)',
            ]);

            DB::commit();

            return redirect()->route('admin.invoices.print', $invoice)
                ->with('success', 'Pharmacy Sale completed & Stock auto-deducted successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Pharmacy sale failed: ' . $e->getMessage());
        }
    }
}

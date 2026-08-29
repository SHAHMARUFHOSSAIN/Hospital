<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Patient;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Invoice::with('patient')->latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($startDate = $request->input('start_date')) {
            $query->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate = $request->input('end_date')) {
            $query->whereDate('created_at', '<=', $endDate);
        }

        if ($search = $request->input('search')) {
            $query->where('invoice_no', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")->orWhere('patient_id', 'like', "%{$search}%");
                  });
        }

        $invoices = $query->paginate(15)->withQueryString();

        // Calculate totals based on current filtered query
        $totalCollected = (clone $query)->sum('paid_amount');
        $totalDue = (clone $query)->sum('due_amount');

        return view('admin.invoices.index', compact('invoices', 'totalCollected', 'totalDue'));
    }

    public function create(Request $request)
    {
        $patients = Patient::orderBy('name')->get();
        $invoiceNo = Invoice::generateInvoiceNo();
        $selectedPatientId = $request->input('patient_id');

        return view('admin.invoices.create', compact('patients', 'invoiceNo', 'selectedPatientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_no' => 'required|unique:invoices,invoice_no',
            'patient_id' => 'required|exists:patients,id',
            'items' => 'required|array',
            'subtotal' => 'required|numeric|min:0',
            'discount' => 'nullable|numeric|min:0',
            'paid_amount' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $subtotal = (float) $validated['subtotal'];
        $discount = (float) ($validated['discount'] ?? 0);
        $totalAmount = max(0, $subtotal - $discount);
        $paidAmount = (float) $validated['paid_amount'];
        $dueAmount = max(0, $totalAmount - $paidAmount);

        $status = 'paid';
        if ($dueAmount > 0) {
            $status = $paidAmount > 0 ? 'partial' : 'unpaid';
        }

        $invoice = Invoice::create([
            'invoice_no' => $validated['invoice_no'],
            'patient_id' => $validated['patient_id'],
            'items' => $validated['items'],
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'due_amount' => $dueAmount,
            'payment_method' => $validated['payment_method'],
            'status' => $status,
            'notes' => $validated['notes'] ?? null,
        ]);

        return redirect()->route('admin.invoices.show', $invoice)
            ->with('success', 'Invoice generated successfully: ' . $invoice->invoice_no);
    }

    public function show(Invoice $invoice)
    {
        $invoice->load('patient');
        return view('admin.invoices.show', compact('invoice'));
    }

    public function print(Invoice $invoice)
    {
        $invoice->load('patient');
        return view('admin.invoices.print', compact('invoice'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('admin.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }
}

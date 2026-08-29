@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-amber-400"></i> Hospital Invoice Generator
            </h1>
            <a href="{{ route('admin.invoices.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Invoices</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.invoices.store') }}" class="space-y-6" id="invoiceForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-slate-800">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Invoice Serial No</label>
                        <input type="text" name="invoice_no" value="{{ old('invoice_no', $invoiceNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-amber-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient *</label>
                        <select name="patient_id" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-amber-500">
                            <option value="">Choose Patient...</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ (old('patient_id', $selectedPatientId) == $p->id) ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Dynamic Itemized Billing Table -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold uppercase text-amber-400 flex items-center gap-2">
                            <i class="fas fa-list-check"></i> Billable Items / Services
                        </h3>
                        <button type="button" id="addItemBtn" class="px-3 py-1.5 bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 font-bold text-xs rounded-lg border border-amber-500/30 transition">
                            + Add Bill Line Item
                        </button>
                    </div>

                    <div class="space-y-3" id="itemsContainer">
                        <div class="grid grid-cols-12 gap-3 item-row items-center">
                            <div class="col-span-8">
                                <input type="text" name="items[0][description]" placeholder="Item Description (e.g. Doctor Consultation Fee / MRI Brain Scan / Cabin Rent)" required
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-amber-500">
                            </div>
                            <div class="col-span-3">
                                <input type="number" step="0.01" name="items[0][amount]" placeholder="Amount (৳)" required
                                    class="item-amount w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-amber-500">
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" class="remove-item-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Totals Calculation Box -->
                <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1">Subtotal (৳)</label>
                            <input type="number" step="0.01" name="subtotal" id="subtotal" readonly value="0.00"
                                class="w-full bg-slate-900 border border-slate-800 text-white font-extrabold text-sm rounded-xl px-4 py-2.5 outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Discount (৳)</label>
                            <input type="number" step="0.01" name="discount" id="discount" value="0.00" min="0"
                                class="w-full bg-slate-900 border border-slate-800 text-amber-400 font-bold text-sm rounded-xl px-4 py-2.5 outline-none focus:border-amber-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Paid Amount (৳) *</label>
                            <input type="number" step="0.01" name="paid_amount" id="paid_amount" value="0.00" min="0" required
                                class="w-full bg-slate-900 border border-slate-800 text-emerald-400 font-extrabold text-sm rounded-xl px-4 py-2.5 outline-none focus:border-emerald-500">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-1">Calculated Due Amount (৳)</label>
                            <input type="number" step="0.01" id="due_amount" readonly value="0.00"
                                class="w-full bg-slate-900 border border-slate-800 text-rose-400 font-extrabold text-sm rounded-xl px-4 py-2.5 outline-none">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3 border-t border-slate-900">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Payment Method</label>
                            <select name="payment_method" required class="w-full bg-slate-900 border border-slate-800 text-white text-xs rounded-xl px-4 py-2.5 outline-none">
                                <option value="cash">Cash Counter</option>
                                <option value="card">Credit / Debit Card</option>
                                <option value="bkash">bKash / Nagad / Mobile Banking</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Invoice Notes (Optional)</label>
                            <input type="text" name="notes" placeholder="e.g. OPD Consultation &amp; Pathology Tests"
                                class="w-full bg-slate-900 border border-slate-800 text-white text-xs rounded-xl px-4 py-2.5 outline-none">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.invoices.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Save &amp; Generate Invoice</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let itemIndex = 1;
    const container = document.getElementById('itemsContainer');
    const addBtn = document.getElementById('addItemBtn');

    function calculateTotals() {
        let subtotal = 0;
        document.querySelectorAll('.item-amount').forEach(input => {
            const val = parseFloat(input.value) || 0;
            subtotal += val;
        });

        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const paid = parseFloat(document.getElementById('paid_amount').value) || 0;
        const total = Math.max(0, subtotal - discount);
        const due = Math.max(0, total - paid);

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('due_amount').value = due.toFixed(2);
    }

    addBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'grid grid-cols-12 gap-3 item-row items-center';
        row.innerHTML = `
            <div class="col-span-8">
                <input type="text" name="items[${itemIndex}][description]" placeholder="Item Description" required
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-amber-500">
            </div>
            <div class="col-span-3">
                <input type="number" step="0.01" name="items[${itemIndex}][amount]" placeholder="Amount (৳)" required
                    class="item-amount w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-amber-500">
            </div>
            <div class="col-span-1 text-center">
                <button type="button" class="remove-item-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        itemIndex++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-item-btn')) {
            const rows = container.querySelectorAll('.item-row');
            if (rows.length > 1) {
                e.target.closest('.item-row').remove();
                calculateTotals();
            }
        }
    });

    document.getElementById('invoiceForm').addEventListener('input', calculateTotals);
});
</script>
@endsection

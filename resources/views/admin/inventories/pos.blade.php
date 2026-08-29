@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-cash-register text-emerald-400"></i> Pharmacy POS &amp; Medicine Dispensing Counter
                </h1>
                <p class="text-slate-400 text-xs mt-1">Sell medicines over the counter with automatic stock deduction and instant receipt printing.</p>
            </div>
            <a href="{{ route('admin.inventories.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Inventory</a>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-xs font-bold">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.inventories.sell') }}" class="space-y-6" id="posForm">
                @csrf

                <!-- Bill Header Bar -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pb-6 border-b border-slate-800">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Pharmacy Invoice No</label>
                        <input type="text" name="invoice_no" value="{{ old('invoice_no', $pharmacyInvoiceNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-emerald-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient / Customer</label>
                        <select name="patient_id" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-emerald-500">
                            <option value="">Walk-in OTC Customer (Cash Sale)</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}">
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Payment Method *</label>
                        <select name="payment_method" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-emerald-500">
                            <option value="cash">Cash Counter</option>
                            <option value="card">Credit / Debit Card</option>
                            <option value="bkash">bKash / Nagad / Mobile Banking</option>
                        </select>
                    </div>
                </div>

                <!-- Dynamic POS Medicine Cart Table -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold uppercase text-emerald-400 flex items-center gap-2">
                            <i class="fas fa-pills"></i> Select Medicines to Dispense
                        </h3>
                        <button type="button" id="addPosItemBtn" class="px-3 py-1.5 bg-emerald-500/20 hover:bg-emerald-500/30 text-emerald-300 font-bold text-xs rounded-lg border border-emerald-500/30 transition">
                            + Add Medicine Row
                        </button>
                    </div>

                    <div class="space-y-3" id="posItemsContainer">
                        <!-- Row 1 -->
                        <div class="grid grid-cols-12 gap-3 pos-row items-center">
                            <div class="col-span-6">
                                <select name="items[0][inventory_id]" class="medicine-select w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500" required>
                                    <option value="" data-price="0" data-stock="0">Select Medicine from Stock...</option>
                                    @foreach($medicines as $med)
                                    <option value="{{ $med->id }}" data-price="{{ $med->unit_price }}" data-stock="{{ $med->quantity }}">
                                        {{ $med->item_name }} (Stock: {{ $med->quantity }} units @ ৳{{ number_format($med->unit_price, 2) }})
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <input type="number" name="items[0][quantity]" value="1" min="1" required placeholder="Qty"
                                    class="qty-input w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500">
                            </div>
                            <div class="col-span-3 text-right">
                                <span class="text-xs font-bold text-slate-400">Line Total: </span>
                                <strong class="line-total text-emerald-400 text-xs font-black">৳ 0.00</strong>
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" class="remove-pos-row text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Financial Calculation Box -->
                <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 space-y-4">
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 text-xs">
                        <div>
                            <label class="block font-bold text-slate-400 mb-1">Subtotal (৳)</label>
                            <input type="number" step="0.01" id="posSubtotal" readonly value="0.00"
                                class="w-full bg-slate-900 border border-slate-800 text-white font-extrabold text-sm rounded-xl px-3.5 py-2 outline-none">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 mb-1">Discount (৳)</label>
                            <input type="number" step="0.01" name="discount" id="posDiscount" value="0.00" min="0"
                                class="w-full bg-slate-900 border border-slate-800 text-amber-400 font-bold text-sm rounded-xl px-3.5 py-2 outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-300 mb-1">Paid Amount (৳) *</label>
                            <input type="number" step="0.01" name="paid_amount" id="posPaid" value="0.00" min="0" required
                                class="w-full bg-slate-900 border border-slate-800 text-emerald-400 font-extrabold text-sm rounded-xl px-3.5 py-2 outline-none focus:border-emerald-500">
                        </div>
                        <div>
                            <label class="block font-bold text-slate-400 mb-1">Due Amount (৳)</label>
                            <input type="number" step="0.01" id="posDue" readonly value="0.00"
                                class="w-full bg-slate-900 border border-slate-800 text-rose-400 font-extrabold text-sm rounded-xl px-3.5 py-2 outline-none">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.inventories.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
                        <i class="fas fa-check-circle"></i> Complete Sale &amp; Print Receipt
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let rowIdx = 1;
    const container = document.getElementById('posItemsContainer');
    const addBtn = document.getElementById('addPosItemBtn');

    function calculatePosTotals() {
        let subtotal = 0;
        document.querySelectorAll('.pos-row').forEach(row => {
            const select = row.querySelector('.medicine-select');
            const qtyInput = row.querySelector('.qty-input');
            const lineTotalSpan = row.querySelector('.line-total');

            const option = select.options[select.selectedIndex];
            const price = parseFloat(option ? option.dataset.price : 0) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            const lineTotal = price * qty;

            lineTotalSpan.textContent = '৳ ' + lineTotal.toFixed(2);
            subtotal += lineTotal;
        });

        const discount = parseFloat(document.getElementById('posDiscount').value) || 0;
        const total = Math.max(0, subtotal - discount);
        
        document.getElementById('posSubtotal').value = subtotal.toFixed(2);
        
        // Auto fill paid amount if not touched
        const paidInput = document.getElementById('posPaid');
        if (paidInput.dataset.userTouched !== 'true') {
            paidInput.value = total.toFixed(2);
        }
        
        const paid = parseFloat(paidInput.value) || 0;
        const due = Math.max(0, total - paid);
        document.getElementById('posDue').value = due.toFixed(2);
    }

    document.getElementById('posPaid').addEventListener('input', function() {
        this.dataset.userTouched = 'true';
    });

    addBtn.addEventListener('click', function () {
        const firstSelect = container.querySelector('.medicine-select');
        const optionsHtml = firstSelect.innerHTML;

        const row = document.createElement('div');
        row.className = 'grid grid-cols-12 gap-3 pos-row items-center';
        row.innerHTML = `
            <div class="col-span-6">
                <select name="items[${rowIdx}][inventory_id]" class="medicine-select w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500" required>
                    ${optionsHtml}
                </select>
            </div>
            <div class="col-span-2">
                <input type="number" name="items[${rowIdx}][quantity]" value="1" min="1" required placeholder="Qty"
                    class="qty-input w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500">
            </div>
            <div class="col-span-3 text-right">
                <span class="text-xs font-bold text-slate-400">Line Total: </span>
                <strong class="line-total text-emerald-400 text-xs font-black">৳ 0.00</strong>
            </div>
            <div class="col-span-1 text-center">
                <button type="button" class="remove-pos-row text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        rowIdx++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-pos-row')) {
            const rows = container.querySelectorAll('.pos-row');
            if (rows.length > 1) {
                e.target.closest('.pos-row').remove();
                calculatePosTotals();
            }
        }
    });

    document.getElementById('posForm').addEventListener('input', calculatePosTotals);
    document.getElementById('posForm').addEventListener('change', calculatePosTotals);
});
</script>
@endsection

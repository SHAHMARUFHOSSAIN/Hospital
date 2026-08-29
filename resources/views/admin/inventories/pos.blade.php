@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-cash-register text-emerald-400"></i> Pharmacy POS &amp; Live Stock Dispensing Engine
                </h1>
                <p class="text-slate-400 text-xs mt-1">Search medicines by name or code, check real-time stock, and dispense with auto stock deduction.</p>
            </div>
            <a href="{{ route('admin.inventories.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Stock Directory</a>
        </div>

        @if(session('error'))
        <div class="mb-6 p-4 bg-rose-500/20 border border-rose-500/40 text-rose-300 rounded-xl text-xs font-bold">
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.inventories.sell') }}" id="posForm">
            @csrf
            <input type="hidden" name="invoice_no" value="{{ $pharmacyInvoiceNo }}">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                
                <!-- Left Side: Live Medicine Search & Quick Add Panel (7 Cols) -->
                <div class="lg:col-span-7 space-y-4">
                    <!-- Search Bar -->
                    <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 space-y-3">
                        <label class="block text-xs font-extrabold uppercase text-emerald-400 flex items-center gap-2">
                            <i class="fas fa-search"></i> Search Medicine Stock (Instant Search)
                        </label>
                        <div class="relative">
                            <input type="text" id="medicineSearchInput" placeholder="Type medicine name (e.g. Napa, Ceftriaxone) or Item Code..."
                                class="w-full bg-slate-950 border border-slate-700 text-white text-xs font-semibold rounded-xl pl-10 pr-4 py-3 outline-none focus:border-emerald-500 shadow-inner">
                            <i class="fas fa-pills absolute left-3.5 top-3.5 text-slate-500 text-sm"></i>
                        </div>
                    </div>

                    <!-- Searchable Medicine Cards Grid -->
                    <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 min-h-[420px] max-h-[520px] overflow-y-auto scrollbar-thin">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3" id="medicineCardContainer">
                            @forelse($medicines as $med)
                            <div class="medicine-card bg-slate-950 p-3.5 rounded-xl border border-slate-800 hover:border-emerald-500/50 transition flex flex-col justify-between"
                                 data-name="{{ strtolower($med->item_name) }}"
                                 data-code="{{ strtolower($med->item_code) }}">
                                <div>
                                    <div class="flex items-start justify-between gap-2">
                                        <span class="text-[10px] font-mono text-slate-400 bg-slate-900 px-2 py-0.5 rounded border border-slate-800">{{ $med->item_code }}</span>
                                        <span class="text-[10px] font-extrabold px-2 py-0.5 rounded-full uppercase {{ $med->quantity <= $med->reorder_level ? 'bg-amber-500/20 text-amber-300 border border-amber-500/30' : 'bg-emerald-500/20 text-emerald-300' }}">
                                            Stock: {{ $med->quantity }}
                                        </span>
                                    </div>
                                    <h4 class="text-xs font-extrabold text-white mt-2">{{ $med->item_name }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-0.5">Supplier: {{ $med->supplier ?: 'General' }}</p>
                                </div>

                                <div class="flex items-center justify-between mt-3 pt-2 border-t border-slate-900">
                                    <span class="text-xs font-black text-emerald-400">৳ {{ number_format($med->unit_price, 2) }}</span>
                                    <button type="button" 
                                        class="add-to-cart-btn px-3 py-1.5 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-[11px] rounded-lg shadow transition flex items-center gap-1"
                                        data-id="{{ $med->id }}"
                                        data-name="{{ $med->item_name }}"
                                        data-price="{{ $med->unit_price }}"
                                        data-stock="{{ $med->quantity }}">
                                        + Add to Bill
                                    </button>
                                </div>
                            </div>
                            @empty
                            <div class="col-span-2 text-center py-12 text-slate-500 text-xs">
                                No active medicine stock found in inventory.
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Right Side: Live POS Cart & Checkout Panel (5 Cols) -->
                <div class="lg:col-span-5 space-y-4">
                    <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800 space-y-4 flex flex-col justify-between">
                        
                        <div>
                            <!-- Header Info -->
                            <div class="flex items-center justify-between pb-3 border-b border-slate-800 mb-4">
                                <span class="text-xs font-extrabold text-emerald-400 uppercase">Dispensing Invoice</span>
                                <span class="text-xs font-mono text-slate-300 font-bold bg-slate-950 px-2.5 py-1 rounded-lg border border-slate-800">{{ $pharmacyInvoiceNo }}</span>
                            </div>

                            <!-- Patient / Customer Selector -->
                            <div class="space-y-3 mb-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-300 mb-1">Customer / Registered Patient</label>
                                    <select name="patient_id" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500">
                                        <option value="">Walk-in OTC Customer (Cash)</option>
                                        @foreach($patients as $p)
                                        <option value="{{ $p->id }}">
                                            {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-[11px] font-bold text-slate-300 mb-1">Payment Method *</label>
                                    <select name="payment_method" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-emerald-500">
                                        <option value="cash">Cash Counter</option>
                                        <option value="card">Credit / Debit Card</option>
                                        <option value="bkash">bKash / Nagad / Mobile Banking</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Cart Items List -->
                            <div class="space-y-2 mb-4">
                                <label class="block text-[11px] font-extrabold uppercase text-slate-400">Cart Bill Items</label>
                                <div class="space-y-2 max-h-[220px] overflow-y-auto scrollbar-thin" id="cartContainer">
                                    <p class="text-xs text-slate-500 italic text-center py-6" id="emptyCartNotice">No medicines added yet. Click "+ Add to Bill" on the left.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Calculations Box -->
                        <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 space-y-2.5 text-xs font-semibold">
                            <div class="flex justify-between text-slate-400">
                                <span>Subtotal Amount:</span>
                                <strong class="text-white text-sm" id="cartSubtotal">৳ 0.00</strong>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-slate-300">Discount (৳):</span>
                                <input type="number" step="0.01" name="discount" id="cartDiscount" value="0.00" min="0"
                                    class="w-28 bg-slate-900 border border-slate-800 text-amber-400 font-extrabold text-xs text-right rounded-lg px-2.5 py-1 outline-none focus:border-amber-500">
                            </div>

                            <div class="flex justify-between text-emerald-400 font-extrabold text-sm pt-2 border-t border-slate-800">
                                <span>Total Payable:</span>
                                <strong id="cartTotal">৳ 0.00</strong>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-slate-300">Paid Amount (৳):</span>
                                <input type="number" step="0.01" name="paid_amount" id="cartPaid" value="0.00" min="0" required
                                    class="w-28 bg-slate-900 border border-slate-800 text-emerald-400 font-extrabold text-xs text-right rounded-lg px-2.5 py-1 outline-none focus:border-emerald-500">
                            </div>

                            <div class="flex justify-between text-rose-400 font-extrabold">
                                <span>Due Amount:</span>
                                <strong id="cartDue">৳ 0.00</strong>
                            </div>
                        </div>

                        <button type="submit" class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-extrabold text-xs rounded-xl shadow-lg transition flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle text-base"></i> Complete Sale &amp; Auto Deduct Stock
                        </button>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('medicineSearchInput');
    const cards = document.querySelectorAll('.medicine-card');
    const cartContainer = document.getElementById('cartContainer');
    const emptyNotice = document.getElementById('emptyCartNotice');
    let cart = {};

    // Real-time Search Filter
    searchInput.addEventListener('keyup', function () {
        const query = this.value.toLowerCase().trim();
        cards.forEach(card => {
            const name = card.dataset.name;
            const code = card.dataset.code;
            if (name.includes(query) || code.includes(query)) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Add to Cart Handler
    document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const price = parseFloat(this.dataset.price);
            const stock = parseInt(this.dataset.stock);

            if (cart[id]) {
                if (cart[id].qty < stock) {
                    cart[id].qty++;
                } else {
                    alert('Cannot exceed available stock limit (' + stock + ' units)');
                }
            } else {
                cart[id] = { id, name, price, stock, qty: 1 };
            }

            renderCart();
        });
    });

    function renderCart() {
        cartContainer.innerHTML = '';
        const keys = Object.keys(cart);

        if (keys.length === 0) {
            emptyNotice.style.display = 'block';
            cartContainer.appendChild(emptyNotice);
            calculateTotals();
            return;
        }

        emptyNotice.style.display = 'none';

        keys.forEach((id, index) => {
            const item = cart[id];
            const lineTotal = item.price * item.qty;

            const div = document.createElement('div');
            div.className = 'p-2.5 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between gap-2 text-xs';
            div.innerHTML = `
                <input type="hidden" name="items[${index}][inventory_id]" value="${item.id}">
                <div class="flex-1 min-w-0">
                    <h5 class="text-white font-extrabold truncate text-[11px]">${item.name}</h5>
                    <span class="text-[10px] text-emerald-400 font-bold">৳ ${item.price.toFixed(2)} / unit</span>
                </div>
                <div class="flex items-center gap-1.5 shrink-0">
                    <input type="number" name="items[${index}][quantity]" value="${item.qty}" min="1" max="${item.stock}" required
                        data-id="${item.id}"
                        class="cart-qty-input w-14 bg-slate-900 border border-slate-700 text-white font-bold text-center text-xs rounded-lg py-1 outline-none">
                    <span class="text-white font-black text-xs w-16 text-right">৳ ${lineTotal.toFixed(2)}</span>
                    <button type="button" data-id="${item.id}" class="remove-cart-item text-rose-400 hover:text-rose-300 p-1">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            cartContainer.appendChild(div);
        });

        calculateTotals();
    }

    cartContainer.addEventListener('change', function (e) {
        if (e.target.classList.contains('cart-qty-input')) {
            const id = e.target.dataset.id;
            let val = parseInt(e.target.value) || 1;
            if (val > cart[id].stock) {
                alert('Stock limit exceeded! Max available: ' + cart[id].stock);
                val = cart[id].stock;
            }
            cart[id].qty = val;
            renderCart();
        }
    });

    cartContainer.addEventListener('click', function (e) {
        const btn = e.target.closest('.remove-cart-item');
        if (btn) {
            const id = btn.dataset.id;
            delete cart[id];
            renderCart();
        }
    });

    function calculateTotals() {
        let subtotal = 0;
        Object.keys(cart).forEach(id => {
            subtotal += cart[id].price * cart[id].qty;
        });

        const discount = parseFloat(document.getElementById('cartDiscount').value) || 0;
        const total = Math.max(0, subtotal - discount);

        document.getElementById('cartSubtotal').textContent = '৳ ' + subtotal.toFixed(2);
        document.getElementById('cartTotal').textContent = '৳ ' + total.toFixed(2);

        const paidInput = document.getElementById('cartPaid');
        if (paidInput.dataset.userTouched !== 'true') {
            paidInput.value = total.toFixed(2);
        }

        const paid = parseFloat(paidInput.value) || 0;
        const due = Math.max(0, total - paid);
        document.getElementById('cartDue').textContent = '৳ ' + due.toFixed(2);
    }

    document.getElementById('cartPaid').addEventListener('input', function () {
        this.dataset.userTouched = 'true';
    });

    document.getElementById('cartDiscount').addEventListener('input', calculateTotals);
    document.getElementById('cartPaid').addEventListener('input', calculateTotals);
});
</script>
@endsection

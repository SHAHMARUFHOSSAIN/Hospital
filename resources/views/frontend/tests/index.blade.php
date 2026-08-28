@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('tests') . ' — CarePlus Hospital')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-microscope"></i> {{ \App\Helpers\LanguageHelper::get('tests') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">{{ \App\Helpers\LanguageHelper::get('tests') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-sm font-semibold">Search across 2,000+ pathology, imaging, CT scan, 3.0T MRI, and blood test rates with instant health card discount calculator.</p>
    </div>
</section>

<!-- Interactive Live Search Engine & Discount Calculator -->
<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="grid lg:grid-cols-12 gap-8">
            
            <!-- Left 8 Columns: Live Search & Test Checkboxes -->
            <div class="lg:col-span-8 space-y-6">
                
                <!-- Instant Live Search Bar -->
                <div class="bg-white p-4 rounded-3xl shadow-lg border border-sky-100 flex items-center gap-3">
                    <i class="fas fa-magnifying-glass text-[#0284C7] text-xl ml-2"></i>
                    <input type="text" id="testSearchInput" placeholder="Search test name or department (e.g. CBC, MRI, Troponin, Lipid Profile...)"
                        class="w-full text-xs sm:text-sm font-semibold text-slate-800 focus:outline-none bg-transparent">
                    <span id="testMatchCount" class="text-xs font-extrabold text-[#0284C7] bg-sky-50 px-3 py-1.5 rounded-full whitespace-nowrap border border-sky-100">
                        {{ $tests->count() }} Tests
                    </span>
                </div>

                <!-- Test List Cards Grid -->
                <div class="space-y-3" id="testsGrid">
                    @forelse($tests as $test)
                    @php
                        $priceVal = $test->price ?? $test->price_bdt ?? 0;
                        $deptVal = $test->category_name ?? $test->department ?? 'General Pathology';
                        $prepVal = $test->preparation_instructions ?? $test->preparation_info ?? '';
                    @endphp
                    <div class="test-item-card bg-white p-5 rounded-2xl border border-slate-200 hover:border-[#0284C7] shadow-sm transition flex flex-col sm:flex-row sm:items-center justify-between gap-4"
                        data-search="{{ strtolower($test->name . ' ' . $deptVal . ' ' . $prepVal) }}">
                        
                        <div class="flex items-start gap-4">
                            <input type="checkbox" class="test-checkbox w-5 h-5 rounded text-[#0284C7] focus:ring-[#0284C7] mt-1 cursor-pointer"
                                data-id="{{ $test->id }}"
                                data-name="{{ $test->name }}"
                                data-price="{{ $priceVal }}">
                            
                            <div>
                                <span class="px-2.5 py-0.5 bg-sky-50 text-[#0284C7] text-[10px] font-extrabold uppercase rounded-full border border-sky-100 inline-block mb-1">
                                    {{ $deptVal }}
                                </span>
                                <h4 class="font-extrabold text-base text-slate-900 leading-tight">{{ $test->name }}</h4>
                                @if($prepVal)
                                <p class="text-[11px] text-amber-700 bg-amber-50 px-2.5 py-1 rounded-lg font-bold mt-1 inline-block border border-amber-200/60">
                                    <i class="fas fa-circle-info mr-1"></i> {{ $prepVal }}
                                </p>
                                @endif
                            </div>
                        </div>

                        <div class="text-right shrink-0">
                            <div class="text-xl font-extrabold text-[#0284C7]">BDT {{ number_format((float)$priceVal, 2) }}</div>
                            <span class="text-[10px] text-emerald-600 font-bold bg-emerald-50 px-2 py-0.5 rounded-full"><i class="fas fa-bolt mr-0.5"></i> Same-Day Report</span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-16 bg-white rounded-3xl border border-slate-200">
                        <i class="fas fa-vial text-5xl text-slate-300 mb-4"></i>
                        <p class="text-slate-500 font-semibold">No diagnostic test rates published yet.</p>
                    </div>
                    @endforelse
                </div>

            </div>

            <!-- Right 4 Columns: Interactive Live Discount Calculator -->
            <div class="lg:col-span-4">
                <div class="bg-white p-6 sm:p-8 rounded-3xl shadow-2xl border-2 border-sky-100 sticky top-24 space-y-6">
                    <div>
                        <div class="flex items-center gap-2 text-[#0284C7] text-xs font-extrabold uppercase tracking-wider mb-1">
                            <i class="fas fa-[#0284C7]"></i> Bill Estimate &amp; Discount
                        </div>
                        <h3 class="font-extrabold text-xl text-slate-900">Selected Tests Summary</h3>
                    </div>

                    <!-- Selected Items Container -->
                    <div id="selectedTestsContainer" class="min-h-[100px] max-h-[220px] overflow-y-auto space-y-2 text-xs font-semibold text-slate-600 divide-y divide-slate-100 pr-1">
                        <p class="text-slate-400 italic text-center py-8">Select tests on the left to calculate total bill and health card discounts.</p>
                    </div>

                    <!-- Discount Selector Buttons -->
                    <div>
                        <label class="block text-[11px] font-extrabold uppercase text-slate-500 mb-2">Apply Health Card Discount</label>
                        <div class="grid grid-cols-5 gap-1.5" id="discountButtonGrid">
                            <button type="button" class="discount-btn active py-2 rounded-xl border text-xs font-extrabold transition bg-[#0284C7] text-white border-[#0284C7]" data-discount="0">0%</button>
                            <button type="button" class="discount-btn py-2 rounded-xl border text-xs font-extrabold transition bg-slate-50 text-slate-700 border-slate-200 hover:bg-sky-50" data-discount="5">5%</button>
                            <button type="button" class="discount-btn py-2 rounded-xl border text-xs font-extrabold transition bg-slate-50 text-slate-700 border-slate-200 hover:bg-sky-50" data-discount="10">10%</button>
                            <button type="button" class="discount-btn py-2 rounded-xl border text-xs font-extrabold transition bg-slate-50 text-slate-700 border-slate-200 hover:bg-sky-50" data-discount="15">15%</button>
                            <button type="button" class="discount-btn py-2 rounded-xl border text-xs font-extrabold transition bg-slate-50 text-slate-700 border-slate-200 hover:bg-sky-50" data-discount="20">20%</button>
                        </div>
                    </div>

                    <!-- Financial Summary -->
                    <div class="bg-slate-50 p-4 rounded-2xl border border-slate-200 space-y-2 text-xs font-bold">
                        <div class="flex justify-between text-slate-600">
                            <span>Subtotal Rate:</span>
                            <span id="calcSubtotal">BDT 0</span>
                        </div>
                        <div class="flex justify-between text-emerald-600">
                            <span>Discount Amount:</span>
                            <span id="calcDiscount">BDT 0</span>
                        </div>
                        <div class="flex justify-between text-slate-900 text-base font-extrabold pt-2 border-t border-slate-200">
                            <span>Net Payable:</span>
                            <span id="calcNetTotal" class="text-[#0284C7]">BDT 0</span>
                        </div>
                    </div>

                    <a href="#appointment" id="proceedBookingBtn" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                        <span>Book Selected Tests</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- JavaScript for Live Search & Discount Calculator -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('testSearchInput');
    const testCards = document.querySelectorAll('.test-item-card');
    const matchCount = document.getElementById('testMatchCount');
    const checkboxes = document.querySelectorAll('.test-checkbox');
    const container = document.getElementById('selectedTestsContainer');
    const calcSubtotal = document.getElementById('calcSubtotal');
    const calcDiscount = document.getElementById('calcDiscount');
    const calcNetTotal = document.getElementById('calcNetTotal');
    const discountBtns = document.querySelectorAll('.discount-btn');
    
    let activeDiscountPercent = 0;
    let selectedTests = [];

    // Live Search Filter
    if (searchInput) {
        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            let count = 0;

            testCards.forEach(card => {
                const searchData = card.getAttribute('data-search') || '';
                if (searchData.includes(query)) {
                    card.style.display = 'flex';
                    count++;
                } else {
                    card.style.display = 'none';
                }
            });

            matchCount.textContent = count + ' Tests';
        });
    }

    // Checkbox Toggle Event
    checkboxes.forEach(cb => {
        cb.addEventListener('change', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseFloat(this.getAttribute('data-price')) || 0;

            if (this.checked) {
                selectedTests.push({ id, name, price });
            } else {
                selectedTests = selectedTests.filter(t => t.id !== id);
            }
            renderSummary();
        });
    });

    // Discount Button Click Event
    discountBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            discountBtns.forEach(b => {
                b.classList.remove('bg-[#0284C7]', 'text-white', 'border-[#0284C7]');
                b.classList.add('bg-slate-50', 'text-slate-700', 'border-slate-200');
            });
            this.classList.remove('bg-slate-50', 'text-slate-700', 'border-slate-200');
            this.classList.add('bg-[#0284C7]', 'text-white', 'border-[#0284C7]');
            
            activeDiscountPercent = parseFloat(this.getAttribute('data-discount')) || 0;
            renderSummary();
        });
    });

    // Render Calculator Results
    function renderSummary() {
        if (selectedTests.length === 0) {
            container.innerHTML = '<p class="text-slate-400 italic text-center py-8">Select tests on the left to calculate total bill and health card discounts.</p>';
            calcSubtotal.textContent = 'BDT 0';
            calcDiscount.textContent = 'BDT 0';
            calcNetTotal.textContent = 'BDT 0';
            return;
        }

        let html = '';
        let subtotal = 0;

        selectedTests.forEach(test => {
            subtotal += test.price;
            html += `
                <div class="flex justify-between items-center py-1.5">
                    <span class="text-slate-800 font-bold truncate max-w-[180px]">${test.name}</span>
                    <span class="text-[#0284C7] font-extrabold">BDT ${test.price.toLocaleString()}</span>
                </div>
            `;
        });

        const discountAmt = (subtotal * activeDiscountPercent) / 100;
        const netTotal = subtotal - discountAmt;

        container.innerHTML = html;
        calcSubtotal.textContent = 'BDT ' + subtotal.toLocaleString();
        calcDiscount.textContent = 'BDT ' + discountAmt.toLocaleString();
        calcNetTotal.textContent = 'BDT ' + netTotal.toLocaleString();
    }
});
</script>
@endsection

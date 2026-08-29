<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Money Receipt — {{ $invoice->invoice_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        
        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                overflow: hidden !important;
            }
            .no-print { display: none !important; }
            .a4-page {
                width: 210mm !important;
                height: 297mm !important;
                max-height: 297mm !important;
                margin: 0 !important;
                padding: 12mm 15mm !important;
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
            }
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            max-height: 297mm;
            margin: 0 auto;
            padding: 12mm 15mm;
            background: #ffffff;
            position: relative;
            display: flex;
            flex-col;
            justify-content: space-between;
            overflow: hidden;
        }

        .watermark-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            max-height: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0.04;
            pointer-events: none;
            user-select: none;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-slate-100 py-6">

    <!-- Action Bar -->
    <div class="max-w-[210mm] mx-auto mb-4 flex items-center justify-between no-print bg-slate-900 p-4 rounded-2xl text-white shadow-xl">
        <div class="flex items-center gap-3">
            <i class="fas fa-file-invoice-dollar text-amber-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Official Money Receipt (A4 Print Ready)</h3>
                <p class="text-slate-400 text-xs">Optimized for single-page A4 print output without cropping</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Official Receipt
        </button>
    </div>

    <!-- Printable A4 Container -->
    <div class="a4-page shadow-2xl border border-slate-200 rounded-2xl relative">
        
        <!-- Transparent Watermark -->
        <div class="watermark-container">
            @php
                $logoUrl = \App\Models\Media::where('type', 'logo')->value('url') ?: asset('images/logo.png');
            @endphp
            <img src="{{ $logoUrl }}" class="w-64 h-auto object-contain max-h-64 mb-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="text-center font-black text-6xl tracking-widest text-slate-900 uppercase" style="display:none;">CAREPLUS</div>
            <span class="text-3xl font-black text-slate-900 uppercase tracking-widest mt-2">CarePlus Hospital</span>
            <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Official Payment Receipt</span>
        </div>

        <div class="relative z-10 flex-1 flex flex-col justify-between">
            <div>
                <!-- Hospital Header -->
                <div class="flex items-center justify-between pb-4 border-b-2 border-amber-500">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ $logoUrl }}" class="h-14 w-auto max-w-[180px] object-contain" 
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-md shrink-0" style="display:none;">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black tracking-tight text-slate-900 leading-none">
                                Care<span class="text-[#0284C7]">Plus</span> Hospital
                            </h1>
                            <p class="text-[10px] font-extrabold text-amber-600 uppercase tracking-widest mt-1">Official Money Receipt &amp; Voucher</p>
                        </div>
                    </div>

                    <div class="text-right text-[11px] text-slate-600 space-y-0.5">
                        <p class="font-extrabold text-slate-900">Dhanmondi, Dhaka 1205</p>
                        <p>Hotline: <strong class="text-slate-900">1-800-CARE-NOW</strong></p>
                        <p class="text-[10px] text-amber-600 font-bold uppercase">Customer Copy</p>
                    </div>
                </div>

                <!-- Receipt Metadata -->
                <div class="my-4 p-3.5 bg-amber-50/60 rounded-xl border border-amber-200/80 grid grid-cols-4 gap-3 text-xs font-semibold">
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Receipt No</span>
                        <strong class="text-amber-600 text-sm block">{{ $invoice->invoice_no }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Patient Name</span>
                        <strong class="text-slate-900 text-xs block truncate">{{ $invoice->patient->name ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">UHID</span>
                        <strong class="text-[#0284C7] text-xs block">{{ $invoice->patient->patient_id ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Date &amp; Time</span>
                        <strong class="text-slate-900 text-xs block">{{ $invoice->created_at->format('d/m/Y h:i A') }}</strong>
                    </div>
                </div>

                <!-- Table -->
                <div class="mb-4">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="bg-amber-100/70 text-slate-800 font-extrabold uppercase border-b border-amber-300 text-[10px]">
                                <th class="py-2 px-3 text-left w-8">#</th>
                                <th class="py-2 px-3 text-left">Service / Item Description</th>
                                <th class="py-2 px-3 text-right">Amount (৳)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 font-medium text-[11px]">
                            @forelse($invoice->items ?? [] as $index => $item)
                            <tr>
                                <td class="py-2.5 px-3 text-slate-400 font-bold">{{ $index + 1 }}</td>
                                <td class="py-2.5 px-3 text-slate-900 font-extrabold text-xs">{{ $item['description'] ?? '' }}</td>
                                <td class="py-2.5 px-3 text-right font-bold text-slate-900 text-xs">৳ {{ number_format($item['amount'] ?? 0, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-slate-400 italic">No billable items.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Financial Summary & Status Stamp -->
                <div class="flex items-center justify-between gap-4 pt-3 border-t border-slate-200">
                    <div>
                        <div class="inline-block px-3 py-1.5 rounded-lg text-center border uppercase font-black text-xs shadow-sm
                            @if($invoice->status === 'paid') bg-emerald-50 text-emerald-600 border-emerald-500
                            @elseif($invoice->status === 'partial') bg-amber-50 text-amber-600 border-amber-500
                            @else bg-rose-50 text-rose-600 border-rose-500 @endif">
                            Payment Status: {{ $invoice->status }}
                        </div>
                        <p class="text-[10px] text-slate-400 font-semibold mt-1">Payment Method: <strong class="uppercase text-slate-700">{{ $invoice->payment_method }}</strong></p>
                    </div>

                    <div class="w-56 space-y-1 text-xs font-bold text-right">
                        <div class="flex justify-between text-slate-500">
                            <span>Subtotal:</span>
                            <span class="text-slate-900">৳ {{ number_format($invoice->subtotal, 2) }}</span>
                        </div>
                        @if($invoice->discount > 0)
                        <div class="flex justify-between text-amber-600">
                            <span>Discount:</span>
                            <span>- ৳ {{ number_format($invoice->discount, 2) }}</span>
                        </div>
                        @endif
                        <div class="flex justify-between text-slate-900 text-sm font-black pt-1 border-t border-slate-300">
                            <span>Total Amount:</span>
                            <span>৳ {{ number_format($invoice->total_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-emerald-600 font-extrabold">
                            <span>Paid Amount:</span>
                            <span>৳ {{ number_format($invoice->paid_amount, 2) }}</span>
                        </div>
                        @if($invoice->due_amount > 0)
                        <div class="flex justify-between text-rose-600 font-black pt-0.5">
                            <span>Due Amount:</span>
                            <span>৳ {{ number_format($invoice->due_amount, 2) }}</span>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Footer Signature -->
            <div class="pt-4 border-t border-slate-200 flex items-end justify-between text-xs mt-4">
                <p class="text-[9px] text-slate-400 font-semibold">Thank you for choosing CarePlus Hospital. Computer generated receipt.</p>
                <div class="text-center w-44">
                    <div class="border-b border-slate-700 pb-0.5 mb-0.5 font-bold text-slate-900 text-xs">
                        Authorized Cashier
                    </div>
                    <span class="text-[9px] text-slate-400 uppercase tracking-wider block">Signature &amp; Stamp</span>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

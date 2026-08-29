<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Money Receipt — {{ $invoice->invoice_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #0f172a; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-container { shadow: none !important; border: none !important; margin: 0 !important; max-width: 100% !important; }
        }
    </style>
</head>
<body class="py-8 px-4">

    <!-- Top Action Bar -->
    <div class="max-w-3xl mx-auto mb-6 flex items-center justify-between no-print bg-slate-900 p-4 rounded-2xl text-white shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-file-invoice-dollar text-amber-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Official Hospital Payment Receipt</h3>
                <p class="text-slate-400 text-xs">Print or save as PDF receipt for patient</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Official Receipt
        </button>
    </div>

    <!-- Printable Receipt Sheet Container -->
    <div class="max-w-3xl mx-auto bg-white rounded-3xl p-8 sm:p-10 shadow-2xl border border-slate-200 print-container">
        
        <!-- Hospital Header with Logo -->
        <div class="flex items-center justify-between pb-6 border-b-2 border-amber-500">
            <div class="flex items-center gap-3.5">
                <div class="w-12 h-12 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-lg shadow-sky-500/20 shrink-0">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-black tracking-tight text-slate-900 leading-tight">
                        Care<span class="text-[#0284C7]">Plus</span> Hospital
                    </h1>
                    <p class="text-[10px] font-extrabold text-amber-600 uppercase tracking-widest">Official Money Receipt &amp; Voucher</p>
                </div>
            </div>

            <div class="text-right text-xs text-slate-500 space-y-0.5">
                <p class="font-bold text-slate-900">Dhanmondi, Dhaka 1205</p>
                <p>Hotline: <strong>1-800-CARE-NOW</strong></p>
                <p class="text-[10px] text-slate-400 font-bold uppercase">Customer Copy</p>
            </div>
        </div>

        <!-- Receipt Metadata -->
        <div class="my-6 p-4 bg-amber-50/60 rounded-2xl border border-amber-200/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold">
            <div>
                <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Receipt No</span>
                <strong class="text-amber-600 text-sm block">{{ $invoice->invoice_no }}</strong>
            </div>
            <div>
                <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Patient Name</span>
                <strong class="text-slate-900 text-sm block truncate">{{ $invoice->patient->name ?? 'N/A' }}</strong>
            </div>
            <div>
                <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">UHID</span>
                <strong class="text-[#0284C7] text-sm block">{{ $invoice->patient->patient_id ?? 'N/A' }}</strong>
            </div>
            <div>
                <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Date &amp; Time</span>
                <strong class="text-slate-900 text-xs block">{{ $invoice->created_at->format('d/m/Y h:i A') }}</strong>
            </div>
        </div>

        <!-- Itemized Table -->
        <div class="mb-6">
            <table class="w-full text-xs">
                <thead>
                    <tr class="bg-amber-100/70 text-slate-800 font-extrabold uppercase border-b border-amber-300">
                        <th class="py-2.5 px-3 text-left w-10">#</th>
                        <th class="py-2.5 px-3 text-left">Service / Item Description</th>
                        <th class="py-2.5 px-3 text-right">Amount (৳)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 font-medium">
                    @forelse($invoice->items ?? [] as $index => $item)
                    <tr>
                        <td class="py-3 px-3 text-slate-400 font-bold">{{ $index + 1 }}</td>
                        <td class="py-3 px-3 text-slate-900 font-extrabold">{{ $item['description'] ?? '' }}</td>
                        <td class="py-3 px-3 text-right font-bold text-slate-900">৳ {{ number_format($item['amount'] ?? 0, 2) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="py-4 text-center text-slate-400 italic">No billable items.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Totals & Payment Status Stamp -->
        <div class="flex flex-col sm:flex-row items-center justify-between gap-6 pt-4 border-t border-slate-200">
            <!-- Payment Stamp -->
            <div>
                <div class="inline-block px-4 py-2 rounded-xl text-center border-2 uppercase font-black tracking-widest text-sm shadow-sm
                    @if($invoice->status === 'paid') bg-emerald-50 text-emerald-600 border-emerald-500
                    @elseif($invoice->status === 'partial') bg-amber-50 text-amber-600 border-amber-500
                    @else bg-rose-50 text-rose-600 border-rose-500 @endif">
                    <i class="fas fa-certificate mr-1"></i> Status: {{ $invoice->status }}
                </div>
                <p class="text-[10px] text-slate-400 font-semibold mt-2">Payment Method: <strong class="uppercase text-slate-700">{{ $invoice->payment_method }}</strong></p>
            </div>

            <!-- Financial Summary -->
            <div class="w-full sm:w-64 space-y-1.5 text-xs font-bold text-right">
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
                <div class="flex justify-between text-slate-900 text-sm font-black pt-1.5 border-t border-slate-300">
                    <span>Total Amount:</span>
                    <span>৳ {{ number_format($invoice->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-emerald-600 font-extrabold">
                    <span>Paid Amount:</span>
                    <span>৳ {{ number_format($invoice->paid_amount, 2) }}</span>
                </div>
                @if($invoice->due_amount > 0)
                <div class="flex justify-between text-rose-600 font-black pt-1">
                    <span>Outstanding Due:</span>
                    <span>৳ {{ number_format($invoice->due_amount, 2) }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Cashier Signature Footer -->
        <div class="pt-10 border-t border-slate-200 flex items-end justify-between text-xs mt-10">
            <p class="text-[10px] text-slate-400 font-semibold">Thank you for choosing CarePlus Hospital. Wish you good health!</p>
            <div class="text-center w-48">
                <div class="border-b border-slate-700 pb-1 mb-1 font-bold text-slate-900">
                    Authorized Cashier
                </div>
                <span class="text-[10px] text-slate-400 uppercase tracking-wider block">Signature &amp; Stamp</span>
            </div>
        </div>

    </div>

</body>
</html>

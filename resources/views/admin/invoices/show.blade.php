@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-file-invoice-dollar text-amber-400"></i> Invoice Details — {{ $invoice->invoice_no }}
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.invoices.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back</a>
                <a href="{{ route('admin.invoices.print', $invoice) }}" target="_blank" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl shadow transition">
                    <i class="fas fa-print mr-1"></i> Print Receipt
                </a>
            </div>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800 space-y-6">
            <!-- Patient Info -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-800">
                <div>
                    <span class="text-[10px] text-slate-500 uppercase font-extrabold tracking-wider">Billed To Patient</span>
                    <h2 class="text-lg font-bold text-white mt-0.5">{{ $invoice->patient->name ?? 'N/A' }}</h2>
                    <p class="text-xs text-slate-400">UHID: <span class="text-sky-400 font-bold">{{ $invoice->patient->patient_id ?? 'N/A' }}</span> &bull; Phone: {{ $invoice->patient->phone ?? 'N/A' }}</p>
                </div>
                <div class="text-left sm:text-right">
                    <span class="px-3 py-1 text-xs font-black rounded-full uppercase 
                        @if($invoice->status === 'paid') bg-emerald-500/20 text-emerald-300 border border-emerald-500/30
                        @elseif($invoice->status === 'partial') bg-amber-500/20 text-amber-300 border border-amber-500/30
                        @else bg-rose-500/20 text-rose-300 border border-rose-500/30 @endif">
                        {{ $invoice->status }}
                    </span>
                    <p class="text-xs text-slate-400 mt-2">Billing Date: {{ $invoice->created_at->format('M d, Y - h:i A') }}</p>
                    <p class="text-xs text-slate-400">Method: <span class="text-white font-bold uppercase">{{ $invoice->payment_method }}</span></p>
                </div>
            </div>

            <!-- Itemized Table -->
            <div>
                <h4 class="text-xs font-extrabold text-amber-400 uppercase mb-3">Itemized Billing Charges</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs">
                        <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                            <tr>
                                <th class="px-4 py-2.5 text-left">#</th>
                                <th class="px-4 py-2.5 text-left">Item Description</th>
                                <th class="px-4 py-2.5 text-right">Amount (৳)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 font-medium">
                            @forelse($invoice->items ?? [] as $index => $item)
                            <tr>
                                <td class="px-4 py-3 text-slate-500">{{ $index + 1 }}</td>
                                <td class="px-4 py-3 text-white font-bold">{{ $item['description'] ?? '' }}</td>
                                <td class="px-4 py-3 text-right text-slate-200 font-bold">৳ {{ number_format($item['amount'] ?? 0, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-4 py-4 text-center text-slate-500">No items.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Totals Box -->
            <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 flex justify-end">
                <div class="w-full sm:w-72 space-y-2 text-xs font-bold">
                    <div class="flex justify-between text-slate-400">
                        <span>Subtotal:</span>
                        <span class="text-white">৳ {{ number_format($invoice->subtotal, 2) }}</span>
                    </div>
                    @if($invoice->discount > 0)
                    <div class="flex justify-between text-amber-400">
                        <span>Discount:</span>
                        <span>- ৳ {{ number_format($invoice->discount, 2) }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between text-white text-sm font-extrabold pt-2 border-t border-slate-800">
                        <span>Total Payable:</span>
                        <span>৳ {{ number_format($invoice->total_amount, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-emerald-400">
                        <span>Amount Paid:</span>
                        <span>৳ {{ number_format($invoice->paid_amount, 2) }}</span>
                    </div>
                    @if($invoice->due_amount > 0)
                    <div class="flex justify-between text-rose-400 font-extrabold pt-1">
                        <span>Outstanding Due:</span>
                        <span>৳ {{ number_format($invoice->due_amount, 2) }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-file-invoice-dollar text-amber-400"></i> Hospital Invoicing &amp; Billing Management
                </h1>
                <p class="text-slate-400 text-xs mt-1">Generate patient billing receipts for consultations, diagnostic tests, cabins, and medicines.</p>
            </div>
            <a href="{{ route('admin.invoices.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Create New Invoice
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Quick Financial Summary Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase">Filtered Revenue Collected</span>
                    <h3 class="text-2xl font-black text-emerald-400 mt-1">৳ {{ number_format($totalCollected, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
            </div>
            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-xs font-extrabold text-slate-400 uppercase">Filtered Outstanding Due</span>
                    <h3 class="text-2xl font-black text-rose-400 mt-1">৳ {{ number_format($totalDue, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-xl">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>
        </div>

        <!-- Date-Wise Financial Filter Bar -->
        <div class="bg-slate-900 rounded-2xl p-4 border border-slate-800 mb-6">
            <form method="GET" action="{{ route('admin.invoices.index') }}" class="flex flex-wrap items-center gap-4 text-xs">
                <div class="flex items-center gap-2">
                    <label class="font-extrabold text-slate-300">From Date:</label>
                    <input type="date" name="start_date" value="{{ request('start_date') }}"
                        class="bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 outline-none focus:border-amber-500">
                </div>

                <div class="flex items-center gap-2">
                    <label class="font-extrabold text-slate-300">To Date:</label>
                    <input type="date" name="end_date" value="{{ request('end_date') }}"
                        class="bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 outline-none focus:border-amber-500">
                </div>

                <div class="flex items-center gap-2">
                    <label class="font-extrabold text-slate-300">Status:</label>
                    <select name="status" class="bg-slate-950 border border-slate-800 text-white rounded-xl px-3 py-2 outline-none focus:border-amber-500">
                        <option value="">All Statuses</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="partial" {{ request('status') == 'partial' ? 'selected' : '' }}>Partial</option>
                        <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                    </select>
                </div>

                <div class="flex items-center gap-2 ml-auto">
                    <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-extrabold rounded-xl transition shadow">
                        <i class="fas fa-filter mr-1"></i> Filter Date Range
                    </button>
                    @if(request()->hasAny(['start_date', 'end_date', 'status', 'search']))
                    <a href="{{ route('admin.invoices.index') }}" class="px-4 py-2 bg-slate-800 text-slate-300 font-extrabold rounded-xl hover:bg-slate-700 transition">
                        Reset
                    </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Invoices Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">Invoice No</th>
                            <th class="px-6 py-3.5 text-left">Patient Details</th>
                            <th class="px-6 py-3.5 text-left">Total Amount</th>
                            <th class="px-6 py-3.5 text-left">Paid / Due</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-left">Date</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($invoices as $inv)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-amber-500/20 text-amber-300 font-extrabold rounded-lg border border-amber-500/30 text-[11px]">
                                    {{ $inv->invoice_no }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $inv->patient->name ?? 'N/A' }} <br>
                                <span class="text-sky-400 text-[10px]">{{ $inv->patient->patient_id ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-white font-extrabold text-sm">৳ {{ number_format($inv->total_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="text-emerald-400 font-bold">Paid: ৳ {{ number_format($inv->paid_amount, 2) }}</span>
                                @if($inv->due_amount > 0)
                                <br><span class="text-rose-400 font-bold text-[10px]">Due: ৳ {{ number_format($inv->due_amount, 2) }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase
                                    @if($inv->status === 'paid') bg-emerald-500/20 text-emerald-300 border border-emerald-500/30
                                    @elseif($inv->status === 'partial') bg-amber-500/20 text-amber-300 border border-amber-500/30
                                    @else bg-rose-500/20 text-rose-300 border border-rose-500/30 @endif">
                                    {{ $inv->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $inv->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.invoices.show', $inv) }}" class="px-3 py-1.5 bg-slate-800 text-slate-200 font-bold rounded-lg hover:bg-slate-700">View</a>
                                <a href="{{ route('admin.invoices.print', $inv) }}" target="_blank" class="px-3 py-1.5 bg-amber-500 text-white font-bold rounded-lg hover:bg-amber-600">
                                    <i class="fas fa-print mr-1"></i> Print Receipt
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No invoices generated yet. Click "+ Create New Invoice" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($invoices->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $invoices->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto space-y-6">
        <!-- Dashboard Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-[#0284C7] fa-chart-line text-emerald-400"></i> Executive Financial &amp; Operations Dashboard
                </h1>
                <p class="text-slate-400 text-xs mt-1">Real-time revenue performance, department census, IPD bed occupancy, and hospital operations KPIs.</p>
            </div>
            <div class="px-4 py-2 bg-slate-900 rounded-xl border border-slate-800 text-xs text-slate-300 font-bold self-start sm:self-auto">
                <i class="fas fa-circle text-emerald-400 text-[10px] mr-1.5 animate-pulse"></i> Live Hospital Data Engine
            </div>
        </div>

        <!-- 4 Financial & Operational Top KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Total Revenue Collected</span>
                    <h3 class="text-2xl font-black text-emerald-400 mt-1">৳ {{ number_format($totalRevenue, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fas fa-hand-holding-dollar"></i>
                </div>
            </div>

            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Total Outstanding Due</span>
                    <h3 class="text-2xl font-black text-rose-400 mt-1">৳ {{ number_format($totalDue, 2) }}</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-500/20 text-rose-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fas fa-hourglass-half"></i>
                </div>
            </div>

            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Active IPD Inpatients</span>
                    <h3 class="text-2xl font-black text-indigo-400 mt-1">{{ $ipdActiveCount }} Patients</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fas fa-bed-pulse"></i>
                </div>
            </div>

            <div class="p-5 bg-slate-900 rounded-2xl border border-slate-800 flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-extrabold text-slate-400 uppercase tracking-wider">Scheduled OT Surgeries</span>
                    <h3 class="text-2xl font-black text-teal-400 mt-1">{{ $otCount }} Bookings</h3>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-xl shrink-0">
                    <i class="fas fa-scissors"></i>
                </div>
            </div>
        </div>

        <!-- 4 Secondary Activity Stats -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-800 text-center">
                <span class="text-slate-400 text-[10px] uppercase font-bold block">Registered Patients</span>
                <strong class="text-white text-lg font-black mt-0.5 block">{{ $patientCount }}</strong>
            </div>
            <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-800 text-center">
                <span class="text-slate-400 text-[10px] uppercase font-bold block">E-Prescriptions Issued</span>
                <strong class="text-sky-400 text-lg font-black mt-0.5 block">{{ $prescriptionCount }}</strong>
            </div>
            <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-800 text-center">
                <span class="text-slate-400 text-[10px] uppercase font-bold block">Diagnostic Lab Reports</span>
                <strong class="text-purple-400 text-lg font-black mt-0.5 block">{{ $labReportCount }}</strong>
            </div>
            <div class="p-4 bg-slate-900/80 rounded-xl border border-slate-800 text-center">
                <span class="text-slate-400 text-[10px] uppercase font-bold block">Pharmacy Low Stock Alerts</span>
                <strong class="text-amber-400 text-lg font-black mt-0.5 block">{{ $lowStockCount }} Items</strong>
            </div>
        </div>

        <!-- Recent Transactions & Admissions Split View -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Recent Invoices -->
            <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-extrabold uppercase text-amber-400 flex items-center gap-2">
                        <i class="fas fa-receipt"></i> Recent Billing Transactions
                    </h3>
                    <a href="{{ route('admin.invoices.index') }}" class="text-[10px] text-slate-400 hover:text-white font-bold">View All &rarr;</a>
                </div>
                <div class="space-y-2">
                    @forelse($recentInvoices as $inv)
                    <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between text-xs">
                        <div>
                            <strong class="text-white block">{{ $inv->patient->name ?? 'Walk-in Customer' }}</strong>
                            <span class="text-[10px] text-amber-400 font-mono">{{ $inv->invoice_no }} &bull; {{ $inv->created_at->format('M d, Y') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="text-emerald-400 font-black text-sm block">৳ {{ number_format($inv->paid_amount, 2) }}</span>
                            <span class="text-[9px] uppercase font-extrabold text-slate-400">{{ $inv->status }}</span>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-500 text-center py-4">No recent billing records.</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent IPD Admissions -->
            <div class="bg-slate-900 rounded-2xl p-5 border border-slate-800">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xs font-extrabold uppercase text-indigo-400 flex items-center gap-2">
                        <i class="fas fa-bed"></i> Active Inpatient Occupancy
                    </h3>
                    <a href="{{ route('admin.ipd-admissions.index') }}" class="text-[10px] text-slate-400 hover:text-white font-bold">View All &rarr;</a>
                </div>
                <div class="space-y-2">
                    @forelse($recentAdmissions as $adm)
                    <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between text-xs">
                        <div>
                            <strong class="text-white block">{{ $adm->patient->name ?? 'N/A' }}</strong>
                            <span class="text-[10px] text-indigo-400 font-mono">Room {{ $adm->cabin->room_number ?? 'N/A' }} &bull; Admitted: {{ $adm->admission_date->format('M d, Y') }}</span>
                        </div>
                        <div class="text-right">
                            <span class="px-2 py-0.5 bg-indigo-500/20 text-indigo-300 text-[10px] font-black rounded-full uppercase border border-indigo-500/30">
                                {{ $adm->status }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-500 text-center py-4">No active admissions.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

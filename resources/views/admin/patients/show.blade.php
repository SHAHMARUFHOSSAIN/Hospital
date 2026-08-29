@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Patient Profile Header Card -->
        <div class="bg-gradient-to-r from-slate-900 via-slate-950 to-slate-900 rounded-2xl p-6 mb-8 border border-slate-800 shadow-xl flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-2xl font-bold border border-teal-500/30 shrink-0">
                    <i class="fas fa-user-injured"></i>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <h1 class="text-xl font-extrabold text-white">{{ $patient->name }}</h1>
                        <span class="px-3 py-1 bg-sky-500/20 text-sky-300 text-xs font-extrabold rounded-full border border-sky-500/30">{{ $patient->patient_id }}</span>
                        @if($patient->blood_group)
                        <span class="px-2.5 py-0.5 bg-rose-500/20 text-rose-400 text-xs font-black rounded-md border border-rose-500/30">{{ $patient->blood_group }}</span>
                        @endif
                    </div>
                    <p class="text-slate-400 text-xs mt-1">
                        {{ $patient->age }} Yrs, {{ $patient->gender }} &bull; <i class="fas fa-phone text-sky-400 ml-1"></i> {{ $patient->phone }}
                        @if($patient->address) &bull; <i class="fas fa-location-dot text-amber-400 ml-1"></i> {{ $patient->address }} @endif
                    </p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('admin.prescriptions.create', ['patient_id' => $patient->id]) }}" class="px-4 py-2.5 bg-sky-500 text-white font-extrabold text-xs rounded-xl shadow hover:bg-sky-600 transition">
                    + Write E-Prescription (Rx)
                </a>
                <a href="{{ route('admin.invoices.create', ['patient_id' => $patient->id]) }}" class="px-4 py-2.5 bg-amber-500 text-white font-extrabold text-xs rounded-xl shadow hover:bg-amber-600 transition">
                    + Generate Bill
                </a>
                <a href="{{ route('admin.lab-reports.create', ['patient_id' => $patient->id]) }}" class="px-4 py-2.5 bg-purple-500 text-white font-extrabold text-xs rounded-xl shadow hover:bg-purple-600 transition">
                    + Add Lab Report
                </a>
            </div>
        </div>

        <!-- Patient Medical Timeline Tabs & Vault -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left 2 Cols: Medical History & Prescriptions -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Prescriptions History -->
                <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
                    <h3 class="text-sm font-extrabold text-white mb-4 flex items-center justify-between">
                        <span><i class="fas fa-file-prescription text-sky-400 mr-2"></i> E-Prescriptions History ({{ $patient->prescriptions->count() }})</span>
                        <a href="{{ route('admin.prescriptions.create', ['patient_id' => $patient->id]) }}" class="text-xs text-[#0284C7] hover:underline">+ New Rx</a>
                    </h3>
                    <div class="space-y-3">
                        @forelse($patient->prescriptions as $rx)
                        <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-sky-400">{{ $rx->prescription_no }}</span>
                                <p class="text-white font-bold text-xs mt-0.5">Dr. {{ $rx->doctor->name ?? 'General OPD' }}</p>
                                <p class="text-slate-400 text-[11px]">Diagnosis: {{ $rx->diagnosis ?: 'General Checkup' }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500 text-[10px] mr-2">{{ $rx->created_at->format('M d, Y') }}</span>
                                <a href="{{ route('admin.prescriptions.show', $rx) }}" class="px-3 py-1.5 bg-slate-800 text-slate-200 text-xs font-bold rounded-lg hover:bg-slate-700">View</a>
                                <a href="{{ route('admin.prescriptions.print', $rx) }}" target="_blank" class="px-3 py-1.5 bg-[#0284C7] text-white text-xs font-bold rounded-lg hover:bg-sky-600">Print Rx</a>
                            </div>
                        </div>
                        @empty
                        <p class="text-slate-500 text-xs italic py-4 text-center">No prescriptions issued for this patient yet.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Diagnostic Lab Reports -->
                <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
                    <h3 class="text-sm font-extrabold text-white mb-4 flex items-center justify-between">
                        <span><i class="fas fa-vial text-purple-400 mr-2"></i> Diagnostic Lab Test Reports ({{ $patient->labReports->count() }})</span>
                        <a href="{{ route('admin.lab-reports.create', ['patient_id' => $patient->id]) }}" class="text-xs text-purple-400 hover:underline">+ Add Report</a>
                    </h3>
                    <div class="space-y-3">
                        @forelse($patient->labReports as $lab)
                        <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-purple-400">{{ $lab->report_no }}</span>
                                <p class="text-white font-bold text-xs mt-0.5">{{ $lab->test_name }}</p>
                                <span class="text-[10px] text-emerald-400 font-bold uppercase">{{ $lab->status }}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-slate-500 text-[10px] mr-2">{{ $lab->report_date->format('M d, Y') }}</span>
                                <a href="{{ route('admin.lab-reports.print', $lab) }}" target="_blank" class="px-3 py-1.5 bg-purple-600 text-white text-xs font-bold rounded-lg hover:bg-purple-500">Print Report</a>
                            </div>
                        </div>
                        @empty
                        <p class="text-slate-500 text-xs italic py-4 text-center">No lab test reports uploaded for this patient yet.</p>
                        @endforelse
                    </div>
                </div>

            </div>

            <!-- Right 1 Col: Billing History & Invoices -->
            <div class="space-y-6">
                <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
                    <h3 class="text-sm font-extrabold text-white mb-4 flex items-center justify-between">
                        <span><i class="fas fa-receipt text-amber-400 mr-2"></i> Invoices &amp; Billing ({{ $patient->invoices->count() }})</span>
                        <a href="{{ route('admin.invoices.create', ['patient_id' => $patient->id]) }}" class="text-xs text-amber-400 hover:underline">+ Create Bill</a>
                    </h3>
                    <div class="space-y-3">
                        @forelse($patient->invoices as $inv)
                        <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 flex items-center justify-between">
                            <div>
                                <span class="text-xs font-bold text-amber-400">{{ $inv->invoice_no }}</span>
                                <p class="text-white font-extrabold text-xs mt-0.5">৳ {{ number_format($inv->total_amount, 2) }}</p>
                                <span class="px-2 py-0.5 text-[9px] font-black rounded uppercase 
                                    @if($inv->status === 'paid') bg-emerald-500/20 text-emerald-300
                                    @else bg-rose-500/20 text-rose-300 @endif">
                                    {{ $inv->status }}
                                </span>
                            </div>
                            <a href="{{ route('admin.invoices.print', $inv) }}" target="_blank" class="px-3 py-1.5 bg-amber-500 text-white text-xs font-bold rounded-lg hover:bg-amber-600">Print Receipt</a>
                        </div>
                        @empty
                        <p class="text-slate-500 text-xs italic py-4 text-center">No billing invoices issued yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

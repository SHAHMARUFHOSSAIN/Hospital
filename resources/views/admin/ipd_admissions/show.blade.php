@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-bed-pulse text-indigo-400"></i> IPD Admission Record — {{ $ipdAdmission->admission_no }}
            </h1>
            <a href="{{ route('admin.ipd-admissions.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Admissions</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800 space-y-6">
            <!-- Patient Info -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-800">
                <div>
                    <span class="text-[10px] text-slate-500 uppercase font-extrabold tracking-wider">Admitted Patient</span>
                    <h2 class="text-lg font-bold text-white mt-0.5">{{ $ipdAdmission->patient->name ?? 'N/A' }}</h2>
                    <p class="text-xs text-slate-400">UHID: <span class="text-sky-400 font-bold">{{ $ipdAdmission->patient->patient_id ?? 'N/A' }}</span> &bull; Age/Gender: {{ $ipdAdmission->patient->age ?? 'N/A' }} Yrs / {{ $ipdAdmission->patient->gender ?? 'N/A' }}</p>
                </div>
                <div class="text-left sm:text-right">
                    <span class="px-3 py-1 text-xs font-black rounded-full uppercase
                        @if($ipdAdmission->status === 'admitted') bg-indigo-500/20 text-indigo-300 border border-indigo-500/30
                        @else bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 @endif">
                        {{ $ipdAdmission->status }}
                    </span>
                    <p class="text-xs text-slate-400 mt-2">Room: <span class="text-white font-bold">{{ $ipdAdmission->cabin->room_number ?? 'N/A' }} ({{ $ipdAdmission->cabin->type ?? '' }})</span></p>
                    <p class="text-xs text-slate-400">Daily Rent: <span class="text-emerald-400 font-bold">৳ {{ number_format($ipdAdmission->daily_rent, 2) }}</span></p>
                </div>
            </div>

            <!-- Details Box -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-xs">
                <div>
                    <span class="text-slate-400 font-bold block mb-1">Attending Doctor:</span>
                    <p class="text-white font-extrabold">Dr. {{ $ipdAdmission->doctor->name ?? 'General Duty Doctor' }}</p>
                </div>
                <div>
                    <span class="text-slate-400 font-bold block mb-1">Admission Date:</span>
                    <p class="text-white font-extrabold">{{ $ipdAdmission->admission_date->format('M d, Y - h:i A') }}</p>
                </div>
            </div>

            @if($ipdAdmission->notes)
            <div>
                <span class="text-xs font-extrabold uppercase text-slate-400 block mb-1">Admission Notes &amp; Symptoms</span>
                <p class="text-xs text-slate-200 bg-slate-950 p-4 rounded-xl border border-slate-800 whitespace-pre-line">{{ $ipdAdmission->notes }}</p>
            </div>
            @endif

            <!-- Discharge Summary Box (If Discharged) -->
            @if($ipdAdmission->status === 'discharged')
            <div class="p-5 bg-emerald-500/10 border border-emerald-500/30 rounded-2xl space-y-3">
                <h4 class="text-xs font-extrabold uppercase text-emerald-400 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i> Official Discharge Summary
                </h4>
                <p class="text-xs text-slate-200 whitespace-pre-line">{{ $ipdAdmission->discharge_summary }}</p>
                <div class="pt-3 border-t border-emerald-500/20 text-xs font-bold text-slate-300 flex justify-between">
                    <span>Discharge Date: {{ $ipdAdmission->discharge_date ? $ipdAdmission->discharge_date->format('M d, Y') : 'N/A' }}</span>
                    <span>Total Cabin Rent: <strong class="text-emerald-400">৳ {{ number_format($ipdAdmission->total_bill_amount, 2) }}</strong></span>
                </div>
            </div>
            @else
            <!-- Discharge Form (If currently admitted) -->
            <div class="pt-6 border-t border-slate-800">
                <h3 class="text-xs font-extrabold uppercase text-rose-400 mb-3 flex items-center gap-2">
                    <i class="fas fa-right-from-bracket"></i> Patient Discharge Action
                </h3>
                <form method="POST" action="{{ route('admin.ipd-admissions.discharge', $ipdAdmission) }}" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Discharge Date *</label>
                            <input type="date" name="discharge_date" value="{{ date('Y-m-d') }}" required
                                class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-2.5 outline-none focus:border-rose-500">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-300 mb-1">Calculated Total Rent Bill (৳) *</label>
                            @php
                                $days = max(1, now()->diffInDays($ipdAdmission->admission_date));
                                $totalBill = $days * $ipdAdmission->daily_rent;
                            @endphp
                            <input type="number" step="0.01" name="total_bill_amount" value="{{ $totalBill }}" required min="0"
                                class="w-full bg-slate-950 border border-slate-800 text-emerald-400 font-extrabold text-xs rounded-xl px-4 py-2.5 outline-none focus:border-rose-500">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-1">Discharge Summary &amp; Treatment Advice *</label>
                        <textarea name="discharge_summary" rows="3" required placeholder="State condition at discharge, medications, and follow-up advice..."
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-2.5 outline-none focus:border-rose-500"></textarea>
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">
                        Discharge Patient &amp; Release Cabin
                    </button>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

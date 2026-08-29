@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-file-prescription text-sky-400"></i> Prescription Details — {{ $prescription->prescription_no }}
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.prescriptions.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back</a>
                <a href="{{ route('admin.prescriptions.print', $prescription) }}" target="_blank" class="px-4 py-2 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                    <i class="fas fa-print mr-1"></i> Print Rx Sheet
                </a>
            </div>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800 space-y-6">
            <!-- Patient & Doctor Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-slate-800">
                <div>
                    <span class="text-[10px] text-slate-500 uppercase font-extrabold tracking-wider">Patient Info</span>
                    <h2 class="text-lg font-bold text-white mt-1">{{ $prescription->patient->name ?? 'N/A' }}</h2>
                    <p class="text-xs text-slate-400 mt-0.5">UHID: <span class="text-sky-400 font-bold">{{ $prescription->patient->patient_id ?? 'N/A' }}</span> &bull; Age: {{ $prescription->patient->age ?? 'N/A' }} Yrs &bull; Gender: {{ $prescription->patient->gender ?? 'N/A' }}</p>
                    <p class="text-xs text-slate-400">Phone: {{ $prescription->patient->phone ?? 'N/A' }}</p>
                </div>
                <div>
                    <span class="text-[10px] text-slate-500 uppercase font-extrabold tracking-wider">Attending Doctor</span>
                    <h2 class="text-lg font-bold text-white mt-1">Dr. {{ $prescription->doctor->name ?? 'General OPD Doctor' }}</h2>
                    <p class="text-xs text-sky-400 font-semibold">{{ $prescription->doctor->designation ?? 'Medical Officer' }}</p>
                    <p class="text-xs text-slate-400">Date: {{ $prescription->created_at->format('M d, Y - h:i A') }}</p>
                </div>
            </div>

            <!-- Vitals Bar -->
            @if($prescription->vitals_bp || $prescription->vitals_pulse || $prescription->vitals_weight || $prescription->vitals_temp)
            <div class="p-4 bg-slate-950 rounded-xl border border-slate-800 flex flex-wrap items-center justify-around gap-4 text-xs">
                @if($prescription->vitals_bp)<div><span class="text-slate-500">BP:</span> <span class="text-white font-bold">{{ $prescription->vitals_bp }}</span></div>@endif
                @if($prescription->vitals_pulse)<div><span class="text-slate-500">Pulse:</span> <span class="text-white font-bold">{{ $prescription->vitals_pulse }}</span></div>@endif
                @if($prescription->vitals_weight)<div><span class="text-slate-500">Weight:</span> <span class="text-white font-bold">{{ $prescription->vitals_weight }}</span></div>@endif
                @if($prescription->vitals_temp)<div><span class="text-slate-500">Temp:</span> <span class="text-white font-bold">{{ $prescription->vitals_temp }}</span></div>@endif
            </div>
            @endif

            <!-- Symptoms & Diagnosis -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if($prescription->chief_complaints)
                <div>
                    <h4 class="text-xs font-extrabold text-slate-400 uppercase mb-1">Chief Complaints</h4>
                    <p class="text-xs text-slate-200 bg-slate-950 p-3 rounded-xl border border-slate-800 whitespace-pre-line">{{ $prescription->chief_complaints }}</p>
                </div>
                @endif
                @if($prescription->diagnosis)
                <div>
                    <h4 class="text-xs font-extrabold text-slate-400 uppercase mb-1">Diagnosis</h4>
                    <p class="text-xs text-slate-200 bg-slate-950 p-3 rounded-xl border border-slate-800 whitespace-pre-line">{{ $prescription->diagnosis }}</p>
                </div>
                @endif
            </div>

            <!-- Prescribed Medicines -->
            <div>
                <h4 class="text-xs font-extrabold text-sky-400 uppercase mb-3"><i class="fas fa-pills mr-1"></i> Prescribed Medicines (Rx)</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs">
                        <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                            <tr>
                                <th class="px-4 py-2.5 text-left">Medicine Name</th>
                                <th class="px-4 py-2.5 text-left">Dose</th>
                                <th class="px-4 py-2.5 text-left">Timing</th>
                                <th class="px-4 py-2.5 text-left">Duration</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 font-medium">
                            @forelse($prescription->medicines ?? [] as $med)
                            <tr>
                                <td class="px-4 py-3 text-white font-bold">{{ $med['name'] ?? '' }}</td>
                                <td class="px-4 py-3 text-sky-400 font-extrabold">{{ $med['dosage'] ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-slate-300">{{ $med['timing'] ?? 'N/A' }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $med['duration'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-slate-500">No medicines prescribed.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Advised Tests & Advice -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-800">
                @if($prescription->advised_tests)
                <div>
                    <h4 class="text-xs font-extrabold text-amber-400 uppercase mb-1">Advised Tests</h4>
                    <p class="text-xs text-slate-200 bg-slate-950 p-3 rounded-xl border border-slate-800 whitespace-pre-line">{{ $prescription->advised_tests }}</p>
                </div>
                @endif
                @if($prescription->general_advice)
                <div>
                    <h4 class="text-xs font-extrabold text-emerald-400 uppercase mb-1">General Advice</h4>
                    <p class="text-xs text-slate-200 bg-slate-950 p-3 rounded-xl border border-slate-800 whitespace-pre-line">{{ $prescription->general_advice }}</p>
                </div>
                @endif
            </div>

            @if($prescription->follow_up_date)
            <div class="p-3 bg-sky-500/10 border border-sky-500/30 rounded-xl text-sky-300 text-xs font-bold text-center">
                Follow-up Visit Date: {{ $prescription->follow_up_date->format('M d, Y') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

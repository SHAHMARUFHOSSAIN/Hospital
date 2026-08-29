@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-microscope text-purple-400"></i> Lab Report Details — {{ $labReport->report_no }}
            </h1>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.lab-reports.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back</a>
                <a href="{{ route('admin.lab-reports.print', $labReport) }}" target="_blank" class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                    <i class="fas fa-print mr-1"></i> Print Diagnostic Report
                </a>
            </div>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800 space-y-6">
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-800">
                <div>
                    <span class="text-[10px] text-slate-500 uppercase font-extrabold tracking-wider">Patient Details</span>
                    <h2 class="text-lg font-bold text-white mt-0.5">{{ $labReport->patient->name ?? 'N/A' }}</h2>
                    <p class="text-xs text-slate-400">UHID: <span class="text-sky-400 font-bold">{{ $labReport->patient->patient_id ?? 'N/A' }}</span> &bull; Age/Gender: {{ $labReport->patient->age ?? 'N/A' }} Yrs / {{ $labReport->patient->gender ?? 'N/A' }}</p>
                </div>
                <div class="text-left sm:text-right">
                    <span class="px-3 py-1 bg-emerald-500/20 text-emerald-300 text-xs font-black rounded-full uppercase border border-emerald-500/30">
                        {{ $labReport->status }}
                    </span>
                    <p class="text-xs text-slate-400 mt-2">Test Name: <span class="text-white font-bold">{{ $labReport->test_name }}</span></p>
                    <p class="text-xs text-slate-400">Report Date: {{ $labReport->report_date->format('M d, Y') }}</p>
                </div>
            </div>

            <div>
                <h4 class="text-xs font-extrabold text-purple-400 uppercase mb-3">Diagnostic Test Findings</h4>
                <div class="overflow-x-auto">
                    <table class="min-w-full text-xs">
                        <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                            <tr>
                                <th class="px-4 py-2.5 text-left">Parameter</th>
                                <th class="px-4 py-2.5 text-left">Observed Value</th>
                                <th class="px-4 py-2.5 text-left">Unit</th>
                                <th class="px-4 py-2.5 text-left">Standard Reference Range</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-800 font-medium">
                            @forelse($labReport->parameters ?? [] as $p)
                            <tr>
                                <td class="px-4 py-3 text-white font-bold">{{ $p['parameter'] ?? '' }}</td>
                                <td class="px-4 py-3 text-purple-300 font-extrabold">{{ $p['value'] ?? '' }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $p['unit'] ?? '' }}</td>
                                <td class="px-4 py-3 text-slate-400">{{ $p['reference_range'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-4 text-center text-slate-500">No parameters recorded.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($labReport->impression)
            <div class="pt-4 border-t border-slate-800">
                <h4 class="text-xs font-extrabold text-slate-400 uppercase mb-1">Impression &amp; Comments</h4>
                <p class="text-xs text-slate-200 bg-slate-950 p-4 rounded-xl border border-slate-800 whitespace-pre-line">{{ $labReport->impression }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

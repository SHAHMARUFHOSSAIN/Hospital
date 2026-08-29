@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-microscope text-purple-400"></i> Diagnostic Lab Test Reports
                </h1>
                <p class="text-slate-400 text-xs mt-1">Generate pathology, radiology, and blood test reports with reference ranges.</p>
            </div>
            <a href="{{ route('admin.lab-reports.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Create New Lab Report
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">Report No</th>
                            <th class="px-6 py-3.5 text-left">Patient Details</th>
                            <th class="px-6 py-3.5 text-left">Test Name</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-left">Report Date</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($labReports as $report)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-purple-500/20 text-purple-300 font-extrabold rounded-lg border border-purple-500/30 text-[11px]">
                                    {{ $report->report_no }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $report->patient->name ?? 'N/A' }} <br>
                                <span class="text-sky-400 text-[10px]">{{ $report->patient->patient_id ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-white font-extrabold">{{ $report->test_name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $report->report_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.lab-reports.show', $report) }}" class="px-3 py-1.5 bg-slate-800 text-slate-200 font-bold rounded-lg hover:bg-slate-700">View</a>
                                <a href="{{ route('admin.lab-reports.print', $report) }}" target="_blank" class="px-3 py-1.5 bg-purple-600 text-white font-bold rounded-lg hover:bg-purple-500">
                                    <i class="fas fa-print mr-1"></i> Print Report
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No lab test reports generated yet. Click "+ Create New Lab Report" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($labReports->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $labReports->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

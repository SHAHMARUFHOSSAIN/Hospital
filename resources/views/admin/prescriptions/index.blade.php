@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-file-prescription text-sky-400"></i> Doctor E-Prescription (Rx) Management
                </h1>
                <p class="text-slate-400 text-xs mt-1">Create digital prescriptions, add dosage instructions, and generate printable Rx sheets.</p>
            </div>
            <a href="{{ route('admin.prescriptions.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Write New E-Prescription (Rx)
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
                            <th class="px-6 py-3.5 text-left">Rx No</th>
                            <th class="px-6 py-3.5 text-left">Patient Details</th>
                            <th class="px-6 py-3.5 text-left">Doctor</th>
                            <th class="px-6 py-3.5 text-left">Diagnosis / Complaints</th>
                            <th class="px-6 py-3.5 text-left">Date</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($prescriptions as $rx)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-sky-500/20 text-sky-300 font-extrabold rounded-lg border border-sky-500/30 text-[11px]">
                                    {{ $rx->prescription_no }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $rx->patient->name ?? 'N/A' }} <br>
                                <span class="text-sky-400 text-[10px]">{{ $rx->patient->patient_id ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300 font-semibold">Dr. {{ $rx->doctor->name ?? 'General OPD' }}</td>
                            <td class="px-6 py-4 text-slate-300 max-w-xs truncate">{{ $rx->diagnosis ?: ($rx->chief_complaints ?: 'N/A') }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $rx->created_at->format('M d, Y') }}</td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.prescriptions.show', $rx) }}" class="px-3 py-1.5 bg-slate-800 text-slate-200 font-bold rounded-lg hover:bg-slate-700">View</a>
                                <a href="{{ route('admin.prescriptions.print', $rx) }}" target="_blank" class="px-3 py-1.5 bg-[#0284C7] text-white font-bold rounded-lg hover:bg-sky-600">
                                    <i class="fas fa-print mr-1"></i> Print Rx
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No prescriptions issued yet. Click "+ Write New E-Prescription (Rx)" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($prescriptions->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $prescriptions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

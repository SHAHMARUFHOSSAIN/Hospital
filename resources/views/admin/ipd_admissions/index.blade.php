@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-bed-pulse text-indigo-400"></i> IPD Inpatient Admission &amp; Cabin Tracker
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage indoor patient admissions, cabin occupancy grid, daily rent calculation, and discharge summaries.</p>
            </div>
            <a href="{{ route('admin.ipd-admissions.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Admit Patient to Cabin / Ward
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Live Cabin Occupancy Grid -->
        <div class="mb-8 bg-slate-900 rounded-2xl p-5 border border-slate-800">
            <h3 class="text-xs font-extrabold uppercase text-indigo-400 mb-3 flex items-center gap-2">
                <i class="fas fa-[#0284C7] fa-square-h"></i> Live Cabin &amp; Ward Occupancy Status
            </h3>
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($cabins as $cabin)
                <div class="p-3 rounded-xl border text-center transition
                    @if($cabin->status === 'booked') bg-rose-500/10 border-rose-500/30 text-rose-300
                    @elseif($cabin->status === 'maintenance') bg-amber-500/10 border-amber-500/30 text-amber-300
                    @else bg-emerald-500/10 border-emerald-500/30 text-emerald-300 @endif">
                    <span class="text-xs font-extrabold block">Room {{ $cabin->room_number }}</span>
                    <span class="text-[10px] block opacity-80 uppercase font-extrabold">{{ $cabin->type }}</span>
                    <span class="inline-block mt-1 px-2 py-0.5 text-[9px] font-black rounded-full uppercase
                        @if($cabin->status === 'booked') bg-rose-500/20 text-rose-300
                        @else bg-emerald-500/20 text-emerald-300 @endif">
                        {{ $cabin->status === 'booked' ? 'OCCUPIED' : 'VACANT' }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- IPD Admissions Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">Admission No</th>
                            <th class="px-6 py-3.5 text-left">Patient Details</th>
                            <th class="px-6 py-3.5 text-left">Cabin / Ward</th>
                            <th class="px-6 py-3.5 text-left">Attending Doctor</th>
                            <th class="px-6 py-3.5 text-left">Admission Date</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($admissions as $adm)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4 font-mono text-indigo-400 font-bold">{{ $adm->admission_no }}</td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $adm->patient->name ?? 'N/A' }} <br>
                                <span class="text-sky-400 text-[10px]">{{ $adm->patient->patient_id ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-200 font-bold">
                                Room {{ $adm->cabin->room_number ?? 'N/A' }} ({{ $adm->cabin->type ?? '' }})
                            </td>
                            <td class="px-6 py-4 text-slate-300">Dr. {{ $adm->doctor->name ?? 'General Duty Doctor' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $adm->admission_date->format('M d, Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase
                                    @if($adm->status === 'admitted') bg-indigo-500/20 text-indigo-300 border border-indigo-500/30
                                    @else bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 @endif">
                                    {{ $adm->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap">
                                <a href="{{ route('admin.ipd-admissions.show', $adm) }}" class="px-3 py-1.5 bg-indigo-600 text-white font-bold rounded-lg hover:bg-indigo-500 text-xs">
                                    Details &amp; Discharge
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No active IPD admissions. Click "+ Admit Patient to Cabin / Ward" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($admissions->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $admissions->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

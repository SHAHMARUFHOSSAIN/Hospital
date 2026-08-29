@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-scissors text-teal-400"></i> Operation Theatre (OT) &amp; Surgery Scheduler
                </h1>
                <p class="text-slate-400 text-xs mt-1">Book surgery suites, assign primary surgeons &amp; anesthetists, and track operation progress.</p>
            </div>
            <a href="{{ route('admin.ot-schedules.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Book New OT Surgery
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
                            <th class="px-6 py-3.5 text-left">OT Serial</th>
                            <th class="px-6 py-3.5 text-left">Patient Details</th>
                            <th class="px-6 py-3.5 text-left">Operation / Procedure</th>
                            <th class="px-6 py-3.5 text-left">Surgeon &amp; Anesthetist</th>
                            <th class="px-6 py-3.5 text-left">OT Room &amp; Schedule Time</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($schedules as $ot)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4 font-mono text-teal-400 font-bold">{{ $ot->ot_no }}</td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $ot->patient->name ?? 'N/A' }} <br>
                                <span class="text-sky-400 text-[10px]">{{ $ot->patient->patient_id ?? '' }}</span>
                            </td>
                            <td class="px-6 py-4 text-white font-extrabold">{{ $ot->operation_type }}</td>
                            <td class="px-6 py-4 text-slate-300">
                                Dr. {{ $ot->surgeon->name ?? 'Chief Surgeon' }} <br>
                                <span class="text-slate-500 text-[10px]">Anes: {{ $ot->anesthetist_name ?: 'N/A' }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-200">
                                <span class="font-bold text-teal-400">{{ $ot->ot_room }}</span> <br>
                                <span class="text-slate-400 text-[10px]">{{ $ot->scheduled_datetime->format('M d, Y - h:i A') }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase
                                    @if($ot->status === 'completed') bg-emerald-500/20 text-emerald-300 border border-emerald-500/30
                                    @elseif($ot->status === 'in_progress') bg-rose-500/20 text-rose-300 border border-rose-500/30 animate-pulse
                                    @else bg-sky-500/20 text-sky-300 border border-sky-500/30 @endif">
                                    {{ $ot->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.ot-schedules.destroy', $ot) }}" method="POST" class="inline" onsubmit="return confirm('Cancel OT Schedule?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:underline font-bold">Cancel</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No surgeries scheduled. Click "+ Book New OT Surgery" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($schedules->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $schedules->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

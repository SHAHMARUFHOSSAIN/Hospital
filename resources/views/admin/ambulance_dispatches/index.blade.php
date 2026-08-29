@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-truck-medical text-sky-400"></i> 24/7 Emergency Ambulance Dispatch Tracker
                </h1>
                <p class="text-slate-400 text-xs mt-1">Book emergency ambulance fleets, assign drivers, track pickup locations, and log fares.</p>
            </div>
            <a href="{{ route('admin.ambulance-dispatches.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Dispatch Ambulance Now
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
                            <th class="px-6 py-3.5 text-left">Dispatch No</th>
                            <th class="px-6 py-3.5 text-left">Patient / Caller</th>
                            <th class="px-6 py-3.5 text-left">Ambulance &amp; Driver</th>
                            <th class="px-6 py-3.5 text-left">Pickup &amp; Destination</th>
                            <th class="px-6 py-3.5 text-left">Fare Amount</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($dispatches as $dispatch)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4 font-mono text-sky-400 font-bold">{{ $dispatch->dispatch_no }}</td>
                            <td class="px-6 py-4 text-white font-bold">
                                {{ $dispatch->patient_name }} <br>
                                <span class="text-emerald-400 font-mono text-[10px]">{{ $dispatch->phone }}</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <strong class="text-white">{{ $dispatch->vehicle_no }}</strong> <br>
                                <span class="text-slate-400 text-[10px]">Driver: {{ $dispatch->driver_name }} ({{ $dispatch->driver_phone ?: 'N/A' }})</span>
                            </td>
                            <td class="px-6 py-4 text-slate-300">
                                <span class="text-amber-400">From: {{ $dispatch->pickup_location }}</span> <br>
                                <span class="text-slate-400 text-[10px]">To: {{ $dispatch->destination }}</span>
                            </td>
                            <td class="px-6 py-4 text-emerald-400 font-bold text-sm">৳ {{ number_format($dispatch->fare_amount, 2) }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase
                                    @if($dispatch->status === 'completed') bg-emerald-500/20 text-emerald-300 border border-emerald-500/30
                                    @elseif($dispatch->status === 'on_route') bg-amber-500/20 text-amber-300 border border-amber-500/30 animate-pulse
                                    @else bg-sky-500/20 text-sky-300 border border-sky-500/30 @endif">
                                    {{ $dispatch->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.ambulance-dispatches.destroy', $dispatch) }}" method="POST" class="inline" onsubmit="return confirm('Delete dispatch record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No ambulance dispatches logged. Click "+ Dispatch Ambulance Now" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($dispatches->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $dispatches->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Page Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-hospital-user text-teal-400"></i> Patient Management &amp; UHID Directory
                </h1>
                <p class="text-slate-400 text-xs mt-1">Register new patients, lookup Health IDs (UHID), and view medical timelines.</p>
            </div>
            <a href="{{ route('admin.patients.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Register New Patient
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Search Bar -->
        <div class="bg-slate-900 p-4 rounded-2xl border border-slate-800 mb-6">
            <form method="GET" action="{{ route('admin.patients.index') }}" class="flex gap-3">
                <input type="text" name="search" value="{{ request('search') }}" 
                    placeholder="Search patient by Name, Phone or UHID (e.g. PAT-2026-0001)..." 
                    class="flex-1 bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-[#0284C7]">
                <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs rounded-xl transition">
                    Search
                </button>
            </form>
        </div>

        <!-- Patients Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">UHID / Patient ID</th>
                            <th class="px-6 py-3.5 text-left">Patient Name</th>
                            <th class="px-6 py-3.5 text-left">Phone &amp; Email</th>
                            <th class="px-6 py-3.5 text-left">Age / Gender</th>
                            <th class="px-6 py-3.5 text-left">Blood Group</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($patients as $patient)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 bg-sky-500/20 text-sky-300 font-extrabold rounded-lg border border-sky-500/30 text-[11px]">
                                    {{ $patient->patient_id }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-bold text-sm">{{ $patient->name }}</td>
                            <td class="px-6 py-4 text-slate-300">
                                <span class="font-bold text-white">{{ $patient->phone }}</span>
                                @if($patient->email)<br><span class="text-slate-500 text-[10px]">{{ $patient->email }}</span>@endif
                            </td>
                            <td class="px-6 py-4 text-slate-300 font-semibold">{{ $patient->age }} Yrs / {{ $patient->gender }}</td>
                            <td class="px-6 py-4">
                                @if($patient->blood_group)
                                <span class="px-2 py-0.5 bg-rose-500/20 text-rose-400 font-black rounded-md border border-rose-500/30 text-[10px]">
                                    {{ $patient->blood_group }}
                                </span>
                                @else
                                <span class="text-slate-500">N/A</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.patients.show', $patient) }}" class="px-3 py-1.5 bg-teal-500/20 hover:bg-teal-500/30 text-teal-300 font-bold rounded-lg transition border border-teal-500/30">
                                    <i class="fas fa-folder-open mr-1"></i> Timeline
                                </a>
                                <a href="{{ route('admin.prescriptions.create', ['patient_id' => $patient->id]) }}" class="px-3 py-1.5 bg-sky-500/20 hover:bg-sky-500/30 text-sky-300 font-bold rounded-lg transition border border-sky-500/30">
                                    + Rx
                                </a>
                                <a href="{{ route('admin.invoices.create', ['patient_id' => $patient->id]) }}" class="px-3 py-1.5 bg-amber-500/20 hover:bg-amber-500/30 text-amber-300 font-bold rounded-lg transition border border-amber-500/30">
                                    + Bill
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No patient records found. Click "+ Register New Patient" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($patients->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $patients->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

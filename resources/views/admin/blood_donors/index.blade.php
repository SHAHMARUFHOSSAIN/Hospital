@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-hand-holding-droplet text-rose-400"></i> Volunteer Blood Donor Registry
                </h1>
                <p class="text-slate-400 text-xs mt-1">Directory of registered volunteer blood donors with blood group filters and eligibility tracking.</p>
            </div>
            <a href="{{ route('admin.blood-donors.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Register New Blood Donor
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <!-- Blood Group Filter Pills -->
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <a href="{{ route('admin.blood-donors.index') }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-extrabold transition border {{ !request('blood_group') ? 'bg-rose-600 text-white border-rose-600' : 'bg-slate-900 text-slate-400 border-slate-800 hover:text-white' }}">
                All Groups
            </a>
            @foreach(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-'] as $bg)
            <a href="{{ route('admin.blood-donors.index', ['blood_group' => $bg]) }}"
                class="px-3.5 py-1.5 rounded-xl text-xs font-extrabold transition border {{ request('blood_group') == $bg ? 'bg-rose-600 text-white border-rose-600' : 'bg-slate-900 text-rose-400 border-slate-800 hover:bg-slate-800' }}">
                {{ $bg }}
            </a>
            @endforeach
        </div>

        <!-- Donors Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">Blood Group</th>
                            <th class="px-6 py-3.5 text-left">Donor Name</th>
                            <th class="px-6 py-3.5 text-left">Contact Phone</th>
                            <th class="px-6 py-3.5 text-left">Age / Gender</th>
                            <th class="px-6 py-3.5 text-left">Last Donated Date</th>
                            <th class="px-6 py-3.5 text-left">Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($donors as $donor)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4">
                                <span class="w-9 h-9 bg-rose-500/20 text-rose-300 font-black text-xs rounded-xl flex items-center justify-center border border-rose-500/30">
                                    {{ $donor->blood_group }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-white font-bold text-sm">
                                {{ $donor->donor_name }} <br>
                                <span class="text-slate-400 text-[10px]">{{ $donor->address ?: 'Dhaka' }}</span>
                            </td>
                            <td class="px-6 py-4 text-emerald-400 font-bold font-mono">{{ $donor->phone }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $donor->age ?: 'N/A' }} Yrs / {{ $donor->gender ?: 'N/A' }}</td>
                            <td class="px-6 py-4 text-slate-400">{{ $donor->last_donated_date ? $donor->last_donated_date->format('M d, Y') : 'Never / First Time' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase
                                    {{ $donor->is_eligible ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-300 border border-rose-500/30' }}">
                                    {{ $donor->is_eligible ? 'ELIGIBLE' : 'NOT ELIGIBLE' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form action="{{ route('admin.blood-donors.destroy', $donor) }}" method="POST" class="inline" onsubmit="return confirm('Remove donor record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:underline font-bold">Remove</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No volunteer blood donors found. Click "+ Register New Blood Donor" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($donors->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $donors->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

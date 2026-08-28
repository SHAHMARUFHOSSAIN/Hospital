@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-bed-pulse text-indigo-400"></i> Hospital Cabins &amp; Ward Rent Rates
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage inpatient cabins, VIP suites, room amenities &amp; daily rent rates.</p>
            </div>
            <a href="{{ route('admin.cabins.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-bold text-xs rounded-xl transition shadow">
                + Add New Cabin / Ward
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <table class="min-w-full text-xs">
                <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                    <tr>
                        <th class="px-6 py-3.5 text-left">Cabin Name</th>
                        <th class="px-6 py-3.5 text-left">Room Type</th>
                        <th class="px-6 py-3.5 text-left">Daily Rent Rate</th>
                        <th class="px-6 py-3.5 text-left">Amenities</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($cabins as $cabin)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4 text-white font-bold">{{ $cabin->name }}</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-sky-500/20 text-sky-300 border border-sky-500/30 rounded-full font-bold text-[10px]">{{ $cabin->room_type }}</span></td>
                        <td class="px-6 py-4 text-emerald-400 font-extrabold">৳ {{ number_format($cabin->rent_per_day, 2) }} / day</td>
                        <td class="px-6 py-4 text-slate-400 max-w-xs truncate">{{ $cabin->amenities }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('cabins.show', $cabin->id) }}" target="_blank" class="text-slate-400 hover:text-white font-bold mr-2">Preview Page</a>
                            <a href="{{ route('admin.cabins.edit', $cabin) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.cabins.destroy', $cabin) }}" method="POST" class="inline" onsubmit="return confirm('Delete cabin?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No cabins added yet. Click "+ Add New Cabin" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

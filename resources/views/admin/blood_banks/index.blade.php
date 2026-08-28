@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-droplet text-rose-500"></i> Emergency Blood Bank Stocks
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage real-time available blood units and emergency hotline contact numbers.</p>
            </div>
            <a href="{{ route('admin.blood-banks.create') }}" class="px-5 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Add Blood Group Stock
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
                        <th class="px-6 py-3.5 text-left">Blood Group</th>
                        <th class="px-6 py-3.5 text-left">Available Units</th>
                        <th class="px-6 py-3.5 text-left">Emergency Hotline</th>
                        <th class="px-6 py-3.5 text-left">Last Updated</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($bloodStocks as $stock)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <span class="px-3 py-1.5 bg-rose-500/20 text-rose-400 border border-rose-500/30 rounded-xl font-extrabold text-base">
                                {{ $stock->blood_group }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-white font-extrabold text-sm">{{ $stock->units_available }} Bags</span>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold">{{ $stock->contact_number }}</td>
                        <td class="px-6 py-4 text-slate-400 font-semibold">{{ $stock->last_updated ?: 'Just Now' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] rounded-full font-bold {{ $stock->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $stock->is_active ? 'Available' : 'Out of Stock' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.blood-banks.edit', $stock) }}" class="text-sky-400 hover:underline font-bold">Edit Stock</a>
                            <form action="{{ route('admin.blood-banks.destroy', $stock) }}" method="POST" class="inline" onsubmit="return confirm('Delete this blood group entry?')">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No blood bank stocks added yet. Click "+ Add Blood Group Stock" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

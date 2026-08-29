@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                <h1 class="text-xl sm:text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-boxes-stacked text-cyan-400"></i> Pharmacy &amp; Hospital Stock Inventory
                </h1>
                <p class="text-slate-400 text-xs mt-1">Track medicine stock, surgical supplies, reorder limits, and expiry dates.</p>
            </div>
            <a href="{{ route('admin.inventories.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white font-extrabold text-xs rounded-xl shadow transition shrink-0 self-start sm:self-auto">
                + Add New Stock Item
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        @if($lowStockCount > 0)
        <div class="mb-6 p-4 bg-amber-500/20 border border-amber-500/40 text-amber-300 rounded-xl text-xs font-bold flex items-center gap-2">
            <i class="fas fa-triangle-exclamation text-amber-400 text-base"></i>
            <span>Warning: {{ $lowStockCount }} item(s) are currently below their minimum reorder level and need restocking!</span>
        </div>
        @endif

        <!-- Category Navigation Bar -->
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <a href="{{ route('admin.inventories.index') }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ !request('category') ? 'bg-cyan-600 text-white border-cyan-600' : 'bg-slate-900 text-slate-400 border-slate-800 hover:text-white' }}">
                All Items
            </a>
            <a href="{{ route('admin.inventories.index', ['category' => 'medicine']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('category') == 'medicine' ? 'bg-sky-500 text-white border-sky-500' : 'bg-slate-900 text-sky-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-pills mr-1"></i> Medicines
            </a>
            <a href="{{ route('admin.inventories.index', ['category' => 'surgical']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('category') == 'surgical' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-slate-900 text-emerald-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-scissors mr-1"></i> Surgical Supplies
            </a>
            <a href="{{ route('admin.inventories.index', ['category' => 'equipment']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('category') == 'equipment' ? 'bg-indigo-500 text-white border-indigo-500' : 'bg-slate-900 text-indigo-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-microscope mr-1"></i> Hospital Equipment
            </a>
        </div>

        <!-- Inventory Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3.5 text-left">Code</th>
                            <th class="px-6 py-3.5 text-left">Item Name</th>
                            <th class="px-6 py-3.5 text-left">Category</th>
                            <th class="px-6 py-3.5 text-left">Current Stock</th>
                            <th class="px-6 py-3.5 text-left">Unit Price</th>
                            <th class="px-6 py-3.5 text-left">Expiry Date</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse($inventories as $item)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4 font-mono text-slate-400">{{ $item->item_code }}</td>
                            <td class="px-6 py-4 text-white font-bold text-sm">{{ $item->item_name }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full uppercase bg-slate-800 text-slate-300 border border-slate-700">
                                    {{ $item->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-white font-extrabold text-sm">{{ $item->quantity }}</span>
                                @if($item->isLowStock())
                                <span class="ml-2 px-2 py-0.5 bg-rose-500/20 text-rose-300 text-[10px] font-extrabold rounded-md border border-rose-500/30">LOW STOCK</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-emerald-400 font-bold">৳ {{ number_format($item->unit_price, 2) }}</td>
                            <td class="px-6 py-4 text-slate-400">
                                @if($item->expiry_date)
                                {{ $item->expiry_date->format('M d, Y') }}
                                @else
                                N/A
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.inventories.edit', $item) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                                <form action="{{ route('admin.inventories.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete stock item?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No stock items found in inventory. Click "+ Add New Stock Item" above.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($inventories->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $inventories->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

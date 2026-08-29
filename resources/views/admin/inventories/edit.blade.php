@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-edit text-cyan-400"></i> Edit Stock Item — {{ $inventory->item_code }}
            </h1>
            <a href="{{ route('admin.inventories.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Inventory</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.inventories.update', $inventory) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Item Code</label>
                        <input type="text" value="{{ $inventory->item_code }}" readonly disabled
                            class="w-full bg-slate-950 border border-slate-800 text-slate-500 font-extrabold text-xs rounded-xl px-4 py-3 cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Item / Medicine Name *</label>
                        <input type="text" name="item_name" value="{{ old('item_name', $inventory->item_name) }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Category *</label>
                        <select name="category" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                            <option value="medicine" {{ $inventory->category == 'medicine' ? 'selected' : '' }}>Medicine / Pharmaceutical</option>
                            <option value="surgical" {{ $inventory->category == 'surgical' ? 'selected' : '' }}>Surgical Supply</option>
                            <option value="equipment" {{ $inventory->category == 'equipment' ? 'selected' : '' }}>Medical Machinery &amp; Equipment</option>
                            <option value="general_supply" {{ $inventory->category == 'general_supply' ? 'selected' : '' }}>General Hospital Supply</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Current Quantity in Stock *</label>
                        <input type="number" name="quantity" value="{{ old('quantity', $inventory->quantity) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Minimum Reorder Alert Level *</label>
                        <input type="number" name="reorder_level" value="{{ old('reorder_level', $inventory->reorder_level) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Unit Price (৳) *</label>
                        <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', $inventory->unit_price) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Supplier / Company Name</label>
                        <input type="text" name="supplier" value="{{ old('supplier', $inventory->supplier) }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Expiry Date (Optional)</label>
                        <input type="date" name="expiry_date" value="{{ old('expiry_date', $inventory->expiry_date ? $inventory->expiry_date->format('Y-m-d') : '') }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Notes &amp; Description</label>
                    <textarea name="notes" rows="3"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">{{ old('notes', $inventory->notes) }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.inventories.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Update Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

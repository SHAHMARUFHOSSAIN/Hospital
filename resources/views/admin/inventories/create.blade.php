@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-box-archive text-cyan-400"></i> Add Stock Item to Inventory
            </h1>
            <a href="{{ route('admin.inventories.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Inventory</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.inventories.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Item Code</label>
                        <input type="text" name="item_code" value="{{ old('item_code', $itemCode) }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-cyan-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Item / Medicine Name *</label>
                        <input type="text" name="item_name" value="{{ old('item_name') }}" required placeholder="e.g. Injection Ceftriaxone 1g"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Category *</label>
                        <select name="category" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                            <option value="medicine">Medicine / Pharmaceutical</option>
                            <option value="surgical">Surgical Supply</option>
                            <option value="equipment">Medical Machinery &amp; Equipment</option>
                            <option value="general_supply">General Hospital Supply</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Initial Quantity in Stock *</label>
                        <input type="number" name="quantity" value="{{ old('quantity', 100) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Minimum Reorder Alert Level *</label>
                        <input type="number" name="reorder_level" value="{{ old('reorder_level', 15) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Unit Price (৳) *</label>
                        <input type="number" step="0.01" name="unit_price" value="{{ old('unit_price', 150.00) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Supplier / Company Name</label>
                        <input type="text" name="supplier" value="{{ old('supplier') }}" placeholder="e.g. Square Pharmaceuticals Ltd."
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Expiry Date (Optional)</label>
                        <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Notes &amp; Description</label>
                    <textarea name="notes" rows="3" placeholder="Storage instructions e.g. Keep below 25°C in dry place"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-cyan-500">{{ old('notes') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.inventories.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-cyan-600 hover:bg-cyan-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Save Stock Item</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

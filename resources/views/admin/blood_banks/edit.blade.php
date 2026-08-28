@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-3xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Blood Group Stock: {{ $stock->blood_group }}</h1>
            <a href="{{ route('admin.blood-banks.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Blood Bank</a>
        </div>

        <form action="{{ route('admin.blood-banks.update', $stock) }}" method="POST" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Blood Group *</label>
                    <input type="text" name="blood_group" required value="{{ $stock->blood_group }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Available Units (Bags) *</label>
                    <input type="number" name="units_available" required value="{{ $stock->units_available }}" min="0" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Emergency Hotline Contact Number</label>
                <input type="text" name="contact_number" value="{{ $stock->contact_number }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $stock->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active &amp; Ready for Emergency Dispatch</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Blood Stock</button>
        </form>
    </div>
</div>
@endsection

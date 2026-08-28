@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Add Clinical Specialty &amp; Highlight</h1>
            <a href="{{ route('admin.button-types.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Specialties</a>
        </div>

        <form action="{{ route('admin.button-types.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Specialty / Highlight Name *</label>
                <input type="text" name="name" required value="{{ old('name') }}"
                    placeholder="e.g. 24/7 Level-1 Trauma &amp; Emergency Center"
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Clinical Specialty Category *</label>
                <select name="variant" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                    @foreach(\App\Models\ButtonType::variants() as $key => $label)
                        <option value="{{ $key }}" {{ old('variant') === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <p class="text-[11px] text-slate-500 font-semibold mt-1">Select the primary clinical classification for this hospital highlight.</p>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Feature Image (Optional)</label>
                <input type="file" name="image" accept="image/*" class="text-xs text-slate-400">
                <p class="text-[11px] text-slate-500 font-semibold mt-1">Upload a high-resolution photo showcasing this medical facility or equipment.</p>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Specialty Overview &amp; Clinical Description</label>
                <textarea name="description" rows="4"
                    placeholder="Enter detailed information about 24/7 availability, specialist consultant team, and medical equipment..."
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ old('description') }}</textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Hospital Highlights Showcase</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Save Clinical Specialty Profile</button>
        </form>
    </div>
</div>
@endsection

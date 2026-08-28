@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Clinical Specialty: {{ $buttonType->name }}</h1>
            <a href="{{ route('admin.button-types.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Specialties</a>
        </div>

        <form action="{{ route('admin.button-types.update', $buttonType) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Specialty / Highlight Name *</label>
                <input type="text" name="name" required value="{{ old('name', $buttonType->name) }}"
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Clinical Specialty Category *</label>
                <select name="variant" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                    @foreach(\App\Models\ButtonType::variants() as $key => $label)
                        <option value="{{ $key }}" {{ old('variant', $buttonType->variant) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Feature Image</label>
                <input type="file" name="image" accept="image/*" class="text-xs text-slate-400 mb-3">
                <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center gap-4">
                    <img src="{{ $buttonType->image_url }}" alt="{{ $buttonType->name }}" class="w-16 h-16 rounded-lg object-cover border border-slate-700 shrink-0">
                    <div>
                        <span class="text-xs font-bold text-white block">Current Feature Image</span>
                        <span class="text-[10px] text-slate-400">Upload a new image file above to update.</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Specialty Overview &amp; Clinical Description</label>
                <textarea name="description" rows="4"
                    class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ old('description', $buttonType->description) }}</textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $buttonType->is_active) ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Hospital Highlights Showcase</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $buttonType->sort_order) }}" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Clinical Specialty Profile</button>
        </form>
    </div>
</div>
@endsection

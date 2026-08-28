@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Clinical Department: {{ $category->name }}</h1>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Departments</a>
        </div>

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Name *</label>
                    <input type="text" name="name" required value="{{ $category->name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">URL Slug *</label>
                    <input type="text" name="slug" required value="{{ $category->slug }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Head of Department (HOD Doctor)</label>
                    <input type="text" name="head_of_dept" value="{{ $category->head_of_dept }}" placeholder="Prof. Dr. Robert Vance, MBBS, FCPS (Neuro)" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">OPD Consultation Hours</label>
                    <input type="text" name="opd_hours" value="{{ $category->opd_hours }}" placeholder="Sat - Thu: 9:00 AM - 8:00 PM" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Emergency Extension</label>
                    <input type="text" name="emergency_contact" value="{{ $category->emergency_contact }}" placeholder="+880 1700 112233 (Ext. 402)" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Bed &amp; ICU Unit Allocation</label>
                    <input type="text" name="bed_info" value="{{ $category->bed_info }}" placeholder="25 Dedicated Neuro ICU Beds + 40 Inpatient Cabins" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Description &amp; Overview</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $category->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Main Cover Banner Photo</label>
                    <input type="file" name="image" accept="image/*" class="text-xs text-slate-400 mb-3">
                    @if($category->image)
                    <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center gap-4">
                        <img src="{{ asset('storage/' . $category->image) }}" class="w-16 h-16 rounded-lg object-cover border border-slate-700 shrink-0">
                        <div>
                            <span class="text-xs font-bold text-white block">Current Banner</span>
                            <span class="text-[10px] text-slate-400">Upload a new file above to replace.</span>
                        </div>
                    </div>
                    @endif
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Logo / Icon Photo</label>
                    <input type="file" name="logo" accept="image/*" class="text-xs text-slate-400 mb-3">
                    @if($category->logo)
                    <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center gap-4">
                        <img src="{{ asset('storage/' . $category->logo) }}" class="w-16 h-16 rounded-lg object-contain bg-white p-1 shrink-0">
                        <div>
                            <span class="text-xs font-bold text-white block">Current Logo</span>
                            <span class="text-[10px] text-slate-400">Upload a new file above to replace.</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Hospital Directory</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ $category->sort_order }}" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Clinical Department Profile</button>
        </form>
    </div>
</div>
@endsection
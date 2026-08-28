@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Add Clinical Department &amp; Institute</h1>
            <a href="{{ route('admin.categories.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Departments</a>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Name *</label>
                    <input type="text" name="name" required placeholder="Neurology &amp; Neurosurgery" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">URL Slug *</label>
                    <input type="text" name="slug" required placeholder="neurology-neurosurgery" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Head of Department (HOD Doctor)</label>
                    <input type="text" name="head_of_dept" placeholder="Prof. Dr. Robert Vance, MBBS, FCPS (Neuro)" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">OPD Consultation Hours</label>
                    <input type="text" name="opd_hours" placeholder="Sat - Thu: 9:00 AM - 8:00 PM" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Emergency Extension</label>
                    <input type="text" name="emergency_contact" placeholder="+880 1700 112233 (Ext. 402)" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Bed &amp; ICU Unit Allocation</label>
                    <input type="text" name="bed_info" placeholder="25 Dedicated Neuro ICU Beds + 40 Inpatient Cabins" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Description &amp; Overview</label>
                <textarea name="description" rows="4" placeholder="Enter clinical division overview, sub-specialties, and surgical capabilities..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Main Cover Banner Photo</label>
                    <input type="file" name="image" accept="image/*" class="text-xs text-slate-400">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Department Logo / Icon Photo</label>
                    <input type="file" name="logo" accept="image/*" class="text-xs text-slate-400">
                </div>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Hospital Directory</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Save Clinical Department</button>
        </form>
    </div>
</div>
@endsection
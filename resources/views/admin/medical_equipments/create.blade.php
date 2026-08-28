@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Add Medical Equipment &amp; Robotics</h1>
            <a href="{{ route('admin.medical-equipments.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Equipment List</a>
        </div>

        <form action="{{ route('admin.medical-equipments.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Equipment Name *</label>
                    <input type="text" name="name" required placeholder="3.0 Tesla Silent MRI Scanner" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Model Name / Series</label>
                    <input type="text" name="model_name" placeholder="MAGNETOM Vida 3T" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Manufacturer / Brand</label>
                    <input type="text" name="manufacturer" placeholder="Siemens Healthineers" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Country of Origin</label>
                    <input type="text" name="country_of_origin" placeholder="Germany" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Diagnostic Scan Fee (BDT)</label>
                    <input type="number" step="0.01" name="scan_fee" placeholder="8500.00" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Clinical Department</label>
                <input type="text" name="department_name" placeholder="Radiology &amp; Advanced Imaging" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Equipment Description</label>
                <textarea name="description" rows="3" placeholder="Enter high-level overview of machinery, clinical purpose, and medical advantages..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Key Diagnostic Features</label>
                    <textarea name="features" rows="4" placeholder="e.g. Ultra-Silent Scan Technology, 70cm Bore Diameter, Cardiac MRI Suite..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Technical Operating Specifications</label>
                    <textarea name="specifications" rows="4" placeholder="e.g. 64-Channel Matrix Coil System, Zero Helium Boil-off, Sub-millimeter Resolution..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Main Cover Image</label>
                    <input type="file" name="image" class="text-xs text-slate-400">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Multiple Gallery Photos (Select Multiple)</label>
                    <input type="file" name="gallery_images[]" multiple class="text-xs text-slate-400">
                    <span class="text-[10px] text-slate-500 block mt-1">You can select multiple photo files for the equipment gallery.</span>
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Technology Showcase</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Save Medical Equipment Profile</button>
        </form>
    </div>
</div>
@endsection

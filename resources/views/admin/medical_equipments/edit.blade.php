@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Medical Equipment: {{ $equipment->name }}</h1>
            <a href="{{ route('admin.medical-equipments.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Equipment List</a>
        </div>

        <form action="{{ route('admin.medical-equipments.update', $equipment) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Equipment Name *</label>
                    <input type="text" name="name" required value="{{ $equipment->name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Model Name / Series</label>
                    <input type="text" name="model_name" value="{{ $equipment->model_name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Manufacturer / Brand</label>
                    <input type="text" name="manufacturer" value="{{ $equipment->manufacturer }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Country of Origin</label>
                    <input type="text" name="country_of_origin" value="{{ $equipment->country_of_origin }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Diagnostic Scan Fee (BDT)</label>
                    <input type="number" step="0.01" name="scan_fee" value="{{ $equipment->scan_fee }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Clinical Department</label>
                <input type="text" name="department_name" value="{{ $equipment->department_name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Equipment Description</label>
                <textarea name="description" rows="3" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $equipment->description }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Key Diagnostic Features</label>
                    <textarea name="features" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $equipment->features }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Technical Operating Specifications</label>
                    <textarea name="specifications" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $equipment->specifications }}</textarea>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Main Cover Image</label>
                    <input type="file" name="image" class="text-xs text-slate-400 mb-3">
                    <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center gap-4">
                        <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}" class="w-16 h-16 rounded-lg object-cover border border-slate-700 shrink-0">
                        <div>
                            <span class="text-xs font-bold text-white block">Current Cover Photo</span>
                            <span class="text-[10px] text-slate-400">Upload a new file above to replace.</span>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Add More Gallery Photos (Select Multiple)</label>
                    <input type="file" name="gallery_images[]" multiple class="text-xs text-slate-400 mb-3">
                    @if(!empty($equipment->gallery_urls) && count($equipment->gallery_urls) > 0)
                        <div class="flex items-center gap-2 overflow-x-auto p-2 bg-slate-950 rounded-xl border border-slate-800">
                            @foreach($equipment->gallery_urls as $gal)
                                <img src="{{ $gal }}" class="w-12 h-12 rounded object-cover border border-slate-700 shrink-0">
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $equipment->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Technology Showcase</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Medical Equipment Profile</button>
        </form>
    </div>
</div>
@endsection

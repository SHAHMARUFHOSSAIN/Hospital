@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Doctor Profile: {{ $director->name }}</h1>
            <a href="{{ route('admin.directors.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Doctor Directory</a>
        </div>

        <form action="{{ route('admin.directors.update', $director) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Doctor Name *</label>
                    <input type="text" name="name" required value="{{ $director->name }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Slug / URL Handle *</label>
                    <input type="text" name="slug" required value="{{ $director->slug }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Official Designation</label>
                    <input type="text" name="designation" value="{{ $director->designation }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Degrees &amp; Qualifications</label>
                    <input type="text" name="degree" value="{{ $director->degree }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Specialization</label>
                    <input type="text" name="specialization" value="{{ $director->specialization }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Experience (Years)</label>
                    <input type="number" name="experience_years" value="{{ $director->experience_years }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Consultation Fee (BDT) *</label>
                    <input type="number" step="0.01" name="consultation_fee" value="{{ $director->consultation_fee }}" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Chamber Days</label>
                    <input type="text" name="chamber_days" value="{{ $director->chamber_days }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Chamber Time Slot</label>
                    <input type="text" name="chamber_time" value="{{ $director->chamber_time }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Chamber Room Number</label>
                    <input type="text" name="room_no" value="{{ $director->room_no }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <!-- Doctor Photo File Input & Prominent Photo Preview -->
            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Doctor Profile Photo</label>
                <input type="file" name="photo" class="text-xs text-slate-400 mb-3">
                
                <div class="p-4 bg-slate-950 rounded-2xl border border-slate-800 flex items-center gap-4">
                    <img src="{{ $director->photo_url }}" alt="{{ $director->name }}" class="w-20 h-20 rounded-xl object-cover border-2 border-[#0284C7] shadow-lg shrink-0">
                    <div>
                        <span class="text-xs font-extrabold text-white block">Current Doctor Photo Preview</span>
                        <span class="text-[11px] text-slate-400 font-semibold leading-relaxed">This photo is live on the doctor's profile page and frontend directory. Choose a new file above to replace it.</span>
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Doctor Biography &amp; Medical Background</label>
                <textarea name="bio" rows="4" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $director->bio }}</textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $director->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Doctor Directory</span>
                </label>
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ $director->sort_order }}" class="w-24 px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold">
                </div>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Doctor Profile</button>
        </form>
    </div>
</div>
@endsection
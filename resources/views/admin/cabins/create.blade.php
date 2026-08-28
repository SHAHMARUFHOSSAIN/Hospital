@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Add Hospital Cabin / Ward Bed</h1>
            <a href="{{ route('admin.cabins.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Cabins</a>
        </div>

        <form action="{{ route('admin.cabins.store') }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Cabin / Suite Name *</label>
                    <input type="text" name="name" required placeholder="VIP Presidential Suite #501" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Room Type *</label>
                    <select name="room_type" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                        <option value="VIP Suite">VIP Presidential Suite</option>
                        <option value="Deluxe Cabin">Deluxe AC Cabin</option>
                        <option value="Single Cabin">Single Non-AC Cabin</option>
                        <option value="ICU Bed">ICU / CCU Bed</option>
                        <option value="Shared Ward Bed">Shared General Ward Bed</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Floor / Building Block</label>
                    <input type="text" name="floor_no" placeholder="5th Floor, Block B" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Bed Allocation Count</label>
                    <input type="text" name="bed_count" placeholder="1 Patient Bed + 1 Attendant Bed" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Daily Rent Rate (BDT) *</label>
                    <input type="number" step="0.01" name="rent_per_day" required placeholder="5000.00" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Oxygen &amp; Medical Pipeline</label>
                <input type="text" name="oxygen_type" placeholder="Central Line Medical Oxygen Supply + Vacuum Suction" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Room Amenities List</label>
                <input type="text" name="amenities" placeholder="AC, Attached Bath, LED TV, Attendant Bed, Fridge, 24/7 Nursing Call" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Cabin Image</label>
                <input type="file" name="image" class="text-xs text-slate-400">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Detailed Room Description &amp; Facilities Overview</label>
                <textarea name="description" rows="4" placeholder="Enter detailed description of room layout, attendant facilities, privacy level, and nursing care..." class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none"></textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_available" value="1" checked class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Currently Vacant &amp; Available for Admission</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Active in Website Directory</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Save Hospital Cabin Profile</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-user-doctor text-sky-400"></i> Specialist Doctors Directory CRUD
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage doctor profiles, qualifications, consultation fees, chamber hours &amp; room numbers.</p>
            </div>
            <a href="{{ route('admin.directors.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Add Specialist Doctor
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-500/20 border border-emerald-500/40 text-emerald-300 rounded-xl text-xs font-bold">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <table class="min-w-full text-xs">
                <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                    <tr>
                        <th class="px-6 py-3.5 text-left">Doctor Name &amp; Designation</th>
                        <th class="px-6 py-3.5 text-left">Degrees / Qualifications</th>
                        <th class="px-6 py-3.5 text-left">Consultation Fee</th>
                        <th class="px-6 py-3.5 text-left">Chamber Schedule</th>
                        <th class="px-6 py-3.5 text-left">Room #</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($directors as $doc)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $doc->photo_url }}"
                                    class="w-10 h-10 rounded-full object-cover border border-slate-700"
                                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=600&q=80';">
                                <div>
                                    <p class="text-white font-bold text-sm">{{ $doc->name }}</p>
                                    <p class="text-sky-400 text-[11px] font-semibold">{{ $doc->designation }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-300 font-semibold max-w-xs truncate">{{ $doc->degree ?: 'MBBS, FCPS' }}</td>
                        <td class="px-6 py-4 text-emerald-400 font-extrabold">৳ {{ number_format($doc->consultation_fee ?: 1000, 2) }}</td>
                        <td class="px-6 py-4 text-slate-300">
                            <span class="font-bold text-white">{{ $doc->chamber_days ?: 'Sat - Wed' }}</span><br>
                            <span class="text-slate-400 text-[10px]">{{ $doc->chamber_time ?: '4:00 PM - 8:00 PM' }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-300 font-bold"><i class="fas fa-door-open text-sky-400 mr-1"></i> {{ $doc->room_no ?: 'Room 302' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('doctors.show', $doc->slug) }}" target="_blank" class="text-slate-400 hover:text-white font-bold mr-2">Preview</a>
                            <a href="{{ route('admin.directors.edit', $doc) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.directors.destroy', $doc) }}" method="POST" class="inline" onsubmit="return confirm('Delete doctor profile?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No doctors added yet. Click "+ Add Specialist Doctor" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
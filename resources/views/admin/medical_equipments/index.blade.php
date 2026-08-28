@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-microscope text-sky-400"></i> Medical Machinery &amp; Robotics Showcase
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage diagnostic MRI/CT scanners, robotic surgical suits &amp; lab machinery.</p>
            </div>
            <a href="{{ route('admin.medical-equipments.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-bold text-xs rounded-xl transition shadow">
                + Add Medical Equipment
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
                        <th class="px-6 py-3.5 text-left">Equipment Name</th>
                        <th class="px-6 py-3.5 text-left">Model Name / Origin</th>
                        <th class="px-6 py-3.5 text-left">Department</th>
                        <th class="px-6 py-3.5 text-left">Scan Fee</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($equipments as $eq)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $eq->image_url }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&q=80';">
                                <div>
                                    <p class="text-white font-bold text-sm">{{ $eq->name }}</p>
                                    <p class="text-slate-400 text-[10px]">{{ $eq->manufacturer }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold">{{ $eq->model_name ?: 'Latest Gen' }}</td>
                        <td class="px-6 py-4"><span class="px-2.5 py-1 bg-slate-800 text-slate-300 rounded-full text-[10px] font-bold">{{ $eq->department_name ?: 'Diagnostic' }}</span></td>
                        <td class="px-6 py-4 text-emerald-400 font-extrabold">{{ $eq->scan_fee ? '৳ ' . number_format($eq->scan_fee, 2) : 'Free Consultation' }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('equipment.show', $eq->id) }}" target="_blank" class="text-slate-400 hover:text-white font-bold mr-2">Preview Page</a>
                            <a href="{{ route('admin.medical-equipments.edit', $eq) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.medical-equipments.destroy', $eq) }}" method="POST" class="inline" onsubmit="return confirm('Delete equipment?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No medical equipments listed yet. Click "+ Add Medical Equipment" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

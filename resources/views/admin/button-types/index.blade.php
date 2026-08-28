@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-notes-medical text-[#06B6D4]"></i> Clinical Specialties &amp; Hospital Highlights
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage 24/7 ICU, Emergency, Robotic Surgical Suite &amp; Cath Lab highlights.</p>
            </div>
            <a href="{{ route('admin.button-types.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Add Clinical Specialty
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
                        <th class="px-6 py-3.5 text-left">Specialty Name</th>
                        <th class="px-6 py-3.5 text-left">Clinical Category</th>
                        <th class="px-6 py-3.5 text-left">Sort Order</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($buttonTypes as $type)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $type->image_url }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80';">
                                <div>
                                    <p class="text-white font-bold text-sm">{{ $type->name }}</p>
                                    <p class="text-slate-400 text-[10px] truncate max-w-xs">{{ $type->description ?: 'Hospital Specialty Highlight' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold">
                            {{ \App\Models\ButtonType::variants()[$type->variant] ?? $type->variant }}
                        </td>
                        <td class="px-6 py-4 text-slate-300 font-bold">{{ $type->sort_order }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] rounded-full font-bold {{ $type->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $type->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('specialties.show', $type->id) }}" target="_blank" class="text-slate-400 hover:text-white font-bold mr-2">Preview Page</a>
                            <a href="{{ route('admin.button-types.edit', $type) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.button-types.destroy', $type) }}" method="POST" class="inline" onsubmit="return confirm('Delete this clinical specialty?')">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No clinical specialties added yet. Click "+ Add Clinical Specialty" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

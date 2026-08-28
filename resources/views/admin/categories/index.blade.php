@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-hospital-user text-teal-400"></i> Clinical Departments &amp; Institutes CRUD
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage medical specialties, clinical institutes, department descriptions &amp; icons.</p>
            </div>
            <a href="{{ route('admin.categories.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Add Clinical Department
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
                        <th class="px-6 py-3.5 text-left">Department Name</th>
                        <th class="px-6 py-3.5 text-left">Slug / Handle</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-left">Order</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($categories as $category)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @if($category->image_url)
                                    <img src="{{ $category->image_url }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80';">
                                @else
                                    <div class="w-10 h-10 rounded-lg bg-sky-500/20 text-[#0284C7] flex items-center justify-center text-lg font-bold border border-sky-500/30">
                                        <i class="fas fa-heart-pulse"></i>
                                    </div>
                                @endif
                                <div>
                                    <p class="text-white font-bold text-sm">{{ $category->name }}</p>
                                    <p class="text-slate-500 text-[10px] truncate max-w-xs">{{ $category->description ?: 'Clinical Division' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold font-mono">{{ $category->slug }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] rounded-full font-bold {{ $category->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $category->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-300 font-bold">{{ $category->sort_order }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('categories.show', $category->slug) }}" target="_blank" class="text-slate-400 hover:text-white font-bold mr-2">Preview Page</a>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this clinical department?')">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No clinical departments added yet. Click "+ Add Clinical Department" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-newspaper text-[#0284C7]"></i> Health Articles &amp; Medical Tips
                </h1>
                <p class="text-slate-400 text-xs mt-1">Publish doctor guides, heart care tips, and hospital news.</p>
            </div>
            <a href="{{ route('admin.health-blogs.create') }}" class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow transition">
                + Write Health Article
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
                        <th class="px-6 py-3.5 text-left">Article Title</th>
                        <th class="px-6 py-3.5 text-left">Category</th>
                        <th class="px-6 py-3.5 text-left">Author Doctor</th>
                        <th class="px-6 py-3.5 text-left">Published Date</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($blogs as $blog)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <img src="{{ $blog->image_url }}" class="w-10 h-10 rounded-lg object-cover border border-slate-700" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80';">
                                <div>
                                    <p class="text-white font-bold text-sm">{{ $blog->title }}</p>
                                    <p class="text-slate-400 text-[10px] truncate max-w-xs">{{ Str::limit(strip_tags($blog->content), 60) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sky-400 font-bold">{{ $blog->category }}</td>
                        <td class="px-6 py-4 text-slate-300 font-bold">{{ $blog->author }}</td>
                        <td class="px-6 py-4 text-slate-400 font-semibold">{{ $blog->published_at ? $blog->published_at->format('d M Y') : 'N/A' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-[10px] rounded-full font-bold {{ $blog->is_active ? 'bg-emerald-500/20 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $blog->is_active ? 'Published' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.health-blogs.edit', $blog) }}" class="text-sky-400 hover:underline font-bold">Edit</a>
                            <form action="{{ route('admin.health-blogs.destroy', $blog) }}" method="POST" class="inline" onsubmit="return confirm('Delete this health article?')">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-slate-500 font-semibold">No health articles published yet. Click "+ Write Health Article" above.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

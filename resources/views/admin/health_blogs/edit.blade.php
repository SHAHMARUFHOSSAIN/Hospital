@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-extrabold text-white">Edit Health Article</h1>
            <a href="{{ route('admin.health-blogs.index') }}" class="text-xs font-bold text-slate-400 hover:text-white">&larr; Back to Health Articles</a>
        </div>

        <form action="{{ route('admin.health-blogs.update', $blog) }}" method="POST" enctype="multipart/form-data" class="bg-slate-900 p-8 rounded-2xl border border-slate-800 space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Article Title *</label>
                    <input type="text" name="title" required value="{{ $blog->title }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Category *</label>
                    <select name="category" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                        <option value="Cardiology & Heart Care" {{ $blog->category == 'Cardiology & Heart Care' ? 'selected' : '' }}>Cardiology &amp; Heart Care</option>
                        <option value="Pediatrics & Child Care" {{ $blog->category == 'Pediatrics & Child Care' ? 'selected' : '' }}>Pediatrics &amp; Child Care</option>
                        <option value="Neurology & Brain Health" {{ $blog->category == 'Neurology & Brain Health' ? 'selected' : '' }}>Neurology &amp; Brain Health</option>
                        <option value="Diabetes & Lifestyle" {{ $blog->category == 'Diabetes & Lifestyle' ? 'selected' : '' }}>Diabetes &amp; Lifestyle</option>
                        <option value="Surgery & Recovery" {{ $blog->category == 'Surgery & Recovery' ? 'selected' : '' }}>Surgery &amp; Recovery</option>
                        <option value="General Wellness" {{ $blog->category == 'General Wellness' ? 'selected' : '' }}>General Wellness</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Author Doctor Name</label>
                    <input type="text" name="author" value="{{ $blog->author }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Publishing Date</label>
                    <input type="date" name="published_at" value="{{ $blog->published_at ? $blog->published_at->format('Y-m-d') : date('Y-m-d') }}" class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Cover Image Photo</label>
                <input type="file" name="image" accept="image/*" class="text-xs text-slate-400 mb-3">
                @if($blog->image)
                <div class="p-3 bg-slate-950 rounded-xl border border-slate-800 flex items-center gap-4">
                    <img src="{{ $blog->image_url }}" class="w-16 h-16 rounded-lg object-cover border border-slate-700 shrink-0">
                    <div>
                        <span class="text-xs font-bold text-white block">Current Photo</span>
                        <span class="text-[10px] text-slate-400">Upload a new file above to replace.</span>
                    </div>
                </div>
                @endif
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Article Content &amp; Health Guidelines *</label>
                <textarea name="content" rows="8" required class="w-full px-4 py-3 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7] resize-none">{{ $blog->content }}</textarea>
            </div>

            <div class="flex items-center gap-6 pt-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ $blog->is_active ? 'checked' : '' }} class="rounded">
                    <span class="text-xs text-slate-300 font-bold">Publish Live on Website</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs uppercase rounded-xl shadow transition">Update Article</button>
        </form>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-bold text-white">Media Gallery</h1>
                <p class="text-gray-400">Manage images, logos, videos and slider media</p>
            </div>
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="px-5 py-2.5 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-xl hover:shadow-lg transition">
                <span class="flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Upload Media
                </span>
            </button>
        </div>

        <!-- Filter Tabs -->
        <div class="flex gap-2 mb-6">
            <a href="{{ route('admin.media.index') }}?type=all" class="px-4 py-2 rounded-lg font-medium transition {{ !request('type') || request('type') == 'all' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                All
            </a>
            <a href="{{ route('admin.media.index') }}?type=logo" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'logo' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Logo
            </a>
            <a href="{{ route('admin.media.index') }}?type=image" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'image' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Images
            </a>
            <a href="{{ route('admin.media.index') }}?type=slider" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'slider' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Slider
            </a>
            <a href="{{ route('admin.media.index') }}?type=video" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'video' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Videos
            </a>
            <a href="{{ route('admin.media.index') }}?type=brand" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'brand' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Client Brands
            </a>
            <a href="{{ route('admin.media.index') }}?type=gallery" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'gallery' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Factory Gallery
            </a>
            <a href="{{ route('admin.media.index') }}?type=certification" class="px-4 py-2 rounded-lg font-medium transition {{ request('type') == 'certification' ? 'bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white' : 'bg-gray-800 text-gray-400 hover:bg-gray-700' }}">
                Certifications
            </a>
        </div>

        <!-- Factory Video URL -->
        <form action="{{ route('admin.content.video') }}" method="POST" class="mb-6 p-5 bg-gray-800/50 rounded-xl border border-gray-700 flex flex-col sm:flex-row sm:items-center gap-4">
            @csrf
            <div class="flex items-center gap-3 flex-1">
                <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center shrink-0">
                    <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"></path></svg>
                </div>
                <div>
                    <p class="text-white font-semibold text-sm">Factory Tour Video</p>
                    <p class="text-gray-500 text-xs">YouTube URL — shown in the home page gallery section</p>
                </div>
            </div>
            <input type="url" name="factory_video_url" value="{{ \App\Models\Setting::get('factory_video_url', '') }}"
                placeholder="https://www.youtube.com/watch?v=..."
                class="flex-1 w-full px-4 py-2.5 bg-gray-900 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-[#296d6d] outline-none">
            <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-xl hover:shadow-lg transition whitespace-nowrap">Save</button>
        </form>

        <!-- Active Logo Banner -->
        @php
            $activeLogo = \App\Models\Media::where('type', 'logo')->where('is_active', true)->first();
        @endphp
        @if($activeLogo)
        <div class="mb-6 p-4 bg-green-500/20 rounded-xl border border-green-500/30 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <img src="{{ $activeLogo->image_url }}" alt="Active Logo" class="h-12 w-auto object-contain bg-white rounded-lg p-1" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=300&q=80';">
                <div>
                    <p class="text-green-400 font-semibold">Active Logo Set</p>
                    <p class="text-green-400/70 text-sm">This logo is displayed on the website</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Media Grid -->
        @if($media->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($media as $item)
            <div class="group relative bg-gray-800 rounded-xl overflow-hidden hover:bg-gray-700 transition border border-gray-700">
                @if($item->type === 'video')
                <div class="aspect-video bg-gray-900 flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                @else
                <div class="aspect-video overflow-hidden bg-white">
                    <img src="{{ $item->image_url }}" alt="{{ $item->alt }}" class="w-full h-full object-contain p-2" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=300&q=80';">
                </div>
                @endif
                
                @if($item->type === 'logo' && $item->is_active)
                <div class="absolute top-2 right-2 z-10">
                    <span class="px-2 py-1 bg-green-500 text-white text-xs font-medium rounded-full">Active</span>
                </div>
                @endif
                
                <div class="absolute inset-0 bg-black/70 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-2 rounded-xl">
                    @if(in_array($item->type, ['logo', 'image', 'slider']) && (!$item->is_active || $item->type !== 'logo'))
                    <form action="{{ route('admin.media.setLogo', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="p-2 bg-[#296d6d] rounded-lg hover:bg-[#235d5d] transition" title="Set as Logo">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </button>
                    </form>
                    @endif
                    @if($item->file_path)
                    <a href="{{ asset('storage/' . $item->file_path) }}" target="_blank" class="p-2 bg-white/20 rounded-lg hover:bg-white/40 transition">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    </a>
                    @endif
                    <form action="{{ route('admin.media.destroy', $item->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this?')" class="p-2 bg-red-500 rounded-lg hover:bg-red-600 transition">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </form>
                </div>
                <div class="p-3 bg-gray-800">
                    <p class="text-white text-sm font-medium truncate">{{ $item->alt ?? $item->title ?? 'Untitled' }}</p>
                    <div class="flex items-center justify-between mt-1">
                        <span class="text-gray-500 text-xs capitalize">{{ $item->type }}</span>
                        @if($item->is_active)
                        <span class="text-green-500 text-xs">Active</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-gray-800/50 rounded-xl border border-gray-700">
            <div class="w-20 h-20 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
            <p class="text-gray-400">No media files uploaded yet</p>
            <button onclick="document.getElementById('uploadModal').classList.remove('hidden')" class="mt-4 text-[#7fb3b3] hover:text-[#9fd0cf] font-medium">
                Upload your first media
            </button>
        </div>
        @endif
    </div>
</div>

<!-- Upload Modal -->
<div id="uploadModal" class="fixed inset-0 bg-black/70 hidden z-50 flex items-center justify-center" onclick="if(event.target === this) this.classList.add('hidden')">
    <div class="bg-gray-800 rounded-2xl p-6 w-full max-w-md mx-4 shadow-2xl border border-gray-700">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-white">Upload Media</h2>
            <button onclick="document.getElementById('uploadModal').classList.add('hidden')" class="text-gray-400 hover:text-white">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        
        <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Media Type</label>
                <select name="type" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-xl text-white focus:ring-2 focus:ring-[#296d6d]">
                    <option value="logo">Logo</option>
                    <option value="image">Image</option>
                    <option value="slider">Slider</option>
                    <option value="video">Video</option>
                    <option value="brand">Client Brand (logo)</option>
                    <option value="gallery">Factory Gallery</option>
                    <option value="certification">Certification Badge</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Title / Name</label>
                <input type="text" name="title" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-[#296d6d]" placeholder="e.g. OEKO-TEX, Brand name, Machine room">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Alt Text</label>
                <input type="text" name="alt" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-xl text-white placeholder-gray-500 focus:ring-2 focus:ring-[#296d6d]" placeholder="Describe this media">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">File</label>
                <input type="file" name="file_path" accept="image/*,video/*" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-xl text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-[#296d6d] file:text-white file:cursor-pointer" required>
            </div>
            
            <div>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded border-gray-600 bg-gray-900 text-[#5b9393] focus:ring-[#296d6d]">
                    <span class="text-gray-300">Active</span>
                </label>
            </div>
            
            <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-bold rounded-xl hover:shadow-lg transition">
                Upload
            </button>
        </form>
    </div>
</div>
@endsection
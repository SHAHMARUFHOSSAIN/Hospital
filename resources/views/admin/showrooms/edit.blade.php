@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Edit Showroom</h1>
        
        <form action="{{ route('admin.showrooms.update', $showroom->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Name *</label>
                        <input type="text" name="name" value="{{ $showroom->name }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Slug *</label>
                        <input type="text" name="slug" value="{{ $showroom->slug }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">{{ $showroom->description }}</textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    @if($showroom->image)
                    <img src="{{ asset('storage/' . $showroom->image) }}" class="mt-2 h-32 rounded">
                    @endif
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Address</label>
                    <textarea name="address" rows="2" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">{{ $showroom->address }}</textarea>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ $showroom->phone }}" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                        <input type="email" name="email" value="{{ $showroom->email }}" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ $showroom->sort_order }}" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <label class="flex items-center mt-4">
                    <input type="checkbox" name="is_active" value="1" {{ $showroom->is_active ? 'checked' : '' }} class="rounded border-gray-600 text-[#7fb3b3] bg-gray-900">
                    <span class="ml-2 text-sm text-gray-300">Active</span>
                </label>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded-lg hover:opacity-90">Update</button>
        </form>
    </div>
</div>
@endsection
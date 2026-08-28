@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Edit History</h1>
        
        <form action="{{ route('admin.histories.update', $history->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Year *</label>
                        <input type="number" name="year" value="{{ $history->year }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ $history->sort_order }}" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Title *</label>
                    <input type="text" name="title" value="{{ $history->title }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">{{ $history->description }}</textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Image</label>
                    <input type="file" name="image" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    @if($history->image)
                    <img src="{{ asset('storage/' . $history->image) }}" class="mt-2 h-32 rounded">
                    @endif
                </div>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded-lg hover:opacity-90">Update</button>
        </form>
    </div>
</div>
@endsection
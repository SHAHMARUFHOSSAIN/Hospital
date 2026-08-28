@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Create Product</h1>
        
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Category *</label>
                        <select name="category_id" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Name *</label>
                        <input type="text" name="name" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Slug *</label>
                        <input type="text" name="slug" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white"></textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Specifications</label>
                    <textarea name="specifications" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white"></textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" class="rounded border-gray-600 text-[#7fb3b3] bg-gray-900">
                        <span class="ml-2 text-sm text-gray-300">Featured</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded border-gray-600 text-[#7fb3b3] bg-gray-900">
                        <span class="ml-2 text-sm text-gray-300">Active</span>
                    </label>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="0" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded-lg hover:opacity-90">Create</button>
        </form>
    </div>
</div>
@endsection
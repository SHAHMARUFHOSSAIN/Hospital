@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Edit: {{ $product->name }}</h1>
        
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf @method('PUT')
            
            <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Category *</label>
                        <select name="category_id" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Name *</label>
                        <input type="text" name="name" value="{{ $product->name }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Slug *</label>
                        <input type="text" name="slug" value="{{ $product->slug }}" required class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">{{ $product->description }}</textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Specifications</label>
                    <textarea name="specifications" rows="4" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">{{ $product->specifications }}</textarea>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-1">Thumbnail</label>
                    <input type="file" name="thumbnail" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    @if($product->thumbnail)
                    <img src="{{ asset('storage/' . $product->thumbnail) }}" class="mt-2 h-32 object-cover rounded">
                    @endif
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="rounded border-gray-600 text-[#7fb3b3] bg-gray-900">
                        <span class="ml-2 text-sm text-gray-300">Featured</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }} class="rounded border-gray-600 text-[#7fb3b3] bg-gray-900">
                        <span class="ml-2 text-sm text-gray-300">Active</span>
                    </label>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ $product->sort_order }}" class="w-full px-4 py-2 bg-gray-900 border border-gray-600 rounded-lg text-white">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded-lg hover:opacity-90">Update</button>
        </form>
        
        <div class="mt-12">
            <h2 class="text-xl font-bold text-white mb-4">Variants</h2>
            <form action="{{ route('admin.products.storeVariant', $product->id) }}" method="POST" class="mb-4 p-4 bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700">
                @csrf
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                    <input type="text" name="size" placeholder="Size" class="px-3 py-2 bg-gray-900 border border-gray-600 rounded text-white placeholder-gray-500">
                    <input type="text" name="color" placeholder="Color" class="px-3 py-2 bg-gray-900 border border-gray-600 rounded text-white placeholder-gray-500">
                    <input type="text" name="sku" placeholder="SKU" class="px-3 py-2 bg-gray-900 border border-gray-600 rounded text-white placeholder-gray-500">
                    <input type="number" name="price" placeholder="Price" step="0.01" class="px-3 py-2 bg-gray-900 border border-gray-600 rounded text-white placeholder-gray-500">
                    <input type="number" name="stock" placeholder="Stock" value="0" class="px-3 py-2 bg-gray-900 border border-gray-600 rounded text-white placeholder-gray-500">
                </div>
                <button type="submit" class="mt-2 px-4 py-2 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded hover:opacity-90">Add Variant</button>
            </form>
            
            <table class="min-w-full bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-400">Size</th>
                        <th class="px-4 py-2 text-left text-gray-400">Color</th>
                        <th class="px-4 py-2 text-left text-gray-400">SKU</th>
                        <th class="px-4 py-2 text-left text-gray-400">Price</th>
                        <th class="px-4 py-2 text-left text-gray-400">Stock</th>
                        <th class="px-4 py-2 text-left text-gray-400">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($product->variants as $variant)
                    <tr class="hover:bg-gray-800/30">
                        <td class="px-4 py-2 text-white">{{ $variant->size }}</td>
                        <td class="px-4 py-2 text-white">{{ $variant->color }}</td>
                        <td class="px-4 py-2 text-white">{{ $variant->sku }}</td>
                        <td class="px-4 py-2 text-white">${{ $variant->price }}</td>
                        <td class="px-4 py-2 text-white">{{ $variant->stock }}</td>
                        <td class="px-4 py-2">
                            <form action="{{ route('admin.products.destroyVariant', $variant->id) }}" method="POST">@csrf @method('delete')<button class="text-red-400 hover:text-red-300">Delete</button></form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-8">
            <h2 class="text-xl font-bold text-white mb-4">Images</h2>
            <form action="{{ route('admin.products.storeImage', $product->id) }}" method="POST" enctype="multipart/form-data" class="mb-4 p-4 bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700">
                @csrf
                <input type="file" name="image" required class="mr-2 text-white">
                <button type="submit" class="px-4 py-2 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded hover:opacity-90">Upload</button>
            </form>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @foreach($product->images as $image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $image->image) }}" class="h-32 w-full object-cover rounded">
                    <form action="{{ route('admin.products.destroyImage', $image->id) }}" method="POST" class="absolute top-0 right-0">
                        @csrf @method('delete')
                        <button class="bg-red-500 text-white px-2 py-1 text-xs rounded">X</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
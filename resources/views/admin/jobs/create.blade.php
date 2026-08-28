@extends('layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Create Job</h1>
        
        <form action="{{ route('admin.jobs.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-gray-700">
                <h2 class="text-lg font-semibold text-white mb-4">Job Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Title *</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Slug *</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" required class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                </div>
                
                <div class="mt-4 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                        <input type="text" name="location" value="{{ old('location') }}" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Type</label>
                        <input type="text" name="type" value="{{ old('type') }}" placeholder="Full-time, Part-time" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Salary</label>
                        <input type="number" name="salary" value="{{ old('salary') }}" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                </div>
            </div>
            
            <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-gray-700">
                <h2 class="text-lg font-semibold text-white mb-4">Description</h2>
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <textarea name="description" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">{{ old('description') }}</textarea>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Requirements</label>
                    <textarea name="requirements" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">{{ old('requirements') }}</textarea>
                </div>
            </div>
            
            <div class="bg-gray-800/50 backdrop-blur-sm p-6 rounded-xl border border-gray-700">
                <h2 class="text-lg font-semibold text-white mb-4">Status</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center gap-3">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-600 bg-gray-900 text-[#5b9393] focus:ring-[#296d6d]">
                            <span class="text-gray-300">Active</span>
                        </label>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full px-4 py-3 bg-gray-900 border border-gray-600 rounded-lg text-white focus:ring-2 focus:ring-[#296d6d] focus:border-transparent">
                    </div>
                </div>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="px-6 py-3 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-lg hover:shadow-lg transition">Create Job</button>
                <a href="{{ route('admin.jobs.index') }}" class="px-6 py-3 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-800 transition">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
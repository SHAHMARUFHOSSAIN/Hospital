@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Showrooms</h1>
            <a href="{{ route('admin.showrooms.create') }}" class="px-4 py-2 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white rounded-lg hover:opacity-90">Add New</a>
        </div>
        
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($showrooms as $showroom)
                    <tr class="hover:bg-gray-800/30">
                        <td class="px-6 py-4 whitespace-nowrap text-white">{{ $showroom->name }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $showroom->category->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 text-xs rounded-full {{ $showroom->is_active ? 'bg-green-500/20 text-green-400' : 'bg-gray-500/20 text-gray-400' }}">
                                {{ $showroom->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.showrooms.edit', $showroom->id) }}" class="text-[#7fb3b3] hover:text-[#9fd0cf] mr-3">Edit</a>
                            <form action="{{ route('admin.showrooms.destroy', $showroom->id) }}" method="POST" class="inline">
                                @csrf @method('delete')
                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-6 py-4 text-center text-gray-400">No showrooms found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-white">Jobs</h1>
            <a href="{{ route('admin.jobs.create') }}" class="px-5 py-2.5 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-lg hover:shadow-lg transition">Add New</a>
        </div>
        
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl overflow-hidden border border-gray-700">
            <table class="min-w-full">
                <thead class="bg-gray-800/80">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach($jobs as $job)
                    <tr class="hover:bg-gray-800/30 transition">
                        <td class="px-6 py-4 text-white">{{ $job->title }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $job->location }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-xs rounded-full {{ $job->is_active ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-gray-700 text-gray-400' }}">
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.jobs.edit', $job->id) }}" class="text-[#7fb3b3] hover:text-[#9fd0cf] mr-4 font-medium">Edit</a>
                            <a href="{{ route('admin.jobs.applications', $job->id) }}" class="text-[#7fb3b3] hover:text-[#9fd0cf] mr-4 font-medium">Applications</a>
                            <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" class="inline">
                                @csrf @method('delete')
                                <button type="submit" class="text-red-400 hover:text-red-300 font-medium" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="px-6 py-4">{{ $jobs->links() }}</div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.admin')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white mb-8">Applications</h1>
        
        <div class="bg-gray-800/50 backdrop-blur-sm rounded-xl border border-gray-700 overflow-hidden">
            <table class="min-w-full divide-y divide-gray-700">
                <thead class="bg-gray-800">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Job</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($applications as $application)
                    <tr class="hover:bg-gray-800/30">
                        <td class="px-6 py-4 text-white">{{ $application->name }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $application->job->title }}</td>
                        <td class="px-6 py-4 text-gray-400">{{ $application->email }}</td>
                        <td class="px-6 py-4">
                            <form action="{{ route('admin.applications.status', $application->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()" class="text-sm border rounded px-2 py-1 bg-gray-900 text-white border-gray-600
                                    @if($application->status === 'pending') border-yellow-500
                                    @elseif($application->status === 'reviewing') border-[#296d6d]
                                    @elseif($application->status === 'shortlisted') border-green-500
                                    @elseif($application->status === 'rejected') border-red-500
                                    @else border-[#296d6d] @endif">
                                    <option value="pending" {{ $application->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="reviewing" {{ $application->status === 'reviewing' ? 'selected' : '' }}>Reviewing</option>
                                    <option value="shortlisted" {{ $application->status === 'shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                    <option value="rejected" {{ $application->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    <option value="hired" {{ $application->status === 'hired' ? 'selected' : '' }}>Hired</option>
                                </select>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            @if($application->cv_path)
                            <a href="{{ $application->cv_url }}" target="_blank" class="text-sky-400 hover:underline font-bold mr-3"><i class="fas fa-file-pdf mr-1"></i> View CV</a>
                            @endif
                            <form action="{{ route('admin.applications.destroy', $application->id) }}" method="POST" class="inline">
                                @csrf @method('delete')
                                <button type="submit" class="text-red-400 hover:text-red-300" onclick="return confirm('Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="px-6 py-4 text-center text-gray-400">No applications yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-6 py-4">{{ $applications->links() }}</div>
        </div>
    </div>
</div>
@endsection
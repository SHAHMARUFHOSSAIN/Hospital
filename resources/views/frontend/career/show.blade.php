@extends('layouts.frontend')

@section('content')
@if($job)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('career') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-500 transition mb-8">
            <i class="fas fa-arrow-left"></i> Back to Careers
        </a>

        <div class="grid lg:grid-cols-3 gap-16">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-4 mb-4">
                    @if($job->isExpired())
                        <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Closed</span>
                    @else
                        <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Open</span>
                    @endif
                    @if($job->deadline && !$job->isExpired())
                        <span class="text-sm text-gray-500">
                            <i class="fas fa-clock mr-1"></i> Apply by {{ $job->deadline->format('M d, Y') }}
                        </span>
                    @endif
                </div>

                <h1 class="text-3xl md:text-4xl font-bold">{{ $job->title }}</h1>

                <div class="flex flex-wrap gap-6 mt-4 text-sm text-gray-500">
                    @if($job->location)
                    <span class="flex items-center gap-2">
                        <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                    </span>
                    @endif
                    @if($job->type)
                    <span class="flex items-center gap-2">
                        <i class="fas fa-briefcase"></i> {{ $job->type }}
                    </span>
                    @endif
                    @if($job->salary)
                    <span class="flex items-center gap-2">
                        <i class="fas fa-dollar-sign"></i> {{ $job->salary }}
                    </span>
                    @endif
                </div>

                @if($job->description)
                <div class="mt-8">
                    <h2 class="text-xl font-bold mb-4">Job Description</h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $job->description }}</div>
                </div>
                @endif

                @if($job->requirements)
                <div class="mt-8">
                    <h2 class="text-xl font-bold mb-4">Requirements</h2>
                    <div class="text-gray-600 leading-relaxed whitespace-pre-line">{{ $job->requirements }}</div>
                </div>
                @endif
            </div>

            <div>
                <div class="card-3d bg-white rounded-2xl p-8 shadow-card sticky top-24">
                    <h3 class="text-lg font-bold mb-6">Apply for this Position</h3>
                    <form action="{{ route('career.apply', $job->slug) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                            <input type="tel" name="phone" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Resume (PDF)</label>
                            <input type="file" name="cv" accept=".pdf" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Cover Letter</label>
                            <textarea name="cover_letter" rows="4" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent outline-none"></textarea>
                        </div>
                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-[#296d6d] to-[#235d5d] text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition">
                            Submit Application
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@else
<section class="py-24 text-center">
    <i class="fas fa-exclamation-circle text-6xl text-gray-200 mb-4"></i>
    <h1 class="text-2xl font-bold">Job Not Found</h1>
    <a href="{{ route('career') }}" class="inline-flex items-center gap-2 mt-6 text-indigo-500 font-medium">
        <i class="fas fa-arrow-left"></i> Back to Careers
    </a>
</section>
@endif
@endsection
@extends('layouts.frontend')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Join Us</span>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Career Opportunities</h1>
            <div class="section-divider w-20 mx-auto mb-6"></div>
            <p class="text-gray-500 max-w-2xl mx-auto">Join our team and be part of something amazing. Explore open positions below.</p>
        </div>
    </div>
</section>

<section class="pb-24">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="space-y-6">
            @forelse($jobs as $job)
            <a href="{{ route('career.show', $job->slug) }}" class="block card-3d bg-white rounded-2xl p-8 shadow-card hover:shadow-3d transition-all duration-500">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <h3 class="text-xl font-bold hover:text-indigo-500 transition">{{ $job->title }}</h3>
                        <div class="flex flex-wrap gap-4 mt-2 text-sm text-gray-500">
                            @if($job->location)
                            <span class="flex items-center gap-1">
                                <i class="fas fa-map-marker-alt"></i> {{ $job->location }}
                            </span>
                            @endif
                            @if($job->type)
                            <span class="flex items-center gap-1">
                                <i class="fas fa-briefcase"></i> {{ $job->type }}
                            </span>
                            @endif
                            @if($job->salary)
                            <span class="flex items-center gap-1">
                                <i class="fas fa-dollar-sign"></i> {{ $job->salary }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @if($job->isExpired())
                            <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm">Closed</span>
                        @else
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm">Open</span>
                        @endif
                        <i class="fas fa-arrow-right text-gray-400 group-hover:text-indigo-500"></i>
                    </div>
                </div>
            </a>
            @empty
            <div class="text-center py-24">
                <i class="fas fa-briefcase text-6xl text-gray-200 mb-4"></i>
                <p class="text-gray-500">No open positions at the moment. Check back soon!</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
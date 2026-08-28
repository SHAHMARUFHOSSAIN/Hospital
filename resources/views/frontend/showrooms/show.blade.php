@extends('layouts.frontend')

@section('content')
@if($showroom)
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('showrooms') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-500 transition mb-8">
            <i class="fas fa-arrow-left"></i> Back to Showrooms
        </a>

        <div class="grid lg:grid-cols-2 gap-16">
            <div class="card-3d bg-white rounded-3xl overflow-hidden shadow-card p-6">
                <div class="aspect-[4/3] bg-gradient-to-br from-purple-50 to-indigo-50 rounded-2xl flex items-center justify-center overflow-hidden">
                    @if($showroom->image)
                        <img src="{{ asset('storage/' . $showroom->image) }}" alt="{{ $showroom->name }}" class="w-full h-full object-cover rounded-2xl">
                    @else
                        <div class="w-32 h-32 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-store text-4xl text-purple-500"></i>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <span class="inline-block px-4 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-4">Showroom</span>
                <h1 class="text-3xl md:text-4xl font-bold">{{ $showroom->name }}</h1>
                
                @if($showroom->description)
                <div class="mt-6">
                    <p class="text-gray-600 leading-relaxed">{{ $showroom->description }}</p>
                </div>
                @endif

                <div class="mt-8 space-y-4">
                    @if($showroom->address)
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-indigo-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-map-marker-alt text-indigo-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Address</h3>
                            <p class="text-gray-500">{{ $showroom->address }}</p>
                        </div>
                    </div>
                    @endif

                    @if($showroom->phone)
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-phone text-purple-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Phone</h3>
                            <p class="text-gray-500">{{ $showroom->phone }}</p>
                        </div>
                    </div>
                    @endif

                    @if($showroom->email)
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-envelope text-pink-500"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold">Email</h3>
                            <p class="text-gray-500">{{ $showroom->email }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        @if($showroom->map_embed)
        <div class="mt-16">
            <h2 class="text-2xl font-bold mb-6">Find Us on Map</h2>
            <div class="aspect-[21/9] bg-gray-50 rounded-2xl overflow-hidden shadow-card">
                {!! $showroom->map_embed !!}
            </div>
        </div>
        @endif
    </div>
</section>

@else
<section class="py-24 text-center">
    <i class="fas fa-exclamation-circle text-6xl text-gray-200 mb-4"></i>
    <h1 class="text-2xl font-bold">Showroom Not Found</h1>
    <a href="{{ route('showrooms') }}" class="inline-flex items-center gap-2 mt-6 text-indigo-500 font-medium">
        <i class="fas fa-arrow-left"></i> Back to Showrooms
    </a>
</section>
@endif
@endsection
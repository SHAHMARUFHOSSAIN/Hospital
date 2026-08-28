@extends('layouts.frontend')

@section('content')
<!-- Single Page Hero - Vibrant Striking -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Dynamic Background Collage -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Base gradient -->
        <div class="absolute inset-0 bg-gradient-to-br from-amber-500 via-blue-600 to-slate-700"></div>
        
        <!-- Fabric texture overlays -->
        <div class="absolute inset-0 opacity-30" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        
        <!-- Colorful fabric patches -->
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute -top-20 -left-20 w-96 h-96 bg-amber-400/60 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute -top-16 right-10 w-80 h-80 bg-blue-400/50 rounded-full blur-3xl animate-pulse delay-300"></div>
            <div class="absolute top-1/3 left-[5%] w-64 h-64 bg-yellow-400/40 rounded-full blur-2xl animate-pulse delay-500"></div>
            <div class="absolute top-1/2 right-[5%] w-72 h-72 bg-slate-400/40 rounded-full blur-2xl animate-pulse delay-700"></div>
            <div class="absolute bottom-10 right-[20%] w-56 h-56 bg-cyan-400/35 rounded-full blur-2xl animate-pulse delay-1000"></div>
            <div class="absolute bottom-0 left-[15%] w-64 h-64 bg-rose-400/40 rounded-full blur-2xl animate-pulse delay-800"></div>
        </div>
        
        <!-- Sewing tools collage -->
        <div class="absolute inset-0">
            <div class="absolute top-[15%] left-[10%] text-6xl opacity-40 animate-bounce" style="animation-duration: 4s;">🧵</div>
            <div class="absolute top-[25%] right-[15%] text-5xl opacity-35 animate-bounce" style="animation-duration: 3.5s;">✂️</div>
            <div class="absolute bottom-[30%] left-[15%] text-5xl opacity-30 animate-bounce" style="animation-duration: 4.5s;">🪡</div>
            <div class="absolute bottom-[20%] right-[25%] text-6xl opacity-30 animate-bounce" style="animation-duration: 5s;">🪜</div>
        </div>
        
        <!-- Thread lines -->
        <svg class="absolute top-[35%] left-[5%] w-0.5 h-32 opacity-40" style="transform: rotate(20deg)">
            <line x1="0" y1="0" x2="0" y2="100%" stroke="white" stroke-width="2" stroke-dasharray="6 3"/>
        </svg>
        <svg class="absolute top-[55%] right-[10%] w-0.5 h-24 opacity-40" style="transform: rotate(-15deg)">
            <line x1="0" y1="0" x2="0" y2="100%" stroke="white" stroke-width="2" stroke-dasharray="4 2"/>
        </svg>
    </div>
    
    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/50 via-black/30 to-black/50"></div>
    
    <!-- Page Title -->
    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <!-- Breadcrumb -->
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-sm font-medium mb-6">
            <a href="{{ route('home') }}" class="hover:text-yellow-300 transition">Home</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
            <span class="text-white/80">{{ $pageTitle ?? 'Page' }}</span>
        </div>
        
        <!-- Bold Headline -->
        <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-4 drop-shadow-lg">
            {{ $pageTitle ?? 'Welcome' }}
        </h1>
        
        <!-- Subtitle -->
        @if(isset($pageSubtitle))
        <p class="text-xl text-white/90 max-w-2xl mx-auto">{{ $pageSubtitle }}</p>
        @endif
    </div>
</section>

<!-- Page Content -->
@yield('pageContent')

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-amber-500 via-blue-500 to-slate-500 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <pattern id="waves" width="20" height="20" patternUnits="userSpaceOnUse">
                <path d="M0 10 Q 5 5 10 10 T 20 10" fill="none" stroke="white" stroke-width="1"/>
            </pattern>
            <rect width="100" height="100" fill="url(#waves)"/>
        </svg>
    </div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-black text-white mb-4">Have Questions?</h2>
        <p class="text-xl text-white/90 mb-8">We'd love to hear from you. Get in touch today.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="{{ route('contact') }}" class="group px-8 py-4 bg-white text-amber-600 font-bold rounded-full hover:shadow-xl transition transform hover:scale-105 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Us
            </a>
            <a href="{{ route('products') }}" class="px-8 py-4 border-2 border-white text-white font-bold rounded-full hover:bg-white hover:text-amber-600 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Browse Products
            </a>
        </div>
    </div>
</section>
@endsection
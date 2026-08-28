@extends('layouts.frontend')

@section('content')
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <a href="{{ route('about') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-indigo-500 transition mb-8">
            <i class="fas fa-arrow-left"></i> Back to About
        </a>
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-4 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-semibold mb-4">Timeline</span>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Our History</h1>
            <div class="section-divider w-20 mx-auto mb-6"></div>
            <p class="text-gray-500">A journey of growth and excellence.</p>
        </div>
    </div>
</section>

<section class="pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php $histories = \App\Models\History::orderBy('year', 'desc')->get(); @endphp
        
        @if($histories->count() > 0)
        <div class="max-w-3xl mx-auto">
            <div class="space-y-12">
                @foreach($histories as $history)
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#296d6d] to-[#235d5d] text-white rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="font-bold text-lg">{{ $history->year }}</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <h3 class="text-xl font-bold">{{ $history->title }}</h3>
                        <p class="text-gray-600 mt-2 leading-relaxed">{{ $history->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div class="max-w-3xl mx-auto">
            <div class="space-y-12">
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#296d6d] to-[#235d5d] text-white rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="font-bold text-lg">2010</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <h3 class="text-xl font-bold">Company Founded</h3>
                        <p class="text-gray-600 mt-2">Alam Buttons was established with a vision to provide premium quality garments.</p>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-[#235d5d] to-[#296d6d] text-white rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="font-bold text-lg">2015</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <h3 class="text-xl font-bold">Expansion</h3>
                        <p class="text-gray-600 mt-2">Opened multiple showrooms and expanded our product range.</p>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-pink-500 to-rose-500 text-white rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="font-bold text-lg">2020</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <h3 class="text-xl font-bold">Digital Transformation</h3>
                        <p class="text-gray-600 mt-2">Launched our online presence and modernized operations.</p>
                    </div>
                </div>
                <div class="flex gap-6">
                    <div class="flex-shrink-0">
                        <div class="w-20 h-20 bg-gradient-to-br from-rose-500 to-red-500 text-white rounded-2xl flex items-center justify-center shadow-lg">
                            <span class="font-bold text-lg">2026</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-4">
                        <h3 class="text-xl font-bold">Continued Growth</h3>
                        <p class="text-gray-600 mt-2">Expanding our reach with new categories and products.</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
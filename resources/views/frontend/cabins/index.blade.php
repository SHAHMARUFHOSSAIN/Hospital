@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('cabins') . ' — CarePlus Hospital')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-bed"></i> {{ \App\Helpers\LanguageHelper::get('cabins') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">{{ \App\Helpers\LanguageHelper::get('cabins') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-sm font-semibold">Book luxury VIP suites, single AC cabins, deluxe rooms, and ICU critical care beds equipped with 24/7 medical attendant support.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($cabins as $cabin)
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-6">
                <div>
                    <!-- Clickable Image -> Details Page -->
                    <a href="{{ route('cabins.show', $cabin->id) }}" class="block aspect-video rounded-2xl overflow-hidden mb-6 bg-slate-100 relative shadow-inner">
                        <img src="{{ $cabin->image_url }}" alt="{{ $cabin->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80';">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-[#0284C7] text-white text-[10px] font-extrabold uppercase rounded-full shadow">
                            {{ $cabin->room_type }}
                        </span>
                    </a>

                    <!-- Clickable Title -> Details Page -->
                    <a href="{{ route('cabins.show', $cabin->id) }}" class="block font-extrabold text-xl text-slate-900 mb-2 group-hover:text-[#0284C7] transition-colors leading-tight">
                        {{ $cabin->name }}
                    </a>

                    <!-- Price Badge -->
                    <div class="flex items-center gap-2 mb-4">
                        <span class="text-2xl font-extrabold text-[#0284C7]">BDT {{ number_format($cabin->rent_per_day) }}</span>
                        <span class="text-xs text-slate-500 font-bold">/ {{ \App\Helpers\LanguageHelper::get('daily_rent') }}</span>
                    </div>

                    <!-- Amenities list preview -->
                    @if($cabin->amenities)
                    <div class="flex flex-wrap gap-1.5 mb-6">
                        @foreach(array_slice(explode(',', $cabin->amenities), 0, 4) as $amenity)
                            <span class="px-2.5 py-1 bg-sky-50 text-slate-700 text-[10px] font-bold rounded-lg border border-sky-100">
                                <i class="fas fa-check text-[#0284C7] mr-1"></i>{{ trim($amenity) }}
                            </span>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Clickable Button -> Details Page -->
                <a href="{{ route('cabins.show', $cabin->id) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>View Room Details &amp; Reserve</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-slate-200">
                <i class="fas fa-bed text-5xl text-slate-300 mb-4"></i>
                <p class="text-slate-500 font-semibold">No hospital cabins currently listed.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

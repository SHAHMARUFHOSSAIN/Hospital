@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('equipment') . ' — CarePlus Hospital')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-robot"></i> {{ \App\Helpers\LanguageHelper::get('equipment') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">{{ \App\Helpers\LanguageHelper::get('equipment') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-sm font-semibold">Explore Da Vinci Robotic Surgical Systems, 3.0T Tesla Silent MRI, 128-Slice Cardiac CT, and Cath Lab technology.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($equipments as $eq)
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-6">
                <div>
                    <!-- Clickable Image -> Equipment Details Page -->
                    <a href="{{ route('equipment.show', $eq->id) }}" class="block aspect-video rounded-2xl overflow-hidden mb-6 bg-slate-100 relative shadow-inner">
                        <img src="{{ $eq->image_url }}" alt="{{ $eq->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&q=80';">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-full">
                            {{ $eq->department ?: 'Radiology & Imaging' }}
                        </span>
                    </a>

                    <!-- Clickable Title -> Equipment Details Page -->
                    <a href="{{ route('equipment.show', $eq->id) }}" class="block font-extrabold text-xl text-slate-900 mb-1 group-hover:text-[#0284C7] transition-colors leading-tight">
                        {{ $eq->name }}
                    </a>

                    <p class="text-xs text-slate-500 font-bold mb-4"><i class="fas fa-microchip text-[#0284C7] mr-1"></i> {{ $eq->model_name ?: 'High-Precision System' }}</p>

                    <p class="text-xs text-slate-600 font-medium leading-relaxed mb-6 line-clamp-3">{{ $eq->description }}</p>
                </div>

                <!-- Clickable Button -> Equipment Details Page -->
                <a href="{{ route('equipment.show', $eq->id) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>View Specifications &amp; Book Scan</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-16 bg-white rounded-3xl border border-slate-200">
                <i class="fas fa-robot text-5xl text-slate-300 mb-4"></i>
                <p class="text-slate-500 font-semibold">No medical equipment currently listed in showcase.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

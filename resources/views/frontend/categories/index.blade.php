@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('department_categories') . ' — CarePlus Hospital')

@section('content')
<!-- Header Banner -->
<section class="py-20 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-hospital-user"></i> {{ \App\Helpers\LanguageHelper::get('department_categories') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">{{ \App\Helpers\LanguageHelper::get('department_categories') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-base font-semibold">Explore specialized clinical divisions equipped with 24/7 ICUs, operation theaters, and senior specialist consultants.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($categories as $category)
            @php $theme = $category->medical_theme; @endphp
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-8 hover:-translate-y-1.5 transition-all duration-300">
                <div>
                    <!-- Unique Department Medical Icon / Image -->
                    <a href="{{ route('categories.show', $category->slug) }}" class="block mb-6">
                        @if($category->image_url)
                            <div class="w-full aspect-video rounded-2xl overflow-hidden bg-slate-100 mb-4 shadow border border-slate-200">
                                <img src="{{ $category->image_url }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80';">
                            </div>
                        @else
                            <div class="w-16 h-16 rounded-2xl {{ $theme['bg'] }} {{ $theme['text'] }} {{ $theme['border'] }} border flex items-center justify-center text-3xl {{ $theme['hover_bg'] }} group-hover:text-white transition-all duration-300 shadow-sm">
                                <i class="fas {{ $category->medical_icon }}"></i>
                            </div>
                        @endif
                    </a>

                    <!-- Department Title -->
                    <a href="{{ route('categories.show', $category->slug) }}" class="block text-xl font-extrabold text-slate-900 group-hover:text-[#0284C7] transition-colors mb-3 leading-tight">
                        {{ $category->name }}
                    </a>

                    <p class="text-slate-500 text-xs leading-relaxed mb-6 font-medium line-clamp-3">{{ $category->description ?: 'State-of-the-art clinical division equipped with 24/7 ICUs, operation theaters, and senior specialist consultants.' }}</p>
                </div>

                <!-- Explore Button -->
                <a href="{{ route('categories.show', $category->slug) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>{{ \App\Helpers\LanguageHelper::get('explore_dept') }}</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-slate-200">
                <i class="fas fa-hospital-user text-5xl text-slate-300 mb-4"></i>
                <p class="text-slate-500 font-semibold">No clinical departments listed at the moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
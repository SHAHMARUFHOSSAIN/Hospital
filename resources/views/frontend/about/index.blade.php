@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('about_us') . ' — CarePlus Hospital')

@section('content')
<section class="py-20 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-hospital"></i> {{ \App\Helpers\LanguageHelper::get('about_us') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">{{ \App\Helpers\LanguageHelper::get('site_name') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-base font-semibold">Leading tertiary care multi-specialty hospital dedicated to clinical excellence and patient safety.</p>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=1000&q=80" alt="CarePlus Hospital Building" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
            </div>

            <div class="space-y-6">
                <h2 class="text-3xl font-extrabold text-slate-900">World-Class Tertiary Healthcare Infrastructure</h2>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">
                    CarePlus Hospital &amp; Research Center is equipped with 500+ beds, 24/7 Level-1 Trauma &amp; Emergency response units, robotic surgical suites, 3.0T MRI, 128-slice CT scan, and dedicated ICU/CCU/NICU beds.
                </p>
                <p class="text-slate-600 text-sm leading-relaxed font-medium">
                    Our medical board comprises renowned senior consultants, international board-certified surgeons, and 24/7 dedicated medical attendants providing compassionate patient-centered care.
                </p>
                <div class="pt-4 flex flex-wrap gap-4">
                    <a href="{{ route('directors') }}" class="px-6 py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow transition">
                        {{ \App\Helpers\LanguageHelper::get('find_doctors') }} &rarr;
                    </a>
                    <a href="{{ route('categories') }}" class="px-6 py-3 bg-slate-100 hover:bg-sky-50 text-slate-700 font-extrabold text-xs rounded-full transition">
                        {{ \App\Helpers\LanguageHelper::get('specialties') }} &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@extends('layouts.frontend')

@section('title', \App\Helpers\LanguageHelper::get('featured_doctors') . ' — CarePlus')

@section('content')
<section class="py-20 bg-gradient-to-b from-[#F0F9FF] to-slate-50 text-slate-900 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-user-doctor"></i> {{ \App\Helpers\LanguageHelper::get('featured_doctors') }}
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">{{ \App\Helpers\LanguageHelper::get('find_doctors') }}</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-base font-semibold">{{ \App\Helpers\LanguageHelper::get('featured_doctors_sub') }}</p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse(($directors ?? \App\Models\Director::where('is_active', true)->get()) as $doctor)
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <!-- Clickable Photo -> Doctor Profile Details Page -->
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="block aspect-square rounded-2xl mb-6 overflow-hidden shadow-md ring-2 ring-slate-100 relative group-hover:ring-[#0284C7] transition-all">
                        <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=600&q=80';">
                    </a>

                    <!-- Clickable Name -> Doctor Profile Details Page -->
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="block font-extrabold text-xl text-slate-900 mb-1 hover:text-[#0284C7] transition-colors leading-tight">
                        {{ $doctor->name }}
                    </a>

                    <p class="text-xs font-bold text-[#0284C7] uppercase tracking-wider mb-2">{{ $doctor->designation }}</p>
                    <p class="text-[11px] font-bold text-slate-600 bg-sky-50 px-2.5 py-1 rounded-lg inline-block mb-3">{{ $doctor->degree ?: 'MBBS, FCPS' }}</p>
                    <p class="text-slate-500 text-xs leading-relaxed mb-6 font-medium line-clamp-3">{{ $doctor->bio }}</p>
                </div>

                <!-- View Profile & Book Appointment Button -->
                <a href="{{ route('doctors.show', $doctor->slug) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>{{ \App\Helpers\LanguageHelper::get('view_profile') }}</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-400 font-bold">No doctors listed in directory.</div>
            @endforelse
        </div>
    </div>
</section>
@endsection

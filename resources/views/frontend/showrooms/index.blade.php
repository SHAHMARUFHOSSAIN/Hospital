@extends('layouts.frontend')

@section('title', 'Hospital Campuses & Outpatient Clinics — CarePoint Hospital')

@section('content')
<section class="py-20 bg-gradient-to-b from-[#0F172A] to-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-slate-800 text-sky-300 border border-slate-700 mb-4">
            <i class="fas fa-building-circle-check"></i> Hospital Network
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold tracking-tight">Our Hospital Campuses &amp; Clinics</h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#0284C7] to-[#06B6D4] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-300 max-w-2xl mx-auto text-base">Visit our main tertiary hospital campus, 24/7 ER center, or outpatient consultation clinics.</p>
    </div>
</section>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-2 gap-8">
            @forelse(\App\Models\Showroom::where('is_active', true)->orderBy('sort_order')->get() as $center)
            <div class="bg-white rounded-3xl p-8 border border-slate-200/80 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between">
                <div>
                    <div class="w-16 h-16 rounded-2xl bg-sky-50 text-[#0284C7] flex items-center justify-center text-3xl mb-6 shadow-sm">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <span class="inline-block px-3 py-1 bg-sky-100 text-sky-700 font-extrabold text-[10px] uppercase tracking-wider rounded-full mb-3">
                        24/7 Medical Center
                    </span>
                    <h3 class="font-extrabold text-2xl text-slate-900 mb-2">{{ $center->name }}</h3>
                    <p class="text-slate-500 text-sm leading-relaxed mb-6">{{ $center->description }}</p>
                    
                    <div class="space-y-3 border-t border-slate-100 pt-4 mb-6 text-sm text-slate-600 font-medium">
                        <div class="flex items-start gap-3">
                            <i class="fas fa-location-dot mt-1 text-[#0284C7]"></i>
                            <span>{{ $center->address }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone text-[#0284C7]"></i>
                            <span>{{ $center->phone }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-[#0284C7]"></i>
                            <span>{{ $center->email }}</span>
                        </div>
                    </div>
                </div>
                <a href="{{ route('home') }}#appointment" class="w-full py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-bold text-xs text-center rounded-xl shadow transition">
                    Book OPD Appointment Here
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-20 bg-white rounded-3xl border border-slate-200">
                <i class="fas fa-hospital text-5xl text-slate-300 mb-4"></i>
                <p class="text-slate-500 font-semibold">No hospital locations listed.</p>
            </div>
            @endforelse
        </div>

        <!-- Live Google Map Location -->
        <div class="mt-16 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-wider block mb-1">LIVE GOOGLE MAP LOCATION</span>
                    <h3 class="font-extrabold text-2xl text-slate-900">CarePlus Main Hospital Campus Map</h3>
                    <p class="text-xs text-slate-500 font-semibold mt-0.5">Uttara Sector 7, Main Medical Drive, Dhaka, Bangladesh.</p>
                </div>
                <a href="https://maps.google.com/?q=Sector+7+Uttara+Dhaka+Bangladesh" target="_blank" class="px-5 py-2.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-md transition flex items-center gap-2">
                    <i class="fas fa-location-arrow"></i>
                    <span>Get Directions</span>
                </a>
            </div>

            <div class="w-full h-[400px] rounded-2xl overflow-hidden shadow-inner border border-slate-200 relative bg-slate-100">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.4038848419614!2d90.38927937604104!3d23.87532398452427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c465f24794e7%3A0xe5a3f3a8b4173873!2sSector%207%2C%20Uttara%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade" 
                    class="w-full h-full rounded-2xl border-0">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection
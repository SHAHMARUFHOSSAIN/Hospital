@extends('layouts.frontend')

@section('content')

<!-- 1. HERO SECTION WITH DOCTOR SEARCH BAR & HIGH-RES HERO IMAGE -->
<section class="bg-gradient-to-b from-[#F0F9FF] via-[#E0F2FE]/40 to-[#F8FAFC] py-16 sm:py-24 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left Copy & Search Bar -->
            <div class="lg:col-span-7 space-y-6">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-white border border-sky-100 rounded-full shadow-sm">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-pulse"></span>
                    <span class="text-xs font-extrabold uppercase tracking-widest text-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('top_rated_network') }}</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-slate-900 tracking-tight leading-[1.15]">
                    {!! nl2br(e(\App\Helpers\LanguageHelper::get('hero_title'))) !!}
                </h1>
                <p class="text-lg sm:text-xl text-slate-600 font-medium">
                    {{ \App\Helpers\LanguageHelper::get('hero_subtitle') }}
                </p>

                <!-- Premium Spacious Doctor Search Bar -->
                <div class="bg-white p-4 sm:p-5 rounded-3xl shadow-xl shadow-sky-500/10 border border-sky-100 mt-8 backdrop-blur-md">
                    <form action="{{ route('directors') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-3 items-center">
                        
                        <!-- Input 1: Search Doctor / Keyword (4 cols) -->
                        <div class="lg:col-span-4 flex items-center gap-3 px-4 py-3 bg-slate-50 hover:bg-sky-50/50 rounded-2xl border border-slate-200/80 focus-within:border-[#0284C7] focus-within:ring-2 focus-within:ring-sky-100 transition-all">
                            <i class="fas fa-magnifying-glass text-[#0284C7] text-base shrink-0"></i>
                            <input type="text" name="search" placeholder="{{ \App\Helpers\LanguageHelper::get('search_placeholder') }}"
                                class="w-full text-xs sm:text-sm font-semibold text-slate-800 placeholder-slate-400 focus:outline-none bg-transparent">
                        </div>

                        <!-- Dropdown 2: Location (3 cols) -->
                        <div class="lg:col-span-3 flex items-center gap-3 px-4 py-3 bg-slate-50 hover:bg-sky-50/50 rounded-2xl border border-slate-200/80 focus-within:border-[#0284C7] transition-all text-xs sm:text-sm font-semibold text-slate-700">
                            <i class="fas fa-location-dot text-[#0284C7] shrink-0"></i>
                            <select name="location" class="w-full bg-transparent focus:outline-none cursor-pointer text-slate-800 font-semibold">
                                <option value="">{{ \App\Helpers\LanguageHelper::get('all_locations') }}</option>
                                <option value="dhaka">Main Hospital (Uttara)</option>
                                <option value="gulshan">Gulshan Special OPD</option>
                                <option value="dhanmondi">Dhanmondi Consultation Center</option>
                            </select>
                        </div>

                        <!-- Dropdown 3: Specialty (3 cols) -->
                        <div class="lg:col-span-3 flex items-center gap-3 px-4 py-3 bg-slate-50 hover:bg-sky-50/50 rounded-2xl border border-slate-200/80 focus-within:border-[#0284C7] transition-all text-xs sm:text-sm font-semibold text-slate-700">
                            <i class="fas fa-stethoscope text-[#0284C7] shrink-0"></i>
                            <select name="category" class="w-full bg-transparent focus:outline-none cursor-pointer text-slate-800 font-semibold">
                                <option value="">{{ \App\Helpers\LanguageHelper::get('all_specialties') }}</option>
                                @foreach(($categories ?? \App\Models\Category::where('is_active', true)->get()) as $cat)
                                    <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Submit Button (2 cols) -->
                        <div class="lg:col-span-2">
                            <button type="submit" class="w-full py-3.5 px-6 bg-gradient-to-r from-[#0284C7] to-[#0369A1] hover:from-sky-500 hover:to-[#0284C7] text-white font-extrabold text-xs sm:text-sm rounded-2xl shadow-lg shadow-sky-500/25 transition-all hover:scale-105 flex items-center justify-center gap-2 whitespace-nowrap">
                                <span>{{ \App\Helpers\LanguageHelper::get('find_now') }}</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Visual Doctor Image Banner -->
            <div class="lg:col-span-5 relative flex justify-center">
                <div class="relative w-full max-w-md">
                    <div class="aspect-[4/5] rounded-3xl overflow-hidden shadow-2xl border-4 border-white relative group">
                        <img src="https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80" alt="Dr. Samir Sven — Senior Neurosurgeon"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent"></div>

                        <!-- Floating Verified Doctor Badge -->
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-md px-3.5 py-1.5 rounded-full shadow-md border border-white/40 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            <span class="text-[10px] font-extrabold uppercase tracking-wider text-slate-800">{{ \App\Helpers\LanguageHelper::get('doctors_online') }}</span>
                        </div>

                        <!-- Floating Rating Badge -->
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 backdrop-blur-md p-4 rounded-2xl shadow-xl border border-sky-100 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-500 flex items-center justify-center font-extrabold text-sm shadow-sm">
                                    <i class="fas fa-star"></i>
                                </div>
                                <div>
                                    <div class="text-xs font-extrabold text-slate-900">4.9 / 5.0 Rating</div>
                                    <div class="text-[10px] text-slate-500 font-semibold">10,000+ Verified Patient Reviews</div>
                                </div>
                            </div>
                            <span class="px-3 py-1 bg-sky-100 text-[#0284C7] font-extrabold text-[10px] rounded-full uppercase tracking-wider">Top Rated</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 1.5 24/7 EMERGENCY AMBULANCE & LIVE BLOOD BANK STOCK WIDGET (LUXURY REDESIGN) -->
<section class="py-14 bg-gradient-to-r from-slate-950 via-rose-950/80 to-slate-950 text-white relative shadow-2xl border-y border-rose-900/40 overflow-hidden">
    <!-- Ambient Neon Pulse Light -->
    <div class="absolute top-1/2 left-1/4 -translate-y-1/2 w-96 h-96 bg-rose-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
            
            <!-- Left Info -->
            <div class="space-y-3 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 bg-rose-500/20 text-rose-300 border border-rose-500/40 text-[11px] font-extrabold uppercase rounded-full shadow-lg backdrop-blur-md">
                    <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
                    <i class="fas fa-droplet text-rose-400"></i> Real-Time Emergency Network
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
                    24/7 Live Blood Bank &amp; ICU Ambulance Dispatch
                </h2>
                <p class="text-xs sm:text-sm text-rose-200/90 font-medium max-w-xl">
                    Instant real-time blood group stock verification and 24/7 emergency ICU ambulance hotline.
                </p>
            </div>

            <!-- Right Blood Stocks Ticker & Call Button -->
            <div class="w-full lg:w-auto flex flex-col sm:flex-row items-center justify-center lg:justify-end gap-4">
                @if(isset($bloodStocks) && $bloodStocks->count())
                <div class="w-full sm:w-auto overflow-x-auto scrollbar-thin p-1 max-w-full">
                    <div class="inline-flex items-center gap-2.5 bg-slate-950/90 backdrop-blur-md p-2.5 sm:p-3 rounded-2xl border border-rose-900/50 shadow-2xl shrink-0">
                        @foreach($bloodStocks as $stock)
                        <div class="px-3 sm:px-3.5 py-2 rounded-xl bg-gradient-to-b from-rose-950/80 to-slate-950 border border-rose-500/30 text-center transition-all hover:scale-105 hover:border-rose-400 shadow-md shrink-0 min-w-[65px]">
                            <span class="text-rose-400 font-black text-xs sm:text-sm block tracking-wide">{{ $stock->blood_group }}</span>
                            <span class="text-[9px] sm:text-[10px] text-slate-300 font-extrabold whitespace-nowrap">{{ $stock->units_available }} Bags</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <a href="tel:1-800-CARE-NOW" class="w-full sm:w-auto px-7 py-3.5 sm:py-4 bg-gradient-to-r from-rose-600 to-red-600 hover:from-rose-500 hover:to-red-500 text-white font-black text-xs rounded-full shadow-[0_0_25px_rgba(225,29,72,0.4)] transition-all hover:scale-105 flex items-center justify-center gap-2.5 uppercase tracking-wider shrink-0">
                    <i class="fas fa-ambulance text-sm animate-bounce"></i>
                    <span>Call Ambulance Dispatch</span>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- 1.8 3D INTERACTIVE ANATOMY & SYMPTOM DEPARTMENT FINDER (MESMERIZING REDESIGN) -->
<section class="py-24 bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 text-white relative overflow-hidden">
    <!-- Glowing background accents -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-sky-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-40 -right-40 w-96 h-96 bg-indigo-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-widest bg-sky-500/20 text-sky-300 border border-sky-500/40 mb-3 shadow-lg backdrop-blur-md">
                <i class="fas fa-child-reaching text-[#0284C7] animate-pulse"></i> 3D Hologram Anatomy Visualizer
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight">
                {{ \App\Helpers\LanguageHelper::get('body_finder_title') }}
            </h2>
            <p class="text-slate-400 text-xs sm:text-sm font-medium mt-3">
                {{ \App\Helpers\LanguageHelper::get('body_finder_subtitle') }}
            </p>
        </div>

        <!-- Quick Organ Pills Bar -->
        <div class="flex flex-wrap items-center justify-center gap-3 mb-14" id="organPillContainer">
            <button type="button" class="organ-pill-btn active px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-[#0284C7] text-white border-[#0284C7] shadow-[0_0_20px_rgba(2,132,199,0.4)]" data-organ="heart">
                <i class="fas fa-heart-pulse mr-2 text-rose-300"></i> {{ \App\Helpers\LanguageHelper::get('organ_heart') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="brain">
                <i class="fas fa-brain mr-2 text-sky-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_brain') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="bones">
                <i class="fas fa-bone mr-2 text-indigo-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_bones') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="lungs">
                <i class="fas fa-lungs mr-2 text-cyan-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_lungs') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="stomach">
                <i class="fas fa-notes-medical mr-2 text-emerald-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_stomach') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="kidney">
                <i class="fas fa-vial mr-2 text-purple-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_kidney') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="eyes">
                <i class="fas fa-eye mr-2 text-amber-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_eyes') }}
            </button>
            <button type="button" class="organ-pill-btn px-5 py-3 rounded-full text-xs font-extrabold transition-all border bg-slate-900/90 text-slate-300 border-slate-800 hover:border-sky-500/50 hover:text-white backdrop-blur-md" data-organ="pediatric">
                <i class="fas fa-baby mr-2 text-pink-400"></i> {{ \App\Helpers\LanguageHelper::get('organ_pediatric') }}
            </button>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left Realistic 3D Medical Human Body Anatomy Visualizer (Full Body Head-to-Toe 360° Rotation) -->
            <div class="lg:col-span-6 flex justify-center">
                <div class="relative w-full max-w-md h-[650px] bg-gradient-to-b from-slate-950 via-slate-900 to-slate-950 rounded-3xl border border-slate-800/90 p-5 flex flex-col items-center justify-center shadow-[0_0_50px_rgba(2,132,199,0.15)] overflow-hidden ring-1 ring-slate-800 group">
                    
                    <!-- Grid Background Effect -->
                    <div class="absolute inset-0 bg-[radial-gradient(#0284c7_1px,transparent_1px)] [background-size:16px_16px] opacity-20 pointer-events-none"></div>

                    <!-- 360 Degree Turntable Rotation Badge -->
                    <div class="absolute top-4 left-4 z-20 bg-slate-950/90 backdrop-blur-md px-3.5 py-1.5 rounded-full border border-sky-500/30 flex items-center gap-2 pointer-events-none shadow-md">
                        <i class="fas fa-rotate text-sky-400 text-xs animate-spin" style="animation-duration: 8s;"></i>
                        <span class="text-[10px] font-extrabold text-sky-300 uppercase tracking-widest">Full Body 360° 3D Rotation</span>
                    </div>

                    <!-- Realistic 3D Medical Human Anatomy Frame (Full Height Head to Toe) -->
                    <div class="relative w-full h-[580px] flex items-center justify-center overflow-hidden [perspective:1000px]">
                        
                        <!-- 360 Rotating Full Body Container -->
                        <div class="relative w-full h-full flex items-center justify-center animate-3d-rotate duration-1000">
                            
                            <!-- High-Definition Full Body 3D Medical Human Anatomy Image -->
                            <img src="{{ asset('images/real-3d-human-anatomy.webp') }}" alt="Full Body 3D Medical Human Anatomy Model"
                                class="w-auto h-[550px] max-h-full object-contain filter drop-shadow-[0_0_25px_rgba(2,132,199,0.35)]"
                                id="realHumanBodyImg">

                            <!-- ACCURATE ORGAN GLOWING INTERACTIVE HOTSPOTS -->
                            
                            <!-- 1. Brain & Head Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[3%] left-[50%] -translate-x-1/2 z-30 group" data-organ="brain" title="Brain & Head">
                                <span class="w-8 h-8 rounded-full bg-sky-500/40 flex items-center justify-center ring-2 ring-sky-400 animate-pulse shadow-[0_0_15px_#0284c7]">
                                    <i class="fas fa-brain text-sky-200 text-xs"></i>
                                </span>
                                <span class="absolute left-10 top-0 bg-slate-950/95 text-sky-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-sky-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Brain &amp; Head (মস্তিষ্ক)
                                </span>
                            </button>

                            <!-- 2. Lungs & Respiratory Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[19%] left-[36%] -translate-x-1/2 z-30 group" data-organ="lungs" title="Lungs & Respiratory">
                                <span class="w-8 h-8 rounded-full bg-cyan-500/40 flex items-center justify-center ring-2 ring-cyan-400 animate-pulse shadow-[0_0_15px_#06b6d4]">
                                    <i class="fas fa-lungs text-cyan-200 text-xs"></i>
                                </span>
                                <span class="absolute right-10 top-0 bg-slate-950/95 text-cyan-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-cyan-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Lungs (ফুসফুস)
                                </span>
                            </button>

                            <!-- 3. Heart & Cardiac Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[21%] left-[62%] -translate-x-1/2 z-30 group" data-organ="heart" title="Heart & Chest">
                                <span class="w-9 h-9 rounded-full bg-rose-500/40 flex items-center justify-center ring-2 ring-rose-400 animate-pulse shadow-[0_0_18px_#f43f5e]">
                                    <i class="fas fa-heart-pulse text-rose-200 text-sm"></i>
                                </span>
                                <span class="absolute left-11 top-0 bg-slate-950/95 text-rose-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-rose-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Heart (হৃদপিন্ড)
                                </span>
                            </button>

                            <!-- 4. Liver & Gallbladder Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[35%] left-[40%] -translate-x-1/2 z-30 group" data-organ="stomach" title="Liver & Stomach">
                                <span class="w-8 h-8 rounded-full bg-amber-500/40 flex items-center justify-center ring-2 ring-amber-400 animate-pulse shadow-[0_0_15px_#f59e0b]">
                                    <i class="fas fa-notes-medical text-amber-200 text-xs"></i>
                                </span>
                            </button>

                            <!-- 5. Stomach & Gastric Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[37%] left-[60%] -translate-x-1/2 z-30 group" data-organ="stomach" title="Stomach & Gastric">
                                <span class="w-8 h-8 rounded-full bg-emerald-500/40 flex items-center justify-center ring-2 ring-emerald-400 animate-pulse shadow-[0_0_15px_#10b981]">
                                    <i class="fas fa-prescription-bottle-medical text-emerald-200 text-xs"></i>
                                </span>
                                <span class="absolute left-10 top-0 bg-slate-950/95 text-emerald-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-emerald-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Stomach (পাকস্থলী)
                                </span>
                            </button>

                            <!-- 6. Intestines & Digestive Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[54%] left-[50%] -translate-x-1/2 z-30 group" data-organ="stomach" title="Intestines & Digestion">
                                <span class="w-9 h-9 rounded-full bg-pink-500/40 flex items-center justify-center ring-2 ring-pink-400 animate-pulse shadow-[0_0_16px_#ec4899]">
                                    <i class="fas fa-stethoscope text-pink-200 text-xs"></i>
                                </span>
                                <span class="absolute left-11 top-0 bg-slate-950/95 text-pink-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-pink-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Intestines (আন্ত্রিক হজম)
                                </span>
                            </button>

                            <!-- 7. Kidneys & Pelvis Hotspot -->
                            <button type="button" class="body-hotspot-btn absolute top-[70%] left-[50%] -translate-x-1/2 z-30 group" data-organ="kidney" title="Kidneys & Urinary">
                                <span class="w-8 h-8 rounded-full bg-purple-500/40 flex items-center justify-center ring-2 ring-purple-400 animate-pulse shadow-[0_0_15px_#a855f7]">
                                    <i class="fas fa-vial text-purple-200 text-xs"></i>
                                </span>
                                <span class="absolute left-10 top-0 bg-slate-950/95 text-purple-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-purple-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Kidneys (কিডনি)
                                </span>
                            </button>

                            <!-- 8. Thighs, Legs & Vascular System Hotspot (Head-to-Toe) -->
                            <button type="button" class="body-hotspot-btn absolute top-[86%] left-[50%] -translate-x-1/2 z-30 group" data-organ="bones" title="Legs & Vascular">
                                <span class="w-8 h-8 rounded-full bg-indigo-500/40 flex items-center justify-center ring-2 ring-indigo-400 animate-pulse shadow-[0_0_15px_#6366f1]">
                                    <i class="fas fa-bone text-indigo-200 text-xs"></i>
                                </span>
                                <span class="absolute left-10 top-0 bg-slate-950/95 text-indigo-300 text-[10px] font-extrabold px-2.5 py-1 rounded-full border border-indigo-500/40 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                                    Legs &amp; Bones (পা ও রক্তনালী)
                                </span>
                            </button>

                        </div>

                        <!-- Glowing Holographic Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-transparent to-slate-950/50 pointer-events-none"></div>

                    </div>

                    <div class="absolute bottom-4 text-center z-20 pointer-events-none">
                        <span class="text-[10px] font-bold text-slate-300 bg-slate-950/95 px-3.5 py-1.5 rounded-full border border-slate-800 shadow-md">
                            <i class="fas fa-arrows-spin text-sky-400 mr-1 animate-spin" style="animation-duration:4s;"></i> Full Body Head-to-Toe 360° Rotation Visualizer
                        </span>
                    </div>

                </div>
            </div>

            <!-- Right Interactive Organ Details & Recommended Department Panel (LUXURY DESK REDESIGN) -->
            <div class="lg:col-span-6">
                <div class="bg-slate-900/95 backdrop-blur-xl rounded-3xl p-8 border border-slate-800/90 shadow-[0_0_50px_rgba(2,132,199,0.1)] space-y-7 relative overflow-hidden" id="organDetailPanel">
                    
                    <!-- Dynamic Organ Header -->
                    <div class="flex items-center justify-between border-b border-slate-800/80 pb-6">
                        <div class="flex items-center gap-5">
                            <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-rose-500/30 to-rose-950/40 text-rose-400 border border-rose-500/40 flex items-center justify-center text-3xl shadow-lg ring-4 ring-rose-500/10" id="panelOrganIcon">
                                <i class="fas fa-heart-pulse"></i>
                            </div>
                            <div>
                                <span class="text-[11px] font-black text-sky-400 uppercase tracking-widest block mb-0.5" id="panelCategoryTag">Cardiovascular Division</span>
                                <h3 class="text-2xl sm:text-3xl font-black text-white leading-tight tracking-tight" id="panelOrganTitle">Heart &amp; Chest (হৃদপিন্ড ও বুক)</h3>
                            </div>
                        </div>
                        <span class="px-3.5 py-1.5 bg-emerald-500/20 text-emerald-300 border border-emerald-500/40 text-[10px] font-black uppercase rounded-full shadow-md backdrop-blur-md shrink-0" id="panelStatusBadge">24/7 ICU Ready</span>
                    </div>

                    <!-- Symptoms Breakdown -->
                    <div class="space-y-2">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-file-medical text-sky-400"></i> Common Symptoms &amp; Clinical Indicators (রোগলক্ষণসমূহ)
                        </h4>
                        <div class="bg-slate-950/90 p-5 rounded-2xl border border-slate-800 text-xs sm:text-sm text-slate-200 font-semibold leading-relaxed shadow-inner" id="panelSymptomsText">
                            • Chest pain, tightness, or pressure radiating to arm or jaw.<br>
                            • Shortness of breath, dizziness, or palpitations.<br>
                            • High blood pressure &amp; irregular heart rhythm.
                        </div>
                    </div>

                    <!-- Recommended Department -->
                    <div class="p-5 bg-gradient-to-r from-sky-950/60 via-slate-950 to-sky-950/60 rounded-2xl border border-sky-500/40 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-lg">
                        <div>
                            <span class="text-[10px] uppercase font-black text-sky-400 block tracking-wider">Recommended Department (প্রস্তাবিত বিভাগ)</span>
                            <h5 class="text-lg font-extrabold text-white mt-1" id="panelDeptName">Cardiology &amp; Heart Center</h5>
                        </div>
                        <a href="{{ route('categories') }}" id="panelDeptLink" class="w-full sm:w-auto px-5 py-3 bg-gradient-to-r from-[#0284C7] to-[#0369A1] hover:from-sky-500 hover:to-[#0284C7] text-white font-extrabold text-xs rounded-full shadow-lg transition-all hover:scale-105 text-center shrink-0">
                            Explore Department &rarr;
                        </a>
                    </div>

                    <!-- Available Specialist Doctors -->
                    <div class="space-y-3">
                        <h4 class="text-xs font-black text-slate-400 uppercase tracking-widest flex items-center gap-2">
                            <i class="fas fa-user-doctor text-sky-400"></i> On-Call Organ Specialist
                        </h4>
                        <div class="p-5 bg-slate-950/90 rounded-2xl border border-slate-800/90 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-md">
                            <div class="flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80" class="w-14 h-14 rounded-2xl object-cover border-2 border-sky-500/30 shrink-0 shadow-md" id="panelDocPhoto">
                                <div>
                                    <h5 class="font-black text-base text-white" id="panelDocName">Dr. Sarah Chen</h5>
                                    <p class="text-xs text-sky-400 font-bold mt-0.5" id="panelDocDegree">Chief Cardiologist — MBBS, FCPS (Cardiology)</p>
                                </div>
                            </div>
                            <a href="#appointment" class="w-full sm:w-auto px-5 py-3 bg-[#0284C7] hover:bg-sky-500 text-white font-extrabold text-xs rounded-full shadow-lg transition-all hover:scale-105 shrink-0 flex items-center justify-center gap-2">
                                <span>Book Doctor</span>
                                <i class="fas fa-arrow-right text-[10px]"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>
</section>

<!-- Vanilla JS State Management for 3D Body Symptom Finder -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const organData = {
        heart: {
            icon: 'fa-heart-pulse',
            iconColor: 'bg-rose-500/20 text-rose-400 border-rose-500/30',
            category: 'Cardiovascular Division',
            title: 'Heart & Chest (হৃদপিন্ড ও বুক)',
            symptoms: '• Chest pain, tightness, or pressure radiating to arm or jaw.\n• Shortness of breath, dizziness, or palpitations.\n• High blood pressure & irregular heart rhythm.',
            deptName: 'Cardiology & Heart Center',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Sarah Chen',
            docDegree: 'Chief Cardiologist — MBBS, FCPS (Cardiology)',
            docPhoto: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80'
        },
        brain: {
            icon: 'fa-brain',
            iconColor: 'bg-indigo-500/20 text-indigo-400 border-indigo-500/30',
            category: 'Neurological Sciences',
            title: 'Brain, Head & Spine (মস্তিষ্ক ও স্নায়ুতন্ত্র)',
            symptoms: '• Severe headache, migraine, or sudden dizziness.\n• Numbness in face or limbs, speech difficulty (Stroke signs).\n• Seizures, memory loss, or spinal back numbness.',
            deptName: 'Neurology & Neurosurgery',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Samir Sven',
            docDegree: 'Senior Neurosurgeon — MBBS, MS (Neurosurgery)',
            docPhoto: 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80'
        },
        bones: {
            icon: 'fa-bone',
            iconColor: 'bg-emerald-500/20 text-emerald-400 border-emerald-500/30',
            category: 'Orthopedic & Joint Care',
            title: 'Bones, Spine & Joints (হাড়, কোমর ও জয়েন্ট)',
            symptoms: '• Joint swelling, knee pain, or arthritis stiffness.\n• Bone fractures, ligament tears, or sports injury.\n• Chronic lower back pain & spinal disc herniation.',
            deptName: 'Orthopedics & Joint Care',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Tanvir Ahmed',
            docDegree: 'Senior Orthopedic Surgeon — MBBS, MS (Orthopedics)',
            docPhoto: 'https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=800&q=80'
        },
        lungs: {
            icon: 'fa-lungs',
            iconColor: 'bg-cyan-500/20 text-cyan-400 border-cyan-500/30',
            category: 'Pulmonology Division',
            title: 'Lungs & Airway (ফুসফুস ও শ্বাসযন্ত্র)',
            symptoms: '• Persistent coughing, wheezing, or asthma tightness.\n• Shortness of breath during exertion.\n• Respiratory infections, bronchitis, or chest congestion.',
            deptName: 'Emergency & Trauma Care',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Sarah Chen',
            docDegree: 'Consultant Pulmonologist — MBBS, MD',
            docPhoto: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80'
        },
        stomach: {
            icon: 'fa-notes-medical',
            iconColor: 'bg-amber-500/20 text-amber-400 border-amber-500/30',
            category: 'Gastroenterology Division',
            title: 'Stomach, Liver & Abdomen (পাকস্থলী ও হরমোন)',
            symptoms: '• Severe abdominal pain, hyper-acidity, or ulcer.\n• Liver disorders, jaundice, or gallstone distress.\n• Indigestion, nausea, or bowel irregularity.',
            deptName: 'Diagnostic & Imaging Lab',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Nusrat Jahan',
            docDegree: 'Consultant Gastroenterologist — MBBS, FCPS',
            docPhoto: 'https://images.unsplash.com/photo-1594824813570-78a335626111?auto=format&fit=crop&w=800&q=80'
        },
        kidney: {
            icon: 'fa-vial',
            iconColor: 'bg-purple-500/20 text-purple-400 border-purple-500/30',
            category: 'Nephrology & Urology',
            title: 'Kidneys & Urinary Tract (কিডনি ও মূত্রনালী)',
            symptoms: '• Lower back flank pain, kidney stone colic.\n• Burning sensation during urination or blood in urine.\n• Swelling in legs or face due to fluid retention.',
            deptName: 'Diagnostic & Imaging Lab',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Samir Sven',
            docDegree: 'Senior Consultant Urologist — MBBS, MS',
            docPhoto: 'https://images.unsplash.com/photo-1622253692010-333f2da6031d?auto=format&fit=crop&w=800&q=80'
        },
        eyes: {
            icon: 'fa-eye',
            iconColor: 'bg-amber-500/20 text-amber-400 border-amber-500/30',
            category: 'Ophthalmology Wing',
            title: 'Eyes & Vision Care (চোখ ও দৃষ্টিশক্তি)',
            symptoms: '• Blurry vision, double vision, or eye strain.\n• Cataract cloudiness or glaucoma pressure pain.\n• Redness, itching, or diabetic retinopathy.',
            deptName: 'Diagnostic & Imaging Lab',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Sarah Chen',
            docDegree: 'Eye Specialist & Surgeon — MBBS, DO',
            docPhoto: 'https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80'
        },
        pediatric: {
            icon: 'fa-baby',
            iconColor: 'bg-pink-500/20 text-pink-400 border-pink-500/30',
            category: 'Pediatric & Child Care',
            title: 'Child & Infant Care (শিশু ও নবজাতক অঙ্গ)',
            symptoms: '• High fever, cold, or childhood immunization.\n• Infant feeding difficulties or growth delay.\n• Newborn jaundice or pediatric infections.',
            deptName: 'Pediatrics & Child Health',
            deptLink: '{{ route("categories") }}',
            docName: 'Dr. Nusrat Jahan',
            docDegree: 'Professor of Pediatrics — MBBS, FCPS',
            docPhoto: 'https://images.unsplash.com/photo-1594824813570-78a335626111?auto=format&fit=crop&w=800&q=80'
        }
    };

    const pillBtns = document.querySelectorAll('.organ-pill-btn');
    const hotspotBtns = document.querySelectorAll('.body-hotspot-btn');

    function updateOrganView(organKey) {
        const data = organData[organKey] || organData.heart;
        
        // Update Pill Buttons Styling
        pillBtns.forEach(btn => {
            if (btn.getAttribute('data-organ') === organKey) {
                btn.classList.remove('bg-slate-900', 'text-slate-300', 'border-slate-800');
                btn.classList.add('bg-[#0284C7]', 'text-white', 'border-[#0284C7]', 'shadow-lg');
            } else {
                btn.classList.remove('bg-[#0284C7]', 'text-white', 'border-[#0284C7]', 'shadow-lg');
                btn.classList.add('bg-slate-900', 'text-slate-300', 'border-slate-800');
            }
        });

        // Update Panel Content
        document.getElementById('panelOrganIcon').className = `w-14 h-14 rounded-2xl ${data.iconColor} border flex items-center justify-center text-2xl shadow-inner`;
        document.getElementById('panelOrganIcon').innerHTML = `<i class="fas ${data.icon}"></i>`;
        document.getElementById('panelCategoryTag').textContent = data.category;
        document.getElementById('panelOrganTitle').textContent = data.title;
        document.getElementById('panelSymptomsText').innerHTML = data.symptoms.replace(/\n/g, '<br>');
        document.getElementById('panelDeptName').textContent = data.deptName;
        document.getElementById('panelDeptLink').href = data.deptLink;
        document.getElementById('panelDocPhoto').src = data.docPhoto;
        document.getElementById('panelDocName').textContent = data.docName;
        document.getElementById('panelDocDegree').textContent = data.docDegree;
    }

    pillBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const key = this.getAttribute('data-organ');
            updateOrganView(key);
        });
    });

    hotspotBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const key = this.getAttribute('data-organ');
            updateOrganView(key);
        });
    });
});
</script>

<!-- THREE.JS CDN FOR REAL 3D ROTATING HUMAN ANATOMY -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvasContainer = document.getElementById('threeDCanvasContainer');
    if (!canvasContainer || typeof THREE === 'undefined') return;

    const width = canvasContainer.clientWidth || 320;
    const height = canvasContainer.clientHeight || 460;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(45, width / height, 0.1, 1000);
    camera.position.set(0, 0.2, 4.2);

    const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(width, height);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    canvasContainer.appendChild(renderer.domElement);

    // Group holding the 3D Human Model
    const humanGroup = new THREE.Group();
    scene.add(humanGroup);

    // 1. Futuristic Cyan Wireframe Shader Material
    const bodyMaterial = new THREE.MeshBasicMaterial({
        color: 0x0284c7,
        wireframe: true,
        transparent: true,
        opacity: 0.5
    });

    // 2. Build 3D Human Anatomy Mesh Parts
    // Head Sphere
    const headGeo = new THREE.SphereGeometry(0.35, 16, 16);
    const headMesh = new THREE.Mesh(headGeo, bodyMaterial);
    headMesh.position.set(0, 1.45, 0);
    humanGroup.add(headMesh);

    // Neck
    const neckGeo = new THREE.CylinderGeometry(0.12, 0.14, 0.25, 12);
    const neckMesh = new THREE.Mesh(neckGeo, bodyMaterial);
    neckMesh.position.set(0, 1.15, 0);
    humanGroup.add(neckMesh);

    // Chest & Torso
    const torsoGeo = new THREE.CylinderGeometry(0.45, 0.35, 1.1, 16);
    const torsoMesh = new THREE.Mesh(torsoGeo, bodyMaterial);
    torsoMesh.position.set(0, 0.5, 0);
    humanGroup.add(torsoMesh);

    // Pelvis
    const pelvisGeo = new THREE.CylinderGeometry(0.35, 0.28, 0.4, 14);
    const pelvisMesh = new THREE.Mesh(pelvisGeo, bodyMaterial);
    pelvisMesh.position.set(0, -0.25, 0);
    humanGroup.add(pelvisMesh);

    // Left Arm
    const armGeo = new THREE.CylinderGeometry(0.08, 0.06, 1.2, 12);
    const leftArm = new THREE.Mesh(armGeo, bodyMaterial);
    leftArm.position.set(-0.6, 0.4, 0);
    leftArm.rotation.z = 0.15;
    humanGroup.add(leftArm);

    // Right Arm
    const rightArm = new THREE.Mesh(armGeo, bodyMaterial);
    rightArm.position.set(0.6, 0.4, 0);
    rightArm.rotation.z = -0.15;
    humanGroup.add(rightArm);

    // Left Leg
    const legGeo = new THREE.CylinderGeometry(0.12, 0.08, 1.4, 12);
    const leftLeg = new THREE.Mesh(legGeo, bodyMaterial);
    leftLeg.position.set(-0.2, -1.1, 0);
    humanGroup.add(leftLeg);

    // Right Leg
    const rightLeg = new THREE.Mesh(legGeo, bodyMaterial);
    rightLeg.position.set(0.2, -1.1, 0);
    humanGroup.add(rightLeg);

    // 3. Add Glowing Organ Hotspot Spheres in 3D Space
    const organ3DNodes = {};

    function addOrgan3DNode(key, colorHex, x, y, z, size = 0.09) {
        const geo = new THREE.SphereGeometry(size, 16, 16);
        const mat = new THREE.MeshBasicMaterial({ color: colorHex, wireframe: false });
        const mesh = new THREE.Mesh(geo, mat);
        mesh.position.set(x, y, z);
        humanGroup.add(mesh);
        organ3DNodes[key] = mesh;
    }

    addOrgan3DNode('brain', 0x38bdf8, 0, 1.48, 0, 0.1);
    addOrgan3DNode('eyes', 0xf59e0b, 0, 1.48, 0.32, 0.07);
    addOrgan3DNode('heart', 0xf43f5e, 0.14, 0.72, 0.22, 0.11);
    addOrgan3DNode('lungs', 0x06b6d4, -0.16, 0.76, 0.2, 0.1);
    addOrgan3DNode('stomach', 0x10b981, 0, 0.35, 0.25, 0.1);
    addOrgan3DNode('kidney', 0xa855f7, 0.14, 0.1, -0.2, 0.09);
    addOrgan3DNode('bones', 0x6366f1, -0.2, -0.7, 0.1, 0.09);
    addOrgan3DNode('pediatric', 0xec4899, 0.15, -0.25, 0.18, 0.09);

    // 4. Slow Continuous 360-Degree Turntable Rotation + Drag Control
    let isDragging = false;
    let previousMouseX = 0;

    canvasContainer.addEventListener('mousedown', (e) => {
        isDragging = true;
        previousMouseX = e.clientX;
    });

    window.addEventListener('mouseup', () => { isDragging = false; });

    canvasContainer.addEventListener('mousemove', (e) => {
        if (isDragging) {
            const deltaX = e.clientX - previousMouseX;
            humanGroup.rotation.y += deltaX * 0.01;
            previousMouseX = e.clientX;
        }
    });

    // Touch support for mobile devices
    canvasContainer.addEventListener('touchstart', (e) => {
        if (e.touches.length === 1) {
            isDragging = true;
            previousMouseX = e.touches[0].clientX;
        }
    });

    window.addEventListener('touchend', () => { isDragging = false; });

    canvasContainer.addEventListener('touchmove', (e) => {
        if (isDragging && e.touches.length === 1) {
            const deltaX = e.touches[0].clientX - previousMouseX;
            humanGroup.rotation.y += deltaX * 0.01;
            previousMouseX = e.touches[0].clientX;
        }
    });

    // Animation Loop (Slow continuous 360° rotation)
    function animate() {
        requestAnimationFrame(animate);

        if (!isDragging) {
            humanGroup.rotation.y += 0.006; // Smooth 360-degree slow rotation
        }

        // Pulse 3D organ nodes
        const time = Date.now() * 0.005;
        Object.values(organ3DNodes).forEach(node => {
            node.scale.setScalar(1 + Math.sin(time) * 0.15);
        });

        renderer.render(scene, camera);
    }

    animate();

    window.addEventListener('resize', () => {
        const w = canvasContainer.clientWidth;
        const h = canvasContainer.clientHeight;
        if (w && h) {
            camera.aspect = w / h;
            camera.updateProjectionMatrix();
            renderer.setSize(w, h);
        }
    });
});
</script>

<!-- 2. DEPARTMENT CATEGORIES SECTION WITH DYNAMIC CLINICAL DEPARTMENTS -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="flex items-center justify-between mb-10">
            <div class="text-left">
                <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">CENTERS OF EXCELLENCE</span>
                <h2 class="text-3xl font-extrabold text-slate-900">{{ \App\Helpers\LanguageHelper::get('department_categories') }}</h2>
            </div>
            <a href="{{ route('categories') }}" class="text-xs font-extrabold text-[#0284C7] hover:underline hidden sm:inline-block">{{ \App\Helpers\LanguageHelper::get('view_all_departments') }} &rarr;</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-6">
            @foreach(($categories ?? \App\Models\Category::where('is_active', true)->orderBy('sort_order')->get()) as $cat)
            <a href="{{ route('categories.show', $cat->slug) }}" class="group flex flex-col items-center p-5 rounded-3xl bg-white hover:bg-sky-50/70 border border-slate-200/80 hover:border-sky-200 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-1">
                <div class="relative w-20 h-20 mb-4 rounded-2xl overflow-hidden shadow-md ring-4 ring-sky-50 group-hover:ring-[#0284C7] transition-all bg-sky-100 flex items-center justify-center">
                    @if($cat->image_url)
                        <img src="{{ $cat->image_url }}" alt="{{ $cat->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=800&q=80';">
                    @else
                        <div class="w-full h-full bg-[#0284C7] text-white flex items-center justify-center text-2xl group-hover:scale-110 transition-transform duration-500">
                            <i class="fas {{ $cat->medical_icon }}"></i>
                        </div>
                    @endif
                </div>
                <h3 class="font-extrabold text-sm text-slate-900 group-hover:text-[#0284C7] transition-colors leading-tight text-center">{{ $cat->name }}</h3>
                <span class="text-[10px] font-bold text-slate-400 mt-1">Explore &rarr;</span>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- 3. FEATURED DOCTORS SECTION — DYNAMIC DBL-CLICK TO DOCTOR DETAILS PAGE -->
<section class="py-20 bg-slate-50 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
            <div>
                <h2 class="text-xs font-extrabold text-slate-400 uppercase tracking-[0.25em] mb-1">{{ \App\Helpers\LanguageHelper::get('featured_doctors') }}</h2>
                <p class="text-slate-600 text-sm font-semibold">{{ \App\Helpers\LanguageHelper::get('featured_doctors_sub') }}</p>
            </div>
            <a href="{{ route('directors') }}" class="px-5 py-2.5 bg-white border border-sky-100 text-[#0284C7] font-extrabold text-xs rounded-full shadow-sm hover:bg-sky-50 transition">
                {{ \App\Helpers\LanguageHelper::get('view_all_doctors') }} &rarr;
            </a>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse(($directors ?? \App\Models\Director::where('is_active', true)->orderBy('sort_order')->get()) as $doctor)
            <div class="card-careplus p-5 text-center flex flex-col justify-between group">
                <div>
                    <!-- Click Photo -> Doctor Profile Details Page -->
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="block aspect-square rounded-2xl mb-5 overflow-hidden shadow-md ring-2 ring-slate-100 relative group-hover:ring-[#0284C7] transition-all">
                        <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}"
                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=800&q=80';">
                    </a>

                    <!-- Click Doctor Name -> Doctor Profile Details Page -->
                    <a href="{{ route('doctors.show', $doctor->slug) }}" class="block font-extrabold text-lg text-slate-900 group-hover:text-[#0284C7] transition-colors leading-tight mb-1">
                        {{ $doctor->name }}
                    </a>
                    <p class="text-xs text-slate-500 font-semibold mb-2">{{ $doctor->designation }}</p>
                    <p class="text-[10px] font-bold text-[#0284C7] bg-sky-50 px-2.5 py-1 rounded-full inline-block mb-3">{{ $doctor->degree ?: 'MBBS, FCPS' }}</p>

                    <!-- Rating -->
                    <div class="flex items-center justify-center gap-1 bg-amber-50 px-3 py-1 rounded-full text-amber-600 text-xs font-extrabold mb-5 border border-amber-200/50">
                        <i class="fas fa-star text-amber-400"></i> 4.9 Rating
                    </div>
                </div>

                <!-- Click Button -> Doctor Profile Details Page -->
                <a href="{{ route('doctors.show', $doctor->slug) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-md shadow-sky-500/20 transition-all hover:scale-105 flex items-center justify-center gap-2">
                    <span>{{ \App\Helpers\LanguageHelper::get('view_profile') }}</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-400 font-bold">No doctors available.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- 3.5 EXECUTIVE HEALTH SCREENING PACKAGES SECTION -->
@if(isset($healthPackages) && $healthPackages->count())
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">EXECUTIVE SCREENING</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Health Checkup &amp; Screening Packages</h2>
            </div>
            <a href="{{ route('products') }}" class="text-xs font-extrabold text-[#0284C7] hover:underline">View All Medical Services &rarr;</a>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($healthPackages as $pkg)
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-7 border border-slate-200 hover:border-sky-300">
                <div>
                    <div class="w-full aspect-video rounded-2xl overflow-hidden mb-5 bg-slate-100 relative shadow-inner">
                        <img src="{{ $pkg->thumbnail_url }}" alt="{{ $pkg->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="font-extrabold text-xl text-slate-900 mb-2 group-hover:text-[#0284C7] transition-colors leading-tight">{{ $pkg->name }}</h3>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed mb-6 line-clamp-3">{{ $pkg->description }}</p>
                </div>
                <a href="{{ route('products.show', $pkg->slug) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>Book Package Now</span>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 3.6 HOSPITAL PHOTO GALLERY & VIDEO TOUR SHOWCASE -->
<section class="py-20 bg-slate-900 text-white relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col sm:flex-row items-center justify-between mb-12 gap-4">
            <div>
                <span class="inline-flex items-center gap-2 px-3.5 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-widest bg-sky-500/20 text-sky-300 border border-sky-500/30 mb-2">
                    <i class="fas fa-video"></i> Virtual Tour &amp; Campus
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-white">Hospital Video Tour &amp; Photo Gallery</h2>
            </div>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-center">
            <!-- Left Video Player Widget -->
            <div class="lg:col-span-7">
                <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-slate-800 bg-slate-950">
                    <iframe class="w-full h-full" src="{{ $factoryVideoUrl }}" title="Hospital Video Tour" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>

            <!-- Right Photo Gallery Grid -->
            <div class="lg:col-span-5 grid grid-cols-2 gap-4">
                @if(isset($gallery) && $gallery->count())
                    @foreach($gallery->take(4) as $item)
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-800 border border-slate-700 relative group">
                        <img src="{{ $item->url ?: asset('storage/' . $item->file_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-slate-950/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-xs font-bold text-white p-2 text-center">
                            {{ $item->title ?: 'Hospital Infrastructure' }}
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-800 border border-slate-700"><img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover"></div>
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-800 border border-slate-700"><img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover"></div>
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-800 border border-slate-700"><img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover"></div>
                    <div class="aspect-square rounded-2xl overflow-hidden bg-slate-800 border border-slate-700"><img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=400&q=80" class="w-full h-full object-cover"></div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- 3.7 LIVE HOSPITAL IMPACT & SUCCESS COUNTERS WITH ANIMATED SCROLL COUNTER -->
<section class="py-16 bg-gradient-to-r from-[#0284C7] via-[#0369A1] to-[#0284C7] text-white relative overflow-hidden shadow-xl" id="impactCountersSection">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            
            <!-- Counter 1: Patients -->
            <div class="p-5 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="text-4xl sm:text-5xl font-extrabold mb-1 font-mono tracking-tight text-white drop-shadow-md">
                    <span class="counter-value" data-target="50000" data-format="comma" data-suffix="+">0</span>
                </div>
                <div class="text-xs uppercase tracking-wider text-sky-100 font-extrabold mt-1">Happy Patients Treated</div>
            </div>

            <!-- Counter 2: Doctors -->
            <div class="p-5 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="text-4xl sm:text-5xl font-extrabold mb-1 font-mono tracking-tight text-white drop-shadow-md">
                    <span class="counter-value" data-target="150" data-suffix="+">0</span>
                </div>
                <div class="text-xs uppercase tracking-wider text-sky-100 font-extrabold mt-1">Certified Doctors</div>
            </div>

            <!-- Counter 3: Success Rate -->
            <div class="p-5 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="text-4xl sm:text-5xl font-extrabold mb-1 font-mono tracking-tight text-white drop-shadow-md">
                    <span class="counter-value" data-target="99.8" data-decimals="1" data-suffix="%">0.0</span>
                </div>
                <div class="text-xs uppercase tracking-wider text-sky-100 font-extrabold mt-1">Surgical Success Rate</div>
            </div>

            <!-- Counter 4: Hotline & ICU -->
            <div class="p-5 rounded-3xl bg-white/10 backdrop-blur-md border border-white/20 shadow-lg hover:scale-105 transition-transform duration-300">
                <div class="text-4xl sm:text-5xl font-extrabold mb-1 font-mono tracking-tight text-white drop-shadow-md">
                    <span class="counter-value" data-target="24" data-suffix="/7">0</span>
                </div>
                <div class="text-xs uppercase tracking-wider text-sky-100 font-extrabold mt-1">ICU &amp; Emergency Beds</div>
            </div>

        </div>
    </div>
</section>

<!-- Scroll Observer Count-Up Animation Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const counterSection = document.getElementById('impactCountersSection');
    const counters = document.querySelectorAll('.counter-value');
    let animated = false;

    function animateCounters() {
        counters.forEach(counter => {
            const target = parseFloat(counter.getAttribute('data-target'));
            const suffix = counter.getAttribute('data-suffix') || '';
            const isComma = counter.getAttribute('data-format') === 'comma';
            const decimals = parseInt(counter.getAttribute('data-decimals') || '0');
            const duration = 2200; // 2.2 seconds silky smooth animation
            const startTime = performance.now();

            function update(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);
                
                // EaseOutCubic function for smooth slowing down at end
                const easeProgress = 1 - Math.pow(1 - progress, 3);
                const currentVal = target * easeProgress;

                let formattedVal = decimals > 0 
                    ? currentVal.toFixed(decimals) 
                    : Math.floor(currentVal).toString();

                if (isComma) {
                    formattedVal = parseInt(formattedVal).toLocaleString();
                }

                counter.textContent = formattedVal + suffix;

                if (progress < 1) {
                    requestAnimationFrame(update);
                } else {
                    let finalVal = decimals > 0 ? target.toFixed(decimals) : target.toString();
                    if (isComma) finalVal = target.toLocaleString();
                    counter.textContent = finalVal + suffix;
                }
            }

            requestAnimationFrame(update);
        });
    }

    if ('IntersectionObserver' in window && counterSection) {
        const observer = new IntersectionObserver((entries) => {
            if (entries[0].isIntersecting && !animated) {
                animated = true;
                animateCounters();
            }
        }, { threshold: 0.2 });
        observer.observe(counterSection);
    } else {
        animateCounters();
    }
});
</script>

<!-- 3.8 HEALTH ARTICLES & MEDICAL TIPS BLOG -->
@if(isset($healthBlogs) && $healthBlogs->count())
<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-12">
            <div>
                <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">DOCTOR INSIGHTS</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Health Articles &amp; Medical Tips</h2>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($healthBlogs as $article)
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-6 border border-slate-200">
                <div>
                    <div class="w-full aspect-video rounded-2xl overflow-hidden mb-5 bg-slate-100 relative shadow-inner">
                        <img src="{{ $article->image_url }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80';">
                        <span class="absolute top-3 right-3 px-3 py-1 bg-slate-900/80 backdrop-blur-md text-white text-[10px] font-extrabold uppercase rounded-full">
                            {{ $article->category }}
                        </span>
                    </div>
                    <h3 class="font-extrabold text-lg text-slate-900 mb-2 group-hover:text-[#0284C7] transition-colors leading-tight">{{ $article->title }}</h3>
                    <p class="text-xs text-slate-500 font-bold mb-3"><i class="fas fa-user-doctor text-[#0284C7] mr-1"></i> {{ $article->author }}</p>
                    <p class="text-xs text-slate-600 font-medium leading-relaxed mb-6 line-clamp-3">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 3.9 CAREER & JOB VACANCIES SECTION -->
@php
    $careerJobs = \App\Models\Job::where('is_active', true)->orderBy('sort_order')->take(4)->get();
@endphp
@if($careerJobs->count())
<section class="py-20 bg-white border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-12 gap-4">
            <div>
                <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">CAREER &amp; RECRUITMENT</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Hospital Career Vacancies &amp; Open Positions</h2>
                <p class="text-slate-500 text-xs font-semibold mt-1">Join our medical &amp; administrative healthcare team.</p>
            </div>
            <a href="{{ route('career') }}" class="px-5 py-2.5 bg-sky-50 text-[#0284C7] font-extrabold text-xs rounded-full border border-sky-100 hover:bg-[#0284C7] hover:text-white transition shadow-sm">
                View All Job Posts &rarr;
            </a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            @foreach($careerJobs as $job)
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm hover:shadow-xl hover:border-sky-200 transition-all flex flex-col justify-between group">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="px-3 py-1 bg-sky-100 text-[#0284C7] text-[10px] font-extrabold uppercase rounded-full">
                            {{ $job->type ?: 'Full-time' }}
                        </span>
                        <span class="text-[11px] text-slate-400 font-bold">
                            <i class="fas fa-location-dot text-[#0284C7] mr-1"></i>{{ $job->location ?: 'Dhaka Main Campus' }}
                        </span>
                    </div>

                    <a href="{{ route('career.show', $job->slug) }}" class="block text-xl font-extrabold text-slate-900 group-hover:text-[#0284C7] transition-colors leading-tight mb-2">
                        {{ $job->title }}
                    </a>

                    <p class="text-xs text-slate-600 font-medium leading-relaxed mb-4 line-clamp-2">
                        {{ $job->description }}
                    </p>
                </div>

                <div class="pt-4 border-t border-slate-100 flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-500 truncate max-w-[200px]">
                        <i class="fas fa-user-check text-[#0284C7] mr-1"></i> {{ $job->requirements ?: 'Medical Qualification' }}
                    </span>
                    <a href="{{ route('career.show', $job->slug) }}" class="px-4 py-2 bg-[#0284C7] hover:bg-[#0369A1] text-white text-xs font-extrabold rounded-full transition shadow-sm flex items-center gap-1.5">
                        <span>Apply Now</span>
                        <i class="fas fa-chevron-right text-[10px]"></i>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 4. SIMPLE BOOKING PROCESS SECTION -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-xs font-extrabold text-slate-400 uppercase tracking-[0.25em] mb-12">{{ \App\Helpers\LanguageHelper::get('simple_booking_process') }}</h2>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Step 1 -->
            <div class="card-careplus p-7 text-center relative group border-t-4 border-t-[#0284C7]">
                <span class="w-8 h-8 rounded-full bg-[#0284C7] text-white font-extrabold text-xs flex items-center justify-center mx-auto mb-5 shadow-md">1</span>
                <div class="w-16 h-16 rounded-2xl bg-sky-50 text-[#0284C7] flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0284C7] group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-magnifying-glass"></i>
                </div>
                <h3 class="font-extrabold text-base text-slate-900 mb-2">{{ \App\Helpers\LanguageHelper::get('step_1_title') }}</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-5">{{ \App\Helpers\LanguageHelper::get('step_1_sub') }}</p>
                <a href="#appointment" class="inline-block px-4 py-2 bg-sky-50 hover:bg-[#0284C7] text-[#0284C7] hover:text-white text-[11px] font-extrabold rounded-full transition shadow-sm">{{ \App\Helpers\LanguageHelper::get('book_appointment') }}</a>
            </div>

            <!-- Step 2 -->
            <div class="card-careplus p-7 text-center relative group border-t-4 border-t-[#0284C7]">
                <span class="w-8 h-8 rounded-full bg-[#0284C7] text-white font-extrabold text-xs flex items-center justify-center mx-auto mb-5 shadow-md">2</span>
                <div class="w-16 h-16 rounded-2xl bg-sky-50 text-[#0284C7] flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0284C7] group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-user-doctor"></i>
                </div>
                <h3 class="font-extrabold text-base text-slate-900 mb-2">{{ \App\Helpers\LanguageHelper::get('step_2_title') }}</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-5">{{ \App\Helpers\LanguageHelper::get('step_2_sub') }}</p>
                <a href="#appointment" class="inline-block px-4 py-2 bg-sky-50 hover:bg-[#0284C7] text-[#0284C7] hover:text-white text-[11px] font-extrabold rounded-full transition shadow-sm">{{ \App\Helpers\LanguageHelper::get('book_appointment') }}</a>
            </div>

            <!-- Step 3 -->
            <div class="card-careplus p-7 text-center relative group border-t-4 border-t-[#0284C7]">
                <span class="w-8 h-8 rounded-full bg-[#0284C7] text-white font-extrabold text-xs flex items-center justify-center mx-auto mb-5 shadow-md">3</span>
                <div class="w-16 h-16 rounded-2xl bg-sky-50 text-[#0284C7] flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0284C7] group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-calendar-days"></i>
                </div>
                <h3 class="font-extrabold text-base text-slate-900 mb-2">{{ \App\Helpers\LanguageHelper::get('step_3_title') }}</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-5">{{ \App\Helpers\LanguageHelper::get('step_3_sub') }}</p>
                <a href="#appointment" class="inline-block px-4 py-2 bg-sky-50 hover:bg-[#0284C7] text-[#0284C7] hover:text-white text-[11px] font-extrabold rounded-full transition shadow-sm">{{ \App\Helpers\LanguageHelper::get('book_appointment') }}</a>
            </div>

            <!-- Step 4 -->
            <div class="card-careplus p-7 text-center relative group border-t-4 border-t-[#0284C7]">
                <span class="w-8 h-8 rounded-full bg-[#0284C7] text-white font-extrabold text-xs flex items-center justify-center mx-auto mb-5 shadow-md">4</span>
                <div class="w-16 h-16 rounded-2xl bg-sky-50 text-[#0284C7] flex items-center justify-center text-2xl mx-auto mb-4 group-hover:bg-[#0284C7] group-hover:text-white transition-all shadow-sm">
                    <i class="fas fa-clipboard-check"></i>
                </div>
                <h3 class="font-extrabold text-base text-slate-900 mb-2">{{ \App\Helpers\LanguageHelper::get('step_4_title') }}</h3>
                <p class="text-xs text-slate-500 font-medium leading-relaxed mb-5">{{ \App\Helpers\LanguageHelper::get('step_4_sub') }}</p>
                <a href="#appointment" class="inline-block px-4 py-2 bg-sky-50 hover:bg-[#0284C7] text-[#0284C7] hover:text-white text-[11px] font-extrabold rounded-full transition shadow-sm">{{ \App\Helpers\LanguageHelper::get('book_appointment') }}</a>
            </div>

        </div>
    </div>
</section>

<!-- 4.5 INTERACTIVE PATIENT FAQ ACCORDION -->
@if(isset($faqs) && $faqs->count())
<section class="py-20 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">PATIENT HELP DESK</span>
            <h2 class="text-3xl font-extrabold text-slate-900">Frequently Asked Questions (FAQ)</h2>
        </div>

        <div class="space-y-4">
            @foreach($faqs as $faq)
            <details class="group bg-white rounded-2xl border border-slate-200 shadow-sm p-6 [&_summary::-webkit-details-marker]:hidden cursor-pointer">
                <summary class="flex items-center justify-between gap-4 font-extrabold text-base text-slate-900">
                    <span><i class="fas fa-circle-question text-[#0284C7] mr-2"></i> {{ $faq->question }}</span>
                    <span class="w-8 h-8 rounded-full bg-sky-50 text-[#0284C7] flex items-center justify-center shrink-0 group-open:rotate-180 transition-transform">
                        <i class="fas fa-chevron-down text-xs"></i>
                    </span>
                </summary>
                <div class="mt-4 text-xs text-slate-600 font-semibold leading-relaxed pt-3 border-t border-slate-100">
                    {{ $faq->answer }}
                </div>
            </details>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- 4.8 ACCREDITED INSURANCE PARTNERS SHOWCASE (AUTO SCROLLING MARQUEE TICKER) -->
@if(isset($brands) && $brands->count())
<section class="py-16 bg-gradient-to-b from-slate-50 to-white border-t border-slate-200 overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-8">
        <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.25em] block mb-2">ACCREDITED HEALTHCARE ALLIANCES</span>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Trusted Insurance Partners &amp; Corporate Networks</h3>
    </div>

    <!-- Fade Gradient Edge Overlays for Smooth Marquee Look -->
    <div class="relative w-full overflow-hidden">
        <div class="absolute top-0 bottom-0 left-0 w-24 bg-gradient-to-r from-slate-50 to-transparent z-10 pointer-events-none"></div>
        <div class="absolute top-0 bottom-0 right-0 w-24 bg-gradient-to-l from-slate-50 to-transparent z-10 pointer-events-none"></div>

        <!-- Marquee Track (Repeated for Smooth Seamless Infinite Loop) -->
        <div class="flex gap-6 animate-marquee hover:[animation-play-state:paused] whitespace-nowrap py-2">
            @foreach($brands->concat($brands)->concat($brands)->concat($brands) as $brand)
            <div class="p-4 bg-white hover:bg-sky-50 rounded-2xl border border-slate-200/90 transition-all group flex items-center gap-3 shadow-sm hover:shadow-md shrink-0 cursor-pointer">
                <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center font-extrabold text-base shadow-sm border border-sky-200 overflow-hidden shrink-0">
                    @if($brand->image_url)
                        <img src="{{ $brand->image_url }}" alt="{{ $brand->title }}" class="w-full h-full object-cover" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="hidden w-full h-full items-center justify-center bg-sky-100 text-[#0284C7]">
                            <i class="fas fa-building-shield"></i>
                        </div>
                    @else
                        <i class="fas fa-building-shield"></i>
                    @endif
                </div>
                <span class="font-extrabold text-sm text-slate-800 group-hover:text-[#0284C7] transition-colors pr-2">{{ $brand->title }}</span>
            </div>
            @endforeach
        </div>
    </div>
</section>

<style>
@keyframes marquee {
  0% { transform: translateX(0%); }
  100% { transform: translateX(-50%); }
}
.animate-marquee {
  display: flex;
  width: max-content;
  animation: marquee 22s linear infinite;
}
</style>
@endif

<!-- 5. PATIENT TESTIMONIALS SECTION WITH REAL USER AVATARS -->
<section class="py-20 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-xs font-extrabold text-slate-400 uppercase tracking-[0.25em] mb-12">{{ \App\Helpers\LanguageHelper::get('patient_testimonials') }}</h2>

        <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto">
            
            <!-- Testimonial 1 -->
            <div class="card-careplus p-7 text-left flex items-start gap-4 hover:border-sky-200">
                <img src="{{ asset('images/placeholders/doctor-male.svg') }}" alt="John D."
                    class="w-14 h-14 rounded-full object-cover shrink-0 border-2 border-white shadow-md"
                    onerror="this.onerror=null; this.src='{{ asset('images/placeholders/doctor-male.svg') }}';">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-extrabold text-slate-900 text-sm">John D.</h4>
                        <div class="flex text-amber-400 text-xs gap-1">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 font-semibold italic">"Excellent service and skilled doctors! The booking process was so simple and fast."</p>
                </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="card-careplus p-7 text-left flex items-start gap-4 hover:border-sky-200">
                <img src="{{ asset('images/placeholders/doctor-female.svg') }}" alt="Maria G."
                    class="w-14 h-14 rounded-full object-cover shrink-0 border-2 border-white shadow-md"
                    onerror="this.onerror=null; this.src='{{ asset('images/placeholders/doctor-female.svg') }}';">
                <div class="space-y-2">
                    <div class="flex items-center justify-between">
                        <h4 class="font-extrabold text-slate-900 text-sm">Maria G.</h4>
                        <div class="flex text-amber-400 text-xs gap-1">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-600 font-semibold italic">"Easy to use platform, found the best care for my family within minutes!"</p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- 6. RED/BLUE 24/7 EMERGENCY HOTLINE BANNER -->
<section class="relative bg-gradient-to-r from-[#DC2626] via-[#B91C1C] to-[#0284C7] text-white py-16 text-center overflow-hidden shadow-2xl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-4">
        <span class="inline-block px-4 py-1 bg-white/20 text-white font-extrabold text-[11px] uppercase tracking-widest rounded-full backdrop-blur-md">
            24/7 EMERGENCY HOTLINE
        </span>
        <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight drop-shadow-md">
            {{ \App\Helpers\LanguageHelper::get('emergency_help') }}
        </h2>
        <p class="text-white/90 text-sm sm:text-base font-semibold max-w-xl mx-auto">
            {{ \App\Helpers\LanguageHelper::get('emergency_sub') }}
        </p>
        <div class="pt-4">
            <a href="tel:1-800-CARE-NOW" class="inline-flex items-center gap-3 px-8 py-4 bg-white text-slate-900 hover:bg-slate-100 font-extrabold text-base sm:text-lg rounded-full shadow-2xl transition hover:scale-105">
                <i class="fas fa-phone text-red-600 animate-bounce"></i>
                <span>{{ \App\Helpers\LanguageHelper::get('call_now') }}</span>
            </a>
        </div>
    </div>
</section>

<!-- 7. INTERACTIVE APPOINTMENT FORM SECTION WITH SPECIFIC DOCTOR SELECTION -->
<section id="appointment" class="py-20 bg-white">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-careplus p-8 sm:p-12 border-2 border-sky-100 shadow-xl">
            <div class="text-center mb-8">
                <span class="inline-block px-4 py-1 bg-sky-100 text-[#0284C7] font-extrabold text-xs uppercase tracking-widest rounded-full mb-2">Fast Scheduling</span>
                <h3 class="font-extrabold text-2xl sm:text-3xl text-slate-900">{{ \App\Helpers\LanguageHelper::get('doctor_consultation') }}</h3>
                <p class="text-xs text-slate-500 font-semibold mt-1">Select your preferred doctor &amp; date slot. Get instant serial number.</p>
            </div>

            @if(session('custom_order_success'))
            <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-start gap-3 text-sm font-medium">
                <i class="fas fa-circle-check text-emerald-600 mt-0.5 text-lg"></i>
                <p>{{ session('custom_order_success') }}</p>
            </div>
            @endif

            <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('patient_name') }} *</label>
                        <input type="text" name="name" required placeholder="Full Name"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('email_address') }} *</label>
                        <input type="email" name="email" required placeholder="patient@example.com"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('phone_number') }} *</label>
                        <input type="tel" name="phone" required placeholder="+880 1700 000000"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition" value="{{ old('phone') }}">
                    </div>

                    <!-- SELECT SPECIFIC DOCTOR DROPDOWN -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('select_doctor') }} *</label>
                        <select name="doctor_id" required class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition cursor-pointer">
                            <option value="">Choose Specialist Doctor...</option>
                            @foreach(($directors ?? \App\Models\Director::where('is_active', true)->get()) as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->name }} ({{ $doc->designation }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('appointment_date') }}</label>
                        <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Specialty Department</label>
                        <select name="company" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition">
                            <option value="Cardiology">Cardiology</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="Orthopedics">Orthopedics</option>
                            <option value="Neurology">Neurology</option>
                            <option value="Oncology">Oncology</option.
                            <option value="Maternity">Maternity</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('symptoms_notes') }}</label>
                    <textarea name="message" rows="3" placeholder="Specify health symptoms or preferred chamber time slot..."
                        class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs sm:text-sm font-semibold transition resize-none">{{ old('message') }}</textarea>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                    <span>{{ \App\Helpers\LanguageHelper::get('confirm_booking') }}</span>
                    <i class="fas fa-check-circle"></i>
                </button>
            </form>
        </div>
    </div>
</section>

<!-- 8. HOSPITAL LOCATION & INTERACTIVE GOOGLE MAP SECTION -->
<section class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl p-6 sm:p-10 border border-slate-200 shadow-xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-[0.2em] block mb-1">INTERACTIVE HOSPITAL MAP</span>
                    <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Hospital Location &amp; Directions</h2>
                    <p class="text-xs text-slate-500 font-semibold mt-1">Plot # 12, Main Medical Drive, Sector 7, Uttara, Dhaka-1230, Bangladesh.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="tel:1-800-CARE-NOW" class="px-4 py-2.5 bg-rose-50 text-rose-600 font-extrabold text-xs rounded-full border border-rose-100 flex items-center gap-1.5">
                        <i class="fas fa-phone"></i>
                        <span>1-800-CARE-NOW</span>
                    </a>
                    <a href="https://maps.google.com/?q=Sector+7+Uttara+Dhaka+Bangladesh" target="_blank" class="px-5 py-2.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-md transition flex items-center gap-2">
                        <i class="fas fa-diamond-turn-right"></i>
                        <span>Open Google Maps</span>
                    </a>
                </div>
            </div>

            <div class="w-full h-[450px] rounded-2xl overflow-hidden shadow-inner border border-slate-200 relative bg-slate-100">
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
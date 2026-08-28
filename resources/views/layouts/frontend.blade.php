<!DOCTYPE html>
<html lang="{{ \App\Helpers\LanguageHelper::currentLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', \App\Helpers\LanguageHelper::get('site_name'))</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Noto+Serif+Bengali:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', 'Noto Serif Bengali', sans-serif; }
        html { scroll-behavior: smooth; }
        
        .careplus-blue { color: #0284C7; }
        .bg-careplus-blue { background-color: #0284C7; }
        .bg-careplus-blue:hover { background-color: #0369A1; }
        .bg-careplus-light { background-color: #F0F9FF; }
        
        .card-careplus {
            background: #ffffff;
            border-radius: 1.25rem;
            border: 1px solid #E0F2FE;
            box-shadow: 0 10px 25px -5px rgba(2, 132, 199, 0.08);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-careplus:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 35px -10px rgba(2, 132, 199, 0.18);
            border-color: #BAE6FD;
        }

        .icon-pill {
            width: 4.5rem;
            height: 4.5rem;
            border-radius: 50%;
            background: #E0F2FE;
            color: #0284C7;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            transition: all 0.3s ease;
        }
        .group:hover .icon-pill {
            background: #0284C7;
            color: #ffffff;
            transform: scale(1.08);
        }
    </style>
</head>
<body class="bg-[#F8FAFC] text-slate-800 antialiased selection:bg-[#0284C7] selection:text-white pb-16 sm:pb-0">

    <!-- Red Critical Care Emergency Top Bar -->
    <div class="bg-[#DC2626] text-white text-xs font-bold py-2.5 px-4 text-center tracking-wide">
        <div class="max-w-7xl mx-auto flex items-center justify-center gap-2">
            <span class="w-2 h-2 rounded-full bg-white animate-ping"></span>
            <span>{{ \App\Helpers\LanguageHelper::get('critical_care') }} <a href="tel:1-800-CARE-NOW" class="underline font-extrabold hover:text-red-100">1-800-CARE-NOW</a></span>
        </div>
    </div>

    <!-- CarePlus Clean White Header with Perfect Spacing & Mobile Drawer -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-8 py-3.5">
            <div class="flex items-center justify-between gap-4 sm:gap-6">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2.5 group shrink-0 mr-2 sm:mr-8">
                    <div class="w-10 h-10 rounded-xl bg-[#0284C7] flex items-center justify-center text-white text-xl font-bold shadow-md shadow-sky-500/20 group-hover:scale-105 transition-transform">
                        <i class="fas fa-plus"></i>
                    </div>
                    <span class="font-extrabold text-2xl tracking-tight text-slate-900">Care<span class="text-[#0284C7]">Plus</span></span>
                </a>

                <!-- Desktop Nav Links -->
                <div class="hidden lg:flex items-center gap-5 xl:gap-7 text-xs xl:text-sm font-extrabold tracking-wide whitespace-nowrap">
                    <a href="{{ route('directors') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('find_doctors') }}</a>
                    <a href="{{ route('categories') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('specialties') }}</a>
                    <a href="{{ route('products') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('services') }}</a>
                    <a href="{{ route('cabins.index') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('cabins') }}</a>
                    <a href="{{ route('tests.index') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('tests') }}</a>
                    <a href="{{ route('equipment.index') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('equipment') }}</a>
                    <a href="{{ route('showrooms') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('locations') }}</a>
                    <a href="{{ route('career') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">{{ \App\Helpers\LanguageHelper::get('careers') }}</a>
                    <a href="{{ route('contact') }}" class="text-slate-700 hover:text-[#0284C7] transition py-1 border-b-2 border-transparent hover:border-[#0284C7]">Contact</a>
                </div>

                <!-- Header Action Buttons & Mobile Hamburger Button -->
                <div class="flex items-center gap-2 sm:gap-3 shrink-0">
                    
                    <!-- Language Switcher Toggle Button -->
                    <a href="{{ route('lang.switch', \App\Helpers\LanguageHelper::currentLocale() == 'en' ? 'bn' : 'en') }}"
                        class="px-3 py-1.5 bg-slate-100 hover:bg-sky-50 text-slate-800 hover:text-[#0284C7] text-xs font-extrabold rounded-full border border-slate-200 transition flex items-center gap-1.5 shadow-sm">
                        <i class="fas fa-globe text-[#0284C7]"></i>
                        <span class="hidden sm:inline-block">{{ \App\Helpers\LanguageHelper::get('switch_language') }}</span>
                        <span class="sm:hidden uppercase">{{ \App\Helpers\LanguageHelper::currentLocale() == 'en' ? 'BN' : 'EN' }}</span>
                    </a>

                    <a href="{{ route('login') }}" class="hidden sm:inline-block text-xs font-bold text-slate-700 hover:text-[#0284C7] transition px-2">
                        {{ \App\Helpers\LanguageHelper::get('log_in') }}
                    </a>
                    
                    <a href="{{ route('home') }}#appointment" class="hidden sm:inline-block px-5 py-2 bg-[#0284C7] hover:bg-[#0369A1] text-white text-xs font-extrabold rounded-full shadow-md shadow-sky-500/20 transition-all hover:scale-105">
                        {{ \App\Helpers\LanguageHelper::get('book_now') }}
                    </a>

                    <!-- Mobile Menu Hamburger Button -->
                    <button type="button" id="mobileMenuBtn" class="lg:hidden p-2 rounded-xl text-slate-700 hover:text-[#0284C7] hover:bg-slate-100 transition border border-slate-200 flex items-center justify-center w-10 h-10 shrink-0" aria-label="Toggle Mobile Menu">
                        <i class="fas fa-bars text-xl" id="mobileMenuIcon"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation Overlay -->
        <div id="mobileMenuDrawer" class="hidden lg:hidden bg-white border-b border-slate-200 px-4 pt-3 pb-6 shadow-2xl transition-all duration-300">
            <div class="flex flex-col space-y-2.5 font-extrabold text-sm text-slate-800">
                <a href="{{ route('directors') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-user-doctor"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('find_doctors') }}</span>
                </a>
                <a href="{{ route('categories') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-stethoscope"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('specialties') }}</span>
                </a>
                <a href="{{ route('products') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-briefcase-medical"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('services') }}</span>
                </a>
                <a href="{{ route('cabins.index') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-bed"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('cabins') }}</span>
                </a>
                <a href="{{ route('tests.index') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('tests') }}</span>
                </a>
                <a href="{{ route('equipment.index') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-kit-medical"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('equipment') }}</span>
                </a>
                <a href="{{ route('showrooms') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-location-dot"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('locations') }}</span>
                </a>
                <a href="{{ route('career') }}" class="flex items-center gap-3 p-3 rounded-2xl hover:bg-sky-50 hover:text-[#0284C7] transition border border-slate-100">
                    <div class="w-8 h-8 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center shrink-0">
                        <i class="fas fa-user-gear"></i>
                    </div>
                    <span>{{ \App\Helpers\LanguageHelper::get('careers') }}</span>
                </a>

                <div class="pt-3 border-t border-slate-100 flex flex-col gap-2.5">
                    <a href="{{ route('home') }}#appointment" class="w-full py-3 bg-[#0284C7] text-white text-center font-extrabold text-xs rounded-2xl shadow-md">
                        {{ \App\Helpers\LanguageHelper::get('book_now') }}
                    </a>
                    <a href="{{ route('login') }}" class="w-full py-3 bg-slate-100 text-slate-800 text-center font-extrabold text-xs rounded-2xl border border-slate-200">
                        {{ \App\Helpers\LanguageHelper::get('log_in') }} / Admin Panel
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Mobile Bottom Quick Navigation Bar (For Mobile Phones) -->
    <div class="sm:hidden fixed bottom-0 left-0 right-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200 shadow-[0_-5px_20px_rgba(0,0,0,0.08)] py-2 px-3 flex items-center justify-around text-center">
        <a href="{{ route('home') }}" class="flex flex-col items-center text-[10px] font-extrabold text-slate-600 hover:text-[#0284C7]">
            <i class="fas fa-house text-base mb-0.5 text-[#0284C7]"></i>
            <span>Home</span>
        </a>
        <a href="{{ route('directors') }}" class="flex flex-col items-center text-[10px] font-extrabold text-slate-600 hover:text-[#0284C7]">
            <i class="fas fa-user-doctor text-base mb-0.5 text-[#0284C7]"></i>
            <span>Doctors</span>
        </a>
        <a href="tel:1-800-CARE-NOW" class="flex flex-col items-center text-[10px] font-extrabold text-rose-600">
            <div class="w-9 h-9 rounded-full bg-rose-600 text-white flex items-center justify-center -mt-5 border-4 border-white shadow-lg animate-pulse">
                <i class="fas fa-phone text-xs"></i>
            </div>
            <span class="mt-0.5">Call 24/7</span>
        </a>
        <a href="{{ route('categories') }}" class="flex flex-col items-center text-[10px] font-extrabold text-slate-600 hover:text-[#0284C7]">
            <i class="fas fa-stethoscope text-base mb-0.5 text-[#0284C7]"></i>
            <span>Depts</span>
        </a>
        <a href="{{ route('home') }}#appointment" class="flex flex-col items-center text-[10px] font-extrabold text-slate-600 hover:text-[#0284C7]">
            <i class="fas fa-calendar-check text-base mb-0.5 text-[#0284C7]"></i>
            <span>Book</span>
        </a>
    </div>

    <!-- Mobile Drawer Menu Toggle Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const mobileMenuDrawer = document.getElementById('mobileMenuDrawer');
        const mobileMenuIcon = document.getElementById('mobileMenuIcon');

        if (mobileMenuBtn && mobileMenuDrawer) {
            mobileMenuBtn.addEventListener('click', function () {
                const isHidden = mobileMenuDrawer.classList.contains('hidden');
                if (isHidden) {
                    mobileMenuDrawer.classList.remove('hidden');
                    mobileMenuIcon.classList.remove('fa-bars');
                    mobileMenuIcon.classList.add('fa-xmark');
                } else {
                    mobileMenuDrawer.classList.add('hidden');
                    mobileMenuIcon.classList.remove('fa-xmark');
                    mobileMenuIcon.classList.add('fa-bars');
                }
            });
        }
    });
    </script>

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 py-16 border-t border-slate-800 mt-20 text-xs font-semibold">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10">
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-[#0284C7] flex items-center justify-center text-white text-base font-bold">
                            <i class="fas fa-plus"></i>
                        </div>
                        <span class="font-extrabold text-xl text-white">Care<span class="text-[#0284C7]">Plus</span></span>
                    </div>
                    <p class="text-slate-400 leading-relaxed text-xs">CarePlus Hospital &amp; Research Center is a premier multi-specialty healthcare network providing 24/7 tertiary clinical care.</p>
                </div>
                
                <div>
                    <h4 class="text-white font-extrabold text-sm mb-4 uppercase tracking-wider">Quick Navigation</h4>
                    <ul class="space-y-2.5">
                        <li><a href="{{ route('directors') }}" class="hover:text-white transition">Find Doctors</a></li>
                        <li><a href="{{ route('categories') }}" class="hover:text-white transition">Clinical Departments</a></li>
                        <li><a href="{{ route('products') }}" class="hover:text-white transition">Medical Services</a></li>
                        <li><a href="{{ route('cabins.index') }}" class="hover:text-white transition">Inpatient Cabins</a></li>
                        <li><a href="{{ route('tests.index') }}" class="hover:text-white transition">Diagnostic Tests</a></li>
                        <li><a href="{{ route('career') }}" class="hover:text-white transition">Careers &amp; Vacancies</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-extrabold text-sm mb-4 uppercase tracking-wider">Emergency Hotline</h4>
                    <ul class="space-y-2.5">
                        <li class="text-rose-400 font-extrabold text-sm"><i class="fas fa-phone mr-1"></i> 1-800-CARE-NOW</li>
                        <li><i class="fas fa-clock mr-1 text-sky-400"></i> 24/7 Casualty &amp; Trauma Unit</li>
                        <li><i class="fas fa-ambulance mr-1 text-sky-400"></i> ICU Ambulance Dispatch</li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-extrabold text-sm mb-4 uppercase tracking-wider">Hospital Address</h4>
                    <p class="text-slate-400 leading-relaxed text-xs">CarePlus Hospital &amp; Research Center<br>Plot # 12, Main Medical Drive, Sector 7, Uttara, Dhaka-1230, Bangladesh.</p>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-slate-500 text-[11px]">
                &copy; {{ date('Y') }} CarePlus Hospital &amp; Research Center. All rights reserved.
            </div>
        </div>
    </footer>

</body>
</html>
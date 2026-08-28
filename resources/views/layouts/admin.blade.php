<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CarePlus Hospital Admin — Control Center</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
        [x-cloak] { display: none !important; }
        .scrollbar-thin::-webkit-scrollbar { width: 6px; height: 6px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: rgba(255,255,255,0.1); }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.3); border-radius: 3px; }
        .scrollbar-thin::-webkit-scrollbar-thumb:hover { background: rgba(255,255,255,0.5); }
    </style>
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100">
    <div x-data="{ sidebarOpen: false, sidebarHover: false }" class="min-h-screen">
        <!-- Main wrapper -->
        <div class="flex h-screen">
            <!-- Sidebar -->
            <aside 
                @mouseenter="sidebarHover = true" 
                @mouseleave="sidebarHover = false"
                :class="sidebarHover ? 'w-72' : 'w-20'"
                class="fixed lg:relative z-40 h-screen transition-all duration-300 bg-gradient-to-b from-slate-900 via-slate-950 to-black shadow-2xl overflow-hidden border-r border-slate-800">

                <!-- Logo -->
                <div class="relative z-10 h-16 flex items-center justify-center border-b border-slate-800/80 px-4">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-xl flex items-center justify-center text-white text-lg font-bold shadow-lg shadow-sky-500/20">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div x-show="sidebarHover" class="flex flex-col">
                            <span class="text-white font-extrabold text-lg whitespace-nowrap">Care<span class="text-[#0284C7]">Plus</span> Admin</span>
                            <span class="text-[10px] text-sky-400 font-bold uppercase tracking-widest -mt-1">Hospital CMS Engine</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="relative z-10 mt-4 px-3 space-y-1 overflow-y-auto scrollbar-thin h-[calc(100vh-8rem)] text-xs font-semibold">
                    
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('dashboard') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-chart-line text-lg w-5 text-center"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Dashboard</span>
                    </a>

                    <!-- Appointments -->
                    <a href="{{ route('admin.custom-orders.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all relative {{ request()->routeIs('admin.custom-orders.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-calendar-check text-lg w-5 text-center text-amber-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Doctor Appointments</span>
                        @php $newOrders = \App\Models\CustomOrder::where('status', 'new')->count(); @endphp
                        @if($newOrders > 0)
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 px-2 py-0.5 bg-rose-500 text-white text-[10px] font-extrabold rounded-full animate-bounce">{{ $newOrders }}</span>
                        @endif
                    </a>

                    <!-- Specialist Doctors -->
                    <a href="{{ route('admin.directors.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.directors.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-user-doctor text-lg w-5 text-center text-sky-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Specialist Doctors Directory</span>
                    </a>

                    <!-- Clinical Departments -->
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-hospital-user text-lg w-5 text-center text-teal-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Clinical Departments</span>
                    </a>

                    <!-- Cabins & Ward Rates -->
                    <a href="{{ route('admin.cabins.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.cabins.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-bed-pulse text-lg w-5 text-center text-indigo-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Cabins &amp; Ward Rent Rates</span>
                    </a>

                    <!-- Diagnostic Tests & Rates -->
                    <a href="{{ route('admin.diagnostic-tests.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.diagnostic-tests.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-vial text-lg w-5 text-center text-rose-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Diagnostic Tests &amp; Rates</span>
                    </a>

                    <!-- Medical Machinery & Equipment -->
                    <a href="{{ route('admin.medical-equipments.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.medical-equipments.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-microscope text-lg w-5 text-center text-cyan-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Medical Machinery &amp; Equipment</span>
                    </a>

                    <!-- Services & Packages -->
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.products.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-hand-holding-medical text-lg w-5 text-center text-emerald-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Medical Services &amp; Packages</span>
                    </a>

                    <!-- Specialties & Icons -->
                    <a href="{{ route('admin.button-types.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.button-types.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-notes-medical text-lg w-5 text-center text-[#06B6D4]"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Specialties &amp; Highlights</span>
                    </a>

                    <!-- Hospital Locations -->
                    <a href="{{ route('admin.showrooms.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.showrooms.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-hospital text-lg w-5 text-center text-purple-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Hospital Locations &amp; Centers</span>
                    </a>

                    <!-- Career Vacancies -->
                    <a href="{{ route('admin.jobs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.jobs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-briefcase text-lg w-5 text-center text-pink-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Career Vacancies</span>
                    </a>

                    <!-- Career Applications -->
                    <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.applications.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-file-signature text-lg w-5 text-center text-amber-300"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Career Applications</span>
                    </a>

                    <!-- Emergency Blood Bank Stock -->
                    <a href="{{ route('admin.blood-banks.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.blood-banks.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-droplet text-lg w-5 text-center text-rose-500"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Emergency Blood Bank</span>
                    </a>

                    <!-- Health Articles & Medical Tips -->
                    <a href="{{ route('admin.health-blogs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.health-blogs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-newspaper text-lg w-5 text-center text-emerald-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Health Articles &amp; Blog</span>
                    </a>

                    <!-- Patient FAQs & Help Desk -->
                    <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.faqs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-circle-question text-lg w-5 text-center text-amber-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Patient FAQs &amp; Help Desk</span>
                    </a>

                    <!-- Accreditations & Banners -->
                    <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.media.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                        <i class="fas fa-photo-film text-lg w-5 text-center text-rose-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap">Media, Video Tour &amp; Gallery</span>
                    </a>

                </nav>

                <!-- View Website Link -->
                <div class="absolute bottom-0 left-0 right-0 p-3 border-t border-slate-800 bg-slate-950">
                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                        <i class="fas fa-external-link-alt text-base text-sky-400"></i>
                        <span x-show="sidebarHover" class="whitespace-nowrap font-bold text-xs">View Live CarePlus Site</span>
                    </a>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Top Header -->
                <header class="h-16 bg-slate-900 border-b border-slate-800 flex items-center justify-between px-6">
                    <div class="flex items-center gap-4">
                        <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-lg text-slate-300 hover:text-white hover:bg-slate-800">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h1 class="text-lg font-extrabold text-white">CarePlus Hospital Control Panel</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 bg-[#0284C7] rounded-full flex items-center justify-center text-white font-bold">
                                <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div class="hidden md:block">
                                <p class="text-white font-bold text-xs">{{ Auth::user()->name }}</p>
                                <p class="text-slate-400 text-[10px]">Hospital Administrator</p>
                            </div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="ml-4">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-rose-400 text-xs font-bold transition flex items-center gap-1.5">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                        @endauth
                    </div>
                </header>

                <!-- Page Body -->
                <main class="flex-1 overflow-y-auto bg-slate-950 p-6">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
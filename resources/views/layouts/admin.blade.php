<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
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
        .scrollbar-thin::-webkit-scrollbar { width: 5px; height: 5px; }
        .scrollbar-thin::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
        .scrollbar-thin::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 3px; }
    </style>
</head>
<body class="font-sans antialiased bg-slate-950 text-slate-100 min-h-screen">
    <div x-data="{ mobileMenuOpen: false, sidebarHover: false }" class="min-h-screen flex flex-col lg:flex-row">

        <!-- ==================== MOBILE SLIDE-OUT DRAWER (& BACKDROP) ==================== -->
        <!-- Backdrop -->
        <div x-show="mobileMenuOpen" 
             x-cloak
             @click="mobileMenuOpen = false" 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-50 bg-slate-950/80 backdrop-blur-md lg:hidden"></div>

        <!-- Mobile Drawer Content -->
        <aside x-show="mobileMenuOpen"
               x-cloak
               x-transition:enter="transition ease-out duration-300 transform"
               x-transition:enter-start="-translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-200 transform"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="-translate-x-full"
               class="fixed inset-y-0 left-0 z-50 w-72 bg-gradient-to-b from-slate-900 via-slate-950 to-black shadow-2xl border-r border-slate-800 flex flex-col lg:hidden">
            
            <!-- Mobile Drawer Logo & Close -->
            <div class="h-16 flex items-center justify-between px-4 border-b border-slate-800 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-xl flex items-center justify-center text-white text-base font-bold shadow-lg shadow-sky-500/20 shrink-0">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-white font-extrabold text-base leading-tight">Care<span class="text-[#0284C7]">Plus</span> Admin</span>
                        <span class="text-[9px] text-sky-400 font-bold uppercase tracking-widest">Hospital Control Engine</span>
                    </div>
                </a>
                <button @click="mobileMenuOpen = false" class="p-2 text-slate-400 hover:text-white rounded-lg focus:outline-none">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Mobile Navigation Menu -->
            <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto scrollbar-thin text-xs font-semibold">
                <a href="{{ route('dashboard') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('dashboard') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-chart-line text-base w-5 text-center shrink-0"></i>
                    <span>Dashboard</span>
                </a>

                <!-- ERP Core Modules -->
                <a href="{{ route('admin.patients.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.patients.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-hospital-user text-base w-5 text-center text-teal-400 shrink-0"></i>
                    <span>Patients &amp; UHID Directory</span>
                </a>
                <a href="{{ route('admin.prescriptions.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.prescriptions.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-file-prescription text-base w-5 text-center text-sky-400 shrink-0"></i>
                    <span>Doctor E-Prescriptions (Rx)</span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.invoices.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-file-invoice-dollar text-base w-5 text-center text-amber-400 shrink-0"></i>
                    <span>Invoices &amp; Hospital Billing</span>
                </a>
                <a href="{{ route('admin.lab-reports.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.lab-reports.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-vial text-base w-5 text-center text-purple-400 shrink-0"></i>
                    <span>Diagnostic Lab Reports</span>
                </a>
                <a href="{{ route('admin.inventories.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.inventories.index') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-boxes-stacked text-base w-5 text-center text-cyan-400 shrink-0"></i>
                    <span>Pharmacy &amp; Stock Inventory</span>
                </a>
                <a href="{{ route('admin.inventories.pos') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.inventories.pos') ? 'bg-emerald-600 text-white shadow-lg' : '' }}">
                    <i class="fas fa-cash-register text-base w-5 text-center text-emerald-400 shrink-0"></i>
                    <span>Pharmacy POS Counter</span>
                </a>
                <a href="{{ route('admin.ipd-admissions.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ipd-admissions.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-bed-pulse text-base w-5 text-center text-indigo-400 shrink-0"></i>
                    <span>IPD Inpatient Cabin Admission</span>
                </a>
                <a href="{{ route('admin.blood-donors.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.blood-donors.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-hand-holding-droplet text-base w-5 text-center text-rose-400 shrink-0"></i>
                    <span>Volunteer Blood Donors</span>
                </a>
                <a href="{{ route('admin.ot-schedules.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ot-schedules.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-scissors text-base w-5 text-center text-teal-400 shrink-0"></i>
                    <span>OT &amp; Surgery Scheduler</span>
                </a>
                <a href="{{ route('admin.ambulance-dispatches.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ambulance-dispatches.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-truck-medical text-base w-5 text-center text-sky-400 shrink-0"></i>
                    <span>Emergency Ambulance</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.analytics.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-chart-line text-base w-5 text-center text-emerald-400 shrink-0"></i>
                    <span>Executive Analytics Dashboard</span>
                </a>

                <a href="{{ route('admin.custom-orders.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all relative {{ request()->routeIs('admin.custom-orders.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-calendar-check text-base w-5 text-center text-amber-400 shrink-0"></i>
                    <span>Doctor Appointments</span>
                    @php $newOrders = \App\Models\CustomOrder::where('status', 'new')->count(); @endphp
                    @if($newOrders > 0)
                        <span class="ml-auto px-2 py-0.5 bg-rose-500 text-white text-[10px] font-extrabold rounded-full">{{ $newOrders }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.directors.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.directors.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-user-doctor text-base w-5 text-center text-sky-400 shrink-0"></i>
                    <span>Specialist Doctors Directory</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-hospital-user text-base w-5 text-center text-teal-400 shrink-0"></i>
                    <span>Clinical Departments</span>
                </a>
                <a href="{{ route('admin.cabins.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.cabins.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-bed-pulse text-base w-5 text-center text-indigo-400 shrink-0"></i>
                    <span>Cabins &amp; Ward Rent Rates</span>
                </a>
                <a href="{{ route('admin.diagnostic-tests.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.diagnostic-tests.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-vial text-base w-5 text-center text-rose-400 shrink-0"></i>
                    <span>Diagnostic Tests &amp; Rates</span>
                </a>
                <a href="{{ route('admin.medical-equipments.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.medical-equipments.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-microscope text-base w-5 text-center text-cyan-400 shrink-0"></i>
                    <span>Medical Machinery &amp; Equipment</span>
                </a>
                <a href="{{ route('admin.products.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.products.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-hand-holding-medical text-base w-5 text-center text-emerald-400 shrink-0"></i>
                    <span>Medical Services &amp; Packages</span>
                </a>
                <a href="{{ route('admin.button-types.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.button-types.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-notes-medical text-base w-5 text-center text-[#06B6D4] shrink-0"></i>
                    <span>Specialties &amp; Highlights</span>
                </a>
                <a href="{{ route('admin.showrooms.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.showrooms.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-hospital text-base w-5 text-center text-purple-400 shrink-0"></i>
                    <span>Hospital Locations &amp; Centers</span>
                </a>
                <a href="{{ route('admin.jobs.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.jobs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-briefcase text-base w-5 text-center text-pink-400 shrink-0"></i>
                    <span>Career Vacancies</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.applications.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-file-signature text-base w-5 text-center text-amber-300 shrink-0"></i>
                    <span>Career Applications</span>
                </a>
                <a href="{{ route('admin.blood-banks.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.blood-banks.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-droplet text-base w-5 text-center text-rose-500 shrink-0"></i>
                    <span>Emergency Blood Bank</span>
                </a>
                <a href="{{ route('admin.health-blogs.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.health-blogs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-newspaper text-base w-5 text-center text-emerald-400 shrink-0"></i>
                    <span>Health Articles &amp; Blog</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.faqs.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-circle-question text-base w-5 text-center text-amber-400 shrink-0"></i>
                    <span>Patient FAQs &amp; Help Desk</span>
                </a>
                <a href="{{ route('admin.media.index') }}" @click="mobileMenuOpen = false" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.media.*') ? 'bg-[#0284C7] text-white shadow-lg' : '' }}">
                    <i class="fas fa-photo-film text-base w-5 text-center text-rose-400 shrink-0"></i>
                    <span>Media, Video Tour &amp; Gallery</span>
                </a>
            </nav>

            <div class="p-3 border-t border-slate-800 bg-slate-950 shrink-0">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                    <i class="fas fa-external-link-alt text-base text-sky-400 shrink-0"></i>
                    <span class="font-bold text-xs">View Live CarePlus Site</span>
                </a>
            </div>
        </aside>

        <!-- ==================== DESKTOP SIDEBAR (HIDDEN ON MOBILE) ==================== -->
        <aside 
            @mouseenter="sidebarHover = true" 
            @mouseleave="sidebarHover = false"
            :class="sidebarHover ? 'w-72' : 'w-20'"
            class="hidden lg:flex sticky top-0 left-0 h-screen transition-all duration-300 bg-gradient-to-b from-slate-900 via-slate-950 to-black shadow-2xl border-r border-slate-800 flex-col shrink-0 overflow-hidden z-40">

            <!-- Logo -->
            <div class="h-16 flex items-center justify-center px-4 border-b border-slate-800/80 shrink-0">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-xl flex items-center justify-center text-white text-lg font-bold shadow-lg shadow-sky-500/20 shrink-0">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div x-show="sidebarHover" class="flex flex-col">
                        <span class="text-white font-extrabold text-lg whitespace-nowrap">Care<span class="text-[#0284C7]">Plus</span> Admin</span>
                        <span class="text-[10px] text-sky-400 font-bold uppercase tracking-widest -mt-1">Hospital Control Engine</span>
                    </div>
                </a>
            </div>

            <!-- Navigation Links -->
            <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto scrollbar-thin text-xs font-semibold">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('dashboard') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-chart-line text-lg w-5 text-center shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Dashboard</span>
                </a>

                <!-- ERP Core Modules -->
                <a href="{{ route('admin.patients.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.patients.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-hospital-user text-lg w-5 text-center text-teal-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Patients &amp; UHID Directory</span>
                </a>
                <a href="{{ route('admin.prescriptions.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.prescriptions.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-file-prescription text-lg w-5 text-center text-sky-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Doctor E-Prescriptions (Rx)</span>
                </a>
                <a href="{{ route('admin.invoices.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.invoices.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-file-invoice-dollar text-lg w-5 text-center text-amber-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Invoices &amp; Hospital Billing</span>
                </a>
                <a href="{{ route('admin.lab-reports.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.lab-reports.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-vial text-lg w-5 text-center text-purple-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Diagnostic Lab Reports</span>
                </a>
                <a href="{{ route('admin.inventories.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.inventories.index') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-boxes-stacked text-lg w-5 text-center text-cyan-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Pharmacy &amp; Stock Inventory</span>
                </a>
                <a href="{{ route('admin.inventories.pos') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.inventories.pos') ? 'bg-emerald-600 text-white shadow-lg shadow-emerald-500/20' : '' }}">
                    <i class="fas fa-cash-register text-lg w-5 text-center text-emerald-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Pharmacy POS Counter</span>
                </a>
                <a href="{{ route('admin.ipd-admissions.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ipd-admissions.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-bed-pulse text-lg w-5 text-center text-indigo-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">IPD Inpatient Cabin Admission</span>
                </a>
                <a href="{{ route('admin.blood-donors.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.blood-donors.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-hand-holding-droplet text-lg w-5 text-center text-rose-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Volunteer Blood Donors</span>
                </a>
                <a href="{{ route('admin.ot-schedules.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ot-schedules.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-scissors text-lg w-5 text-center text-teal-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">OT &amp; Surgery Scheduler</span>
                </a>
                <a href="{{ route('admin.ambulance-dispatches.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.ambulance-dispatches.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-truck-medical text-lg w-5 text-center text-sky-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Emergency Ambulance</span>
                </a>
                <a href="{{ route('admin.analytics.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.analytics.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-chart-line text-lg w-5 text-center text-emerald-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Executive Analytics Dashboard</span>
                </a>
                <a href="{{ route('admin.custom-orders.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all relative {{ request()->routeIs('admin.custom-orders.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-calendar-check text-lg w-5 text-center text-amber-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Doctor Appointments</span>
                    @php $newOrders = \App\Models\CustomOrder::where('status', 'new')->count(); @endphp
                    @if($newOrders > 0)
                        <span class="ml-auto px-2 py-0.5 bg-rose-500 text-white text-[10px] font-extrabold rounded-full animate-pulse">{{ $newOrders }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.directors.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.directors.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-user-doctor text-lg w-5 text-center text-sky-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Specialist Doctors Directory</span>
                </a>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.categories.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-hospital-user text-lg w-5 text-center text-teal-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Clinical Departments</span>
                </a>
                <a href="{{ route('admin.cabins.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.cabins.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-bed-pulse text-lg w-5 text-center text-indigo-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Cabins &amp; Ward Rent Rates</span>
                </a>
                <a href="{{ route('admin.diagnostic-tests.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.diagnostic-tests.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-vial text-lg w-5 text-center text-rose-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Diagnostic Tests &amp; Rates</span>
                </a>
                <a href="{{ route('admin.medical-equipments.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.medical-equipments.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-microscope text-lg w-5 text-center text-cyan-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Medical Machinery &amp; Equipment</span>
                </a>
                <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.products.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-hand-holding-medical text-lg w-5 text-center text-emerald-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Medical Services &amp; Packages</span>
                </a>
                <a href="{{ route('admin.button-types.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.button-types.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-notes-medical text-lg w-5 text-center text-[#06B6D4] shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Specialties &amp; Highlights</span>
                </a>
                <a href="{{ route('admin.showrooms.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.showrooms.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-hospital text-lg w-5 text-center text-purple-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Hospital Locations &amp; Centers</span>
                </a>
                <a href="{{ route('admin.jobs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.jobs.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-briefcase text-lg w-5 text-center text-pink-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Career Vacancies</span>
                </a>
                <a href="{{ route('admin.applications.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.applications.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-file-signature text-lg w-5 text-center text-amber-300 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Career Applications</span>
                </a>
                <a href="{{ route('admin.blood-banks.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.blood-banks.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-droplet text-lg w-5 text-center text-rose-500 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Emergency Blood Bank</span>
                </a>
                <a href="{{ route('admin.health-blogs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.health-blogs.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-newspaper text-lg w-5 text-center text-emerald-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Health Articles &amp; Blog</span>
                </a>
                <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.faqs.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-circle-question text-lg w-5 text-center text-amber-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Patient FAQs &amp; Help Desk</span>
                </a>
                <a href="{{ route('admin.media.index') }}" class="flex items-center gap-3.5 px-3.5 py-3 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800/80 transition-all {{ request()->routeIs('admin.media.*') ? 'bg-[#0284C7] text-white shadow-lg shadow-sky-500/20' : '' }}">
                    <i class="fas fa-photo-film text-lg w-5 text-center text-rose-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap">Media, Video Tour &amp; Gallery</span>
                </a>
            </nav>

            <div class="p-3 border-t border-slate-800/80 bg-slate-950 shrink-0">
                <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
                    <i class="fas fa-external-link-alt text-base text-sky-400 shrink-0"></i>
                    <span x-show="sidebarHover" class="whitespace-nowrap font-bold text-xs">View Live CarePlus Site</span>
                </a>
            </div>
        </aside>

        <!-- ==================== MAIN CONTENT AREA ==================== -->
        <div class="flex-1 flex flex-col min-w-0 overflow-hidden">
            
            <!-- Top Header -->
            <header class="h-16 bg-slate-900/90 backdrop-blur border-b border-slate-800 flex items-center justify-between px-4 sm:px-6 sticky top-0 z-30 shrink-0">
                <div class="flex items-center gap-3 min-w-0">
                    <!-- Hamburger Menu for Mobile -->
                    <button @click="mobileMenuOpen = true" class="lg:hidden p-2 rounded-xl text-slate-300 hover:text-white hover:bg-slate-800 focus:outline-none shrink-0">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                    <!-- Header Title -->
                    <h1 class="text-sm sm:text-base font-extrabold text-white truncate">
                        CarePlus Control Panel
                    </h1>
                </div>

                <div class="flex items-center gap-3 shrink-0">
                    @auth
                    <div class="flex items-center gap-2 sm:gap-3">
                        <div class="w-8 h-8 sm:w-9 sm:h-9 bg-[#0284C7] rounded-full flex items-center justify-center text-white font-bold text-xs sm:text-sm shadow-md shadow-sky-500/20 shrink-0">
                            <span>{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="hidden sm:block">
                            <p class="text-white font-bold text-xs leading-tight">{{ Auth::user()->name }}</p>
                            <p class="text-slate-400 text-[10px]">Hospital Administrator</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-1 sm:ml-4">
                        @csrf
                        <button type="submit" class="p-2 sm:px-3 sm:py-1.5 rounded-lg text-slate-400 hover:text-rose-400 text-xs font-bold transition flex items-center gap-1.5 hover:bg-slate-800">
                            <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Logout</span>
                        </button>
                    </form>
                    @endauth
                </div>
            </header>

            <!-- Main Page Content Body -->
            <main class="flex-1 overflow-y-auto bg-slate-950 p-4 sm:p-6">
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
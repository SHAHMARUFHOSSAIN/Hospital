@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-extrabold text-white mb-6 flex items-center gap-2">
            <i class="fas fa-[#0284C7] fa-hospital-user text-[#0284C7]"></i> CarePoint Hospital Management Control Panel
        </h1>
        
        <!-- Hero / Slider Media Card -->
        <div class="bg-gradient-to-r from-[#0284C7] via-[#0369A1] to-slate-900 rounded-2xl p-6 mb-8 text-white shadow-xl">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                <div>
                    <span class="px-3 py-1 bg-white/20 text-white rounded-full text-[10px] font-extrabold uppercase tracking-widest">Home Slider &amp; Media</span>
                    <h2 class="text-2xl font-extrabold mt-2 mb-1">CarePlus Hero Slider &amp; Media Gallery</h2>
                    <p class="text-slate-200 text-xs font-semibold">Upload photos, sliders, and video links for the homepage banner &amp; accreditations</p>
                </div>
                <a href="{{ route('admin.media.index') }}" class="inline-flex items-center px-6 py-3 bg-white text-slate-900 font-extrabold text-xs rounded-xl hover:bg-slate-100 transition shadow-lg shrink-0">
                    <i class="fas fa-images mr-2 text-[#0284C7]"></i> Manage Hero Slider &amp; Media
                </a>
            </div>
        </div>
        
        <!-- Quick Stats Overview Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- 1. Appointments -->
            <a href="{{ route('admin.custom-orders.index') }}" class="bg-slate-900 rounded-2xl p-5 border border-slate-800 hover:border-amber-500/50 transition shadow-md group">
                <div class="flex items-center justify-between">
                    <div>
                        <dt class="text-xs font-extrabold uppercase text-slate-400">Doctor Appointments</dt>
                        <dd class="text-2xl font-extrabold text-white mt-1">{{ \App\Models\CustomOrder::count() }}</dd>
                        <span class="text-[10px] text-amber-400 font-semibold mt-1 inline-block">Edits Patient Bookings</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-amber-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
            </a>
            
            <!-- 2. Doctors -->
            <a href="{{ route('admin.directors.index') }}" class="bg-slate-900 rounded-2xl p-5 border border-slate-800 hover:border-sky-500/50 transition shadow-md group">
                <div class="flex items-center justify-between">
                    <div>
                        <dt class="text-xs font-extrabold uppercase text-slate-400">Specialist Doctors</dt>
                        <dd class="text-2xl font-extrabold text-white mt-1">{{ \App\Models\Director::count() }}</dd>
                        <span class="text-[10px] text-sky-400 font-semibold mt-1 inline-block">Edits Doctor Directory</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-sky-500/20 text-sky-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-user-doctor"></i>
                    </div>
                </div>
            </a>
            
            <!-- 3. Clinical Departments -->
            <a href="{{ route('admin.categories.index') }}" class="bg-slate-900 rounded-2xl p-5 border border-slate-800 hover:border-teal-500/50 transition shadow-md group">
                <div class="flex items-center justify-between">
                    <div>
                        <dt class="text-xs font-extrabold uppercase text-slate-400">Clinical Departments</dt>
                        <dd class="text-2xl font-extrabold text-white mt-1">{{ $stats['categories'] }}</dd>
                        <span class="text-[10px] text-teal-400 font-semibold mt-1 inline-block">Edits Department Cards</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-teal-500/20 text-teal-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                </div>
            </a>
            
            <!-- 4. Medical Services -->
            <a href="{{ route('admin.products.index') }}" class="bg-slate-900 rounded-2xl p-5 border border-slate-800 hover:border-emerald-500/50 transition shadow-md group">
                <div class="flex items-center justify-between">
                    <div>
                        <dt class="text-xs font-extrabold uppercase text-slate-400">Medical Services</dt>
                        <dd class="text-2xl font-extrabold text-white mt-1">{{ $stats['products'] }}</dd>
                        <span class="text-[10px] text-emerald-400 font-semibold mt-1 inline-block">Edits Services &amp; Packages</span>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
                        <i class="fas fa-hand-holding-medical"></i>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- CMS Quick Navigation Modules -->
        <h3 class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-4">CarePlus CMS Content Management Modules</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
            
            <!-- Departments -->
            <a href="{{ route('admin.categories.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-teal-500/20 text-teal-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-hospital-user"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Departments</span>
                <span class="text-[9px] text-slate-500 font-semibold">Edits Clinical Cards</span>
            </a>

            <!-- Doctors -->
            <a href="{{ route('admin.directors.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-sky-500/20 text-sky-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-user-doctor"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Doctors</span>
                <span class="text-[9px] text-slate-500 font-semibold">Edits Doctor Profiles</span>
            </a>

            <!-- Medical Services -->
            <a href="{{ route('admin.products.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-emerald-500/20 text-emerald-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-hand-holding-medical"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Services</span>
                <span class="text-[9px] text-slate-500 font-semibold">Edits Packages</span>
            </a>

            <!-- Specialties -->
            <a href="{{ route('admin.button-types.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-cyan-500/20 text-cyan-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-notes-medical"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Specialties</span>
                <span class="text-[9px] text-slate-500 font-semibold">Edits Icon Pills</span>
            </a>

            <!-- Locations -->
            <a href="{{ route('admin.showrooms.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-indigo-500/20 text-indigo-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-hospital"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Locations</span>
                <span class="text-[9px] text-slate-500 font-semibold">Edits Hospital Centers</span>
            </a>

            <!-- Appointments -->
            <a href="{{ route('admin.custom-orders.index') }}" class="p-4 bg-slate-900 rounded-2xl border border-slate-800 hover:border-[#0284C7] transition text-center group">
                <div class="w-10 h-10 mx-auto bg-amber-500/20 text-amber-400 rounded-xl flex items-center justify-center mb-2 text-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <span class="text-xs font-extrabold text-slate-200 block">Appointments</span>
                <span class="text-[9px] text-slate-500 font-semibold">Views Patient Requests</span>
            </a>

        </div>
        
        <!-- Recent Patient Doctor Appointments Table -->
        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-800 flex items-center justify-between">
                <h3 class="text-base font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-calendar-check text-amber-400"></i> Recent Doctor Appointment Requests
                </h3>
                <a href="{{ route('admin.custom-orders.index') }}" class="text-xs font-bold text-[#0284C7] hover:underline">View All Appointments &rarr;</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-xs">
                    <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                        <tr>
                            <th class="px-6 py-3 text-left">Patient Name</th>
                            <th class="px-6 py-3 text-left">Email / Contact</th>
                            <th class="px-6 py-3 text-left">Specialty Department</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Booking Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 font-medium">
                        @forelse(\App\Models\CustomOrder::latest()->take(5)->get() as $order)
                        <tr class="hover:bg-slate-800/40 transition">
                            <td class="px-6 py-4 text-white font-bold">{{ $order->name }}</td>
                            <td class="px-6 py-4 text-slate-300">{{ $order->email }} <br><span class="text-slate-500 text-[10px]">{{ $order->phone }}</span></td>
                            <td class="px-6 py-4 text-slate-300 font-bold">{{ $order->company ?: 'General OPD' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2.5 py-1 text-[10px] font-extrabold rounded-full 
                                    @if($order->status === 'new') bg-amber-500/20 text-amber-300 border border-amber-500/40
                                    @elseif($order->status === 'completed') bg-emerald-500/20 text-emerald-300 border border-emerald-500/40
                                    @else bg-slate-800 text-slate-300 border border-slate-700 @endif">
                                    {{ strtoupper($order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-slate-400">{{ $order->created_at->format('M d, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-semibold">No appointment bookings received yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection
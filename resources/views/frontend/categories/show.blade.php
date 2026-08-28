@extends('layouts.frontend')

@section('title', $category->name . ' — Clinical Department & Institute — CarePlus')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('categories') }}" class="hover:text-[#0284C7]">Departments</a> &rarr; 
            <span class="text-slate-900">{{ $category->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <div class="lg:col-span-4 flex justify-center">
                <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative group bg-sky-50 flex items-center justify-center">
                    @if($category->image_url)
                        <img src="{{ $category->image_url }}" alt="{{ $category->name }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80';">
                    @else
                        <div class="w-24 h-24 rounded-3xl bg-[#0284C7] text-white flex items-center justify-center text-5xl shadow-lg">
                            <i class="fas {{ $category->medical_icon }}"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas {{ $category->medical_icon }}"></i> Center of Clinical Excellence
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $category->name }}</h1>
                
                <!-- Quick Meta Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-1">
                    @if($category->head_of_dept)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Head of Department (HOD)</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-user-doctor text-[#0284C7] mr-1"></i> {{ $category->head_of_dept }}</div>
                    </div>
                    @endif
                    @if($category->opd_hours)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">OPD Consultation Hours</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-clock text-[#0284C7] mr-1"></i> {{ $category->opd_hours }}</div>
                    </div>
                    @endif
                    @if($category->bed_info)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100 col-span-2 sm:col-span-1">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Bed &amp; ICU Allocation</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-bed-pulse text-[#0284C7] mr-1"></i> {{ $category->bed_info }}</div>
                    </div>
                    @endif
                </div>

                <p class="text-slate-600 text-sm font-semibold leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-200/80">
                    {{ $category->description ?: 'Comprehensive clinical division providing 24/7 outpatient consultations, modular operation theatre procedures, inpatient ICU beds, and specialized diagnostic testing.' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#department-doctors" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-user-doctor"></i> View Department Doctors
                    </a>
                    <a href="#appointment-form" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-extrabold text-xs rounded-full inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check text-[#0284C7]"></i> Book Department Appointment
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Department Specialist Doctors Section -->
<section id="department-doctors" class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10">
            <div>
                <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-widest block mb-1">Medical Faculty</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Specialist Doctors in {{ $category->name }}</h2>
            </div>
            <a href="{{ route('directors') }}" class="text-xs font-extrabold text-[#0284C7] hover:underline mt-2 md:mt-0">View Entire Hospital Doctors Directory &rarr;</a>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            @forelse($doctors as $doc)
            <div class="bg-white rounded-3xl p-6 border border-slate-200/80 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                <div>
                    <!-- Doctor Photo -> Profile Page -->
                    <a href="{{ route('doctors.show', $doc->slug) }}" class="block aspect-square rounded-2xl mb-5 overflow-hidden shadow-md ring-2 ring-slate-100 relative group-hover:ring-[#0284C7] transition-all">
                        <img src="{{ $doc->photo_url }}" alt="{{ $doc->name }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </a>

                    <!-- Doctor Name -> Profile Page -->
                    <a href="{{ route('doctors.show', $doc->slug) }}" class="block font-extrabold text-lg text-slate-900 mb-1 hover:text-[#0284C7] transition-colors leading-tight">
                        {{ $doc->name }}
                    </a>

                    <p class="text-xs font-bold text-[#0284C7] uppercase tracking-wider mb-2">{{ $doc->designation }}</p>
                    <p class="text-[11px] font-bold text-slate-600 bg-sky-50 px-2 py-1 rounded-lg inline-block mb-3">{{ $doc->degree ?: 'MBBS, FCPS' }}</p>
                </div>

                <a href="{{ route('doctors.show', $doc->slug) }}" class="w-full py-2.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-1.5">
                    <span>View Profile &amp; Book</span>
                    <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
            @empty
            <div class="col-span-full text-center py-12 text-slate-400 font-bold">No doctors currently assigned to this department.</div>
            @endforelse
        </div>
    </div>
</section>

<!-- Department Medical Services & Packages Section -->
@if(isset($products) && $products->count())
<section class="py-16 bg-white border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10">
            <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-widest block mb-1">Clinical Offerings</span>
            <h2 class="text-3xl font-extrabold text-slate-900">Services &amp; Procedures in {{ $category->name }}</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $prod)
            <div class="card-careplus overflow-hidden flex flex-col justify-between group p-6">
                <div>
                    <a href="{{ route('products.show', $prod->slug) }}" class="block aspect-video rounded-2xl overflow-hidden mb-5 bg-slate-100 relative shadow-inner">
                        <img src="{{ $prod->thumbnail_url }}" alt="{{ $prod->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </a>

                    <a href="{{ route('products.show', $prod->slug) }}" class="block font-extrabold text-xl text-slate-900 mb-2 group-hover:text-[#0284C7] transition-colors leading-tight">
                        {{ $prod->name }}
                    </a>

                    <p class="text-slate-500 text-xs leading-relaxed mb-6 font-medium line-clamp-3">{{ $prod->description }}</p>
                </div>

                <a href="{{ route('products.show', $prod->slug) }}" class="w-full py-3 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs text-center rounded-full shadow transition flex items-center justify-center gap-2">
                    <span>View Details &amp; Book Service</span>
                    <i class="fas fa-chevron-right text-[10px]"></i>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Direct Department Booking Form -->
<section id="appointment-form" class="py-16 bg-slate-50 border-t border-slate-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="card-careplus p-8 sm:p-12 border-2 border-sky-100 shadow-2xl">
            <div class="text-center mb-8">
                <span class="inline-block px-4 py-1 bg-sky-100 text-[#0284C7] font-extrabold text-xs uppercase tracking-widest rounded-full mb-2">Direct Consultation</span>
                <h3 class="font-extrabold text-2xl sm:text-3xl text-slate-900">Book Appointment in {{ $category->name }}</h3>
                <p class="text-xs text-slate-500 font-semibold mt-1">Schedule consultation with department specialists.</p>
            </div>

            @if(session('custom_order_success'))
            <div class="mb-8 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-bold text-center">
                <i class="fas fa-circle-check text-emerald-600 text-lg mr-2"></i>
                {{ session('custom_order_success') }}
            </div>
            @endif

            <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="booking_type" value="doctor_appointment">
                <input type="hidden" name="company" value="{{ $category->name }} Department">

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Patient Name *</label>
                        <input type="text" name="name" required placeholder="Full Name"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('name') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Email Address *</label>
                        <input type="email" name="email" required placeholder="patient@example.com"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Phone Number *</label>
                        <input type="tel" name="phone" required placeholder="+880 1700 000000"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('phone') }}">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Select Department Doctor</label>
                        <select name="doctor_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                            <option value="">Any Specialist in {{ $category->name }}</option>
                            @foreach($doctors as $doc)
                                <option value="{{ $doc->id }}">{{ $doc->name }} ({{ $doc->designation }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Appointment Date</label>
                        <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Symptoms / Reason for Visit</label>
                        <input type="text" name="message" placeholder="Briefly describe health concerns..."
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                    </div>
                </div>

                <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                    <span>Confirm Department Appointment</span>
                    <i class="fas fa-check-circle"></i>
                </button>
            </form>
        </div>
    </div>
</section>

@endsection
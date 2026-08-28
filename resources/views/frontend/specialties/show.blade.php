@extends('layouts.frontend')

@section('title', $specialty->name . ' — Clinical Specialty Details — CarePlus')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('categories') }}" class="hover:text-[#0284C7]">Specialties &amp; Highlights</a> &rarr; 
            <span class="text-slate-900">{{ $specialty->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Cover Photo -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative group bg-slate-100 flex items-center justify-center">
                    <img src="{{ $specialty->image_url }}" alt="{{ $specialty->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <span class="absolute top-4 right-4 px-4 py-1.5 bg-slate-900/80 backdrop-blur-md text-white text-xs font-extrabold uppercase rounded-full">
                        {{ \App\Models\ButtonType::variants()[$specialty->variant] ?? $specialty->variant }}
                    </span>
                </div>
            </div>

            <!-- Meta Info -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas fa-shield-heart"></i> Specialized Clinical Unit
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $specialty->name }}</h1>
                
                <p class="text-slate-600 text-xs sm:text-sm font-semibold leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-200/80">
                    {{ $specialty->description ?: 'State-of-the-art clinical division equipped with 24/7 ICUs, operation theaters, and senior specialist consultants.' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#consultation-form" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i> Book Specialty Consultation
                    </a>
                    <a href="{{ route('home') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-extrabold text-xs rounded-full inline-flex items-center gap-2">
                        &larr; Back to Hospital Home
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Clinical Overview & Booking Form -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Details Overview -->
            <div class="lg:col-span-7 space-y-6">
                <h3 class="font-extrabold text-2xl text-slate-900">Clinical Infrastructure &amp; Capabilities</h3>
                
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 text-xs text-slate-700 font-semibold leading-relaxed whitespace-pre-line">
                    {{ $specialty->description ?: 'Comprehensive specialty division maintaining 24/7 level-1 emergency response, modular infection-controlled theaters, and ICU critical care monitoring.' }}
                </div>

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">24/7 Availability</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">Round-the-clock emergency team &amp; senior consultants on call.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">Advanced Technology</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">Equipped with zero-lag monitors, central gas line &amp; life support systems.</p>
                        </div>
                    </div>
                </div>

                <!-- Assigned Doctors -->
                @if(isset($doctors) && $doctors->count())
                <div class="pt-6">
                    <h4 class="font-extrabold text-lg text-slate-900 mb-4">Specialist Doctors On Call</h4>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($doctors as $doc)
                        <a href="{{ route('doctors.show', $doc->slug) }}" class="p-4 bg-slate-50 hover:bg-sky-50 rounded-2xl border border-slate-200 transition group flex items-center gap-3">
                            <img src="{{ $doc->photo_url }}" class="w-12 h-12 rounded-xl object-cover border border-slate-200 shrink-0">
                            <div>
                                <h5 class="font-extrabold text-xs text-slate-900 group-hover:text-[#0284C7] transition-colors">{{ $doc->name }}</h5>
                                <p class="text-[10px] text-slate-500 font-bold">{{ $doc->designation }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Booking Form -->
            <div id="consultation-form" class="lg:col-span-5">
                <div class="card-careplus p-8 border-2 border-sky-100 shadow-2xl">
                    <h3 class="font-extrabold text-xl text-slate-900 mb-1">Book {{ $specialty->name }}</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-6">Schedule consultation or emergency inquiry</p>

                    @if(session('custom_order_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold leading-relaxed">
                        <i class="fas fa-circle-check text-emerald-600 text-base mr-1"></i>
                        {{ session('custom_order_success') }}
                    </div>
                    @endif

                    <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="booking_type" value="doctor_appointment">
                        <input type="hidden" name="company" value="{{ $specialty->name }} Unit">

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

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Phone Number *</label>
                            <input type="tel" name="phone" required placeholder="+880 1700 000000"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Appointment Date</label>
                            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Health Symptoms / Requirements</label>
                            <textarea name="message" rows="3" placeholder="Describe symptoms or clinical requirements..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Confirm Specialty Booking</span>
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

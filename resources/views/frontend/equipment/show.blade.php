@extends('layouts.frontend')

@section('title', $equipment->name . ' — Advanced Medical Technology Details — CarePlus')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('equipment.index') }}" class="hover:text-[#0284C7]">Medical Equipment &amp; Robotics</a> &rarr; 
            <span class="text-slate-900">{{ $equipment->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Main Image -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative group bg-slate-100 flex items-center justify-center">
                    <img src="{{ $equipment->image_url }}" alt="{{ $equipment->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&q=80';">
                    @if($equipment->model_name)
                    <span class="absolute top-4 right-4 px-4 py-1.5 bg-slate-900/80 backdrop-blur-md text-white text-xs font-extrabold uppercase rounded-full">
                        {{ $equipment->model_name }}
                    </span>
                    @endif
                </div>
            </div>

            <!-- Meta Info -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas fa-microscope"></i> {{ $equipment->department_name ?: 'Diagnostic Department' }}
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $equipment->name }}</h1>
                
                <!-- Manufacturer & Scan Fee Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-1">
                    @if($equipment->manufacturer)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Manufacturer &amp; Origin</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-industry text-[#0284C7] mr-1"></i> {{ $equipment->manufacturer }} {{ $equipment->country_of_origin ? '('.$equipment->country_of_origin.')' : '' }}</div>
                    </div>
                    @endif
                    @if($equipment->scan_fee && $equipment->scan_fee > 0)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Diagnostic Scan Fee</div>
                        <div class="text-lg font-extrabold text-[#0284C7]">৳ {{ number_format($equipment->scan_fee, 2) }}</div>
                    </div>
                    @endif
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100 col-span-2 sm:col-span-1">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Model Series</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-microchip text-[#0284C7] mr-1"></i> {{ $equipment->model_name ?: 'Latest Gen' }}</div>
                    </div>
                </div>

                <p class="text-slate-600 text-xs sm:text-sm font-medium leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                    {{ $equipment->description ?: 'State-of-the-art medical technology providing high-precision clinical diagnostics and minimally invasive procedures.' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#inquiry-form" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i> Book Diagnostic Scan / Procedure
                    </a>
                    <a href="{{ route('equipment.index') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-extrabold text-xs rounded-full inline-flex items-center gap-2">
                        &larr; View All Medical Equipment
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Gallery & Specifications -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Specs & Gallery -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- Multiple Photo Gallery Grid -->
                @if(!empty($equipment->gallery_urls) && count($equipment->gallery_urls) > 0)
                <div>
                    <h4 class="font-extrabold text-lg text-slate-900 mb-3 flex items-center gap-2">
                        <i class="fas fa-images text-[#0284C7]"></i> Equipment Photo Gallery
                    </h4>
                    <div class="grid grid-cols-3 gap-3">
                        @foreach($equipment->gallery_urls as $galUrl)
                        <div class="aspect-video rounded-2xl overflow-hidden shadow border border-slate-200 bg-slate-100 group">
                            <img src="{{ $galUrl }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <h3 class="font-extrabold text-2xl text-slate-900">Clinical Capabilities &amp; Technical Specifications</h3>
                
                @if($equipment->features)
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 space-y-2 text-xs text-slate-700 font-semibold leading-relaxed">
                    <h4 class="font-extrabold text-sm text-slate-900 mb-2">Key Diagnostic Features</h4>
                    <div class="whitespace-pre-line">{{ $equipment->features }}</div>
                </div>
                @endif

                @if($equipment->specifications)
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 space-y-2 text-xs text-slate-700 font-semibold leading-relaxed">
                    <h4 class="font-extrabold text-sm text-slate-900 mb-2">Technical Operating Specifications</h4>
                    <div class="whitespace-pre-line">{{ $equipment->specifications }}</div>
                </div>
                @endif

                <!-- Other Equipment -->
                @if(isset($otherEquipments) && $otherEquipments->count())
                <div class="pt-6">
                    <h4 class="font-extrabold text-lg text-slate-900 mb-4">Other Advanced Medical Technology</h4>
                    <div class="grid sm:grid-cols-3 gap-4">
                        @foreach($otherEquipments as $oth)
                        <a href="{{ route('equipment.show', $oth->id) }}" class="p-4 bg-slate-50 hover:bg-sky-50 rounded-2xl border border-slate-200 transition group block">
                            <span class="text-[10px] font-extrabold text-sky-700 uppercase block mb-1">{{ $oth->department_name ?: 'Diagnostic' }}</span>
                            <h5 class="font-extrabold text-sm text-slate-900 group-hover:text-[#0284C7] transition-colors mb-1">{{ $oth->name }}</h5>
                            <span class="text-xs font-bold text-slate-500">View Specs &rarr;</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Booking Form -->
            <div id="inquiry-form" class="lg:col-span-5">
                <div class="card-careplus p-8 border-2 border-sky-100 shadow-2xl">
                    <h3 class="font-extrabold text-xl text-slate-900 mb-1">Book {{ $equipment->name }} Scan</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-6">Schedule diagnostic scan / procedure appointment</p>

                    @if(session('custom_order_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold leading-relaxed">
                        <i class="fas fa-circle-check text-emerald-600 text-base mr-1"></i>
                        {{ session('custom_order_success') }}
                    </div>
                    @endif

                    <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="booking_type" value="medical_service">
                        <input type="hidden" name="company" value="{{ $equipment->name }} Scan ({{ $equipment->department_name }})">

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
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Doctor Prescription / Clinical Notes</label>
                            <textarea name="message" rows="3" placeholder="Specify referring doctor or diagnostic scan instructions..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Confirm Scan Appointment</span>
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@extends('layouts.frontend')

@section('title', $cabin->name . ' — Inpatient Accommodation Details — CarePlus')

@section('content')
<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('cabins.index') }}" class="hover:text-[#0284C7]">Cabins &amp; Wards</a> &rarr; 
            <span class="text-slate-900">{{ $cabin->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Cabin Image -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative group bg-slate-100 flex items-center justify-center">
                    <img src="{{ $cabin->image_url }}" alt="{{ $cabin->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80';">
                    <span class="absolute top-4 right-4 px-4 py-1.5 bg-slate-900/80 backdrop-blur-md text-white text-xs font-extrabold uppercase rounded-full">
                        {{ $cabin->room_type }}
                    </span>
                </div>
            </div>

            <!-- Cabin Meta Info -->
            <div class="lg:col-span-7 space-y-4">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas fa-bed-pulse"></i> Inpatient Suite
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $cabin->name }}</h1>
                
                <!-- Quick Meta Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-1">
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Daily Rent Rate</div>
                        <div class="text-lg font-extrabold text-[#0284C7]">৳ {{ number_format($cabin->rent_per_day, 2) }} <span class="text-[10px] text-slate-500 font-medium">/ day</span></div>
                    </div>
                    @if($cabin->floor_no)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Location / Floor</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-building text-[#0284C7] mr-1"></i> {{ $cabin->floor_no }}</div>
                    </div>
                    @endif
                    @if($cabin->bed_count)
                    <div class="p-3 bg-sky-50 rounded-2xl border border-sky-100 col-span-2 sm:col-span-1">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Bed Allocation</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1"><i class="fas fa-bed text-[#0284C7] mr-1"></i> {{ $cabin->bed_count }}</div>
                    </div>
                    @endif
                </div>

                <p class="text-slate-600 text-xs sm:text-sm font-semibold leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                    <i class="fas fa-circle-check text-emerald-500 mr-1.5"></i> <strong>Included Amenities:</strong> {{ $cabin->amenities ?: 'Air Conditioning, Private Attached Bath, Emergency Central Oxygen, Attendant Sofa Bed, LED Television, Mini Refrigerator, 24/7 Nurse Call Station' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#reservation-form" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i> Reserve {{ $cabin->name }}
                    </a>
                    <a href="{{ route('cabins.index') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-extrabold text-xs rounded-full inline-flex items-center gap-2">
                        &larr; View All Cabins &amp; Wards
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Detailed Facilities & Admission Form -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Room Features & Guidelines -->
            <div class="lg:col-span-7 space-y-6">
                <h3 class="font-extrabold text-2xl text-slate-900">Inpatient Suite Overview &amp; Specifications</h3>
                
                @if($cabin->description)
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 text-xs text-slate-700 font-semibold leading-relaxed whitespace-pre-line">
                    {{ $cabin->description }}
                </div>
                @endif

                <div class="grid sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-100 text-[#0284C7] flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-user-nurse"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">24/7 Dedicated Nursing</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">Round-the-clock nurse call response &amp; vital signs monitoring.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-lungs"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">Medical Pipeline</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">{{ $cabin->oxygen_type ?: 'Central Line Oxygen Supply & Suction Apparatus' }}</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-couch"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">Attendant Bed &amp; Lounge</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">Comfortable attendant sofa bed, table &amp; privacy curtains.</p>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 flex items-start gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-600 flex items-center justify-center text-lg shrink-0">
                            <i class="fas fa-utensils"></i>
                        </div>
                        <div>
                            <h5 class="font-extrabold text-sm text-slate-900">Dietician Meal Plan</h5>
                            <p class="text-xs text-slate-500 font-semibold mt-0.5">Custom therapeutic meals prepared under clinical nutritionists.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 space-y-3">
                    <h4 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                        <i class="fas fa-shield-heart text-[#0284C7]"></i> Admission &amp; Visitor Guidelines
                    </h4>
                    <ul class="space-y-2 text-xs text-slate-600 font-semibold">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> One attendant pass is provided per cabin for 24-hour stay.</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Visiting hours: 4:00 PM – 7:00 PM daily. Children under 12 require permission.</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Cabin checkout time is calculated at 12:00 PM noon.</li>
                    </ul>
                </div>

                <!-- Other Cabins -->
                @if(isset($otherCabins) && $otherCabins->count())
                <div class="pt-6">
                    <h4 class="font-extrabold text-lg text-slate-900 mb-4">Other Available Accommodations</h4>
                    <div class="grid sm:grid-cols-3 gap-4">
                        @foreach($otherCabins as $oth)
                        <a href="{{ route('cabins.show', $oth->id) }}" class="p-4 bg-slate-50 hover:bg-sky-50 rounded-2xl border border-slate-200 transition group block">
                            <span class="text-[10px] font-extrabold text-sky-700 uppercase block mb-1">{{ $oth->room_type }}</span>
                            <h5 class="font-extrabold text-sm text-slate-900 group-hover:text-[#0284C7] transition-colors mb-1">{{ $oth->name }}</h5>
                            <span class="text-xs font-bold text-emerald-600">৳ {{ number_format($oth->rent_per_day, 0) }}/day</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Reservation Form -->
            <div id="reservation-form" class="lg:col-span-5">
                <div class="card-careplus p-8 border-2 border-sky-100 shadow-2xl">
                    <h3 class="font-extrabold text-xl text-slate-900 mb-1">Reserve {{ $cabin->name }}</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-6">Inpatient admission &amp; cabin reservation</p>

                    @if(session('custom_order_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold leading-relaxed">
                        <i class="fas fa-circle-check text-emerald-600 text-base mr-1"></i>
                        {{ session('custom_order_success') }}
                    </div>
                    @endif

                    <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="booking_type" value="cabin_booking">
                        <input type="hidden" name="cabin_id" value="{{ $cabin->id }}">
                        <input type="hidden" name="company" value="{{ $cabin->name }} ({{ $cabin->room_type }})">

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Patient / Attendant Name *</label>
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
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Admission Date</label>
                            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Health Notes / Requirements</label>
                            <textarea name="message" rows="3" placeholder="Specify patient condition, oxygen requirements, or doctor name..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Confirm Cabin Reservation</span>
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

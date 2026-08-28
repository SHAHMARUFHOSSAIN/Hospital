@extends('layouts.frontend')

@section('title', $doctor->name . ' — ' . ($doctor->specialization ?: $doctor->designation) . ' — CarePlus')

@section('content')

<!-- Header Banner -->
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('directors') }}" class="hover:text-[#0284C7]">Specialist Doctors</a> &rarr; 
            <span class="text-slate-900">{{ $doctor->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Doctor Photo -->
            <div class="lg:col-span-4 flex justify-center">
                <div class="w-64 h-64 sm:w-72 sm:h-72 rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative">
                    <img src="{{ $doctor->photo_url }}" alt="{{ $doctor->name }}"
                        class="w-full h-full object-cover"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=600&q=80';">
                </div>
            </div>

            <!-- Doctor Profile Info -->
            <div class="lg:col-span-8 space-y-4">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas fa-stethoscope"></i> {{ $doctor->specialization ?: 'Senior Specialist' }}
                </div>
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900">{{ $doctor->name }}</h1>
                <p class="text-sm font-bold text-[#0284C7]">{{ $doctor->designation }}</p>
                <p class="text-xs text-slate-600 font-semibold leading-relaxed bg-slate-50 p-4 rounded-2xl border border-slate-200/80">
                    <i class="fas fa-graduation-cap text-[#0284C7] mr-1.5"></i> <strong>Qualifications / Degrees:</strong> {{ $doctor->degree ?: 'MBBS, FCPS, MD, MS' }}
                </p>

                <!-- Chamber & Fee Meta Badges -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2">
                    <div class="p-3 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Consultation Fee</div>
                        <div class="text-base font-extrabold text-slate-900">৳ {{ number_format($doctor->consultation_fee ?: 1000, 2) }}</div>
                    </div>
                    <div class="p-3 bg-sky-50 rounded-xl border border-sky-100">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Chamber Schedule</div>
                        <div class="text-xs font-extrabold text-slate-900 mt-1">{{ $doctor->chamber_days ?: 'Sat - Wed' }} <br><span class="text-sky-700">{{ $doctor->chamber_time ?: '4:00 PM - 8:00 PM' }}</span></div>
                    </div>
                    <div class="p-3 bg-sky-50 rounded-xl border border-sky-100 col-span-2 sm:col-span-1">
                        <div class="text-[10px] uppercase font-bold text-slate-500">Chamber Room</div>
                        <div class="text-sm font-extrabold text-slate-900 mt-1"><i class="fas fa-door-open text-[#0284C7] mr-1"></i> {{ $doctor->room_no ?: 'Room 302' }}</div>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="#booking-form" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i> Book Consultation with {{ $doctor->name }}
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Doctor Bio & Direct Appointment Form -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Bio Details -->
            <div class="lg:col-span-7 space-y-6">
                <h3 class="font-extrabold text-2xl text-slate-900">Doctor Biography &amp; Medical Background</h3>
                <p class="text-slate-600 text-sm leading-relaxed whitespace-pre-line font-medium">{{ $doctor->bio }}</p>

                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 space-y-4">
                    <h4 class="font-extrabold text-base text-slate-900 flex items-center gap-2">
                        <i class="fas fa-shield-heart text-[#0284C7]"></i> Patient Consultation Guidelines
                    </h4>
                    <ul class="space-y-2 text-xs text-slate-600 font-semibold">
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Please arrive 15 minutes before your scheduled appointment serial time.</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Bring any previous medical prescriptions, lab reports, or X-Ray films.</li>
                        <li class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Serial numbers are called strictly in order at Chamber {{ $doctor->room_no ?: 'Room 302' }}.</li>
                    </ul>
                </div>
            </div>

            <!-- Booking Form for this specific doctor -->
            <div id="booking-form" class="lg:col-span-5">
                <div class="card-careplus p-8 border-2 border-sky-100 shadow-2xl">
                    <h3 class="font-extrabold text-xl text-slate-900 mb-1">Book Consultation</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-6">Direct appointment with {{ $doctor->name }}</p>

                    @if(session('custom_order_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold leading-relaxed">
                        <i class="fas fa-circle-check text-emerald-600 text-base mr-1"></i>
                        {{ session('custom_order_success') }}
                    </div>
                    @endif

                    <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="booking_type" value="doctor_appointment">
                        <input type="hidden" name="doctor_id" value="{{ $doctor->id }}">
                        <input type="hidden" name="company" value="{{ $doctor->specialization ?: $doctor->designation }}">

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Patient Name *</label>
                            <input type="text" name="name" required placeholder="Full Name"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('name') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Email Address *</label>
                            <input type="email" name="email" required placeholder="patient@example.com"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-[#0284C7] outline-none text-xs font-semibold" value="{{ old('email') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Phone Number *</label>
                            <input type="tel" name="phone" required placeholder="+880 1700 000000"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold" value="{{ old('phone') }}">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Appointment Date</label>
                            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Symptoms / Notes</label>
                            <textarea name="message" rows="3" placeholder="Briefly describe health symptoms..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Get Appointment Token &amp; Serial</span>
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

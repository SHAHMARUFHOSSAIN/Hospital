@extends('layouts.frontend')

@section('title', $product->name . ' — Medical Service Details — CarePlus')

@section('content')
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <div class="flex items-center gap-2 text-xs font-bold text-slate-500 mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#0284C7]">Home</a> &rarr; 
            <a href="{{ route('products') }}" class="hover:text-[#0284C7]">Medical Services</a> &rarr; 
            <span class="text-slate-900">{{ $product->name }}</span>
        </div>

        <div class="bg-white rounded-3xl p-8 sm:p-10 shadow-xl border border-sky-100 grid lg:grid-cols-12 gap-8 items-center">
            
            <!-- Thumbnail Image -->
            <div class="lg:col-span-5 flex justify-center">
                <div class="w-full aspect-video rounded-3xl overflow-hidden shadow-2xl ring-4 ring-sky-100 relative group bg-slate-100 flex items-center justify-center">
                    <img src="{{ $product->thumbnail_url }}" alt="{{ $product->name }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80';">
                </div>
            </div>

            <!-- Profile / Package Info -->
            <div class="lg:col-span-7 space-y-4">
                @if($product->category)
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-sky-100 text-[#0284C7] rounded-full text-xs font-extrabold uppercase tracking-wider">
                    <i class="fas fa-hand-holding-medical"></i> {{ $product->category->name }}
                </div>
                @endif
                
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight">{{ $product->name }}</h1>
                
                <p class="text-slate-600 text-sm font-medium leading-relaxed bg-slate-50 p-5 rounded-2xl border border-slate-200/80">
                    {{ $product->description ?: 'Comprehensive clinical medical service delivered by senior specialist surgeons and certified healthcare staff.' }}
                </p>

                <div class="pt-2 flex flex-wrap gap-4">
                    <a href="#booking-form" class="px-8 py-3.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-lg shadow-sky-500/20 inline-flex items-center gap-2">
                        <i class="fas fa-calendar-check"></i> Book {{ $product->name }} Service
                    </a>
                    <a href="{{ route('products') }}" class="px-6 py-3.5 bg-white border border-slate-200 text-slate-700 hover:bg-slate-50 font-extrabold text-xs rounded-full inline-flex items-center gap-2">
                        &larr; View All Medical Services
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Details & Booking Form -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12">
            
            <!-- Service Full Specifications & Info -->
            <div class="lg:col-span-7 space-y-6">
                <h3 class="font-extrabold text-2xl text-slate-900">Service Specifications &amp; Clinical Details</h3>
                
                @if($product->specifications)
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 text-xs text-slate-700 font-semibold leading-relaxed whitespace-pre-line">
                    {{ $product->specifications }}
                </div>
                @else
                <div class="bg-slate-50 p-6 rounded-3xl border border-slate-200 space-y-3 text-xs text-slate-600 font-semibold">
                    <p class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Provided in state-of-the-art modular operation theatres (OT) &amp; diagnostic suites.</p>
                    <p class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> Conducted by certified senior consultant physicians and specialized nursing staff.</p>
                    <p class="flex items-center gap-2"><i class="fas fa-check-circle text-emerald-500"></i> 24/7 post-procedure observation and emergency ICU/CCU support available.</p>
                </div>
                @endif

                <!-- Related Services -->
                @if(isset($relatedProducts) && $relatedProducts->count())
                <div class="pt-6">
                    <h4 class="font-extrabold text-lg text-slate-900 mb-4">Related Clinical Offerings</h4>
                    <div class="grid sm:grid-cols-2 gap-4">
                        @foreach($relatedProducts as $rel)
                        <a href="{{ route('products.show', $rel->slug) }}" class="p-4 bg-slate-50 hover:bg-sky-50 rounded-2xl border border-slate-200 transition group block">
                            <h5 class="font-extrabold text-sm text-slate-900 group-hover:text-[#0284C7] transition-colors mb-1">{{ $rel->name }}</h5>
                            <span class="text-[10px] font-bold text-slate-400">View Details &rarr;</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Booking Form for Medical Services -->
            <div id="booking-form" class="lg:col-span-5">
                <div class="card-careplus p-8 border-2 border-sky-100 shadow-2xl">
                    <h3 class="font-extrabold text-xl text-slate-900 mb-1">Book {{ $product->name }}</h3>
                    <p class="text-xs text-slate-500 font-semibold mb-6">Schedule procedure / consultation appointment</p>

                    @if(session('custom_order_success'))
                    <div class="mb-6 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs font-bold leading-relaxed">
                        <i class="fas fa-circle-check text-emerald-600 text-base mr-1"></i>
                        {{ session('custom_order_success') }}
                    </div>
                    @endif

                    <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- EXPLICIT BOOKING TYPE FOR MEDICAL SERVICES -->
                        <input type="hidden" name="booking_type" value="medical_service">
                        <input type="hidden" name="company" value="{{ $product->name }}">

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
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Specialist Doctor (Optional)</label>
                            <select name="doctor_id" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                                <option value="">Any Specialist Physician</option>
                                @foreach(\App\Models\Director::where('is_active', true)->get() as $doc)
                                    <option value="{{ $doc->id }}">{{ $doc->name }} ({{ $doc->designation }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Preferred Appointment Date</label>
                            <input type="date" name="appointment_date" min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Notes / Instructions</label>
                            <textarea name="message" rows="3" placeholder="Specify any health symptoms or procedure requests..."
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                            <span>Confirm Service Booking</span>
                            <i class="fas fa-check-circle"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection
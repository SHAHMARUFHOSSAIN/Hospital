@extends('layouts.frontend')

@section('title', 'Contact Us & Emergency Desk — CarePlus Hospital')

@section('content')
<section class="py-16 bg-gradient-to-b from-[#F0F9FF] to-slate-50 border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest bg-white text-[#0284C7] shadow-sm border border-sky-100 mb-4">
            <i class="fas fa-headset"></i> 24/7 Patient Desk
        </span>
        <h1 class="text-4xl sm:text-5xl font-extrabold text-slate-900 tracking-tight">Contact CarePlus Hospital</h1>
        <div class="w-20 h-1.5 bg-[#0284C7] rounded-full mx-auto mt-4 mb-4"></div>
        <p class="text-slate-600 max-w-2xl mx-auto text-sm font-semibold">Reach out for appointment bookings, ambulance dispatch, diagnostic inquiries, and health card support.</p>
    </div>
</section>

<section class="py-16 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12">
            
            <!-- Contact Form -->
            <div class="card-careplus p-8 sm:p-10 border-2 border-sky-100 shadow-xl">
                <h3 class="font-extrabold text-2xl text-slate-900 mb-2">Send Message to Patient Desk</h3>
                <p class="text-xs text-slate-500 font-semibold mb-6">Our patient relations team will respond within 30 minutes.</p>

                <form action="{{ route('custom-order.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="booking_type" value="medical_service">
                    <input type="hidden" name="company" value="General Contact Inquiry">

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('patient_name') }} *</label>
                        <input type="text" name="name" required placeholder="Full Name" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('email_address') }} *</label>
                        <input type="email" name="email" required placeholder="patient@example.com" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">{{ \App\Helpers\LanguageHelper::get('phone_number') }} *</label>
                        <input type="tel" name="phone" required placeholder="+880 1700 000000" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase text-slate-600 mb-1">Message / Inquiry Details *</label>
                        <textarea name="message" rows="4" required placeholder="How can our clinical team help you?" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-[#0284C7] outline-none text-xs font-semibold resize-none"></textarea>
                    </div>

                    <button type="submit" class="w-full py-4 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs uppercase tracking-wider rounded-full shadow-lg transition-all hover:scale-[1.01] flex items-center justify-center gap-2">
                        <span>Send Patient Inquiry</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>

            <!-- Contact Information Cards -->
            <div class="space-y-6">
                <div class="p-6 bg-white rounded-3xl border border-slate-200 shadow-md flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-phone-volume"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-base">24/7 Emergency Hotline</h4>
                        <p class="text-xs text-rose-600 font-extrabold mt-1">1-800-CARE-NOW (+880 1700 000000)</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">ICU Ambulance &amp; Casualty Unit</p>
                    </div>
                </div>

                <div class="p-6 bg-white rounded-3xl border border-slate-200 shadow-md flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-sky-100 text-[#0284C7] flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-base">Patient Relations Email</h4>
                        <p class="text-xs text-[#0284C7] font-bold mt-1">info@careplushospital.com</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Online booking &amp; report verification desk</p>
                    </div>
                </div>

                <div class="p-6 bg-white rounded-3xl border border-slate-200 shadow-md flex items-start gap-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-xl shrink-0">
                        <i class="fas fa-map-location-dot"></i>
                    </div>
                    <div>
                        <h4 class="font-extrabold text-slate-900 text-base">Hospital Address</h4>
                        <p class="text-xs text-slate-700 font-semibold mt-1">CarePlus Hospital &amp; Research Center</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Plot # 12, Main Medical Drive, Sector 7, Uttara, Dhaka-1230, Bangladesh.</p>
                    </div>
                </div>
                </div>
            </div>

        </div>

        <!-- Interactive Google Map Section -->
        <div class="mt-16 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-xl">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-[#0284C7] uppercase tracking-wider block mb-1">INTERACTIVE CAMPUS MAP</span>
                    <h3 class="font-extrabold text-2xl text-slate-900">Find CarePlus Hospital on Google Maps</h3>
                    <p class="text-xs text-slate-500 font-semibold mt-0.5">Plot # 12, Main Medical Drive, Sector 7, Uttara, Dhaka-1230, Bangladesh.</p>
                </div>
                <a href="https://maps.google.com/?q=Sector+7+Uttara+Dhaka+Bangladesh" target="_blank" class="px-5 py-2.5 bg-[#0284C7] hover:bg-[#0369A1] text-white font-extrabold text-xs rounded-full shadow-md transition flex items-center gap-2">
                    <i class="fas fa-diamond-turn-right"></i>
                    <span>Open Directions in Google Maps</span>
                </a>
            </div>

            <div class="w-full h-[450px] rounded-2xl overflow-hidden shadow-inner border border-slate-200 relative bg-slate-100">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3648.4038848419614!2d90.38927937604104!3d23.87532398452427!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c465f24794e7%3A0xe5a3f3a8b4173873!2sSector%207%2C%20Uttara%2C%20Dhaka%201230!5e0!3m2!1sen!2sbd!4v1700000000000!5m2!1sen!2sbd" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade" 
                    class="w-full h-full rounded-2xl border-0">
                </iframe>
            </div>
        </div>
    </div>
</section>
@endsection
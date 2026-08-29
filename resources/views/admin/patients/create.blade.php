@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-user-plus text-teal-400"></i> Register New Patient
            </h1>
            <a href="{{ route('admin.patients.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Directory</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.patients.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">UHID / Patient ID (Auto Generated)</label>
                        <input type="text" name="patient_id" value="{{ old('patient_id', $patientId) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-sky-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Full Patient Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="e.g. Mohammad Rahman"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. 01700000000"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Email Address (Optional)</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. patient@example.com"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Age (Years) *</label>
                        <input type="number" name="age" value="{{ old('age') }}" required min="0" max="150" placeholder="e.g. 35"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Gender *</label>
                        <select name="gender" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Blood Group</label>
                        <select name="blood_group" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                            <option value="">Select Blood Group</option>
                            @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Present Address</label>
                        <input type="text" name="address" value="{{ old('address') }}" placeholder="e.g. House 12, Road 4, Dhanmondi, Dhaka"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Medical History &amp; Allergies</label>
                    <textarea name="medical_history" rows="3" placeholder="e.g. Diabetic, Hypertension, Penicillin Allergy"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">{{ old('medical_history') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.patients.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Save Patient</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

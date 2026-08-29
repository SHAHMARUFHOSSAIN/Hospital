@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-hand-holding-droplet text-rose-400"></i> Register Volunteer Blood Donor
            </h1>
            <a href="{{ route('admin.blood-donors.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Directory</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.blood-donors.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Donor Full Name *</label>
                        <input type="text" name="donor_name" value="{{ old('donor_name') }}" required placeholder="e.g. Tanvir Hossain"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Blood Group *</label>
                        <select name="blood_group" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                            @foreach(['O+', 'A+', 'B+', 'AB+', 'O-', 'A-', 'B-', 'AB-'] as $bg)
                            <option value="{{ $bg }}" {{ old('blood_group') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Contact Phone Number *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. 01700112233"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Email Address (Optional)</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="e.g. tanvir@example.com"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Age</label>
                        <input type="number" name="age" value="{{ old('age', 25) }}" min="18" max="65"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Gender</label>
                        <select name="gender" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Last Donated Date (Optional)</label>
                        <input type="date" name="last_donated_date" value="{{ old('last_donated_date') }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Donor Eligibility Status</label>
                        <select name="is_eligible" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">
                            <option value="1">Eligible to Donate Blood</option>
                            <option value="0">Currently Ineligible (Rest Period / Medical Condition)</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Living Address / Area</label>
                    <textarea name="address" rows="2" placeholder="e.g. House 14, Sector 7, Uttara, Dhaka"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-rose-500">{{ old('address') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.blood-donors.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-rose-600 hover:bg-rose-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Save Blood Donor</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-truck-medical text-sky-400"></i> Dispatch Emergency Ambulance
            </h1>
            <a href="{{ route('admin.ambulance-dispatches.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Dispatches</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.ambulance-dispatches.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Dispatch Serial No</label>
                        <input type="text" name="dispatch_no" value="{{ old('dispatch_no', $dispatchNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-sky-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Patient / Caller Name *</label>
                        <input type="text" name="patient_name" value="{{ old('patient_name') }}" required placeholder="e.g. Mrs. Sharmin Akter"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Emergency Contact Phone *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required placeholder="e.g. 01711998877"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Ambulance Vehicle Registration No *</label>
                        <input type="text" name="vehicle_no" value="{{ old('vehicle_no', 'DHAKA METRO-CHA-11-2026') }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Assigned Driver Name *</label>
                        <input type="text" name="driver_name" value="{{ old('driver_name', 'Md. Jahangir Alam') }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Driver Phone Number</label>
                        <input type="text" name="driver_phone" value="{{ old('driver_phone', '01812345678') }}"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Pickup Location Address *</label>
                        <input type="text" name="pickup_location" value="{{ old('pickup_location') }}" required placeholder="e.g. Sector 10, Uttara, Dhaka"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Destination Address *</label>
                        <input type="text" name="destination" value="{{ old('destination', 'CarePlus Hospital Emergency ER Suite') }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Ambulance Trip Fare (৳) *</label>
                        <input type="number" step="0.01" name="fare_amount" value="{{ old('fare_amount', 2500) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-emerald-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Trip Status *</label>
                        <select name="status" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-sky-500">
                            <option value="dispatched">Dispatched</option>
                            <option value="on_route">On Route to Emergency ER</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.ambulance-dispatches.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Confirm Ambulance Dispatch</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

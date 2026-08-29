@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-bed-pulse text-indigo-400"></i> Admit Patient to IPD Cabin / Ward
            </h1>
            <a href="{{ route('admin.ipd-admissions.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Admissions</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.ipd-admissions.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Admission No</label>
                        <input type="text" name="admission_no" value="{{ old('admission_no', $admissionNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-indigo-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient *</label>
                        <select name="patient_id" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">
                            <option value="">Choose Patient...</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Allocate Cabin / Room Bed *</label>
                        <select name="cabin_id" id="cabinSelect" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">
                            <option value="" data-rent="0">Choose Available Cabin...</option>
                            @foreach($cabins as $c)
                            <option value="{{ $c->id }}" data-rent="{{ $c->price }}" {{ old('cabin_id') == $c->id ? 'selected' : '' }}>
                                Room {{ $c->room_number }} - {{ $c->title }} (৳{{ number_format($c->price, 2) }}/day - {{ strtoupper($c->status) }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Attending Specialist Doctor</label>
                        <select name="attending_doctor_id" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">
                            <option value="">General Duty Medical Officer</option>
                            @foreach($doctors as $d)
                            <option value="{{ $d->id }}" {{ old('attending_doctor_id') == $d->id ? 'selected' : '' }}>
                                Dr. {{ $d->name }} ({{ $d->designation }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Admission Date &amp; Time *</label>
                        <input type="datetime-local" name="admission_date" value="{{ old('admission_date', date('Y-m-d\TH:i')) }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Daily Room Rent Rate (৳) *</label>
                        <input type="number" step="0.01" name="daily_rent" id="dailyRentInput" value="{{ old('daily_rent', 2500) }}" required min="0"
                            class="w-full bg-slate-950 border border-slate-800 text-emerald-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Admission Notes &amp; Symptoms</label>
                    <textarea name="notes" rows="3" placeholder="Reason for admission e.g. Post-operative observation, severe acute pain"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-indigo-500">{{ old('notes') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.ipd-admissions.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Confirm Patient Admission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const cabinSelect = document.getElementById('cabinSelect');
    const rentInput = document.getElementById('dailyRentInput');

    cabinSelect.addEventListener('change', function () {
        const option = this.options[this.selectedIndex];
        const rent = option.dataset.rent || 0;
        if (rent > 0) {
            rentInput.value = rent;
        }
    });
});
</script>
@endsection

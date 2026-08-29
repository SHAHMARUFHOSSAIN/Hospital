@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-scissors text-teal-400"></i> Schedule Operation Theatre (OT) Surgery
            </h1>
            <a href="{{ route('admin.ot-schedules.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to OT Schedules</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.ot-schedules.store') }}" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">OT Booking Serial</label>
                        <input type="text" name="ot_no" value="{{ old('ot_no', $otNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-teal-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient *</label>
                        <select name="patient_id" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                            <option value="">Choose Patient...</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ old('patient_id') == $p->id ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Operation / Procedure Name *</label>
                        <input type="text" name="operation_type" value="{{ old('operation_type') }}" required placeholder="e.g. Laparoscopic Cholecystectomy / Appendectomy"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Primary Lead Surgeon</label>
                        <select name="surgeon_id" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                            <option value="">Chief Surgical Officer</option>
                            @foreach($surgeons as $s)
                            <option value="{{ $s->id }}" {{ old('surgeon_id') == $s->id ? 'selected' : '' }}>
                                Dr. {{ $s->name }} ({{ $s->designation }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Operation Theatre Suite / Room *</label>
                        <select name="ot_room" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                            <option value="OT Suite 01 (General Surgery)">OT Suite 01 (General Surgery)</option>
                            <option value="OT Suite 02 (Orthopedics &amp; Trauma)">OT Suite 02 (Orthopedics &amp; Trauma)</option>
                            <option value="Cardiac OT 03 (Heart &amp; Vascular)">Cardiac OT 03 (Heart &amp; Vascular)</option>
                            <option value="Neuro OT 04 (Brain &amp; Spine)">Neuro OT 04 (Brain &amp; Spine)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Scheduled Date &amp; Time *</label>
                        <input type="datetime-local" name="scheduled_datetime" value="{{ old('scheduled_datetime', date('Y-m-d\TH:i')) }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Consultant Anesthetist Name</label>
                        <input type="text" name="anesthetist_name" value="{{ old('anesthetist_name') }}" placeholder="e.g. Dr. M. A. Karim, DA"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Status *</label>
                        <select name="status" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">
                            <option value="scheduled">Scheduled</option>
                            <option value="in_progress">In Progress (Inside OT)</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Pre-operative Instructions &amp; Notes</label>
                    <textarea name="notes" rows="3" placeholder="Special equipment e.g. C-Arm Fluoroscopy, Harmonic Scalpel required"
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-teal-500">{{ old('notes') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.ot-schedules.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-teal-600 hover:bg-teal-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Confirm OT Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

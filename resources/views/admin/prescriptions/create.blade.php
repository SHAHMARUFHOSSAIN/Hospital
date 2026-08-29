@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-file-prescription text-sky-400"></i> E-Prescription (Rx) Builder
            </h1>
            <a href="{{ route('admin.prescriptions.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Prescriptions</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.prescriptions.store') }}" class="space-y-6" id="rxForm">
                @csrf

                <!-- Rx No & Patient / Doctor Selection -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pb-6 border-b border-slate-800">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Rx Serial No</label>
                        <input type="text" name="prescription_no" value="{{ old('prescription_no', $prescriptionNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-sky-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient *</label>
                        <select name="patient_id" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                            <option value="">Choose Patient...</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ (old('patient_id', $selectedPatientId) == $p->id) ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Attending Doctor</label>
                        <select name="doctor_id" class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                            <option value="">General OPD Doctor</option>
                            @foreach($doctors as $d)
                            <option value="{{ $d->id }}" {{ old('doctor_id') == $d->id ? 'selected' : '' }}>
                                Dr. {{ $d->name }} ({{ $d->designation }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Patient Vitals Bar -->
                <div>
                    <h3 class="text-xs font-extrabold uppercase text-slate-400 mb-3">Patient Vitals &amp; Examination</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        <div>
                            <input type="text" name="vitals_bp" value="{{ old('vitals_bp') }}" placeholder="BP (e.g. 120/80)"
                                class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                        </div>
                        <div>
                            <input type="text" name="vitals_pulse" value="{{ old('vitals_pulse') }}" placeholder="Pulse (e.g. 78 bpm)"
                                class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                        </div>
                        <div>
                            <input type="text" name="vitals_weight" value="{{ old('vitals_weight') }}" placeholder="Weight (e.g. 68 kg)"
                                class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                        </div>
                        <div>
                            <input type="text" name="vitals_temp" value="{{ old('vitals_temp') }}" placeholder="Temp (e.g. 98.6 F)"
                                class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                        </div>
                    </div>
                </div>

                <!-- Complaints & Diagnosis -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Chief Complaints / Symptoms</label>
                        <textarea name="chief_complaints" rows="3" placeholder="e.g. Fever for 3 days, dry cough, headache"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">{{ old('chief_complaints') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Clinical Diagnosis</label>
                        <textarea name="diagnosis" rows="3" placeholder="e.g. Viral Upper Respiratory Tract Infection (URTI)"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">{{ old('diagnosis') }}</textarea>
                    </div>
                </div>

                <!-- Dynamic Medicines Table -->
                <div class="pt-4 border-t border-slate-800">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold uppercase text-sky-400 flex items-center gap-2">
                            <i class="fas fa-[#0284C7] fa-pills"></i> Prescribed Medicines (Rx)
                        </h3>
                        <button type="button" id="addMedicineBtn" class="px-3 py-1.5 bg-sky-500/20 hover:bg-sky-500/30 text-sky-300 font-bold text-xs rounded-lg border border-sky-500/30 transition">
                            + Add Medicine Row
                        </button>
                    </div>

                    <div class="space-y-3" id="medicineContainer">
                        <!-- Row 1 Default -->
                        <div class="grid grid-cols-12 gap-2 medicine-row items-center">
                            <div class="col-span-4">
                                <input type="text" name="medicines[0][name]" placeholder="Medicine Name (e.g. Tab. Napa Extend 665mg)" required
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                            </div>
                            <div class="col-span-3">
                                <input type="text" name="medicines[0][dosage]" placeholder="Dose (e.g. 1 + 0 + 1)"
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                            </div>
                            <div class="col-span-2">
                                <input type="text" name="medicines[0][timing]" placeholder="Timing (e.g. After Food)"
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                            </div>
                            <div class="col-span-2">
                                <input type="text" name="medicines[0][duration]" placeholder="Duration (e.g. 7 Days)"
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" class="remove-row-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Advised Tests & General Advice -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-800">
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Advised Diagnostic Tests</label>
                        <textarea name="advised_tests" rows="3" placeholder="e.g. CBC, Chest X-Ray (P/A View), Serum Creatinine"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">{{ old('advised_tests') }}</textarea>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">General Advice &amp; Instructions</label>
                        <textarea name="general_advice" rows="3" placeholder="e.g. Drink plenty of warm water, take proper bed rest for 3 days."
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">{{ old('general_advice') }}</textarea>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Follow-up Date (Optional)</label>
                    <input type="date" name="follow_up_date" value="{{ old('follow_up_date') }}"
                        class="w-full sm:w-64 bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-[#0284C7]">
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.prescriptions.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Generate Prescription</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let rowIndex = 1;
    const container = document.getElementById('medicineContainer');
    const addBtn = document.getElementById('addMedicineBtn');

    addBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'grid grid-cols-12 gap-2 medicine-row items-center';
        row.innerHTML = `
            <div class="col-span-4">
                <input type="text" name="medicines[${rowIndex}][name]" placeholder="Medicine Name" required
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
            </div>
            <div class="col-span-3">
                <input type="text" name="medicines[${rowIndex}][dosage]" placeholder="Dose (e.g. 1+0+1)"
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
            </div>
            <div class="col-span-2">
                <input type="text" name="medicines[${rowIndex}][timing]" placeholder="Timing"
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
            </div>
            <div class="col-span-2">
                <input type="text" name="medicines[${rowIndex}][duration]" placeholder="Duration"
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3.5 py-2.5 outline-none focus:border-[#0284C7]">
            </div>
            <div class="col-span-1 text-center">
                <button type="button" class="remove-row-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        rowIndex++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-row-btn')) {
            const rows = container.querySelectorAll('.medicine-row');
            if (rows.length > 1) {
                e.target.closest('.medicine-row').remove();
            }
        }
    });
});
</script>
@endsection

@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-4xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-extrabold text-white flex items-center gap-2">
                <i class="fas fa-vial text-purple-400"></i> Create Diagnostic Test Report
            </h1>
            <a href="{{ route('admin.lab-reports.index') }}" class="text-xs text-slate-400 hover:text-white font-bold">&larr; Back to Reports</a>
        </div>

        <div class="bg-slate-900 rounded-2xl p-6 border border-slate-800">
            <form method="POST" action="{{ route('admin.lab-reports.store') }}" class="space-y-6" id="reportForm">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-6 border-b border-slate-800">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 mb-2">Report Serial No</label>
                        <input type="text" name="report_no" value="{{ old('report_no', $reportNo) }}" readonly required
                            class="w-full bg-slate-950 border border-slate-800 text-purple-400 font-extrabold text-xs rounded-xl px-4 py-3 outline-none cursor-not-allowed">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Select Patient *</label>
                        <select name="patient_id" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">
                            <option value="">Choose Patient...</option>
                            @foreach($patients as $p)
                            <option value="{{ $p->id }}" {{ (old('patient_id', $selectedPatientId) == $p->id) ? 'selected' : '' }}>
                                {{ $p->name }} ({{ $p->patient_id }} - {{ $p->phone }})
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Test Name *</label>
                        <input type="text" name="test_name" value="{{ old('test_name') }}" required placeholder="e.g. Complete Blood Count (CBC) / Serum Creatinine"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Referred Doctor Name</label>
                        <input type="text" name="referred_by" value="{{ old('referred_by') }}" placeholder="e.g. Dr. K. Rahman"
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Report Date *</label>
                        <input type="date" name="report_date" value="{{ old('report_date', date('Y-m-d')) }}" required
                            class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-300 mb-2">Status *</label>
                        <select name="status" required class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">
                            <option value="completed">Completed &amp; Verified</option>
                            <option value="processing">Under Processing</option>
                        </select>
                    </div>
                </div>

                <!-- Dynamic Test Parameters Table -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-extrabold uppercase text-purple-400 flex items-center gap-2">
                            <i class="fas fa-list"></i> Test Parameters &amp; Values
                        </h3>
                        <button type="button" id="addParamBtn" class="px-3 py-1.5 bg-purple-500/20 hover:bg-purple-500/30 text-purple-300 font-bold text-xs rounded-lg border border-purple-500/30 transition">
                            + Add Parameter Row
                        </button>
                    </div>

                    <div class="space-y-3" id="paramContainer">
                        <div class="grid grid-cols-12 gap-2 param-row items-center">
                            <div class="col-span-4">
                                <input type="text" name="parameters[0][parameter]" placeholder="Parameter (e.g. Hemoglobin)" required
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
                            </div>
                            <div class="col-span-3">
                                <input type="text" name="parameters[0][value]" placeholder="Result Value (e.g. 13.5)" required
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
                            </div>
                            <div class="col-span-2">
                                <input type="text" name="parameters[0][unit]" placeholder="Unit (e.g. g/dL)"
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
                            </div>
                            <div class="col-span-2">
                                <input type="text" name="parameters[0][reference_range]" placeholder="Ref Range (e.g. 12.0 - 16.0)"
                                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
                            </div>
                            <div class="col-span-1 text-center">
                                <button type="button" class="remove-param-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-300 mb-2">Pathologist Impression / Comments</label>
                    <textarea name="impression" rows="3" placeholder="e.g. Blood picture shows normal hemoglobin and RBC count."
                        class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-4 py-3 outline-none focus:border-purple-500">{{ old('impression') }}</textarea>
                </div>

                <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                    <a href="{{ route('admin.lab-reports.index') }}" class="px-5 py-2.5 bg-slate-800 text-slate-300 text-xs font-bold rounded-xl hover:bg-slate-700 transition">Cancel</a>
                    <button type="submit" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg">Save &amp; Generate Report</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let paramIndex = 1;
    const container = document.getElementById('paramContainer');
    const addBtn = document.getElementById('addParamBtn');

    addBtn.addEventListener('click', function () {
        const row = document.createElement('div');
        row.className = 'grid grid-cols-12 gap-2 param-row items-center';
        row.innerHTML = `
            <div class="col-span-4">
                <input type="text" name="parameters[${paramIndex}][parameter]" placeholder="Parameter" required
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
            </div>
            <div class="col-span-3">
                <input type="text" name="parameters[${paramIndex}][value]" placeholder="Result Value" required
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
            </div>
            <div class="col-span-2">
                <input type="text" name="parameters[${paramIndex}][unit]" placeholder="Unit"
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
            </div>
            <div class="col-span-2">
                <input type="text" name="parameters[${paramIndex}][reference_range]" placeholder="Ref Range"
                    class="w-full bg-slate-950 border border-slate-800 text-white text-xs rounded-xl px-3 py-2.5 outline-none focus:border-purple-500">
            </div>
            <div class="col-span-1 text-center">
                <button type="button" class="remove-param-btn text-rose-400 hover:text-rose-300 font-bold text-sm p-1">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        container.appendChild(row);
        paramIndex++;
    });

    container.addEventListener('click', function (e) {
        if (e.target.closest('.remove-param-btn')) {
            const rows = container.querySelectorAll('.param-row');
            if (rows.length > 1) {
                e.target.closest('.param-row').remove();
            }
        }
    });
});
</script>
@endsection

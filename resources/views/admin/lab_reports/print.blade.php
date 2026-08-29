<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Report — {{ $labReport->report_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f8fafc; color: #0f172a; }
        @media print {
            .no-print { display: none !important; }
            body { background: white !important; padding: 0 !important; }
            .print-container { shadow: none !important; border: none !important; margin: 0 !important; max-width: 100% !important; }
        }
    </style>
</head>
<body class="py-8 px-4">

    <!-- Top Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print bg-slate-900 p-4 rounded-2xl text-white shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-vial text-purple-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Official Diagnostic Lab Report</h3>
                <p class="text-slate-400 text-xs">Print or save as PDF diagnostic report for patient</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Diagnostic Report
        </button>
    </div>

    <!-- Printable Diagnostic Report Sheet Container -->
    <div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 sm:p-12 shadow-2xl border border-slate-200 print-container overflow-hidden min-h-[1050px] flex flex-col justify-between">
        
        <div>
            <!-- Diagnostic Laboratory Header with Logo -->
            <div class="flex items-center justify-between pb-6 border-b-2 border-purple-600">
                <div class="flex items-center gap-4">
                    <!-- Brand Logo Badge -->
                    <div class="w-14 h-14 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-purple-500/20 shrink-0">
                        <i class="fas fa-microscope"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 leading-tight">
                            Care<span class="text-purple-600">Plus</span> Diagnostics
                        </h1>
                        <p class="text-xs font-bold text-purple-600 uppercase tracking-widest">&amp; Clinical Laboratory Services</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">Accredited High-Precision Diagnostic Imaging &amp; Pathology Center</p>
                    </div>
                </div>

                <div class="text-right text-xs text-slate-600 space-y-0.5">
                    <p class="font-bold text-slate-900"><i class="fas fa-location-dot text-purple-600 mr-1"></i> Diagnostic Wing</p>
                    <p>Dhanmondi, Dhaka &bull; Hotline: <strong>1-800-CARE-NOW</strong></p>
                    <p><i class="fas fa-globe text-purple-600 mr-1"></i> www.careplushospital.com</p>
                </div>
            </div>

            <!-- Patient & Report Metadata Header -->
            <div class="my-6 p-4 bg-purple-50/60 rounded-2xl border border-purple-200/80 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold">
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Patient Name</span>
                    <strong class="text-slate-900 text-sm block truncate">{{ $labReport->patient->name ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">UHID / Patient ID</span>
                    <strong class="text-sky-600 text-sm block">{{ $labReport->patient->patient_id ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Report No</span>
                    <strong class="text-purple-600 text-sm block">{{ $labReport->report_no }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Report Date</span>
                    <strong class="text-slate-900 text-xs block">{{ $labReport->report_date->format('d/m/Y') }}</strong>
                </div>
            </div>

            <div class="flex items-center justify-between pb-3 mb-6 border-b border-slate-200 text-xs">
                <p><span class="text-slate-500 font-semibold">Referred By Doctor:</span> <strong class="text-slate-900">{{ $labReport->referred_by ?: 'Self / OPD Doctor' }}</strong></p>
                <p><span class="text-slate-500 font-semibold">Status:</span> <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">VERIFIED</span></p>
            </div>

            <!-- Test Title Header -->
            <div class="bg-purple-100/70 p-3 rounded-xl border border-purple-200 text-center mb-6">
                <h2 class="text-base font-extrabold text-purple-900 uppercase tracking-wide">{{ $labReport->test_name }}</h2>
            </div>

            <!-- Parameters Table -->
            <div class="mb-8">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="bg-slate-100 text-slate-700 font-extrabold uppercase border-b border-slate-300">
                            <th class="py-3 px-4 text-left">Parameter / Investigation</th>
                            <th class="py-3 px-4 text-left">Observed Value</th>
                            <th class="py-3 px-4 text-left">Unit</th>
                            <th class="py-3 px-4 text-left">Standard Reference Range</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 font-medium">
                        @forelse($labReport->parameters ?? [] as $p)
                        <tr>
                            <td class="py-3.5 px-4 font-extrabold text-slate-900">{{ $p['parameter'] ?? '' }}</td>
                            <td class="py-3.5 px-4 font-black text-purple-700 text-sm">{{ $p['value'] ?? '' }}</td>
                            <td class="py-3.5 px-4 text-slate-600 font-semibold">{{ $p['unit'] ?? '' }}</td>
                            <td class="py-3.5 px-4 text-slate-500">{{ $p['reference_range'] ?? 'N/A' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-6 text-center text-slate-400 italic">No parameters recorded.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pathologist Impression Box -->
            @if($labReport->impression)
            <div class="p-4 bg-slate-50 rounded-2xl border border-slate-200 text-xs">
                <span class="text-[10px] font-extrabold uppercase text-purple-700 block mb-1">Pathologist Impression &amp; Remarks</span>
                <p class="font-bold text-slate-800 whitespace-pre-line">{{ $labReport->impression }}</p>
            </div>
            @endif
        </div>

        <!-- Pathologist Signature Footer -->
        <div class="pt-10 border-t border-slate-200 flex items-end justify-between text-xs mt-12">
            <div>
                <p class="text-[10px] text-slate-400 font-semibold">CarePlus High-Precision LIS System</p>
                <p class="text-[10px] text-slate-400">Authentic Diagnostic Report verified by Chief Pathologist</p>
            </div>
            <div class="text-center w-56">
                <div class="border-b-2 border-slate-800 pb-1 mb-1 font-extrabold text-slate-900">
                    Chief Pathologist
                </div>
                <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider block">MBBS, MD (Pathology)</span>
            </div>
        </div>

    </div>

</body>
</html>

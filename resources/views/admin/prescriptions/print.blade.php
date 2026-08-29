<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription — {{ $prescription->prescription_no }}</title>
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
        .watermark {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 8rem;
            font-weight: 900;
            color: rgba(2, 132, 199, 0.03);
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
        }
    </style>
</head>
<body class="py-8 px-4">

    <!-- Top Floating Print Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex items-center justify-between no-print bg-slate-900 p-4 rounded-2xl text-white shadow-lg">
        <div class="flex items-center gap-3">
            <i class="fas fa-file-prescription text-sky-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Official E-Prescription Letterhead</h3>
                <p class="text-slate-400 text-xs">Print or save as PDF for patient records</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-[#0284C7] hover:bg-sky-600 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Prescription
        </button>
    </div>

    <!-- Main Printable Letterhead Sheet Container -->
    <div class="max-w-4xl mx-auto bg-white rounded-3xl p-8 sm:p-12 shadow-2xl border border-slate-200 relative print-container overflow-hidden min-h-[1050px] flex flex-col justify-between">
        
        <!-- Background Watermark -->
        <div class="watermark">CAREPLUS HOSPITAL</div>

        <div>
            <!-- Official Hospital Letterhead Header with Logo -->
            <div class="flex items-center justify-between pb-6 border-b-2 border-[#0284C7]">
                <div class="flex items-center gap-4">
                    <!-- Brand Logo Badge -->
                    <div class="w-14 h-14 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-sky-500/20 shrink-0">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl sm:text-3xl font-black tracking-tight text-slate-900 leading-tight">
                            Care<span class="text-[#0284C7]">Plus</span> Hospital
                        </h1>
                        <p class="text-xs font-bold text-sky-600 uppercase tracking-widest">&amp; Research Center Ltd.</p>
                        <p class="text-[11px] text-slate-500 font-semibold mt-0.5">24/7 Tertiary Clinical Care &amp; Emergency Center</p>
                    </div>
                </div>

                <div class="text-right text-xs text-slate-600 space-y-0.5">
                    <p class="font-bold text-slate-900"><i class="fas fa-location-dot text-[#0284C7] mr-1"></i> Dhanmondi Main Campus</p>
                    <p>House 12, Road 4, Dhanmondi, Dhaka</p>
                    <p><i class="fas fa-phone text-[#0284C7] mr-1"></i> Hotline: <strong class="text-slate-900">1-800-CARE-NOW</strong></p>
                    <p><i class="fas fa-globe text-[#0284C7] mr-1"></i> www.careplushospital.com</p>
                </div>
            </div>

            <!-- Patient & Doctor Metadata Header Bar -->
            <div class="my-6 p-4 bg-sky-50/60 rounded-2xl border border-sky-100 grid grid-cols-2 sm:grid-cols-4 gap-4 text-xs font-semibold">
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Patient Name</span>
                    <strong class="text-slate-900 text-sm block truncate">{{ $prescription->patient->name ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">UHID / Patient ID</span>
                    <strong class="text-[#0284C7] text-sm block">{{ $prescription->patient->patient_id ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Age / Gender</span>
                    <strong class="text-slate-900 text-sm block">{{ $prescription->patient->age ?? 'N/A' }} Yrs / {{ $prescription->patient->gender ?? 'N/A' }}</strong>
                </div>
                <div>
                    <span class="text-[10px] text-slate-400 uppercase font-extrabold tracking-wider block">Date &amp; Rx No</span>
                    <strong class="text-slate-900 text-xs block">{{ $prescription->created_at->format('d/m/Y') }}</strong>
                    <span class="text-[10px] text-sky-600 font-bold">{{ $prescription->prescription_no }}</span>
                </div>
            </div>

            <!-- Doctor Specialty Info & Vitals Bar -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200 mb-6">
                <div>
                    <h2 class="text-base font-extrabold text-slate-900">Dr. {{ $prescription->doctor->name ?? 'Attending Medical Officer' }}</h2>
                    <p class="text-xs text-[#0284C7] font-bold">{{ $prescription->doctor->degree ?? 'MBBS, FCPS, MD' }}</p>
                    <p class="text-[11px] text-slate-500 font-semibold">{{ $prescription->doctor->designation ?? 'Senior Consultant' }} &bull; BMDC Reg: A-54321</p>
                </div>

                @if($prescription->vitals_bp || $prescription->vitals_pulse || $prescription->vitals_weight || $prescription->vitals_temp)
                <div class="px-4 py-2 bg-slate-100 rounded-xl border border-slate-200 flex items-center gap-4 text-xs">
                    @if($prescription->vitals_bp)<div><span class="text-slate-500">BP:</span> <strong class="text-slate-900">{{ $prescription->vitals_bp }}</strong></div>@endif
                    @if($prescription->vitals_pulse)<div><span class="text-slate-500">Pulse:</span> <strong class="text-slate-900">{{ $prescription->vitals_pulse }}</strong></div>@endif
                    @if($prescription->vitals_weight)<div><span class="text-slate-500">Weight:</span> <strong class="text-slate-900">{{ $prescription->vitals_weight }}</strong></div>@endif
                    @if($prescription->vitals_temp)<div><span class="text-slate-500">Temp:</span> <strong class="text-slate-900">{{ $prescription->vitals_temp }}</strong></div>@endif
                </div>
                @endif
            </div>

            <!-- Complaints & Diagnosis -->
            @if($prescription->chief_complaints || $prescription->diagnosis)
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6 text-xs">
                @if($prescription->chief_complaints)
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200">
                    <span class="text-[10px] font-extrabold uppercase text-slate-400 block mb-1">Chief Complaints</span>
                    <p class="font-semibold text-slate-800 whitespace-pre-line">{{ $prescription->chief_complaints }}</p>
                </div>
                @endif
                @if($prescription->diagnosis)
                <div class="p-3 bg-sky-50/50 rounded-xl border border-sky-100">
                    <span class="text-[10px] font-extrabold uppercase text-sky-600 block mb-1">Clinical Diagnosis</span>
                    <p class="font-extrabold text-slate-900 whitespace-pre-line">{{ $prescription->diagnosis }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Rx Symbol & Medicines List -->
            <div class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-3xl font-black italic text-[#0284C7]">Rx</span>
                    <div class="h-0.5 flex-1 bg-slate-200"></div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700 font-extrabold uppercase border-b border-slate-300">
                                <th class="py-3 px-4 text-left w-12">#</th>
                                <th class="py-3 px-4 text-left">Medicine Name</th>
                                <th class="py-3 px-4 text-left">Dosage</th>
                                <th class="py-3 px-4 text-left">Timing</th>
                                <th class="py-3 px-4 text-left">Duration</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 font-medium">
                            @forelse($prescription->medicines ?? [] as $index => $med)
                            <tr>
                                <td class="py-3.5 px-4 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-3.5 px-4 font-extrabold text-slate-900 text-sm">{{ $med['name'] ?? '' }}</td>
                                <td class="py-3.5 px-4 font-bold text-[#0284C7]">{{ $med['dosage'] ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-slate-700">{{ $med['timing'] ?? '-' }}</td>
                                <td class="py-3.5 px-4 text-slate-600 font-semibold">{{ $med['duration'] ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-slate-400 italic">No prescribed medicines listed.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Advised Investigations & Special Advice -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-slate-200 text-xs">
                @if($prescription->advised_tests)
                <div>
                    <span class="text-[10px] font-extrabold uppercase text-amber-600 block mb-1">Advised Diagnostic Investigations</span>
                    <p class="font-bold text-slate-800 bg-amber-50/60 p-3 rounded-xl border border-amber-200/80 whitespace-pre-line">{{ $prescription->advised_tests }}</p>
                </div>
                @endif
                @if($prescription->general_advice)
                <div>
                    <span class="text-[10px] font-extrabold uppercase text-emerald-600 block mb-1">General Advice &amp; Instructions</span>
                    <p class="font-semibold text-slate-800 bg-emerald-50/60 p-3 rounded-xl border border-emerald-200/80 whitespace-pre-line">{{ $prescription->general_advice }}</p>
                </div>
                @endif
            </div>

            @if($prescription->follow_up_date)
            <div class="mt-6 p-3 bg-sky-50 rounded-xl border border-sky-200 text-sky-700 text-xs font-bold text-center">
                <i class="fas fa-calendar-day mr-1"></i> Follow-up Visit Date: {{ $prescription->follow_up_date->format('M d, Y') }}
            </div>
            @endif
        </div>

        <!-- Footer Signature & Authenticity Stamp -->
        <div class="pt-10 border-t border-slate-200 flex items-end justify-between text-xs mt-12">
            <div>
                <p class="text-[10px] text-slate-400 font-semibold">Generated via CarePlus EMR System</p>
                <p class="text-[10px] text-slate-400">Scan QR Code or visit careplus.com for authenticity</p>
            </div>
            <div class="text-center w-56">
                <div class="border-b-2 border-slate-800 pb-1 mb-1 font-extrabold text-slate-900">
                    Dr. {{ $prescription->doctor->name ?? 'Attending Doctor' }}
                </div>
                <span class="text-[10px] text-slate-500 font-bold uppercase tracking-wider block">Signature &amp; Seal</span>
            </div>
        </div>

    </div>

</body>
</html>

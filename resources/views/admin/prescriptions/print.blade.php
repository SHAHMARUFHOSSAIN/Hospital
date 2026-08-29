<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prescription — {{ $prescription->prescription_no }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { font-family: 'Plus Jakarta Sans', sans-serif; box-sizing: border-box; }
        
        @page {
            size: A4 portrait;
            margin: 0;
        }

        @media print {
            html, body {
                width: 210mm;
                height: 297mm;
                margin: 0 !important;
                padding: 0 !important;
                background: #ffffff !important;
                overflow: hidden !important;
            }
            .no-print { display: none !important; }
            .a4-page {
                width: 210mm !important;
                height: 297mm !important;
                max-height: 297mm !important;
                margin: 0 !important;
                padding: 12mm 15mm !important;
                box-shadow: none !important;
                border: none !important;
                border-radius: 0 !important;
                page-break-after: avoid !important;
                page-break-inside: avoid !important;
            }
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            max-height: 297mm;
            margin: 0 auto;
            padding: 12mm 15mm;
            background: #ffffff;
            position: relative;
            display: flex;
            flex-col;
            justify-content: space-between;
            overflow: hidden;
        }

        /* Full Uncropped Transparent Watermark */
        .watermark-container {
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 65%;
            max-height: 55%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0.04;
            pointer-events: none;
            user-select: none;
            z-index: 0;
        }
    </style>
</head>
<body class="bg-slate-100 py-6">

    <!-- Top Action Bar -->
    <div class="max-w-[210mm] mx-auto mb-4 flex items-center justify-between no-print bg-slate-900 p-4 rounded-2xl text-white shadow-xl">
        <div class="flex items-center gap-3">
            <i class="fas fa-file-prescription text-sky-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Enterprise E-Prescription (A4 Print Ready)</h3>
                <p class="text-slate-400 text-xs">Optimized for single-page A4 print output without cropping</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-[#0284C7] hover:bg-sky-600 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Prescription
        </button>
    </div>

    <!-- Main Printable A4 Container -->
    <div class="a4-page shadow-2xl border border-slate-200 rounded-2xl relative">
        
        <!-- Full Uncropped Transparent Logo/Seal Watermark -->
        <div class="watermark-container">
            @php
                $logoUrl = \App\Models\Media::where('type', 'logo')->value('url') ?: asset('images/logo.png');
            @endphp
            <img src="{{ $logoUrl }}" class="w-64 h-auto object-contain max-h-64 mb-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="text-center font-black text-6xl tracking-widest text-slate-900 uppercase" style="display:none;">CAREPLUS</div>
            <span class="text-3xl font-black text-slate-900 uppercase tracking-widest mt-2">CarePlus Hospital</span>
            <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Official Medical Document</span>
        </div>

        <div class="relative z-10 flex-1 flex flex-col justify-between">
            <div>
                <!-- Hospital Letterhead Header -->
                <div class="flex items-center justify-between pb-4 border-b-2 border-[#0284C7]">
                    <div class="flex items-center gap-4">
                        <!-- Dynamic Logo Image with Transparent Fallback -->
                        <img src="{{ $logoUrl }}" class="h-14 w-auto max-w-[180px] object-contain" 
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#0284C7] to-[#06B6D4] rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-md shrink-0" style="display:none;">
                            <i class="fas fa-plus"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black tracking-tight text-slate-900 leading-none">
                                Care<span class="text-[#0284C7]">Plus</span> Hospital
                            </h1>
                            <p class="text-[10px] font-extrabold text-sky-600 uppercase tracking-widest mt-1">&amp; Research Center Ltd.</p>
                            <p class="text-[10px] text-slate-500 font-semibold">24/7 Tertiary Healthcare &amp; Critical Emergency Network</p>
                        </div>
                    </div>

                    <div class="text-right text-[11px] text-slate-600 space-y-0.5">
                        <p class="font-extrabold text-slate-900">Dhanmondi Main Campus</p>
                        <p>House 12, Road 4, Dhanmondi, Dhaka-1205</p>
                        <p>Hotline: <strong class="text-slate-900">1-800-CARE-NOW</strong></p>
                        <p class="text-[#0284C7] font-bold">www.careplushospital.com</p>
                    </div>
                </div>

                <!-- Patient & Rx Barcode Strip -->
                <div class="my-4 p-3 bg-sky-50/70 rounded-xl border border-sky-100 grid grid-cols-4 gap-3 text-xs font-semibold">
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Patient Name</span>
                        <strong class="text-slate-900 text-xs block truncate">{{ $prescription->patient->name ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">UHID / Patient ID</span>
                        <strong class="text-[#0284C7] text-xs block">{{ $prescription->patient->patient_id ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Age / Gender / Blood</span>
                        <strong class="text-slate-900 text-xs block">{{ $prescription->patient->age ?? 'N/A' }}Y / {{ $prescription->patient->gender ?? 'N/A' }} / {{ $prescription->patient->blood_group ?: 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Date &amp; Rx No</span>
                        <strong class="text-slate-900 text-xs block">{{ $prescription->created_at->format('d/m/Y') }}</strong>
                        <span class="text-[9px] text-sky-600 font-bold block">{{ $prescription->prescription_no }}</span>
                    </div>
                </div>

                <!-- Doctor Details & Vitals -->
                <div class="flex items-center justify-between gap-4 pb-3 border-b border-slate-200 mb-4">
                    <div>
                        <h2 class="text-sm font-extrabold text-slate-900">Dr. {{ $prescription->doctor->name ?? 'Attending Medical Officer' }}</h2>
                        <p class="text-[11px] text-[#0284C7] font-bold">{{ $prescription->doctor->degree ?? 'MBBS, FCPS, MD' }} &bull; BMDC Reg: A-54321</p>
                        <p class="text-[10px] text-slate-500 font-semibold">{{ $prescription->doctor->designation ?? 'Senior Consultant' }}</p>
                    </div>

                    @if($prescription->vitals_bp || $prescription->vitals_pulse || $prescription->vitals_weight || $prescription->vitals_temp)
                    <div class="px-3 py-1.5 bg-slate-100 rounded-lg border border-slate-200 flex items-center gap-3 text-[11px]">
                        @if($prescription->vitals_bp)<div><span class="text-slate-400 font-bold">BP:</span> <strong class="text-slate-900">{{ $prescription->vitals_bp }}</strong></div>@endif
                        @if($prescription->vitals_pulse)<div><span class="text-slate-400 font-bold">Pulse:</span> <strong class="text-slate-900">{{ $prescription->vitals_pulse }}</strong></div>@endif
                        @if($prescription->vitals_weight)<div><span class="text-slate-400 font-bold">Wt:</span> <strong class="text-slate-900">{{ $prescription->vitals_weight }}</strong></div>@endif
                        @if($prescription->vitals_temp)<div><span class="text-slate-400 font-bold">Temp:</span> <strong class="text-slate-900">{{ $prescription->vitals_temp }}</strong></div>@endif
                    </div>
                    @endif
                </div>

                <!-- Clinical Diagnosis & Complaints -->
                @if($prescription->chief_complaints || $prescription->diagnosis)
                <div class="grid grid-cols-2 gap-3 mb-4 text-xs">
                    @if($prescription->chief_complaints)
                    <div class="p-2.5 bg-slate-50 rounded-lg border border-slate-200">
                        <span class="text-[9px] font-extrabold uppercase text-slate-400 block mb-0.5">Complaints</span>
                        <p class="font-semibold text-slate-800 text-[11px] leading-tight">{{ $prescription->chief_complaints }}</p>
                    </div>
                    @endif
                    @if($prescription->diagnosis)
                    <div class="p-2.5 bg-sky-50/50 rounded-lg border border-sky-100">
                        <span class="text-[9px] font-extrabold uppercase text-sky-600 block mb-0.5">Diagnosis</span>
                        <p class="font-extrabold text-slate-900 text-[11px] leading-tight">{{ $prescription->diagnosis }}</p>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Rx Symbol & Medicines Table -->
                <div class="mb-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-2xl font-black italic text-[#0284C7] leading-none">Rx</span>
                        <div class="h-0.5 flex-1 bg-slate-200"></div>
                    </div>

                    <table class="w-full text-xs">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700 font-extrabold uppercase border-b border-slate-300 text-[10px]">
                                <th class="py-2 px-3 text-left w-8">#</th>
                                <th class="py-2 px-3 text-left">Medicine Name</th>
                                <th class="py-2 px-3 text-left">Dose</th>
                                <th class="py-2 px-3 text-left">Timing</th>
                                <th class="py-2 px-3 text-left">Duration</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 font-medium text-[11px]">
                            @forelse($prescription->medicines ?? [] as $index => $med)
                            <tr>
                                <td class="py-2.5 px-3 font-bold text-slate-400">{{ $index + 1 }}</td>
                                <td class="py-2.5 px-3 font-extrabold text-slate-900 text-xs">{{ $med['name'] ?? '' }}</td>
                                <td class="py-2.5 px-3 font-bold text-[#0284C7]">{{ $med['dosage'] ?? '-' }}</td>
                                <td class="py-2.5 px-3 text-slate-700">{{ $med['timing'] ?? '-' }}</td>
                                <td class="py-2.5 px-3 text-slate-600 font-semibold">{{ $med['duration'] ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="py-4 text-center text-slate-400 italic">No prescribed medicines.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Advised Tests & Special Advice -->
                <div class="grid grid-cols-2 gap-3 pt-3 border-t border-slate-200 text-xs">
                    @if($prescription->advised_tests)
                    <div>
                        <span class="text-[9px] font-extrabold uppercase text-amber-600 block mb-0.5">Advised Investigations</span>
                        <p class="font-bold text-slate-800 text-[11px] bg-amber-50/60 p-2 rounded-lg border border-amber-200/80 leading-tight">{{ $prescription->advised_tests }}</p>
                    </div>
                    @endif
                    @if($prescription->general_advice)
                    <div>
                        <span class="text-[9px] font-extrabold uppercase text-emerald-600 block mb-0.5">Special Advice</span>
                        <p class="font-semibold text-slate-800 text-[11px] bg-emerald-50/60 p-2 rounded-lg border border-emerald-200/80 leading-tight">{{ $prescription->general_advice }}</p>
                    </div>
                    @endif
                </div>

                @if($prescription->follow_up_date)
                <div class="mt-3 p-2 bg-sky-50 rounded-lg border border-sky-200 text-sky-700 text-[11px] font-bold text-center">
                    Follow-up Visit Date: {{ $prescription->follow_up_date->format('d/m/Y') }}
                </div>
                @endif
            </div>

            <!-- Footer Stamp & Doctor Signature -->
            <div class="pt-4 border-t border-slate-200 flex items-end justify-between text-xs mt-4">
                <div>
                    <p class="text-[9px] text-slate-400 font-semibold">CarePlus Health System &bull; EMR Verified Document</p>
                    <p class="text-[9px] text-slate-400">Authentic computer-generated medical prescription.</p>
                </div>
                <div class="text-center w-48">
                    <div class="border-b border-slate-800 pb-0.5 mb-0.5 font-extrabold text-slate-900 text-xs">
                        Dr. {{ $prescription->doctor->name ?? 'Attending Doctor' }}
                    </div>
                    <span class="text-[9px] text-slate-500 font-bold uppercase tracking-wider block">Signature &amp; Seal</span>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnostic Report — {{ $labReport->report_no }}</title>
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

        .watermark-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 60%;
            max-height: 50%;
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
            <i class="fas fa-vial text-purple-400 text-xl"></i>
            <div>
                <h3 class="font-extrabold text-sm">Diagnostic Lab Report (A4 Print Ready)</h3>
                <p class="text-slate-400 text-xs">Optimized for single-page A4 print output without cropping</p>
            </div>
        </div>
        <button onclick="window.print()" class="px-6 py-2.5 bg-purple-600 hover:bg-purple-700 text-white font-extrabold text-xs rounded-xl transition shadow-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Diagnostic Report
        </button>
    </div>

    <!-- Printable A4 Container -->
    <div class="a4-page shadow-2xl border border-slate-200 rounded-2xl relative">
        
        <!-- Transparent Watermark -->
        <div class="watermark-container">
            @php
                $logoUrl = \App\Models\Media::where('type', 'logo')->value('url') ?: asset('images/logo.png');
            @endphp
            <img src="{{ $logoUrl }}" class="w-64 h-auto object-contain max-h-64 mb-2" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
            <div class="text-center font-black text-6xl tracking-widest text-slate-900 uppercase" style="display:none;">CAREPLUS</div>
            <span class="text-3xl font-black text-slate-900 uppercase tracking-widest mt-2">CarePlus Diagnostics</span>
            <span class="text-sm font-bold text-slate-700 uppercase tracking-wider">Clinical Pathology Report</span>
        </div>

        <div class="relative z-10 flex-1 flex flex-col justify-between">
            <div>
                <!-- Diagnostic Header -->
                <div class="flex items-center justify-between pb-4 border-b-2 border-purple-600">
                    <div class="flex items-center gap-3.5">
                        <img src="{{ $logoUrl }}" class="h-14 w-auto max-w-[180px] object-contain" 
                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-md shrink-0" style="display:none;">
                            <i class="fas fa-microscope"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-black tracking-tight text-slate-900 leading-none">
                                Care<span class="text-purple-600">Plus</span> Diagnostics
                            </h1>
                            <p class="text-[10px] font-extrabold text-purple-600 uppercase tracking-widest mt-1">&amp; Clinical Pathology Laboratory</p>
                        </div>
                    </div>

                    <div class="text-right text-[11px] text-slate-600 space-y-0.5">
                        <p class="font-extrabold text-slate-900">Diagnostic Wing, Dhanmondi</p>
                        <p>Hotline: <strong class="text-slate-900">1-800-CARE-NOW</strong></p>
                        <p class="text-purple-600 font-bold">www.careplushospital.com</p>
                    </div>
                </div>

                <!-- Patient Metadata Strip -->
                <div class="my-4 p-3.5 bg-purple-50/60 rounded-xl border border-purple-200/80 grid grid-cols-4 gap-3 text-xs font-semibold">
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Patient Name</span>
                        <strong class="text-slate-900 text-xs block truncate">{{ $labReport->patient->name ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">UHID / Patient ID</span>
                        <strong class="text-sky-600 text-xs block">{{ $labReport->patient->patient_id ?? 'N/A' }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Report No</span>
                        <strong class="text-purple-600 text-xs block">{{ $labReport->report_no }}</strong>
                    </div>
                    <div>
                        <span class="text-[9px] text-slate-400 uppercase font-extrabold block">Report Date</span>
                        <strong class="text-slate-900 text-xs block">{{ $labReport->report_date->format('d/m/Y') }}</strong>
                    </div>
                </div>

                <div class="flex items-center justify-between pb-2 mb-4 border-b border-slate-200 text-xs">
                    <p><span class="text-slate-500 font-semibold">Referred By Doctor:</span> <strong class="text-slate-900">{{ $labReport->referred_by ?: 'Self / OPD Doctor' }}</strong></p>
                    <span class="px-2.5 py-0.5 bg-emerald-100 text-emerald-700 text-[10px] font-black rounded-full uppercase">VERIFIED REPORT</span>
                </div>

                <!-- Test Title -->
                <div class="bg-purple-100/70 p-2.5 rounded-lg border border-purple-200 text-center mb-4">
                    <h2 class="text-sm font-extrabold text-purple-900 uppercase tracking-wide">{{ $labReport->test_name }}</h2>
                </div>

                <!-- Parameters Table -->
                <div class="mb-4">
                    <table class="w-full text-xs">
                        <thead>
                            <tr class="bg-slate-100 text-slate-700 font-extrabold uppercase border-b border-slate-300 text-[10px]">
                                <th class="py-2 px-3 text-left">Parameter / Investigation</th>
                                <th class="py-2 px-3 text-left">Observed Value</th>
                                <th class="py-2 px-3 text-left">Unit</th>
                                <th class="py-2 px-3 text-left">Standard Reference Range</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 font-medium text-[11px]">
                            @forelse($labReport->parameters ?? [] as $p)
                            <tr>
                                <td class="py-2.5 px-3 font-extrabold text-slate-900">{{ $p['parameter'] ?? '' }}</td>
                                <td class="py-2.5 px-3 font-black text-purple-700 text-xs">{{ $p['value'] ?? '' }}</td>
                                <td class="py-2.5 px-3 text-slate-600 font-semibold">{{ $p['unit'] ?? '' }}</td>
                                <td class="py-2.5 px-3 text-slate-500">{{ $p['reference_range'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="py-4 text-center text-slate-400 italic">No parameters recorded.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Impression Box -->
                @if($labReport->impression)
                <div class="p-3 bg-slate-50 rounded-xl border border-slate-200 text-xs">
                    <span class="text-[9px] font-extrabold uppercase text-purple-700 block mb-0.5">Pathologist Impression &amp; Remarks</span>
                    <p class="font-bold text-slate-800 text-[11px] leading-tight whitespace-pre-line">{{ $labReport->impression }}</p>
                </div>
                @endif
            </div>

            <!-- Pathologist Signature -->
            <div class="pt-4 border-t border-slate-200 flex items-end justify-between text-xs mt-4">
                <p class="text-[9px] text-slate-400 font-semibold">CarePlus LIS System &bull; Certified Pathology Diagnostic Document</p>
                <div class="text-center w-48">
                    <div class="border-b border-slate-800 pb-0.5 mb-0.5 font-extrabold text-slate-900 text-xs">
                        Chief Pathologist
                    </div>
                    <span class="text-[9px] text-slate-500 font-bold uppercase tracking-wider block">MBBS, MD (Pathology)</span>
                </div>
            </div>
        </div>

    </div>

</body>
</html>

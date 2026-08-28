<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Booking Serial List — CarePlus Hospital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { background: white; color: black; }
            .no-print { display: none !important; }
            @page { margin: 1cm; size: A4 portrait; }
        }
    </style>
</head>
<body class="bg-slate-100 p-6 text-slate-900 antialiased">

    <!-- Action Bar -->
    <div class="max-w-4xl mx-auto mb-6 flex justify-between items-center no-print">
        <a href="{{ route('admin.custom-orders.index') }}" class="px-4 py-2 bg-slate-800 text-white rounded-lg text-xs font-bold hover:bg-slate-700">
            &larr; Back to Appointments &amp; Bookings
        </a>
        <button onclick="window.print()" class="px-6 py-2.5 bg-[#0284C7] text-white rounded-lg text-xs font-bold hover:bg-sky-700 shadow-md">
            <i class="fas fa-print mr-2"></i> Print Serial List (PDF)
        </button>
    </div>

    <!-- Official Report Paper Container -->
    <div class="max-w-4xl mx-auto bg-white p-10 rounded-2xl shadow-xl border border-slate-200">
        
        <!-- Hospital Letterhead -->
        <div class="flex justify-between items-start pb-6 border-b-2 border-slate-900 mb-6">
            <div class="space-y-1">
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">CarePlus Hospital &amp; Research Center</h1>
                <p class="text-xs text-slate-600 font-semibold">Plot 12, Medical Zone, Gulshan-2, Dhaka | Hotline: 10616 | +880 1900 123456</p>
                <p class="text-xs text-sky-700 font-bold uppercase tracking-wider">Official Daily Serial Sheet &amp; Booking Report</p>
            </div>
            <div class="text-right">
                <div class="text-sm font-extrabold text-slate-900">Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y (l)') }}</div>
                <div class="text-xs text-slate-500 font-semibold">Generated: {{ now()->format('h:i A') }}</div>
            </div>
        </div>

        <!-- Doctor / Entity Header -->
        <div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6 flex justify-between items-center">
            <div>
                <span class="text-[10px] font-extrabold uppercase text-sky-700 tracking-widest">Report Category</span>
                <h2 class="text-lg font-extrabold text-slate-900">
                    @if($doctor)
                        {{ $doctor->name }} (Doctor Appointments)
                    @elseif($bookingType === 'cabin_booking')
                        Inpatient Cabin Reservations
                    @elseif($bookingType === 'medical_service')
                        Medical Services &amp; Health Packages
                    @else
                        All Daily Hospital Bookings
                    @endif
                </h2>
                @if($doctor)
                    <p class="text-xs font-semibold text-slate-600">{{ $doctor->designation }} | Chamber: {{ $doctor->room_no }} | Time: {{ $doctor->chamber_time }}</p>
                @endif
            </div>
            <div class="text-right">
                <span class="text-xs font-extrabold text-slate-500 uppercase">Total Bookings</span>
                <div class="text-2xl font-extrabold text-[#0284C7]">{{ $appointments->count() }} Entries</div>
            </div>
        </div>

        <!-- Serialized Table -->
        <table class="w-full text-xs text-left border-collapse border border-slate-300">
            <thead>
                <tr class="bg-slate-900 text-white font-extrabold uppercase">
                    <th class="p-3 border border-slate-400 w-14 text-center">Serial #</th>
                    <th class="p-3 border border-slate-400">Category</th>
                    <th class="p-3 border border-slate-400">Patient Name &amp; Contact</th>
                    <th class="p-3 border border-slate-400">Booked Entity / Service</th>
                    <th class="p-3 border border-slate-400">Status</th>
                    <th class="p-3 border border-slate-400 w-24 text-center">Officer Sign</th>
                </tr>
            </thead>
            <tbody>
                @forelse($appointments as $index => $app)
                <tr class="border-b border-slate-200 font-semibold {{ $index % 2 === 0 ? 'bg-white' : 'bg-slate-50' }}">
                    <td class="p-3 border border-slate-300 text-center font-extrabold text-sm text-[#0284C7]">#{{ $app->serial_no ?: ($index + 1) }}</td>
                    <td class="p-3 border border-slate-300 font-bold uppercase text-[10px]">
                        {{ $app->booking_type_label }}
                    </td>
                    <td class="p-3 border border-slate-300 font-bold text-slate-900">
                        {{ $app->name }} <br><span class="text-slate-500 text-[10px] font-normal">{{ $app->phone }}</span>
                    </td>
                    <td class="p-3 border border-slate-300 font-semibold">
                        @if($app->doctor)
                            {{ $app->doctor->name }} ({{ $app->doctor->room_no }})
                        @elseif($app->cabin)
                            {{ $app->cabin->name }}
                        @else
                            {{ $app->company }}
                        @endif
                    </td>
                    <td class="p-3 border border-slate-300 uppercase font-bold text-[10px]">
                        <span class="px-2 py-0.5 rounded bg-slate-100 text-slate-800 border border-slate-300">{{ $app->status }}</span>
                    </td>
                    <td class="p-3 border border-slate-300"></td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-8 text-center text-slate-400 font-bold">No bookings found for the selected category &amp; date.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Report Signature Footer -->
        <div class="mt-16 pt-8 border-t border-slate-200 flex justify-between items-end text-xs font-bold text-slate-600">
            <div>
                <p>Prepared By: Patient Desk Officer</p>
                <p class="text-[10px] text-slate-400 font-normal">CarePlus Hospital Information System</p>
            </div>
            <div class="text-center w-48 border-t border-slate-900 pt-2">
                <p>Authorized Signature</p>
            </div>
        </div>

    </div>

</body>
</html>

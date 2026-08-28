@extends('layouts.admin')

@section('content')
<div class="py-4">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header & Print Report Button -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
            <div>
                <h1 class="text-2xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-calendar-check text-amber-400"></i> Appointments &amp; Hospital Bookings Management
                </h1>
                <p class="text-slate-400 text-xs mt-1">Manage Doctor Appointments, Clinical Service Bookings &amp; Cabin Reservations with serial sheets.</p>
            </div>

            <!-- Print Appointment List Button -->
            <a href="{{ route('admin.custom-orders.print', ['booking_type' => request('booking_type'), 'doctor_id' => request('doctor_id'), 'date' => request('date', now()->toDateString())]) }}" target="_blank"
                class="px-5 py-2.5 bg-[#0284C7] hover:bg-sky-700 text-white font-extrabold text-xs rounded-xl shadow-lg transition flex items-center justify-center gap-2 shrink-0">
                <i class="fas fa-print"></i>
                <span>Print Serialized Sheet (PDF)</span>
            </a>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-xs font-bold">{{ session('success') }}</div>
        @endif

        <!-- Quick Type Filter Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-2 mb-6">
            <a href="{{ route('admin.custom-orders.index') }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ !request('booking_type') ? 'bg-[#0284C7] text-white border-[#0284C7]' : 'bg-slate-900 text-slate-400 border-slate-800 hover:text-white' }}">
                All Bookings ({{ $counts['all'] ?? 0 }})
            </a>
            <a href="{{ route('admin.custom-orders.index', ['booking_type' => 'doctor_appointment']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('booking_type') == 'doctor_appointment' ? 'bg-sky-500 text-white border-sky-500' : 'bg-slate-900 text-sky-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-[#0284C7] fa-user-doctor mr-1"></i> Doctor Appointments ({{ $counts['doctor_appointment'] ?? 0 }})
            </a>
            <a href="{{ route('admin.custom-orders.index', ['booking_type' => 'medical_service']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('booking_type') == 'medical_service' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-slate-900 text-emerald-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-hand-holding-medical mr-1"></i> Medical Services ({{ $counts['medical_service'] ?? 0 }})
            </a>
            <a href="{{ route('admin.custom-orders.index', ['booking_type' => 'cabin_booking']) }}"
                class="px-4 py-2 rounded-xl text-xs font-extrabold transition border {{ request('booking_type') == 'cabin_booking' ? 'bg-indigo-500 text-white border-indigo-500' : 'bg-slate-900 text-indigo-400 border-slate-800 hover:bg-slate-800' }}">
                <i class="fas fa-bed-pulse mr-1"></i> Cabin Reservations ({{ $counts['cabin_booking'] ?? 0 }})
            </a>
        </div>

        <!-- Filters Form: Type, Doctor, Cabin, Date & Status -->
        <div class="bg-slate-900 p-5 rounded-2xl border border-slate-800 mb-6">
            <form action="{{ route('admin.custom-orders.index') }}" method="GET" class="grid sm:grid-cols-12 gap-4 items-end">
                
                <!-- Filter Booking Type -->
                <div class="sm:col-span-3">
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Booking Category</label>
                    <select name="booking_type" class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                        <option value="">All Categories</option>
                        <option value="doctor_appointment" {{ request('booking_type') == 'doctor_appointment' ? 'selected' : '' }}>Doctor Appointments</option>
                        <option value="medical_service" {{ request('booking_type') == 'medical_service' ? 'selected' : '' }}>Medical Services &amp; Packages</option>
                        <option value="cabin_booking" {{ request('booking_type') == 'cabin_booking' ? 'selected' : '' }}>Cabin Reservations</option>
                    </select>
                </div>

                <!-- Filter Doctor -->
                <div class="sm:col-span-3">
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Doctor (If Appt.)</label>
                    <select name="doctor_id" class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                        <option value="">All Doctors</option>
                        @foreach($doctors as $doc)
                            <option value="{{ $doc->id }}" {{ request('doctor_id') == $doc->id ? 'selected' : '' }}>{{ $doc->name }} ({{ $doc->designation }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Date -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Booking Date</label>
                    <input type="date" name="date" value="{{ request('date') }}"
                        class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                </div>

                <!-- Filter Status -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold uppercase text-slate-400 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2.5 bg-slate-950 border border-slate-800 rounded-xl text-white text-xs font-semibold focus:outline-none focus:border-[#0284C7]">
                        <option value="">All Statuses</option>
                        @foreach(\App\Models\CustomOrder::statuses() as $st)
                            <option value="{{ $st }}" {{ request('status') == $st ? 'selected' : '' }}>{{ ucfirst($st) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Submit Filter -->
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="w-full py-2.5 bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs rounded-xl border border-slate-700 transition">Filter</button>
                    <a href="{{ route('admin.custom-orders.index') }}" class="py-2.5 px-3 bg-slate-800 text-slate-400 hover:text-white font-bold text-xs rounded-xl border border-slate-700 transition flex items-center justify-center">Reset</a>
                </div>

            </form>
        </div>

        <div class="bg-slate-900 rounded-2xl border border-slate-800 overflow-hidden">
            <table class="min-w-full text-xs">
                <thead class="bg-slate-950 text-slate-400 font-extrabold uppercase">
                    <tr>
                        <th class="px-6 py-3.5 text-left w-16">Serial #</th>
                        <th class="px-6 py-3.5 text-left">Category / Type</th>
                        <th class="px-6 py-3.5 text-left">Patient Details</th>
                        <th class="px-6 py-3.5 text-left">Booked Entity / Service / Doctor</th>
                        <th class="px-6 py-3.5 text-left">Date</th>
                        <th class="px-6 py-3.5 text-left">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-medium">
                    @forelse($orders as $order)
                    <tr class="hover:bg-slate-800/40 transition">
                        <td class="px-6 py-4 text-sky-400 font-extrabold text-sm">#{{ $order->serial_no ?: '-' }}</td>
                        
                        <!-- Booking Type Badge -->
                        <td class="px-6 py-4">
                            @if($order->booking_type === 'doctor_appointment')
                                <span class="px-2.5 py-1 bg-sky-500/20 text-sky-300 border border-sky-500/30 rounded-full font-bold text-[10px] inline-flex items-center gap-1">
                                    <i class="fas fa-user-doctor"></i> Doctor Appt.
                                </span>
                            @elseif($order->booking_type === 'cabin_booking')
                                <span class="px-2.5 py-1 bg-indigo-500/20 text-indigo-300 border border-indigo-500/30 rounded-full font-bold text-[10px] inline-flex items-center gap-1">
                                    <i class="fas fa-bed-pulse"></i> Cabin Reservation
                                </span>
                            @else
                                <span class="px-2.5 py-1 bg-emerald-500/20 text-emerald-300 border border-emerald-500/30 rounded-full font-bold text-[10px] inline-flex items-center gap-1">
                                    <i class="fas fa-hand-holding-medical"></i> Medical Service
                                </span>
                            @endif
                        </td>

                        <!-- Patient Details -->
                        <td class="px-6 py-4">
                            <p class="text-white font-bold text-sm">{{ $order->name }}</p>
                            <p class="text-slate-400 text-xs">{{ $order->phone }} | {{ $order->email }}</p>
                            @if($order->message)
                                <p class="text-slate-500 text-[11px] mt-1 italic max-w-xs truncate">"{{ $order->message }}"</p>
                            @endif
                        </td>

                        <!-- Booked Entity (Doctor Name, Cabin Name, or Service Name) -->
                        <td class="px-6 py-4">
                            @if($order->booking_type === 'doctor_appointment' && $order->doctor)
                                <p class="text-white font-bold">{{ $order->doctor->name }}</p>
                                <p class="text-sky-400 text-[11px] font-semibold">{{ $order->doctor->designation }} ({{ $order->doctor->room_no ?: 'Room 302' }})</p>
                            @elseif($order->booking_type === 'cabin_booking' && $order->cabin)
                                <p class="text-white font-bold">{{ $order->cabin->name }}</p>
                                <p class="text-indigo-400 text-[11px] font-semibold">Rent: ৳ {{ number_format($order->cabin->rent_per_day, 2) }}/day</p>
                            @else
                                <p class="text-emerald-400 font-bold">{{ $order->company ?: 'General Clinical Service' }}</p>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-slate-300 font-bold">
                            {{ $order->appointment_date ? \Carbon\Carbon::parse($order->appointment_date)->format('M d, Y') : $order->created_at->format('M d, Y') }}
                        </td>

                        <td class="px-6 py-4">
                            <form action="{{ route('admin.custom-orders.status', $order) }}" method="POST">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                    class="px-3 py-1.5 bg-slate-950 border border-slate-800 rounded-xl text-xs text-white focus:border-[#0284C7] outline-none cursor-pointer font-bold">
                                    @foreach(\App\Models\CustomOrder::statuses() as $status)
                                        <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>{{ ucfirst($status) }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </td>

                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.custom-orders.destroy', $order) }}" method="POST">
                                @csrf @method('delete')
                                <button type="submit" class="text-rose-400 hover:underline font-bold text-xs" onclick="return confirm('Delete this booking record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500 font-semibold">No bookings found matching the search criteria.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
        <div class="mt-6">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection

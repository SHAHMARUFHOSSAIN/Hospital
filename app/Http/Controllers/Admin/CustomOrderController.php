<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomOrder;
use App\Models\Director;
use App\Models\Cabin;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class CustomOrderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status');
        $bookingType = $request->query('booking_type');
        $doctorId = $request->query('doctor_id');
        $cabinId = $request->query('cabin_id');
        $date = $request->query('date');

        $orders = CustomOrder::with(['doctor', 'cabin'])
            ->when($status && in_array($status, CustomOrder::statuses()), function ($q) use ($status) {
                return $q->where('status', $status);
            })
            ->when($bookingType, function ($q) use ($bookingType) {
                return $q->where('booking_type', $bookingType);
            })
            ->when($doctorId, function ($q) use ($doctorId) {
                return $q->where('doctor_id', $doctorId);
            })
            ->when($cabinId, function ($q) use ($cabinId) {
                return $q->where('cabin_id', $cabinId);
            })
            ->when($date, function ($q) use ($date) {
                return $q->whereDate('appointment_date', $date);
            })
            ->orderBy('appointment_date', 'desc')
            ->orderBy('serial_no', 'asc')
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        $doctors = Director::where('is_active', true)->orderBy('name')->get();
        $cabins = Cabin::where('is_active', true)->orderBy('name')->get();

        $counts = [
            'all' => CustomOrder::count(),
            'doctor_appointment' => CustomOrder::where('booking_type', 'doctor_appointment')->count(),
            'medical_service' => CustomOrder::where('booking_type', 'medical_service')->count(),
            'cabin_booking' => CustomOrder::where('booking_type', 'cabin_booking')->count(),
            'new' => CustomOrder::where('status', 'new')->count(),
            'completed' => CustomOrder::where('status', 'completed')->count(),
        ];

        return view('admin.custom-orders.index', compact('orders', 'counts', 'doctors', 'cabins'));
    }

    public function printAppointments(Request $request): View
    {
        $doctorId = $request->query('doctor_id');
        $bookingType = $request->query('booking_type');
        $date = $request->query('date', now()->toDateString());

        $doctor = $doctorId ? Director::find($doctorId) : null;

        $appointments = CustomOrder::with(['doctor', 'cabin'])
            ->when($doctorId, function ($q) use ($doctorId) {
                return $q->where('doctor_id', $doctorId);
            })
            ->when($bookingType, function ($q) use ($bookingType) {
                return $q->where('booking_type', $bookingType);
            })
            ->whereDate('appointment_date', $date)
            ->orderBy('serial_no', 'asc')
            ->get();

        return view('admin.custom-orders.print', compact('appointments', 'doctor', 'date', 'bookingType'));
    }

    public function updateStatus(Request $request, CustomOrder $customOrder): RedirectResponse
    {
        $request->validate(['status' => 'required|in:new,contacted,completed,rejected']);
        $customOrder->update(['status' => $request->input('status')]);

        return back()->with('success', 'Booking status updated successfully');
    }

    public function destroy(CustomOrder $customOrder): RedirectResponse
    {
        $customOrder->delete();
        return back()->with('success', 'Booking entry deleted');
    }
}

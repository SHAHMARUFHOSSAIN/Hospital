<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AmbulanceDispatch;
use Illuminate\Http\Request;

class AmbulanceDispatchController extends Controller
{
    public function index(Request $request)
    {
        $dispatches = AmbulanceDispatch::latest()->paginate(15);
        return view('admin.ambulance_dispatches.index', compact('dispatches'));
    }

    public function create()
    {
        $dispatchNo = 'AMB-' . date('Y') . '-' . str_pad(AmbulanceDispatch::count() + 1, 4, '0', STR_PAD_LEFT);
        return view('admin.ambulance_dispatches.create', compact('dispatchNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'dispatch_no' => 'required|unique:ambulance_dispatches,dispatch_no',
            'patient_name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'vehicle_no' => 'required|string|max:100',
            'driver_name' => 'required|string|max:255',
            'driver_phone' => 'nullable|string|max:50',
            'pickup_location' => 'required|string',
            'destination' => 'required|string',
            'fare_amount' => 'required|numeric|min:0',
            'status' => 'required|string',
        ]);

        AmbulanceDispatch::create($validated);

        return redirect()->route('admin.ambulance-dispatches.index')
            ->with('success', 'Ambulance dispatch booked & dispatched successfully!');
    }

    public function destroy(AmbulanceDispatch $ambulanceDispatch)
    {
        $ambulanceDispatch->delete();
        return redirect()->route('admin.ambulance-dispatches.index')
            ->with('success', 'Ambulance dispatch record deleted.');
    }
}

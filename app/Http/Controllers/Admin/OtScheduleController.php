<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OtSchedule;
use App\Models\Patient;
use App\Models\Director;
use Illuminate\Http\Request;

class OtScheduleController extends Controller
{
    public function index(Request $request)
    {
        $query = OtSchedule::with(['patient', 'surgeon'])->latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $schedules = $query->paginate(15);
        return view('admin.ot_schedules.index', compact('schedules'));
    }

    public function create()
    {
        $patients = Patient::latest()->get();
        $surgeons = Director::where('is_active', 1)->get();
        $otNo = 'OT-' . date('Y') . '-' . str_pad(OtSchedule::count() + 1, 4, '0', STR_PAD_LEFT);

        return view('admin.ot_schedules.create', compact('patients', 'surgeons', 'otNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ot_no' => 'required|unique:ot_schedules,ot_no',
            'patient_id' => 'required|exists:patients,id',
            'surgeon_id' => 'nullable|exists:directors,id',
            'operation_type' => 'required|string|max:255',
            'ot_room' => 'required|string',
            'scheduled_datetime' => 'required|date',
            'anesthetist_name' => 'nullable|string|max:255',
            'status' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        OtSchedule::create($validated);

        return redirect()->route('admin.ot-schedules.index')
            ->with('success', 'Operation Theatre surgery scheduled successfully!');
    }

    public function destroy(OtSchedule $otSchedule)
    {
        $otSchedule->delete();
        return redirect()->route('admin.ot-schedules.index')
            ->with('success', 'OT schedule cancelled & removed.');
    }
}

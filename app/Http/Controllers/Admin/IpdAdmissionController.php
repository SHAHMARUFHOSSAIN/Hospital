<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IpdAdmission;
use App\Models\Patient;
use App\Models\Cabin;
use App\Models\Director;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IpdAdmissionController extends Controller
{
    public function index(Request $request)
    {
        $query = IpdAdmission::with(['patient', 'cabin', 'doctor'])->latest();

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $admissions = $query->paginate(15);
        $cabins = Cabin::orderBy('room_number')->get();

        return view('admin.ipd_admissions.index', compact('admissions', 'cabins'));
    }

    public function create()
    {
        $patients = Patient::latest()->get();
        $cabins = Cabin::latest()->get();
        $doctors = Director::where('is_active', 1)->get();
        $admissionNo = 'IPD-' . date('Y') . '-' . str_pad(IpdAdmission::count() + 1, 4, '0', STR_PAD_LEFT);

        return view('admin.ipd_admissions.create', compact('patients', 'cabins', 'doctors', 'admissionNo'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'admission_no' => 'required|unique:ipd_admissions,admission_no',
            'patient_id' => 'required|exists:patients,id',
            'cabin_id' => 'required|exists:cabins,id',
            'attending_doctor_id' => 'nullable|exists:directors,id',
            'admission_date' => 'required|date',
            'daily_rent' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        DB::transaction(function () use ($validated, $request) {
            $admission = IpdAdmission::create($validated);

            // Update cabin status to booked / occupied
            $cabin = Cabin::find($request->cabin_id);
            if ($cabin) {
                $cabin->update(['status' => 'booked']);
            }
        });

        return redirect()->route('admin.ipd-admissions.index')
            ->with('success', 'Patient admitted to IPD cabin successfully!');
    }

    public function show(IpdAdmission $ipdAdmission)
    {
        $ipdAdmission->load(['patient', 'cabin', 'doctor']);
        return view('admin.ipd_admissions.show', compact('ipdAdmission'));
    }

    public function discharge(Request $request, IpdAdmission $ipdAdmission)
    {
        $request->validate([
            'discharge_date' => 'required|date',
            'discharge_summary' => 'required|string',
            'total_bill_amount' => 'required|numeric|min:0',
        ]);

        DB::transaction(function () use ($request, $ipdAdmission) {
            $ipdAdmission->update([
                'discharge_date' => $request->discharge_date,
                'discharge_summary' => $request->discharge_summary,
                'total_bill_amount' => $request->total_bill_amount,
                'status' => 'discharged',
            ]);

            // Release cabin to vacant
            if ($ipdAdmission->cabin) {
                $ipdAdmission->cabin->update(['status' => 'available']);
            }
        });

        return redirect()->route('admin.ipd-admissions.index')
            ->with('success', 'Patient discharged successfully and Cabin released!');
    }
}

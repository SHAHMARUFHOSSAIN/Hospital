<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prescription;
use App\Models\Patient;
use App\Models\Director;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    public function index(Request $request)
    {
        $query = Prescription::with(['patient', 'doctor'])->latest();

        if ($search = $request->input('search')) {
            $query->where('prescription_no', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")->orWhere('patient_id', 'like', "%{$search}%");
                  });
        }

        $prescriptions = $query->paginate(15);
        return view('admin.prescriptions.index', compact('prescriptions'));
    }

    public function create(Request $request)
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Director::orderBy('name')->get();
        $prescriptionNo = Prescription::generatePrescriptionNo();
        $selectedPatientId = $request->input('patient_id');

        return view('admin.prescriptions.create', compact('patients', 'doctors', 'prescriptionNo', 'selectedPatientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'prescription_no' => 'required|unique:prescriptions,prescription_no',
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'nullable|exists:directors,id',
            'vitals_bp' => 'nullable|string|max:50',
            'vitals_pulse' => 'nullable|string|max:50',
            'vitals_weight' => 'nullable|string|max:50',
            'vitals_temp' => 'nullable|string|max:50',
            'chief_complaints' => 'nullable|string',
            'diagnosis' => 'nullable|string',
            'medicines' => 'nullable|array',
            'advised_tests' => 'nullable|string',
            'general_advice' => 'nullable|string',
            'follow_up_date' => 'nullable|date',
        ]);

        $prescription = Prescription::create($validated);

        return redirect()->route('admin.prescriptions.show', $prescription)
            ->with('success', 'Prescription created successfully: ' . $prescription->prescription_no);
    }

    public function show(Prescription $prescription)
    {
        $prescription->load(['patient', 'doctor']);
        return view('admin.prescriptions.show', compact('prescription'));
    }

    public function print(Prescription $prescription)
    {
        $prescription->load(['patient', 'doctor']);
        return view('admin.prescriptions.print', compact('prescription'));
    }

    public function destroy(Prescription $prescription)
    {
        $prescription->delete();
        return redirect()->route('admin.prescriptions.index')
            ->with('success', 'Prescription record deleted successfully.');
    }
}

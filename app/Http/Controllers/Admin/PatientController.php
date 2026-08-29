<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $query = Patient::latest();

        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('patient_id', 'like', "%{$search}%");
        }

        $patients = $query->paginate(15);
        return view('admin.patients.index', compact('patients'));
    }

    public function create()
    {
        $patientId = Patient::generatePatientId();
        return view('admin.patients.create', compact('patientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|unique:patients,patient_id',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|string|in:Male,Female,Other',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $patient = Patient::create($validated);

        return redirect()->route('admin.patients.show', $patient)
            ->with('success', 'Patient registered successfully with UHID: ' . $patient->patient_id);
    }

    public function show(Patient $patient)
    {
        $patient->load(['prescriptions.doctor', 'invoices', 'labReports']);
        return view('admin.patients.show', compact('patient'));
    }

    public function edit(Patient $patient)
    {
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|string|in:Male,Female,Other',
            'blood_group' => 'nullable|string|max:10',
            'address' => 'nullable|string',
            'medical_history' => 'nullable|string',
        ]);

        $patient->update($validated);

        return redirect()->route('admin.patients.show', $patient)
            ->with('success', 'Patient details updated successfully.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return redirect()->route('admin.patients.index')
            ->with('success', 'Patient record deleted successfully.');
    }
}

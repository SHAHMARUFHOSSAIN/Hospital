<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabReport;
use App\Models\Patient;
use Illuminate\Http\Request;

class LabReportController extends Controller
{
    public function index(Request $request)
    {
        $query = LabReport::with('patient')->latest();

        if ($search = $request->input('search')) {
            $query->where('report_no', 'like', "%{$search}%")
                  ->orWhere('test_name', 'like', "%{$search}%")
                  ->orWhereHas('patient', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")->orWhere('patient_id', 'like', "%{$search}%");
                  });
        }

        $labReports = $query->paginate(15);
        return view('admin.lab_reports.index', compact('labReports'));
    }

    public function create(Request $request)
    {
        $patients = Patient::orderBy('name')->get();
        $reportNo = LabReport::generateReportNo();
        $selectedPatientId = $request->input('patient_id');

        return view('admin.lab_reports.create', compact('patients', 'reportNo', 'selectedPatientId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'report_no' => 'required|unique:lab_reports,report_no',
            'patient_id' => 'required|exists:patients,id',
            'test_name' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'parameters' => 'nullable|array',
            'status' => 'required|string',
            'impression' => 'nullable|string',
            'referred_by' => 'nullable|string|max:255',
            'report_date' => 'required|date',
        ]);

        $report = LabReport::create($validated);

        return redirect()->route('admin.lab-reports.show', $report)
            ->with('success', 'Lab report created successfully: ' . $report->report_no);
    }

    public function show(LabReport $labReport)
    {
        $labReport->load('patient');
        return view('admin.lab_reports.show', compact('labReport'));
    }

    public function print(LabReport $labReport)
    {
        $labReport->load('patient');
        return view('admin.lab_reports.print', compact('labReport'));
    }

    public function destroy(LabReport $labReport)
    {
        $labReport->delete();
        return redirect()->route('admin.lab-reports.index')
            ->with('success', 'Lab report record deleted.');
    }
}

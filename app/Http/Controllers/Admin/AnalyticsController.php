<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\IpdAdmission;
use App\Models\Prescription;
use App\Models\LabReport;
use App\Models\Inventory;
use App\Models\OtSchedule;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Invoice Query
        $invoiceQuery = Invoice::query();
        if ($startDate) $invoiceQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $invoiceQuery->whereDate('created_at', '<=', $endDate);

        $totalRevenue = (clone $invoiceQuery)->sum('paid_amount');
        $totalDue = (clone $invoiceQuery)->sum('due_amount');

        // Patient Query
        $patientQuery = Patient::query();
        if ($startDate) $patientQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $patientQuery->whereDate('created_at', '<=', $endDate);
        $patientCount = $patientQuery->count();

        // Prescriptions Query
        $prescriptionQuery = Prescription::query();
        if ($startDate) $prescriptionQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $prescriptionQuery->whereDate('created_at', '<=', $endDate);
        $prescriptionCount = $prescriptionQuery->count();

        // Lab Reports Query
        $labReportQuery = LabReport::query();
        if ($startDate) $labReportQuery->whereDate('created_at', '>=', $startDate);
        if ($endDate) $labReportQuery->whereDate('created_at', '<=', $endDate);
        $labReportCount = $labReportQuery->count();

        $ipdActiveCount = IpdAdmission::where('status', 'admitted')->count();
        $lowStockCount = Inventory::whereColumn('quantity', '<=', 'reorder_level')->count();
        $otCount = OtSchedule::where('status', 'scheduled')->count();

        $recentInvoices = (clone $invoiceQuery)->with('patient')->latest()->take(5)->get();
        $recentAdmissions = IpdAdmission::with(['patient', 'cabin'])->latest()->take(5)->get();

        return view('admin.analytics.index', compact(
            'totalRevenue',
            'totalDue',
            'patientCount',
            'ipdActiveCount',
            'prescriptionCount',
            'labReportCount',
            'lowStockCount',
            'otCount',
            'recentInvoices',
            'recentAdmissions',
            'startDate',
            'endDate'
        ));
    }
}

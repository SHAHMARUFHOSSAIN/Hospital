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
    public function index()
    {
        $totalRevenue = Invoice::sum('paid_amount');
        $totalDue = Invoice::sum('due_amount');
        $patientCount = Patient::count();
        $ipdActiveCount = IpdAdmission::where('status', 'admitted')->count();
        $prescriptionCount = Prescription::count();
        $labReportCount = LabReport::count();
        $lowStockCount = Inventory::whereColumn('quantity', '<=', 'reorder_level')->count();
        $otCount = OtSchedule::where('status', 'scheduled')->count();

        $recentInvoices = Invoice::with('patient')->latest()->take(5)->get();
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
            'recentAdmissions'
        ));
    }
}

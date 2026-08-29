<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Diagnostic Report — {{ $labReport->report_no }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 20px; color: #1e293b; background: #fff; }
        .lab-header { text-align: center; border-bottom: 2px solid #8b5cf6; padding-bottom: 12px; margin-bottom: 15px; }
        .lab-header h1 { margin: 0; color: #8b5cf6; font-size: 22px; text-transform: uppercase; }
        .lab-header p { margin: 2px 0; font-size: 11px; color: #64748b; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }
        .meta-table td { padding: 6px 10px; background: #f5f3ff; border: 1px solid #ddd6fe; }
        .test-title { font-size: 16px; font-weight: bold; color: #6d28d9; text-align: center; margin-bottom: 15px; text-transform: uppercase; border-bottom: 1px solid #cbd5e1; padding-bottom: 5px; }
        .param-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size: 12px; }
        .param-table th { background: #ede9fe; text-align: left; padding: 8px 10px; border-bottom: 2px solid #8b5cf6; }
        .param-table td { padding: 8px 10px; border-bottom: 1px solid #e2e8f0; }
        .impression-box { background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px; border-radius: 6px; font-size: 12px; margin-bottom: 30px; }
        .footer { margin-top: 50px; display: flex; justify-content: space-between; font-size: 11px; color: #64748b; }
        .sig-box { text-align: center; border-top: 1px solid #94a3b8; width: 180px; padding-top: 5px; display: inline-block; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 8px 18px; background: #8b5cf6; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Print Diagnostic Report
        </button>
    </div>

    <div class="lab-header">
        <h1>CarePlus Diagnostic &amp; Pathology Laboratory</h1>
        <p>Accredited High-Precision Clinical Laboratory &amp; Imaging Center</p>
        <p>Dhanmondi, Dhaka &bull; Phone: 1-800-CARE-NOW &bull; Web: careplus.com</p>
    </div>

    <table class="meta-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $labReport->patient->name ?? 'N/A' }}</td>
            <td><strong>UHID:</strong> {{ $labReport->patient->patient_id ?? 'N/A' }}</td>
            <td><strong>Report No:</strong> {{ $labReport->report_no }}</td>
        </tr>
        <tr>
            <td><strong>Age / Gender:</strong> {{ $labReport->patient->age ?? 'N/A' }} Yrs / {{ $labReport->patient->gender ?? 'N/A' }}</td>
            <td><strong>Referred By:</strong> {{ $labReport->referred_by ?: 'Self / OPD Doctor' }}</td>
            <td><strong>Report Date:</strong> {{ $labReport->report_date->format('d/m/Y') }}</td>
        </tr>
    </table>

    <div class="test-title">{{ $labReport->test_name }}</div>

    <table class="param-table">
        <thead>
            <tr>
                <th style="width: 35%;">Parameter / Investigation</th>
                <th style="width: 20%;">Observed Result</th>
                <th style="width: 15%;">Unit</th>
                <th style="width: 30%;">Standard Reference Range</th>
            </tr>
        </thead>
        <tbody>
            @forelse($labReport->parameters ?? [] as $p)
            <tr>
                <td><strong>{{ $p['parameter'] ?? '' }}</strong></td>
                <td><strong style="color: #6d28d9;">{{ $p['value'] ?? '' }}</strong></td>
                <td>{{ $p['unit'] ?? '' }}</td>
                <td>{{ $p['reference_range'] ?? 'N/A' }}</td>
            </tr>
            @empty
            <tr><td colspan="4">No findings recorded.</td></tr>
            @endforelse
        </tbody>
    </table>

    @if($labReport->impression)
    <div style="font-[12px]; font-weight: bold; color: #6d28d9; margin-bottom: 5px;">PATHOLOGIST IMPRESSION:</div>
    <div class="impression-box">
        {{ $labReport->impression }}
    </div>
    @endif

    <div style="margin-top: 60px; text-align: right;">
        <div class="sig-box">
            <strong>Consultant Pathologist</strong><br>
            <span style="font-size: 10px;">MBBS, MD (Pathology)</span>
        </div>
    </div>

</body>
</html>

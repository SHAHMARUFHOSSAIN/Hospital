<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Prescription — {{ $prescription->prescription_no }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 20px; color: #1e293b; background: #fff; }
        .header { text-align: center; border-bottom: 2px solid #0284c7; padding-bottom: 15px; margin-bottom: 20px; }
        .header h1 { margin: 0; color: #0284c7; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 3px 0; font-size: 12px; color: #64748b; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; font-size: 12px; }
        .meta-table td { padding: 6px 10px; background: #f8fafc; border: 1px solid #e2e8f0; }
        .rx-symbol { font-size: 28px; font-weight: bold; color: #0284c7; margin-bottom: 10px; font-style: italic; }
        .med-table { width: 100%; border-collapse: collapse; margin-bottom: 25px; font-size: 13px; }
        .med-table th { background: #f1f5f9; text-align: left; padding: 8px 10px; border-bottom: 2px solid #cbd5e1; }
        .med-table td { padding: 10px; border-bottom: 1px solid #e2e8f0; }
        .section-title { font-size: 13px; font-weight: bold; color: #0284c7; text-transform: uppercase; margin-top: 15px; margin-bottom: 5px; }
        .footer { margin-top: 50px; text-align: right; font-size: 12px; }
        .signature { display: inline-block; text-align: center; border-top: 1px solid #94a3b8; width: 200px; padding-top: 5px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #0284c7; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Print Prescription
        </button>
    </div>

    <!-- Letterhead Header -->
    <div class="header">
        <h1>CarePlus Hospital &amp; Research Center</h1>
        <p>24/7 Tertiary Healthcare &amp; Multi-Specialty Medical Center</p>
        <p>House 12, Road 4, Dhanmondi, Dhaka-1205 &bull; Phone: 1-800-CARE-NOW &bull; Web: careplus.com</p>
    </div>

    <!-- Patient & Doctor Metadata -->
    <table class="meta-table">
        <tr>
            <td><strong>Patient Name:</strong> {{ $prescription->patient->name ?? 'N/A' }}</td>
            <td><strong>UHID:</strong> {{ $prescription->patient->patient_id ?? 'N/A' }}</td>
            <td><strong>Age/Gender:</strong> {{ $prescription->patient->age ?? 'N/A' }} Yrs / {{ $prescription->patient->gender ?? 'N/A' }}</td>
            <td><strong>Date:</strong> {{ $prescription->created_at->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <td><strong>Doctor:</strong> Dr. {{ $prescription->doctor->name ?? 'General OPD Doctor' }}</td>
            <td><strong>Degrees:</strong> {{ $prescription->doctor->degree ?? 'MBBS, FCPS' }}</td>
            <td><strong>Rx No:</strong> {{ $prescription->prescription_no }}</td>
            <td><strong>BP/Pulse:</strong> {{ $prescription->vitals_bp ?: 'N/A' }} / {{ $prescription->vitals_pulse ?: 'N/A' }}</td>
        </tr>
    </table>

    @if($prescription->chief_complaints)
    <div class="section-title">Chief Complaints</div>
    <div style="font-size: 12px; margin-bottom: 15px;">{{ $prescription->chief_complaints }}</div>
    @endif

    @if($prescription->diagnosis)
    <div class="section-title">Clinical Diagnosis</div>
    <div style="font-size: 12px; margin-bottom: 15px;"><strong>{{ $prescription->diagnosis }}</strong></div>
    @endif

    <!-- Rx Symbol & Medicines -->
    <div class="rx-symbol">Rx</div>
    <table class="med-table">
        <thead>
            <tr>
                <th style="width: 40%;">Medicine Name</th>
                <th style="width: 20%;">Dosage</th>
                <th style="width: 20%;">Timing</th>
                <th style="width: 20%;">Duration</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prescription->medicines ?? [] as $med)
            <tr>
                <td><strong>{{ $med['name'] ?? '' }}</strong></td>
                <td>{{ $med['dosage'] ?? '' }}</td>
                <td>{{ $med['timing'] ?? '' }}</td>
                <td>{{ $med['duration'] ?? '' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No medicines listed.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    @if($prescription->advised_tests)
    <div class="section-title">Advised Investigations</div>
    <div style="font-size: 12px; margin-bottom: 15px;">{{ $prescription->advised_tests }}</div>
    @endif

    @if($prescription->general_advice)
    <div class="section-title">Special Advice</div>
    <div style="font-size: 12px; margin-bottom: 15px;">{{ $prescription->general_advice }}</div>
    @endif

    @if($prescription->follow_up_date)
    <div style="font-size: 12px; margin-top: 15px; font-weight: bold; color: #0284c7;">
        Follow-up Visit Date: {{ $prescription->follow_up_date->format('d/m/Y') }}
    </div>
    @endif

    <div class="footer">
        <div class="signature">
            <strong>Dr. {{ $prescription->doctor->name ?? 'Attending Medical Officer' }}</strong><br>
            <span style="font-size: 10px; color: #64748b;">Signature &amp; Seal</span>
        </div>
    </div>

</body>
</html>

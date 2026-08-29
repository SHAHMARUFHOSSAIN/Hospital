<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Billing Receipt — {{ $invoice->invoice_no }}</title>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; margin: 0; padding: 20px; color: #1e293b; background: #fff; }
        .receipt-header { text-align: center; border-bottom: 2px solid #f59e0b; padding-bottom: 12px; margin-bottom: 15px; }
        .receipt-header h1 { margin: 0; color: #f59e0b; font-size: 20px; text-transform: uppercase; }
        .receipt-header p { margin: 2px 0; font-size: 11px; color: #64748b; }
        .meta-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 12px; }
        .meta-table td { padding: 5px 8px; background: #fffbe6; border: 1px solid #fef08a; }
        .items-table { width: 100%; border-collapse: collapse; margin-bottom: 15px; font-size: 12px; }
        .items-table th { background: #fef3c7; text-align: left; padding: 8px; border-bottom: 2px solid #f59e0b; }
        .items-table td { padding: 8px; border-bottom: 1px solid #e2e8f0; }
        .totals-table { width: 250px; float: right; border-collapse: collapse; font-size: 12px; margin-bottom: 30px; }
        .totals-table td { padding: 4px 8px; }
        .footer { clear: both; margin-top: 40px; text-align: center; font-size: 11px; color: #64748b; border-top: 1px dashed #cbd5e1; padding-top: 10px; }
        @media print {
            .no-print { display: none; }
        }
    </style>
</head>
<body>

    <div class="no-print" style="margin-bottom: 20px; text-align: right;">
        <button onclick="window.print()" style="padding: 8px 18px; background: #f59e0b; color: white; border: none; border-radius: 6px; font-weight: bold; cursor: pointer;">
            Print Official Receipt
        </button>
    </div>

    <div class="receipt-header">
        <h1>CarePlus Hospital &amp; Research Center</h1>
        <p>OFFICIAL PAYMENT RECEIPT &amp; MONEY RECEIPT</p>
        <p>Dhanmondi, Dhaka &bull; Hotline: 1-800-CARE-NOW</p>
    </div>

    <table class="meta-table">
        <tr>
            <td><strong>Invoice No:</strong> {{ $invoice->invoice_no }}</td>
            <td><strong>Date:</strong> {{ $invoice->created_at->format('d/m/Y h:i A') }}</td>
        </tr>
        <tr>
            <td><strong>Patient Name:</strong> {{ $invoice->patient->name ?? 'N/A' }}</td>
            <td><strong>UHID:</strong> {{ $invoice->patient->patient_id ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td><strong>Phone:</strong> {{ $invoice->patient->phone ?? 'N/A' }}</td>
            <td><strong>Payment Method:</strong> {{ strtoupper($invoice->payment_method) }}</td>
        </tr>
    </table>

    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 10%;">#</th>
                <th style="width: 65%;">Service / Description</th>
                <th style="width: 25%; text-align: right;">Amount (৳)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoice->items ?? [] as $idx => $item)
            <tr>
                <td>{{ $idx + 1 }}</td>
                <td><strong>{{ $item['description'] ?? '' }}</strong></td>
                <td style="text-align: right;">{{ number_format($item['amount'] ?? 0, 2) }}</td>
            </tr>
            @empty
            <tr><td colspan="3">No items.</td></tr>
            @endforelse
        </tbody>
    </table>

    <table class="totals-table">
        <tr>
            <td>Subtotal:</td>
            <td style="text-align: right;">৳ {{ number_format($invoice->subtotal, 2) }}</td>
        </tr>
        @if($invoice->discount > 0)
        <tr>
            <td>Discount:</td>
            <td style="text-align: right;">- ৳ {{ number_format($invoice->discount, 2) }}</td>
        </tr>
        @endif
        <tr style="font-weight: bold; border-top: 1px solid #f59e0b;">
            <td>Total Payable:</td>
            <td style="text-align: right;">৳ {{ number_format($invoice->total_amount, 2) }}</td>
        </tr>
        <tr style="color: #059669; font-weight: bold;">
            <td>Paid Amount:</td>
            <td style="text-align: right;">৳ {{ number_format($invoice->paid_amount, 2) }}</td>
        </tr>
        @if($invoice->due_amount > 0)
        <tr style="color: #dc2626; font-weight: bold;">
            <td>Due Amount:</td>
            <td style="text-align: right;">৳ {{ number_format($invoice->due_amount, 2) }}</td>
        </tr>
        @endif
    </table>

    <div class="footer">
        <p>Thank you for choosing CarePlus Hospital. Wish you good health!</p>
        <p style="font-size: 10px; color: #94a3b8;">This is a computer-generated money receipt.</p>
    </div>

</body>
</html>

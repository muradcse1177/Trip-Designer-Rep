<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Office Expense Report</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            color: #222;
            margin: 0 30px;
        }

        .header-section {
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #444;
        }

        .logo {
            max-height: 60px;
        }

        .company-info {
            text-align: right;
            font-size: 12px;
            line-height: 1.6;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
            text-transform: uppercase;
        }

        .date-range {
            text-align: center;
            font-size: 12px;
            margin-bottom: 15px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        thead {
            background-color: #f2f2f2;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 6px;
            text-align: center;
        }

        th {
            font-weight: bold;
            background-color: #e6e6e6;
            color: #333;
        }

        .total-row {
            background-color: #f9f9f9;
            font-weight: bold;
            border-top: 2px solid #555;
        }

        .footer {
            margin-top: 40px;
            font-size: 11px;
            text-align: right;
            color: #888;
        }

        .no-data {
            text-align: center;
            font-style: italic;
            color: #999;
        }
    </style>
</head>
<body>

{{-- Company Header --}}
<div class="header-section">
    <table style="width: 100%; border: none;" cellpadding="0" cellspacing="0">
        <tr style="border: none;">
            <td style="width: 60%; border: none;">
                @if($company->logo)
                    <img src="{{ url($company->logo) }}" class="logo" alt="Logo" style="max-height: 60px;">
                @else
                    <strong style="font-size: 20px;">{{ $company->company_name }}</strong>
                @endif
            </td>
            <td style="text-align: right; border: none;">
                <strong>{{ $company->company_name }}</strong><br>
                Phone: {{ $company->company_pnone }}<br>
                Email: {{ $company->company_email }}<br>
                Address: {{ $company->address }}
            </td>
        </tr>
    </table>
</div>

{{-- Report Title --}}
<div class="report-title">Office Expense Report</div>

{{-- Date Range --}}
<div class="date-range">
    <strong>From:</strong> {{ $from ?? 'N/A' }} &nbsp;&nbsp;&nbsp;
    <strong>To:</strong> {{ $to ?? 'N/A' }}
</div>

{{-- Table --}}
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Transaction Type</th>
        <th>Head</th>
        <th>Purpose</th>
        <th>Expense</th>
        <th>Income</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total_buying = 0;
        $total_selling = 0;
    @endphp

    @forelse($transactions as $t)
        <tr>
            <td>{{ $t->date }}</td>
            <td>{{ $t->transaction_type }}</td>
            <td>{{ $t->head }}</td>
            <td>{{ $t->purpose }}</td>
            <td>
                {{ $t->buying_price ? number_format($t->buying_price, 2) : '-' }}
                @php $total_buying += $t->buying_price; @endphp
            </td>
            <td>
                {{ $t->selling_price ? number_format($t->selling_price, 2) : '-' }}
                @php $total_selling += $t->selling_price; @endphp
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6" class="no-data">No data found for the selected filter.</td>
        </tr>
    @endforelse

    @if(count($transactions))
        <tr class="total-row">
            <td colspan="4">Total</td>
            <td>{{ number_format($total_buying, 2) }}</td>
            <td>{{ number_format($total_selling, 2) }}</td>
        </tr>
    @endif
    </tbody>
</table>
<br>
{{-- Footer --}}
<div class="footer">
    Report generated on: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
</div>

</body>
</html>

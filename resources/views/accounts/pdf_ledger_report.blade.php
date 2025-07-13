<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Transactions Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #212529;
            margin: 20px;
        }

        .logo {
            max-height: 60px;
        }

        .header-section {
            margin-bottom: 20px;
            border-bottom: 2px solid #060e57;
            padding-bottom: 10px;
        }

        .company-details {
            font-size: 13px;
            line-height: 1.5;
            text-align: right;
        }

        .report-title {
            text-align: center;
            font-size: 18px;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #060e57;
        }

        .date-range {
            text-align: center;
            margin-bottom: 15px;
            font-size: 13px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table thead {
            background-color: #19196e;
            color: #fff;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }
    </style>
</head>
<body>

{{-- ✅ Company Header --}}
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

{{-- ✅ Report Title --}}
<h3 class="report-title">Transactions Report</h3>
<p class="date-range">
    <strong>From:</strong> {{ $from ?? 'N/A' }} &nbsp;&nbsp;&nbsp;
    <strong>To:</strong> {{ $to ?? 'N/A' }}
</p>

{{-- ✅ Transaction Table --}}
<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Invoice</th>
        <th>Source</th>
        <th>Purpose</th>
        <th>Buying Price</th>
        <th>Selling Price</th>
        <th>Profit</th>
    </tr>
    </thead>
    <tbody>
    @php
        $total_buy = 0;
        $total_sell = 0;
        $total_profit = 0;
    @endphp
    @foreach($transactions as $t)
        @php
            $profit = $t->selling_price - $t->buying_price;
            $total_buy += $t->buying_price;
            $total_sell += $t->selling_price;
            $total_profit += $profit;
        @endphp
        <tr>
            <td>{{ $t->date }}</td>
            <td>{{ $t->invoice_id }}</td>
            <td>{{ $t->source }}</td>
            <td>{{ $t->purpose }}</td>
            <td>{{ number_format($t->buying_price, 2) }}</td>
            <td>{{ number_format($t->selling_price, 2) }}</td>
            <td>{{ number_format($profit, 2) }}</td>
        </tr>
    @endforeach
    @if(count($transactions))
        <tr class="total-row">
            <td colspan="4">Total</td>
            <td>{{ number_format($total_buy, 2) }}</td>
            <td>{{ number_format($total_sell, 2) }}</td>
            <td>{{ number_format($total_profit, 2) }}</td>
        </tr>
    @endif
    </tbody>
</table>
<div class="footer">
    Report generated on: {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
</div>
</body>
</html>

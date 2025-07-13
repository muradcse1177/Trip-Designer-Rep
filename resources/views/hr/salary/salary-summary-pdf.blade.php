<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Salary Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 25px;
            color: #333;
        }

        .logo {
            max-height: 60px;
        }

        .company-info {
            text-align: right;
            font-size: 12px;
            line-height: 1.5;
        }

        h2.title {
            text-align: center;
            font-size: 18px;
            color: #007BFF;
            margin: 20px 0 10px;
        }

        .header-section {
            border-bottom: 2px solid #007BFF;
            margin-bottom: 10px;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 6px;
            text-align: center;
        }

        th {
            background: #f0f0f0;
        }

        .total-row {
            font-weight: bold;
            background: #f9f9f9;
        }

        .footer {
            text-align: right;
            font-size: 10px;
            margin-top: 30px;
            color: #666;
        }
    </style>
</head>
<body>

<!-- Header -->
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

<!-- Title -->
<h2 class="title">
    Salary Report — {{ \Carbon\Carbon::create()->month($month)->format('F') }} {{ $year }}
</h2>

<!-- Table -->
<table>
    <thead>
    <tr>
        <th>Employee</th>
        <th>Basic</th>
        <th>House Rent</th>
        <th>Medical</th>
        <th>Transport</th>
        <th>Commission</th>
        <th>TA/DA</th>
        <th>Total</th>
        <th>Working</th>
        <th>Attendance</th>
        <th>Net Salary</th>
        <th>Advance</th>
        <th>Deduct</th>
        <th>Net Pay</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salaries as $sal)
        <tr>
            <td>{{ $sal->name }}</td>
            <td>{{ number_format($sal->basic, 2) }}</td>
            <td>{{ number_format($sal->house_rent, 2) }}</td>
            <td>{{ number_format($sal->medical, 2) }}</td>
            <td>{{ number_format($sal->transport, 2) }}</td>
            <td>{{ number_format($sal->commission, 2) }}</td>
            <td>{{ number_format($sal->ta_da, 2) }}</td>
            <td>{{ number_format($sal->salary, 2) }}</td>
            <td>{{ $workingDays }}</td>
            <td>{{ $sal->attendance_day ?? '-' }}</td>
            <td>{{ number_format($sal->net_salary ?? 0, 2) }}</td>
            <td>{{ number_format($sal->advance ?? 0, 2) }}</td>
            <td>{{ number_format($sal->deduct ?? 0, 2) }}</td>
            <td><strong>{{ number_format($sal->net_pay ?? 0, 2) }}</strong></td>
        </tr>
    @endforeach

    <tr class="total-row">
        <td colspan="7">Total Salary</td>
        <td>{{ number_format($salaries->sum('salary'), 2) }}</td>
        <td colspan="2"></td>
        <td>{{ number_format($salaries->sum('net_salary'), 2) }}</td>
        <td>{{ number_format($salaries->sum('advance'), 2) }}</td>
        <td>{{ number_format($salaries->sum('deduct'), 2) }}</td>
        <td>{{ number_format($salaries->sum('net_pay'), 2) }}</td>
    </tr>
    </tbody>
</table>

<!-- Footer -->
<div class="footer">
    Report Generated: {{ now()->format('d M Y') }}
</div>

</body>
</html>

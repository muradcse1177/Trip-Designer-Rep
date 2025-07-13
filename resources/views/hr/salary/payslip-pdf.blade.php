<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pay Slip</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #333;
            margin: 20px;
        }
        .header-section {
            border-bottom: 2px solid #060e57;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .logo {
            max-height: 60px;
        }
        .company-info {
            text-align: right;
            font-size: 13px;
            line-height: 1.5;
        }
        .title {
            text-align: center;
            font-size: 20px;
            color: #06069a;
            margin-bottom: 20px;
        }
        .info-table, .salary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table td, .salary-table td, .salary-table th {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .info-table td:first-child {
            width: 35%;
            background-color: #f7f7f7;
            font-weight: bold;
        }
        .salary-table th {
            background-color: #19196e;
            color: white;
        }
        .salary-table td {
            text-align: right;
        }
        .salary-table td:first-child {
            text-align: left;
        }
        .total-row {
            font-weight: bold;
            background-color: #f1f1f1;
        }
        .footer {
            font-size: 12px;
            text-align: right;
            margin-top: 40px;
            color: #777;
        }
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 60px;
            color: #cccccc;
            opacity: 0.2;
            z-index: -1;
            white-space: nowrap;
            pointer-events: none;
            font-weight: bold;
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header-section">
    <table style="width: 100%;">
        <tr>
            <td style="width: 60%;">
                @if($company->logo)
                    <img src="{{ url($company->logo) }}" class="logo" alt="Logo">
                @else
                    <strong style="font-size: 20px;">{{ $company->company_name }}</strong>
                @endif
            </td>
            <td class="company-info">
                <strong>{{ $company->company_name }}</strong><br>
                Phone: {{ $company->company_pnone }}<br>
                Email: {{ $company->company_email }}<br>
                Address: {{ $company->address }}
            </td>
        </tr>
    </table>
</div>
<div class="watermark">{{ $company->company_name }}</div>
<!-- Title -->
<div class="title">
    Employee Pay Slip - {{ DateTime::createFromFormat('!m', $salary->month)->format('F') }} {{ $salary->year }}
</div>

<!-- Employee Info -->
<table class="info-table">
    <tr><td>Employee Name</td><td>{{ $salary->name }}</td></tr>
    <tr><td>Designation</td><td>{{ $salary->designation }}</td></tr>
    <tr><td>Phone</td><td>{{ '880'.$salary->phone }}</td></tr>
    <tr><td>Email</td><td>{{ $salary->email }}</td></tr>
</table>

<!-- Salary Breakdown -->
<table class="salary-table">
    <thead>
    <tr>
        <th>Salary Details</th>
        <th>Amount (BDT)</th>
    </tr>
    </thead>
    <tbody>
    <tr><td>Basic</td><td>{{ number_format($salary->basic, 2) }}</td></tr>
    <tr><td>House Rent</td><td>{{ number_format($salary->house_rent, 2) }}</td></tr>
    <tr><td>Medical</td><td>{{ number_format($salary->medical, 2) }}</td></tr>
    <tr><td>Transport</td><td>{{ number_format($salary->transport, 2) }}</td></tr>
    <tr><td>Commission</td><td>{{ number_format($salary->commission, 2) }}</td></tr>
    <tr><td>TA/DA</td><td>{{ number_format($salary->ta_da, 2) }}</td></tr>
    <tr><td>Working Days</td><td>{{ $workingDays }} Days</td></tr>
    <tr><td>Attendance Days</td><td>{{ $salary->attendance }} Days</td></tr>
    <tr class="total-row"><td>Total Salary</td><td>{{ number_format($salary->net_salary, 2) }}</td></tr>
    </tbody>
</table>

<!-- Footer -->
<div class="footer">
    This pay slip generated and verified by <b>{{$company->company_name}} </b>.
</div>

</body>
</html>

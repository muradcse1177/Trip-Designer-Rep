<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Salary Slip</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .container {
            max-width: 700px;
            margin: 40px auto;
            background: #ffffff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header img {
            height: 60px;
            margin-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            color: #198754;
        }
        .subheading {
            text-align: center;
            font-size: 15px;
            color: #6c757d;
            margin-bottom: 30px;
        }
        .section-title {
            background-color: #198754;
            color: #fff;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 4px 4px 0 0;
            margin-top: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
        }
        th, td {
            padding: 12px 15px;
            font-size: 14px;
        }
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        .highlight-row {
            background-color: #e9f7ef;
            font-weight: bold;
        }
        .deduction-row {
            background-color: #fff3cd;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 13px;
            color: #6c757d;
        }
    </style>
</head>
<body>
<div class="container">
    {{-- Header with logo and company name --}}
    <div class="header">
        <h1>{{ $company->company_name }}</h1>
        <div class="subheading">{{ $company->company_email }} | {{ $company->phone_code.$company->company_pnone }}</div>
    </div>

    {{-- Greeting --}}
    <p>Dear <strong>{{ $employee->name }}</strong>,</p>
    <p>Please find below your salary slip for <strong>{{ $salary->month }}/{{ $salary->year }}</strong>.</p>

    {{-- Earnings Section --}}
    <div class="section-title">Earnings</div>
    <table>
        <tbody>
        <tr><td>Basic</td><td>{{ number_format($salary->basic, 2) }}</td></tr>
        <tr><td>House Rent</td><td>{{ number_format($salary->house_rent, 2) }}</td></tr>
        <tr><td>Medical</td><td>{{ number_format($salary->medical, 2) }}</td></tr>
        <tr><td>Transport</td><td>{{ number_format($salary->transport, 2) }}</td></tr>
        <tr><td>Commission</td><td>{{ number_format($salary->commission, 2) }}</td></tr>
        <tr><td>TA/DA</td><td>{{ number_format($salary->ta_da, 2) }}</td></tr>
        <tr class="highlight-row"><td>Net Salary</td><td>{{ number_format($salary->net_salary, 2) }}</td></tr>
        </tbody>
    </table>

    {{-- Deductions Section --}}
    <div class="section-title" style="background-color:#dc3545;">Deductions</div>
    <table>
        <tbody>
        <tr><td>Advance</td><td>{{ number_format($salary->advance, 2) }}</td></tr>
        <tr><td>Deduct</td><td>{{ number_format($salary->deduct, 2) }}</td></tr>
        <tr><td>Loan</td><td>{{ number_format($salary->loan_due, 2) }}</td></tr>
        <tr class="deduction-row"><td>Net Pay</td><td>{{ number_format($salary->net_pay, 2) }}</td></tr>
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        Thank you for your dedication and contribution.<br>
        — HR Department, {{ $company->company_name }}
    </div>
</div>
</body>
</html>

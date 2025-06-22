<!DOCTYPE html>
<html>
<head>
    <title>Attendance Report</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            font-size: 20px;
            border-bottom: 2px solid #444;
            padding-bottom: 5px;
        }

        .info {
            margin-top: 10px;
        }

        .info p {
            margin: 3px 0;
        }

        .summary {
            margin-top: 10px;
            padding: 10px;
            background: #f5f5f5;
            border: 1px solid #ccc;
            width: 100%;
        }

        .summary ul {
            padding-left: 18px;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 11px;
        }

        th {
            background-color: #f0f0f0;
        }

        th, td {
            border: 1px solid #666;
            padding: 6px;
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
        }
        .header {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            padding: 20px;
            margin-bottom: 30px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .header h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #343a40;
        }

        .header-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: nowrap;
        }

        .company-logo img {
            height: 50px;
            width: 180px;
            object-fit: contain;
            border-radius: 4px;
        }

        .company-info {
            flex: 1;
        }

        .company-info h5 {
            margin: 0 0 8px;
            color: #007bff;
        }

        .company-info p {
            margin: 2px 0;
            font-size: 14px;
            color: #495057;
        }
    </style>
</head>
<body>

<div class="header">
    <h2>Attendance Report</h2>
    <div class="header-box">
        <div class="company-logo">
            <img src="{{ url($company->logo) }}" alt="Logo">
        </div>
        <div class="company-info">
            <p>Phone: {{ $company->company_pnone }}</p>
            <p>Email: {{ $company->company_email }}</p>
            <p>Address: {{ $company->address }}</p>
        </div>
    </div>
</div>

<div class="info">
    <p><strong>Employee:</strong> {{ $employee->company_name }}</p>
    <p><strong>Date Range:</strong> {{ $start_date }} to {{ $end_date }}</p>
</div>

<div class="summary">
    <ul>
        <li><strong>Office Days this Month:</strong> {{ $rangeOfficeDays }} days</li>
        <li><strong>Total Present Days (Entry Given):</strong> {{ $totalPresentDays }} days</li>
        <li><strong>Late Entries:</strong> {{ $lateCount }} days</li>
        <li><strong>Early Exits:</strong> {{ $earlyExitCount }} days</li>
        <li><strong>Current Month Days:</strong> {{ $currentMonthDays }} days</li>
    </ul>
</div>

<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Entry Time</th>
        <th>Exit Time</th>
        <th>Late</th>
        <th>Early Exit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($atts as $att)
        <tr>
            <td>{{ $att->date }}</td>
            <td>{{ $att->entry_time ?? '-' }}</td>
            <td>{{ $att->exit_time ?? '-' }}</td>
            <td>{{ $att->late ?? '-' }}</td>
            <td>{{ $att->early_exit ?? '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="footer">
    Generated on {{ \Carbon\Carbon::now()->format('d M Y, h:i A') }}
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->transaction_id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            font-size: 14px;
            margin: 0;
            padding: 0;
            background: #f9f9f9;
        }
        .invoice-box {
            max-width: 800px;
            margin: 30px auto;
            padding: 30px 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
        }
        .logo {
            max-width: 160px;
        }
        .header,
        .footer {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h2 {
            margin: 10px 0 0;
            font-size: 28px;
            color: #007bff;
        }
        .info-table,
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .info-table td {
            padding: 10px 15px;
            vertical-align: top;
        }
        .info-box {
            background: #f5f5f5;
            border-radius: 5px;
        }
        .summary-table th,
        .summary-table td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        .summary-table th {
            background-color: #f1f1f1;
            text-align: left;
        }
        .summary-table .total-row td {
            font-weight: bold;
            background-color: #fafafa;
        }
        .footer p {
            font-size: 12px;
            color: #777;
        }
        .text-right {
            text-align: right;
        }
        .status-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            background-color: {{
        strtolower($order->status) == 'complete' ? '#28a745' :
        (strtolower($order->status) == 'pending' ? '#ffc107' :
        (strtolower($order->status) == 'cancel' ? '#dc3545' : '#6c757d'))
    }};
            text-transform: uppercase;
        }
    </style>
</head>
<body>

<div class="invoice-box">
    {{-- Logo and Header --}}
    <div class="header">
        <img src="{{ url('public/logo.jpg') }}" alt="Logo" class="logo">
        <h2>Invoice</h2>
        <small>#{{ $order->transaction_id }}</small><br>
        <small>{{ \Carbon\Carbon::parse($order->time)->format('d M Y') }}</small>
    </div>

    {{-- Customer & Course Info --}}
    <table class="info-table">
        <tr>
            <td class="info-box">
                <strong>Customer Info</strong><br>
                Name: {{ $order->name }}<br>
                Email: {{ $order->email }}<br>
                Phone: {{ $order->phone }}
            </td>
            <td class="info-box">
                <strong>Product Info</strong><br>
                Course: {{ $order->product_name }}<br>
                Type: {{ $order->product_category }}<br>
                Status: <span class="status-badge">{{ ucfirst($order->status) }}</span>
            </td>
        </tr>
    </table>

    {{-- Payment Summary --}}
    <table class="summary-table">
        <thead>
        <tr>
            <th>Description</th>
            <th class="text-right">Amount (BDT)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $order->product_name }}</td>
            <td class="text-right">{{ number_format($order->amount, 2) }}</td>
        </tr>
        <tr class="total-row">
            <td>Total</td>
            <td class="text-right">BDT {{ number_format($order->amount, 2) }}</td>
        </tr>
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Thank you for booking with <strong>Trip Designer</strong>.</p>
        <p>For any queries, contact us at <a href="mailto:sales@tripdesigner.net">sales@tripdesigner.net</a></p>
    </div>
</div>

</body>
</html>

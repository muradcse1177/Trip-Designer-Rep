<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - Trip Designer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
            color: #2c3e50;
            padding: 0;
        }
        .invoice {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            position: relative;
        }
        .invoice::before {
            content: "";
            height: 6px;
            width: 100%;
            background: #1abc9c;
            position: absolute;
            top: 0;
            left: 0;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo img {
            height: 60px;
        }
        .invoice-title {
            text-align: right;
        }
        .invoice-title h1 {
            margin: 0;
            font-size: 28px;
        }
        .section {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .card {
            width: 30%;
            background: #ecf0f1;
            border-radius: 8px;
            padding: 15px;
            font-size: 14px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .card h3 {
            margin: 0 0 8px;
            font-size: 16px;
            color: #34495e;
        }
        table {
            width: 100%;
            margin-top: 40px;
            border-collapse: collapse;
            font-size: 14px;
        }
        table th, table td {
            padding: 12px 10px;
            border-bottom: 1px solid #ccc;
        }
        table thead {
            background-color: #1abc9c;
            color: white;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        table tbody tr:hover {
            background-color: #f1fdfb;
        }
        .summary {
            margin-top: 40px;
            text-align: right;
            font-size: 15px;
        }
        .summary div {
            margin: 5px 0;
        }
        .paid { color: green; }
        .due { color: red; }
        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
        }
        .sign {
            text-align: center;
            width: 40%;
            border-top: 1px dashed #aaa;
            padding-top: 10px;
            font-weight: 600;
        }
        .footer-note {
            margin-top: 50px;
            text-align: center;
            font-size: 13px;
            color: #555;
            font-style: italic;
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
            body {
                background: #fff !important;
                color: #000 !important;
            }
            .invoice {
                box-shadow: none !important;
                border: none !important;
            }
            .invoice::before {
                background: #1abc9c !important;
            }
            .card {
                background: #ecf0f1 !important;
            }
            thead {
                background: #1abc9c !important;
                color: white !important;
            }
            .due {
                color: red !important;
            }
            .paid {
                color: green !important;
            }
            .sign {
                border-top: 1px dashed #000 !important;
                color: #000 !important;
            }
            .footer-note {
                color: #444 !important;
            }
            .summary {
                display: flex;
                justify-content: space-between;
                gap: 40px;
                margin-top: 40px;
            }
            .summary h3 {
                color: #1abc9c;
                margin-bottom: 10px;
                border-bottom: 1px solid #ccc;
                padding-bottom: 6px;
            }
            .payment-details p,
            .totals p {
                margin: 6px 0;
            }
            @page {
                size: auto;
                margin: 0.5in;
            }
        }
    </style>
</head>
<body>
<div class="invoice">
    <div class="header">
        <div class="logo">
            <img src="{{$domain.'/'.@$agent_info->logo}}" alt="Company Logo">
        </div>
        <div class="invoice-title">
            <h1>INVOICE</h1>
            <p>Date: {{$invoice->date}}</p>
            <p>Invoice #: {{$invoice->invoice_id}}</p>
        </div>
    </div>

    <div class="section" style="display: flex; justify-content: space-between; gap: 20px; margin-top: 40px;">
        <div class="card" style="flex: 1; background: #f0f3f5; padding: 20px; border-radius: 10px; font-size: 14px;">
            <h3 style="margin-top: 0; color: #34495e; font-size: 16px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 6px;">From</h3>
            {{$agent_info->company_name}}<br>
            Phone: {{$company_info->phone_code.$company_info->company_pnone}}<br>
            Email: {{$company_info->company_email}}<br>
            Address: {{@$company_info->address}}
        </div>

        <div class="card" style="flex: 1; background: #f0f3f5; padding: 20px; border-radius: 10px; font-size: 14px;">
            <h3 style="margin-top: 0; color: #34495e; font-size: 16px; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 6px;">To</h3>
            {{$invoice->name}}<br>
            Phone: {{$invoice->phone}}<br>
            Email: {{$invoice->email}}<br>
            Address: {{$invoice->address}}
        </div>
    </div>

    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>Purpose</th>
            <th>Passengers</th>
            <th>Reference</th>
            <th>Amount</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $purposes = json_decode($invoice->purpose);
        $pax_numbers = json_decode($invoice->pax_number);
        $amounts = json_decode($invoice->amount);
        $references = json_decode($invoice->reference);
        $i = 0;
        $sum = 0;
        ?>
        @foreach($purposes as $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $purposes[$i] }}</td>
                <td>{{ $pax_numbers[$i] }}</td>
                <td>{{ $references[$i] }}</td>
                <td>{{ $amounts[$i].' '.$c_info->symbol }}</td>
                    <?php $sum += $amounts[$i]; $i++; ?>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="summary" style="display: flex; justify-content: space-between; gap: 40px; margin-top: 40px;">
        <!-- Left part: Payment Info -->
        <div class="payment-details" style="flex: 1; font-size: 14px;">
            <h3 style="color: #1abc9c; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 6px;">Payment Info</h3>
            <p><strong>Method:</strong> {{ @$invoice->p_method }}</p>
            <p><strong>Account:</strong> {{ @$invoice->acc_number }}</p>
            <p><strong>Due:</strong> <span style="color: red; font-weight: bold;">{{ $invoice->due_amount.' '.$c_info->symbol }}</span></p>
        </div>

        <!-- Right part: Summary breakdown -->
        <div class="totals" style="flex: 1; font-size: 14px; text-align: right;">
            <h3 style="color: #1abc9c; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 6px;">Summary</h3>
            <p><strong>Subtotal:</strong> {{ $sum.' '.$c_info->symbol }}</p>
            <p><strong>Tax:</strong> 0.00 {{ $c_info->symbol }}</p>
            @if($invoice->due_amount > 0)
                <p><strong class="paid" style="color: green;">Paid:</strong> {{ $sum - $invoice->due_amount.' '.$c_info->symbol }}</p>
            @else
                <p><strong class="paid" style="color: green;">Paid:</strong> {{ $sum.' '.$c_info->symbol }}</p>
            @endif
            <p><strong class="due" style="color: red;">Due:</strong> {{ $invoice->due_amount.' '.$c_info->symbol }}</p>
        </div>
    </div>

    <div class="signature-section">
        <div class="sign">Customer Signature</div>
        <div class="sign">Authorized Signature</div>
    </div>

    <div class="footer-note">
        This is a system-generated invoice approved by <strong>Trip Designer</strong>. No additional signature is required.
    </div>
</div>

<script>
    window.addEventListener("load", () => window.print());
</script>
</body>
</html>

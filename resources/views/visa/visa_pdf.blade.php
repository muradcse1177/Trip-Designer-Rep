<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Visa Invoice</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        .header, .section-title {
            text-align: center;
            font-weight: bold;
        }

        .divider {
            position: relative;
            text-align: center;
        }

        .divider img {
            width: 100%;
            height: 50px;
            opacity: 0.1;
        }

        .divider .title {
            position: absolute;
            top: 15px;
            left: 0;
            width: 100%;
            text-align: center;
            font-weight: bold;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        td, th {
            padding: 6px;
            border: 1px solid #ccc;
        }

        .no-border td {
            border: none;
        }

        .text-right {
            text-align: right;
        }

        .text-purple {
            color: purple;
        }

        .text-danger {
            color: red;
        }

        hr {
            border: 0;
            border-top: 1px dashed #ccc;
            margin: 5px 0;
        }
    </style>
</head>
<body>

<div class="header">
    <h3>Visa Invoice ({{ 'TV-' . $visa->id }})</h3>
</div>

<table class="no-border">
    <tr>
        <td>
            <img src="{{ url($company->logo) }}" alt="Company Logo" height="50" width="180">
        </td>
        <td class="text-right">
            <strong>{{ $company->company_name }}</strong><br>
            Phone: {{ $company->company_pnone }}<br>
            Email: {{ $company->company_email }}<br>
            Address: {{ $company->address }}
        </td>
    </tr>
</table><br>

<div class="divider">
    <img src="{{ url('public/ssss.png') }}" alt="divider">
    <div class="title">Visa Application Details</div>
</div>

<table>
    <tr>
        <td><strong>Invoice No.</strong></td>
        <td>{{ 'TV-' . $visa->id }}</td>
    </tr>
    <tr>
        <td><strong>Booking Date</strong></td>
        <td>{{ $visa->date }}</td>
    </tr>
    <tr>
        <td><strong>Visa Country</strong></td>
        <td>{{ $visa->visa_country }}</td>
    </tr>
    <tr>
        <td><strong>Visa Service Details</strong></td>
        <td>{{ $visa->v_details }}</td>
    </tr>
    <tr>
        <td><strong>Guest Details</strong></td>
        <td>
            @php $j = 1; @endphp
            @foreach($passengers as $p)
                <strong>{{ $j }}. Name:</strong> {{ $p->f_name }} {{ $p->l_name }}<br>
                <strong>Passport No:</strong> {{ $p->p_number }}
                @if(!$loop->last)<hr>@endif
                @php $j++; @endphp
            @endforeach
        </td>
    </tr>
</table><br>

<div class="divider">
    <img src="{{ url('public/ssss.png') }}" alt="divider">
    <div class="title">Payments Details</div>
</div>

<table>
    <tr>
        <td rowspan="6" style="width: 50%">
            <p><strong>Payment Type:</strong> {{ $visa->v_p_type }}</p>
            <p><strong>Payment Details:</strong><br>{!! nl2br($visa->v_p_details) !!}</p>
        </td>
        <td class="text-right">Visa Price</td>
        <td class="text-right">{{ $visa->v_c_price }}/-</td>
    </tr>
    <tr>
        <td class="text-right">VAT</td>
        <td class="text-right">{{ $visa->v_vat }}/-</td>
    </tr>
    <tr>
        <td class="text-right">AIT</td>
        <td class="text-right">{{ $visa->v_ait }}/-</td>
    </tr>
    <tr>
        <td class="text-right text-purple"><strong>Grand Total</strong></td>
        <td class="text-right text-purple">
            <strong>{{ $visa->v_c_price + $visa->v_vat + $visa->v_ait }}/-</strong>
        </td>
    </tr>
    <tr>
        <td class="text-right">Due Amount</td>
        <td class="text-right">{{ $visa->v_due }}/-</td>
    </tr>
    <tr>
        <td class="text-right text-danger"><strong>Total Paid Amount</strong></td>
        <td class="text-right text-danger">
            <strong>{{ $visa->v_c_price + $visa->v_vat + $visa->v_ait - $visa->v_due }}/-</strong>
        </td>
    </tr>
</table>

</body>
</html>

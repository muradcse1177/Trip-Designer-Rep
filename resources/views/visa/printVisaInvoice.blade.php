<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Visa Invoice - TV-{{ $visa->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Fonts & CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600&display=swap">
    <link rel="stylesheet" href="{{ url('/public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/dist/css/adminlte.min.css') }}">

    <style>
        body {
            font-family: 'Source Sans Pro', sans-serif;
            background: #fff;
            font-size: 14px;
        }
        .container {
            padding: 30px;
        }
        .divider-title {
            position: relative;
            text-align: center;
            margin-bottom: 20px;
        }
        .divider-title img {
            width: 100%;
            height: 40px;
            opacity: 0.1;
        }
        .divider-title .text {
            position: absolute;
            top: 8px;
            left: 0;
            right: 0;
            font-weight: bold;
            color: #000;
        }
        .table td, .table th {
            vertical-align: middle !important;
        }
        @media print {
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body onload="window.print()">
<div class="container">
    <div class="text-center mb-4">
        <h4><strong>Visa Invoice - TV-{{ $visa->id }}</strong></h4>
    </div>

    <!-- Company & Header -->
    <table class="table mb-4">
        <tr>
            <td>
                <img src="{{ url($company->logo) }}" height="50" width="180">
            </td>
            <td class="text-right">
                <h5><strong>{{ $company->company_name }}</strong></h5>
                <p class="mb-1">Phone: {{ $company->company_pnone }}</p>
                <p class="mb-1">Email: {{ $company->company_email }}</p>
                <p class="mb-0">Address: {{ $company->address }}</p>
            </td>
        </tr>
    </table>

    <!-- Visa Details Divider -->
    <div class="divider-title">
        <img src="{{ url('public/ssss.png') }}" alt="divider">
        <div class="text">Visa Application Details</div>
    </div>

    <table class="table table-bordered">
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
                @php $p = json_decode($visa->p_details); $j = 1; @endphp
                @foreach($p as $pas)
                    @php
                        $name = DB::table('passengers')
                            ->where('id',$pas)
                            ->where('upload_by', Session::get('agent_id'))
                            ->first();
                    @endphp
                    <div>
                        <strong>{{ $j }}. Name:</strong> {{ $name->f_name }} {{ $name->l_name }}<br>
                        <strong>Passport No:</strong> {{ $name->p_number }}
                    </div>
                    <hr>
                    @php $j++; @endphp
                @endforeach
            </td>
        </tr>
    </table>

    <!-- Payment Details Divider -->
    <div class="divider-title">
        <img src="{{ url('public/ssss.png') }}" alt="divider">
        <div class="text">Payments Details</div>
    </div>

    <table class="table table-bordered">
        <tr>
            <td rowspan="6" style="width: 50%;">
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
            <td class="text-right text-primary"><strong>Grand Total</strong></td>
            <td class="text-right text-primary">
                <strong>{{ $visa->v_c_price + $visa->v_vat + $visa->v_ait }}/-</strong>
            </td>
        </tr>
        <tr>
            <td class="text-right">Due Amount</td>
            <td class="text-right">{{ $visa->v_due }}/-</td>
        </tr>
        <tr>
            <td class="text-right text-success"><strong>Total Paid Amount</strong></td>
            <td class="text-right text-success">
                <strong>{{ $visa->v_c_price + $visa->v_vat + $visa->v_ait - $visa->v_due }}/-</strong>
            </td>
        </tr>
    </table>
</div>
</body>
</html>

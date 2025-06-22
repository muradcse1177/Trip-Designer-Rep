<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Air Ticket Invoice</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #333;
        }
        .invoice-box {
            padding: 5px;
            border: 1px solid #ddd;
            width: 100%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            text-transform: uppercase;
            font-size: 18px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #bbb;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .section-title {
            font-weight: bold;
            font-size: 14px;
            margin-top: 25px;
            margin-bottom: 5px;
            border-left: 5px solid #007BFF;
            padding-left: 8px;
            background-color: #f8f8f8;
        }
        .no-border td {
            border: none !important;
            padding: 4px;
        }
        .totals td {
            font-weight: bold;
        }
        .logo {
            height: 50px;
        }

    </style>
</head>
<body>
<div class="invoice-box">
    <table class="no-border">
        <tr>
            <td style="width: 60%;">
                @if($company->logo)
                    <img src="{{ url($company->logo) }}" class="logo" alt="Logo">
                @else
                    <strong>{{ $company->company_name }}</strong>
                @endif
            </td>
            <td style="text-align: right;">
                <strong>{{ $company->company_name }}</strong><br>
                Phone: {{ $company->company_pnone }}<br>
                Email: {{ $company->company_email }}<br>
                Address: {{ $company->address }}
            </td>
        </tr>
    </table>

    <h2>Electronic Ticket / Invoice</h2>

    <div class="section-title">Booking Details</div>
    <table>
        <tr>
            <th>Airline PNR</th>
            <th>Reservation PNR</th>
            <th>Issue Date</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>{{ $ticket->airline_pnr }}</td>
            <td>{{ $ticket->reservation_pnr }}</td>
            <td>{{ $ticket->issue_date }}</td>
            <td style="color: green;">Confirmed</td>
        </tr>
    </table>

    @php
        $pax = json_decode($ticket->pax_name);
        $t_number = json_decode($ticket->t_number);
        $luggage = json_decode($ticket->luggage);
        $a_from = json_decode($ticket->a_from);
        $a_to = json_decode($ticket->a_to);
        $d_time = json_decode($ticket->d_time);
        $a_time = json_decode($ticket->a_time);
        $airlines = json_decode($ticket->airlines);
        $f_number = json_decode($ticket->f_number);
    @endphp

    <div class="section-title">Passenger Details</div>
    <table>
        <tr>
            <th>Passenger Name</th>
            <th>Ticket Number</th>
            <th>Baggage</th>
        </tr>
        @for($i = 0; $i < $ticket->pax_number; $i++)
            @php $passenger = DB::table('passengers')->where('id', $pax[$i])->first(); @endphp
            <tr>
                <td>{{ $passenger->f_name . ' ' . $passenger->l_name }}</td>
                <td>{{ $t_number[$i] }}</td>
                <td>{{ $luggage[$i] }}</td>
            </tr>
        @endfor
    </table>

    <div class="section-title">Flight Details</div>
    <table>
        <tr>
            <th>Airlines</th>
            <th>Flight Number</th>
            <th>From</th>
            <th>To</th>
            <th>Departure</th>
            <th>Arrival</th>
        </tr>
        @for($i = 0; $i < count($f_number); $i++)
            <tr>
                <td>{{ $airlines[$i] }}</td>
                <td>{{ $f_number[$i] }}</td>
                <td>{{ $a_from[$i] }}</td>
                <td>{{ $a_to[$i] }}</td>
                <td>{{ $d_time[$i] }}</td>
                <td>{{ $a_time[$i] }}</td>
            </tr>
        @endfor
    </table>

    <div class="section-title">Payment Details</div>
    <table>
        <tr>
            <td><strong>Payment Type:</strong> {{ $ticket->payment_type }}</td>
            <td><strong>Payment Info:</strong> {!! nl2br($ticket->p_details) !!}</td>
        </tr>
    </table>

    <table class="totals">
        <tr>
            <td>Ticket Price</td>
            <td>{{ $ticket->c_price }}/-</td>
        </tr>
        <tr>
            <td>VAT</td>
            <td>{{ $ticket->vat }}/-</td>
        </tr>
        <tr>
            <td>AIT</td>
            <td>{{ $ticket->ait }}/-</td>
        </tr>
        <tr>
            <td><strong>Grand Total</strong></td>
            <td><strong>{{ $ticket->c_price + $ticket->vat + $ticket->ait }}/-</strong></td>
        </tr>
        <tr>
            <td>Due Amount</td>
            <td>{{ $ticket->due_amount }}/-</td>
        </tr>
    </table>

    <div class="section-title">Terms and Conditions</div>
    <div style="border: 1px solid #ccc; padding: 10px;">
        {!! nl2br($airTicketTnT->tnt) !!}
    </div>
</div>
</body>
</html>

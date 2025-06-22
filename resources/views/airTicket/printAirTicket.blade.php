<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trip Designer | Invoice Print</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ url('/public/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ url('/public/dist/css/adminlte.min.css') }}">
    <style>
        .invoice-box {
            padding: 40px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .section-title {
            border-left: 5px solid #ffc107;
            padding-left: 10px;
            margin: 30px 0 15px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #343a40;
        }
        .highlight-box-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px 10px;
            margin-bottom: 30px;
            box-shadow: inset 0 0 5px rgba(0,0,0,0.05);
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .highlight-box-row .box {
            flex: 0 0 48%;
            margin-bottom: 15px;
            text-align: center;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            background-color: #ffffff;
        }
        @media (min-width: 768px) {
            .highlight-box-row .box {
                flex: 0 0 23%;
            }
        }
        .highlight-box-row strong {
            display: block;
            font-size: 0.9rem;
            color: #6c757d;
        }
        .highlight-box-row span {
            font-size: 1.1rem;
            font-weight: 500;
            color: #212529;
        }
        .header-box {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-bottom: 30px;
        }
        .header-box .company-logo {
            flex: 1;
        }
        .header-box .company-info {
            flex: 1;
            text-align: right;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="invoice-box">
                        <div class="text-center mb-4">
                            <h4><strong>Electronic Ticket / Invoice</strong></h4>
                        </div>

                        <div class="header-box">
                            <div class="company-logo">
                                <img src="{{ url($company->logo) }}" height="50" width="180" alt="Logo">
                            </div>
                            <div class="company-info">
                                <h5><strong>{{ $company->company_name }}</strong></h5>
                                <p class="mb-0">Phone: {{ $company->company_pnone }}</p>
                                <p class="mb-0">Email: {{ $company->company_email }}</p>
                                <p class="mb-0">Address: {{ $company->address }}</p>
                            </div>
                        </div>

                        <div class="highlight-box-row">
                            <div class="box">
                                <strong>Airline PNR</strong>
                                <span>{{ $ticket->airline_pnr }}</span>
                            </div>
                            <div class="box">
                                <strong>Reservation PNR</strong>
                                <span>{{ $ticket->reservation_pnr }}</span>
                            </div>
                            <div class="box">
                                <strong>Issue Date</strong>
                                <span>{{ $ticket->issue_date }}</span>
                            </div>
                            <div class="box">
                                <strong>Status</strong>
                                <span class="text-success">Confirmed</span>
                            </div>
                        </div>

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
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Ticket Number</th>
                                <th>Baggage</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for($i = 0; $i < $ticket->pax_number; $i++)
                                @php $passenger = DB::table('passengers')->where('id', $pax[$i])->first(); @endphp
                                <tr>
                                    <td>{{ $passenger->f_name . ' ' . $passenger->l_name }}</td>
                                    <td>{{ $t_number[$i] }}</td>
                                    <td>{{ $luggage[$i] }}</td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>

                        <div class="section-title">Flight Details</div>
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Airlines</th>
                                <th>Flight Number</th>
                                <th>From</th>
                                <th>To</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                            </tr>
                            </thead>
                            <tbody>
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
                            </tbody>
                        </table>

                        <div class="section-title">Payment Details</div>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Payment Type:</strong> {{ $ticket->payment_type }}</p>
                                <p><strong>Payment Details:</strong><br>{!! nl2br($ticket->p_details) !!}</p>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Ticket Price</span><span>{{ $ticket->c_price }}/-</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>VAT</span><span>{{ $ticket->vat }}/-</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>AIT</span><span>{{ $ticket->ait }}/-</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between font-weight-bold text-purple">
                                        <span>Grand Total</span><span>{{ $ticket->c_price + $ticket->vat + $ticket->ait }}/-</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <span>Due Amount</span><span>{{ $ticket->due_amount }}/-</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="section-title">Terms and Conditions</div>
                        <div class="mb-3">
                            {!! nl2br($airTicketTnT->tnt) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>

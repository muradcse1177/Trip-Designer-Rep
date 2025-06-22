@extends('mainLayout.layout')
@section('title','Trip Designer || New Air Ticket')
@section('airTicket','active')
@section('ticketMenu','menu-open')

@section('css')
    <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
    <style>
        .invoice-section {
            background: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }
        .section-title {
            border-left: 5px solid #ffc107;
            padding-left: 12px;
            margin: 30px 0 20px;
            font-size: 1.3rem;
            font-weight: bold;
            color: #343a40;
        }
        .info-box {
            background-color: #f1f3f5;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .info-label {
            font-weight: 600;
            color: #6c757d;
        }
        .info-value {
            font-size: 1.05rem;
            font-weight: 500;
            color: #212529;
        }
        .list-group-item span {
            font-weight: 500;
        }
        .text-purple {
            color: #6f42c1;
        }
        .table th {
            background-color: #f8f9fa;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Air Ticket Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Air Ticket Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="invoice-section">
                            <div class="text-center mb-4">
                                <h4><strong>Electronic Ticket / Invoice</strong></h4>
                            </div>

                            <div class="row mb-4 align-items-center">
                                <div class="col-md-6">
                                    <img src="{{url($company->logo)}}" height="50" width="180" alt="Company Logo">
                                </div>
                                <div class="col-md-6 text-md-right">
                                    <h5><strong>{{$company->company_name}}</strong></h5>
                                    <p class="mb-0">Phone: {{$company->company_pnone}}</p>
                                    <p class="mb-0">Email: {{$company->company_email}}</p>
                                    <p class="mb-0">Address: {{$company->address}}</p>
                                </div>
                            </div>

                            <div class="row info-box">
                                <div class="col-md-3"><span class="info-label">Airline PNR:</span><br><span class="info-value">{{$ticket->airline_pnr}}</span></div>
                                <div class="col-md-3"><span class="info-label">Reservation PNR:</span><br><span class="info-value">{{$ticket->reservation_pnr}}</span></div>
                                <div class="col-md-3"><span class="info-label">Issue Date:</span><br><span class="info-value">{{$ticket->issue_date}}</span></div>
                                <div class="col-md-3"><span class="info-label">Status:</span><br><span class="info-value text-success">Confirmed</span></div>
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
                                <thead>
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
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <p><strong>Payment Type:</strong> {{$ticket->payment_type}}</p>
                                    <p><strong>Payment Details:</strong><br>{!! nl2br($ticket->p_details) !!}</p>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-group">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Ticket Price</span><span>{{$ticket->c_price}}/-</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>VAT</span><span>{{$ticket->vat}}/-</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>AIT</span><span>{{$ticket->ait}}/-</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between text-purple font-weight-bold">
                                            <span>Grand Total</span><span>{{$ticket->c_price + $ticket->vat + $ticket->ait}}/-</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Due Amount</span><span>{{$ticket->due_amount}}/-</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="section-title">Terms and Conditions</div>
                            <div class="mb-4">
                                {!! nl2br($airTicketTnT->tnt) !!}
                            </div>

                            <div class="text-right">
                                {{ Form::open(['url' => 'generateAirInvoicePDF', 'method' => 'post']) }}
                                @csrf
                                <input type="hidden" name="id" value="{{$ticket->id}}">
                                <a href="{{url('printAirTicket?id='.$ticket->id)}}" target="_blank" class="btn btn-success">
                                    <i class="fas fa-print"></i> Print Invoice
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-download"></i> Download Invoice
                                </button>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
@endsection

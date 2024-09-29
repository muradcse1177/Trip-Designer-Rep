@extends('mainLayout.layout')
@section('title','Trip Designer || New Air Ticket')
@section('airTicket','active')
@section('ticketMenu','menu-open')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,td {
        height: 40px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Air Ticket Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Air Ticket Management</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning ">
                            <div class="card-header">
                                <h3 class="card-title">Air Ticket</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;" >
                                <div class="card-body row table-responsive">
                                    <div id="printArea" style="margin-top: 50px; margin-left: 50px; margin-right: 50px; margin-bottom: 50px;">
                                        <font size="3" face="Arial" >
                                        @section('css')
                                            <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
                                            <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
                                        @endsection
                                        <div class="col-12 d-flex justify-content-center">
                                            <h4><b>Electronic Ticket/Invoice</b></h4>
                                        </div>
                                        <table class="table" style="">
                                            <tr>
                                                <td>
                                                    <img src="{{url($company->logo)}}" height="50" width="180"/>
                                                </td>
                                                <td align="right" style="width: 100%;">
                                                    <div>
                                                        <h5><b>{{$company->company_name}}</b></h5>
                                                        <p>Phone: {{$company->company_pnone}}</p>
                                                        <p style="margin-top: -10px">Email:{{$company->company_email}}</p>
                                                        <p style="margin-top: -10px">Address: {{$company->address}}</p>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table" style="margin-top: -30px;">
                                            <tr>
                                                <td>
                                                        <p><b>Airline PNR: </b>{{$ticket->airline_pnr}}</p>
                                                </td>
                                                <td align="center">
                                                        <p><b>Reservation PNR: </b>{{$ticket->reservation_pnr}}</p>
                                                </td>
                                                <td align="right">
                                                        <p><b>Issue Date: </b>{{$ticket->issue_date}}</p>
                                                </td>
                                                <td align="right">
                                                        <b>Status: Confirmed</b>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php
                                        $pax = json_decode($ticket->pax_name);
                                        $t_number = json_decode($ticket->t_number);
                                        $luggage = json_decode($ticket->luggage);
                                        $a_from = json_decode($ticket->a_from);
                                        $a_to = json_decode($ticket->a_to);
                                        $d_time = json_decode($ticket->d_time);
                                        $a_time = json_decode($ticket->a_time);
                                        $airlines = json_decode($ticket->airlines);
                                        $f_number = json_decode($ticket->f_number);
                                        ?>

                                        <table class="table" style="margin-top: -30px;">
                                            <tr>
                                                <td colspan="3">
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Passenger Details</b></div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <th>Name</th>
                                            <th>Ticket Number</th>
                                            <th >Baggage</th>
                                            @for($i=0; $i<$ticket->pax_number; $i++)
                                                    <?php
                                                    $passenger = DB::table('passengers')->where('id',$pax[$i])->first();
                                                    ?>
                                                <tr>
                                                    <td>{{$passenger->f_name.' '.$passenger->l_name}}</td>
                                                    <td>{{$t_number[$i]}}</td>
                                                    <td>{{$luggage[$i]}}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                        <table class="table" style="margin-top: -20px;">
                                            <tr class="all">
                                                <td colspan="6">
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Flight Details</b></div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <th>Airlines</th>
                                            <th>Flight Number</th>
                                            <th>From</th>
                                            <th>To</th>
                                            <th>Departure</th>
                                            <th>Arrival</th>
                                            @for($i=0; $i<count($f_number); $i++)
                                                <tr>
                                                    <td>{{$airlines[$i]}}</td>
                                                    <td>{{$f_number[$i]}}</td>
                                                    <td>{{$a_from[$i]}}</td>
                                                    <td>{{$a_to[$i]}}</td>
                                                    <td>{{$d_time[$i]}}</td>
                                                    <td>{{$a_time[$i]}}</td>
                                                </tr>
                                            @endfor
                                        </table>
                                        <table class="table" style="margin-top: -20px;">
                                            <tr>
                                                <td>
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Payments Details</b></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td rowspan="6">
                                                    <div>
                                                        <p><b>Payment Type: </b>{{$ticket->payment_type}}</p>
                                                        <div><b>Payment Details:</b><br> {!! nl2br($ticket->p_details) !!}</div>
                                                    </div>
                                                </td>
                                                <td align="right">Ticket Price</td>
                                                <td  align="right">{{$ticket->c_price.'/-'}}</td>
                                            </tr>
                                            <tr>
                                                <td align="right" >VAT</td>
                                                <td  align="right">{{$ticket->vat.'/-'}}</td>
                                            </tr>
                                            <tr>
                                                <td align="right">AIT</td>
                                                <td  align="right">{{$ticket->ait.'/-'}}</td>
                                            </tr>
                                            <tr>
                                                <td align="right"><b style="color: purple;">Grand Total</b></td>
                                                <td  align="right"><b style="color: purple;">{{$ticket->c_price + $ticket->vat + $ticket->ait.'/-'}}</b></td>
                                            </tr>
                                            <tr>
                                                <td align="right">Due Amount</td>
                                                <td  align="right">{{$ticket->due_amount.'/-'}}</td>
                                            </tr>
                                        </table>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Terms and Conditions</b></div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                        {!! nl2br($airTicketTnT->tnt) !!}}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    {{ Form::open(array('url' => 'generateAirInvoicePDF',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                    {{ csrf_field() }}
                                    <a href="{{url('printAirTicket?id='.$ticket->id)}}"  target="_blank" class="btn btn-success float-left">Print Invoice</a>
                                    <button class="btn btn-warning float-right">Download Invoice</button>
                                    <input type="hidden" name="id" value="{{$ticket->id}}">
                                    {{ Form::close() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('js')
@endsection

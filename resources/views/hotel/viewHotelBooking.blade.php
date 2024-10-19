@extends('mainLayout.layout')
@section('title','Trip Designer || Hotel Booking')
@section('hotelBooking','active')
@section('hotelMenu','menu-open')
@section('hotel','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hotel Booking Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Hotel Booking Management</li>
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
                                <h3 class="card-title">Hotel Booking</h3>
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
                                        <font size="3" face="Century Gothic" >
                                            @section('css')
                                                <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
                                                <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
                                            @endsection
                                            <div class="col-12 d-flex justify-content-center">
                                                <h4><b> Hotel Booking Confirmation Details</b></h4>
                                            </div>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <img src="{{url(@$company->logo)}}" height="50" width="180"/>
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
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Booking Details</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                       <b>Hotel Name</b>
                                                    </td>
                                                    <td>
                                                        {{$package->h_name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Hotel Phone</b>
                                                    </td>
                                                    <td>
                                                        {{$package->h_phone}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b> Hotel Address</b>
                                                    </td>
                                                    <td>
                                                        {{$package->h_address}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <b>Check in - Check out</b>
                                                    </td>
                                                    <td>
                                                        {{$package->check_in.': 2.00PM' .' '. 'to'.' '.$package->check_out.': 11.00AM'}}
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Guest Details</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                            $pax = json_decode($package->pax);
                                            ?>

                                            <table class="table">
                                                @for($i=0; $i<$package->pax_number; $i++)
                                                        <?php
                                                        $passenger = DB::table('passengers')->where('id',$pax[$i])->first();
                                                        ?>
                                                    <tr>
                                                        <th>Guest {{$i +1}}</th>
                                                        <td>{{$passenger->f_name.' '.$passenger->l_name}}</td>
                                                    </tr>
                                                @endfor
                                            </table>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Payments Details</b></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td rowspan="6">
                                                        <div>
                                                            <p><b>Payment Type: </b>{{$package->p_type}}</p>
                                                            <div><b>Payment Details:</b><br> {!! nl2br(json_decode(@$package->p_details)) !!}</div>
                                                        </div>
                                                    </td>
                                                    <td align="right">Ticket Price</td>
                                                    <td  align="right">{{$package->c_price.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right" >VAT</td>
                                                    <td  align="right">{{$package->vat.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">AIT</td>
                                                    <td  align="right">{{$package->ait.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: purple;">Grand Total</b></td>
                                                    <td  align="right"><b style="color: purple;">{{$package->c_price + $package->vat + $package->ait.'/-'}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Due Amount</td>
                                                    <td  align="right">{{$package->due_amount.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: red;">Amount need to be paid</b></td>
                                                    <td  align="right"><b style="color: red;">{{$package->c_price + $package->vat + $package->ait - $package->due_amount.'/-'}}</b></td>
                                                </tr>
                                            </table>
                                            @if(@$package->p_details)
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>
                                                            <div style="position: relative; text-align: center; color: black;">
                                                                <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                                <div style="position: absolute; bottom: 15px;"><b>Hotel Details</b></div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                </table>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>
                                                            {!! nl2br(json_decode($package->h_details)) !!}
                                                        </td>
                                                    </tr>
                                                </table>
                                            @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-warning float-right printMe">Print Invoice</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $('.printMe').click(function(){
            var divToPrint=document.getElementById("printArea");
            newWin= window.open('');
            newWin.document.write('<link href="{{url('/public/dist/css/adminlte.min.css')}}" rel="stylesheet" type="text/css" />');
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();
        });

    </script>
@endsection

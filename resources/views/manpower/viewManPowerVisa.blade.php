@extends('mainLayout.layout')
@section('title','Trip Designer || Work Permit Visa Processing')
@section('newManPowerPackage','active')
@section('manPowerPackage','active')
@section('manPowerMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Work Permit Visa Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Work Permit Visa Management</li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title"> Work Permit Visa Invoice</h3>
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
                                                <h4><b>Work Permit Visa Invoice</b></h4>
                                            </div>
                                            <table class="table">
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
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Work Permit Visa Application Details</b></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-bordered">
                                                <tr>
                                                    <td><b>Invoice No.</b></td>
                                                    <td>{{'WP-'.$visa->id}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Booking Date</b></td>
                                                    <td>{{$visa->date}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Visa Country</b></td>
                                                    <td>{{$visa->visa_country}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Visa Service Details</b></td>
                                                    <td>{{$visa->v_details}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Guest Details</b></td>
                                                    <?php
                                                    $p = json_decode($visa->p_details);
                                                    $j = 1;
                                                    ?>
                                                    <td>
                                                        @foreach($p as $pas)
                                                                <?php
                                                                $name = DB::table('passengers')
                                                                    ->where('id',$pas)
                                                                    ->where('upload_by',Session::get('user_id'))
                                                                    ->first();
                                                                ?>
                                                            <div>{{$j.'. Name: '.$name->f_name.' '.$name->l_name}}</div>
                                                            <div>{{$j.'. Passport No: '.$name->p_number}}</div><hr>
                                                            @php
                                                                $j++;
                                                            @endphp
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Work Permit Details Details</b></div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <div>
                                                            {!! nl2br(json_decode(@$visa->w_details)) !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
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
                                                            <p><b>Payment Type: </b>{{$visa->v_p_type}}</p>
                                                            <div><b>Payment Details:</b><br> {!! nl2br($visa->v_p_details) !!}</div>
                                                        </div>
                                                    </td>
                                                    <td align="right">Visa Price</td>
                                                    <td  align="right">{{$visa->v_c_price.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right" >VAT</td>
                                                    <td  align="right">{{$visa->v_vat.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">AIT</td>
                                                    <td  align="right">{{$visa->v_ait.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: purple;">Grand Total</b></td>
                                                    <td  align="right"><b style="color: purple;">{{$visa->v_c_price + $visa->v_vat + $visa->v_ait.'/-'}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Due Amount</td>
                                                    <td  align="right">{{$visa->v_due.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: red;">Total Paid Amount</b></td>
                                                    <td  align="right"><b style="color: red;">{{$visa->v_c_price + $visa->v_vat + $visa->v_ait - $visa->v_due.'/-'}}</b></td>
                                                </tr>
                                            </table>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{url('printVisaInvoice?id='.$visa->id)}}" target="_blank" class="btn btn-warning float-right printMe">Print Invoice</a>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
@endsection

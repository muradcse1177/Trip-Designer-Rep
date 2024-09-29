@extends('mainLayout.layout')
@section('title','Trip Designer || Tour Management')
@section('tourPackage','active')
@section('tourMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tour Package Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Tour Package Management</li>
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
                                <h3 class="card-title">Tour Package</h3>
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
                                                <h4><b>Tour Package Invoice</b></h4>
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
                                                            <div style="position: absolute; bottom: 15px;"><b>{{$package->title.' '.'(Starting From -'.$package->start_date.')'}}</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table">
                                                <tr>
                                                    <td>
                                                        Package Covered
                                                    </td>
                                                    <td>
                                                        {{$package->p_cover}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        Package Duration
                                                    </td>
                                                    <td>
                                                        {{$package->start_date .' '. 'to'.' '.$package->end_date}}
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
                                            $pax = json_decode($package->traveler);
                                            ?>

                                            <table class="table">
                                                @for($i=0; $i<$package->g_details; $i++)
                                                        <?php
                                                        $passenger = DB::table('passengers')->where('id',$pax[$i])->first();
                                                        ?>
                                                    <tr>
                                                        <th>Name</th>
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
                                                            <p><b>Payment Type: </b>{{$package->payment_type}}</p>
                                                            <div><b>Payment Details:</b><br> {!! nl2br($package->pay_details) !!}</div>
                                                        </div>
                                                    </td>
                                                    <td align="right">Ticket Price</td>
                                                    <td  align="right">{{$package->p_c_details.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right" >VAT</td>
                                                    <td  align="right">{{$package->p_vat.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right">AIT</td>
                                                    <td  align="right">{{$package->p_ait.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: purple;">Grand Total</b></td>
                                                    <td  align="right"><b style="color: purple;">{{$package->p_c_details + $package->p_vat + $package->p_ait.'/-'}}</b></td>
                                                </tr>
                                                <tr>
                                                    <td align="right">Due Amount</td>
                                                    <td  align="right">{{$package->due.'/-'}}</td>
                                                </tr>
                                                <tr>
                                                    <td align="right"><b style="color: red;">Amount need to be paid</b></td>
                                                    <td  align="right"><b style="color: red;">{{$package->p_c_details + $package->p_vat + $package->p_ait - $package->due.'/-'}}</b></td>
                                                </tr>
                                            </table>
                                            @if(@$package->p_details)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Package Details</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        {!! nl2br($package->p_details) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                            @endif
                                            @if(@$package->p_inclusions)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Package Inclusions</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        {!! nl2br($package->p_inclusions) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                            @endif
                                            @if(@$package->p_exclusions)
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        <div style="position: relative; text-align: center; color: black;">
                                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                            <div style="position: absolute; bottom: 15px;"><b>Package Exclusions</b></div>
                                                        </div>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table class="table table-borderless">
                                                <tr>
                                                    <td>
                                                        {!! nl2br($package->p_exclusions) !!}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                        @if(@$package->p_tnt)
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Package Terms and Conditions</b></div>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    {!! nl2br($package->p_tnt) !!}
                                                </td>
                                            </tr>
                                        </table>
                                        @endif
                                        @if(@$package->p_policy)
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    <div style="position: relative; text-align: center; color: black;">
                                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                                        <div style="position: absolute; bottom: 15px;"><b>Package Policy</b></div>
                                                    </div>

                                                </td>
                                            </tr>
                                        </table>
                                        <table class="table table-borderless">
                                            <tr>
                                                <td>
                                                    {!! nl2br($package->p_policy) !!}
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

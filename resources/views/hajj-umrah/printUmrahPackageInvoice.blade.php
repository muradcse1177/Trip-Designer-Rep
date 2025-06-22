<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->

    <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
</head>
<body>
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div id="printArea" style="margin-top: 50px; margin-left: 50px; margin-right: 50px; margin-bottom: 50px;">
                    <font size="3" face="Century Gothic" >
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
                                        <div style="position: absolute; bottom: 15px;"><b>Package Details</b></div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-bordered">
                            <tr>
                                <td>
                                    <b>Package Name</b>
                                </td>
                                <td>
                                    {{$package->title}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Package Code</b>
                                </td>
                                <td>
                                    {{$package->p_code}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Package Duration</b>
                                </td>
                                <td>
                                    {{$package->start_date .' '. 'to'.' '.$package->end_date}}
                                </td>
                            </tr>
                        </table>
                        <table class="table ">
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

                        <table class="table table-bordered">
                            @for($i=0; $i<$package->g_details; $i++)
                                    <?php
                                    $passenger = DB::table('passengers')->where('id',$pax[$i])->first();
                                    ?>
                                <tr>
                                    <th>Guest {{$i+1}}</th>
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
                        <table class="table table-bordered">
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
                                <td align="right"><b style="color: red;">Total Paid Amount</b></td>
                                <td  align="right"><b style="color: red;">{{$package->p_c_details + $package->p_vat + $package->p_ait - $package->due.'/-'}}</b></td>
                            </tr>
                        </table>
                        @if(@$package->highlights)
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <div style="position: relative; text-align: center; color: black;">
                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                            <div style="position: absolute; bottom: 15px;"><b>Package Highlights</b></div>
                                        </div>

                                    </td>
                                </tr>
                            </table>
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        {!! nl2br(json_decode($package->highlights)) !!}
                                    </td>
                                </tr>
                            </table>
                        @endif
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Day Wise Itinerary</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <?php
                        $i =0;
                        $d_titles = json_decode($package->day_title);
                        $d_ininaris = json_decode($package->dat_itinary);
                        ?>
                        <table class="table table-bordered">
                            @foreach($d_titles as $d_title)
                                <tr>
                                    <td>
                                        Day {{$i +1}} {{$d_titles[$i]}}
                                    </td>
                                    <td>
                                            <?php
                                            $output = '<ul style="list-style-type: disc !important; adding-left:1em !important; margin-left:1em;">';
                                            $listformat = explode("\n", $d_ininaris[$i]);
                                            foreach ($listformat as $test => $line) {
                                                $output .= "<li>".$line."</li>";
                                            };
                                            $output .='</ul>';
                                            ?>
                                        {!! $output !!}
                                    </td>
                                </tr>
                                    <?php $i++; ?>
                            @endforeach
                        </table>
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
                                        {!! nl2br(json_decode($package->p_inclusions)) !!}
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
                                        {!! nl2br(json_decode($package->p_exclusions)) !!}
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
                                        {!! nl2br(json_decode($package->p_tnt)) !!}
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
                                        {!! nl2br(json_decode($package->p_policy)) !!}
                                    </td>
                                </tr>
                            </table>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
    window.addEventListener("load", window.print());
</script>
</body>
</html>

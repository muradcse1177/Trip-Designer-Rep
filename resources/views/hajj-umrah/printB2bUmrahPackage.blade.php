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
                            <h4><b>Tour Package Details</b></h4>
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
                                    {{$package->p_name}}
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
                                    <b>Fare Details</b>
                                </td>
                                <td>
                                    Adult Fare: {{$package->p_p_adult*$adult}} BDT
                                    @if($child>0)
                                        <br>
                                        Child Fare: {{$package->p_p_child*$child}} BDT
                                    @endif
                                    @if($infant>0)
                                        <br>
                                        Infant Fare: {{$package->p_p_infant*$infant}} BDT
                                    @endif
                                </td>
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
                        $d_titles = json_decode($package->title);
                        $d_ininaris = json_decode($package->itinary);
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
                        @if(@$package->inclusion)
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
                                        {!! nl2br(json_decode($package->inclusion)) !!}
                                    </td>
                                </tr>
                            </table>
                        @endif
                        @if(@$package->exclusion)
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
                                        {!! nl2br(json_decode($package->exclusion)) !!}
                                    </td>
                                </tr>
                            </table>
                        @endif
                        @if(@$package->tnt)
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
                                        {!! nl2br(json_decode($package->tnt)) !!}
                                    </td>
                                </tr>
                            </table>
                        @endif
                        @if(@$package->policy)
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
                                        {!! nl2br(json_decode($package->policy)) !!}
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

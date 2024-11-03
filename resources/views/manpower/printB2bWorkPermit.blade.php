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
                    <font size="3" face="Century Gothic" ></font>
                    <div class="col-12 d-flex justify-content-center">
                        <h4><b>Work Permit Visa Details</b></h4>
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
                                    <div style="position: absolute; bottom: 15px;"><b>Visa Details</b></div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <b>Visa Country</b>
                            </td>
                            <td>
                                {{$package->country}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Visa Name</b>
                            </td>
                            <td>
                                {{$package->country}} Work Permit Visa
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Accommodation</b>
                            </td>
                            <td>
                                {{$package->accommodation}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Contact Period</b>
                            </td>
                            <td>
                                {{$package->period}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Salary (Approximate)</b>
                            </td>
                            <td>
                                {{$package->salary}}
                            </td>
                        </tr>
                    </table>
                    @if(@$package->requirements)
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Requirements</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    {!! nl2br(json_decode($package->requirements)) !!}
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if(@$package->responsibilities)
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Responsibilities</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    {!! nl2br(json_decode($package->responsibilities)) !!}
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if(@$package->p_time)
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Process Time</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    {!! nl2br(json_decode($package->p_time)) !!}
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if(@$package->p_method)
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Payment Method</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    {!! nl2br(json_decode($package->p_method)) !!}
                                </td>
                            </tr>
                        </table>
                    @endif
                    @if(@$package->r_policy)
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    <div style="position: relative; text-align: center; color: black;">
                                        <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                        <div style="position: absolute; bottom: 15px;"><b>Refund Policy</b></div>
                                    </div>

                                </td>
                            </tr>
                        </table>
                        <table class="table table-borderless">
                            <tr>
                                <td>
                                    {!! nl2br(json_decode($package->r_policy)) !!}
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
                                        <div style="position: absolute; bottom: 15px;"><b>Exclusion</b></div>
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

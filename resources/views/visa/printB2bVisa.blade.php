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
                            <h4><b>Visa Details</b></h4>
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
                                    {{$package->title}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Fare Details</b>
                                </td>
                                <td>
                                    <b>Adult Fare: {{$package->a_price*$adult}} BDT</b>
                                    @if($child>0)
                                        <br>
                                        <b>Child Fare: {{$package->c_price*$child}} BDT</b>
                                    @endif
                                </td>
                            </tr>
                        </table>
                        @if(@$package->requirements)
                            <table class="table table-borderless">
                                <tr>
                                    <td>
                                        <div style="position: relative; text-align: center; color: black;">
                                            <img src="{{url('public/ssss.png')}}" style="margin-left: -15px;" height="50" width="103%">
                                            <div style="position: absolute; bottom: 15px;"><b>Visa Requirements</b></div>
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

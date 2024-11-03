@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('mainDashboard','active')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid"></br>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-warning card-tabs" style="">
                            <div class="card-header p-0 pt-1">
                                <?php
                                if($type == 'f_tour'){
                                    $ni_t = 'menu-is-opening menu-open';
                                    $nl_t = 'active';
                                    $tp_t = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'f_visa'){
                                    $ni_v = 'menu-is-opening menu-open';
                                    $nl_v = 'active';
                                    $tp_v = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'f_permit'){
                                    $ni_p = 'menu-is-opening menu-open';
                                    $nl_p = 'active';
                                    $tp_p = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'f_umrah'){
                                    $ni_u = 'menu-is-opening menu-open';
                                    $nl_u = 'active';
                                    $tp_u = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'f_edu'){
                                    $ni_e = 'menu-is-opening menu-open';
                                    $nl_e = 'active';
                                    $tp_e = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'f_service'){
                                    $ni_s = 'menu-is-opening menu-open';
                                    $nl_s = 'active';
                                    $tp_s = 'show active';

                                    $ni_m = '';
                                    $nl_m = ' ';
                                }
                                if($type == 'main'){
                                    $ni_m = 'menu-is-opening menu-open';
                                    $nl_m = 'active';
                                    $tp_t = 'show active';
                                }
                                ?>
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item <?php echo  @$ni_t.''. @$ni_m; ?> ">
                                        <a class="nav-link <?php echo @$nl_t .''. @$nl_m; ?>" id="tour-package" data-toggle="pill" href="#custom-tabs-one-tour-package" role="tab" aria-controls="custom-tabs-one-tour-package" aria-selected="true">Tour Package</a>
                                    </li>
                                    <li class="nav-item <?php echo @$ni_m; ?>">
                                        <a class="nav-link <?php echo @$nl_v; ?>" id="visa" data-toggle="pill" href="#custom-tabs-one-visa" role="tab" aria-controls="custom-tabs-one-visa" aria-selected="false">Visa</a>
                                    </li>
                                    <li class="nav-item <?php echo @$ni_p; ?>">
                                        <a class="nav-link <?php echo @$nl_p; ?>" id="work-permit" data-toggle="pill" href="#custom-tabs-one-work-permit" role="tab" aria-controls="custom-tabs-one-work-permit" aria-selected="false">Work Permit</a>
                                    </li>
                                    <li class="nav-item <?php echo @$nl_u; ?>">
                                        <a class="nav-link <?php echo @$nl_u; ?>" id="hajj-urmah" data-toggle="pill" href="#custom-tabs-one-hajj-umrah" role="tab" aria-controls="custom-tabs-one-hajj-umrah" aria-selected="false">Hajj & Umrah</a>
                                    </li>
                                    <li class="nav-item <?php echo @$ni_e; ?>">
                                        <a class="nav-link <?php echo @$nl_e; ?>" id="education" data-toggle="pill" href="#custom-tabs-one-education" role="tab" aria-controls="custom-tabs-one-education" aria-selected="false">Education</a>
                                    </li>
                                    <li class="nav-item <?php echo @$ni_s; ?>">
                                        <a class="nav-link <?php echo @$nl_s; ?>" id="service" data-toggle="pill" href="#custom-tabs-one-service" role="tab" aria-controls="custom-tabs-one-service" aria-selected="false">Services</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade <?php echo @$tp_t; ?>" id="custom-tabs-one-tour-package" role="tabpanel" aria-labelledby="custom-tabs-one-tour-package"><br>
                                        {{ Form::open(array('url' => 'search-tour-package-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="" id="c_name" style="width: 100%;" required>
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="country" style="width: 100%;" required>
                                                        @foreach($t_country as $country)
                                                            <option value="{{$country->name}}" <?php if(@$_GET['country'] == $country->name) echo 'selected'; ?> >{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Check-In & Check-Out" name="checkinout" id="checkinout" readonly="readonly" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="type" value="f_tour">
                                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-search"></i> Search</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="tab-pane fade <?php echo @$tp_v; ?>" id="custom-tabs-one-visa" role="tabpanel" aria-labelledby="custom-tabs-one-visa"><br>
                                        {{ Form::open(array('url' => 'search-visa-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="" id="c_name" style="width: 100%;" required>
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="country" style="width: 100%;" required>
                                                        @foreach($v_country as $coun)
                                                            <option value="{{$coun->name}}" <?php if(@$_GET['country'] == $coun->name) echo 'selected'; ?>>{{$coun->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="type" value="f_visa">
                                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-search"></i>   Search</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="tab-pane fade <?php echo @$tp_p; ?>" id="custom-tabs-one-work-permit" role="tabpanel" aria-labelledby="custom-tabs-one-work-permit"><br>
                                        {{ Form::open(array('url' => 'search-manpower-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="" id="c_name" style="width: 100%;" required>
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="country" style="width: 100%;" required>
                                                        <option value="">Select Country</option>
                                                        @foreach($m_country as $countt)
                                                            <option value="{{$countt->name}}" <?php if(@$permit->country == $countt->name) echo 'selected'; ?>>{{$countt->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="type" value="f_permit">
                                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-search"></i>   Search</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                        <hr>
                                        <br>
                                        <div class="card">
                                            <div class="card-header" style="background-color: #D9E0FF;">
                                                <h5 style="text-align:center; color: #00000;"><b> {{$permit->country}} Work Permit Service from Bangladesh</b> </h5>
                                                <center><span style="color: #00000;""> {{$c_info->name}} Authorized Visa Submitting Agents of Embassy in Dhaka, Bangladesh </span></center>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>{{$permit->country}} Job Category</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <?php
                                                            $output = '<ul style="list-style-type: disc !important; adding-left:1em !important;">';
                                                            $listformat = explode("\n", json_decode($permit->requirements));
                                                            foreach ($listformat as $test => $line) {
                                                                $output .= "<li>".$line."</li>";
                                                            };
                                                            $output .='</ul>';
                                                            ?>
                                                            {!! $output !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Job Responsibilities</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <?php
                                                            $output = '<ul style="list-style-type: disc !important; adding-left:1em !important;">';
                                                            $listformat = explode("\n", json_decode($permit->responsibilities));
                                                            foreach ($listformat as $test => $line) {
                                                                $output .= "<li>".$line."</li>";
                                                            };
                                                            $output .='</ul>';
                                                            ?>
                                                            {!! $output !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Process Time</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! nl2br(json_decode($permit->p_time)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Payment Method</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! nl2br(json_decode($permit->p_method)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Refund Policy</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! nl2br(json_decode($permit->r_policy)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Exclusion</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! nl2br(json_decode($permit->exclusion)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(json_decode($permit->tnt) !=null)
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="fs-5"><b>Terms and Conditions</b></h4>
                                                        </div>
                                                        <div class="card-body">
                                                            {!! nl2br(json_decode($permit->tnt)) !!}
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <p class="font10 lh-1 mb-0"><b>For Booking Please Contact Us: </b></p><hr>
                                                        <p class="font10 lh-1 mb-0"><b>Phone: </b> {{$c_info->phone1}}</p><hr>
                                                        <p class="font10 lh-1 mb-0"><b>Email: </b>{{$c_info->email}}</p>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <a href="{{url('download-work-permit/'.$permit->slug)}}" type="button" class="btn btn-block btn-warning">Download</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade <?php echo @$tp_u; ?>" id="custom-tabs-one-hajj-umrah" role="tabpanel" aria-labelledby="custom-tabs-one-hajj-umrah"><br>
                                        {{ Form::open(array('url' => 'search-hajj-umrah-package-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="" id="c_name" style="width: 100%;" required>
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="h_type" id="type" style="width: 100%;" required>
                                                        <option value="">Select Country</option>
                                                        <option value="Umrah" <?php if(@$_GET['h_type'] == 'Umrah') echo 'selected'; ?>>Umrah</option>
                                                        <option value="Hajj" <?php if(@$_GET['h_type'] == 'Hajj') echo 'selected'; ?>>Hajj</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="type" value="f_umrah">
                                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-search"></i>   Search</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                        <hr>
                                        <br>
                                    </div>
                                    <div class="tab-pane fade <?php echo @$tp_e; ?>" id="custom-tabs-one-education" role="tabpanel" aria-labelledby="custom-tabs-one-education"><br>
                                        Work on going...
                                    </div>
                                    <div class="tab-pane fade <?php echo @$tp_s; ?>" id="custom-tabs-one-service" role="tabpanel" aria-labelledby="custom-tabs-one-service"><br>
                                        {{ Form::open(array('url' => 'service-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="" id="" style="width: 100%;" required>
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select class="form-control select2bs4" name="name" style="width: 100%;" required>
                                                        @foreach($services as $servi)
                                                            <option value="{{$servi->name}}" <?php if(@$_GET['name'] == $servi->name) echo 'selected'; ?>>{{$servi->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="hidden" name="type" value="f_service">
                                                <button type="submit" class="btn btn-block btn-warning"><i class="fa fa-search"></i>   Search</button>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                        <hr>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $('#checkinout').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
    </script>
@endsection

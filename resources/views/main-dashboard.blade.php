@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('mainDashboard','active')
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
                                        <div class="alert" style="background-color: #D9E0FF;">
                                            <h5 style="text-align: center; color: black;">Hot & Trending Tour Packages</h5>
                                        </div>
                                        <div class="row">
                                            @foreach($t_package as $package)
                                            <div class="col-md-4">
                                                <a href="{{url('tour-package-b2b/'.$package->slug)}}">
                                                <!-- Widget: user widget style 2 -->
                                                    <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header">
                                                            <img src="{{url($package->p_c_photo)}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item" >
                                                                    <a href="#" class="nav-link" >
                                                                        @if(@$include[0] = 'Hotel')
                                                                            <span class="float-left badge" style="margin-right: 20px; background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-hotel"></i></div>
                                                                                <div class="actv-wrap-caps">Hotel</div>
                                                                            </span>
                                                                        @endif
                                                                        @if(@$include[1] = 'SightSeeing')
                                                                            <span class="float-left badge" style="margin-right: 20px;background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-umbrella-beach"></i></div>
                                                                                <div class="actv-wrap-caps">SightSeeing</div>
                                                                            </span>
                                                                        @endif
                                                                        @if(@$include[2] = 'Transfer')
                                                                            <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-train"></i></div>
                                                                                <div class="actv-wrap-caps">Transfer</div>
                                                                            </span>
                                                                        @endif
                                                                        @if(@$include[3] = 'Meal')
                                                                            <span class="float-right badge" style="background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-hamburger"></i></div>
                                                                                <div class="actv-wrap-caps">Meal</div>
                                                                            </span>
                                                                        @endif
                                                                    </a><br><br>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <b>{{substr($package->p_name,'0',30).'..'}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        {{$package->night}}</span> Night {{$package->night +1}} Days<span class="float-right badge bg-success">{{$package->p_p_adult}} {{$c_info->symbol}}</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
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
                                        <div class="alert" style="background-color: #D9E0FF;">
                                            <h5 style="text-align: center; color: black;">Best Visa Service From Bangladesh</h5>
                                        </div>
                                        <div class="row">
                                            @foreach($visas as $visa)
                                                <div class="col-md-4">
                                                    <!-- Widget: user widget style 2 -->
                                                    <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header">
                                                            <img src="{{url($visa->v_c_photo)}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <b>{{$visa->country}} Visa</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <a type="button" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Requirements</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
                                                            <option value="{{$countt->name}}" <?php if(@$_GET['country'] == $countt->name) echo 'selected'; ?>>{{$countt->name}}</option>
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
                                        <div class="alert" style="background-color: #D9E0FF;">
                                            <h5 style="text-align: center; color: black;">Best Work Permit Visa Service From Bangladesh</h5>
                                        </div>
                                        <div class="row">
                                            @foreach($permits as $permit)
                                                <div class="col-md-4">
                                                    <!-- Widget: user widget style 2 -->
                                                    <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header">
                                                            <img src="{{url($permit->c_photo)}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <b>{{$permit->country}} Work Permit Visa</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <a type="button" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
                                        <div class="alert" style="background-color: #D9E0FF;">
                                            <h5 style="text-align: center; color: black;">Hot & Trending Hajj & Umrah Packages</h5>
                                        </div>
                                        <div class="row">
                                            @foreach($u_package as $pack)
                                                <div class="col-md-4">
                                                    <!-- Widget: user widget style 2 -->
                                                    <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header">
                                                            <img src="{{url($pack->p_c_photo)}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item" >
                                                                    <a href="#" class="nav-link" >
                                                                        @if(@$include[0] = 'Hotel')
                                                                            <span class="float-left badge" style="margin-right: 6px; background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-hotel"></i></div>
                                                                            <div class="actv-wrap-caps">Hotel</div>
                                                                        </span>
                                                                        @endif
                                                                        @if(@$include[1] = 'SightSeeing')
                                                                            <span class="float-left badge" style="margin-right: 6px;background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-umbrella-beach"></i></div>
                                                                            <div class="actv-wrap-caps">Sight</div>
                                                                        </span>
                                                                        @endif
                                                                        @if(@$include[2] = 'Transfer')
                                                                            <span class="float-left badge" style="margin-right: 6px; background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-train"></i></div>
                                                                            <div class="actv-wrap-caps">Transfer</div>
                                                                        </span>
                                                                        @endif
                                                                        @if(@$include[3] = 'Meal')
                                                                            <span class="float-left badge" style="margin-right: 6px; background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-hamburger"></i></div>
                                                                            <div class="actv-wrap-caps">Meal</div>
                                                                        </span>
                                                                        @endif
                                                                        @if(@$include[4] = 'Visa')
                                                                            <span class="float-left badge" style="margin-right: 6px; background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-passport"></i></div>
                                                                            <div class="actv-wrap-caps">Visa</div>
                                                                        </span>
                                                                        @endif
                                                                        @if(@$include[5] = 'Flight')
                                                                            <span class="float-right badge" style="background-color: #04107C; color:white;">
                                                                            <div class="actv-wrap-ico"><i class="fa fa-plane"></i></div>
                                                                            <div class="actv-wrap-caps">Flight</div>
                                                                        </span>
                                                                        @endif
                                                                    </a><br><br>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <b>{{substr($pack->p_name,'0',30).'..'}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        {{$pack->night}}</span> Night {{$pack->night +1}} Days<span class="float-right badge bg-success">{{$pack->p_p_adult}} {{$c_info->symbol}}</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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
                                        <div class="alert" style="background-color: #D9E0FF;">
                                            <h5 style="text-align: center; color: black;">Highest Profit Gaining Services</h5>
                                        </div>
                                        <div class="row">
                                            @foreach($services as $servi)
                                                <div class="col-md-4">
                                                    <!-- Widget: user widget style 2 -->
                                                    <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                                        <div class="widget-user-header">
                                                            <img src="{{url($servi->c_photo)}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                <li class="nav-item">
                                                                    <a href="#" class="nav-link">
                                                                        <b>{{$servi->name}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <a type="button" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Details</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
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

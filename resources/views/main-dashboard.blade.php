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
                                   $useragent=$_SERVER['HTTP_USER_AGENT'];
                                   if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                                       $a = 'a';
                                   else
                                       $a = 'b';
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
                                                            <img src="{{@$domain.'/'.$package->p_c_photo}}" class="img-fluid" alt="" style="object-fit: cover; width: 100%; border-radius: 10px">
                                                        </div>
                                                        <div class="card-footer p-0">
                                                            <ul class="nav flex-column">
                                                                @if($a == 'b')
                                                                <li class="nav-item" >
                                                                    <a href="#" class="nav-link" >
                                                                        <div class="row">
                                                                            <div class="col-sm-3">
                                                                                @if(@$include[0] = 'Hotel')
                                                                                    <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-hotel"></i></div>
                                                                                        <div class="actv-wrap-caps">Hotel</div>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                @if(@$include[1] = 'SightSeeing')
                                                                                    <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-umbrella-beach"></i></div>
                                                                                <div class="actv-wrap-caps">SightSeeing</div>
                                                                            </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                @if(@$include[2] = 'Transfer')
                                                                                    <span class="float-right badge" style="background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-train"></i></div>
                                                                                <div class="actv-wrap-caps">Transfer</div>
                                                                            </span>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-sm-3">
                                                                                @if(@$include[3] = 'Meal')
                                                                                    <span class="float-right badge" style="background-color: #04107C; color:white;">
                                                                                <div class="actv-wrap-ico"><i class="fa fa-hamburger"></i></div>
                                                                                <div class="actv-wrap-caps">Meal</div>
                                                                            </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                <li class="nav-item">
                                                                    <a href="{{url('tour-package-b2b/'.$package->slug)}}" class="nav-link">
                                                                        <b>{{substr($package->p_name,'0',30).'..'}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a href="{{url('tour-package-b2b/'.$package->slug)}}" class="nav-link">
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
                                                    <a href="{{url('visa-b2b/'.$visa->slug)}}">
                                                        <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header">
                                                                <img src="{{@$domain.'/'.$visa->v_c_photo}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                            </div>
                                                            <div class="card-footer p-0">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item">
                                                                        <a href="#" class="nav-link">
                                                                            <b>{{$visa->country}} Visa</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a href="#" class="nav-link">
                                                                            <b>Price</b> <span class="float-right badge bg-info">{{$visa->a_price}} {{$c_info->symbol}}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <a type="button" href="{{url('visa-b2b/'.$visa->slug)}}" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Requirements</a>
                                                            </div>
                                                        </div>
                                                    </a>
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
                                                    <a href="{{url('manpower-b2b/'.$permit->slug)}}">
                                                        <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header">
                                                                <img src="{{@$domain.'/'.$permit->c_photo}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                            </div>
                                                            <div class="card-footer p-0">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item">
                                                                        <a href="#" class="nav-link">
                                                                            <b>{{$permit->country}} Work Permit Visa</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <a type="button" href="{{url('manpower-b2b/'.$permit->slug)}}" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Details</a>
                                                            </div>
                                                        </div>
                                                    </a>
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
                                                    <a href="{{url('hajj-umrah-b2b/'.$pack->slug)}}">
                                                        <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header">
                                                                <img src="{{@$domain.'/'.$pack->p_c_photo}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                            </div>
                                                            <div class="card-footer p-0">
                                                                <ul class="nav flex-column">
                                                                    @if($a == 'b')
                                                                    <li class="nav-item" >
                                                                        <a href="#" class="nav-link" >
                                                                            <div class="row">
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[0] = 'Hotel')
                                                                                        <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-hotel"></i></div>
                                                                                        <div class="actv-wrap-caps">Hotel</div>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[1] = 'SightSeeing')
                                                                                        <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-umbrella-beach"></i></div>
                                                                                        <div class="actv-wrap-caps">Sight</div>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[2] = 'Transfer')
                                                                                        <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-train"></i></div>
                                                                                        <div class="actv-wrap-caps">Trans.</div>
                                                                                    </span>
                                                                                   @endif
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[3] = 'Meal')
                                                                                        <span class="float-left badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-hamburger"></i></div>
                                                                                        <div class="actv-wrap-caps">Meal</div>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[4] = 'Visa')
                                                                                        <span class="float-left badge" style="margin-right: 10%; background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-passport"></i></div>
                                                                                        <div class="actv-wrap-caps">Visa</div>
                                                                                    </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-sm-2">
                                                                                    @if(@$include[5] = 'Flight')
                                                                                        <span class="float-right badge" style="background-color: #04107C; color:white;">
                                                                                        <div class="actv-wrap-ico"><i class="fa fa-plane"></i></div>
                                                                                        <div class="actv-wrap-caps">Flight</div>
                                                                                    </span>
                                                                                   @endif
                                                                                </div>
                                                                            </div>
                                                                        </a><br><br>
                                                                    </li>
                                                                    @endif
                                                                    <li class="nav-item">
                                                                        <a href="{{url('hajj-umrah-b2b/'.$pack->slug)}}" class="nav-link">
                                                                            <b>{{substr($pack->p_name,'0',30).'..'}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="nav-item">
                                                                        <a href="{{url('hajj-umrah-b2b/'.$pack->slug)}}" class="nav-link">
                                                                            {{$pack->night}}</span> Night {{$pack->night +1}} Days<span class="float-right badge bg-success">{{$pack->p_p_adult}} {{$c_info->symbol}}</span>
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
                                                    <a href="{{url('service-b2b/'.$servi->slug)}}">
                                                        <div class="card card-widget widget-user-2 shadow-sm" style="border-radius: 10px; border-style: dotted;">
                                                            <!-- Add the bg color to the header using any of the bg-* classes -->
                                                            <div class="widget-user-header">
                                                                <img src="{{@$domain.'/'.$servi->c_photo}}" class="img-fluid" alt="" style="object-fit: cover;width: 100%; border-radius: 10px">
                                                            </div>
                                                            <div class="card-footer p-0">
                                                                <ul class="nav flex-column">
                                                                    <li class="nav-item">
                                                                        <a href="{{url('service-b2b/'.$servi->slug)}}" class="nav-link">
                                                                            <b>{{$servi->name}}</b> <span class="float-right badge bg-info">*{{floatval(rand(4,5))}}</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <a type="button" href="{{url('service-b2b/'.$servi->slug)}}" class="btn btn-block btn-default" style="background-color: #D9E0FF; color: #04107C;">View Details</a>
                                                            </div>
                                                        </div>
                                                    </a>
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

@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('mainDashboard','active')
@section('css')
    <link rel="stylesheet" href="{{url('/public/plugins/ekko-lightbox/ekko-lightbox.css')}}">
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
                                        <?php
                                        $m_photo = json_decode($package->p_m_photo);
                                        $count= count($m_photo);
                                        $highlight = json_decode($package->highlights);
                                        $inclusion = json_decode($package->inclusion);
                                        $exclusion = json_decode($package->exclusion);
                                        $tnt = json_decode($package->tnt);
                                        ?>
                                        <div class="card">
                                            <div class="card-header" style="background-color: #D9E0FF;">
                                                <h5 style="text-align:; color: #00000;"><b>Package Name:</b>  {{$package->p_name}}</h5>
                                                <span style="color: #00000;""><b>Package Type:</b> {{$package->night +1 }} Days {{$package->night }} Nights </span>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php
                                                    for($i=0; $i<4; $i++) {?>
                                                        <div class="col-sm-3">
                                                            <a href="{{@$domain.'/'.@$m_photo[$i]}}" data-toggle="lightbox" data-title="{{$package->p_name}}" data-gallery="gallery">
                                                                <img src="{{@$domain.'/'.@$m_photo[$i]}}" class="img-fluid mb-2" alt="white sample" style="height: 170px; width: 100%; border-radius: 8px"/>
                                                            </a>
                                                        </div>
                                                    <?php }?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-warning card-tabs" style="">
                                            <div class="card-header p-0 pt-1">
                                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                                    <li class="nav-item menu-is-opening menu-open">
                                                        <a class="nav-link active" id="overview" data-toggle="pill" href="#custom-tabs-one-overview" role="tab" aria-controls="custom-tabs-one-overview" aria-selected="true">Overview</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="itinerary" data-toggle="pill" href="#custom-tabs-one-itinerary" role="tab" aria-controls="custom-tabs-one-itinerary" aria-selected="false">Itinerary</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content" id="custom-tabs-one-tabContent">
                                            <div class="tab-pane fade show active" id="custom-tabs-one-overview" role="tabpanel" aria-labelledby="custom-tabs-one-overview">
                                                <div class="row">
                                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><b>Tour Highlights </b></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    {!!  $highlight !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><b>Inclusions </b></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    {!!  $inclusion !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><b>Exclusions </b></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    {!!  $exclusion !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5><b>Terms and Conditions </b></h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    {!!  $tnt !!}
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                                <p class="font12 lh-1 mb-0">
                                                                    <span class="text-dark fs-3 fw-bold">
                                                                        <span style="font-size: 20px;"><b>{{$c_info->currency.' '}}{{$package->p_p_adult}}</b></span>
                                                                    </span>  Per Adult*</p><hr>
                                                                <p class="font12 lh-1 mb-0">
                                                                    <span class="text-dark fs-3 fw-bold">
                                                                        <span style="font-size: 12px;"><b>{{$c_info->currency.' '}}{{$package->p_p_child}}</b></span>
                                                                    </span>  Per Child*</p><br>
                                                                <button type="button" data-id="{{$package->slug}}" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-block btn-success delete">Book Now</button>
                                                                <button type="button" class="btn btn-block btn-warning">Send Inquiry</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                $i= 0;
                                                $itinary = json_decode($package->itinary);
                                                $title = json_decode($package->title);
                                                $d = 'rounded-2';
                                            ?>
                                            <div class="tab-pane fade" id="custom-tabs-one-itinerary" role="tabpanel" aria-labelledby="custom-tabs-one-itinerary">
                                                <div class="row">
                                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                                        <!-- The time line -->
                                                        <div class="timeline">
                                                            <div class="time-label">
                                                                <span class="bg-success">Tour Start</span>
                                                            </div>
                                                            @for($i=0; $i<=$package->night; $i++)
                                                                <div>
                                                                    <i class="fas fa-bus bg-success"></i>
                                                                    <div class="timeline-item">
                                                                        <h3 class="timeline-header"><b>Day {{$i+1}}  :  {{$title[$i]}}</b></h3>

                                                                        <div class="timeline-body">
                                                                                <?php
                                                                                $output = '<ul style="list-style-type: disc !important; adding-left:1em !important; margin-left:1em;">';
                                                                                $listformat = explode("\n", $itinary[$i]);
                                                                                foreach ($listformat as $test => $line) {
                                                                                    $output .= "<li>".$line."</li>";
                                                                                };
                                                                                $output .='</ul>';
                                                                                ?>
                                                                            {!! $output !!}
                                                                        </div>
                                                                        <div class="timeline-footer">
                                                                            <a class="btn btn-danger btn-sm">Day End</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endfor
                                                            <div>
                                                                <i class="fas fa-clock bg-red"></i>
                                                            </div>
                                                        </div>
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
                                                                <p class="font12 lh-1 mb-0">
                                                                    <span class="text-dark fs-3 fw-bold">
                                                                        <span style="font-size: 20px;"><b>{{$c_info->currency.' '}}{{$package->p_p_adult}}</b></span>
                                                                    </span>  Per Adult*</p><hr>
                                                                <p class="font12 lh-1 mb-0">
                                                                    <span class="text-dark fs-3 fw-bold">
                                                                        <span style="font-size: 12px;"><b>{{$c_info->currency.' '}}{{$package->p_p_child}}</b></span>
                                                                    </span>  Per Child*</p><br>
                                                                <button  data-id="{{$package->slug}}" type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-block btn-success delete">Book Now</button>
                                                                <button  type="button" class="btn btn-block btn-warning">Send Inquiry</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Passengers Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'book-tour-package-page-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Adult Number (12 Years +)</label>
                                <input type="number" class="form-control" id="adult" value="2" name="adult" min="2" placeholder="Enter Adult Number" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Child Number (0-12 Years)</label>
                                <input type="number" class="form-control" id="child" value="0" name="child" min="0" placeholder="Enter Child Number" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="slug" class="id">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Update Fare</button>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{url('/public/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
    <script src="{{url('/public/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $('#checkinout').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true,
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endsection

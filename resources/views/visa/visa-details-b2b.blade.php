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
                                                            <option value="{{$coun->name}}" <?php if(@$visa->country == $coun->name) echo 'selected'; ?>>{{$coun->name}}</option>
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
                                        <div class="card">
                                            <div class="card-header" style="background-color: #D9E0FF;">
                                                <h5 style="text-align:center; color: #00000;"><b>  {{$visa->title}}</b> </h5>
                                                <center><span style="color: #00000;""> {{$c_info->name}} Authorized Visa Submitting Agents of Embassy in Dhaka, Bangladesh </span></center>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-8 col-lg-8 col-md-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Documents Required for {{$visa->country}} Tourist Visa </b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! json_decode(@$visa->requirements) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Price Details</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! json_decode(@$visa->price_details) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><b>Embassy Information</b></h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            {!! json_decode(@$visa->em_info) !!}
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
                                                                        <span style="font-size: 20px;"><b>{{$c_info->currency.' '}}{{$visa->a_price}}</b></span>
                                                                    </span>  Per Adult*</p><hr>
                                                        <p class="font12 lh-1 mb-0">
                                                                    <span class="text-dark fs-3 fw-bold">
                                                                        <span style="font-size: 12px;"><b>{{$c_info->currency.' '}}{{$visa->c_price}}</b></span>
                                                                    </span>  Per Child*</p><hr>
                                                        <button  data-id="{{$visa->slug}}" type="button" data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-block btn-success delete">Book Now</button>
                                                        <button type="button" data-id="{{$visa->slug}}" data-toggle="modal" data-target="#exampleModalCenter1" class="btn btn-block btn-warning delete">Download</button>
                                                    </div>
                                                </div>
                                            </div>
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
                    {{ Form::open(array('url' => 'book-visa-package-page-b2b',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Adult Number (12 Years +)</label>
                                <input type="number" class="form-control" id="adult" value="1" name="adult" min="1" placeholder="Enter Adult Number" required>
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
    <div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Passengers Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open(array('url' => 'download-b2b-visa-package',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Adult Number (12 Years +)</label>
                                <input type="number" class="form-control" id="adult" value="1" name="adult" min="1" placeholder="Enter Adult Number" required>
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
                    <button type="submit" class="btn btn-success">Download Now</button>
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
        $('#checkinout').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            }
        })
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
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

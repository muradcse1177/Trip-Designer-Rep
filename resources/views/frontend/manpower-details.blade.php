@extends('frontend.layout.body')
@section('title','Trip Designer - Manpower  - The Best Ticket, Visa, Manpower Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- ============================ Hero Banner  Start================================== -->
        <div class="py-5 bg-primary position-relative">
            <div class="container">
                <!-- Search Form -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="search-wrap position-relative my-3">
                            {{ Form::open(array('url' => 'search-manpower',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                            <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                <div class="col-xl-8 col-lg-7 col-md-12">
                                    <div class="row gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class=" form-control fw-bold">
                                                    <option value="Bangladesh" selected>Bangladesh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                        if(@$visa->country)
                                            $_GET['country'] = $visa->country;
                                        ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="goingto form-control fw-bold" name="country" required>
                                                    <option value="">Select Country</option>
                                                    @foreach($v_country as $country)
                                                        <option value="{{$country->name}}" <?php if($country->name == $_GET['country']) echo 'selected';  ?>>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-12">
                                    <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-whites text-primary full-width fw-medium"><i
                                                            class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ Hero Banner End ================================== -->

        <section class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-5">
                        <ul class="nav nav-pills primary nav-fill gap-2 p-2  bg-light-primary rounded-2" id="pillstour-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2 active" id="pills-overview-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview"
                                        aria-selected="true"><h4 style="color: white;">{{@$visa->country}} Manpower Service from Bangladesh </h4></button>
                                <p>{{$c_info->name}} Authorized Visa Submitting Agents of Embassy in Dhaka, Bangladesh</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-12">
                                <div class="tab-content" id="pillstour-tabContent">
                                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                                         aria-labelledby="pills-overview-tab" tabindex="0">
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">{{$_GET['country']}}  Job Category</h4>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $output = '<ul style="list-style-type: disc !important; adding-left:1em !important;">';
                                                    $listformat = explode("\n", json_decode($visa->requirements));
                                                    foreach ($listformat as $test => $line) {
                                                        $output .= "<li>".$line."</li>";
                                                    };
                                                    $output .='</ul>';
                                                    ?>
                                                    {!! $output !!}
                                                </div>
                                            </div>

                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Job Responsibilities</h4>
                                                </div>
                                                <div class="card-body">
                                                    <?php
                                                    $output = '<ul style="list-style-type: disc !important; adding-left:1em !important;">';
                                                    $listformat = explode("\n", json_decode($visa->responsibilities));
                                                    foreach ($listformat as $test => $line) {
                                                        $output .= "<li>".$line."</li>";
                                                    };
                                                    $output .='</ul>';
                                                    ?>
                                                    {!! $output !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Process Time</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($visa->p_time)) !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Payment Method</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($visa->p_method)) !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Refund Policy</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($visa->r_policy)) !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Exclusion</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($visa->exclusion)) !!}
                                                </div>
                                            </div>
                                            @if(json_decode($visa->tnt) !=null)
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Terms and Conditions</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($visa->tnt)) !!}
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="sides-block">
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <p class="font10 lh-1 mb-0"><b>Salary: </b> {{$visa->salary}}</p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Contact Period: </b>{{$visa->period}}</p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Accommodation: </b>{{$visa->accommodation}}</p>
                                        </div>
                                    </div>
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <p class="font10 lh-1 mb-0"><b>For Booking Please Contact Us: </b></p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Phone: </b> {{$c_info->phone1}}</p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Email: </b>{{$c_info->email}}</p>
                                        </div>
                                    </div>
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <button  data-bs-toggle="modal" data-bs-target="#tour-request" class="btn btn-sm btn-primary full-width fw-medium text-uppercase mb-2" type="button">proceed to book </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="row justify-content-center gy-3 gx-xl-3 gx-lg-4 gx-4">
                                    @foreach($visas as $visa)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="pop-touritem">
                                                <a href="{{url('manpower/'.$visa->slug)}}" class="card rounded-3 border br-dashed m-0">
                                                    <div class="flight-thumb-wrapper p-2 pb-0">
                                                        <div class="popFlights-item-overHidden rounded-3">
                                                            <img src="{{@$domain.'/'.$visa->c_photo}}" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="touritem-middle position-relative p-3">
                                                        <div class="touritem-flexxer">
                                                            <div class="explot">
                                                                <h4 class="city fs-6 m-0 fw-bold">
                                                                    <span>{{$visa->country}} Work Permit Visa</span>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="booking-wrapes d-flex align-items-center mt-3">
                                                            <button class="btn btn-md btn-light-primary fw-medium rounded full-width me-2">View Requirements</button>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="tour-request" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
            <div class="modal-content" id="loginmodal">
                <div class="modal-header">
                    <h4 class="modal-title fs-6">Request for Your Booking.</h4>
                    <a href="#" class="text-muted fs-4" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-square-xmark"></i></a>
                </div>
                <div class="modal-body">
                    <div class="modal-login-form py-4 px-md-3 px-0">
                        {{ Form::open(array('url' => 'order-request',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" name="name" placeholder="Write Full Name" required>
                                    <label>Name*</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input type="number" class="form-control" min="11"  name="phone" placeholder="Write Phone Number" required>
                                    <label>Phone*</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input type="email" class="form-control"  name="email" placeholder="Write Email" required>
                                    <label>Email*</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control"  name="person" placeholder="Write Person Number" required>
                                    <label>Person*</label>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-floating mb-4">
                                    <textarea  class="form-control" rows="3" name="remarks" placeholder="Write Remarks..."></textarea>
                                    <label>Remarks*</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="view" value="{{url()->full()}}">
                            <input type="hidden" name="r_type" value="Work Permit">
                            <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Send Query</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

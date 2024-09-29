@extends('frontend.layout.body')
@section('title','Trip Designer - Service  - The Best Ticket, Visa, Manpower Service Provider in Bangladesh.')
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
                            {{ Form::open(array('url' => 'service',  'method' => 'get' ,'class' =>'form-horizontal')) }}
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
                                        if(@$ser->name)
                                            $_GET['name'] = $ser->name;
                                        ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="goingto form-control fw-bold" name="name" required>
                                                    <option value="">Select Service</option>
                                                    @foreach($services as $service)
                                                        <option value="{{$service->name}}" <?php if($service->name == $_GET['name']) echo 'selected';  ?>>{{$service->name}}</option>
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
                                        data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview" aria-selected="true">
                                    <h4 style="color: white;">{{@$ser->title}}</h4></button>
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
                                                    <h4 class="fs-5">Service Details</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! nl2br(json_decode($ser->s_details)) !!}
                                                </div>
                                            </div>
                                            @if(json_decode($ser->p_method) !=null)
                                                <div class="card border rounded-3 mb-4">
                                                    <div class="card-header">
                                                        <h4 class="fs-5">Payment Method</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        {!! nl2br(json_decode($ser->p_method)) !!}
                                                    </div>
                                                </div>
                                            @endif
                                            @if(json_decode($ser->exclusion) !=null)
                                                <div class="card border rounded-3 mb-4">
                                                    <div class="card-header">
                                                        <h4 class="fs-5">Exclusion</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        {!! nl2br(json_decode($ser->exclusion)) !!}
                                                    </div>
                                                </div>
                                            @endif
                                            @if(json_decode($ser->tnt) !=null)
                                                <div class="card border rounded-3 mb-4">
                                                    <div class="card-header">
                                                        <h4 class="fs-5">Terms and Conditions</h4>
                                                    </div>
                                                    <div class="card-body">
                                                        {!! nl2br(json_decode($ser->tnt)) !!}
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
                                            <p class="font10 lh-1 mb-0"><b>For Booking Please Contact Us: </b></p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Phone: </b> {{$c_info->phone1}}</p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Email: </b>{{$c_info->email}}</p>
                                        </div>
                                    </div>
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <button class="btn btn-sm btn-primary full-width fw-medium text-uppercase mb-2" type="button">proceed to book </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center gy-3 gx-xl-3 gx-lg-4 gx-4">
                                @foreach($services as $visa)
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                        <div class="pop-touritem">
                                            <a href="{{url('services/'.$visa->slug)}}" class="card rounded-3 border br-dashed m-0">
                                                <div class="flight-thumb-wrapper p-2 pb-0">
                                                    <div class="popFlights-item-overHidden rounded-3">
                                                        <img src="{{@$domain.'/'.$visa->c_photo}}" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                                <div class="touritem-middle position-relative p-3">
                                                    <div class="touritem-flexxer">
                                                        <div class="explot">
                                                            <h4 class="city fs-6 m-0 fw-bold">
                                                                <span>{{$visa->name}}</span>
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
        </section>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

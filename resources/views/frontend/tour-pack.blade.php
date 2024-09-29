@extends('frontend.layout.body')
@section('title','Trip Designer - Tour Package - The Best Tour Package Provider in Bangladesh.')
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
                            {{ Form::open(array('url' => 'search-tour-package',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                            <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                <div class="col-xl-8 col-lg-7 col-md-12">
                                    <div class="row gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="goingto form-control fw-bold" name="country">
                                                    <option value="">Select</option>
                                                    @foreach($t_country as $country)
                                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control fw-bold" placeholder="Check-In & Check-Out" value="" name="checkinout" id="checkinout" readonly="readonly">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-12">
                                    <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="tour form-control fw-bold" required>
                                                    <option value="">Select</option>
                                                    <option value="ny">Family Package</option>
                                                    <option value="sd">Honeymoon Package</option>
                                                    <option value="sj">Group Package</option>
                                                </select>
                                            </div>
                                        </div>
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


        <!-- ============================ Offers Start ================================== -->
        <section class="gray-simple">
            <div class="container">
                <div class="row justify-content-between gy-4 gx-xl-4 gx-lg-3 gx-md-3 gx-4">

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <h5 class="fw-bold fs-6 mb-lg-0 mb-3">Showing {{$count}} Search Results</h5>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="d-flex align-items-center justify-content-start justify-content-lg-end flex-wrap">
                                    {{--                                    <div class="flsx-first me-2">--}}
                                    {{--                                        <div class="bg-white rounded py-2 px-3">--}}
                                    {{--                                            <div class="form-check form-switch">--}}
                                    {{--                                                <input class="form-check-input" type="checkbox" role="switch" id="mapoption">--}}
                                    {{--                                                <label class="form-check-label ms-1" for="mapoption">Map</label>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="flex-first me-2">--}}
                                    {{--                                        <button class="btn btn-filter btn-dark" type="button" data-bs-toggle="offcanvas"--}}
                                    {{--                                                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i--}}
                                    {{--                                                class="fa-solid fa-filter me-1"></i><span class="d-none d-md-block">Filter</span></button>--}}
                                    {{--                                    </div>--}}
                                    <div class="flsx-first mt-sm-0 mt-2">
                                        <ul class="nav nav-pills nav-fill p-1 small lights blukker bg-primary rounded-3 shadow-sm"
                                            id="filtersblocks" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active rounded-3" id="trending" data-bs-toggle="tab" type="button"
                                                        role="tab" aria-selected="true">Our Trending</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-3" id="mostpopular" data-bs-toggle="tab" type="button"
                                                        role="tab" aria-selected="false">Most Popular</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-3" id="lowprice" data-bs-toggle="tab" type="button" role="tab"
                                                        aria-selected="false">Lowest Price</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row justify-content-center gy-4 gx-xl-4 gx-3">
                            @foreach($t_package as $package)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="pop-touritem">
                                        <a href="{{url('tour-package/'.$package->slug)}}" class="card rounded-3 m-0">
                                            <div class="flight-thumb-wrapper p-2 pb-0">
                                                <div class="popFlights-item-overHidden rounded-3">
                                                    <img src="{{url('/'.$package->p_c_photo)}}" class="img-fluid" alt="">
                                                </div>
                                            </div>
                                            <div class="touritem-middle position-relative p-3">
                                                <div class="touritem-flexxer">
                                                        <?php
                                                        $include = json_decode($package->include);
                                                        ?>
                                                    <div class="tourist-wooks position-relative mb-3">
                                                        <ul class="activities-flex">
                                                            @if(@$include[0] = 'Hotel')
                                                                <li>
                                                                    <div class="actv-wrap">
                                                                        <div class="actv-wrap-ico"><i class="fa-solid fa-hotel"></i></div>
                                                                        <div class="actv-wrap-caps">Hotel</div>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(@$include[1] = 'SightSeeing')
                                                                <li>
                                                                    <div class="actv-wrap">
                                                                        <div class="actv-wrap-ico"><i class="fa-solid fa-person-walking-luggage"></i></div>
                                                                        <div class="actv-wrap-caps">SightSeeing</div>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(@$include[2] = 'Transfer')
                                                                <li>
                                                                    <div class="actv-wrap">
                                                                        <div class="actv-wrap-ico"><i class="fa-solid fa-bus"></i></div>
                                                                        <div class="actv-wrap-caps">Transfers</div>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                            @if(@$include[3] = 'Meal')
                                                                <li>
                                                                    <div class="actv-wrap">
                                                                        <div class="actv-wrap-ico"><i class="fa-solid fa-kitchen-set"></i></div>
                                                                        <div class="actv-wrap-caps">Meal</div>
                                                                    </div>
                                                                </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    <div class="explot">
                                                        <h4 class="city fs-title m-0 fw-bold">
                                                            <span>{{$package->p_name}} &nbsp;<strong><i class="fa-solid fa-star text-warning me-1"></i>{{floatval(rand(4,5))}}</strong></span>
                                                        </h4>
                                                    </div>
                                                    <div class="touritem-amenties my-4">
                                                        <ul class="activities-flex">
                                                            <li>
                                                                <div class="actv-wrap">
                                                                    <div class="actv-wrap-caps text-dark fw-bold fs-6"><span class="text-dhani me-1">{{$package->night}}</span>Night {{$package->night +1}} Days</div>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <h5 class="fs-5 low-price m-0">{{$c_info->currency}}
                                                                    <span class="price text-primary"> &nbsp; {{$package->p_p_adult}} {{$c_info->symbol}}</span>
                                                                </h5>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="text-center position-relative mt-5">
                                    <button type="button" class="btn btn-light-primary fw-medium px-5">Explore More<i class="fa-solid fa-arrow-trend-up ms-2"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Offers End ================================== -->

    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

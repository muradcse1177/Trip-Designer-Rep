@extends('frontend.layout.body')
@section('title','Trip Designer - Work Permit  - The Best Visa Service Provider in Bangladesh.')
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
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="goingto form-control fw-bold" name="country" required>
                                                    <option value="">Select Country</option>
                                                    @foreach($v_country as $country)
                                                        <option value="{{$country->name}}">{{$country->name}}</option>
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
                        <div class="row justify-content-center gy-4 gx-xl-3 gx-lg-4 gx-4">
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
                        <div class="row align-items-center justify-content-center">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="text-center position-relative mt-5">
                                    <a href="{{url('work-permit')}}"type="button" class="btn btn-light-primary fw-medium px-5">Explore More<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
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

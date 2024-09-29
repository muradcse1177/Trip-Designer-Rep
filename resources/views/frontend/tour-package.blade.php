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
                                                        <option value="{{$country->name}}" <?php if($country->name == $_GET['country']) echo 'selected';  ?>>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control fw-bold" placeholder="Check-In & Check-Out" value="{{$_GET['checkinout']}}" name="checkinout" id="checkinout" readonly="readonly">
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
                                                    <img src="{{@$domain.'/'.$package->p_c_photo}}" class="img-fluid" alt="">
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

        <!-- Filter Options Content-->
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
             id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header gray-simple">
                <h5 class="offcanvas-title fs-6" id="offcanvasScrollingLabel">Advance Search Options</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="filter-searchBar bg-white rounded-3">
                    <div class="filter-searchBar-head border-bottom">
                        <div class="searchBar-headerBody d-flex align-items-start justify-content-between py-3">
                            <div class="searchBar-headerfirst">
                                <h6 class="fw-bold fs-5 m-0">Filters</h6>
                                <p class="text-md text-muted m-0">Showing 180 Destinations</p>
                            </div>
                            <div class="searchBar-headerlast text-end">
                                <a href="#" class="text-md fw-medium text-primary active">Clear All</a>
                            </div>
                        </div>
                    </div>

                    <div class="filter-searchBar-body">


                        <!-- Bed types -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Bed Type</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-6">
                                        <input type="checkbox" class="btn-check" id="doublebed">
                                        <label class="btn btn-sm btn-secondary rounded-1 fw-medium full-width" for="doublebed">1 Double
                                            Bed</label>
                                    </li>
                                    <li class="col-6">
                                        <input type="checkbox" class="btn-check" id="2bed">
                                        <label class="btn btn-sm btn-secondary rounded-1 fw-medium full-width" for="2bed">2 Beds</label>
                                    </li>
                                    <li class="col-6">
                                        <input type="checkbox" class="btn-check" id="singlebed">
                                        <label class="btn btn-sm btn-secondary rounded-1 fw-medium full-width" for="singlebed">1 Single
                                            Bed</label>
                                    </li>
                                    <li class="col-6">
                                        <input type="checkbox" class="btn-check" id="3beds">
                                        <label class="btn btn-sm btn-secondary rounded-1 fw-medium full-width" for="3beds">3 Beds</label>
                                    </li>
                                    <li class="col-6">
                                        <input type="checkbox" class="btn-check" id="kingbed">
                                        <label class="btn btn-sm btn-secondary rounded-1 fw-medium full-width" for="kingbed">King
                                            Bed</label>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Popular Filters -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Popular Filters</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fsq">
                                            <label class="form-check-label" for="fsq">Free Cancellation Available</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bk1">
                                            <label class="form-check-label" for="bk1">Book @ ₹1</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="payh">
                                            <label class="form-check-label" for="payh">Pay At Hotel Available</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="brks">
                                            <label class="form-check-label" for="brks">Free Breakfast Included</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Pricing -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Pricing Range in US$</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <input type="text" class="js-range-slider" name="my_range" value="" data-skin="round" data-type="double"
                                       data-min="0" data-max="1000" data-grid="false">
                            </div>
                        </div>

                        <!-- Customer Ratings -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Customer Ratings</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="fourfive">
                                                    <label class="form-check-label" for="fourfive"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                        <div class="frm-slicing-title ps-1"><span class="text-dark fw-bold">4.5+</span></div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">16</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="fourplus">
                                                    <label class="form-check-label" for="fourplus"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                        <div class="frm-slicing-title ps-1"><span class="text-dark fw-bold">4+</span></div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">10</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="threefive">
                                                    <label class="form-check-label" for="threefive"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                        <div class="frm-slicing-title ps-1"><span class="text-dark fw-bold">3.5+</span></div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">08</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="threeplus">
                                                    <label class="form-check-label" for="threeplus"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                        <div class="frm-slicing-title ps-1"><span class="text-dark fw-bold">3+</span></div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">26</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Star Ratings -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Star Ratings</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="fivestar">
                                                    <label class="form-check-label" for="fivestar"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">16</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="fourstar">
                                                    <label class="form-check-label" for="fourstar"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">16</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check lg">
                                            <div class="frm-slicing d-flex align-items-center">
                                                <div class="frm-slicing-first">
                                                    <input class="form-check-input" type="checkbox" id="threestar">
                                                    <label class="form-check-label" for="threestar"></label>
                                                </div>
                                                <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                    <div class="frms-flex d-flex align-items-center">
                                                        <div class="frm-slicing-ico text-md">
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                            <i class="fa fa-star text-warning"></i>
                                                        </div>
                                                    </div>
                                                    <div class="text-end"><span class="text-md text-muted-2 opacity-75">16</span></div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Amenities -->
                        <div class="searchBar-single py-3 border-bottom">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Amenities</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="wififree">
                                            <label class="form-check-label" for="wififree">Free Wifi</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="bkrsdt">
                                            <label class="form-check-label" for="bkrsdt">4 Breakfast included</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="pool">
                                            <label class="form-check-label" for="pool">Pool</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="parking">
                                            <label class="form-check-label" for="parking">Free Parking</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="acrion">
                                            <label class="form-check-label" for="acrion">Air Conditioning</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

                        <!-- Popular Filters -->
                        <div class="searchBar-single py-3">
                            <div class="searchBar-single-title d-flex mb-3">
                                <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Fun things To Do</h6>
                            </div>
                            <div class="searchBar-single-wrap">
                                <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="beach">
                                            <label class="form-check-label" for="beach">Beach</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="ftns">
                                            <label class="form-check-label" for="ftns">Fitness center</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="cylc">
                                            <label class="form-check-label" for="cylc">Cycling</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="anms">
                                            <label class="form-check-label" for="anms">Animation Show</label>
                                        </div>
                                    </li>
                                    <li class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="shpc">
                                            <label class="form-check-label" for="shpc">Shopping center</label>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        </div>

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

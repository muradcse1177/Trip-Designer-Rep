@extends('frontend.layout.body')
@section('title','Trip Designer - Tour Package - The Best Tour Package Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br><br>

        <!-- ============================ Breadcrumbs End ================================== -->
        <!-- ============================ Destination Detail Start ================================== -->
        <section class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card border-0 p-3 mb-4">

                            <div class="crd-heaader d-md-flex align-items-center justify-content-between">
                                <div class="crd-heaader-first">
                                    <div class="d-block">
                                        <h4 class="mb-0">{{$package->p_name}}</h4>
                                        <div class="exlops">
                                            <p class="detail ellipsis-container fw-semibold">
                                                <span class="ellipsis-item__normal">{{$package->night}} Night {{$package->night +1}} Days</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="crd-heaader-last my-md-0 my-2">
                                    <div class="drix-first d-flex align-items-center pe-2 text-end mb-2">
                                        <a href="#" class="bg-light-info text-info rounded-1 fw-medium text-sm px-3 py-2 lh-base"><i
                                                class="fa-solid fa-bookmark me-2"></i>Bookmark</a>
                                        <a href="#"
                                           class="bg-light-danger text-danger rounded-1 fw-medium text-sm px-3 py-2 lh-base ms-2"><i
                                                class="fa-solid fa-share-nodes me-2"></i>Share</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $m_photo = json_decode($package->p_m_photo);
                            $highlight = json_decode($package->highlights);
                            $inclusion = json_decode($package->inclusion);
                            $exclusion = json_decode($package->exclusion);
                            $tnt = json_decode($package->tnt);
                            ?>
                            <div class="galleryGrid typeGrid_2 mb-lg-0 mb-3">
                                <div class="galleryGrid__item relative d-flex">
                                    <a href="{{@$domain.'/'.$package->p_c_photo}}" data-lightbox="roadtrip"><img src="{{@$domain.'/'.$package->p_c_photo}}"
                                                                                                            alt="image" class="rounded-2 img-fluid"></a>
                                </div>

                                <div class="galleryGrid__item position-relative">
                                    <a href="{{@$domain.'/'.$m_photo[0]}}" data-lightbox="roadtrip"><img src="{{@$domain.'/'.$m_photo[0]}}"
                                                                                                            alt="image" class="rounded-2 img-fluid"></a>
                                    <div class="position-absolute end-0 bottom-0 mb-3 me-3">
                                        <a href="{{@$domain.'/'.$m_photo[1]}}" data-lightbox="roadtrip"
                                           class="btn btn-md btn-whites fw-medium text-dark"><i class="fa-solid fa-caret-right me-1"></i></a>
                                    </div>
                                </div>
                                <div class="galleryGrid__item">
                                    <a href="{{@$domain.'/'.$m_photo[2]}}" data-lightbox="roadtrip"><img src="{{@$domain.'/'.$m_photo[2]}}"
                                                                                                            alt="image" class="rounded-2 img-fluid"></a>
                                </div>
                                <div class="galleryGrid__item">
                                    <a href="{{@$domain.'/'.$m_photo[3]}}" data-lightbox="roadtrip"><img src="{{@$domain.'/'.$m_photo[3]}}"
                                                                                                            alt="image" class="rounded-2 img-fluid"></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-5">
                        <ul class="nav nav-pills primary nav-fill gap-2 p-2  bg-light-primary rounded-2" id="pillstour-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2 active" id="pills-overview-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview"
                                        aria-selected="true">Overview</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2" id="pills-itinerary-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-itinerary" type="button" role="tab" aria-controls="pills-itinerary"
                                        aria-selected="false">Itinerary</button>
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
                                                    <h4 class="fs-5">Tour Highlights</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!!  $highlight !!}
                                                </div>
                                            </div>

                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Inclusions</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!!  $inclusion !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5"> Exclusions</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!!  $exclusion !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5"> Terms and Conditions</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!!  $tnt !!}
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
                                    <!-- Itinerary -->
                                    <div class="tab-pane fade" id="pills-itinerary" role="tabpanel" aria-labelledby="pills-itinerary-tab"
                                         tabindex="0">
                                        <!-- Itinerary -->
                                        <div class="accordion accordion-flush" id="accordionFlushExample">
                                            @for($i=0; $i<=$package->night; $i++)
                                                <div class="accordion-item border <?php if($i > 0) echo $d; ?>">
                                                    <h2 class="accordion-header <?php if($i == 0) echo $d; ?>">
                                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                data-bs-target="#flush-day<?php  echo $i; ?>" aria-expanded="false" aria-controls="flush-collapse<?php  echo $i; ?>">
                                                            <span class="fw-bold me-2">Day <?php  echo $i+1; ?></span>{{$title[$i]}}
                                                            Day
                                                        </button>
                                                    </h2>
                                                    <div id="flush-day<?php  echo $i; ?>" class="accordion-collapse collapse <?php if($i==0) echo 'show'; ?>"
                                                         data-bs-parent="#accordionFlushExample">
                                                        <div class="accordion-body" style="text-align: justify;">
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
                                                    </div>
                                                </div>
                                            @endfor

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="sides-block">
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
{{--                                            <p class="text-sm mb-0 lh-0"><del>$75,000</del></p>--}}
                                            <p class="font12 lh-1 mb-0"><span class="text-dark fs-3 fw-bold"><span>{{$c_info->currency.' '}}{{$package->p_p_adult}}</span></span>  Per
                                                Adult*</p>
                                        </div>
                                        <div
                                            class="single-card d-flex align-items-center justify-content-between px-3 py-3 border-top border-bottom">
                                            <div class="exlop-date"><span class="text-dark fw-medium"><i
                                                        class="fa-regular fa-calendar me-2"></i>{{$c_info->currency.' '}}{{$package->p_p_adult}}</span> Per Child*</div>
                                        </div>
                                        <div class="single-card px-3 py-3">
                                            <button class="btn btn-sm btn-primary full-width fw-medium text-uppercase mb-2"
                                                    type="button">proceed to book online</button>
                                            <button class="btn btn-sm btn-light-primary full-width fw-medium text-uppercase"
                                                    type="button">Send Inquiry</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Destination Detail End ================================== -->

        <!-- ============================ Similar Destination Start ================================== -->
        <section class="gray-simple py-5">
            <div class="container">
                <div class="row align-items-center justify-content-between mb-3">
                    <div class="col-8">
                        <div class="upside-heading">
                            <h5 class="fw-bold fs-6 m-0">Similar Destination</h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-end grpx-btn">
                            <a href="#" class="btn btn-light-primary btn-md fw-medium">More<i
                                    class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 p-0">
                        <div class="main-carousel arrow-hide cols-3">

                            @foreach($t_package as $package)
                            <div class="carousel-cell">
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
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Similar Destination End ================================== -->
    </div>

@endsection
@section('js')
    <script>
    </script>
@endsection

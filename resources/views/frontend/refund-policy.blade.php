@extends('frontend.layout.body')
@section('title','Trip Designer - Refund Policy  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================ Booking Title ================================== -->
        <section class="bg-cover position-relative" style="background:url(public/b2c/assets/img/bg.jpg)no-repeat;" data-overlay="5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">

                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions">
                                <h1 class="xl-heading text-light"> {{$c_info->name}}'s Refund Policy</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fpc-banner"></div>
        </section>
        <!-- ============================ Booking Title ================================== -->
        <!-- ============================ About Us Section ================================== -->
        <section>
            <div class="container">

                <div class="row align-items-center justify-content-between g-4">

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="" style="text-align: justify;">
                            <h2 class="lh-base fs-1 fw-bold">Our Refund Policy</h2>
                            {!!  json_decode($c_info->r_policy) !!}
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ============================ About Us Section End ================================== -->
        <!-- ============================ Video Helps End ================================== -->
        <section class="bg-cover" style="background:url(public/b2c/assets/img/bg-title.jpg)no-repeat;" data-overlay="5">
            <div class="ht-150"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="video-play-wrap text-center">
                            <div class="video-play-btn d-flex align-items-center justify-content-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#popup-video" class="square--90 circle bg-white fs-2 text-primary"><i class="fa-solid fa-play"></i></a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="ht-150"></div>
        </section>
        <!-- ============================ Video Helps End ================================== -->


        <!-- ============================ Our facts End ================================== -->
        <section class="py-4 gray">
            <div class="container">
                <div class="row align-items-center justify-content-between g-4">

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">15K</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Overall<br>Booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">5+</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Years<br>Successfully</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">10K</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Happly<br>Users</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">20</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Countries<br>We Work</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Our facts End ================================== -->
        <!-- ================================ Article Section Start ======================================= -->
        <section>
            <div class="container">

                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                        <div class="secHeading-wrap text-center mb-5">
                            <h2>Trending & Popular Articles</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach($blogs as $blog)
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="blogGrid-wrap d-flex flex-column h-100">
                                <div class="blogGrid-pics">
                                    <a href="{{url('/blog/'.$blog->slug)}}" class="d-block"><img src="{{url('/'.$blog->b_c_photo)}}" class="img-fluid rounded" alt="Blog image"></a>
                                </div>
                                <div class="blogGrid-caps pt-3">
                                    <div class="d-flex align-items-center mb-1"><span
                                            class="label text-success bg-light-success">{{$blog->b_category}}</span></div>
                                    <h4 class="fw-bold fs-6 lh-base"><a href="{{url('/blog/'.$blog->slug)}}" class="text-dark">{{$blog->b_title}}</a></h4>
                                    <p class="mb-3">{!! substr(json_decode($blog->details),'0',150) !!}</p>
                                    <a class="text-primary fw-medium" href="{{url('/blog/'.$blog->slug)}}">Read More<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- ================================ Article Section Start ======================================= -->
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

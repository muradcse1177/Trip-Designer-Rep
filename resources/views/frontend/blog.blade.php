@extends('frontend.layout.body')
@section('title','Trip Designer - Blog  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================ Articles Thumb Section ================================== -->
        <section class="p-0">
            <div class="thumb-wrap">
                <img src="{{url('public/b2c/assets/img/banner-7.jpg')}}" class="img-fluid full-width ht-500 object-fit" alt="" height="50%">
            </div>
        </section>
        <!-- ============================ Articles Thumb Section ================================== -->
        <!-- ============================ Articles Deatil Section ================================== -->
        <section class="p-0 position-relative mt-n6">
            <div class="container">
                <div class="row g-4">
                    <!-- Article content -->
                    <div class="col-11 col-lg-10 mx-auto">
                        <div class="bg-white shadow rounded-4 p-4">
                            <!-- Badge -->
                            <div class="d-inline-flex mb-2"><span class="label text-success bg-light-success">{{$blog->b_category}}</span></div>
                            <!-- Title -->
                            <h1 class="fs-3">{{$blog->b_title}}</h1>
                            <p class="mb-3">{{$blog->s_description.'...'}}</p>

                            <!-- List -->
                            <ul class="nav nav-divider align-items-center p-0">
                                <li class="nav-item ps-0">
                                    <div class="nav-link">
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg">
                                                <img class="avatar-img circle" src="{{Url('public/user.png')}}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-2">
                                                <h6 class="mb-0"><a href="#">{{$blog->p_by}}</a></h6>
                                                <p class="mb-0"><span>{{$blog->time}}</span><span class="text-muted-2 mx-2"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Articles Detail Section End ================================== -->
        <!-- ============================ Article Description ========================================== -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto" style="text-align: justify;">
                        {!! json_decode($blog->details) !!}
                        <br><br>
                        {!!   @json_decode($blog->map_location) !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Article Description ========================================== -->
        <section class="pt-0">
            <div class="container">

                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                        <div class="secHeading-wrap text-center mb-5">
                            <h2>Trending & Popular Articles</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach($blogs as $blo)
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="blogGrid-wrap d-flex flex-column h-100">
                                <div class="blogGrid-pics">
                                    <a href="{{url('/blog/'.$blo->slug)}}" class="d-block"><img src="{{url('/'.$blo->b_c_photo)}}" class="img-fluid rounded" alt="Blog image"></a>
                                </div>
                                <div class="blogGrid-caps pt-3">
                                    <div class="d-flex align-items-center mb-1"><span
                                            class="label text-success bg-light-success">{{$blo->b_category}}</span></div>
                                    <h4 class="fw-bold fs-6 lh-base"><a href="{{url('/blog/'.$blo->slug)}}" class="text-dark">{{$blo->b_title}}</a></h4>
                                    <p class="mb-3" style="text-align: justify;">{{$blog->s_description.'...'}}</p>
                                    <a class="text-primary fw-medium" href="{{url('/blog/'.$blo->slug)}}">Read More<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

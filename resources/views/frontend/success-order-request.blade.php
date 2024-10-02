@extends('frontend.layout.body')
@section('title','Trip Designer - Order  - The Best Ticket, Visa, Tou Package Manpower Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <br>
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================ Booking Page ================================== -->
        <section class="py-4 gray-simple position-relative">
            <div class="container">

                <div class="row align-items-start">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-3">
                            <div class="car-body px-xl-5 px-lg-4 py-lg-5 py-4 px-2">

                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <div class="square--80 circle text-light bg-success"><i class="fa-solid fa-check-double fs-1"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column text-center mb-5">
                                    <h3 class="mb-0">Your order was requested successfully!</h3>
                                    <p class="text-md mb-0">Confirmation detail send to: <span
                                            class="text-primary">{{$data['email']}}</span></p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column mb-4">
                                    <div class="border br-dashed full-width rounded-2 p-3 pt-0">
                                        <ul class="row align-items-center justify-content-start g-3 m-0 p-0">
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Tracking  Number</p>
                                                    <p class="text-muted mb-0 lh-2">#{{$data['tracking']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Date</p>
                                                    <p class="text-muted mb-0 lh-2">{{date('Y-m-d')}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Name</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['name']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Email</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['email']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Phone</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['phone']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Person</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['person']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Request Type</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['r_type']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Status</p>
                                                    <p class="btn btn-md btn-light-primary fw-semibold mx-2"><b>{{$data['status']}}</b></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center d-flex align-items-center justify-content-center">
                                    <a href="{{url('/')}}" class="btn btn-md btn-light-primary fw-semibold mx-2">Home</a>
                                    <a href="{{url('tour-package')}}" class="btn btn-md btn-light-primary fw-semibold mx-2">View Tour Package</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- ============================ Booking Page End ================================== -->

    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

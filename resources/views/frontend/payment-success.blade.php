@extends('frontend.layout.body')
@section('title', 'Trip Designer - Order Confirmation')

@section('content')
    <div id="main-wrapper">
        <section class="py-4 gray-simple position-relative">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-3">
                            <div class="card-body px-xl-5 px-lg-4 py-lg-5 py-4 px-2">
                                @if($order->status === 'Failed')
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <div class="square--80 circle text-light bg-danger">
                                            <i class="fa-solid fa-times fs-1"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center flex-column text-center mb-5">
                                        <h3 class="mb-0 text-danger">Your payment has failed.</h3>
                                        <p class="text-md mb-0">
                                            Confirmation sent to:
                                            <span class="text-primary">{{ $order->email }}</span>
                                        </p>
                                    </div>
                                @elseif($order->status === 'Canceled')
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <div class="square--80 circle text-light bg-warning">
                                            <i class="fa-solid fa-ban fs-1"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center flex-column text-center mb-5">
                                        <h3 class="mb-0 text-warning">Your transaction was canceled.</h3>
                                        <p class="text-md mb-0">
                                            Confirmation sent to:
                                            <span class="text-primary">{{ $order->email }}</span>
                                        </p>
                                    </div>
                                @else
                                    <div class="d-flex align-items-center justify-content-center mb-3">
                                        <div class="square--80 circle text-light bg-success">
                                            <i class="fa-solid fa-check-double fs-1"></i>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center flex-column text-center mb-5">
                                        <h3 class="mb-0">Your order was placed successfully!</h3>
                                        <p class="text-md mb-0">
                                            Confirmation sent to:
                                            <span class="text-primary">{{ $order->email }}</span>
                                        </p>
                                    </div>
                                @endif

                                <div class="d-flex align-items-center justify-content-center flex-column mb-4">
                                    <div class="border br-dashed full-width rounded-2 p-3 pt-0">
                                        <ul class="row align-items-center justify-content-start g-3 m-0 p-0">
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Tracking Number</p>
                                                    <p class="text-muted mb-0">#{{ $order->transaction_id }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Date</p>
                                                    <p class="text-muted mb-0">{{ date('Y-m-d', strtotime($order->time)) }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Name</p>
                                                    <p class="text-muted mb-0">{{ $order->name }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Email</p>
                                                    <p class="text-muted mb-0">{{ $order->email }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Phone</p>
                                                    <p class="text-muted mb-0">{{ $order->phone }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Course</p>
                                                    <p class="text-muted mb-0">{{ $order->product_name }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Type</p>
                                                    <p class="text-muted mb-0">{{ $order->product_category }}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div>
                                                    <p class="text-dark fw-medium mb-0">Status</p>

                                                    @php
                                                        $status = strtolower($order->status);
                                                        $statusLabel = ucfirst($status);
                                                        $badgeClass = match($status) {
                                                            'complete', 'processing' => 'btn-success',
                                                            'failed'                 => 'btn-danger',
                                                            'canceled'               => 'btn-warning',
                                                            default                  => 'btn-secondary',
                                                        };
                                                    @endphp

                                                    <p class="btn btn-md {{ $badgeClass }} fw-semibold mx-2">
                                                        <b>{{ $statusLabel }}</b>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="text-center d-flex align-items-center justify-content-center">
                                    <a href="{{ url('/') }}" class="btn btn-md btn-light-primary fw-semibold mx-2">Home</a>
                                    @if(Session::get('user_id'))
                                        <a href="{{ url('my-booking') }}" class="btn btn-md btn-light-primary fw-semibold mx-2">My Booking</a>
                                    @else
                                        <a href="{{ url('all-login') }}" class="btn btn-md btn-light-warning fw-semibold mx-2">Login</a>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

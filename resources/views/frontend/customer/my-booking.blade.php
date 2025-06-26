@extends('frontend.layout.body')
@section('title', 'Trip Designer - Order Confirmation')

@section('content')
    <section class="pt-5 gray-simple position-relative">
        <div class="container">
            <?php
            if($user->logo){
                $photo = $user->logo;
            }
            else{
                $photo = 'public/user.png';
            }
            ?>
            <div class="row align-items-start justify-content-between gx-xl-4">

                <div class="col-xl-4 col-lg-4 col-md-12 d-none d-lg-block">
                    <div class="card rounded-2 me-xl-5 mb-4">
                        <div class="card-top bg-primary position-relative">
                            <div class="py-5 px-3">
                                <div class="crd-thumbimg text-center">
                                    <div class="p-2 d-flex align-items-center justify-content-center brd">
                                        @if(!empty($photo))
                                            <img src="{{ url($photo) }}" class="img-fluid circle" width="120" alt="User Photo">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light rounded-circle" style="width: 120px; height: 120px;">
                                                <i class="fa fa-user fa-2x text-secondary"></i>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="crd-capser text-center">
                                    <h5 class="mb-0 text-light fw-semibold">{{ @$user->company_name }}</h5>
                                    <span class="text-light opacity-75 fw-medium text-md">
                        <i class="fa-solid fa-location-dot me-2"></i>{{ @$user->address }}
                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="card-middle px-4 py-5">
                            <div class="crdapproval-groups">

                                <div class="crdapproval-single d-flex align-items-center justify-content-start mb-4">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-success text-success">
                                            <i class="fa-solid fa-envelope-circle-check fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="crdapproval-caps ps-2">
                                        <p class="fw-semibold text-dark lh-2 mb-0">Verified Email</p>
                                        <p class="text-md text-muted lh-1 mb-0">{{ @$user->created_at }}</p>
                                    </div>
                                </div>

                                <div class="crdapproval-single d-flex align-items-center justify-content-start mb-4">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-success text-success">
                                            <i class="fa-solid fa-phone-volume fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="crdapproval-caps ps-2">
                                        <p class="fw-semibold text-dark lh-2 mb-0">Verified Mobile Number</p>
                                        <p class="text-md text-muted lh-1 mb-0">{{ @$user->created_at }}</p>
                                    </div>
                                </div>

                                <div class="crdapproval-single d-flex align-items-center justify-content-start">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-warning text-warning">
                                            <i class="fa-solid fa-file-invoice fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="crdapproval-caps ps-2">
                                        <p class="fw-semibold text-dark lh-2 mb-0">Complete Basic Info</p>
                                        <p class="text-md text-muted lh-1 mb-0">Verified</p>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="card-middle mt-5 mb-4 px-4">
                            <div class="crd-upgrades">
                                <button class="btn btn-light-primary fw-medium full-width rounded-2" type="button">
                                    <i class="fa-solid fa-sun me-2"></i>{{ @$user->status }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xl-8 col-lg-8 col-md-12">
                    <!-- Personal Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-file-invoice-dollar me-2"></i>Payment History</h4>
                        </div>
                        <div class="card-body">
                            <div class="container px-3">
                                @forelse ($orders as $order)
                                    @php
                                        $profile = json_decode($order->product_profile);
                                        $slug = $profile->slug ?? '#';
                                        $status = strtolower($order->status);
                                        $statusClass = match($status) {
                                            'complete', 'completed', 'success', 'paid' => 'bg-success text-white',
                                            'pending', 'hold' => 'bg-info text-white',
                                            'cancel', 'failed', 'cancelled' => 'bg-danger text-white',
                                            'unpaid' => 'bg-warning text-dark',
                                            default => 'bg-secondary text-white'
                                        };
                                    @endphp

                                    <div class="row border rounded shadow-sm p-3 mb-3 align-items-center">
                                        <div class="col-md-3 mb-2 mb-md-0">
                                            <div><strong>Transaction ID:</strong> {{ $order->transaction_id }}</div>
                                            <div><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->time)->format('d M Y') }}</div>
                                        </div>

                                        <div class="col-md-3 mb-2 mb-md-0 d-flex align-items-center justify-content-start justify-content-md-end text-start text-md-end">
                                            <div>
                                                <div><strong>Name:</strong> <a href="{{ url('course/' . $slug) }}" target="_blank">{{ $order->product_name }}</a></div>
                                                <div><strong>Type:</strong> {{ $order->product_category }}</div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="d-flex flex-wrap justify-content-start justify-content-md-end align-items-center gap-2 mt-2 mt-md-0">
                                                <span class="badge {{ $statusClass }} text-uppercase px-3 py-1">{{ $order->status }}</span>
                                                <strong class="text-dark">৳{{ number_format($order->amount, 2) }}</strong>

                                                {{-- Invoice Button --}}
                                                <a href="{{ url('invoice/' . $order->transaction_id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-file-invoice me-1"></i> Invoice
                                                </a>

                                                {{-- View Button --}}
                                                <a href="{{ url('booking/view/' . $order->transaction_id) }}" class="btn btn-sm btn-outline-warning">
                                                    <i class="fa fa-eye me-1"></i> View
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center text-muted">
                                        No bookings found.
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Booking Page End ================================== -->

@endsection

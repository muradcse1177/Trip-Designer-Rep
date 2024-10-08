@extends('frontend.layout.body')
@section('title','Trip Designer - About Us  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')

    <!-- ============================ User Dashboard Menu ============================ -->
    <div class="dashboard-menus border-top d-none d-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <ul class="user-Dashboard-menu">
                        <li class="active"><a href="{{url('customer-profile')}}"><i class="fa-regular fa-id-card me-2"></i>My Profile</a></li>
                        <li><a href="my-booking.html"><i class="fa-solid fa-ticket me-2"></i>My Booking</a></li>
                        <li><a href="travelers.html"><i class="fa-solid fa-user-group me-2"></i>Travelers</a></li>
                        <li><a href="payment-detail.html"><i class="fa-solid fa-wallet me-2"></i>Payment Details</a></li>
                        <li><a href="my-wishlists.html"><i class="fa-solid fa-shield-heart me-2"></i>My Wishlist</a></li>
                        <li><a href="settings.html"><i class="fa-solid fa-sliders me-2"></i>Settings</a></li>
                        <li><a href="delete-account.html"><i class="fa-solid fa-trash-can me-2"></i>Delete Profile</a></li>
                        <li><a href="login.html"><i class="fa-solid fa-power-off me-2"></i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ End user Dashboard Menu ============================ -->


    <!-- ============================ Booking Page ================================== -->
    <section class="pt-5 gray-simple position-relative">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                    <button class="btn btn-dark fw-medium full-width d-block d-lg-none" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasDashboard" aria-controls="offcanvasDashboard"><i
                            class="fa-solid fa-gauge me-2"></i>Dashboard
                        Navigation</button>
                    <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
                         id="offcanvasDashboard" aria-labelledby="offcanvasScrollingLabel">
                        <div class="offcanvas-header gray-simple">
                            <h5 class="offcanvas-title" id="offcanvasScrollingLabel">Offcanvas with body scrolling</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body p-0">
                            <ul class="user-Dashboard-longmenu">
                                <li class="active"><a href="my-profile.html"><i class="fa-regular fa-id-card me-2"></i>My Profile</a>
                                </li>
                                <li><a href="my-booking.html"><i class="fa-solid fa-ticket me-2"></i>My Booking</a>
                                </li>
                                <li><a href="travelers.html"><i class="fa-solid fa-user-group me-2"></i>Travelers</a></li>
                                <li><a href="payment-detail.html"><i class="fa-solid fa-wallet me-2"></i>Payment Details</a></li>
                                <li><a href="my-wishlists.html"><i class="fa-solid fa-shield-heart me-2"></i>My Wishlist</a></li>
                                <li><a href="settings.html"><i class="fa-solid fa-sliders me-2"></i>Settings</a></li>
                                <li><a href="delete-account.html"><i class="fa-solid fa-trash-can me-2"></i>Delete Profile</a></li>
                                <li><a href="login.html"><i class="fa-solid fa-power-off me-2"></i>Sign Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if($user->logo){
                $photo = $user->logo;
            }
            else{
                $photo = 'public/profile.png';
            }
            ?>
            <div class="row align-items-start justify-content-between gx-xl-4">
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="card rounded-2 me-xl-5 mb-4">
                        <div class="card-top bg-primary position-relative">
                            <div class="py-5 px-3">
                                <div class="crd-thumbimg text-center">
                                    <div class="p-2 d-flex align-items-center justify-content-center brd">
                                        <img src="{{url($photo)}}" class="img-fluid circle" width="120" alt=""></div>
                                </div>
                                <div class="crd-capser text-center">
                                    <h5 class="mb-0 text-light fw-semibold">{{@$user->company_name}}</h5>
                                    <span class="text-light opacity-75 fw-medium text-md"><i class="fa-solid fa-location-dot me-2"></i>{{@$user->address}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="card-middle px-4 py-5">
                            <div class="crdapproval-groups">

                                <div class="crdapproval-single d-flex align-items-center justify-content-start mb-4">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-success text-success"><i
                                                class="fa-solid fa-envelope-circle-check fs-5"></i></div>
                                    </div>
                                    <div class="crdapproval-caps ps-2">
                                        <p class="fw-semibold text-dark lh-2 mb-0">Verified Email</p>
                                        <p class="text-md text-muted lh-1 mb-0">{{@$user->created_at}}</p>
                                    </div>
                                </div>

                                <div class="crdapproval-single d-flex align-items-center justify-content-start mb-4">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-success text-success"><i
                                                class="fa-solid fa-phone-volume fs-5"></i></div>
                                    </div>
                                    <div class="crdapproval-caps ps-2">
                                        <p class="fw-semibold text-dark lh-2 mb-0">Verified Mobile Number</p>
                                        <p class="text-md text-muted lh-1 mb-0">{{@$user->created_at}}</p>
                                    </div>
                                </div>

                                <div class="crdapproval-single d-flex align-items-center justify-content-start">
                                    <div class="crdapproval-item">
                                        <div class="square--50 circle bg-light-warning text-warning"><i
                                                class="fa-solid fa-file-invoice fs-5"></i></div>
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
                                    <i class="fa-solid fa-sun me-2"></i>{{@$user->status}}</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8 col-lg-8 col-md-12">

                    <!-- Personal Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-file-invoice me-2"></i>Personal Information</h4>
                        </div>
                        {{ Form::open(array('url' => 'update-customer-profile',  'method' => 'post','enctype'=>"multipart/form-data")) }}
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row align-items-center justify-content-start">
                                @if ($message = Session::get('successMessage'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulations!</strong> {{$message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if ($message = Session::get('errorMessage'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> {{$message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif

                                <div class="col-xl-12 col-lg-12 col-md-12 mb-4">
                                    <div class="d-flex align-items-center">
                                        <label class="position-relative me-4" for="uploadfile-1" title="Replace this pic">
                                            <!-- Avatar place holder -->
                                            <span class="avatar avatar-xl">
                                                <img id="uploadfile-1-preview" class="avatar-img rounded-circle border border-white border-3 shadow" src="{{url($photo)}}" alt="">
                                            </span>
                                        </label>
                                        <!-- Upload button -->
                                        <label class="btn btn-sm btn-light-primary px-4 fw-medium mb-0" for="uploadfile-1">Change</label>
                                        <input id="uploadfile-1" name="photo" class="form-control d-none" type="file" accept="image/png, image/gif, image/jpeg, image/jpg">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Full Name</label>
                                        <input type="text" class="form-control" name="name" value="{{@$user->company_name}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email ID</label>
                                        <input type="email"  name="email" class="form-control" value="{{@$user->company_email}}">
                                    </div>
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Country Code</label>
                                        <select class="select form-control" name="phoneCode" required>
                                            @foreach($countries as $country)
                                                <option value="{{$country->phonecode}}" <?php if($country->phonecode == '880') echo 'selected'; ?> >{{'+'.$country->phonecode}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-4">
                                    <div class="form-group">
                                        <label class="form-label">Mobile</label>
                                        <input type="number" name="phone" class="form-control" value="{{@$user->company_pnone}}">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Address</label>
                                        <input type="text" class="form-control" name="address" value="{{@$user->address}}">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-md btn-primary mb-0">Update Info</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fa-solid fa-lock me-2"></i>Update Password</h4>
                        </div>
                        {{ Form::open(array('url' => 'update-password',  'method' => 'post')) }}
                        {{ csrf_field() }}
                        <div class="card-body">
                            <div class="row align-items-center justify-content-start">
                                @if ($message = Session::get('successMessage1'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>Congratulations!</strong> {{$message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                @if ($message = Session::get('errorMessage1'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Sorry!!</strong> {{$message}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                @endif
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" name="o_pass" class="form-control" placeholder="*********">
                                    </div>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="n_pass" class="form-control" placeholder="*********">
                                    </div>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-md btn-primary mb-0">Change Password</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Booking Page End ================================== -->
@endsection
@section('js')
    <script>
    </script>
@endsection

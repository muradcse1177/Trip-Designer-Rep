@extends('frontend.layout.body')
@section('title','Trip Designer - Customer Signup  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <section class="py-5">
            <div class="container">

                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-12">
                        <div class="bg-mode shadow rounded-3 overflow-hidden" style="background-color: #dce5f3">
                            <div class="row g-0">
                                <!-- Vector Image -->
                                <div class="col-lg-6 d-flex align-items-center order-2 order-lg-1">
                                    <div class="p-3 p-lg-5">
                                        <img src="{{url('public/b2c/assets/img/login.svg')}}" class="img-fluid" alt="">
                                    </div>
                                    <!-- Divider -->
                                    <div class="vr opacity-1 d-none d-lg-block"></div>
                                </div>

                                <!-- Information -->
                                <div class="col-lg-6 order-1">
                                    <div class="p-4 p-sm-7">
                                        <h1 class="mb-2 fs-2">Create New Account</h1>
                                        <p class="mb-0">Already a Member?<a href="{{url('/all-login')}}" class="fw-medium text-primary"> Sign In</a></p>
                                        @if ($message = Session::get('errorMessage'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Sorry!!</strong> {{$message}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        @endif
                                        <!-- Form START -->
                                        {{ Form::open(array('url' => 'create-new-customer',  'method' => 'post','class' => 'mt-4 text-start')) }}
                                        {{ csrf_field() }}
                                            <div class="form row">
                                                <div class="form-group">
                                                    <label class="form-label">Enter Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label class="form-label">Country Code</label>
                                                        <select class="select form-control" name="phoneCode" required>
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->phonecode}}" <?php if($country->phonecode == '880') echo 'selected'; ?> >{{'+'.$country->phonecode}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <div class="form-group">
                                                        <label class="form-label">Enter Phone</label>
                                                        <input type="number" name="phone" class="form-control" placeholder="1707011562" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Enter email ID</label>
                                                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Enter Password</label>
                                                    <div class="position-relative">
                                                        <input type="password" class="form-control" id="password-field" name="password" placeholder="Password">
                                                        <span class="fa-solid fa-eye toggle-password position-absolute top-50 end-0 translate-middle-y me-3"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Create An Account</button>
                                                </div>
                                            </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ============================== Login Section End ================== -->

    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

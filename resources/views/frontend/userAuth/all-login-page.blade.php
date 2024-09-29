@extends('frontend.layout.body')
@section('title','Trip Designer - All Signup and Login  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <section class="py-5">
            <div class="container">

                <div class="row justify-content-center align-items-center m-auto">
                    <div class="col-12">
                        <div class="bg-mode shadow rounded-3 overflow-hidden" style="background-color: #eae5e5">
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
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="">
                                                <ul class="nav nav-pills primary-soft medium justify-content-center mb-3" id="tour-pills-tab" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active cAreaLink" data-bs-toggle="tab" href="#cArea"> Customer Area</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link aAreaLink" data-bs-toggle="tab" href="#aArea"> Agent Area</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="cArea">
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
                                                {{ Form::open(array('url' => 'verifyUsers',  'method' => 'post')) }}
                                                {{ csrf_field() }}
                                                <div class="form-floating mb-4">
                                                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                                    <label> Email</label>
                                                </div>
                                                <div class="form-floating mb-4">
                                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                    <label>Password</label>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Log In</button>
                                                </div>
                                                {{ Form::close() }}
                                                <div class="modal-flex-item d-flex align-items-center justify-content-between mb-3">
                                                    <div class="modal-flex-first">
                                                        <div class="form-check form-check-inline">
                                                            <input class="form-check-input" type="checkbox" id="savepassword" value="option1">
                                                            <label class="form-check-label" for="savepassword">Save Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="modal-flex-last">
                                                        <a href="JavaScript:Void(0);" class="text-primary fw-medium">Forget Password?</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="aArea">
                                                {{ Form::open(array('url' => 'verifyUsers',  'method' => 'post')) }}
                                                {{ csrf_field() }}
                                                    <div class="form-floating mb-4">
                                                        <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                                                        <label> Email</label>
                                                    </div>
                                                    <div class="form-floating mb-4">
                                                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                                                        <label>Password</label>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Log In</button>
                                                    </div>
                                                    <div class="modal-flex-item d-flex align-items-center justify-content-between mb-3">
                                                        <div class="modal-flex-first">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="savepassword" value="option1">
                                                                <label class="form-check-label" for="savepassword">Save Password</label>
                                                            </div>
                                                        </div>
                                                        <div class="modal-flex-last">
                                                            <a href="JavaScript:Void(0);" class="text-primary fw-medium">Forget Password?</a>
                                                        </div>
                                                    </div>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                        <div class="modal-footer align-items-center justify-content-center c_sign_div">
                                            <p>Don't have an account yet?<a href="{{url('/customer-signup')}}" class="text-primary fw-medium ms-1">Sign Up</a></p>
                                        </div>
                                        <div class="modal-footer align-items-center justify-content-center a_sign_div" style="display: none;">
                                            <p>Don't have an account yet?<a href="{{url('/agent-signup')}}" class="text-primary fw-medium ms-1">Sign Up</a></p>
                                        </div>
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

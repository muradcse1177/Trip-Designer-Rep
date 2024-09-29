@extends('userAuth.layout')
@section('title','Trip Designer || Log In')
@section('content')
    <body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Trip Designer</b></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                @if ($message = Session::get('errorMessage'))
                    <center><p style="color: red">{{$message}} </p></center>
                @endif
                {{ Form::open(array('url' => 'createNewUser',  'method' => 'post')) }}
                {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Company Name" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Company Email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="phone" class="form-control" name="phone" placeholder="Company Phone" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" checked>
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                {{ Form::close() }}

                <a href="{{url('login')}}" class="text-center">I already have a account</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
@endsection


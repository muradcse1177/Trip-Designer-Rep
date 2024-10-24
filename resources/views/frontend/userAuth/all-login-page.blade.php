@extends('frontend.layout.body')
@section('title','Trip Designer - All Signup and Login  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <?php
        $useragent=$_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            $a = 'a';
        else
            $a = 'b';
        ?>
        @if( $a == 'b')
            <br><br>
        @endif
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
                                                        <a href="{{url('forgot-password')}}" class="text-primary fw-medium">Forget Password?</a>
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

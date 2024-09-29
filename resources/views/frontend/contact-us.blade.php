@extends('frontend.layout.body')
@section('title','Trip Designer - Contact - The Best Air Ticket, Visa, Tour Package Service Provider in Bangladesh.')
@section('content')
    <div id="main-wrapper">
        <br>
        <br>
        <!-- End Navigation -->
        <div class="clearfix"></div>

        <!-- ============================ Booking Title ================================== -->
        <section class="bg-cover position-relative" style="background:url(public/b2c/assets/img/bg-title.jpg)no-repeat;" data-overlay="5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">

                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions">
                                <h1 class="xl-heading text-light">Get-in Touch</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Booking Title ================================== -->


        <!-- ============================ Form Section ================================== -->
        <section>
            <div class="container">

                <div class="row justify-content-between g-4 mb-5">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card p-4 rounded-4 border br-dashed text-center h-100">
                            <div class="crds-icons d-inline-flex mx-auto mb-3 text-primary fs-2"><i class="fa-solid fa-briefcase"></i>
                            </div>
                            <div class="crds-desc">
                                <h5>Drop a Mail</h5>
                                <p class="fs-6 text-md lh-2 mb-0">{{@$c_info->email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card p-4 rounded-4 border br-dashed text-center h-100">
                            <div class="crds-icons d-inline-flex mx-auto mb-3 text-primary fs-2"><i class="fa-solid fa-headset"></i>
                            </div>
                            <div class="crds-desc">
                                <h5>Call Us</h5>
                                <p class="fs-6 text-md lh-2 mb-0">{{@$c_info->phone1}}<br>{{@$c_info->phone2}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card p-4 rounded-4 border br-dashed text-center h-100">
                            <div class="crds-icons d-inline-flex mx-auto mb-3 text-primary fs-2"><i class="fa-solid fa-globe"></i>
                            </div>
                            <div class="crds-desc">
                                <h5>Connect with Social</h5>
                                <p class="text-md lh-2">Let's Connect with Us via social media</p>
                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item"> <a class="square--40 circle gray-simple color--facebook" href="{{@$c_info->f_link}}" target="_blank"><i
                                                class="fa-brands fa-facebook-f"></i></a> </li>
                                    <li class="list-inline-item"> <a class="square--40 circle gray-simple color--instagram" href="{{@$c_info->in_link}}" target="_blank"><i
                                                class="fa-brands fa-instagram"></i></a> </li>
                                    <li class="list-inline-item"> <a class="square--40 circle gray-simple color--twitter" href="{{@$c_info->y_link}}" target="_blank"><i
                                                class="fa-brands fa-youtube"></i></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center justify-content-between g-4">

                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="contactForm gray-simple p-4 rounded-3">
                            {{ Form::open(array('url' => 'contactUS',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                <div class="row align-items-center">
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="touch-block d-flex flex-column mb-4">
                                            <h2>Drop Us a Line</h2>
                                            <p>Get in touch via form below and we will reply as soon as we can. </p>
                                            @if(Session::get('successMessage'))
                                            <h4 style="color: green;"> {{Session('successMessage')}}</h4>
                                            @endif
                                            @if(Session::get('$errorMessage'))
                                                <h4 style="color: red;">{{Session('errorMessage')}}</h4>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Your Name</label>
                                            <input type="text" class="form-control" name="name" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">E-Mail ID</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Phone No.</label>
                                            <input type="text" class="form-control" name="phone" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Subject</label>
                                            <input type="text" class="form-control" name="subject" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Your Query</label>
                                            <textarea class="form-control ht-120" name="ask" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn fw-medium btn-primary">Send Message<i
                                                    class="fa-solid fa-paper-plane ms-2"></i></button>
                                        </div>
                                    </div>

                                </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                    <div class="col-xl-5 col-lg-5 col-md-12" >
                        <iframe class="full-width ht-100 grayscale rounded"
                                src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCpKM03PNNtNv0dwwoZNqHp38bfnbCpYkM&q=Trip+Designer"
                                height="500" style="border:0;" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    <div class="row" style="text-align: center; margin-top: 20px;">
                        @if(Session::get('successMessagee'))
                            <h4 style="color: green;"> {{Session('successMessagee')}}</h4>
                        @endif
                        @if(Session::get('errorMessagee'))
                            <h4 style="color: red;">{{Session('errorMessagee')}}</h4>
                        @endif
                    </div>
                </div>

            </div>
        </section>
        <!-- ============================ Form Section End ================================== -->
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

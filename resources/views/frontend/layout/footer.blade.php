<!-- ================================ Article Section Start ======================================= -->

<!-- ============================ Call To Action Start ================================== -->
@if(@$c_info->name)
<div class="position-relative bg-cover py-5 bg-primary" style="background:url({{url('/public/b2c/assets/img/bg.jpg')}})no-repeat;"
     data-overlay="5">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="calltoAction-wraps position-relative py-5 px-4">
                    <div class="ht-40"></div>
                    <div class="row align-items-center justify-content-center">
                        <div class="col-xl-8 col-lg-9 col-md-10 col-sm-11 text-center">

                            <div class="calltoAction-title mb-5">
                                <h4 class="text-light fs-2 fw-bold lh-base m-0">Subscribe & Get<br>Special Discount with {{@$c_info->name}}
                                </h4>
                            </div>
                            <div class="newsletter-forms mt-md-0 mt-4">
                                {{ Form::open(array('url' => 'subscribe',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                    <div class="row align-items-center justify-content-between bg-white rounded-3 p-2 gx-0">

                                        <div class="col-xl-9 col-lg-8 col-md-8">
                                            <div class="form-group m-0">
                                                <input type="email" class="form-control bold ps-1 border-0"  name="email" placeholder="Enter Your Mail!">
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-lg-4 col-md-4">
                                            <div class="form-group m-0">
                                                <button type="submit" class="btn btn-primary fw-medium full-width">Submit<i
                                                        class="fa-solid fa-arrow-trend-up ms-2"></i></button>
                                            </div>
                                        </div>

                                    </div>
                                {{ Form::close() }}
                            </div>

                        </div>
                    </div>
                    <div class="ht-40"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ============================ Call To Action Start ================================== -->


<!-- ============================ Footer Start ================================== -->
<footer class="footer " style="background: white;">
    <div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4">
                    <div class="footer-widget">
                        <div class="d-flex align-items-start flex-column mb-3">
                            <div class="d-inline-block"><img src="{{url('/'.@$c_info->logo)}}" class="img-fluid" width="160"
                                                             alt="Footer Logo"></div>
                        </div>
                        <div class="footer-add pe-xl-3">
                            <p style="color: #04107C;">{{@$c_info->tagline}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Important Link</h4>
                        <ul class="footer-menu">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('visa')}}">Visa</a></li>
                            <li><a href="{{url('tour-package')}}">Tour Package</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4">
                    <div class="footer-widget">
                        <h4 class="widget-title">Our Resources</h4>
                        <ul class="footer-menu">
                            <li><a href="{{url('about-us')}}">About Us</a></li>
                            <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                            <li><a href="{{url('privacy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">The Company</h4>
                        <ul class="footer-menu">
                            <li><a href="{{url('terms-conditions')}}">Terms & Conditions</a></li>
                            <li><a href="{{url('refund-policy')}}">Refund Policy</a></li>
                            <li><a href="{{url('cookie-policy')}}">Cookie Policy</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4 class="widget-title">Payment Methods</h4>
                        <div class="pmt-wrap">
                            <img src="{{url('/public/ssl-gateway.png')}}" class="img-fluid" alt="">
                        </div>
                        <div class="foot-socials" style="margin-top: -10px;">
                            <ul>
                                <li style="border: solid 1px #04107C;"><a href="{{@$c_info->f_link}}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                                <li style="border: solid 1px #04107C;"><a href="{{@$c_info->in_link}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                                <li style="border: solid 1px #04107C;"><a href="{{@$c_info->y_link}}" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom border-top" style="background: white;">
        <div class="container">
            <div class="row align-items-center justify-content-between">

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <p class="mb-0" style="color: #04107C;">All rights reserved by {{@$c_info->name}} © 2021 -<?php echo date('Y')?></p>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6" >
                    <ul class="p-0 d-flex justify-content-start justify-content-md-end text-start text-md-end m-0" >
                        <li><a href="{{url('terms-conditions')}}" style="color: #04107C;">Terms of services</a></li>
                        <li class="ms-3"><a href="{{url('refund-policy')}}" style="color: #04107C;">Privacy Policies</a></li>
                        <li class="ms-3"><a href="{{url('cookie-policy')}}" style="color: #04107C;">Cookies</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->
<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="fa-solid fa-sort-up"></i></a>
</div>
@endif
<script src="{{url('/public/b2c/assets/js/jquery.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/popper.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/bootstrap.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/dropzone.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/flatpickr.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/flickity.pkgd.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/lightbox.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/rangeslider.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/select2.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/counterup.min.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/prism.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/addadult.js')}}"></script>
<script src="{{url('/public/b2c/assets/js/custom.js')}}"></script>
<script src="{{url('/public/b2c_custom.js')}}"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function(event) {
        $(".cAreaLink").click(function(){
            $('.c_sign_div').show();
            $('.a_sign_div').hide();
        });
        $(".aAreaLink").click(function(){
            $('.c_sign_div').hide();
            $('.a_sign_div').show();
        });
    });
    (function($) {
        $(document).ready(function(event) {
            $('.loadingstart').click(function() {
                $('.loading').toggle('show');
                $('a').attr('disable','true');
            });
        });
    })(jQuery);
</script>

</body>

</html>

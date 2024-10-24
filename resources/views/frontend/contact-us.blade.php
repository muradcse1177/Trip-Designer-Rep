@extends('frontend.layout.body')
@section('title','Trip Designer - Contact - The Best Air Ticket, Visa, Tour Package Service Provider in Bangladesh.')
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

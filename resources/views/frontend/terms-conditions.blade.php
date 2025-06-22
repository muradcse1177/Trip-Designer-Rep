@extends('frontend.layout.body')
@section('title','Trip Designer - Terms & Conditions  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
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
{{--            <br><br>--}}
        @endif
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <!-- ============================ Booking Title ================================== -->
        <section class="bg-cover position-relative" style="background:url(public/b2c/assets/img/bg.jpg)no-repeat;" data-overlay="5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">

                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions">
                                <h1 class="xl-heading text-light"> {{$c_info->name}}'s Terms & Conditions</h1>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="fpc-banner"></div>
        </section>
        <!-- ============================ Booking Title ================================== -->
        <!-- ============================ About Us Section ================================== -->
        <section>
            <div class="container">

                <div class="row align-items-center justify-content-between g-4">

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="" style="text-align: justify;">
                            <h2 class="lh-base fs-1 fw-bold">Our Terms & Conditions</h2>
                            {!!  json_decode($c_info->tnt) !!}
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- ============================ About Us Section End ================================== -->
        <!-- ============================ Video Helps End ================================== -->
        <section class="bg-cover" style="background:url(public/b2c/assets/img/bg-title.jpg)no-repeat;" data-overlay="5">
            <div class="ht-150"></div>
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="video-play-wrap text-center">
                            <div class="video-play-btn d-flex align-items-center justify-content-center">
                                <a href="" data-bs-toggle="modal" data-bs-target="#popup-video" class="square--90 circle bg-white fs-2 text-primary"><i class="fa-solid fa-play"></i></a>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="ht-150"></div>
        </section>
        <!-- ============================ Video Helps End ================================== -->


        <!-- ============================ Our facts End ================================== -->
        <section class="py-4 gray">
            <div class="container">
                <div class="row align-items-center justify-content-between g-4">

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">15K</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Overall<br>Booking</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">5+</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Years<br>Successfully</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">10K</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Happly<br>Users</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                        <div class="urfacts-wrap d-flex align-items-center justify-content-center">
                            <div class="urfacts-first flex-shrink-0">
                                <h3 class="fs-1 fw-medium text-primary mb-0">20</h3>
                            </div>
                            <div class="urfacts-caps ps-3">
                                <p class="text-muted-2 lh-base mb-0">Countries<br>We Work</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ Our facts End ================================== -->
        <!-- ================================ Article Section Start ======================================= -->
        <!-- ================================ Article Section Start ======================================= -->
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

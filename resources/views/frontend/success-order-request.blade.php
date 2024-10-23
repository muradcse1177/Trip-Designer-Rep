@extends('frontend.layout.body')
@section('title','Trip Designer - Order  - The Best Ticket, Visa, Tou Package Manpower Service Provider in Bangladesh.')
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
        <!-- ============================ Booking Page ================================== -->
        <section class="py-4 gray-simple position-relative">
            <div class="container">

                <div class="row align-items-start">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card mb-3">
                            <div class="car-body px-xl-5 px-lg-4 py-lg-5 py-4 px-2">

                                <div class="d-flex align-items-center justify-content-center mb-3">
                                    <div class="square--80 circle text-light bg-success"><i class="fa-solid fa-check-double fs-1"></i>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column text-center mb-5">
                                    <h3 class="mb-0">Your order was requested successfully!</h3>
                                    <p class="text-md mb-0">Confirmation detail send to: <span
                                            class="text-primary">{{$data['email']}}</span></p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center flex-column mb-4">
                                    <div class="border br-dashed full-width rounded-2 p-3 pt-0">
                                        <ul class="row align-items-center justify-content-start g-3 m-0 p-0">
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Tracking  Number</p>
                                                    <p class="text-muted mb-0 lh-2">#{{$data['tracking']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Date</p>
                                                    <p class="text-muted mb-0 lh-2">{{date('Y-m-d')}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Name</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['name']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Email</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['email']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Phone</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['phone']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Person</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['person']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Request Type</p>
                                                    <p class="text-muted mb-0 lh-2">{{$data['r_type']}}</p>
                                                </div>
                                            </li>
                                            <li class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                                <div class="d-block">
                                                    <p class="text-dark fw-medium lh-2 mb-0">Status</p>
                                                    <p class="btn btn-md btn-light-primary fw-semibold mx-2"><b>{{$data['status']}}</b></p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="text-center d-flex align-items-center justify-content-center">
                                    <a href="{{url('/')}}" class="btn btn-md btn-light-primary fw-semibold mx-2">Home</a>
                                    <a href="{{url('tour-package')}}" class="btn btn-md btn-light-primary fw-semibold mx-2">View Tour Package</a>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>
        <!-- ============================ Booking Page End ================================== -->

    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

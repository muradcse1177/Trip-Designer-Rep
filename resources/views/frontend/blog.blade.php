@extends('frontend.layout.body')
@section('title','Trip Designer - Blog  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
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
        <!-- ============================ Articles Thumb Section ================================== -->
        <section class="p-0">
            <div class="thumb-wrap">
                <img src="{{url('public/b2c/assets/img/banner-7.jpg')}}" class="img-fluid full-width ht-500 object-fit" alt="" height="20%">
            </div>
        </section>
        <!-- ============================ Articles Thumb Section ================================== -->
        <!-- ============================ Articles Deatil Section ================================== -->
        <section class="p-0 position-relative mt-n6">
            <div class="container">
                <div class="row g-4">
                    <!-- Article content -->
                    <div class="col-11 col-lg-10 mx-auto">
                        <div class="bg-white shadow rounded-4 p-4">
                            <!-- Badge -->
                            <div class="d-inline-flex mb-2"><span class="label text-success bg-light-success">{{$blog->b_category}}</span></div>
                            <!-- Title -->
                            <h1 class="fs-3">{{$blog->b_title}}</h1>
                            <p class="mb-3">{{$blog->s_description.'...'}}</p>

                            <!-- List -->
                            <ul class="nav nav-divider align-items-center p-0">
                                <li class="nav-item ps-0">
                                    <div class="nav-link">
                                        <div class="d-flex align-items-center">
                                            <!-- Avatar -->
                                            <div class="avatar avatar-lg">
                                                <img class="avatar-img circle" src="{{Url('public/user.png')}}" alt="avatar">
                                            </div>
                                            <!-- Info -->
                                            <div class="ms-2">
                                                <h6 class="mb-0"><a href="#">{{$blog->p_by}}</a></h6>
                                                <p class="mb-0"><span>{{$blog->time}}</span><span class="text-muted-2 mx-2"></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Articles Detail Section End ================================== -->
        <!-- ============================ Article Description ========================================== -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 mx-auto" style="text-align: justify;">
                        {!! json_decode($blog->details) !!}
                        <br><br>
                        {!!   @json_decode($blog->map_location) !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================ Article Description ========================================== -->
        <section class="pt-0">
            <div class="container">

                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                        <div class="secHeading-wrap text-center mb-5">
                            <h2>Trending & Popular Articles</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center g-4">
                    @foreach($blogs as $blo)
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                            <div class="blogGrid-wrap d-flex flex-column h-100">
                                <div class="blogGrid-pics">
                                    <a href="{{url('/blog/'.$blo->slug)}}" class="d-block"><img src="{{url('/'.$blo->b_c_photo)}}" class="img-fluid rounded" alt="Blog image"></a>
                                </div>
                                <div class="blogGrid-caps pt-3">
                                    <div class="d-flex align-items-center mb-1"><span
                                            class="label text-success bg-light-success">{{$blo->b_category}}</span></div>
                                    <h4 class="fw-bold fs-6 lh-base"><a href="{{url('/blog/'.$blo->slug)}}" class="text-dark">{{$blo->b_title}}</a></h4>
                                    <a class="text-primary fw-medium" href="{{url('/blog/'.$blo->slug)}}">Read More<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

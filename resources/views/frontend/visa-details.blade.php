@extends('frontend.layout.body')
@section('title','Trip Designer - Visa  - The Best Visa Service Provider in Bangladesh.')
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

        <!-- ============================ Hero Banner  Start================================== -->
        <div class="py-5 bg-primary position-relative">
            <div class="container">
                <!-- Search Form -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                        <div class="search-wrap position-relative my-3">
                            {{ Form::open(array('url' => 'search-visa',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                            <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                <div class="col-xl-8 col-lg-7 col-md-12">
                                    <div class="row gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class=" form-control fw-bold">
                                                    <option value="Bangladesh" selected>Bangladesh</option>
                                                </select>
                                            </div>
                                        </div>
                                        <?php
                                            if(@$visa->country)
                                                $_GET['country'] = $visa->country;
                                        ?>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                            <div class="form-group hdd-arrow mb-0">
                                                <select class="goingto form-control fw-bold" name="country" required>
                                                    <option value="">Select Country</option>
                                                    @foreach($v_country as $country)
                                                        <option value="{{$country->name}}" <?php if($country->name == $_GET['country']) echo 'selected';  ?>>{{$country->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-5 col-md-12">
                                    <div class="row align-items-end gy-3 gx-md-3 gx-sm-2">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                            <div class="form-group mb-0">
                                                <button type="submit" class="btn btn-whites text-primary full-width fw-medium"><i
                                                        class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================ Hero Banner End ================================== -->

        <section class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-5">
                        <ul class="nav nav-pills primary nav-fill gap-2 p-2  bg-light-primary rounded-2" id="pillstour-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2 active" id="pills-overview-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview"
                                        aria-selected="true"><h4 style="color: white;">{{$visa->title}}</h4></button>
                                <p>{{$c_info->name}} Authorized Visa Submitting Agents of Embassy in Dhaka, Bangladesh</p>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row">
                            <div class="col-xl-9 col-lg-9 col-md-12">
                                <div class="tab-content" id="pillstour-tabContent">
                                    <div class="tab-pane fade show active" id="pills-overview" role="tabpanel"
                                         aria-labelledby="pills-overview-tab" tabindex="0">
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Documents Required for {{$_GET['country']}}  Tourist Visa</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! json_decode(@$visa->requirements) !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5"> Price Details</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! json_decode(@$visa->price_details) !!}
                                                </div>
                                            </div>
                                            <div class="card border rounded-3 mb-4">
                                                <div class="card-header">
                                                    <h4 class="fs-5"> Embassy Information</h4>
                                                </div>
                                                <div class="card-body">
                                                    {!! json_decode(@$visa->em_info) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sidebar -->
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="sides-block">
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <p class="font10 lh-1 mb-0"><b>For Booking Please Contact Us: </b></p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Phone: </b> {{$c_info->phone1}}</p><hr>
                                            <p class="font10 lh-1 mb-0"><b>Email: </b>{{$c_info->email}}</p>
                                        </div>
                                    </div>
                                    <div class="card border rounded-3 mb-4">
                                        <div class="single-card px-3 py-3">
                                            <button class="btn btn-sm btn-primary full-width fw-medium text-uppercase mb-2"
                                                    type="button"  data-bs-toggle="modal" data-bs-target="#visa-request">proceed to book </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="row justify-content-center gy-3 gx-xl-3 gx-lg-4 gx-4">
                                    @foreach($visas as $visa)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                            <div class="pop-touritem">
                                                <a href="{{url('visa/'.$visa->slug)}}" class="card rounded-3 border br-dashed m-0">
                                                    <div class="flight-thumb-wrapper p-2 pb-0">
                                                        <div class="popFlights-item-overHidden rounded-3">
                                                            <img src="{{@$domain.'/'.$visa->v_c_photo}}" class="img-fluid" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="touritem-middle position-relative p-3">
                                                        <div class="touritem-flexxer">
                                                            <div class="explot">
                                                                <h4 class="city fs-6 m-0 fw-bold">
                                                                    <span>{{$visa->country}} Visa</span>
                                                                </h4>
                                                            </div>
                                                        </div>
                                                        <div class="booking-wrapes d-flex align-items-center mt-3">
                                                            <button class="btn btn-md btn-light-primary fw-medium rounded full-width me-2">View Requirements</button>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="modal fade" id="visa-request" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered login-pop-form" role="document">
            <div class="modal-content" id="loginmodal">
                <div class="modal-header">
                    <h4 class="modal-title fs-6">Request for Your Booking.</h4>
                    <a href="#" class="text-muted fs-4" data-bs-dismiss="modal" aria-label="Close"><i
                            class="fa-solid fa-square-xmark"></i></a>
                </div>
                <div class="modal-body">
                    <div class="modal-login-form py-4 px-md-3 px-0">
                        {{ Form::open(array('url' => 'order-request',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control" name="name" placeholder="Write Full Name" required>
                                        <label>Name*</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-4">
                                        <input type="number" class="form-control" min="11"  name="phone" placeholder="Write Phone Number" required>
                                        <label>Phone*</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control"  name="email" placeholder="Write Email" required>
                                        <label>Email*</label>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-floating mb-4">
                                        <input type="text" class="form-control"  name="person" placeholder="Write Person Number" required>
                                        <label>Person*</label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-floating mb-4">
                                        <textarea  class="form-control" rows="3" name="remarks" placeholder="Write Remarks..."></textarea>
                                        <label>Remarks*</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="view" value="{{url()->full()}}">
                                <input type="hidden" name="r_type" value="Visa">
                                <button type="submit" class="btn btn-primary full-width font--bold btn-lg">Send Query</button>
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

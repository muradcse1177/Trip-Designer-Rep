@extends('frontend.layout.body')
@section('title','Trip Designer - Tour Package - The Best Tour Package Provider in Bangladesh.')
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
{{--            <br><br>--}}
        @endif
        <!-- End Navigation -->
        <div class="clearfix"></div>
        <section class="pt-4 gray-simple position-relative">
            <div class="container">
                <div class="row align-items-start">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="div-title d-flex align-items-center mb-3">
                            <h4>Guests Detail</h4>
                        </div>
                        {{ Form::open(array('url' => 'make-payment-tour',  'method' => 'post','class' => 'mt-4 text-start')) }}
                        {{ csrf_field() }}
                        <div class="row align-items-start">
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                @for($i = 0;$i<$adult; $i++)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Adult No: {{$i +1}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control" name="ad_f_name[]" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control" name="ad_l_name[]" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input type="date" name="ad_dob[]" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Passport Number</label>
                                                        <input type="text" class="form-control" name="ad_passport[]" placeholder="Passport Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                @for($i = 0;$i<$child; $i++)
                                    <div class="card mb-3">
                                        <div class="card-header">
                                            <h4>Child No: {{$i +1}}</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" name="ch_f_name[]" class="form-control" placeholder="First Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" name="ch_l_name[]" class="form-control" placeholder="Last Name" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Date of Birth</label>
                                                        <input type="date" name="ch_dob[]" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Passport Number</label>
                                                        <input type="text" name="ch_passport[]" class="form-control" placeholder="Passport Number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h4>Lead Contact Person Details</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" name="c_f_name" class="form-control" placeholder="First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" name="c_l_name" class="form-control" placeholder="Last Name" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label">Country Code</label>
                                                    <select class="form-control" name="phoneCode" required>
                                                            <option value="880">+880</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4">
                                                <div class="form-group">
                                                    <label class="form-label">Phone</label>
                                                    <input type="number" name="phone" class="form-control" maxlength="10" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-4 col-md-12">
                                <div class="side-block card rounded-2 p-3">
                                    <h5 class="fw-semibold fs-6">Reservation Summary</h5>
                                    <div class="mid-block rounded-2 border br-dashed p-2 mb-3">
                                        <div class="row align-items-center justify-content-between g-2 mb-4">
                                            <div class="col-6">
                                                <div class="gray rounded-2 p-2">
                                                    <span class="d-block text-muted-3 text-sm fw-medium text-uppercase mb-2">Check-In</span>
                                                    <p class="text-dark fw-semibold lh-base text-md mb-0">{{$checkin}}</p>
                                                    <span class="text-dark text-md">From 14:00</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="gray rounded-2 p-2">
                                                    <span class="d-block text-muted-3 text-sm fw-medium text-uppercase mb-2">Check-Out</span>
                                                    <p class="text-dark fw-semibold lh-base text-md mb-0">{{$checkout}}</p>
                                                    <span class="text-dark text-md">To 11:50</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                            $date1 = new DateTime($checkin);
                                            $date2 = new DateTime($checkout);

                                            $diff = $date1->diff($date2);
                                        ?>
                                        <div class="row align-items-center justify-content-between mb-4">
                                            <div class="col-12">
                                                <p class="text-muted-2 text-sm text-uppercase fw-medium mb-1">Total Length of Stay:</p>
                                                <div class="d-flex align-items-center">
                                                    <div class="square--30 circle text-seegreen bg-light-seegreen"><i
                                                            class="fa-regular fa-calendar"></i></div><span class="text-dark fw-semibold ms-2">{{$diff->days}} Days \
                                                            {{$diff->days-1}} Night</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-12">
                                                <p class="text-muted-2 text-sm text-uppercase fw-medium mb-1">Your Selected Package</p>
                                                <div class="d-flex align-items-center flex-column">
                                                    <p class="mb-0"><a href="{{url('tour-package/'.$tour_details->slug)}}" class="fw-medum text-primary">{{$tour_details->p_name}}</p>
                                                    <p class="mb-0"><a href="{{url('tour-package')}}" class="fw-medum text-primary"> Change your Selection</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bott-block d-block mb-3">
                                        <h5 class="fw-semibold fs-6">Your Price Summary</h5>
                                        <ul class="list-group list-group-borderless">
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="fw-medium mb-0">Adult Price</span>
                                                <span class="fw-semibold">{{$c_info->currency}} {{number_format($tour_details->p_p_adult*$adult, 2)}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="fw-medium mb-0">Child Price</span>
                                                <span class="fw-semibold">{{$c_info->currency}} {{number_format($tour_details->p_p_child*$child, 2)}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="fw-medium mb-0">VAT,Taxes and AIT</span>
                                                <span class="fw-semibold">{{$c_info->currency}} 0.00</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span class="fw-medium text-success mb-0">Total Price</span>
                                                <span class="fw-semibold text-success">{{$c_info->currency}} {{number_format($tour_details->p_p_adult*$adult + $tour_details->p_p_child*$child, 2)}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="bott-block">
                                        <div class="searchBar-single-wrap">
                                            <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2 mb-0">
                                                <li class="col-12">
                                                    <div class="form-check lg">
                                                        <div class="frm-slicing d-flex align-items-center">
                                                            <div class="frm-slicing-first">
                                                                <input class="form-check-input" type="checkbox" id="hyundai" required>
                                                                <label class="form-check-label" for="hyundai"></label>
                                                            </div>
                                                            <div class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                                                <div class="frms-flex d-flex align-items-center">
                                                                    <div class="frm-slicing-title ps-2">
                                                                        <span class="text-muted-2">I agreed with
                                                                            <a href="{{url('privacy-policy')}}">Privacy Policy , </a>
                                                                            <a href="{{url('terms-conditions')}}">Terms & Conditions , </a>
                                                                            <a href="{{url('refund-policy')}}">Refund Policy</a>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <input type="hidden" name="tour-id" value="{{$tour_details->id}}">
                                        <button type="submit" class="btn fw-medium btn-primary full-width">Make Payment</button>
                                    </div>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

{{--                    <div class="col-xl-12 col-lg-12 col-md-12">--}}
{{--                        <div class="text-center d-flex align-items-center justify-content-center mt-4">--}}
{{--                            <a href="booking-page.html" class="btn btn-md btn-dark fw-semibold mx-2"><i--}}
{{--                                    class="fa-solid fa-arrow-left me-2"></i>Previous</a>--}}
{{--                            <a href="bookingpage-03.html" class="btn btn-md btn-primary fw-semibold mx-2">Make Your Payment<i--}}
{{--                                    class="fa-solid fa-arrow-right ms-2"></i></a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </section>

@endsection
@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[maxlength]').forEach(input => {
                input.addEventListener('input', e => {
                    let val = e.target.value, len = +e.target.getAttribute('maxlength');
                    e.target.value = val.slice(0,len);
                })
            })
        })
    </script>
@endsection

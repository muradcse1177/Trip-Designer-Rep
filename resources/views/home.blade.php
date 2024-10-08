@extends('frontend.layout.body')
@section('title','Trip Designer - Home - The Biggest and Prominent Travel Agency in Bangladesh.')
@section('css')
@endsection
@section('content')
    <div class="image-cover hero-header bg-white" style="background:url({{url('/public/b2c/assets/images/a.jpg')}})no-repeat; height: 60%;">
        <div class="container">

            <!-- Search Form -->
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="search-wrap bg-white rounded-3 p-3">
                        <ul class="nav nav-pills primary-soft medium justify-content-left mb-3" id="tour-pills-tab" role="tablist">
                            <?php
                            $useragent=$_SERVER['HTTP_USER_AGENT'];
                            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                                $a = 'a';
                            ?>

{{--                            <li class="nav-item">--}}
{{--                                <a class="nav-link active" data-bs-toggle="tab" href="#flights"><i class="fa-solid fa-jet-fighter me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Flights';?></a>--}}
{{--                            </li>--}}
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#tours"><i class="fa-solid fa-umbrella-beach me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Tour Package';?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-bs-toggle="tab" href="#visa"><i class="fa-solid fa-passport me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Visa';?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link " data-bs-toggle="tab" href="#work-permit"><i class="fa-solid fa-solid fa-user-secret me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Work Permit';?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#hajj-umrah"><i class="fa-solid fa-kaaba me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Hajj Umrah';?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#education"><i class="fa-solid fa-graduation-cap me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'Education';?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#services"><i class="fa-solid fa-kaaba me-2"></i> <?php if(@$a == 'a') echo ''; else  echo 'services';?></a>
                            </li>
                        </ul>
                        <div class="tab-content">
{{--                            <div class="tab-pane show active" id="flights">--}}
{{--                                <ul class="nav nav-pills primary-soft medium justify-content-center mb-3" id="tour-pills-tab" role="tablist">--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link active" data-bs-toggle="tab" href="#oneWay"> One Way</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-bs-toggle="tab" href="#round"> Round Trip</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="nav-item">--}}
{{--                                        <a class="nav-link" data-bs-toggle="tab" href="#multi"> Multi City</a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}

{{--                                <div class="tab-content">--}}
{{--                                    <div class="tab-pane show active" id="oneWay">--}}
{{--                                        {{ Form::open(array('url' => '',  'method' => 'get' ,'class' =>'form-horizontal')) }}--}}
{{--                                        <div class="row gx-lg-2 g-3">--}}
{{--                                            <div class="col-xl-6 col-lg-6 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">--}}
{{--                                                        <div class="form-group hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold" type="text" id="departure" name="departure" value="DAC,Dhaka" placeholder="Enter City or Airport Name">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="btn-flip-icon mt-md-0">--}}
{{--                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>--}}
{{--                                                        </div>--}}
{{--                                                        <div id="suggesstion-box"></div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-groupp hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold " type="text" id="arrival" name="arrival" value="CXB,Cox's Bazar" placeholder="Enter City or Airport Name">--}}
{{--                                                            <div id="suggesstion-box1"></div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-4 col-lg-4 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <input class="form-control fw-bold choosedate" name="dep_date" type="text" value="<?php echo date("Y-m-d", time() + 86400); ?>" placeholder="Departure Date.." readonly="readonly">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <div class="booking-form__input guests-input mixer-auto">--}}
{{--                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>--}}
{{--                                                                <input type="hidden" name="adult" id="adult" value="">--}}
{{--                                                                <input type="hidden" name="child" id="child" value="">--}}
{{--                                                                <input type="hidden" name="infant" id="infant" value="">--}}
{{--                                                                <div class="guests-input__options" id="guests-input-options">--}}
{{--                                                                    <div>--}}
{{--                                                                        <span class="guests-input__ctrl minus" id="adults-subs-btn"><i--}}
{{--                                                                                class="fa-solid fa-minus"></i></span>--}}
{{--                                                                            <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>--}}
{{--                                                                            <span class="guests-input__ctrl plus" id="adults-add-btn"><i--}}
{{--                                                                                    class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--                                                                        <span class="guests-input__ctrl minus" id="children-subs-btn"><i--}}
{{--                                                                                class="fa-solid fa-minus"></i></span>--}}
{{--                                                                            <span class="guests-input__value"><span id="guests-count-children">0</span>Children 0-12 Years</span>--}}
{{--                                                                            <span class="guests-input__ctrl plus" id="children-add-btn"><i--}}
{{--                                                                                    class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--                                                                        <span class="guests-input__ctrl minus" id="room-subs-btn"><i--}}
{{--                                                                                class="fa-solid fa-minus"></i></span>--}}
{{--                                                                            <span class="guests-input__value"><span id="guests-count-room">0</span>Infant</span>--}}
{{--                                                                            <span class="guests-input__ctrl plus" id="room-add-btn"><i--}}
{{--                                                                                    class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-1 col-lg-1 col-md-12">--}}
{{--                                                <div class="form-group hdd-arrow mb-0">--}}
{{--                                                    <select class="Infant form-control fw-bold" name="f_class">--}}
{{--                                                        <option value="Economy">Economy</option>--}}
{{--                                                        <option value="Premium Economy">Premium Economy</option>--}}
{{--                                                        <option value="Business">Business</option>--}}
{{--                                                        <option value="FirstClass">First Class</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-1 col-lg-1 col-md-12">--}}
{{--                                                <div class="form-group mb-0">--}}
{{--                                                    <input type="hidden" name="f_type" value="Oneway">--}}
{{--                                                    <button type="submit" class="btn btn-primary full-width fw-medium loadingstart"><i--}}
{{--                                                            class="fa-solid fa-magnifying-glass fs-5"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        {{ Form::close() }}--}}
{{--                                    </div>--}}

{{--                                    <div class="tab-pane" id="round">--}}
{{--                                        <div class="row gx-lg-2 g-3">--}}
{{--                                            <div class="col-xl-4 col-lg-4 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">--}}
{{--                                                        <div class="form-group hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold " type="text" placeholder="Departure">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="btn-flip-icon mt-md-0">--}}
{{--                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-groupp hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold " type="text" placeholder="Arrival">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-6 col-lg-6 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Departure Date.." readonly="readonly">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Arrival Date.." readonly="readonly">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <div class="booking-form__input guests-input mixer-auto">--}}
{{--                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>--}}
{{--                                                                <div class="guests-input__options" id="guests-input-options">--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="adults-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="adults-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="children-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-children">0</span>Children</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="children-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="room-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-room">0</span>Rooms</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="room-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-1 col-lg-1 col-md-12">--}}
{{--                                                <div class="form-group hdd-arrow mb-0">--}}
{{--                                                    <select class="Infant form-control fw-bold">--}}
{{--                                                        <option value="Economy">Economy</option>--}}
{{--                                                        <option value="Business">Business</option>--}}
{{--                                                        <option value="FirstClass">First Class</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-1 col-lg-1 col-md-12">--}}
{{--                                                <div class="form-group mb-0">--}}
{{--                                                    <button type="button" class="btn btn-primary full-width fw-medium"><i--}}
{{--                                                            class="fa-solid fa-magnifying-glass fs-5"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="tab-pane" id="multi">--}}
{{--                                        <div class="row gx-lg-2 g-3">--}}
{{--                                            <div class="col-xl-4 col-lg-4 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">--}}
{{--                                                        <div class="form-group hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold " type="text" placeholder="Departure">--}}
{{--                                                        </div>--}}
{{--                                                        <div class="btn-flip-icon mt-md-0">--}}
{{--                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-groupp hdd-arrow mb-0">--}}
{{--                                                            <input class="form-control fw-bold " type="text" placeholder="Arrival">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-5 col-lg-5 col-md-12">--}}
{{--                                                <div class="row gy-3 gx-lg-2 gx-3">--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Departure Date.." readonly="readonly">--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">--}}
{{--                                                        <div class="form-group mb-0">--}}
{{--                                                            <div class="booking-form__input guests-input mixer-auto">--}}
{{--                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>--}}
{{--                                                                <div class="guests-input__options" id="guests-input-options">--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="adults-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="adults-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="children-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-children">0</span>Children</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="children-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                    <div>--}}
{{--																	<span class="guests-input__ctrl minus" id="room-subs-btn"><i--}}
{{--                                                                            class="fa-solid fa-minus"></i></span>--}}
{{--                                                                        <span class="guests-input__value"><span id="guests-count-room">0</span>Rooms</span>--}}
{{--                                                                        <span class="guests-input__ctrl plus" id="room-add-btn"><i--}}
{{--                                                                                class="fa-solid fa-plus"></i></span>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-2 col-lg-2 col-md-12">--}}
{{--                                                <div class="form-group hdd-arrow mb-0">--}}
{{--                                                    <select class="Infant form-control fw-bold">--}}
{{--                                                        <option value="Economy">Economy</option>--}}
{{--                                                        <option value="Business">Business</option>--}}
{{--                                                        <option value="FirstClass">First Class</option>--}}
{{--                                                    </select>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <div class="col-xl-1 col-lg-1 col-md-12">--}}
{{--                                                <div class="form-group mb-0">--}}
{{--                                                    <button type="button" class="btn btn-primary full-width fw-medium"><i--}}
{{--                                                            class="fa-solid fa-plus fs-5"></i></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

                            <div class="tab-pane show active" id="tours">
                                {{ Form::open(array('url' => 'search-tour-package',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row gy-3 gx-md-3 gx-sm-2">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 position-relative">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class=" form-control fw-bold">
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 position-relative">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="goingto form-control fw-bold" name="country" required>
                                                        @foreach($t_country as $country)
                                                        <option value="{{$country->name}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control fw-bold" placeholder="Check-In & Check-Out" name="checkinout" id="checkinout" readonly="readonly" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary full-width fw-medium"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane show" id="visa">
                                {{ Form::open(array('url' => 'search-visa',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row gy-3 gx-md-3 gx-sm-2">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class=" form-control fw-bold">
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="goingto form-control fw-bold" name="country" required>
                                                        <option value="">Select Country</option>
                                                        @foreach($v_country as $coun)
                                                            <option value="{{$coun->name}}">{{$coun->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary full-width fw-medium"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                            <div class="tab-pane show" id="work-permit">
                                {{ Form::open(array('url' => 'search-manpower',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row gy-3 gx-md-3 gx-sm-2">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class=" form-control fw-bold">
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="goingto form-control fw-bold" name="country" required>
                                                        <option value="">Select Country</option>
                                                        @foreach($m_country as $countt)
                                                            <option value="{{$countt->name}}">{{$countt->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary full-width fw-medium"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>

                            <div class="tab-pane show" id="hajj-umrah">
                                {{ Form::open(array('url' => 'search-hajj-umrah-package',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row gy-3 gx-md-3 gx-sm-2">
                                    <div class="col-xl-8 col-lg-7 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class=" form-control fw-bold">
                                                        <option value="Bangladesh" selected>Bangladesh</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="goingto form-control fw-bold" name="country" required>
                                                        <option value="">Select Country</option>
                                                        @foreach($m_country as $countt)
                                                            <option value="{{$countt->name}}">{{$countt->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-5 col-md-12">
                                        <div class="row gy-3 gx-md-3 gx-sm-2">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-group mb-0">
                                                    <button type="submit" class="btn btn-primary full-width fw-medium"><i class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
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
            <!-- </row> -->

        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Popular Attraction Start ================================== -->
    <section>
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                    <div class="secHeading-wrap text-center mb-5">
                        <h2>Best Visa Service  From Bangladesh </h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center gy-4 gx-xl-3 gx-lg-4 gx-4">
                @foreach($visas as $visa)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="pop-touritem">
                        <a href="{{'visa/'.$visa->slug}}" class="card rounded-3 border br-dashed m-0">
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
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center position-relative mt-5">
                        <a type="button" href="{{url('visa')}}" class="btn btn-light-primary fw-medium px-5">Explore More<i
                                class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Popular Attraction Start ================================== -->

    <!-- ============================ Popular Venues Start ================================== -->
    <section>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                    <div class="secHeading-wrap text-center mb-5">
                        <h2>Hot & Trending Tour Packages</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gy-4 gx-xl-3 gx-lg-4 gx-4">
                @foreach($t_package as $package)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="pop-touritem">
                            <a href="{{url('tour-package/'.$package->slug)}}" class="card rounded-3 border br-dashed m-0">
                                <div class="flight-thumb-wrapper p-2 pb-0">
                                    <div class="popFlights-item-overHidden rounded-3">
                                        <img src="{{@$domain.'/'.$package->p_c_photo}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="touritem-middle position-relative p-3">
                                    <div class="touritem-flexxer">
                                            <?php
                                            $include = json_decode($package->include);
                                            ?>
                                        <div class="tourist-wooks position-relative mb-3">
                                            <ul class="activities-flex">
                                                @if(@$include[0] = 'Hotel')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-hotel"></i></div>
                                                            <div class="actv-wrap-caps">Hotel</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[1] = 'SightSeeing')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-person-walking-luggage"></i></div>
                                                            <div class="actv-wrap-caps">SightSeeing</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[2] = 'Transfer')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-bus"></i></div>
                                                            <div class="actv-wrap-caps">Transfers</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[3] = 'Meal')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-kitchen-set"></i></div>
                                                            <div class="actv-wrap-caps">Meal</div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="explot">
                                            <h4 class="city fs-title m-0 fw-bold">
                                                <span>{{$package->p_name}} &nbsp;<strong><i class="fa-solid fa-star text-warning me-1"></i>{{floatval(rand(4,5))}}</strong></span>
                                            </h4>
                                        </div>
                                        <div class="touritem-amenties my-4">
                                            <ul class="activities-flex">
                                                <li>
                                                    <div class="actv-wrap">
                                                        <div class="actv-wrap-caps text-dark fw-bold fs-6"><span class="text-dhani me-1">{{$package->night}}</span>Night {{$package->night +1}} Days</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h5 class="fs-5 low-price m-0">{{$c_info->currency}}
                                                        <span class="price text-primary"> &nbsp; {{$package->p_p_adult}} {{$c_info->symbol}}</span>
                                                    </h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="booking-wrapes d-flex align-items-center mt-3">
                                        <button class="btn btn-md btn-light-primary fw-medium rounded full-width me-2">Request Book<i class="fa-solid fa-arrow-trend-up ms-2"></i></button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center position-relative mt-5">
                        <a href="{{url('tour-package')}}" type="button" class="btn btn-light-primary fw-medium px-5">Explore More<i
                                class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Popular Venues Start ================================== -->

    <section>
        <div class="container">

            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                    <div class="secHeading-wrap text-center mb-5">
                        <h2>Best Work Permit Visa Service  From Bangladesh </h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center gy-4 gx-xl-3 gx-lg-4 gx-4">
                @foreach($permits as $permit)
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                        <div class="pop-touritem">
                            <a href="{{'manpower/'.$permit->slug}}" class="card rounded-3 border br-dashed m-0">
                                <div class="flight-thumb-wrapper p-2 pb-0">
                                    <div class="popFlights-item-overHidden rounded-3">
                                        <img src="{{@$domain.'/'.$permit->c_photo}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="touritem-middle position-relative p-3">
                                    <div class="touritem-flexxer">
                                        <div class="explot">
                                            <h4 class="city fs-6 m-0 fw-bold">
                                                <span>{{$permit->country}} Work permit Visa</span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="booking-wrapes d-flex align-items-center mt-3">
                                        <button class="btn btn-md btn-light-primary fw-medium rounded full-width me-2">View Details</button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center position-relative mt-5">
                        <a type="button" href="{{url('work-permit')}}" class="btn btn-light-primary fw-medium px-5">Explore More<i
                                class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-8 col-lg-9 col-md-11 col-sm-12">
                    <div class="secHeading-wrap text-center mb-5">
                        <h2>Hot & Trending Hajj & Umrah Packages</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center gy-4 gx-xl-3 gx-lg-4 gx-4">
                @foreach($u_packages as $u_package)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                        <div class="pop-touritem">
                            <a href="{{url('hajj-umrah/'.$u_package->slug)}}" class="card rounded-3 border br-dashed m-0">
                                <div class="flight-thumb-wrapper p-2 pb-0">
                                    <div class="popFlights-item-overHidden rounded-3">
                                        <img src="{{@$domain.'/'.$u_package->p_c_photo}}" class="img-fluid" alt="">
                                    </div>
                                </div>
                                <div class="touritem-middle position-relative p-3">
                                    <div class="touritem-flexxer">
                                            <?php
                                            $include = json_decode($u_package->include);
                                            ?>
                                        <div class="tourist-wooks position-relative mb-3">
                                            <ul class="activities-flex">
                                                @if(@$include[0] = 'Hotel')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-hotel"></i></div>
                                                            <div class="actv-wrap-caps">Hotel</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[1] = 'SightSeeing')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-person-walking-luggage"></i></div>
                                                            <div class="actv-wrap-caps">SightSeeing</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[2] = 'Transfer')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-bus"></i></div>
                                                            <div class="actv-wrap-caps">Transfers</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[3] = 'Meal')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-kitchen-set"></i></div>
                                                            <div class="actv-wrap-caps">Meal</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[4] = 'Visa')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-brands fa-cc-visa"></i></div>
                                                            <div class="actv-wrap-caps">Visa</div>
                                                        </div>
                                                    </li>
                                                @endif
                                                @if(@$include[5] = 'Flight')
                                                    <li>
                                                        <div class="actv-wrap">
                                                            <div class="actv-wrap-ico"><i class="fa-solid fa-rocket"></i></div>
                                                            <div class="actv-wrap-caps">Flight</div>
                                                        </div>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="explot">
                                            <h4 class="city fs-title m-0 fw-bold">
                                                <span>{{$u_package->p_name}} &nbsp;<strong><i class="fa-solid fa-star text-warning me-1"></i>{{floatval(rand(4,5))}}</strong></span>
                                            </h4>
                                        </div>
                                        <div class="touritem-amenties my-4">
                                            <ul class="activities-flex">
                                                <li>
                                                    <div class="actv-wrap">
                                                        <div class="actv-wrap-caps text-dark fw-bold fs-6"><span class="text-dhani me-1">{{$u_package->night}}</span>Night {{$u_package->night +1}} Days</div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <h5 class="fs-5 low-price m-0">{{$c_info->currency}}
                                                        <span class="price text-primary"> &nbsp; {{$u_package->p_p_adult}} {{$c_info->symbol}}</span>
                                                    </h5>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="booking-wrapes d-flex align-items-center mt-3">
                                        <button class="btn btn-md btn-light-primary fw-medium rounded full-width me-2">Request Book<i class="fa-solid fa-arrow-trend-up ms-2"></i></button>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-12 col-lg-12 col-md-12">
                    <div class="text-center position-relative mt-5">
                        <a href="{{url('tour-package')}}" type="button" class="btn btn-light-primary fw-medium px-5">Explore More<i
                                class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================================ Article Section Start ======================================= -->
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
                @foreach($blogs as $blog)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
                    <div class="blogGrid-wrap d-flex flex-column h-100">
                        <div class="blogGrid-pics">
                            <a href="{{url('/blog/'.$blog->slug)}}" class="d-block"><img src="{{@$domain.'/'.$blog->b_c_photo}}" class="img-fluid rounded" alt="Blog image"></a>
                        </div>
                        <div class="blogGrid-caps pt-3">
                            <div class="d-flex align-items-center mb-1"><span
                                    class="label text-success bg-light-success">{{$blog->b_category}}</span></div>
                            <h4 class="fw-bold fs-6 lh-base"><a href="{{url('/blog/'.$blog->slug)}}" class="text-dark">{{$blog->b_title}}</a></h4>
                            <p class="mb-3" style="text-align: justify;">{{substr($blog->s_description,'0',200).'...'}}</p>
                            <a class="text-primary fw-medium" href="{{url('/blog/'.$blog->slug)}}">Read More<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
@section('js')
<script>
    $("#departure").on('keyup',function() {
        if($.trim($("#departure").val()).length >= 3){
            var val = $("#departure").val();
            $.ajax({
                type: "GET",
                url: "{{url('getAirportDetails')}}",
                data: {'code':val,"_token": "{{ csrf_token() }}",},
                cache: false,
                success: function(data)
                {
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(data);
                }
            });
        }
    });
    function selectCountry(val) {
        $("#departure").val(val);
        $("#suggesstion-box").hide();
    }

    $("#arrival").on('keyup',function() {
        if($.trim($("#arrival").val()).length >= 3){
            var val = $("#arrival").val();
            $.ajax({
                type: "GET",
                url: "{{url('getAirportDetails1')}}",
                data: {'code':val,"_token": "{{ csrf_token() }}",},
                cache: false,
                success: function(data)
                {
                    $("#suggesstion-box1").show();
                    $("#suggesstion-box1").html(data);
                }
            });
        }
    });
    function selectCountry1(val) {
        $("#arrival").val(val);
        $("#suggesstion-box1").hide();
    }
    <?php
        if(@$errorMas){
            $error = $errorMas;
            echo 'swal('.@$error.')';
        }
    ?>

</script>
@endsection

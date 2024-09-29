@extends('frontend.layout.body')
@section('title','Trip Designer -Air Ticket - The Best Air Ticket Service Provider in Bangladesh.')
@section('content')
    <br><br>
    <div class="clearfix"></div>
    <div class="py-5 bg-primary position-relative">
        <div class="container">
            <!-- Search Form -->
            <div class="row justify-content-center align-items-center">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="search-wrap bg-white rounded-3 p-3">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="flights">
                                <ul class="nav nav-pills primary-soft medium justify-content-center mb-3" id="tour-pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#oneWay"> One Way</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#round"> Round Trip</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#multi"> Multi City</a>
                                    </li>
                                </ul>
                                <?php
                                    $flight_arr = Session::get('flight_arr');
                                    $useragent=$_SERVER['HTTP_USER_AGENT'];
                                    if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                                        $a = 'a';
                                    else
                                        $a='b';
                                ?>
                                <div class="tab-content">
                                    <div class="tab-pane show active" id="oneWay">
                                        {{ Form::open(array('url' => 'flight-search-result',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                        <div class="row gx-lg-2 g-3">
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                        <div class="form-group hdd-arrow mb-0">
                                                            <input class="form-control fw-bold" type="text" id="departure" name="departure" value="{{@$flight_arr['dep_city']}}" placeholder="Enter City or Airport Name">
                                                        </div>
                                                        <div class="btn-flip-icon mt-md-0">
                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>
                                                        </div>
                                                        <div id="suggesstion-box"></div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-groupp hdd-arrow mb-0">
                                                            <input class="form-control fw-bold " type="text" id="arrival" name="arrival" value="{{@$flight_arr['arr_city']}}" placeholder="Enter City or Airport Name">
                                                            <div id="suggesstion-box1"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-group mb-0">
                                                            <input class="form-control fw-bold choosedate" name="dep_date" type="text" value="{{@$flight_arr['dep_date']}}" placeholder="Departure Date.." readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-group mb-0">
                                                            <div class="booking-form__input guests-input mixer-auto">
                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>
                                                                <input type="hidden" name="adult" id="adult" value="{{@$flight_arr['adt']}}">
                                                                <input type="hidden" name="child" id="child" value="{{@$flight_arr['chd']}}">
                                                                <input type="hidden" name="infant" id="infant" value="{{@$flight_arr['inf']}}">
                                                                <div class="guests-input__options" id="guests-input-options">
                                                                    <div>
                                                                        <span class="guests-input__ctrl minus" id="adults-subs-btn"><i
                                                                                class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>
                                                                        <span class="guests-input__ctrl plus" id="adults-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="guests-input__ctrl minus" id="children-subs-btn"><i
                                                                                class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-children">0</span>Children 0-12 Years</span>
                                                                        <span class="guests-input__ctrl plus" id="children-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
                                                                        <span class="guests-input__ctrl minus" id="room-subs-btn"><i
                                                                                class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-room">0</span>Infant</span>
                                                                        <span class="guests-input__ctrl plus" id="room-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="Infant form-control fw-bold" name="f_class">
                                                        <option value="Economy" <?php if($flight_arr['f_class'] == 'Economy') echo 'selected'; ?> >Economy</option>
                                                        <option value="Premium Economy" <?php if($flight_arr['f_class'] == 'Premium Economy') echo 'selected'; ?> >Premium Economy</option>
                                                        <option value="Business" <?php if($flight_arr['f_class'] == 'Business') echo 'selected'; ?> >Business</option>
                                                        <option value="FirstClass" <?php if($flight_arr['f_class'] == 'FirstClass') echo 'selected'; ?> >First Class</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12">
                                                <div class="form-group mb-0">
                                                    <input type="hidden" name="f_type" value="Oneway">
                                                    <button type="submit" class="btn btn-primary full-width fw-medium loadingstart"><i
                                                            class="fa-solid fa-magnifying-glass fs-5"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::close() }}
                                    </div>

                                    <div class="tab-pane" id="round">
                                        <div class="row gx-lg-2 g-3">
                                            <div class="col-xl-4 col-lg-4 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                        <div class="form-group hdd-arrow mb-0">
                                                            <input class="form-control fw-bold " type="text" placeholder="Departure">
                                                        </div>
                                                        <div class="btn-flip-icon mt-md-0">
                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-groupp hdd-arrow mb-0">
                                                            <input class="form-control fw-bold " type="text" placeholder="Arrival">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-6 col-lg-6 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                        <div class="form-group mb-0">
                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Departure Date.." readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                        <div class="form-group mb-0">
                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Arrival Date.." readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
                                                        <div class="form-group mb-0">
                                                            <div class="booking-form__input guests-input mixer-auto">
                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>
                                                                <div class="guests-input__options" id="guests-input-options">
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="adults-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>
                                                                        <span class="guests-input__ctrl plus" id="adults-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="children-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-children">0</span>Children</span>
                                                                        <span class="guests-input__ctrl plus" id="children-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="room-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-room">0</span>Rooms</span>
                                                                        <span class="guests-input__ctrl plus" id="room-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="Infant form-control fw-bold">
                                                        <option value="Economy">Economy</option>
                                                        <option value="Business">Business</option>
                                                        <option value="FirstClass">First Class</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12">
                                                <div class="form-group mb-0">
                                                    <button type="button" class="btn btn-primary full-width fw-medium"><i
                                                            class="fa-solid fa-magnifying-glass fs-5"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="multi">
                                        <div class="row gx-lg-2 g-3">
                                            <div class="col-xl-4 col-lg-4 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 position-relative">
                                                        <div class="form-group hdd-arrow mb-0">
                                                            <input class="form-control fw-bold " type="text" placeholder="Departure">
                                                        </div>
                                                        <div class="btn-flip-icon mt-md-0">
                                                            <button class="p-0 m-0 text-primary"><i class="fa-solid fa-right-left"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-groupp hdd-arrow mb-0">
                                                            <input class="form-control fw-bold " type="text" placeholder="Arrival">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-12">
                                                <div class="row gy-3 gx-lg-2 gx-3">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-group mb-0">
                                                            <input class="form-control fw-bold choosedate" type="text" placeholder="Departure Date.." readonly="readonly">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
                                                        <div class="form-group mb-0">
                                                            <div class="booking-form__input guests-input mixer-auto">
                                                                <button name="guests-btn" id="guests-input-btn">1 Guest</button>
                                                                <div class="guests-input__options" id="guests-input-options">
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="adults-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-adults">1</span>Adults</span>
                                                                        <span class="guests-input__ctrl plus" id="adults-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="children-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-children">0</span>Children</span>
                                                                        <span class="guests-input__ctrl plus" id="children-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                    <div>
																	<span class="guests-input__ctrl minus" id="room-subs-btn"><i
                                                                            class="fa-solid fa-minus"></i></span>
                                                                        <span class="guests-input__value"><span id="guests-count-room">0</span>Rooms</span>
                                                                        <span class="guests-input__ctrl plus" id="room-add-btn"><i
                                                                                class="fa-solid fa-plus"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-2 col-lg-2 col-md-12">
                                                <div class="form-group hdd-arrow mb-0">
                                                    <select class="Infant form-control fw-bold">
                                                        <option value="Economy">Economy</option>
                                                        <option value="Business">Business</option>
                                                        <option value="FirstClass">First Class</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-1 col-lg-1 col-md-12">
                                                <div class="form-group mb-0">
                                                    <button type="button" class="btn btn-primary full-width fw-medium"><i
                                                            class="fa-solid fa-plus fs-5"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="pt-3 gray-simple">
    <div class="container">
        <div class="row">
            <!-- Flight Info -->
            <div class="col-xl-12 col-lg-12 col-md-12">
                {{ Form::open(array('url' => 'flight-booking', 'method' => 'post', 'id' => 'flightBookingForm')) }}
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-xl-9 col-lg-8 col-md-12">
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="crd-block d-md-flex align-items-start justify-content-start">
                                    <div class="crd-heaader-0 flex-shrink-0 mb-3 mb-md-0">
                                        <div class="square--70 rounded-2 bg-light-primary text-primary fs-3"><i class="fa-solid fa-plane"></i></div>
                                    </div>
                                    <div class="crd-heaader-first ps-md-3">
                                        <div class="d-inline-flex align-items-center mb-1">
                                            <span class="label fw-medium bg-light-success text-success">{{@$flight_arr['f_class']}}</span>
                                        </div>
                                        <div class="d-block">
                                            <h4 class="mb-0">{{@$flight_arr['dep_city']}}
                                                <span class="text-muted-2 mx-3">
                                                    @if($flight_arr['f_type'] == 'Oneway')
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    @else
                                                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                                                    @endif
                                                </span>{{@$flight_arr['arr_city']}}
                                            </h4>
                                            <div class="explotter-info">
                                                <p class="detail ellipsis-container fw-semibold">
                                                    <span class="ellipsis-item__normal">{{ $flight_arr['dep_date']}}</span>
{{--                                                    <span class="separate ellipsis-item__normal"></span>--}}
{{--                                                    <span class="ellipsis-item">2 Stop</span>--}}
{{--                                                    <span class="separate ellipsis-item__normal"></span>--}}
{{--                                                    <span class="ellipsis-item">06H 10Min</span>--}}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        <?php
                        $traceId = $flights->response->traceId;
                        $offersGroups = $flights->response->offersGroup;
                        $inc= 0;
                        ?>
                        @foreach($offersGroups as $offersGroup)
                        <div class="card border-0 mb-4">
                            <div class="card-body">
                                <div class="flights-accordion">
                                    <div class="flights-list-item">
                                        <div class="row gy-4 align-items-center justify-content-between">
                                            <div class="col">
                                                <div class="row">
                                                    <?php
                                                        $paxSegmentLists = $offersGroup->offer->paxSegmentList;
                                                        $paxSegmentListsCount = count($paxSegmentLists);
                                                    ?>
                                                    @foreach($paxSegmentLists as $paxSegmentList)
                                                            <?php
                                                                $a_code= DB::table('airlines_details')->where('code',''.$paxSegmentList->paxSegment->marketingCarrierInfo->carrierDesigCode.'')->first();
                                                                $ar_logo = empty($a_code->logo) ? "" : $a_code->logo;
                                                            ?>
                                                        <div class="col-xl-12 col-lg-12 col-md-12">
                                                            <div class="row gx-lg-5 gx-3 gy-4 align-items-center">
                                                                <div class="col-sm-auto">
                                                                    <div class="d-flex align-items-center justify-content-start">
                                                                        <div class="d-start fl-pic">
                                                                            <div class="text-dark" style="font-size: 14px;">{{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierDesigCode.' - '.$paxSegmentList->paxSegment->marketingCarrierInfo->marketingCarrierFlightNumber.'('.$paxSegmentList->paxSegment->iatA_AircraftType->iatA_AircraftTypeCode.')'}}</div>

                                                                            <img class="img-fluid" src="{{url($ar_logo)}}" width="45" alt="image">
                                                                            <div class="text-dark" style="font-size: 14px;"> {{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierName}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="row gx-3 align-items-center">
                                                                        <div class="col-auto">
                                                                            <?php
                                                                                $dateTimedetails = explode('T',$paxSegmentList->paxSegment->departure->aircraftScheduledDateTime);
                                                                                $date = $dateTimedetails[0];
                                                                                $date = date("D,d F Y", strtotime($date));
                                                                                $time = substr($dateTimedetails[1], 0, 5);
                                                                                $minutes = $paxSegmentList->paxSegment->duration;
                                                                                $hours = floor($minutes / 60);
                                                                                $min = $minutes - ($hours * 60);
                                                                                $t_time = $hours.".".$min.' Hours' ;
                                                                                $a_city = DB::table('airport_details')->where('iata_codes',''.$paxSegmentList->paxSegment->departure->iatA_LocationCode.'')->first();
                                                                            ?>
                                                                            <div class="text-dark text-medium fw-bold">{{$a_city->city}} ({{$paxSegmentList->paxSegment->departure->iatA_LocationCode}}) - {{$time}}</div>
                                                                            <div class="text-dark fw-sm">{{$date}}</div>
                                                                        </div>
                                                                        <div class="col text-center">
                                                                            <div class="flightLine departure">
                                                                                <div></div>
                                                                                <div></div>
                                                                            </div>
                                                                            <div class="text-dark text-sm fw-medium mt-3">{{$t_time}}</div>
                                                                        </div>

                                                                        <div class="col-auto">
                                                                            <?php
                                                                                $dateTimedetails1 = explode('T',$paxSegmentList->paxSegment->arrival->aircraftScheduledDateTime);
                                                                                $date1 = $dateTimedetails1[0];
                                                                                $date1 = date("D,d F Y", strtotime($date1));
                                                                                $time1 = substr($dateTimedetails1[1], 0, 5);
                                                                                $b_city = DB::table('airport_details')->where('iata_codes',''.$paxSegmentList->paxSegment->arrival->iatA_LocationCode.'')->first();
                                                                            ?>
                                                                            <div class="text-dark text-medium fw-bold">{{$b_city->city}} ({{$paxSegmentList->paxSegment->arrival->iatA_LocationCode}}) - {{$time1}}</div>
                                                                            <div class="text-dark fw-small">{{$date1}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                    $baggageAllowanceLists = $offersGroup->offer->baggageAllowanceList;
                                                                    foreach ($baggageAllowanceLists as $baggage){
                                                                        $bag = $baggage->baggageAllowance->checkIn[0]->allowance;
                                                                    }
                                                                ?>
                                                                <div class="col-md-auto">
                                                                    <div class="text-dark fw-small"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{$bag}}</div>
                                                                    <div class="text-dark fw-small"><i class="fa-solid fa-chair"></i> {{$paxSegmentList->paxSegment->rbd}} - {{$offersGroup->offer->seatsRemaining}}</div>
                                                                    <div class="text-dark text-sm fw-small">{{$paxSegmentList->paxSegment->cabinType}}</div>
                                                                </div>
                                                            </div>
                                                            @if($paxSegmentListsCount > 1)
                                                                <div style="border-top: 1px dashed #04107C; margin-top: 5px; text-align: center; ">
                                                                    <center><div  style="width: 30%; margin-top: -13px; background-color: #c2bfbf;">Transit Time</div></center>
                                                                </div>
                                                            @endif
                                                            <?php
                                                                $paxSegmentListsCount--;
                                                            ?>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        <?php
                            $offersGroups = $flights->response->offersGroup;
                        ?>
                        @foreach($offersGroups as $offersGroup)
                            @foreach($offersGroup->offer->fareDetailList as $fareDetailLists)
                                <?php
                                $paxCount = $fareDetailLists->fareDetail->paxCount;
                                ?>
                                @for($i = 0; $i<$paxCount; $i++)
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                        <input type="hidden" name="offerId" value="{{@$offersGroup->offer->offerId}}">
                                        <div class="card">
                                            <div class="card-header">
                                                <h6 class="fw-semibold mb-0">{{$fareDetailLists->fareDetail->paxType}} {{$i+1}}</h6>
                                            </div>
                                            <div class="card-body">
                                                <div class="full-width d-flex flex-column mb-4 position-relative">
                                                    <div class="row align-items-stat">
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">First Name</label>
                                                                <input type="hidden" name="traceId" value="{{@$traceId}}">
                                                                <input type="text" class="form-control" style="text-transform:uppercase" placeholder="Your First Name" name="f_name[]" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Last Name</label>
                                                                <input type="hidden" name="pax_type[]" value="{{@$fareDetailLists->fareDetail->paxType}}">
                                                                <input type="text" class="form-control" placeholder="Your Last Name" style="text-transform:uppercase" name="l_name[]" required>
                                                                <input type="hidden" name="domestic" value="{{$domestic}}">
                                                            </div>
                                                        </div>
                                                        @if($domestic == 0)
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Passport Number</label>
                                                                <input type="text" class="form-control" style="text-transform:uppercase" placeholder="Passport Number Here" name="p_number[]" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Passport Expire Date</label>
                                                                <input class="form-control fw-bold p_date" type="text" placeholder="Select Date.." name="p_date[]" required>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($fareDetailLists->fareDetail->paxType == 'Adult')
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Date of birth</label>
                                                                <input class="form-control fw-bold adt_dob" type="text" placeholder="Select Date.." name="dob[]" required>
                                                            </div>
                                                        </div>
                                                        @elseif($fareDetailLists->fareDetail->paxType == 'Child')
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Date of birth</label>
                                                                <input class="form-control fw-bold chd_dob" type="text" placeholder="Select Date.." name="dob[]"  required>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Date of birth</label>
                                                                <input class="form-control fw-bold inf_dob" type="text" placeholder="Select Date.." name="dob[]" required>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Nationality</label>
                                                                <select class="select form-control" name="country[]" required>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{$country->iso}}" <?php if($country->iso == 'BD') echo 'selected'; ?> >{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6">
                                                            <div class="form-group">
                                                                <label class="form-label">Gender</label>
                                                                <select class="form-control" name="gender[]" required>
                                                                    <option value="">Select Gender</option>
                                                                    <option value="Male">Male</option>
                                                                    <option value="Female">Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br>
                                @endfor
                            @endforeach
                        @endforeach
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="fw-semibold mb-0">Contact Details</h6>
                                </div>
                                <?php
                                    if(Session::get('user_id')){
                                        $user_id = Session::get('user_id');
                                        $row = DB::table('users')->where('id',$user_id)->first();
                                    }

                                ?>
                                <div class="card-body">
                                    <div class="full-width d-flex flex-column mb-2 position-relative">
                                        <div class="row align-items-stat">
                                            <div class="col-xl-2 col-lg-2 col-md-2">
                                                <div class="form-group">
                                                    <label class="form-label">Country Code</label>
                                                    <select class="select form-control" name="phoneCode" required>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->phonecode}}" <?php if($country->phonecode == '880') echo 'selected'; ?> >{{'+'.$country->phonecode}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Mobile number</label>
                                                    <input type="number" class="form-control" placeholder="Contact Number" value="{{@$row->company_pnone}}" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-xl-5 col-lg-5 col-md-5">
                                                <div class="form-group">
                                                    <label class="form-label">Email Address</label>
                                                    <input type="text" class="form-control" placeholder="Email Here" value="{{@$row->company_email}}" name="email" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $offersGroups = $flights->response->offersGroup;
                        $paxC = 0;
                    ?>
                    @foreach($offersGroups as $offersGroup)
                    <div class="col-xl-3 col-lg-4 col-md-12">
                        <div class="card mb-4 mt-lg-0 mt-4">
                            <div class="card-header"><h4>Price Details</h4></div>
                            <div class="card-body py-2">
                                <div class="price-summary">
                                    <ul class="list-group">
                                        @foreach($offersGroup->offer->fareDetailList as $fareDetailLists)
                                            @if($fareDetailLists->fareDetail->paxType == 'Adult')
                                                <?php $fare_pax = 'Adult';?>
                                            @elseif($fareDetailLists->fareDetail->paxType == 'Child')
                                                <?php $fare_pax = 'Child';?>
                                            @elseif($fareDetailLists->fareDetail->paxType == 'Infant')
                                                <?php $fare_pax = 'Infant';?>
                                            @endif
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                               <b> {{'Passenger'}}
                                                <span class="text-dark">{{$fare_pax}}</span></b>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'Base Fare'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->baseFare.' '. $fareDetailLists->fareDetail->currency}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'TAX'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->tax.' '. $fareDetailLists->fareDetail->currency}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'Other Fees'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->otherFee.' '. $fareDetailLists->fareDetail->currency}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'VAT'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->vat.' '. $fareDetailLists->fareDetail->currency}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'Discount'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->discount.' '. $fareDetailLists->fareDetail->currency}}</span>
                                            </li>
                                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 py-2 px-0">
                                                {{'PAX Count'}}
                                                <span class="text-dark">{{$fareDetailLists->fareDetail->paxCount}}</span>
                                            </li>
                                            <?php
                                                $paxC = $paxC + $fareDetailLists->fareDetail->paxCount;
                                            ?>
                                        @endforeach
                                        <input type="hidden" name="paxCount" value="{{@$paxC}}">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4 mt-lg-0 mt-4">
                            <div class="card-body py-2">
                                <div class="bott-block d-block mb-3">
                                    <h5 class="fw-semibold fs-6">Price Summary</h5>
                                    <ul class="list-group list-group-borderless">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium mb-0">Total Gross Fare</span>
                                            <input type="hidden" name="grossAmount" value="{{$offersGroup->offer->price->gross->total}}">
                                            <span class="fw-semibold">{{$offersGroup->offer->price->gross->total.' '. $fareDetailLists->fareDetail->currency}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
												<span class="fw-medium mb-0">Total VAT & AIT</span>
                                            <span class="fw-semibold">{{$offersGroup->offer->price->totalVAT->total.' '. $fareDetailLists->fareDetail->currency}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium mb-0">Total Discount</span>
                                            <span class="fw-semibold">{{$offersGroup->offer->price->discount->total.' '. $fareDetailLists->fareDetail->currency}}</span>
                                        </li>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span class="fw-medium text-danger mb-0">Grand Total</span>
                                            <input type="hidden" name="grandAmount" value="{{$offersGroup->offer->price->totalPayable->total}}">
                                            <span class="fw-semibold text-danger">{{$offersGroup->offer->price->totalPayable->total.' '. $fareDetailLists->fareDetail->currency}}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
{{--                        <div class="card border rounded-3">--}}
{{--                            <div class="card-header">--}}
{{--                                <h4>Coupons & Offers</h4>--}}
{{--                            </div>--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="form-group position-relative">--}}
{{--                                    <input type="text" class="form-control" placeholder="Have a Coupon Code?" value="">--}}
{{--                                    <a href="#" class="position-absolute top-50 end-0 fw-semibold translate-middle text-primary disable">Apply</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="col-xl-12 col-lg-12 col-md-12">
                            <button class="btn btn-md full-width px-5 btn-primary fw-medium" type="submit">Submit & Proceed for Payment</button>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ Form::close() }}
            </div>

        </div>
    </div>
    </section>
@endsection
@section('js')
    <script>
        // $("#flightBookingForm").validate({
        //     rules: {
        //         "f_name[]": {
        //             required: true
        //         },
        //         "l_name[]": "required",
        //         "dob[]": "required",
        //         "country[]": "required",
        //         "gender[]": "required",
        //         "p_number[]": "required",
        //         "p_date[]": "required",
        //         "phone": "required",
        //         "email": "required",
        //     },
        //     messages: {
        //         "f_name[]": "Please Write First Name!",
        //         "l_name[]": "Please Write Last Name!",
        //         "dob[]": "Please Select Date of  Birth!",
        //         "country[]": "Please Select Nationality!",
        //         "gender[]": "Please Select Gender!",
        //         "p_number[]": "Please Write Passport Number!",
        //         "p_date[]": "Please Write Passport Expiry!",
        //         "phone": "Please Write Phone Number!",
        //         "email": "Please Write Email!",
        //     }
        // });
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
            $date = $flight_arr['dep_date'];
            $date = strtotime($date);
            $adt_new_date = strtotime('- 12 year', $date);
            $adt_date =  date('Y-m-d', $adt_new_date);
            $chd_new_date = strtotime('- 2 year', $date);
            $chd_date =  date('Y-m-d', $chd_new_date);
        ?>
        $(".adt_dob").flatpickr({
            allowInput: true,
            dateFormat: "Y-m-d",
            maxDate: '<?php echo $adt_date ;?>'
        });
        $(".adt_dob,.chd_dob,.inf_dob,.p_date").keydown(function (event) {
            event.preventDefault();
        });
        $(".chd_dob").flatpickr({
            allowInput: true,
            dateFormat: "Y-m-d",
            maxDate: '{{$chd_date}}',
            minDate: '{{$adt_date}}'
        });
        $(".inf_dob").flatpickr({
            allowInput: true,
            dateFormat: "Y-m-d",
            maxDate: '{{date('Y-m-d')}}',
            minDate: '{{$chd_date}}'
        });
        $(".p_date").flatpickr({
            allowInput: true,
            dateFormat: "Y-m-d",
            maxDate: new Date()
        });

    </script>
@endsection

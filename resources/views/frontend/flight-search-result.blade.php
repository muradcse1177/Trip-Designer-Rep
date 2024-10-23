@extends('frontend.layout.body')
@section('title','Trip Designer -Air Ticket - The Best Air Ticket Service Provider in Bangladesh.')
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
        <!-- ============================ All Flits Search Lists Start ================================== -->
        <section class="gray-simple">
            <div class="container">
                <div class="row justify-content-between gy-4 gx-xl-4 gx-lg-3 gx-md-3 gx-4">

                    <!-- Sidebar Filter Options -->
                    @include('frontend.include.flight-filter')
                    <!-- All Flight Lists -->
                    <div class="col-xl-9 col-lg-8 col-md-12">

                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-4 col-lg-4 col-md-4">
                                <h5 class="fw-bold fs-6 mb-lg-0 mb-3">Showing 280 Search Results</h5>
                            </div>
                            <div class="col-xl-8 col-lg-8 col-md-12">
                                <div class="d-flex align-items-center justify-content-start justify-content-lg-end flex-wrap">
                                    <div class="flsx-first me-2">
                                        <div class="bg-white rounded py-2 px-3">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch" id="mapoption">
                                                <label class="form-check-label ms-1" for="mapoption">Map</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flsx-first mt-sm-0 mt-2">
                                        <ul class="nav nav-pills nav-fill p-1 small lights blukker bg-primary rounded-3 shadow-sm"
                                            id="filtersblocks" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active rounded-3" id="trending" data-bs-toggle="tab" type="button"
                                                        role="tab" aria-selected="true">Our Trending</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-3" id="mostpopular" data-bs-toggle="tab" type="button"
                                                        role="tab" aria-selected="false">Most Popular</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link rounded-3" id="lowprice" data-bs-toggle="tab" type="button" role="tab"
                                                        aria-selected="false">Lowest Price</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center g-4 mt-2">
                            <?php
                            $traceId = $flights->response->traceId;
                            $offersGroups = $flights->response->offersGroup;
                            $inc= 0;
                            ?>
                            @foreach($offersGroups as $offersGroup)
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="flights-accordion">
                                    <div class="flights-list-item bg-white rounded-3 p-3">
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
                                                            @if(@$a == 'a')
                                                            @else
                                                                <div class="col-sm-auto">
                                                                    <div class="d-flex align-items-center justify-content-start">
                                                                        <div class="d-start fl-pic">
                                                                            <div class="text-dark" style="font-size: 14px;">{{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierDesigCode.' - '.$paxSegmentList->paxSegment->marketingCarrierInfo->marketingCarrierFlightNumber.'('.$paxSegmentList->paxSegment->iatA_AircraftType->iatA_AircraftTypeCode.')'}}</div>

                                                                            <img class="img-fluid" src="{{url($ar_logo)}}" width="45" alt="image">
                                                                            <div class="text-dark" style="font-size: 14px;"> {{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierName}}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            <div class="col">
                                                                <div class="row gx-3 align-items-center">
                                                                    <div class="col-auto">
                                                                        @if(@$a == 'a')
                                                                        <div class="text-dark" style="font-size: 14px;">
                                                                            {{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierName}}</div>
                                                                        @endif
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
                                                                        @if(@$a == 'a')
                                                                        <img class="img-fluid" src="{{url($ar_logo)}}" width="45" alt="image">
                                                                        @endif
                                                                        <div class="flightLine departure">
                                                                            <div></div>
                                                                            <div></div>
                                                                        </div>
                                                                        <div class="text-dark text-sm fw-medium mt-3">{{$t_time}}</div>
                                                                    </div>

                                                                    <div class="col-auto">
                                                                        @if(@$a == 'a')
                                                                            <div class="text-dark" style="font-size: 14px;"> {{$paxSegmentList->paxSegment->marketingCarrierInfo->carrierDesigCode.' - '.$paxSegmentList->paxSegment->marketingCarrierInfo->marketingCarrierFlightNumber.'('.$paxSegmentList->paxSegment->iatA_AircraftType->iatA_AircraftTypeCode.')'}}</div>
                                                                        @endif
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
                                                            @if(@$a=='a')
                                                            @else
                                                                <?php
                                                                    $baggageAllowanceLists = $offersGroup->offer->baggageAllowanceList;
                                                                    foreach ($baggageAllowanceLists as $baggage){
                                                                        $bag = $baggage->baggageAllowance->checkIn[0]->allowance;
                                                                    }
                                                                ?>
                                                                <div class="col-md-auto">
                                                                    <div class="text-dark fw-small"><i class="fa fa-shopping-bag" aria-hidden="true"></i> {{$bag}}</div>
                                                                    <div class="text-dark fw-small"><i class="fa-solid fa-chair"></i> {{$paxSegmentList->paxSegment->rbd}} - {{$offersGroup->offer->seatsRemaining}}</div>
                                                                    <div class="text-dark text-sm fw-small">{{$_GET['f_class']}}</div>
                                                                </div>
                                                            @endif
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
                                            <div class="col-md-auto">
                                                <div class="d-flex items-center h-100">
                                                    <div class="d-lg-block d-none border br-dashed me-4"></div>
                                                    <div>
                                                        <div class="text-start text-md-end">
                                                            <span class="label bg-light-success text-success me-1"><del style="color: red;">Gross Fare: {{$offersGroup->offer->price->gross->total}} BDT</del></span>
                                                            <div class="text-dark fs-5 fw-bold lh-base">{{$offersGroup->offer->price->totalPayable->total}} BDT</div>
                                                                <?php
                                                                    if($offersGroup->offer->refundable == 'true')
                                                                        $ref = 'Refundable';
                                                                    else{
                                                                        $ref = 'Non Refundable';
                                                                    }
                                                                    $url = 'flight-details?traceId='.$traceId.'&offerId='.$offersGroup->offer->offerId;
                                                                ?>
                                                            <div class="text-muted text-sm mb-2">{{$ref}}</div>
                                                            @if(@$a == 'a')
                                                                <div class="" style="float: right; text-align: right; margin-left: 300px; margin-top: -80px;">
                                                                    <a href="{{url($url)}}" class="btn btn-primary btn-md fw-medium full-width loadingstart">Select Flight<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        @if(@$a =='b')
                                                            <div class="flight-button-wrap" style="float: right;">
                                                                <a href="{{url($url)}}" class="btn btn-primary btn-md fw-medium full-width loadingstart" >Select Flight<i class="fa-solid fa-arrow-trend-up ms-2"></i></a>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="col-xl-12 col-lg-12 col-12">
                                <div class="pags card py-2 px-5">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination m-0 p-0">
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Previous">
                                                    <span aria-hidden="true"><i class="fa-solid fa-arrow-left-long"></i></span>
                                                </a>
                                            </li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item">
                                                <a class="page-link" href="#" aria-label="Next">
                                                    <span aria-hidden="true"><i class="fa-solid fa-arrow-right-long"></i></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- ============================ All Flits Search Lists End ================================== -->
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
    </script>
@endsection

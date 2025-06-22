@extends('frontend.layout.body')
@section('title','Trip Designer - Blog  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('css')

@endsection
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
        <!-- ============================ Articles Thumb Section ================================== -->
        <?php
            $c_photo_url = json_decode($course->c_p_photo);
        ?>
        <section class="bg-cover position-relative" style="background:url({{url($c_photo_url)}})no-repeat;" data-overlay="5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">
                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions">
                                <h1 class="xl-heading text-light">{{$course->title}}</h1>
                                <p class="text-light">{{substr(json_decode($course->c_descripsion), 0, 200)}}</p>
                                <button type="button" class="btn btn-warning"><b>Enroll Now</b></button>
                                <button type="button"  style="background-color: #060e57; color: white;" class="btn"><b>Price: {{$course->c_price}} {{$c_info->currency.' '}}</b></button>
                            </div>
                        </div>
                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions">
                                <a class="btn btn-success btn-sm">{{$course->type}}</a>
                                <a class="btn btn-danger btn-sm">Total Class: {{$course->class_no}}</a>
                                <a class="btn btn-info btn-sm">Batch No: {{$course->batch_no}}</a>
                                <a class="btn btn-dark btn-sm">Rating: {{$course->star}} &#9733;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="table-responsive bg-light p-3">
                            <table class="table mb-0">
                                <tbody>
                                    <tr class="align-middle text-nowrap">
                                        <!-- Next Batch Start -->
                                        <td class="border-end pe-4">
                                            <div class="fw-semibold">
                                                <i class="fas fa-school text-warning"></i>
                                                Next Batch Start</div>
                                            <?php
                                                $appDates = json_decode($course->app_date, true); // decode as associative array
                                                $firstDate = $appDates[0];
                                            ?>
                                            <span class="badge bg-light text-primary border border-primary">Date: {{$firstDate}}</span>
                                        </td>

                                        <!-- Live Class -->
                                        <td class="border-end px-4">
                                            <div class="mb-1 fw-semibold">
                                                <i class="fas fa-clock text-warning me-1"></i>
                                                Live Class
                                            </div>
                                            <div>
                                                8:30 PM to 9:30 PM (Approx)
{{--                                                <span class="text-muted">(SUN, TUE, THU)</span>--}}
                                            </div>
                                        </td>

                                        <!-- Remaining Seat -->
                                        <td class="ps-4">
                                            <div class="mb-1 fw-semibold">
                                                <i class="fas fa-desktop text-warning me-1 "></i>
                                                Remaining Seat
                                            </div>
                                            <div>{{$course->seat_remain}} Seats</div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <center><br>
                        <div class="row g-3">
                            <!-- Countdown -->
                            <div class="col-12 col-sm-4">
                                <div class="countdown-box d-grid gap-2">
                                    <button class="btn btn-danger" type="button">
                                        <b>Offer Ends:
                                            <span id="hours">--</span> Hours :
                                            <span id="minutes">--</span> Minutes :
                                            <span id="seconds">--</span> Seconds
                                        </b>
                                    </button>
                                </div>
                            </div>

                            <!-- Spacer / Optional Content -->
                            <div class="col-12 col-sm-4">
                                <!-- You can add extra content or keep this empty for spacing -->
                            </div>

                            <!-- Enroll Button -->
                            <div class="col-12 col-sm-4">
                                <div class="d-grid gap-2">
                                    <button class="btn btn-warning" type="button"><b>Enroll Now</b></button>
                                </div>
                            </div>
                        </div>
                    </center>
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-5">
                        <br>
                        <ul class="nav nav-pills primary nav-fill gap-2 p-2  bg-light-primary rounded-2" id="pillstour-tab"
                            role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2 active" id="pills-overview-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-overview" type="button" role="tab" aria-controls="pills-overview"
                                        aria-selected="true">Curriculum</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2" id="pills-itinerary-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-itinerary" type="button" role="tab" aria-controls="pills-itinerary"
                                        aria-selected="false">Instructor</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link rounded-2" id="pills-bonus-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bonus" type="button" role="tab" aria-controls="pills-bonus"
                                        aria-selected="false">Extra Bonus</button>
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
                                                    <h4 class="fs-5">Course Description</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-6 mb-3">
                                                            <div class="card shadow-sm border border-primary">
                                                                <div class="card-body">
                                                                    {{ Str::limit(json_decode($course->c_descripsion), 200) }}
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="card shadow-sm border border-primary">
                                                                <div class="ratio ratio-16x9">
                                                                    <iframe
                                                                        src="{{ $course->y_link }}"
                                                                        title="YouTube video"
                                                                        allowfullscreen>
                                                                    </iframe>
                                                                </div>
                                                                <div class="card-body">
                                                                    <h5 class="card-title">{{ $course->title }}</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Course Module</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                                        <?php
                                                            $curriculums = json_decode($course->curriculum);
                                                            $i  =0;
                                                            $bonuses = json_decode($course->g_course);
                                                            $instructors = json_decode($course->instructor);
                                                            $reviews = json_decode($course->review);
                                                        ?>
                                                        @foreach($curriculums as $curriculum)
                                                            @if($i==0)
                                                            <div class="accordion-item border">
                                                                <h2 class="accordion-header rounded-2">
                                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                                            data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                                                                        {{$curriculum->module}}
                                                                    </button>
                                                                </h2>
                                                                <div id="flush-collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                                    <div class="accordion-body">
                                                                        {{$curriculum->details}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                                <div class="accordion-item border rounded-2">
                                                                    <h2 class="accordion-header">
                                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                                                data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                                                                            {{$curriculum->module}}
                                                                        </button>
                                                                    </h2>
                                                                    <div id="flush-collapse{{$i}}" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                                                        <div class="accordion-body">
                                                                            {{$curriculum->details}}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                                    <?php
                                                                        $i ++;
                                                                    ?>
                                                        @endforeach
                                                    </div>
                                                    <center><br>
                                                        <div class="col-sm-4">
                                                            <div class="d-grid gap-2">
                                                                <button class="btn btn-warning" type="button"><b>Enroll Now </b></button>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Extra Bonus</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row g-4">
                                                        @foreach($bonuses as $bonus)
                                                            <div class="col-12 col-sm-6 col-lg-3">
                                                                <div class="card h-100 shadow-sm text-center border border-primary">
                                                                    <img src="{{ url('public/tick.png') }}" class="rounded-circle mx-auto mt-3" style="width: 100px; height: 100px; object-fit: cover;" alt="Reviewer 1">
                                                                    <div class="card-body">
                                                                        <p class="card-text">{{ $bonus }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-itinerary" role="tabpanel"
                                         aria-labelledby="pills-itinerary-tab" tabindex="0">
                                        <!-- Itinerary -->
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Course Instructor</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="row g-4">
                                                            @foreach($instructors as $instructor)
                                                                <div class="col-12 col-sm-6 col-lg-4">
                                                                    <div class="card h-100 shadow-sm text-center border border-primary">
                                                                        <img src="{{ url($instructor->photo) }}" class="rounded-circle mx-auto mt-3" style="width: 100px; height: 100px; object-fit: cover;" alt="Instructor Photo">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title">Name: {{ $instructor->name }}</h5>
                                                                            <h6 class="card-title">Designations: {{ $instructor->designation }}</h6>
                                                                            <p class="card-text">Institute: {{ $instructor->institute }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="pills-bonus" role="tabpanel"
                                         aria-labelledby="pills-bonus-tab" tabindex="0">
                                        <!-- Itinerary -->
                                        <div class="overview-wrap full-width">
                                            <div class="card mb-4 border rounded-3">
                                                <div class="card-header">
                                                    <h4 class="fs-5">Extra Bonus</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="row g-4">
                                                            @foreach($bonuses as $bonus)
                                                                <div class="col-12 col-sm-6 col-lg-3">
                                                                    <div class="card h-100 shadow-sm text-center border border-primary">
                                                                        <img src="{{ url('public/tick.png') }}" class="rounded-circle mx-auto mt-3" style="width: 100px; height: 100px; object-fit: cover;" alt="Reviewer 1">
                                                                        <div class="card-body">
                                                                            <p class="card-text">{{ $bonus }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12">
                                <div class="sides-block">
                                    <div class="card border rounded-3 mb-4 border border-primary">
                                        <div class="single-card px-3 py-3">
                                            <p class="font10 lh-1 mb-0"><b>Total Course Price</b></p><hr>
                                            <p class="font11 lh-1 mb-0"><b>Course Price: <del>{{$c_info->currency.' '}} {{number_format($course->c_price,2)}}</del></b></p><hr>
                                            <p class="font12 lh-1 mb-0"><b>Grand Price:</b><span class="text-danger fs-4 fw-bold"><span> {{number_format($course->d_c_price, 2)}} {{$c_info->currency.' '}}</span></span></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button class="btn btn-warning" type="button"><b>Enroll Now</b></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <center><br>
                        <div class="col-sm-4">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="button"><b>Students Review </b></button>
                            </div>
                        </div>
                    </center>
                    <div class="col-xl-12 col-lg-12 col-md-12"><br>
                        <div class="card-body">
                            <div class="row g-4">
                                @foreach($reviews as $review)
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <div class="card h-100 shadow-sm p-3 border border-primary">
                                            <div class="d-flex align-items-center mb-2">
                                                <img src="{{ url($review->photo) }}" alt="Reviewer Photo" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                                                <h6 class="mb-0">{{ $review->name }}</h6>
                                            </div>
                                            <p class="card-text">{{ $review->review }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <center><br>
                        <div class="col-sm-4">
                            <div class="d-grid gap-2">
                                <button class="btn btn-warning" type="button"><b>Enroll Now </b></button>
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </section>


    </div>
@endsection
@section('js')
    <script>
        $('p img').css('width', '100%');
        const now = new Date();
        const countDownDate = new Date(
            now.getFullYear(),
            now.getMonth(),
            now.getDate(),
            23, 59, 59
        ).getTime();

        // Update every second
        const x = setInterval(function () {
            const now = new Date().getTime();
            const distance = countDownDate - now;

            if (distance < 0) {
                clearInterval(x);
                $('.countdown-box').html("Offer has ended!");
                return;
            }

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            $("#days").text(days);
            $("#hours").text(hours);
            $("#minutes").text(minutes);
            $("#seconds").text(seconds);
        }, 1000);
    </script>
@endsection

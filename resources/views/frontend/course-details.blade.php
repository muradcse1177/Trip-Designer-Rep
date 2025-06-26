@extends('frontend.layout.body')
@section('title','Trip Designer - Blog  - The Best Air ticket,Visa and Tour Package Service Provider in Bangladesh.')
@section('css')
    <meta property="og:title" content="{{ $course->title }}">
    <meta property="og:description" content="{{ Str::limit(json_decode($course->c_descripsion), 150) }}">
    <meta property="og:image" content="{{ url(json_decode($course->c_p_photo)) }}">
    <meta name="description" content="{{ Str::limit(json_decode($course->c_descripsion), 150) }}">
@endsection
@section('content')
    <div id="main-wrapper">
        <?php
            $c_photo_url = json_decode($course->c_p_photo);
        ?>
        <section class="bg-cover position-relative" style="background:url({{url($c_photo_url)}})no-repeat;" data-overlay="5">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-md-12">
                        <div class="d-flex flex-row flex-wrap justify-content-center align-items-center gap-2 mt-3">
                            <button type="button" class="btn btn-warning w-auto" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                <b>Enroll Now</b>
                            </button>

                            <button type="button" class="btn w-auto" style="background-color: #060e57; color: white;">
                                <b>
                                    @if($course->d_c_price < $course->c_price)
                                        <span style="text-decoration: line-through; opacity: 0.7; margin-right: 8px;">
                    {{ $c_info->currency }} {{ number_format($course->c_price, 2) }}
                </span>
                                    @endif
                                    <span class="text-warning">
                {{ $c_info->currency }} {{ number_format($course->d_c_price, 2) }}
            </span>
                                </b>
                            </button>
                        </div>


                        <div class="fpc-capstion text-center my-4">
                            <div class="fpc-captions d-flex flex-wrap justify-content-center gap-2">
                                <a class="btn btn-success btn-sm">{{ $course->type }}</a>
                                <a class="btn btn-danger btn-sm">Total Class: {{ $course->class_no }}</a>
                                <a class="btn btn-info btn-sm">Batch No: {{ $course->batch_no }}</a>
                                <a class="btn btn-dark btn-sm">Rating: {{ $course->star }} &#9733;</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Modal -->
        @php
            $user = Session::get('user_info');
        @endphp

        <div class="modal fade" id="enrollModal" tabindex="-1" aria-labelledby="enrollModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h5 class="modal-title" id="enrollModalLabel">Enroll in Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <form method="POST" action="{{ route('course.enroll', $course->id) }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $user['company_name'] ?? '') }}" required>
                            </div>

                            <!-- Country Code + Phone -->
                            <div class="row">
                                <div class="col-4">
                                    <div class="mb-3">
                                        <label class="form-label">Country Code</label>
                                        <input type="text" name="country_code" class="form-control" value="+88" readonly>
                                    </div>
                                </div>

                                <div class="col-8">
                                    <div class="mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                               pattern="^(?:\+8801|8801|01)[3-9]\d{8}$"
                                               maxlength="11"
                                               inputmode="numeric"
                                               value="{{ old('phone', $user['company_pnone'] ?? '') }}"
                                               placeholder="e.g. 017XXXXXXXX"
                                               required>
                                    </div>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ old('email', $user['company_email'] ?? '') }}"
                                       placeholder="e.g. example@gmail.com"
                                       required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Course Price</label>
                                <input type="text"
                                       class="form-control fw-bold"
                                       value="{{ $c_info->currency }} {{ number_format($course->d_c_price, 2) }}"
                                       readonly
                                       disabled>
                            </div>
                            <!-- Footer -->
                            <div class="modal-footer p-0 pt-3">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Make Payment</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>


        <section class="pt-3">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="row g-3">
                            <!-- Next Batch Start -->
                            <div class="col-12 col-md-4">
                                <div class="card border border-warning shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="fw-semibold mb-2 text-warning">
                                            <i class="fas fa-school me-1"></i>
                                            Next Batch Start
                                        </div>
                                        <?php
                                        $appDates = json_decode($course->app_date, true);
                                        $firstDate = $appDates[0] ?? 'N/A';
                                        ?>
                                        <span class="badge bg-warning text-dark">
                        Date: {{ $firstDate }}
                    </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Live Class -->
                            <div class="col-12 col-md-4">
                                <div class="card border border-info shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="fw-semibold mb-2 text-info">
                                            <i class="fas fa-clock me-1"></i>
                                            Live Class
                                        </div>
                                        <div>8:30 PM to 9:30 PM (Approx)</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Remaining Seat -->
                            <div class="col-12 col-md-4">
                                <div class="card border border-success shadow-sm h-100">
                                    <div class="card-body">
                                        <div class="fw-semibold mb-2 text-success">
                                            <i class="fas fa-desktop me-1"></i>
                                            Remaining Seat
                                        </div>
                                        <div>{{ $course->seat_remain }} Seats</div>
                                    </div>
                                </div>
                            </div>
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
                                    <button type="button" class="btn btn-warning w-auto" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                        <b>Enroll Now</b>
                                    </button>
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
                                                                    {{ Str::limit(json_decode($course->c_descripsion), 1000) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $videoId = '';
                                                            $url = json_decode($course->y_link);

                                                            if ($url) {
                                                                $query = parse_url($url, PHP_URL_QUERY);
                                                                parse_str($query, $params);
                                                                $videoId = $params['v'] ?? '';
                                                            }
                                                        @endphp
                                                        <div class="col-sm-6">
                                                            <div class="card shadow-sm border border-primary">
                                                                @if($videoId)
                                                                    <div class="ratio ratio-16x9">
                                                                        <iframe
                                                                            src="https://www.youtube.com/embed/{{ $videoId }}"
                                                                            title="YouTube video"
                                                                            allowfullscreen>
                                                                        </iframe>
                                                                    </div>
                                                                @else
                                                                    <p class="text-danger">Invalid YouTube URL</p>
                                                                @endif
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
                                                                <button type="button" class="btn btn-warning w-auto" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                                                    <b>Enroll Now</b>
                                                                </button>
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
                                    <button type="button" class="btn btn-warning w-auto" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                        <b>Enroll Now</b>
                                    </button>
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
                                <button type="button" class="btn btn-warning w-auto" data-bs-toggle="modal" data-bs-target="#enrollModal">
                                    <b>Enroll Now</b>
                                </button>
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

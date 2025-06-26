@extends('frontend.layout.body')
@section('title', 'Booking Details')
@section('content')

    <div class="container py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white">Booking Details</h5>
                <a href="{{ url('download-course-details/' . $order->transaction_id) }}" class="btn btn-light btn-sm">
                    <i class="fa fa-download me-1"></i> Download
                </a>
            </div>

            <div class="card-body">
                <h5 class="mb-3">{{ $order->title }}</h5>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <p><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
                        <p><strong>Booking Date:</strong> {{ \Carbon\Carbon::parse($order->time)->format('d M Y') }}</p>
                        <p><strong>Amount Paid:</strong> ৳{{ number_format($order->amount, 2) }}</p>
                    </div>

                    <div class="col-md-6">
                        <p><strong>Course Type:</strong> {{ $order->type }}</p>
                        <p><strong>Batch No:</strong> {{ $order->batch_no }}</p>
                        <p><strong>Class Time:</strong> {{ $order->class_time }}</p>
                        <p><strong>Seat Remain:</strong> {{ $order->seat_remain }}</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-6">
                        {{-- ✅ Course Description --}}
                        @php
                            $courseDescription = json_decode($order->c_descripsion, true);
                        @endphp

                        @if(!empty($courseDescription))
                            <div class="mt-4">
                                <h5 class="mb-3">Course Description</h5>

                                @if(is_array($courseDescription))
                                    @foreach($courseDescription as $para)
                                        <p class="text-muted">{{ $para }}</p>
                                    @endforeach
                                @else
                                    <p class="text-muted">{{ $courseDescription }}</p>
                                @endif
                            </div>
                        @else
                            <div class="mt-4">
                                <h5 class="mb-3">Course Description</h5>
                                <p class="text-muted">No course description available.</p>
                            </div>
                        @endif

                        {{-- ✅ Instructors --}}
                        <h6 class="mt-4">Instructors</h6>
                        <div class="row">
                            @php
                                $instructors = json_decode($order->instructor);
                            @endphp

                            @if(!empty($instructors))
                                @foreach($instructors as $instructor)
                                    <div class="col-md-6 mb-3 d-flex">
                                        <img src="{{ url($instructor->photo) }}" alt="{{ $instructor->name }}" width="60" class="me-3 rounded-circle border">
                                        <div>
                                            <strong>{{ $instructor->name }}</strong><br>
                                            <small>{{ $instructor->designation }}<br>{{ $instructor->institute }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No instructor information available.</p>
                            @endif
                        </div>

                        {{-- ✅ Curriculum --}}
                        <h5 class="mb-3">Course Curriculum</h5>
                        @php
                            $curriculums = json_decode($order->curriculum);
                        @endphp

                        @if(!empty($curriculums))
                            <div class="accordion" id="curriculumAccordion">
                                @foreach($curriculums as $index => $item)
                                    <div class="accordion-item mb-2">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index !== 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                                                Module {{ $index + 1 }}: {{ $item->module }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#curriculumAccordion">
                                            <div class="accordion-body">
                                                {{ $item->details }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted">No curriculum information available.</p>
                        @endif
                    </div>

                    {{-- ✅ Course Preview --}}
                    <div class="col-md-6">
                        @php
                            $videoId = '';
                            $url = json_decode($order->y_link);

                            if ($url) {
                                $query = parse_url($url, PHP_URL_QUERY);
                                parse_str($query, $params);
                                $videoId = $params['v'] ?? '';
                            }
                        @endphp
                        <h6>Course Preview</h6>
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
                                <h5 class="card-title">{{ $order->title }}</h5>
                            </div>
                        </div>

                        {{-- Guidance Course (g_course) --}}
                        @php
                            $gCourses = json_decode($order->g_course, true);
                        @endphp

                        @if(!empty($gCourses))
                            <h6 class="mt-3">What You’ll Learn</h6>
                            @if(!empty($gCourses))
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($gCourses as $course)
                                        <div class="bg-light border rounded-pill px-3 py-1 d-flex align-items-center shadow-sm">
                                            <i class="fa fa-check-circle text-success me-2"></i>
                                            <span class="text-dark">{{ $course }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-muted mt-2">No guidance course information available.</p>
                            @endif
                        @else
                            <p class="text-muted mt-2">No guidance course information available.</p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Invoice - {{ $order->transaction_id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #2c3e50;
            font-size: 13px;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #3498db;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .logo {
            width: 140px;
        }
        .invoice-info {
            text-align: right;
        }
        .invoice-info h2 {
            margin: 0;
            color: #3498db;
        }
        .section-title {
            background-color: #3498db;
            color: white;
            padding: 8px 12px;
            margin-top: 30px;
            font-weight: bold;
        }
        .info-table, .curriculum-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th, .info-table td,
        .curriculum-table th, .curriculum-table td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        .curriculum-table th {
            background-color: #f0f0f0;
        }
        .pill-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 10px;
        }
        .pill {
            background-color: #ecf0f1;
            color: #2c3e50;
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
        }
        .pill i {
            color: #27ae60;
            margin-right: 6px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>
<body>

{{-- ✅ Header --}}
<div class="header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <div>
        <img src="{{ public_path('logo.jpg') }}" alt="Company Logo" style="height: 60px;">
    </div>
    <div style="text-align: right;">
        <h2 style="margin: 0;">Booking Invoice</h2>
        <p style="margin: 0;"><strong>Transaction ID:</strong> {{ $order->transaction_id }}</p>
        <p style="margin: 0;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->time)->format('d M Y') }}</p>
    </div>
</div>


{{-- ✅ Course Overview --}}
<div class="section-title">Course Overview</div>
<table class="info-table">
    <tr>
        <th>Course Title</th>
        <td>{{ $order->title }}</td>
        <th>Amount Paid</th>
        <td>৳{{ number_format($order->amount, 2) }}</td>
    </tr>
    <tr>
        <th>Course Type</th>
        <td>{{ $order->type }}</td>
        <th>Batch No</th>
        <td>{{ $order->batch_no }}</td>
    </tr>
    <tr>
        <th>Class Time</th>
        <td>{{ $order->class_time }}</td>
        <th>Seat Remaining</th>
        <td>{{ $order->seat_remain }}</td>
    </tr>
</table>

{{-- ✅ Description --}}
@php $description = json_decode($order->c_descripsion, true); @endphp
@if(!empty($description))
    <div class="section-title">Course Description</div>
    @foreach((array)$description as $para)
        <p style="margin: 5px 0;">{{ $para }}</p>
    @endforeach
@endif

{{-- ✅ Instructors --}}
@php $instructors = json_decode($order->instructor); @endphp
@if(!empty($instructors))
    <div class="section-title">Instructor Details</div>
    <table class="info-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Designation</th>
            <th>Institute</th>
        </tr>
        </thead>
        <tbody>
        @foreach($instructors as $instructor)
            <tr>
                <td>{{ $instructor->name }}</td>
                <td>{{ $instructor->designation }}</td>
                <td>{{ $instructor->institute }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

{{-- ✅ Curriculum --}}
@php $curriculums = json_decode($order->curriculum); @endphp
@if(!empty($curriculums))
    <div class="section-title">Course Curriculum</div>
    <table class="curriculum-table">
        <thead>
        <tr>
            <th>Module</th>
            <th>Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($curriculums as $item)
            <tr>
                <td>{{ $item->module }}</td>
                <td>{{ $item->details }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

{{-- ✅ What You’ll Learn --}}
@php
    $gCourses = json_decode($order->g_course, true);
@endphp

@if(!empty($gCourses))
    <div class="mt-4">
        <h5 class="mb-3 fw-bold text-dark">
            <i class="fa fa-check-circle text-success me-2"></i> What You’ll Learn
        </h5>
        <div class="d-flex flex-wrap gap-2">
            @foreach($gCourses as $item)
                <span class="px-3 py-2 bg-white rounded-pill shadow-sm d-inline-flex align-items-center">
                    <i class="fa fa-check-circle text-success me-2"></i>
                    <span class="text-dark fw-semibold">{{ $item }}</span>
                </span>
            @endforeach
        </div>
    </div>
@endif



{{-- ✅ Footer --}}
<div class="footer">
    Thank you for booking with us. For assistance, contact <strong>sales@tripdesigner.net</strong>
</div>

</body>
</html>

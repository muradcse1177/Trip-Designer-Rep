@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('reportDashboard','active')
@section('report','active')
@section('reportMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Filter Sales Report</h3>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['url' => 'report-dashboard', 'method' => 'GET']) !!}
                        <div class="form-row align-items-end">
                            <div class="form-group col-md-4 col-sm-6">
                                {!! Form::label('start_date', 'Start Date') !!}
                                {!! Form::date('start_date', request('start_date') ?? date('Y-m-01'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-4 col-sm-6">
                                {!! Form::label('end_date', 'End Date') !!}
                                {!! Form::date('end_date', request('end_date') ?? date('Y-m-t'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="form-group col-md-4 col-sm-12 d-flex">
                                <button type="submit" class="btn btn-warning mr-2">
                                    <i class="fas fa-search"></i> Search
                                </button>
                                <a href="{{ url('report-dashboard') }}" class="btn btn-secondary">
                                    <i class="fas fa-sync-alt"></i> Reset
                                </a>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    @php
                        $cards = [
                            ['title' => 'Air Ticket', 'prefix' => 'air_ticket', 'url' => 'newAirTicket'],
                            ['title' => 'Visa', 'prefix' => 'visa', 'url' => 'newVisaProcess'],
                            ['title' => 'Tour Package', 'prefix' => 'tour', 'url' => 'newTourPackage'],
                            ['title' => 'Hotel', 'prefix' => 'hotel', 'url' => 'hotelBooking'],
                            ['title' => 'Hajj & Umrah', 'prefix' => 'hajj', 'url' => 'newUmrahPackage'],
                        ];
                    @endphp

                    @foreach($cards as $card)
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ ${"monthly_sale_{$card['prefix']}"} }}</h3>
                                    <p>Monthly {{ $card['title'] }} Sale</p>
                                </div>
                                <div class="icon"><i class="fas fa-chart-line"></i></div>
                                <a href="{{ url($card['url']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ ${"daily_sale_{$card['prefix']}"} }}</h3>
                                    <p>Today {{ $card['title'] }} Sale</p>
                                </div>
                                <div class="icon"><i class="fas fa-calendar-day"></i></div>
                                <a href="{{ url($card['url']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>{{ ${"daily_sale_{$card['prefix']}"} - ${"daily_a_sale_{$card['prefix']}"} }}</h3>
                                    <p>Today {{ $card['title'] }} Profit</p>
                                </div>
                                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                                <a href="{{ url($card['url']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ ${"monthly_sale_{$card['prefix']}"} - ${"monthly_a_sale_{$card['prefix']}"} }}</h3>
                                    <p>Monthly {{ $card['title'] }} Profit</p>
                                </div>
                                <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                                <a href="{{ url($card['url']) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endforeach

                    <!-- Total Metrics -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $monthly_sale_air_ticket + $monthly_sale_visa + $monthly_sale_tour + $monthly_sale_hotel + $monthly_sale_hajj }}</h3>
                                <p>Total Monthly Sale</p>
                            </div>
                            <div class="icon"><i class="fas fa-chart-pie"></i></div>
                            <a href="{{ url('users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ ($monthly_sale_air_ticket + $monthly_sale_visa + $monthly_sale_tour + $monthly_sale_hotel + $monthly_sale_hajj) - ($monthly_a_sale_air_ticket + $monthly_a_sale_visa + $monthly_a_sale_tour + $monthly_a_sale_hotel + $monthly_a_sale_hajj) }}</h3>
                                <p>Total Monthly Profit</p>
                            </div>
                            <div class="icon"><i class="fas fa-chart-pie"></i></div>
                            <a href="{{ url('users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $total_due }}</h3>
                                <p>Total Due Amount</p>
                            </div>
                            <div class="icon"><i class="fas fa-chart-pie"></i></div>
                            <a href="{{ url('users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-dark">
                            <div class="inner">
                                <h3>{{ $users }}</h3>
                                <p>Total Passengers</p>
                            </div>
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <a href="{{ url('users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Total Sales Report</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(function () {
            const startDate = $('#start_date').val();
            const endDate = $('#end_date').val();
            $.ajax({
                url: "{{ url('salesDataGraph') }}",
                type: 'GET',
                data: { start_date: startDate, end_date: endDate },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (result) {
                    const labels = result.map(item => item.date);
                    const data = result.map(item => item.cost);

                    const ctx = document.getElementById('areaChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Sales Graph',
                                data: data,
                                backgroundColor: 'rgba(60,141,188,0.9)',
                                borderColor: 'rgba(60,141,188,0.8)',
                                pointRadius: 3,
                                pointBackgroundColor: '#3b8bba',
                                fill: true,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                xAxes: [{
                                    gridLines: { display: false },
                                    ticks: { autoSkip: true, maxTicksLimit: 10 }
                                }],
                                yAxes: [{
                                    gridLines: { display: true },
                                    ticks: {
                                        beginAtZero: true,
                                        callback: value => '৳' + value
                                    }
                                }]
                            },
                            tooltips: {
                                callbacks: {
                                    label: function(tooltipItem) {
                                        return '৳' + tooltipItem.yLabel;
                                    }
                                }
                            },
                            legend: {
                                display: true
                            }
                        }
                    });
                },
                error: function () {
                    console.error("Failed to load chart data.");
                }
            });
        });
    </script>
@endsection

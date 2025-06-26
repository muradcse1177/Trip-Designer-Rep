
@extends('mainLayout.layout')
@section('title','Trip Designer || Visitor Logs')
@section('report','active')
@section('visitor','active')
@section('reportMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Visitors Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Visitors Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- Daily Hits -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $dailyHitCount }}</h3>
                                <p>Today's Total Hits</p>
                            </div>
                            <div class="icon"><i class="fas fa-chart-bar"></i></div>
                        </div>
                    </div>

                    <!-- Monthly Hits -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $monthlyHitCount }}</h3>
                                <p>This Month's Total Hits</p>
                            </div>
                            <div class="icon"><i class="fas fa-chart-line"></i></div>
                        </div>
                    </div>

                    <!-- Daily Unique Visitors -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $dailyUniqueVisitors }}</h3>
                                <p>Today's Unique Visitors</p>
                            </div>
                            <div class="icon"><i class="fas fa-user-check"></i></div>
                        </div>
                    </div>

                    <!-- Monthly Unique Visitors -->
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $monthlyUniqueVisitors }}</h3>
                                <p>This Month's Unique Visitors</p>
                            </div>
                            <div class="icon"><i class="fas fa-user-friends"></i></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Top Visiting URL</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>URL</th>
                                            <th>Hit Count</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($topLinks as $index => $link)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td><a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a></td>
                                                <td>{{ $link->hit_count }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No data found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    {{ $logs->links() }}
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Visitors Log Report</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="" class="table table-bordered table-hover w-100">
                                        <thead>
                                        <tr>
                                            <th>IP</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>URL</th>
                                            <th>Referrer</th>
                                            <th>Device</th>
                                            <th>Time</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($logs as $log)
                                            <tr>
                                                <td>{{ $log->ip }}</td>
                                                <td>{{ $log->country }}</td>
                                                <td>{{ $log->city }}</td>
                                                <td>{{ Str::limit($log->url, 50) }}</td>
                                                <td>{{ Str::limit($log->referrer, 50) }}</td>
                                                <td>{{ Str::limit($log->user_agent, 60) }}</td>
                                                <td>{{ $log->visited_at }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-responsive">
                                    {{ $logs->links() }}
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
@endsection

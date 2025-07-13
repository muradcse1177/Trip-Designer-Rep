
@extends('mainLayout.layout')
@section('title','Trip Designer || Login Report')
@section('report','active')
@section('login','active')
@section('reportMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Login Dashboard</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item active">Login Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Login  Report</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Total Logins (Same User + Date)</th>
                                        <th>Last IP Address</th>
                                        <th>Last Login Time</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($histories as $row)
                                        <tr>
                                            <td>{{ $row->company_name }}</td>
                                            <td>{{ $row->company_email }}</td>
                                            <td>{{ $row->login_date }}</td>
                                            <td>{{ $row->total_logins }}</td>
                                            <td>{{ $row->last_ip }}</td>
                                            <td>{{ \Carbon\Carbon::parse($row->last_login_time)->format('Y-m-d H:i:s') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No login history found.</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                                {{ $histories->links() }}
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

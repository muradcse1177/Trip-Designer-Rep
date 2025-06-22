@extends('mainLayout.layout')
@section('title','Trip Designer || Attendance Management')
@section('attendance','active')
@section('hrMenu','menu-open')
@section('hr','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Attendance Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Attendance Management</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @if(Session::get('user_role') !=2)
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Attendance Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3 mb-2">
                                        <a href="{{ url('entry-attendance') }}" class="btn btn-success w-100">Attendance Entry</a>
                                    </div>
                                    <div class="col-sm-3 mb-2">
                                        <a href="{{ url('exit-attendance') }}" class="btn btn-danger w-100">Attendance Exit</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Filter Attendance</h3>
                            </div>
                            <div class="card-body">
                                {!! Form::open(['url' => 'filter-attendance', 'method' => 'GET']) !!}
                                <div class="form-row align-items-end">
                                    {{-- Start Date --}}
                                    <div class="form-group col-md-4 col-sm-6">
                                        {!! Form::label('start_date', 'Start Date') !!}
                                        {!! Form::date('start_date', request('start_date') ?? date('Y-m-01'), ['class' => 'form-control']) !!}
                                    </div>

                                    {{-- End Date --}}
                                    <div class="form-group col-md-4 col-sm-6">
                                        {!! Form::label('end_date', 'End Date') !!}
                                        {!! Form::date('end_date', request('end_date') ?? date('Y-m-t'), ['class' => 'form-control']) !!}
                                    </div>

                                    {{-- Employee dropdown (visible only for user_role == 2) --}}
                                    @if(Session::get('user_role') == 2)
                                        <div class="form-group col-md-4 col-sm-6">
                                            {!! Form::label('employee', 'Employee') !!}
                                            <select class="form-control select2bs4" name="employee" id="employee" style="width: 100%;" required>
                                                <option value="">Select Employee Name</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}" {{ request('employee') == $employee->id ? 'selected' : '' }}>
                                                        {{ $employee->company_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    {{-- Action Buttons --}}
                                    <div class="form-group col-12 mt-3 d-flex flex-wrap gap-2">
                                        <button type="submit" class="btn btn-warning mr-2 mb-2">
                                            <i class="fas fa-search"></i> Search
                                        </button>

                                        <a href="{{ url('attendance') }}" class="btn btn-secondary mr-2 mb-2">
                                            <i class="fas fa-sync-alt"></i> Reset
                                        </a>

                                        <a href="{{ route('attendance.download.pdf', request()->all()) }}" target="_blank" class="btn btn-danger mb-2">
                                            <i class="fas fa-file-pdf"></i> Download PDF
                                        </a>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>
                        @if($filter == 1)
                        <div class="row mb-3">
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h4>{{ $rangeOfficeDays ?? 0 }}</h4>
                                        <p>Total Office Days</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h4>{{ $totalPresentDays ?? 0 }}</h4>
                                        <p>Present Days</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-user-check"></i></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h4>{{ $lateCount ?? 0 }}</h4>
                                        <p>Late Entries</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 mb-2">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h4>{{ $earlyExitCount ?? 0 }}</h4>
                                        <p>Early Exits</p>
                                    </div>
                                    <div class="icon"><i class="fas fa-sign-out-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Attendance Management</h3>
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
                                    <table id="" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Entry Time</th>
                                            <th>Late</th>
                                            <th>Exit Time</th>
                                            <th>Early Exit</th>
                                            <th>IP Number</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($atts as $att)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <?php
                                                    $result = DB::table('users')
                                                        ->where('id',$att->user_id)->first();
                                                ?>
                                                <td>{{@$result->company_name}}</td>
                                                <td>{{@$att->date}}</td>
                                                <td>{{@$att->entry_time}}</td>
                                                <td style="color: red;">{{@$att->late}}</td>
                                                <td>{{@$att->exit_time}}</td>
                                                <td style="color: red;">{{@$att->early_exit}}</td>
                                                <td>
                                                    Entry:{{@$att->ip}}<br>
                                                    Exit:{{@$att->exit_ip}}
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="table-responsive">
                                    {{ $atts->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })

    </script>
@endsection

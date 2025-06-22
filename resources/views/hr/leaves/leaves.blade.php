@extends('mainLayout.layout')
@section('title','Trip Designer || Leaves Management ')
@section('hr','active')
@section('leaves','active')
@section('hrMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Leaves Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Leaves Management</li>
                        </ol>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-info shadow-sm">
                            <div class="card-header text-center">
                                <h5 class="card-title mb-0"><i class="fas fa-calendar-check mr-2"></i>Total Leave in a Year</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Casual Leave -->
                                    <div class="col-md-2 col-sm-6 col-6">
                                        <div class="info-box bg-light elevation-1">
                                            <span class="info-box-icon bg-primary"><i class="fas fa-user-clock"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Casual</span>
                                                <span class="info-box-number">{{ $g_holidays->casual_leave }} Days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sick Leave -->
                                    <div class="col-md-2 col-sm-6 col-6">
                                        <div class="info-box bg-light elevation-1">
                                            <span class="info-box-icon bg-danger"><i class="fas fa-briefcase-medical"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Sick</span>
                                                <span class="info-box-number">{{ $g_holidays->seek_leave }} Days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Marriage Leave -->
                                    <div class="col-md-2 col-sm-6 col-6">
                                        <div class="info-box bg-light elevation-1">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-ring"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Marriage</span>
                                                <span class="info-box-number">{{ $g_holidays->marriage_leave }} Days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Fatherhood Leave -->
                                    <div class="col-md-2 col-sm-6 col-6">
                                        <div class="info-box bg-light elevation-1">
                                            <span class="info-box-icon bg-info"><i class="fas fa-baby"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Fatherhood</span>
                                                <span class="info-box-number">{{ $g_holidays->fatherhood }} Days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Motherhood Leave -->
                                    <div class="col-md-2 col-sm-6 col-6">
                                        <div class="info-box bg-light elevation-1">
                                            <span class="info-box-icon" style="background-color: #e83e8c; color: white;"><i class="fas fa-baby-carriage"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Motherhood</span>
                                                <span class="info-box-number">{{ $g_holidays->motherhood }} Days</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Earned Leave (optional) -->
                                    @if(isset($g_holidays->earned_leave))
                                        <div class="col-md-2 col-sm-6 col-6">
                                            <div class="info-box bg-light elevation-1">
                                                <span class="info-box-icon bg-success"><i class="fas fa-coins"></i></span>
                                                <div class="info-box-content">
                                                    <span class="info-box-text">Earned</span>
                                                    <span class="info-box-number">{{ $g_holidays->earned_leave }} Days</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @if(Session::get('user_role') == 5)
                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-header bg-info text-white text-center">
                                <h5 class="mb-0">
                                    <i class="fas fa-calendar-check mr-2"></i> Your Available Leave
                                </h5>
                            </div>
                            <div class="card-body p-3">
                                <div class="row text-center">
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-user-clock fa-lg text-primary mb-2"></i>
                                            <h6>Casual</h6>
                                            <p class="mb-0"><strong>{{ $user->casual_leave }}</strong> Days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-briefcase-medical fa-lg text-danger mb-2"></i>
                                            <h6>Sick</h6>
                                            <p class="mb-0"><strong>{{ $user->seek_leave }}</strong> Days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-ring fa-lg text-warning mb-2"></i>
                                            <h6>Marriage</h6>
                                            <p class="mb-0"><strong>{{ $user->marriage_leave }}</strong> Days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-baby fa-lg text-info mb-2"></i>
                                            <h6>Fatherhood</h6>
                                            <p class="mb-0"><strong>{{ $user->fatherhood }}</strong> Days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-baby-carriage fa-lg text-secondary mb-2"></i>
                                            <h6>Motherhood</h6>
                                            <p class="mb-0"><strong>{{ $user->motherhood }}</strong> Days</p>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 mb-3">
                                        <div class="small-box bg-light p-3 border">
                                            <i class="fas fa-coins fa-lg text-success mb-2"></i>
                                            <h6>Earned</h6>
                                            <p class="mb-0"><strong>{{ $user->earned_leave }}</strong> Days</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">New Leave Request </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'newLeaveRequest',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select class="form-control select2bs4" name="category" id="category" style="width: 100%;" required>
                                                <option value="">Select Category</option>
                                                <option value="Casual Leave">Casual Leave</option>
                                                <option value="Seek Leave">Seek Leave</option>
                                                <option value="Marriage Leave">Marriage Leave</option>
                                                <option value="Fatherhood Leave">Fatherhood Leave</option>
                                                <option value="Motherhood Leave">Motherhood Leave</option>
                                                <option value="Earned Leave">Earned Leave</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Start Date</label>
                                            <div class="input-group date" id="start_date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date" placeholder="Enter Start Date" required/>
                                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>End Date</label>
                                            <div class="input-group date" id="end_date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date" placeholder="Enter End Date" required/>
                                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Reason of Leave</label>
                                            <textarea class="form-control" id="reason" name="reason" rows="5" placeholder="Write Reason Detail..." required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    {{ Form::open(['url' => 'requestEarnedLeave', 'method' => 'post', 'class' => 'form-horizontal']) }}
                    {{ csrf_field() }}

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-coins mr-2"></i>Request for Earned Leave</h3>
                        </div>

                        <div class="card-body row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <div class="input-group date" id="e_start_date" data-target-input="nearest">
                                        <input type="text" name="start_date" class="form-control datetimepicker-input" data-target="#e_start_date" placeholder="Select start date" required />
                                        <div class="input-group-append" data-target="#e_start_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <div class="input-group date" id="e_end_date" data-target-input="nearest">
                                        <input type="text" name="end_date" class="form-control datetimepicker-input" data-target="#e_end_date" placeholder="Select end date" required />
                                        <div class="input-group-append" data-target="#e_end_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar-alt"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right"><i class="fas fa-paper-plane mr-1"></i>Submit Request</button>
                        </div>
                    </div>
                    {{ Form::close() }}
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-danger">
                            <div class="card-header">
                                <h3 class="card-title">Leave Terms & Conditions</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                <div class="card-body row">
                                    <div class="col-sm-12">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                You cannot take any Saturday off.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                No leave can be taken the day after any public holiday.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                No more than two consecutive days of leave can be taken.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                Leave can never be applied for on a Saturday or the day after any holiday.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                Avoid all personal work during office hours. Do your personal work outside office hours. The office will not give any employee leave for such work.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                Before taking leave, the office must be informed 15 days in advance, otherwise the leave may not be accepted. The office will not be responsible for this.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                Some special categories of leave are given on the website. After analyzing them carefully, everyone will see that the leave of a specific category is equal for everyone. No one will get additional leave of those categories.If someone needs more leave than this, one and a half times their daily salary will be deducted from their salary.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                Anyone can work on any day the office closes, in which case one day of earned leave will be counted against each day worked. If he wants, he can get one and a half times his daily salary against that leave, in which case accrued leave will not be counted.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                A medical certificate must be presented for sick leave.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone takes half a day off due to illness and then takes another half day off due to illness, then one day of sick leave will be taken.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                More than one employee cannot take leave at the same time, so consult with your colleagues before taking leave.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone's leave of a certain category has expired and he needs leave of that category, then one and a half to two times his salary can be deducted from his salary for each day of leave.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone needs instant leave before the office starts, they must inform the office's Managing Director about their leave in any way before 9 am, otherwise their leave will not be accepted.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone arrives at the office after 10:10 AM for more than four days in a month, one day's salary will be deducted from their salary due to the disruption caused by attendance.One day's salary will be deducted for each day after the first four days.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone is studying in an institution, the office will not give any leave separately to any employee for studies or exams. His leave will be deducted from his casual leave. Once the casual leave ends, one to one and a half times the salary will be deducted for each day.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If a person takes leave without informing the office, his salary will be deducted twice for each day and his leave will not be accepted.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                If someone wants to use their earned leave, they will be allowed to use a maximum of one day of earned leave. More than one day of earned leave cannot be used together with other leave.
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action" aria-current="true">
                                                <b style="color: red;"> All of the above holiday rules may change as the situation develops.The authority has the power to change any extension of leave. If anyone has any confusion or opinion regarding any leave, they can talk to the authority directly.</b>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Leave Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    @php $i = 1; @endphp
                                    @foreach($leaves as $leave)
                                        @php
                                            $user = DB::table('users')->where('id', $leave->user_id)->first();
                                            $employee = DB::table('employees')->where('email', @$user->company_email)->first();
                                        @endphp

                                        <div class="col-12 mb-3">
                                            <div class="card shadow border-left border-info">
                                                <div class="card-header bg-info text-white d-flex justify-content-between align-items-center py-2 px-3">
                                                    <h6 class="mb-0">
                                                        <i class="fas fa-calendar-check mr-2"></i>Leave Request #{{ $i }}
                                                    </h6>
                                                    <span class="badge
                @if($leave->status == 'Approved') badge-warning
                @elseif($leave->status == 'Rejected') badge-danger
                @else badge-primary @endif
                px-3 py-2 ml-auto">
                {{ $leave->status }}
            </span>
                                                </div>

                                                <div class="card-body">
                                                    <div class="row align-items-start">

                                                        <!-- Employee & Leave Info -->
                                                        <div class="col-md-4 col-sm-12 mb-3">
                                                            <h6 class="text-info"><i class="fas fa-user mr-1"></i> {{ @$user->company_name }}</h6>
                                                            <ul class="list-unstyled small">
                                                                <li><strong>Category:</strong> {{ $leave->category }}</li>
                                                                <li><strong>From:</strong> {{ $leave->start_date }}</li>
                                                                <li><strong>To:</strong> {{ $leave->end_date }}</li>
                                                                <li><strong>Days:</strong> {{ $leave->days }}</li>
                                                            </ul>
                                                        </div>

                                                        <!-- Reason -->
                                                        <div class="col-md-4 col-sm-12 mb-3">
                                                            <h6><i class="fas fa-info-circle text-muted mr-1"></i> Reason</h6>
                                                            <p class="text-muted small mb-0">{{ json_decode($leave->cause) }}</p>
                                                        </div>

                                                        <!-- Leave Balances + Action -->
                                                        @if(Session::get('user_role') <= 2)
                                                            <div class="col-md-4 col-sm-12">
                                                                <div class="row">
                                                                    @php
                                                                        $leaveTypes = [
                                                                            ['label' => 'Casual', 'val' => $employee->casual_leave, 'color' => 'primary', 'icon' => 'user-clock'],
                                                                            ['label' => 'Sick', 'val' => $employee->seek_leave, 'color' => 'danger', 'icon' => 'briefcase-medical'],
                                                                            ['label' => 'Marriage', 'val' => $employee->marriage_leave, 'color' => 'warning', 'icon' => 'ring'],
                                                                            ['label' => 'Fatherhood', 'val' => $employee->fatherhood, 'color' => 'info', 'icon' => 'baby'],
                                                                            ['label' => 'Motherhood', 'val' => $employee->motherhood, 'color' => 'secondary', 'icon' => 'baby-carriage'],
                                                                            ['label' => 'Earned', 'val' => $employee->earned_leave, 'color' => 'success', 'icon' => 'coins'],
                                                                        ];
                                                                    @endphp

                                                                    <div class="col-12 mb-2">
                                                                        <div class="d-flex flex-wrap">
                                                                            @foreach($leaveTypes as $lt)
                                                                                <span class="badge badge-{{ $lt['color'] }} text-white p-2 mr-2 mb-2">
                <i class="fas fa-{{ $lt['icon'] }} mr-1"></i>
                {{ $lt['label'] }}: {{ $lt['val'] }}
            </span>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                    <!-- Action Buttons -->
                                                                    <div class="col-12 text-right mt-2">
                                                                        <div class="btn-group">
                                                                            <button type="button" class="btn btn-sm btn-info">Action</button>
                                                                            <button type="button" class="btn btn-sm btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                                                <span class="sr-only">Toggle Dropdown</span>
                                                                            </button>
                                                                            <div class="dropdown-menu dropdown-menu-right">
                                                                                <a class="dropdown-item" href="{{ url('approveLeave?id=' . $leave->id) }}">
                                                                                    <i class="fas fa-check-circle text-success mr-1"></i> Approve
                                                                                </a>
                                                                                <a class="dropdown-item" href="{{ url('rejectLeave?id=' . $leave->id) }}">
                                                                                    <i class="fas fa-times-circle text-danger mr-1"></i> Reject
                                                                                </a>
                                                                                <a class="dropdown-item" href="{{ url('approveEarnedLeave?id=' . $leave->id) }}">
                                                                                    <i class="fas fa-coins text-warning mr-1"></i> Approve Earned Leave
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <div class="modal fade" id="modal-danger">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-body">
                                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                    </div>
                                    {{ Form::open(array('url' => 'deleteDesignation',  'method' => 'post')) }}
                                    {{ csrf_field() }}
                                    <div class="modal-footer justify-content-between">
                                        <input type="hidden" name="id" class="id">
                                        <button type="submit" class="btn btn-outline-light">Delete</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $('#start_date,#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#e_start_date,#e_end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });

    </script>
@endsection

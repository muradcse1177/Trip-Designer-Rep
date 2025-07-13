@extends('mainLayout.layout')
@section('title','Trip Designer || Employee Management')
@section('Employees','active')
@section('hrMenu','menu-open')
@section('hr','active')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1>Edit Employee</h1></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Employee</li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Edit Employee</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                {{ Form::open(['url' => 'editEmployee', 'method' => 'post', 'class' => 'form-horizontal']) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <!-- Designation -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Designation</label>
                                            <select class="form-control select2bs4" name="designation" required>
                                                <option value="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{ $designation->name }}" {{ $designation->name == $employee->designation ? 'selected' : '' }}>
                                                        {{ $designation->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Name -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
                                        </div>
                                    </div>

                                    <!-- Country Code -->
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Country Code</label>
                                            <select class="form-control" name="phoneCode" required>
                                                @foreach($countries as $country)
                                                    <option value="{{ $country->phonecode }}" {{ $country->phonecode == '880' ? 'selected' : '' }}>
                                                        +{{ $country->phonecode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Phone -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" name="phone" class="form-control" value="{{ $employee->phone }}" required>
                                        </div>
                                    </div>

                                    <!-- Email -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ $employee->email }}" required>
                                        </div>
                                    </div>

                                    <!-- Password -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Password <small class="text-muted">(leave blank if unchanged)</small></label>
                                            <input type="password" name="password" class="form-control" placeholder="Enter New Password">
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ $employee->address }}">
                                        </div>
                                    </div>

                                    <!-- Join Date -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Joining Date</label>
                                            <input type="date" name="join_date" class="form-control" value="{{ $employee->join_date ?? '' }}" required>
                                        </div>
                                    </div>

                                    <!-- Salary -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Salary Amount</label>
                                            <input type="number" name="salary" class="form-control" value="{{ $employee->salary ?? '' }}" required>
                                        </div>
                                    </div>

                                    <!-- Next Increment -->
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Next Salary Increment</label>
                                            <input type="date" name="next_salary_increase" class="form-control" value="{{ $employee->next_salary_increase ?? '' }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{ $employee->id }}">
                                    <button type="submit" class="btn btn-warning float-right">Update</button>
                                </div>
                                {{ Form::close() }}
                            </div> <!-- /.card-body -->
                        </div> <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({ theme: 'bootstrap4' });

        function maxLengthCheck(object) {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>
@endsection

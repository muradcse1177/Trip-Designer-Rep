@extends('mainLayout.layout')
@section('title','Trip Designer || Employee Management')
@section('Employees','active')
@section('hrMenu','menu-open')
@section('hr','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Employee Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Employee Management</li>
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
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Edit Employee</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'editEmployee',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Employee Designation</label>
                                            <select class="form-control select2bs4" name="designation" id="designation" style="width: 100%;" required>
                                                <option value="">Select Designation</option>
                                                @foreach($designations as $designation)
                                                    <option value="{{$designation->name}}"<?php if($designation->name == $employee->designation) echo 'selected'?> >{{$designation->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Employee Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{@$employee->name}}" placeholder="Enter Employee Name" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label class="form-label">Country Code</label>
                                            <select class="select form-control" name="phoneCode" required>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->phonecode}}" <?php if($country->phonecode == '880') echo 'selected'; ?> >{{'+'.$country->phonecode}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Employee Phone</label>
                                            <input type="number" class="form-control" id="phone" name="phone" maxlength='10' oninput="maxLengthCheck(this)" value="{{@$employee->phone}}" placeholder="Enter Employee Phone"required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Employee Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{@$employee->email}}" placeholder="Enter Employee Email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Employee Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Employee Password">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Employee Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{@$employee->address}}" placeholder="Enter Employee Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$employee->id}}">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
                                </div>
                                {{ Form::close() }}
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
        $(function () {
            $("#example11").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print",],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
            }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');
        });
        function maxLengthCheck(object)
        {
            if (object.value.length > object.maxLength)
                object.value = object.value.slice(0, object.maxLength)
        }
    </script>
@endsection

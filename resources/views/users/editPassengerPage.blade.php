@extends('mainLayout.layout')
@section('title','Trip Designer || Passengers Management ')
@section('users','active')
@section('menu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Passengers Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Passengers Management</li>
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
                                <h3 class="card-title">Edit Passengers</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'editPassengerInfo',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <select class="form-control" name="title" id="title" required>
                                                    <option value="" selected>Select Title</option>
                                                    <option value="Mr" @if($passengers->title == 'Mr') Selected @endif>Mr</option>
                                                    <option value="Mrs" @if($passengers->title == 'Mrs') Selected @endif>Mrs</option>
                                                    <option value="Ms" @if($passengers->title == 'Ms') Selected @endif>Ms</option>
                                                    <option value="Mstr" @if($passengers->title == 'Mstr') Selected @endif>Mstr</option>
                                                    <option value="Miss" @if($passengers->title == 'Miss') Selected @endif>Miss</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input type="text" class="form-control" id="f_name" name="f_name" value="{{@$passengers->f_name}}" placeholder="Enter First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input type="text" class="form-control" id="l_name" name="l_name" value="{{@$passengers->l_name}}" placeholder="Enter Last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Mobile Number</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{@$passengers->phone}}" placeholder="Enter Phone Number" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" name="email"  value="{{@$passengers->email}}" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender" id="gender" required>
                                                    <option value="" selected>Select Gender</option>
                                                    <option value="Male" @if($passengers->gender == 'Male') Selected @endif>Male</option>
                                                    <option value="Female" @if($passengers->gender == 'Female') Selected @endif>Female</option>
                                                    <option value="Others" @if($passengers->gender == 'Others') Selected @endif>Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Nationality</label>
                                                <select class="form-control select2bs4" name="nationality" id="nationality" style="width: 100%;" required>
                                                    <option value="">Select Nationality</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{$country->name}}" @if($passengers->nationality == $country->name) Selected @endif>{{$country->name.'('.$country->code.')'}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="input-group date" id="dobDiv" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#dobDiv" name="dob" id="dob" value="{{@$passengers->dob}}">
                                                    <div class="input-group-append" data-target="#dobDiv" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Frequent Flyer Number(If Any) </label>
                                                <input type="text" class="form-control" id="ffn" name="ffn" placeholder="Enter Frequent Flyer Number" value="{{@$passengers->ffn}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Passport Number</label>
                                                <input type="text" class="form-control" id="p_number" name="p_number" placeholder="Enter Passport Number" value="{{@$passengers->p_number}}">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Passport Expiry Date</label>
                                                <div class="input-group date" id="passExpDiv" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" data-target="#passExpDiv" name="p_exp_date" id="p_exp_date"  value="{{@$passengers->p_exp_date}}">
                                                    <div class="input-group-append" data-target="#passExpDiv" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Traveller Type</label>
                                                <select class="form-control" name="t_type" id="t_type" required>
                                                    <option value="Adult" @if($passengers->t_type == 'Adult') Selected @endif>Adult</option>
                                                    <option value="Child" @if($passengers->t_type == 'Child') Selected @endif>Child</option>
                                                    <option value="Infant" @if($passengers->t_type == 'Infant') Selected @endif>Infant</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$passengers->id}}">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                                <!-- /.card-footer -->
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
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $(function () {
            $('#dobDiv').datetimepicker({
                format: 'Y-M-D',
                maxDate: new Date()
            });
        })
        $(function () {
            $('#passExpDiv').datetimepicker({
                format: 'Y-M-D',
                minDate: new Date()
            });
        })
        $(function () {
            $("#example11").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
                "paging": true,
                "searching": true,
                "ordering": true,
                "info": true,
            }).buttons().container().appendTo('#example11_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

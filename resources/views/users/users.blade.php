@extends('mainLayout.layout')
@section('title','Trip Designer || Passengers Management ')
@section('users','active')
@section('userMenu','menu-open')
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
                        <div class="card card-warning collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Passengers</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'createNewPassenger',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <select class="form-control" name="title" id="title" required>
                                                        <option value="" selected>Select Title</option>
                                                        <option value="Mr">Mr</option>
                                                        <option value="Mrs">Mrs</option>
                                                        <option value="Ms">Ms</option>
                                                        <option value="Mstr">Mstr</option>
                                                        <option value="Miss">Miss</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>First Name</label>
                                                    <input type="text" class="form-control" id="f_name" name="f_name" placeholder="Enter First Name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Last Name</label>
                                                    <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Enter Last Name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Mobile Number</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Gender</label>
                                                    <select class="form-control" name="gender" id="gender" required>
                                                        <option value="" selected>Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                        <option value="Others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Nationality</label>
                                                    <select class="form-control select2bs4" name="nationality" id="nationality" style="width: 100%;" required>
                                                        <option value="">Select Nationality</option>
                                                        @foreach($countries as $country)
                                                            <option value="{{$country->name}}">{{$country->name.'('.$country->code.')'}}</option>
                                                            <option value="{{$country->name}}" @if($country->name == 'Bangladesh') {{'Selected'}} @endif>{{$country->name.'('.$country->code.')'}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Date Of Birth</label>
                                                    <div class="input-group date" id="dobDiv" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#dobDiv" name="dob" id="dob">
                                                        <div class="input-group-append" data-target="#dobDiv" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Frequent Flyer Number(If Any) </label>
                                                    <input type="text" class="form-control" id="ffn" name="ffn" placeholder="Enter Frequent Flyer Number">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Passport Number</label>
                                                    <input type="text" class="form-control" id="p_number" name="p_number" placeholder="Enter Passport Number">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Passport Expiry Date</label>
                                                    <div class="input-group date" id="passExpDiv" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#passExpDiv" name="p_exp_date" id="p_exp_date" readonly>
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
                                                        <option value="Adult">Adult</option>
                                                        <option value="Child">Child</option>
                                                        <option value="Infant">Infant</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning">Save</button>
                                    </div>
                                    <!-- /.card-footer -->
                                {{ Form::close() }}
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
                                <h3 class="card-title">Passengers Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'searchPDetails',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row table-responsive">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="s" name="s" value ="<?php if(@$_GET['s']) echo $_GET['s']; ?>" placeholder="Enter Your Text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning">Search</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                                <div class="table-responsive">
                                <table id="passTablea" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Passengers </th>
                                            <th>Status</th>
                                            <th>P. Details</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($passengers as $passenger)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>
                                                <div>
                                                   Name:  {{$passenger->title.' '.$passenger->f_name.' '.$passenger->l_name}}
                                                </div>
                                               <div>
                                                  Gender: {{$passenger->gender}}
                                               </div>
                                                <div>
                                                    DOB: {{$passenger->dob}}
                                                </div>
                                            </td>
                                            <td>
                                                @if($passenger->status == 'Active')
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success">Active</button>
                                                        <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu" style="">
                                                            <a class="dropdown-item" href="{{url('isPassengerInActive?status=Active&id='.$passenger->id)}}">In Active</a>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if($passenger->status == 'In Active')
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-danger">In Active</button>
                                                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu" style="">
                                                            <a class="dropdown-item" href="{{url('isPassengerActive?status=In Active&id='.$passenger->id)}}">Active</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    Phone: {{$passenger->phone}}
                                                </div>
                                                <div>
                                                    Email: {{$passenger->email}}
                                                </div>
                                                <div>
                                                    Phone Number: {{$passenger->p_number}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editPassengerPage?id='.$passenger->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$passenger->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deletePassenger?id='.$passenger->id)}}">Delete</a>
                                                    </div>
                                                </div>
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
                                    {{ $passengers->links() }}
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
        <!-- /.content -->
        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                    </div>
                    {{ Form::open(array('url' => 'deletePassenger',  'method' => 'post')) }}
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
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $(function () {
            $("#passTable").DataTable({
                "pageLength": 50,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print",],
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": false,
            }).buttons().container().appendTo('#passTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

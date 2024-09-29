@extends('mainLayout.layout')
@section('title','Trip Designer || Statement Management')
@section('statement','active')
@section('bankDetailsMenu','menu-open')
@section('ucbStatement','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bank Statement Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Bank Statement Management</li>
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
                                <h3 class="card-title">User Info</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'generatePDFStatement',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Joint Name</label>
                                            <input type="text" class="form-control" id="j_name" name="j_name" placeholder="Enter Joint Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>F/H/P</label>
                                            <input type="text" class="form-control" id="fhp" name="fhp" placeholder="Enter FHP Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Address" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="Enter City" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Customer ID</label>
                                            <input type="number" class="form-control" id="c_id" name="c_id" placeholder="Enter Customer ID" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Account No.</label>
                                            <input type="number" class="form-control" id="ac_no" name="ac_no" placeholder="Enter Account Number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Account Type</label>
                                            <input type="text" class="form-control" id="ac_type" name="ac_type" value="Savings" placeholder="Enter Account Type" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <input type="text" class="form-control" id="currency" name="currency" value="BDT" placeholder="Enter Currency" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>A/C Status</label>
                                            <input type="text" class="form-control" id="a_status" name="a_status" value="Active" placeholder="Enter Account Status" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Statement Start Date</label>
                                            <input type="text" class="form-control" id="s_date" name="s_date" placeholder="01-01-2023" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Statement End Date</label>
                                            <input type="text" class="form-control" id="e_date" name="e_date" placeholder="01-07-2023" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Forward Balance</label>
                                            <input type="number" class="form-control" id="f_balance" name="f_balance" placeholder="Enter Forward Balance" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Transaction Number</label>
                                            <input type="number" class="form-control" id="t_number" name="t_number" placeholder="Enter Transaction Number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning float-right">Generate Statement</button>
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

@endsection

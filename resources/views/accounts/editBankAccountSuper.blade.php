@extends('mainLayout.layout')
@section('title','Trip Designer || Bank Accounts Management')
@section('accounts','active')
@section('accountMenu','menu-open')
@section('bankAccountSuper','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bank Accounts Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Bank Accounts Management</li>
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
                                <h3 class="card-title">Bank Accounts</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateBankAccountsSuper',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bank Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{$account->name}}" placeholder="Enter Bank Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bank Branch</label>
                                            <input type="text" class="form-control" id="branch" name="branch" value="{{$account->branch}}" placeholder="Enter Bank Branch Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Account Name</label>
                                            <input type="text" class="form-control" id="acc_name" name="acc_name" value="{{$account->acc_name}}" placeholder="Enter Bank Account Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Account Number</label>
                                            <input type="text" class="form-control" id="acc_number" name="acc_number"  value="{{$account->acc_number}}" placeholder="Enter Bank Account Number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Routing Number</label>
                                            <input type="text" class="form-control" id="routing" name="routing" value="{{$account->routing}}" placeholder="Enter Routing Number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Transfer Method</label>
                                            <input type="text" class="form-control" id="methods" name="methods" value="{{$account->method}}" placeholder="Enter Transfer Method" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Bank Logo</label>
                                            <input type="file" class="form-control" id="logo" name="logo"  accept="image/png, image/jpeg" <?php if($account->logo) echo ''; else echo 'required'; ?>>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{$account->id}}">
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
@endsection

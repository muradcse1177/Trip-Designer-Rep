@extends('mainLayout.layout')
@section('title','Trip Designer || Payment Management')
@section('accounts','active')
@section('accountMenu','menu-open')
@section('paymentRequest','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Request Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Payment Request Management</li>
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
                                <h3 class="card-title">Payment Request</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateManualPayment',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Payment Status</label>
                                            <select class="form-control select2bs4" name="status" id="status" style="width: 100%;" required>
                                                <option value="">Select Payment Status</option>
                                                <option value="Pending" <?php if($account->status == 'Pending') echo 'selected';?>>Pending</option>
                                                <option value="Approved" <?php if($account->status == 'Approved') echo 'selected';?>>Approved</option>
                                                <option value="Reject" <?php if($account->status == 'Reject') echo 'selected';?>>Reject</option>
                                                <option value="Bank Issue" <?php if($account->status == 'Bank Issue') echo 'selected';?>>Bank Issue</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Deposited Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" value="{{$account->amount}}" placeholder="Enter Remarks" readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Remarks</label>
                                            <input type="text" class="form-control" id="remarks" name="remarks" placeholder="Enter Remarks" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$account->id}}">
                                    <button type="submit" class="btn btn-warning float-right">Update</button>
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

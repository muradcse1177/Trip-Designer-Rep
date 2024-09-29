@extends('mainLayout.layout')
@section('title','Trip Designer || Contacts Management ')
@section('contacts','active')
@section('userMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Contacts Management</li>
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
                                <h3 class="card-title">Update Contacts</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateContacts',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{@$contact->name}}" placeholder="Enter Name">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input type="text" class="form-control" id="phone" value="{{@$contact->phone}}" name="phone" placeholder="Enter Phone Number" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="email" class="form-control" id="email" value="{{@$contact->email}}" name="email" placeholder="Enter Email">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Date Of Birth</label>
                                                <div class="input-group date" id="dobDiv" data-target-input="nearest">
                                                    <input type="text" class="form-control datetimepicker-input" value="{{@$contact->dob}}" data-target="#dobDiv" name="dob" id="dob">
                                                    <div class="input-group-append" data-target="#dobDiv" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$_GET['id']}}">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
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
        $(function () {
            $('#dobDiv').datetimepicker({
                format: 'Y-M-D',
                maxDate: new Date()
            });
        })
    </script>
@endsection

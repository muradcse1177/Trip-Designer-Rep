@extends('mainLayout.layout')
@section('title','Trip Designer || Contacts Management ')
@section('contacts','active')
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
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Purpose</label>
                                                <select class="form-control select2bs4 group" name="purpose" id="purpose" style="width: 100%;" required>
                                                    <option value="" selected>Select Purpose</option>
                                                    <option value="Air Ticket" <?php if($contact->purpose == 'Air Ticket') echo 'selected';?>>Air Ticket</option>
                                                    <option value="Visa" <?php if($contact->purpose == 'Visa') echo 'selected';?>>Visa</option>
                                                    <option value="Tour Package" <?php if($contact->purpose == 'Tour Package') echo 'selected';?>>Tour Packages</option>
                                                    <option value="Hotel Booking" <?php if($contact->purpose == 'Hotel Booking') echo 'selected';?>>Hotel Booking</option>
                                                    <option value="Hajj" <?php if($contact->purpose == 'Hajj') echo 'selected';?>>Hajj & Umrah</option>
                                                    <option value="Work Permit" <?php if($contact->purpose == 'Work Permit') echo 'selected';?>>Work Permit</option>
                                                    <option value="Education" <?php if($contact->purpose == 'Education') echo 'selected';?>>Education</option>
                                                    <option value="Services" <?php if($contact->purpose == 'Services') echo 'selected';?>>Services</option>
                                                    <option value="Bank Solvency" <?php if($contact->purpose == 'Bank Solvency') echo 'selected';?>>Bank Solvency</option>
                                                </select>
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

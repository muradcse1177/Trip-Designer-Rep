@extends('mainLayout.layout')
@section('title','Trip Designer || Company Management')
@section('companyInfo','active')
@section('settingsMenu','menu-open')
@section('settings','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Company Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Company Management</li>
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
                                <h3 class="card-title">Company Info</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateCompany',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Company Name" value="{{@$company->company_name}}" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Company Phone" value="{{@$company->company_pnone}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Company Email" value="{{@$company->company_email}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Company Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Company Address"value="{{@$company->address}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="text" class="form-control" id="password" name="password" placeholder="Enter password">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Person</label>
                                            <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Enter Contact Person Name" value="{{@$company->contact_person}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Person Phone</label>
                                            <input type="text" class="form-control" id="con_phone" name="con_phone" placeholder="Enter Contact Person Phone" value="{{@$company->con_phone}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Company Logo</label>
                                            <input type="file" class="form-control" id="logo" name="logo" accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
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
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

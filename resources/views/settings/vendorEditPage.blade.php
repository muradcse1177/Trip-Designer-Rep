@extends('mainLayout.layout')
@section('title','Trip Designer || Vendor Management')
@section('vendors','active')
@section('vendorMenu','menu-open')
@section('settings','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Vendor Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Vendor Management</li>
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
                                <h3 class="card-title">Edit Vendor</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'editVendor',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Vendor Name</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{@$vendor->name}}" placeholder="Enter Vendor Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Vendor Phone</label>
                                            <input type="phone" class="form-control" id="phone" name="phone" value="{{@$vendor->phone}}" placeholder="Enter Vendor Phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Vendor Email</label>
                                            <input type="email" class="form-control" id="email" name="email" value="{{@$vendor->email}}" placeholder="Enter Vendor Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Vendor Address</label>
                                            <input type="text" class="form-control" id="address" name="address" value="{{@$vendor->address}}" placeholder="Enter Vendor Address">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$vendor->id}}">
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
    </script>
@endsection

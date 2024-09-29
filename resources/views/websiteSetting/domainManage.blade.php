@extends('mainLayout.layout')
@section('title','Trip Designer || Domain Management ')
@section('webSettings','active')
@section('domainManage','active')
@section('websiteMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Domain Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Domain Management</li>
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
                                <h3 class="card-title">Domain Management </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'addDomain',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Domain Name (Don't use http/ or use only pure domain like  tripdesigner.net)</label>
                                            <input type="text" class="form-control" id="name" value="{{@$domainy->name}}" name="name" placeholder="Enter like tripdesigner.net" <?php if(@$domainy->name) echo 'readonly';?>  required>
                                            <br>
                                            @if(@$domainy->status == 0)
                                            <p style="color: red;"><b>Your domain is waiting for approval.</b> </p>
                                            @endif
                                            @if(@$domainy->status == 1)
                                            <p style="color: red;"> <b> Your domain is already approved.</b> </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if(@$domainy->name)
                                @else
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-warning float-right">Save</button>
                                    </div>
                                @endif
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script>
    </script>
@endsection

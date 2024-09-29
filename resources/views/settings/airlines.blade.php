@extends('mainLayout.layout')
@section('title','Trip Designer || Airlines Management')
@section('airports','active')
@section('settingsMenu','menu-open')
@section('settings','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Airlines Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Airlines Management</li>
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
                                <h3 class="card-title">Airlines Info</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'insertAirlines',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Airlines Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Airlines Name "  required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Airlines Code</label>
                                            <input type="text" class="form-control" id="code" maxlength="3" name="code" placeholder="Enter Airlines Code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Airlines Logo</label>
                                            <input type="file" class="form-control" id="logo"  name="logo" accept="image/png, image/jpg, image/gif, image/jpeg" placeholder="Enter Airlines Logo" required>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Airlines Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example111" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Logo</th>
                                        <th>Code</th>
                                        <th>Name</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($airlines as $airline)
                                        <tr>
                                            <td>{{$i}}</td>
                                            @if($airline->logo)
                                            <td><img src="{{url(@$airline->logo)}}" width="40" height="40"></td>
                                            @else
                                                <td></td>
                                            @endif
                                            <td>{{$airline->code}}</td>
                                            <td>{{$airline->name}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editAirlinesPage?id='.$airline->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$airline->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteAirlines?id='.$airline->id)}}">Delete</a>
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
                            <!-- /.card-body -->
                            <div class="modal fade" id="modal-danger">
                                <div class="modal-dialog">
                                    <div class="modal-content bg-danger">
                                        <div class="modal-body">
                                            <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                        </div>
                                        {{ Form::open(array('url' => 'deleteAirlines',  'method' => 'post')) }}
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

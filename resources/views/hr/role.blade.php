@extends('mainLayout.layout')
@section('title','Trip Designer || Role Management ')
@section('hr','active')
@section('roles','active')
@section('hrMenu','menu-open')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Role Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{url('/')}}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Role Management</li>
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
                            <h3 class="card-title">Role Management </h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body" style="display: block;">
                            {{ Form::open(array('url' => 'addRole',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Assign Designation</label>
                                        <select class="form-control select2bs4" name="designation" id="designation" style="width: 100%;" required>
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $designation)
                                                <option value="{{$designation->name}}">{{$designation->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6"></div>
                                <div class="col-sm-12">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Check Role for this Designation </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse"></i>
                                                </button>
                                            </div>
                                            <!-- /.card-tools -->
                                        </div>
                                    </div>
                                </div>
                                @foreach($attributes as $att)
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <div class="icheck-danger d-inline">
                                                <input type="checkbox" id="checkboxPrimary{{$att->id}}" name='role[]' value="{{$att->id}}">
                                                <label for="checkboxPrimary{{$att->id}}">{{$att->name}}</label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning float-right">Save</button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Designation Management</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example11" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>S.L</th>
                                    <th>Designation</th>
                                    <th>Role Details</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                $i=1;
                                $j=0;
                                @endphp
                                @foreach($roles as $role)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{$role->designation}}</td>
                                    <td>
                                        <?php
                                            $details = json_decode($role->details);
                                            foreach ($details as $att){
                                                $rows = DB::table('attribute') ->where('id', $att)->first();
                                                    echo @$rows->name.', ';
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info">Action</button>
                                            <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <div class="dropdown-menu" role="menu" style="">
                                                <a class="dropdown-item delete" data-id="{{$role->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteTourCountryName?id='.$role->id)}}">Delete</a>
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
                    </div>
                    <!-- /.card -->

                    <div class="modal fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-body">
                                    <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                </div>
                                {{ Form::open(array('url' => 'deleteRole',  'method' => 'post')) }}
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
            </div>
        </div>
    </section>
</div>
@endsection
@section('js')
<script>

    $('.select2').select2()
    $('.select2bs4').select2({
        theme: 'bootstrap4',
    })
    $(document).on('click', '.delete', function(e){
        e.preventDefault();
        var id = $(this).data('id');
        $('.id').val(id);
    });
</script>
@endsection

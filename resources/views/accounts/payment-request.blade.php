@extends('mainLayout.layout')
@section('title','Trip Designer || Agency Management ')
@section('agency','active')
@section('agencyMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Agency Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Agency Management</li>
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Agency Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'searchUsersDetails',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="s" name="s" value ="<?php if(@$_GET['s']) echo $_GET['s']; ?>" placeholder="Enter Your Text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning">Search</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                                <div class="table-responsive">
                                    <table id="passTablea" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Logo </th>
                                            <th>Name </th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Address</th>
                                            <th>Contact</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($users as $user)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>
                                                    @if($user->logo)
                                                        <img src="{{url('/'.@$user->logo)}}" height="60" width="100"/>
                                                    @else
                                                    @endif
                                                </td>
                                                <td>{{$user->company_name}}</td>
                                                <td>{{$user->phone_code.''.$user->company_pnone}}</td>
                                                <td>{{$user->company_email}}</td>
                                                <td>{{$user->address}}</td>
                                                <td>
                                                    Contact Person: {{$user->contact_person}}
                                                    Contact Phone: {{$user->con_phone}}
                                                </td>
                                                <td>
                                                    @if($user->status == 'Active')
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-success">Active</button>
                                                            <button type="button" class="btn btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu" style="">
                                                                <a class="dropdown-item" href="{{url('isAgencyInActive?status=Active&id='.$user->id)}}">In Active</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($user->status == 'In Active')
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-danger">In Active</button>
                                                            <button type="button" class="btn btn-danger dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                                <span class="sr-only">Toggle Dropdown</span>
                                                            </button>
                                                            <div class="dropdown-menu" role="menu" style="">
                                                                <a class="dropdown-item" href="{{url('isAgencyActive?status=In Active&id='.$user->id)}}">Active</a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Action</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu" style="">
                                                            <a class="dropdown-item" href="{{url('editCompanyInfo?id='.$user->id)}}">Edit</a>
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
                                <br>
                                <div class="table-responsive">
                                    {{ $users->links() }}
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                    </div>
                    {{ Form::open(array('url' => 'deletePassenger',  'method' => 'post')) }}
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
@endsection
@section('js')
    <script>
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $(function () {
            $('#dobDiv').datetimepicker({
                format: 'Y-M-D',
                maxDate: new Date()
            });
        })
        $(function () {
            $('#passExpDiv').datetimepicker({
                format: 'Y-M-D',
                minDate: new Date()
            });
        })
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $(function () {
            $("#passTable").DataTable({
                "pageLength": 50,
                "responsive": true,
                "lengthChange": false,
                "autoWidth": true,
                "buttons": ["copy", "csv", "excel", "pdf", "print",],
                "paging": true,
                "searching": true,
                "ordering": false,
                "info": false,
            }).buttons().container().appendTo('#passTable_wrapper .col-md-6:eq(0)');
        });
    </script>
@endsection

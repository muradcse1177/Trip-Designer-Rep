@extends('mainLayout.layout')
@section('title','Trip Designer || B2C Order Receiver ')
@section('orderReceiver','active')
@section('userMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>B2C Order Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">B2C Order Management</li>
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
                                <h3 class="card-title">B2C Order Management</h3>
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
                                        <th>Date</th>
                                        <th>Order Ref.</th>
                                        <th>View</th>
                                        <th>Status</th>
                                        <th>Client Details</th>
                                        <th>Query Type</th>
                                        <th>Remarks</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$order->date}}</td>
                                            <td>{{$order->r_ref}}</td>
                                            <td>
                                                <a href="{{url(''.$order->view)}}" target="_blank">View Details</a>
                                            </td>
                                            <td>
                                                @if($order->status == 'Requested')
                                                    <button type="button" class="btn btn-primary">Requested</button>
                                                @elseif($order->status == 'Replied')
                                                    <button type="button" class="btn btn-secondary">Replied</button>
                                                @elseif($order->status == 'In Process')
                                                    <button type="button" class="btn btn-warning">In Process</button>
                                                @elseif($order->status == 'Follow Up')
                                                    <button type="button" class="btn btn-dark">Follow Up</button>
                                                @elseif($order->status == 'Ordered')
                                                    <button type="button" class="btn btn-success">Ordered</button>
                                                @elseif($order->status == 'Cancelled')
                                                    <button type="button" class="btn btn-danger">Cancelled</button>
                                                @endif
                                            </td>
                                            <td>
                                                <p>Name: {{$order->name}}</p>
                                                <p>Phone: {{$order->phone}}</p>
                                                <p>Email: {{$order->email}}</p>
                                            </td>
                                            <td>{{$order->r_type}}</td>
                                            <td>{{json_decode($order->remarks)}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item change" data-id="{{$order->id}}" data-toggle="modal" data-target="#exampleModalCenter">Edit Order Status</a>
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

                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Change Order Status</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {{ Form::open(array('url' => 'changeB2COrderStatus',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                    {{ csrf_field() }}
                                    <div class="modal-body">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control select2bs4" name="status" id="status" style="width: 100%;" required>
                                                    <option value="">Select Status</option>
                                                    <option value="Requested">Requested</option>
                                                    <option value="Replied">Replied</option>
                                                    <option value="In Process">In Process</option>
                                                    <option value="Follow Up">Follow Up</option>
                                                    <option value="Ordered">Ordered</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <input type="hidden" name="id" class="id">
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
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
        $(document).on('click', '.change', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

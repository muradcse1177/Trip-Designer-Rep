@extends('mainLayout.layout')
@section('title','Trip Designer || New Air Ticket')
@section('airTicket','active')
@section('cancelAirTicket','active')
@section('ticketMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Air Ticket Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Air Ticket Management</li>
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
                                <h3 class="card-title">Cancel Air Ticket</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'searchPNRforCancel',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Reservation PNR/Airline PNR</label>
                                            <input type="text" class="form-control" id="pnr" name="pnr" placeholder="Enter Reservation PNR" required>
                                            <input type="hidden" id="reissue" name="cancel" value="cancel" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning float-right">Submit</button>
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
                                <h3 class="card-title">Air Ticket Management</h3>
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
                                        <th>Booking Date</th>
                                        <th>Issued By</th>
                                        <th>R.PNR</th>
                                        <th>A.PNR</th>
                                        <th>Status</th>
                                        <th>Vendor</th>
                                        <th>F.Type</th>
                                        <th>A.Price</th>
                                        <th>C.Price</th>
                                        <th>VAT</th>
                                        <th>AIT</th>
                                        <th>P.Type</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$ticket->issue_date}}</td>
                                            <td>{{$ticket->issued_by}}</td>
                                            <td>{{$ticket->reservation_pnr}}</td>
                                            <td>{{$ticket->	airline_pnr}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success">{{$ticket->status}}</button>
                                            </td>
                                            <td>{{$ticket->vendor}}</td>
                                            <td>{{$ticket->	f_type}}</td>
                                            <td>{{$ticket->	a_price}}</td>
                                            <td>{{$ticket->	c_price}}</td>
                                            <td>{{$ticket->	vat}}</td>
                                            <td>{{$ticket->	ait}}</td>
                                            <td>{{$ticket->	payment_type}}</td>
                                            <td>
                                                @if((int)$ticket->due_amount > 0)
                                                    <button type="button" class="btn btn-danger">{{$ticket->due_amount}}</button>
                                                @else
                                                    {{$ticket->	due_amount}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editTicketPage?id='.$ticket->id.'&reissue=1')}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$ticket->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteTicket?id='.$ticket->id)}}">Delete</a>
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
                    </div>
                    <div class="modal fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-body">
                                    <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                </div>
                                {{ Form::open(array('url' => 'deleteAirTicket',  'method' => 'post')) }}
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

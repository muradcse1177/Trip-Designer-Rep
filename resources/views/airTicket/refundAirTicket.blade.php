@extends('mainLayout.layout')
@section('title','Trip Designer || New Air Ticket')
@section('airTicket','active')
@section('refundAirTicket','active')
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
                                <h3 class="card-title">Refund Air Ticket</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'searchPNRforRefund',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Reservation PNR/Airline PNR</label>
                                            <input type="text" class="form-control" id="pnr" name="pnr" placeholder="Enter Reservation PNR" required>
                                            <input type="hidden" id="reissue" name="refund" value="refund" required>
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
                                <div class="table-responsive">
                                    <table id="passTablea" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Booking Date</th>
                                            <th>Ticket Details</th>
                                            <th>Passengers</th>
                                            <th>Status</th>
                                            <th>Price Details</th>
                                            <th>Due</th>
                                            @if(Session::get('user_role')==2 || Session::get('user_role')==1)
                                            <th>Profit</th>
                                            @endif
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $i=1;
                                            $j=1;
                                            $sum_due = 0;
                                            $sum_a_price = 0;
                                            $sum_c_price = 0;
                                        @endphp
                                        @foreach($tickets as $ticket)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$ticket->issue_date}}</td>
                                                <td>
                                                    <div>R.PNR: {{$ticket->reservation_pnr}} </div>
                                                    <div>A.PNR: {{$ticket->airline_pnr}} </div>
                                                    <div>Vendor: {{$ticket->vendor}} </div>
                                                </td>
                                                    <?php
                                                    $p = json_decode($ticket->pax_name);
                                                    ?>
                                                <td>
                                                    @foreach($p as $pas)
                                                            <?php
                                                            $name = DB::table('passengers')
                                                                ->where('id',$pas)
                                                                ->where('upload_by',Session::get('agent_id'))
                                                                ->first();
                                                            $phone = @$name->phone;
                                                            ?>
                                                        <div>{{$j.'.'.@$name->f_name.' '.@$name->l_name}}</div>
                                                        @php
                                                            $j++;
                                                        @endphp
                                                    @endforeach
                                                    <div>Phone: {{@$phone}}</div>
                                                </td>
                                                <td>
                                                    @if($ticket->	status == 'Issued')
                                                        <button type="button" class="btn btn-success">{{$ticket->status}}</button>
                                                    @endif
                                                    @if($ticket->	status == 'Refunded')
                                                        <button type="button" class="btn btn-danger">{{$ticket->status}}</button>
                                                    @endif
                                                    @if($ticket->	status == 'Cancelled')
                                                        <button type="button" class="btn btn-danger">{{$ticket->status}}</button>
                                                    @endif
                                                    @if($ticket->	status == 'Reissued')
                                                        <button type="button" class="btn btn-warning">{{$ticket->status}}</button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div>A.Price:{{$ticket->	a_price}}/-</div>
                                                    <div>C.Price:{{$ticket->	c_price + $ticket->	vat + $ticket->	ait}}/-</div>
                                                </td>
                                                <td>
                                                    @if((int)$ticket->due_amount > 0)
                                                        <div style="color: red;"><b>{{$ticket->due_amount}}/-</b></div>
                                                    @else
                                                        {{$ticket->	due_amount.'/-'}}
                                                    @endif
                                                </td>
                                                @if(Session::get('user_role')==2 || Session::get('user_role')==1)
                                                <td>
                                                    {{$ticket->	c_price + $ticket->	vat + $ticket->	ait - $ticket->	a_price}}/-
                                                </td>
                                                @endif
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-info">Action</button>
                                                        <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu" role="menu" style="">
                                                            <a class="dropdown-item" href="{{url('viewTicket?id='.$ticket->id)}}">View</a>
                                                            <a class="dropdown-item" href="{{url('editTicketPage?id='.$ticket->id)}}">Edit</a>
                                                            <a class="dropdown-item delete" data-id="{{$ticket->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteTicket?id='.$ticket->id)}}">Delete</a>
                                                            <a class="dropdown-item" href="{{url('editPaymentStatus?id='.$ticket->id)}}">Edit Payment Status</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $i++;
                                                 $j = 1;
                                                 $sum_due = $sum_due + $ticket->due_amount;
                                                 $sum_a_price = $sum_a_price + $ticket->a_price;
                                                 $sum_c_price = $sum_c_price + $ticket->c_price + $ticket->vat + $ticket->ait;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                        @if(Session::get('user_role')==2 || Session::get('user_role')==1)
                                            <tfoot>
                                            <tr>
                                                <td align="right" colspan="5"><b>Total</b></td>
                                                <td align="left">
                                                    <p>A.Price:{{$sum_a_price}}/-</p>
                                                    <p>C.Price:{{$sum_c_price}}/-</p>
                                                </td>
                                                <th align="left">
                                                    <div style="color: red;"><b>{{$sum_due}}/-</b></div>
                                                </th>
                                                <th align="left">
                                                    <div style="color: green;"><b>{{$sum_c_price - $sum_a_price}}/-</b></div>
                                                </th>
                                                <th align="left"></th>
                                            </tr>
                                            </tfoot>
                                        @endif
                                    </table>
                                </div><br>
                                <div class="table-responsive">
                                    {{ $tickets->links() }}
                                </div>
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

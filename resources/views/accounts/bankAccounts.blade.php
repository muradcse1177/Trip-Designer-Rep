@extends('mainLayout.layout')
@section('title','Trip Designer || Bank Accounts Management')
@section('accounts','active')
@section('accountMenu','menu-open')
@section('bankAccounts','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bank Accounts Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Bank Accounts Management</li>
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
                                <h3 class="card-title">Bank Accounts</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'addBankAccounts',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Bank/Wallet Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Bank Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required>
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
                                <h3 class="card-title">Bank Account Management</h3>
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
                                        <th>Bank Name</th>
                                        <th>Amount</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                        $sum=0;
                                    @endphp
                                    @foreach($accounts as $account)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$account->name}}</td>
                                            <td>{{$account->amount}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editBankAccount?id='.$account->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$account->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteBankAccount?id='.$account->id)}}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                            $sum = $sum + $account->amount;
                                        @endphp
                                    @endforeach
                                    <tfoot>
                                        <tr>
                                            <th></th>
                                            <th>Total Amount</th>
                                            <th align="right">{{$sum}}/-</th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    </tbody>
                                </table><br>
                                <table id="example111" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Booking Date</th>
                                        <th>Ticket Details</th>
                                        <th>Passengers</th>
                                        <th>Price Details</th>
                                        <th>Due</th>
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
                                                <div>Reservation PNR: {{$ticket->reservation_pnr}} </div>
                                                <div>Airlines PNR: {{$ticket->airline_pnr}} </div>
                                            </td>
                                                <?php
                                                $p = json_decode($ticket->pax_name);
                                                ?>
                                            <td>
                                                @foreach($p as $pas)
                                                        <?php
                                                        $name = DB::table('passengers')
                                                            ->where('id',$pas)
                                                            ->where('upload_by',Session::get('user_id'))
                                                            ->first();
                                                        ?>
                                                    <div>{{$j.'.'.$name->f_name.' '.$name->l_name}}</div>
                                                    @php
                                                        $j++;
                                                    @endphp
                                                @endforeach
                                            </td>
                                            <td>
                                                <div>A.Price: {{$ticket->	a_price}} /-</div>
                                                <div>C.Price:  {{$ticket->	c_price + $ticket->	vat + $ticket->	ait}} /-</div>
                                            </td>
                                            <td>
                                                @if((int)$ticket->due_amount > 0)
                                                    <div style="color: red;"><b>{{$ticket->due_amount}}/-</b></div>
                                                @else
                                                    {{$ticket->	due_amount.'/-'}}
                                                @endif
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
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th align="center"></th>
                                        <th align="left"></th>
                                        <th align="left"></th>
                                        <th align="left">
                                            <div>A.Price: {{$sum_a_price}} /-</div>
                                            <div>C.Price:  {{$sum_c_price}} /-</div>
                                        </th>
                                        <th align="left">
                                            <div style="color: red;"><b>{{$sum_due}} /-</b></div>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-header">
                                <h3 class="card-title"><b >Total Amount in Hand :   {{$sum + $sum_due}}/- </b></h3>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                    </div>
                    {{ Form::open(array('url' => 'deleteBankAccount',  'method' => 'post')) }}
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
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

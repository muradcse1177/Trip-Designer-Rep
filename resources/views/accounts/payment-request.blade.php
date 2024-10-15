@extends('mainLayout.layout')
@section('title','Trip Designer || Bank Accounts Management')
@section('accounts','active')
@section('accountMenu','menu-open')
@section('paymentRequest','active')
@section('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payment Request</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Payment Request Management</li>
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
                        <div class="card card-warning card-tabs">
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Manual Payment Request</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Instant Payment with Gateway</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        {{ Form::open(array('url' => 'addManualPayment ',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                        {{ csrf_field() }}
                                        <div class="card-body row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Payment Type</label>
                                                    <select class="form-control select2bs4" name="p_type" id="p_type" style="width: 100%;" required>
                                                        <option value="">Select Payment Type</option>
                                                        <option value="Transfer">Transfer</option>
                                                        <option value="BEFTN">BEFTN</option>
                                                        <option value="NPSB">NPSB</option>
                                                        <option value="RTGS">RTGS</option>
                                                        <option value="Cash Deposit">Cash Deposit</option>
                                                        <option value="Cheque Deposit">Cheque Deposit</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Deposit Bank Account</label>
                                                    <select class="form-control select2bs4" name="dep_bank" id="dep_bank" style="width: 100%;" required>
                                                        <option value="">Select Bank Account</option>
                                                        @foreach($banks as $bank)
                                                            <option value="{{$bank->name}}" >{{$bank->name}} || {{$bank->acc_name}} || {{$bank->acc_number}} || {{$bank->branch}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" min="1" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Deposit Date</label>
                                                    <input type="text" class="form-control" id="date" name="date" placeholder="Enter Date" required readonly>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>From Bank</label>
                                                    <input type="text" class="form-control" id="from_bank" name="from_bank" placeholder="Enter Your Bank Name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>From Account Number</label>
                                                    <input type="text" class="form-control" id="from_acc_number" name="from_acc_number" placeholder="Enter Bank Account Number" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Reference Number</label>
                                                    <input type="text" class="form-control" id="ref" name="ref" placeholder="Enter Reference Number" required>
                                                </div>
                                            </div>
{{--                                            <div class="col-sm-3">--}}
{{--                                                <div class="form-group">--}}
{{--                                                    <label>Reference Documents</label>--}}
{{--                                                    <input type="file" class="form-control" id="ref_doc" name="ref_doc" accept="image/png, image/jpeg" required>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-warning float-right">Submit Deposit </button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                                        {{ Form::open(array('url' => 'payOnline',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                        {{ csrf_field() }}
                                        <div class="card-body row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>Amount</label>
                                                    <input type="number" class="form-control" id="amount" name="acc_name" placeholder="Enter Amount" min="1" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" class="btn btn-warning float-right">Pay Online</button>
                                        </div>
                                        {{ Form::close() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Payment History Management</h3>
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
                                        <th>Request Time</th>
                                        <th>Reference</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Deposited Bank</th>
                                        <th>From Bank</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
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
                                            <td>
                                                Req.Time:{{$account->deposit_time}}<br>
                                                Dep.Date:{{$account->date}}
                                            </td>
                                            <td>
                                                REF:{{$account->dep_ref_number}}<br>
                                                <?php
                                                    $rows3 = DB::table('users')
                                                        ->where('id', $account->agent_id)
                                                        ->first();
                                                    ?>
                                                Agency:{{$rows3->company_name}}
                                            </td>
                                            <td>
                                                Tra.Type:{{$account->p_type}}<br>
                                                P.Type:{{$account->type}}
                                            </td>
                                            <td>{{$account->amount}}</td>
                                            <td>{{$account->dep_bank}}</td>
                                            <td>
                                                Fr.Bank:{{$account->from_bank}}<br>
                                                Fr.Acc-Num:{{$account->from_acc_number}}<br>
                                                Fr.REF-Num:{{$account->ref}}<br>
                                            </td>
                                            <td>
                                                @if($account->status == 'Pending')
                                                    <button type="button" class="btn btn-info">Pending</button>
                                                @endif
                                                @if($account->status == 'Approved')
                                                    <button type="button" class="btn btn-success">Approved</button>
                                                @endif
                                                @if($account->status == 'Reject')
                                                    <button type="button" class="btn btn-danger">Reject</button>
                                                @endif
                                                @if($account->status == 'Bank Issue')
                                                    <button type="button" class="btn btn-warning">Reject</button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($account->approved_by)
                                                    Approved:{{$account->approved_by}}<br>
                                                @endif
                                                @if($account->remarks)
                                                    Remarks:{{$account->remarks}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editManualPaymentPage?id='.$account->id)}}">Edit Payment Status</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
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
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <script>
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $( function() {
            $( "#date" ).datepicker({
                showOtherMonths: true,
                selectOtherMonths: true,
                dateFormat: 'yy-m-d'
            });
        } );
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

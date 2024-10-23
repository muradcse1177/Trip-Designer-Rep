@extends('mainLayout.layout')
@section('title','Trip Designer || New Air transaction')
@section('accounts','active')
@section('transactions','active')
@section('accountMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Transaction Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Transaction Management</li>
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
                                <h3 class="card-title">Transaction Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'filterTransaction',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <div class="input-group date" id="from_issue_date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#from_issue_date" name="from_issue_date" placeholder="Enter from date" value="{{@$_GET['from_issue_date']}}" />
                                                <div class="input-group-append" data-target="#from_issue_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <div class="input-group date" id="to_issue_date" data-target-input="nearest"><input type="text" class="form-control datetimepicker-input" data-target="#to_issue_date" name="to_issue_date" placeholder="Enter to date" value="{{@$_GET['to_issue_date']}}" />
                                                <div class="input-group-append" data-target="#to_issue_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Accounts Type</label>
                                            <select class="form-control" name="acc_type" id="acc_type" style="width: 100%;" >
                                                <option value="">Select Accounts Type</option>
                                                <option value="All" @if(@$_GET['acc_type'] == 'Issued') Selected @endif>All</option>
                                                <option value="Air Ticket" @if(@$_GET['acc_type'] == 'Air Ticket') Selected @endif>Air Ticket</option>
                                                <option value="Visa" @if(@$_GET['acc_type'] == 'Visa') Selected @endif>Visa Processing</option>
                                                <option value="Tour Package" @if(@$_GET['acc_type'] == 'Tour Package') Selected @endif>Tour Package</option>
                                                <option value="Office Accounts" @if(@$_GET['acc_type'] == 'Office Accounts') Selected @endif>Office Accounts</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" align="right">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-warning float-right">Filter</button>
                                        </div>
                                    </div>
                                </div><br>
                                {{ Form::close() }}
                                <table id="example11" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Date</th>
                                        <th>Invoice</th>
                                        <th>Source</th>
                                        <th>Purpose</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Buying Price</th>
                                        <th>Selling Price</th>
                                        <th>Profit</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                         $i = 1;
                                         $debit = 0;
                                         $credit = 0;
                                         $b_price = 0;
                                         $c_price = 0;
                                         $profit = 0;
                                    @endphp
                                    @foreach($transactions as $transaction)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$transaction->date}}</td>
                                            <td>{{$transaction->invoice_id}}</td>
                                            <td>{{$transaction->source}}</td>
                                            <td>{{$transaction->purpose}}</td>
                                            @if($transaction->transaction_type	 == 'Debit')
                                                <td>{{$transaction->buying_price}}</td>
                                                @else
                                                <td>0</td>
                                                @php
                                                    $debit = $debit + $transaction->buying_price;
                                                @endphp
                                            @endif
                                            @if($transaction->transaction_type	 == 'Credit')
                                                <td>{{$transaction->buying_price}}</td>
                                                @else
                                                <td>0</td>
                                                @php
                                                    $credit = $credit + $transaction->buying_price;
                                                @endphp
                                            @endif
                                            <td>{{$transaction->buying_price}}</td>
                                            <td>{{$transaction->selling_price}}</td>
                                            <td>{{$transaction->selling_price - $transaction->buying_price}}</td>
                                            <td>
                                                <button type="button" class="btn btn-success">{{$transaction->status}}</button>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                            $b_price = $b_price + $transaction->buying_price;
                                            $c_price = $c_price + $transaction->selling_price;
                                            $profit = $profit + ($transaction->selling_price - $transaction->buying_price);
                                        @endphp
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th></th>
                                        <th align="center"></th>
                                        <th align="left"></th>
                                        <th align="left"></th>
                                        <th align="left"></th>
                                        <th align="left">
                                            <div>Debit: {{$debit}} /-</div>
                                        </th>
                                        <th align="left">
                                            <div>Credit: {{$credit}} /-</div>
                                        </th>
                                        <th align="left">
                                            <div>B.Price: {{$b_price}} /-</div>
                                        </th>
                                        <th align="left">
                                            <div>S.Price: {{$c_price}} /-</div>
                                        </th>
                                        <th align="left">
                                            <div style="color: red;"><b>Profit:  {{$profit}} /-</b></div>
                                        </th>
                                        <th align="left"></th>
                                    </tr>
                                    </tfoot>
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
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $("#from_issue_date,#to_issue_date").click(function(){
            $('#from_issue_date,#to_issue_date').datetimepicker({
                format: 'YYYY-MM-DD',
                maxDate: new Date(),
                icons: { time: 'far fa-clock' }
            });
        });
    </script>
@endsection

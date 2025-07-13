@extends('mainLayout.layout')
@section('title','Trip Designer || Office Expenses Management')
@section('accounts','active')
@section('accountMenu','menu-open')
@section('officeExpenses','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Office Expenses Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Office Expenses/Income Management</li>
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
                        <div class="card card-warning collapsed-card">
                            <div class="card-header">
                                <h3 class="card-title">Office Expenses/Income</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'addOfficeExpense',  'method' => 'post' ,'class' =>'form-horizontal' , 'enctype' => 'multipart/form-data')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Expense Type</label>
                                            <select class="form-control select2bs4" name="type" id="type" style="width: 100%;" required>
                                                <option value="">Select Expense Type</option>
                                                <option value="Debit">Debit</option>
                                                <option value="Credit">Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Accounts Head Type</label>
                                            <select class="form-control select2bs4" name="head" id="head" style="width: 100%;" required>
                                                <option value="">Select Head Type</option>
                                                @foreach($heads as $head)
                                                    <option value="{{$head->head}}">{{$head->head}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Date</label>
                                            <div class="input-group date" id="dob" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="date" placeholder="Enter Date" required/>
                                                <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" min="1" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <input type="text" class="form-control" id="purpose" name="purpose" placeholder="Enter Purpose"  required>
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
                                <h3 class="card-title">Office Expence Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                {{ Form::open(array('url' => 'filterOfficeExpense',  'method' => 'get' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>From Date</label>
                                            <div class="input-group date" id="from_issue_date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#from_issue_date" name="from_issue_date" placeholder="Enter From Date" value="{{@$_GET['from_issue_date']}}" />
                                                <div class="input-group-append" data-target="#from_issue_date" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>To Date</label>
                                            <div class="input-group date" id="to_issue_date" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#to_issue_date" name="to_issue_date" placeholder="Enter To Date" value="{{@$_GET['to_issue_date']}}" />
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
                                                <option value="Debit" @if(@$_GET['acc_type'] == 'Debit') Selected @endif>Debit</option>
                                                <option value="Credit" @if(@$_GET['acc_type'] == 'Credit') Selected @endif>Credit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Accounts Head Type</label>
                                            <select class="form-control select2bs4" name="head" id="head" style="width: 100%;">
                                                <option value="">Select Head Type</option>
                                                @foreach($heads as $head)
                                                    <option value="{{$head->head}}" @if(@$_GET['head'] == $head->head) Selected @endif>{{$head->head}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <button type="submit" class="btn btn-warning btn-block">
                                            <i class="fas fa-filter"></i> Filter
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-2">
                                        <button type="submit" name="download" value="1" class="btn btn-success btn-block">
                                            <i class="fas fa-download"></i> Download Report
                                        </button>
                                    </div>
                                </div>
                                <hr>
                                {{ Form::close() }}
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>S.L</th>
                                            <th>Date</th>
                                            <th>Expense Type</th>
                                            <th>Invoice</th>
                                            <th>Purpose</th>
                                            <th>Expanse Amount</th>
                                            <th>Income Amount</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $b_price = 0;
                                            $c_price = 0;
                                        @endphp

                                        @forelse($transactions as $key => $transaction)
                                            <tr>
                                                <td>{{ $transactions->firstItem() + $key }}</td>
                                                <td>{{ $transaction->date }}</td>
                                                <td>{{ $transaction->transaction_type }}</td>
                                                <td>{{ $transaction->invoice_id }}</td>
                                                <td>{{ $transaction->purpose }}</td>
                                                <td>{{ number_format($transaction->buying_price, 2) }}</td>
                                                <td>{{ number_format($transaction->selling_price, 2) }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success">{{ $transaction->status }}</button>
                                                </td>
                                            </tr>
                                            @php
                                                $b_price += $transaction->buying_price;
                                                $c_price += $transaction->selling_price;
                                            @endphp
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center">No transactions found.</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="5" class="text-right">Total:</th>
                                            <th>{{ number_format($b_price, 2) }} /-</th>
                                            <th>{{ number_format($c_price, 2) }} /-</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <br>
                                {{-- Pagination Links --}}

                                    <div class="d-flex justify-content-center">
                                        {!! $transactions->appends(request()->query())->links() !!}
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
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: new Date(),
        });
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $("#from_issue_date,#to_issue_date").click(function(){
            $('#from_issue_date,#to_issue_date').datetimepicker({
                format: 'YYYY-MM-DD',
                maxDate: new Date(),
                icons: { time: 'far fa-clock' }
            });
        });
    </script>
@endsection

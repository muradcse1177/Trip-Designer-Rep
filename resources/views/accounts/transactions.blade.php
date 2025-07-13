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
                                <div class="card">
                                    <div class="card-header bg-info">
                                        <h3 class="card-title text-white">Filter Accounts</h3>
                                    </div>
                                    <div class="card-body">
                                        <form action="{{ url('your-filter-route') }}" method="GET" class="form-horizontal">
                                            <div class="row">
                                                {{-- From Date --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="from_issue_date">From Date</label>
                                                        <div class="input-group date" id="from_issue_date" data-target-input="nearest">
                                                            <input type="text" name="from_issue_date" class="form-control datetimepicker-input"
                                                                   data-target="#from_issue_date" placeholder="Enter from date"
                                                                   value="{{ request('from_issue_date') }}" />
                                                            <div class="input-group-append" data-target="#from_issue_date" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- To Date --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="to_issue_date">To Date</label>
                                                        <div class="input-group date" id="to_issue_date" data-target-input="nearest">
                                                            <input type="text" name="to_issue_date" class="form-control datetimepicker-input"
                                                                   data-target="#to_issue_date" placeholder="Enter to date"
                                                                   value="{{ request('to_issue_date') }}" />
                                                            <div class="input-group-append" data-target="#to_issue_date" data-toggle="datetimepicker">
                                                                <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Accounts Type --}}
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="acc_type">Accounts Type</label>
                                                        <select name="acc_type" id="acc_type" class="form-control select2bs4" style="width: 100%;">
                                                            <option value="">-- Select Accounts Type --</option>
                                                            <option value="All" {{ request('acc_type') == 'All' ? 'selected' : '' }}>All</option>
                                                            <option value="Air Ticket" {{ request('acc_type') == 'Air Ticket' ? 'selected' : '' }}>Air Ticket</option>
                                                            <option value="Visa" {{ request('acc_type') == 'Visa' ? 'selected' : '' }}>Visa Processing</option>
                                                            <option value="Tour Package" {{ request('acc_type') == 'Tour Package' ? 'selected' : '' }}>Tour Package</option>
                                                            <option value="Office Accounts" {{ request('acc_type') == 'Office Accounts' ? 'selected' : '' }}>Office Accounts</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Submit --}}
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
                                        </form>
                                    </div>
                                </div>
                                <br>
                                {{ Form::close() }}
                                <div class="card">
                                    <div class="card-header bg-primary">
                                        <h3 class="card-title text-white">Transaction Summary</h3>
                                    </div>
                                    <div class="card-body table-responsive">
                                        @php
                                            $grouped = $transactions->getCollection()->groupBy(function ($item) {
                                                return \Carbon\Carbon::parse($item->date)->format('Y-m-d');
                                            });

                                            $i = ($transactions->currentPage() - 1) * $transactions->perPage() + 1;

                                            $debit = $credit = $b_price = $c_price = $profit = 0;
                                        @endphp

                                        <table class="table table-bordered table-hover text-sm">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>S.L</th>
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
                                            @foreach($grouped as $date => $dailyTransactions)
                                                <tr class="bg-light">
                                                    <td colspan="10"><strong>Date: {{ \Carbon\Carbon::parse($date)->format('d M, Y') }}</strong></td>
                                                </tr>

                                                @foreach($dailyTransactions as $transaction)
                                                    @php
                                                        $rowProfit = $transaction->selling_price - $transaction->buying_price;
                                                        $profit += $rowProfit;
                                                        $b_price += $transaction->buying_price;
                                                        $c_price += $transaction->selling_price;

                                                        $debitVal = $transaction->transaction_type === 'Debit' ? $transaction->buying_price : 0;
                                                        $creditVal = $transaction->transaction_type === 'Credit' ? $transaction->buying_price : 0;

                                                        $debit += $debitVal;
                                                        $credit += $creditVal;
                                                    @endphp

                                                    <tr>
                                                        <td>{{ $i++ }}</td>
                                                        <td>{{ $transaction->invoice_id }}</td>
                                                        <td>{{ $transaction->source }}</td>
                                                        <td>{{ $transaction->purpose }}</td>
                                                        <td>{{ number_format($debitVal, 2) }}</td>
                                                        <td>{{ number_format($creditVal, 2) }}</td>
                                                        <td>{{ number_format($transaction->buying_price, 2) }}</td>
                                                        <td>{{ number_format($transaction->selling_price, 2) }}</td>
                                                        <td>
                        <span class="badge {{ $rowProfit >= 0 ? 'badge-success' : 'badge-danger' }}">
                            {{ number_format($rowProfit, 2) }}
                        </span>
                                                        </td>
                                                        <td>
                        <span class="badge badge-{{ $transaction->status == 'Approved' ? 'success' : 'warning' }}">
                            {{ $transaction->status }}
                        </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                            </tbody>

                                            <tfoot>
                                            <tr class="bg-light font-weight-bold">
                                                <td colspan="4" class="text-right">Total:</td>
                                                <td>{{ number_format($debit, 2) }}</td>
                                                <td>{{ number_format($credit, 2) }}</td>
                                                <td>{{ number_format($b_price, 2) }}</td>
                                                <td>{{ number_format($c_price, 2) }}</td>
                                                <td class="{{ $profit >= 0 ? 'text-success' : 'text-danger' }}">
                                                    {{ number_format($profit, 2) }}
                                                </td>
                                                <td></td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-center table-responsive">
                                {!! $transactions->appends(request()->query())->links() !!}
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

@extends('mainLayout.layout')
@section('title','Trip Designer || Loan Management ')
@section('hr','active')
@section('loan','active')
@section('hrMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Loan Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Loan Management</li>
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
                    <div class="col-12">
                        <div class="card card-info shadow-sm">
                            <div class="card-header text-center">
                                <h5 class="card-title mb-0"><i class="fas fa-calendar-check mr-2"></i>Loan Management</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col text-right">
                                        <a href="{{ route('loan.create') }}" class="btn btn-success">
                                            <i class="fas fa-plus-circle mr-1"></i> Add Loan
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Employee Name</th>
                                                <th>Loan</th>
                                                <th>Paid</th>
                                                <th>Due</th>
                                                <th>Paid On</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($loans as $loan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $loan->employee_name }}</td>
                                                    <td>{{ $loan->loan_amount }}</td>
                                                    <td>{{ $loan->paid_amount }}</td>
                                                    <td>{{ $loan->loan_amount - $loan->paid_amount }}</td>
                                                    <td>{{ $loan->paid_on }}</td>
                                                    <td>
                                                        @php
                                                            switch ($loan->status) {
                                                                case 'Approved':
                                                                    $class = 'btn-success';
                                                                    break;
                                                                case 'Aending':
                                                                    $class = 'btn-warning';
                                                                    break;
                                                                case 'Rejected':
                                                                    $class = 'btn-danger';
                                                                    break;
                                                                case 'Closed':
                                                                    $class = 'btn-secondary';
                                                                    break;
                                                                default:
                                                                    $class = 'btn-light';
                                                            }
                                                        @endphp

                                                        <span class="btn btn-sm {{ $class }} text-capitalize">
                                                            {{ $loan->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <!-- Edit Button -->
                                                        <a href="{{ route('loan.edit', $loan->id) }}" class="btn btn-sm btn-primary" title="Edit Loan">
                                                            <i class="fas fa-edit mr-1"></i> Edit
                                                        </a>

                                                        <!-- Status Close Button -->
                                                        @if($loan->status !== 'Closed')
                                                            <button type="button" class="btn btn-sm btn-secondary"
                                                                    data-toggle="modal" data-target="#statusModal{{ $loan->id }}"
                                                                    title="Close Loan">
                                                                <i class="fas fa-lock mr-1"></i> Close
                                                            </button>
                                                        @else
                                                            <span class="btn btn-sm btn-success disabled" title="Loan Closed">
            <i class="fas fa-check mr-1"></i> Closed
        </span>
                                                        @endif

                                                        <!-- Partial Payment Button -->
                                                        @if($loan->status !== 'Closed')
                                                            <button type="button" class="btn btn-sm btn-success"
                                                                    data-toggle="modal" data-target="#payLoan{{ $loan->id }}"
                                                                    title="Add Partial Payment">
                                                                <i class="fas fa-money-bill-wave mr-1"></i> Pay
                                                            </button>
                                                        @endif
                                                    </td>


                                                </tr>
                                                <div class="modal fade" id="statusModal{{ $loan->id }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel{{ $loan->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                        <form action="{{ route('loan.updateStatus', $loan->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Close This Loan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="form-group mb-0">
                                                                        <label for="status">Confirm Status</label>
                                                                        <select name="status" class="form-control" required>
                                                                            <option value="Closed" {{ $loan->status == 'Closed' ? 'selected' : '' }}>Closed</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer p-2">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success btn-sm">Confirm Close</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Payment Modal -->
                                                <div class="modal fade" id="payLoan{{ $loan->id }}" tabindex="-1" role="dialog" aria-labelledby="payLoanLabel{{ $loan->id }}" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                                        <form action="{{ route('loan.payment', $loan->id) }}" method="POST">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="payLoanLabel{{ $loan->id }}">
                                                                        Add Payment for {{ $loan->employee_name ?? 'Employee' }}
                                                                    </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="amount">Amount to Pay</label>
                                                                        <input type="number" name="amount" class="form-control" min="1"
                                                                               max="{{ $loan->loan_amount - $loan->paid_amount }}"
                                                                               placeholder="Enter amount" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="paid_on">Payment Date</label>
                                                                        <input type="date" name="paid_on" class="form-control" value="{{ date('Y-m-d') }}" required>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer p-2">
                                                                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" class="btn btn-success btn-sm">Save Payment</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $('#start_date,#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $('#e_start_date,#e_end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });

    </script>
@endsection

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
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-calendar-check mr-2"></i>
                                    {{ isset($loan) ? 'Edit Loan' : 'Add Loan' }}
                                </h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ isset($loan) ? route('loan.update', $loan->id) : route('loan.store') }}" method="POST">
                                    @csrf
                                    @if(isset($loan))
                                        @method('PUT')
                                    @endif

                                    <div class="row">
                                        <!-- Employee Select -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="employee_id">Employee</label>
                                                <select class="form-control select2bs4" name="employee_id" id="employee_id" style="width: 100%;" required>
                                                    <option value="">Select Employee</option>
                                                    @foreach($employees as $employee)
                                                        <option value="{{ $employee->id }}"
                                                            {{ old('employee_id', $loan->emp_id ?? '') == $employee->id ? 'selected' : '' }}>
                                                            {{ $employee->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <!-- Loan Amount -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="loan_amount">Loan Amount</label>
                                                <input type="number" name="loan_amount" id="loan_amount" class="form-control"
                                                       value="{{ old('loan_amount', $loan->loan_amount ?? '') }}"
                                                       placeholder="Enter Loan Amount" required>
                                            </div>
                                        </div>

                                        <!-- Paid On (Date Picker) -->
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="paid_on">Paid On</label>
                                                <div class="input-group date" id="paid_on" data-target-input="nearest">
                                                    <input type="text" name="paid_on" class="form-control datetimepicker-input"
                                                           data-target="#paid_on"
                                                           value="{{ old('paid_on', $loan->paid_on ?? '') }}"
                                                           placeholder="Select Date" required />
                                                    <div class="input-group-append" data-target="#paid_on" data-toggle="datetimepicker">
                                                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-warning">
                                            <i class="fas fa-save mr-1"></i> {{ isset($loan) ? 'Update' : 'Save' }}
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $(function () {
            $('#paid_on').datetimepicker({
                format: 'YYYY-MM-DD'
            });
        });
    </script>
@endsection

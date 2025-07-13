@extends('mainLayout.layout')
@section('title','Trip Designer || Salary Management')
@section('salary','active')
@section('hrMenu','menu-open')
@section('hr','active')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6"><h1>Salary Management</h1></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Salary Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-info">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0">
                            Salary Details - {{ DateTime::createFromFormat('!m', $month)->format('F') }} {{ $year }}
                        </h3>

                        <a href="{{ route('salary.details.download', ['year' => $year, 'month' => $month]) }}" class="btn btn-sm btn-danger">
                            <i class="fas fa-file-pdf mr-1"></i> Download PDF Report
                        </a>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="bg-secondary text-white align-middle">
                            <tr>
                                <th rowspan="2">Employee</th>
                                <th rowspan="2">Action</th>
                                <th rowspan="2">Basic</th>
                                <th rowspan="2">House Rent</th>
                                <th rowspan="2">Medical</th>
                                <th rowspan="2">Transport</th>
                                <th rowspan="2">Commission</th>
                                <th rowspan="2">TA/DA</th>
                                <th rowspan="2">Total</th>
                                <th colspan="2">Days</th>
                                <th rowspan="2">Net Salary</th>
                                <th rowspan="2">Advance</th>
                                <th rowspan="2">Deduct</th>
                                <th rowspan="2">Net Pay</th>
                            </tr>
                            <tr>
                                <th>Working</th>
                                <th>Attendance</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($salaries as $sal)
                                <tr>
                                    <td>{{ $sal->name }}</td>
                                    <td>
                                        <a href="{{ route('salary.payslip', ['emp_id' => $sal->emp_id, 'month' => $month, 'year' => $year]) }}"
                                           target="_blank" class="btn btn-sm btn-primary" title="Pay Slip">
                                            <i class="fas fa-file-invoice-dollar me-1"></i> Pay Slip
                                        </a>
                                    </td>
                                    <td>{{ number_format($sal->basic, 2) }}</td>
                                    <td>{{ number_format($sal->house_rent, 2) }}</td>
                                    <td>{{ number_format($sal->medical, 2) }}</td>
                                    <td>{{ number_format($sal->transport, 2) }}</td>
                                    <td>{{ number_format($sal->commission, 2) }}</td>
                                    <td>{{ number_format($sal->ta_da, 2) }}</td>
                                    <td><strong>{{ number_format($sal->salary, 2) }}</strong></td>
                                    <td>{{ $sal->working_days ?? $workingDays }}</td>
                                    <td>{{ $sal->attendance_day ?? '-' }}</td>
                                    <td>{{ number_format($sal->net_salary ?? 0, 2) }}</td>
                                    <td>{{ number_format($sal->advance ?? 0, 2) }}</td>
                                    <td>{{ number_format($sal->deduct ?? 0, 2) }}</td>
                                    <td><strong>{{ number_format($sal->net_pay ?? 0, 2) }}</strong></td>
                                </tr>
                            @endforeach
                            </tbody>

                            <tfoot>
                            <tr class="bg-light fw-bold">
                                <td colspan="8" class="text-end">Total</td>
                                <td>{{ number_format($salaries->sum('salary'), 2) }}</td>
                                <td colspan="2"></td>
                                <td>{{ number_format($salaries->sum('net_salary'), 2) }}</td>
{{--                                <td>{{ number_format($salaries->sum('loan_due'), 2) }}</td>--}}
                                <td>{{ number_format($salaries->sum('advance'), 2) }}</td>
                                <td>{{ number_format($salaries->sum('deduct'), 2) }}</td>
                                <td>{{ number_format($salaries->sum('net_pay'), 2) }}</td>

                            </tr>
                            </tfoot>
                        </table>


                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({ theme: 'bootstrap4' });
    </script>
@endsection

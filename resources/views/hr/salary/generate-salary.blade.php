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

                {{-- Salary Generate Form --}}
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Generate Salary</h3>
                    </div>

                    <form action="{{ route('salary.store') }}" method="POST" class="p-3">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Month</label>
                                <select name="month" class="form-control" required>
                                    @foreach(range(1,12) as $m)
                                        <option value="{{ $m }}" {{ (isset($month) && $month == $m) ? 'selected' : '' }}>
                                            {{ date('F', mktime(0,0,0,$m,1)) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Year</label>
                                <input type="number" name="year" class="form-control" value="{{ $year ?? date('Y') }}" required>
                            </div>

                            <div class="form-group col-md-3 align-self-end">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-cogs mr-1"></i> Generate
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- Editable Salary Table --}}
                @if(isset($employees) && count($employees) > 0)
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Salary Breakdown</h3>
                        </div>

                        <form action="{{ route('salary.update.bulk') }}" method="POST">
                            @csrf
                            <input type="hidden" name="month" value="{{ $month ?? '' }}">
                            <input type="hidden" name="year" value="{{ $year ?? '' }}">

                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-sm text-center">
                                    <thead class="bg-success text-white align-middle">
                                    <tr>
                                        <th>Employee</th>
                                        <th>Salary</th>
                                        <th>Total</th>
                                        <th>Others</th>
                                        <th>Days</th>
                                        <th>Net Salary</th>
                                        <th>Loan Due</th>
                                        <th>Advance</th>
                                        <th>Deduct</th>
                                        <th>Net Pay</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $workingDays = \Carbon\Carbon::create($year, $month, 1)->daysInMonth;
                                    @endphp

                                    @foreach($employees as $emp)
                                        @php $sal = $salaries[$emp->id] ?? null; @endphp
                                        <tr>
                                            <td>
                                                {{ $emp->name }}
                                                <input type="hidden" name="emp_ids[]" value="{{ $emp->id }}">
                                            </td>
                                            <td class="text-start">
                                                <label><small>Basic</small></label>
                                                <input type="number" name="basic[]" class="form-control text-end mb-1"
                                                       value="{{ $sal->basic ?? 0 }}" readonly>

                                                <label><small>House Rent</small></label>
                                                <input type="number" name="house_rent[]" class="form-control text-end mb-1"
                                                       value="{{ $sal->house_rent ?? 0 }}" readonly>

                                                <label><small>Medical</small></label>
                                                <input type="number" name="medical[]" class="form-control text-end"
                                                       value="{{ $sal->medical ?? 0 }}" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="total_salary[]" class="form-control text-end bg-light total-salary" value="0" readonly>
                                            </td>
                                            <td class="text-start">
                                                <label><small>Transport</small></label>
                                                <input type="number" name="transport[]" class="form-control text-end mb-1"
                                                       value="{{ $sal->transport ?? 0 }}">

                                                <label><small>Commission</small></label>
                                                <input type="number" name="commission[]" class="form-control text-end mb-1"
                                                       value="{{ $sal->commission ?? 0 }}">

                                                <label><small>TA/DA</small></label>
                                                <input type="number" name="ta_da[]" class="form-control text-end"
                                                       value="{{ $sal->ta_da ?? 0 }}">
                                            </td>
                                            <td class="text-start">
                                                <label><small>Working Days</small></label>
                                                <input type="number" class="form-control text-end mb-1 bg-light working-days"
                                                       value="{{ $workingDays }}" readonly>

                                                <label><small>Attendance Days</small></label>
                                                <input type="number" name="attendance_day[]" class="form-control text-end attendance-day"
                                                       value="{{ $sal->attendance_day ?? $workingDays }}">
                                            </td>
                                            <td>
                                                <input type="number" name="net_salary[]" class="form-control text-end net-salary" value="0" readonly>
                                            </td>
                                            <td>
                                                <input type="number" name="loan_due[]" class="form-control text-end loan-due"
                                                       value="{{ $loans[$emp->id] ?? 0 }}">
                                            </td>
                                            <td>
                                                <input type="number" name="advance[]" class="form-control text-en advance" value="0">
                                            </td>
                                            <td>
                                                <input type="number" name="deduct[]" class="form-control text-end deduct" value="0">
                                            </td>
                                            <td>
                                                <input type="number" name="net_pay[]" class="form-control text-end bg-light net-pay"
                                                       value="0" readonly>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tfoot>
                                    <tr class="bg-light fw-bold">
                                        <td colspan="2" class="text-end">Grand Total:</td>
                                        <td id="grand_total_salary" class="text-end"></td>
                                        <td colspan="2"></td>
                                        <td id="grand_net_salary" class="text-end"></td>
                                        <td colspan="3"></td>
                                        <td id="grand_net_pay" class="text-end"></td>
                                    </tr>
                                    </tfoot>
                                    </tbody>
                                </table>
                            </div>


                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-save mr-1"></i> Final Generate
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                <div class="card card-info">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered text-center">
                            <thead class="bg-primary text-white">
                            <tr>
                                <th>Year</th>
                                <th>Month</th>
                                <th>Total Salary</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($summaries as $summary)
                                <tr>
                                    <td>{{ $summary->year }}</td>
                                    <td>{{ DateTime::createFromFormat('!m', $summary->month)->format('F') }}</td>
                                    <td>{{ number_format($summary->total_salary, 2) }}</td>
                                    <td>
                                        <a href="{{ route('salary.details', ['year' => $summary->year, 'month' => $summary->month]) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fas fa-eye mr-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4">No data available.</td></tr>
                            @endforelse
                            </tbody>
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
        $(document).ready(function () {
            $('table tbody tr').each(function () {
                let $row = $(this);

                function calculateTotalSalary() {
                    let basic = parseFloat($row.find('input[name="basic[]"]').val()) || 0;
                    let houseRent = parseFloat($row.find('input[name="house_rent[]"]').val()) || 0;
                    let medical = parseFloat($row.find('input[name="medical[]"]').val()) || 0;

                    let totalSalary = basic + houseRent + medical;

                    $row.find('input[name="total_salary[]"]').val(Math.round(totalSalary));

                    return totalSalary;
                }


                function calculateNetSalary() {
                    let totalSalary = calculateTotalSalary();
                    let basic = parseFloat($row.find('input[name="basic[]"]').val()) || 0;
                    let houseRent = parseFloat($row.find('input[name="house_rent[]"]').val()) || 0;
                    let medical = parseFloat($row.find('input[name="medical[]"]').val()) || 0;

                    let transport = parseFloat($row.find('input[name="transport[]"]').val()) || 0;
                    let commission = parseFloat($row.find('input[name="commission[]"]').val()) || 0;
                    let ta_da = parseFloat($row.find('input[name="ta_da[]"]').val()) || 0;

                    let attendanceDays = parseFloat($row.find('input[name="attendance_day[]"]').val()) || 0;
                    let workingDays = parseFloat($row.find('.working-days').val()) || 0;

                    let proratedSalary = 0;
                    if (workingDays > 0) {
                        proratedSalary = ((basic + houseRent + medical) / workingDays) * attendanceDays;
                    }

                    let netSalary = proratedSalary + transport + commission + ta_da;

                    netSalary = Math.round(netSalary);
                    $row.find('input[name="net_salary[]"]').val(netSalary);

                    return netSalary;
                }


                function calculateNetPay() {
                    let netSalary = calculateNetSalary();
                    let advance = parseFloat($row.find('input[name="advance[]"]').val()) || 0;
                    let deduct = parseFloat($row.find('input[name="deduct[]"]').val()) || 0;
                    let loanDue = parseFloat($row.find('input[name="loan_due[]"]').val()) || 0;

                    let netPay = netSalary - advance - deduct - loanDue;
                    $row.find('input[name="net_pay[]"]').val(Math.round(netPay));
                }

                // Bind dynamic events
                $row.find('input[name="transport[]"], input[name="commission[]"], input[name="ta_da[]"]').on('input', function () {
                    calculateNetPay();
                });

                $row.find('input[name="attendance_day[]"], input[name="advance[]"], input[name="deduct[]"], input[name="loan_due[]"]').on('input', function () {
                    calculateNetPay();
                });

                // Initial calculation
                calculateNetPay();
            });
        });
        $(document).ready(function () {
            function calculateGrandTotals() {
                let totalSalary = 0;
                let netSalary = 0;
                let netPay = 0;

                $('input[name="total_salary[]"]').each(function () {
                    totalSalary += parseFloat($(this).val()) || 0;
                });

                $('input[name="net_salary[]"]').each(function () {
                    netSalary += parseFloat($(this).val()) || 0;
                });

                $('input[name="net_pay[]"]').each(function () {
                    netPay += parseFloat($(this).val()) || 0;
                });

                $('#grand_total_salary').text(totalSalary.toFixed(2));
                $('#grand_net_salary').text(netSalary.toFixed(2));
                $('#grand_net_pay').text(netPay.toFixed(2));
            }

            // Trigger recalculation on input change
            $('input').on('input', calculateGrandTotals);

            // Initial load
            calculateGrandTotals();
        });
    </script>
@endsection

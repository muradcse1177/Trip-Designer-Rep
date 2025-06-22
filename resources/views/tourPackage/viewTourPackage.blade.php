@extends('mainLayout.layout')
@section('title','Trip Designer || Tour Management')
@section('tourPackage','active')
@section('tourMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tour Package Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Tour Package Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Tour Package</h3>
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="printArea" class="p-4" style="font-family: 'Segoe UI', sans-serif; font-size: 14px;">
                                        @section('css')
                                            <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
                                            <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
                                            <style>
                                                @media print {
                                                    @page { margin: 0.5in; }
                                                    body {
                                                        -webkit-print-color-adjust: exact !important;
                                                        print-color-adjust: exact !important;
                                                    }
                                                    .btn, .printMe { display: none !important; }
                                                    .table th, .table td {
                                                        padding: 6px !important;
                                                        font-size: 13px !important;
                                                    }
                                                    .table-borderless td, .table-borderless th {
                                                        border: none !important;
                                                    }
                                                }
                                                .section-title {
                                                    background: #f8f9fa;
                                                    border-left: 4px solid #ffc107;
                                                    padding: 5px 10px;
                                                    margin-top: 20px;
                                                    font-weight: bold;
                                                    font-size: 16px;
                                                }
                                            </style>
                                        @endsection

                                        <div class="text-center mb-4">
                                            <h4><strong>Tour Package Invoice</strong></h4>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-6">
                                                <img src="{{url($company->logo)}}" height="50" width="180" alt="Logo">
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <h5><strong>{{$company->company_name}}</strong></h5>
                                                <p class="mb-1">Phone: {{$company->company_pnone}}</p>
                                                <p class="mb-1">Email: {{$company->company_email}}</p>
                                                <p class="mb-1">Address: {{$company->address}}</p>
                                            </div>
                                        </div>

                                        <div class="section-title">Package Details</div>
                                        <table class="table table-bordered">
                                            <tr><td><b>Package Name</b></td><td>{{$package->title}}</td></tr>
                                            <tr><td><b>Package Code</b></td><td>{{$package->p_code}}</td></tr>
                                            <tr><td><b>Package Duration</b></td><td>{{$package->start_date}} to {{$package->end_date}}</td></tr>
                                        </table>

                                        <div class="section-title">Guest Details</div>
                                        @php $pax = json_decode($package->traveler); @endphp
                                        <table class="table table-bordered">
                                            @for($i=0; $i<$package->g_details; $i++)
                                                @php $passenger = DB::table('passengers')->where('id',$pax[$i])->first(); @endphp
                                                <tr><th>Guest {{$i+1}}</th><td>{{$passenger->f_name.' '.$passenger->l_name}}</td></tr>
                                            @endfor
                                        </table>

                                        <div class="section-title">Payments Details</div>
                                        <table class="table table-bordered">
                                            <tr>
                                                <td rowspan="6">
                                                    <p><strong>Payment Type:</strong> {{$package->payment_type}}</p>
                                                    <p><strong>Payment Details:</strong><br>{!! nl2br($package->pay_details) !!}</p>
                                                </td>
                                                <td class="text-right">Package Price</td>
                                                <td class="text-right">{{$package->p_c_details}}/-</td>
                                            </tr>
                                            <tr><td class="text-right">VAT</td><td class="text-right">{{$package->p_vat}}/-</td></tr>
                                            <tr><td class="text-right">AIT</td><td class="text-right">{{$package->p_ait}}/-</td></tr>
                                            <tr><td class="text-right text-purple font-weight-bold">Grand Total</td><td class="text-right text-purple font-weight-bold">{{$package->p_c_details + $package->p_vat + $package->p_ait}}/-</td></tr>
                                            <tr><td class="text-right">Due Amount</td><td class="text-right">{{$package->due}}/-</td></tr>
                                            <tr><td class="text-right text-danger font-weight-bold">Total Paid Amount</td><td class="text-right text-danger font-weight-bold">{{$package->p_c_details + $package->p_vat + $package->p_ait - $package->due}}/-</td></tr>
                                        </table>

                                            @php
                                                $sections = [
                                                    'highlights' => 'Hotel Name',
                                                    'day_title' => 'Day Wise Itinerary',
                                                    'p_inclusions' => 'Package Inclusions',
                                                    'p_exclusions' => 'Package Exclusions',
                                                    'p_tnt' => 'Package Terms and Conditions',
                                                    'p_policy' => 'Package Policy'
                                                ];

                                                $listKeys = ['p_inclusions', 'p_exclusions', 'p_tnt', 'p_policy'];
                                            @endphp

                                            @foreach ($sections as $key => $label)
                                                @if(!empty($package->$key))
                                                    <div class="section-title">{{ $label }}</div>

                                                    @if($key === 'day_title')
                                                        @php
                                                            $d_titles = json_decode($package->day_title);
                                                            $d_ininaris = json_decode($package->dat_itinary);
                                                        @endphp
                                                        <table class="table table-bordered">
                                                            @foreach($d_titles as $i => $title)
                                                                <tr>
                                                                    <td><strong>Day {{ $i+1 }}: {{ $title }}</strong></td>
                                                                    <td>
                                                                        <ul style="padding-left: 20px;">
                                                                            @foreach(explode("\n", $d_ininaris[$i]) as $line)
                                                                                <li style="list-style: none;">
                                                                                    <i class="fas fa-check-circle text-success mr-1"></i> {{ $line }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </table>

                                                    @elseif(in_array($key, $listKeys))
                                                        @php
                                                            $html = json_decode($package->$key);
                                                            $text = strip_tags($html, '<div>');
                                                            $lines = array_filter(array_map('trim', explode('</div>', $text)));
                                                        @endphp
                                                        <ul style="padding-left: 20px;">
                                                            @foreach($lines as $line)
                                                                @php $cleanLine = strip_tags($line); @endphp
                                                                @if($cleanLine !== '')
                                                                    <li style="list-style: none;">
                                                                        <i class="fas fa-check-circle text-success mr-1"></i> {{ $cleanLine }}
                                                                    </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>

                                                    @else
                                                        <p>{!! nl2br(json_decode($package->$key)) !!}</p>
                                                    @endif
                                                @endif
                                            @endforeach

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <a href="{{url('printTourPackageInvoice?id='.$package->id)}}" target="_blank" class="btn btn-warning float-right">Print Invoice</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js" integrity="sha512-d5Jr3NflEZmFDdFHZtxeJtBzk0eB+kkRXWFQqEc1EKmolXjHm2IKCA7kTvXBNjIYzjXfD5XzIjaaErpkZHCkBg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('.select2').select2();
        $('.select2bs4').select2({ theme: 'bootstrap4' });
    </script>
@endsection

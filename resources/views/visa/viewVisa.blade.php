@extends('mainLayout.layout')
@section('title','Trip Designer || Visa Processing')
@section('newVisaProcess','active')
@section('visa','active')
@section('visaMenu','menu-open')

@section('css')
    <link rel="stylesheet" href="{{url('/public/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{url('/public/dist/css/adminlte.min.css')}}">
    <style>
        .section-header {
            position: relative;
            text-align: center;
            color: black;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .section-header img {
            height: 50px;
            width: 100%;
            object-fit: cover;
            opacity: 0.1;
        }

        .section-header .title {
            position: absolute;
            bottom: 10px;
            width: 100%;
            font-size: 1.2rem;
        }

        .invoice-section {
            background: #fefefe;
            padding: 2rem;
            border: 1px solid #dee2e6;
            border-radius: .5rem;
        }

        .table td {
            vertical-align: middle !important;
        }

        hr {
            border-top: 1px dashed #999;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="d-flex justify-content-between align-items-center">
                    <h1>Visa Management</h1>
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Visa Management</li>
                    </ol>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-warning shadow">
                    <div class="card-header">
                        <h3 class="card-title">Visa Invoice</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div id="printArea" class="invoice-section">
                            <div class="text-center mb-4">
                                <h4><strong>Visa Invoice</strong></h4>
                            </div>
                            <div class="table table-responsive">
                                <table class="table">
                                    <tr>
                                        <td>
                                            <img src="{{url($company->logo)}}" height="50" width="180"/>
                                        </td>
                                        <td class="text-right">
                                            <h5><strong>{{$company->company_name}}</strong></h5>
                                            <p class="mb-1">Phone: {{$company->company_pnone}}</p>
                                            <p class="mb-1">Email: {{$company->company_email}}</p>
                                            <p class="mb-0">Address: {{$company->address}}</p>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="section-header">
                                <img src="{{url('public/ssss.png')}}" alt="divider">
                                <div class="title">Visa Application Details</div>
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <td><strong>Invoice No.</strong></td>
                                    <td>{{'TV-'.$visa->id}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Booking Date</strong></td>
                                    <td>{{$visa->date}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Visa Country</strong></td>
                                    <td>{{$visa->visa_country}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Visa Service Details</strong></td>
                                    <td>{{$visa->v_details}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Guest Details</strong></td>
                                    <td>
                                        @php
                                            $p = json_decode($visa->p_details);
                                            $j = 1;
                                        @endphp
                                        @foreach($p as $pas)
                                            @php
                                                $name = DB::table('passengers')->where('id',$pas)->where('upload_by',Session::get('agent_id'))->first();
                                            @endphp
                                            <div>
                                                <strong>{{$j}}. Name:</strong> {{$name->f_name}} {{$name->l_name}}<br>
                                                <strong>Passport No:</strong> {{$name->p_number}}
                                            </div>
                                            <hr>
                                            @php $j++; @endphp
                                        @endforeach
                                    </td>
                                </tr>
                            </table>

                            <div class="section-header">
                                <img src="{{url('public/ssss.png')}}" alt="divider">
                                <div class="title">Payments Details</div>
                            </div>

                            <table class="table table-bordered">
                                <tr>
                                    <td rowspan="6" class="w-50">
                                        <p><strong>Payment Type:</strong> {{$visa->v_p_type}}</p>
                                        <p><strong>Payment Details:</strong><br>{!! nl2br($visa->v_p_details) !!}</p>
                                    </td>
                                    <td class="text-right">Visa Price</td>
                                    <td class="text-right">{{$visa->v_c_price}}/-</td>
                                </tr>
                                <tr>
                                    <td class="text-right">VAT</td>
                                    <td class="text-right">{{$visa->v_vat}}/-</td>
                                </tr>
                                <tr>
                                    <td class="text-right">AIT</td>
                                    <td class="text-right">{{$visa->v_ait}}/-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-purple"><strong>Grand Total</strong></td>
                                    <td class="text-right text-purple">
                                        <strong>{{$visa->v_c_price + $visa->v_vat + $visa->v_ait}}/-</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right">Due Amount</td>
                                    <td class="text-right">{{$visa->v_due}}/-</td>
                                </tr>
                                <tr>
                                    <td class="text-right text-success"><strong>Total Paid Amount</strong></td>
                                    <td class="text-right text-success">
                                        <strong>{{$visa->v_c_price + $visa->v_vat + $visa->v_ait - $visa->v_due}}/-</strong>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div> <!-- end of invoice-section -->

                    <div class="card-footer d-flex justify-content-end gap-2">
                        <a href="{{ url('downloadVisaInvoice?id='.$visa->id) }}" class="btn btn-success mr-2" target="_blank">
                            <i class="fas fa-download"></i> Download Invoice
                        </a>
                        <a href="{{ url('printVisaInvoice?id='.$visa->id) }}" target="_blank" class="btn btn-warning">
                            <i class="fas fa-print"></i> Print Invoice
                        </a>
                    </div>

                </div>
            </div>
        </section>
    </div>
@endsection

@section('js')
    <!-- Optional custom JS can go here -->
@endsection

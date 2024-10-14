@extends('mainLayout.layout')
@section('title','Trip Designer || Edit Air Ticket')
@section('airTicket','active')
@section('ticketMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Air Ticket Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Air Ticket Management</li>
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
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Update Air Ticket</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateNewAirTicket',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Reservation PNR</label>
                                            <input type="text" class="form-control" id="reservation_pnr" name="reservation_pnr" placeholder="Enter Reservation PNR" @if(@$_GET['reissue'] == 1) {{'readonly'}} @endif @if(@$_GET['refund'] == 1) {{'readonly'}} @endif @if(@$_GET['cancel'] == 1) {{'readonly'}} @endif value="{{$tickets->reservation_pnr}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Airlines PNR</label>
                                            <input type="text" class="form-control" id="airline_pnr" name="airline_pnr" placeholder="Airlines Reservation PNR" value="{{$tickets->airline_pnr}}" required @if(@$_GET['reissue'] == 1) {{'readonly'}} @endif @if(@$_GET['refund'] == 1) {{'readonly'}} @endif @if(@$_GET['cancel'] == 1) {{'readonly'}} @endif >
                                        </div>
                                    </div>
                                    @if(@$_GET['refund']==1)
                                        @php
                                            $refund = 1;
                                            $cancel = 1;
                                        @endphp
                                    @endif
                                    @if(@$_GET['cancel']==1)
                                        @php
                                            $refund = 1;
                                            $cancel = 1;
                                        @endphp
                                    @endif
                                    @if(@$refund != 1 && @$cancel !=1)
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Issue date</label>
                                            <div class="input-group date" id="dob" data-target-input="nearest">
                                                <input type="text" class="form-control datetimepicker-input" data-target="#dob" name="issue_date" placeholder="26-09-2027 3:15 PM" value="{{$tickets->issue_date}}" required />
                                                <div class="input-group-append" data-target="#dob" data-toggle="datetimepicker">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Vendor Name</label>
                                            <select class="form-control select2bs4" name="vendor" id="vendor" style="width: 100%;" required>
                                                <option value="">Select Vendor Name</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->name}}" @if($tickets->vendor == $vendor->name) Selected @endif>{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Issued By(ticket)</label>
                                            <select class="form-control select2bs4" name="issued_by" id="issued_by" style="width: 100%;" required>
                                                <option value="">Select ticket Name</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->name}}"  @if($tickets->issued_by == $employee->name) Selected @endif>{{$employee->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Flight Type</label>
                                            <select class="form-control select2bs4" name="f_type" id="f_type" style="width: 100%;" required>
                                                <option value="">Select Flight Type</option>
                                                <option value="One Way" @if($tickets->f_type == 'One Way') Selected @endif>One Way</option>
                                                <option value="Round Trip" @if($tickets->f_type == 'Round Trip') Selected @endif>Round Trip</option>
                                                <option value="Multi City" @if($tickets->f_type == 'Multi City') Selected @endif>Multi City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Flight Class</label>
                                            <select class="form-control select2bs4" name="f_class" id="f_class" style="width: 100%;" required>
                                                <option value="">Select Class</option>
                                                <option value="Economy" @if($tickets->f_class == 'Economy') Selected @endif>Economy</option>
                                                <option value="Business" @if($tickets->f_class == 'Business') Selected @endif>Business</option>
                                                <option value="Premium Economy" @if($tickets->f_class == 'Premium Economy') Selected @endif>Premium Economy</option>
                                                <option value="First Class" @if($tickets->f_class == 'First Class') Selected @endif>First Class</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" style="background: #e7e7e1;">
                                            <label style="margin-left: 5px;">Flight Details</label>
                                        </div>
                                    </div>
                                    @php
                                        $f_numbers_count = count(json_decode($tickets->f_number));
                                        $f_numbers = json_decode($tickets->f_number);
                                        $a_time = json_decode($tickets->a_time);
                                        $d_time = json_decode($tickets->d_time);
                                        $airl = json_decode($tickets->airlines);
                                        $af = json_decode($tickets->a_from);
                                        $at = json_decode($tickets->a_to);
                                    @endphp
                                    @for($i =0; $i<$f_numbers_count; $i++)
                                        <div class="row after-add-more" style="margin-left: 5px;">
                                            @if(@$_GET['reissue'] != 1)
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>From</label>
                                                    <select class="form-control select2bs4" name="a_from[]" id="" style="width: 100%;" required>
                                                        <option value="">Select From</option>
                                                        @foreach($airports as $airport)
                                                            @php
                                                                $ap_val = $airport->name.'('.$airport->iata_codes.')';
                                                            @endphp
                                                            <option value="{{$ap_val}}" @if($ap_val == $af[$i]) Selected @endif>{{$ap_val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>To</label>
                                                    <select class="form-control select2bs4" name="a_to[]" id="" style="width: 100%;" required>
                                                        <option value="">Select To</option>
                                                        @foreach($airports as $airport)
                                                            @php
                                                                $ap_val = $airport->name.'('.$airport->iata_codes.')';
                                                            @endphp
                                                            <option value="{{$ap_val}}" @if($ap_val == $at[$i]) Selected @endif>{{$ap_val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                            @if(@$_GET['reissue'] == 1)
                                                <div class="col-sm-3">
                                                    <div class="form-group">
                                                        <label>Flight</label>
                                                        <input type="text" class="form-control" value="Flight Number {{$i +1}}" readonly/>
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Departure</label>
                                                    <div class="input-group date" id="d_time1" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#d_time1" name="d_time[]" placeholder="26-09-2027 3:15 " value="{{@$a_time[$i]}}" required/>
                                                        <div class="input-group-append" data-target="#d_time1" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Arrival</label>
                                                    <div class="input-group date" id="a_time1" data-target-input="nearest">
                                                        <input type="text" class="form-control datetimepicker-input" data-target="#a_time1" name="a_time[]" placeholder="26-09-2027 3:15" value="{{@$d_time[$i]}}" required/>
                                                        <div class="input-group-append" data-target="#a_time1" data-toggle="datetimepicker">
                                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Flight Number</label>
                                                    <input type="text" class="form-control" id="f_number" name="f_number[]" placeholder="Enter Flight Number" value="{{@$f_numbers[$i]}}" required>
                                                </div>
                                            </div>
                                            @if(@$_GET['reissue'] != 1)
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Airlines</label>
                                                    <select class="form-control select2bs4" name="airlines[]" id="" style="width: 100%;" required>
                                                        <option value="">Select Airlines</option>
                                                        @foreach($airlines as $airline)
                                                            @php
                                                                $a_val = $airline->name.'('.$airline->code.')';
                                                            @endphp
                                                            <option value="{{$a_val}}" @if($a_val == $airl[$i]) Selected @endif>{{$a_val}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    @endfor
                                    @endif
                                    @if(@$_GET['reissue']==1)
                                        @php
                                            $refund = 1;
                                            $reissue = 1;
                                            $cancel = 1;
                                        @endphp
                                    @endif
                                    @if(@$refund != 1 && @$reissue != 1 && @$cancel != 1 )
{{--                                    <div class="col-sm-12">--}}
{{--                                        <div class="form-group" style="background: #e7e7e1;">--}}
{{--                                            <label style="margin-left: 5px;">Passenger Details</label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    @endif
                                    <div class="col-sm-12">
                                        <div class="form-group" style="background: #e7e7e1;">
                                            <label style="margin-left: 5px;">Price  Details</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Agent Price</label>
                                            <input type="number" class="form-control" id="a_price" name="a_price" min="1" placeholder="Enter Agent Price" value="{{$tickets->a_price}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Price</label>
                                            <input type="number" class="form-control" id="c_price" name="c_price" min="1"  placeholder="Enter Client Price" value="{{$tickets->c_price}}" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <input type="number" class="form-control" id="vat" name="vat" min="0"  placeholder="Enter VAT" value="{{$tickets->vat}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>AIT</label>
                                            <input type="number" class="form-control" id="ait" name="ait" min="0"  placeholder="Enter AIT" value="{{$tickets->ait}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" style="background: #e7e7e1;">
                                            <label style="margin-left: 5px;">Payment  Details</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label> Payment Type</label>
                                            <select class="form-control select2bs4" name="payment_type" id="payment_type" style="width: 100%;" required>
                                                <option value="">Select Payment Type</option>
                                                @foreach($payment_types as $payment_type)
                                                    <option value="{{$payment_type->type}}"  @if($tickets->payment_type == $payment_type->type) Selected @endif>{{$payment_type->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Due Amount</label>
                                                <input type="number" class="form-control" id="due" name="due" min="0"  value="{{$tickets->due_amount}}" placeholder="Enter Due Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Payments Details</label>
                                            <textarea class="form-control" id="p_details" name="p_details"  rows="5" placeholder="Write Payments Detail...">{{$tickets->p_details}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$tickets->id}}">
                                    <input type="hidden" name="reissue" value="{{@$_GET['reissue']}}">
                                    <input type="hidden" name="refund" value="{{@$_GET['refund']}}">
                                    <input type="hidden" name="cancel" value="{{@$_GET['cancel']}}">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
                                </div>
                                {{ Form::close() }}
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
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: { time: 'far fa-clock' }
        });
        $('#d_time1,#a_time1').datetimepicker({
            format: 'YYYY-MM-DD HH:mm',
            icons: { time: 'far fa-clock' }
        });
        $(document).on('click', '#removeFlight', function () {
            var val = $('#ad_more').val();
            val = parseInt(val) - 1;
            if(val<1)
                val = 1;
            $('#ad_more').val(val);
            $(this).closest('#inputFormRow').remove();
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection

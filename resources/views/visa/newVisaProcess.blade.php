@extends('mainLayout.layout')
@section('title','Trip Designer || Visa Processing')
@section('newVisaProcess','active')
@section('visa','active')
@section('visaMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Visa Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Visa Management</li>
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
                                <h3 class="card-title">Add New Visa </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'createNewVisa',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Country Name</label>
                                            <select class="form-control select2bs4" name="c_name" id="c_name" style="width: 100%;" required>
                                                <option value="">Select Country Name</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}">{{$country->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
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
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Vendor Name</label>
                                            <select class="form-control select2bs4" name="vendor" id="vendor" style="width: 100%;" required>
                                                <option value="">Select Vendor Name</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->name}}">{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Issued By ( Employee ) </label>
                                            <select class="form-control select2bs4" name="issued_by" id="issued_by" style="width: 100%;" required>
                                                <option value="">Select Employee Name</option>
                                                @foreach($employees as $employee)
                                                    <option value="{{$employee->name}}">{{$employee->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label> Status</label>
                                            <select class="form-control select2bs4" name="status" id="status" style="width: 100%;" required>
                                                <option value="">Select Status Type</option>
                                                <option value="Received">Received</option>
                                                <option value="On Process">On Process</option>
                                                <option value="Submitted">Submitted</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Cancelled">Cancelled</option>
                                                <option value="Docs Required">Docs Required</option>
                                                <option value="Delivered">Delivered</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Visa Service Details</label>
                                            <input type="text" class="form-control" id="s_details" name="s_details" placeholder="Enter Visa Service Details" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" style="background: #e7e7e1;">
                                            <label style="margin-left: 5px;">Passenger Details</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 newPassenger" style="margin-left: 0px;">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Passenger Number</label>
                                                <select class="form-control select2bs4" name="pax_number" id="pax_number" style="width: 100%;" required>
                                                    <option value="">Select From</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                    <option value="4">Four</option>
                                                    <option value="5">Five</option>
                                                    <option value="6">Six</option>
                                                    <option value="7">Seven</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group" style="background: #e7e7e1;">
                                            <label style="margin-left: 5px;">Price  Details</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Agent Price</label>
                                            <input type="number" class="form-control" id="a_price" name="a_price" min="1" placeholder="Enter Agent Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Price</label>
                                            <input type="number" class="form-control" id="c_price" name="c_price" min="1"  placeholder="Enter Client Price" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>VAT</label>
                                            <input type="number" class="form-control" id="vat" name="vat" min="0" value="0" placeholder="Enter VAT">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>AIT</label>
                                            <input type="number" class="form-control" id="ait" name="ait" min="0" value="0" placeholder="Enter AIT">
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
                                                    <option value="{{$payment_type->type}}">{{$payment_type->type}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label>Due Amount</label>
                                                <input type="number" class="form-control" id="due" name="due" min="0" value="0" placeholder="Enter Due Amount">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Payments Details</label>
                                            <textarea class="form-control" id="p_details" name="p_details" rows="5" placeholder="Write Payments Detail..."></textarea>
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
                                <h3 class="card-title">Visa Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example11" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Date</th>
                                        <th>Country</th>
                                        <th>Details</th>
                                        <th>Vendor</th>
                                        <th>Passengers</th>
                                        <th>Status</th>
                                        <th>A.Price</th>
                                        <th>C.Price</th>
                                        <th>P.Type</th>
                                        <th>Due</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                        $j = 1;
                                    @endphp
                                    @foreach($visas as $visa)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$visa->date}}</td>
                                            <td>{{$visa->visa_country}}</td>
                                            <td>{{$visa->v_details}}</td>
                                            <td>{{$visa->vendor}}</td>
                                                <?php
                                                $p = json_decode($visa->p_details);
                                                ?>

                                            <td>
                                                @foreach($p as $pas)
                                                    <?php
                                                        $name = DB::table('passengers')
                                                        ->where('id',$pas)
                                                        ->where('upload_by',Session::get('user_id'))
                                                        ->first();
                                                    ?>
                                                    <div>{{$j.'.'.$name->f_name.' '.$name->l_name}}</div>
                                                    @php
                                                        $j++;
                                                    @endphp
                                                @endforeach
                                            </td>
                                            <td>{{$visa->status}}</td>
                                            <td>{{$visa->v_a_price}}</td>
                                            <td>{{$visa->v_c_price + $visa->v_vat + $visa->v_ait}}</td>
                                            <td>{{$visa->v_p_type}}</td>
                                            <td>
                                                @if((int)$visa->v_due > 0)
                                                    <button type="button" class="btn btn-danger">{{$visa->v_due}}</button>
                                                @else
                                                    {{$visa->	v_due}}
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('viewVisa?id='.$visa->id)}}">View</a>
                                                        <a class="dropdown-item" href="{{url('editVisaPage?id='.$visa->id)}}">Edit</a>
                                                        <a class="dropdown-item" href="{{url('editVisaPaymentStatus?id='.$visa->id)}}">Edit Payment Status</a>
                                                        <a class="dropdown-item delete" data-id="{{$visa->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteVisa?id='.$visa->id)}}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                            $j = 1;
                                        @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            <div class="modal fade" id="modal-danger">
                <div class="modal-dialog">
                    <div class="modal-content bg-danger">
                        <div class="modal-body">
                            <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                        </div>
                        {{ Form::open(array('url' => 'deleteVisa',  'method' => 'post')) }}
                        {{ csrf_field() }}
                        <div class="modal-footer justify-content-between">
                            <input type="hidden" name="id" class="id">
                            <button type="submit" class="btn btn-outline-light">Delete</button>
                        </div>
                        {{ Form::close() }}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
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
            maxDate: new Date(),
            icons: { time: 'far fa-clock' }
        });
        $('#d_time1,#a_time1').datetimepicker({
            format: 'YYYY-DD-MM HH:mm:ss',
            icons: { time: 'far fa-clock' }
        });
        $('#pax_number').on('change', function() {
            var pax_value = this.value;
            $('.feedback').remove();
            var html= '<div class="row feedback">';
            for(var i=0; i<pax_value; i++){
                var pax_name = 'pax_name'+i;
                html += '<div class="col-md-6"> <div class="form-group"> <label>Passengers</label> <select class="form-control select2bs4" name="pax_name[]" id="'+pax_name+'" style="width: 100%;" required> <option value="">Select Passenger Name</option>';
                <?php
                foreach($passengers as $passenger)
                {
                    ?>
                    html += '<option value="<?php echo $passenger->id; ?>"><?php echo $passenger->f_name." ".$passenger->l_name; ?></option>';
                    <?php
                }
                ?>
                    html += '</select></div></div>';
                html += '<div class="col-sm-6"> <div class="form-group"> <label>Passport Number</label> <input type="number" class="form-control" id="pass_number" name="pass_number[]" min="1" placeholder="Enter Passport Number" required> </div> </div>'
            }
            html += '</div>';

            $('.newPassenger').append(html);
            $('.select2bs4').select2({
                theme: 'bootstrap4',
            });
        });
    </script>
@endsection

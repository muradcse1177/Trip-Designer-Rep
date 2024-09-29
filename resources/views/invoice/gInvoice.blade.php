@extends('mainLayout.layout')
@section('title','Trip Designer || General Invoice')
@section('g_invoice','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">General Invoice</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">General Invoice</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">General Invoice</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'insertGInvoice',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Client Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Client Phone" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Enter Client Email">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Client Address</label>
                                            <input type="text" class="form-control" id="address" name="address" placeholder="Enter Client Address">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Invoice Date</label>
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
                                            <label>Payment  Method</label>
                                            <input type="text" class="form-control" id="p_method" name="p_method" placeholder="Enter Payment Method" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Account Number </label>
                                            <input type="text" class="form-control" id="acc_number" name="acc_number" placeholder="Enter Account Number" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Due Amount</label>
                                            <input type="number" min="0" class="form-control" id="due_amount" name="due_amount" placeholder="Enter Due Amount" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body row add-more">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Purpose</label>
                                            <input type="text" class="form-control" id="purpose" name="purpose[]" placeholder="Enter Purpose" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Reference</label>
                                            <input type="text" class="form-control" id="reference" name="reference[]" placeholder="Enter Reference" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <input type="number" class="form-control" min="1" id="amount[]" name="amount[]" placeholder="Enter Amount" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Pax Number</label>
                                            <input type="number" class="form-control" min="1" id="pax_number[]" name="pax_number[]" placeholder="Enter Pax Number">
                                        </div>
                                    </div>
                                    <div class="col-sm-2" id="add" style=" margin-top: 30px;">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success float-right ">Add More</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">General Invoice Management</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example111" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>S.L</th>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($invoices as $invoice)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$invoice->date}}</td>
                                            <td>{{$invoice->name}}</td>
                                            <td>{{$invoice->phone}}</td>
                                            <td>{{$invoice->email}}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('printGInvoice?id='.$invoice->id)}}">Print Invoice</a>
                                                        <a class="dropdown-item delete" data-id="{{$invoice->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteGInvoice?id='.$invoice->id)}}">Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
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
        </section>
        <div class="modal fade" id="modal-danger">
            <div class="modal-dialog">
                <div class="modal-content bg-danger">
                    <div class="modal-body">
                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                    </div>
                    {{ Form::open(array('url' => 'deleteGInvoice',  'method' => 'post')) }}
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
    </div>
@endsection
@section('js')
    <script>
        $('#dob').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate: new Date(),
        });
        $("body").on("click","#add",function(){
            var html =  '<div class="card-body row add-more">';
            html +='<div class="col-sm-3"> <div class="form-group"> <label>Purpose</label> <input type="text" class="form-control" id="purpose" name="purpose[]" placeholder="Enter Purpose" required> </div> </div>';
            html +='<div class="col-sm-3"> <div class="form-group"> <label>Reference</label> <input type="text" class="form-control" id="reference" name="reference[]" placeholder="Enter Reference" required></div> </div>';
            html +='<div class="col-sm-2"> <div class="form-group"> <label>Amount</label> <input type="number" class="form-control" min="1" id="amount" name="amount[]" placeholder="Enter Amount" required> </div> </div>';
            html +='<div class="col-sm-2"> <div class="form-group"> <label>Pax Number</label> <input type="number" class="form-control" min="1" id="pax_number" name="pax_number[]" placeholder="Enter Pax Number"> </div></div>';
            html +='<div class="col-sm-2 remove" id="remove" style=" margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right ">Remove</button></div></div>';
            html +='</div>';
            $(".add-more").last().after(html);
        });

        $("body").on("click",".remove",function(){
            $(this).parents(".add-more").remove();
        });
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

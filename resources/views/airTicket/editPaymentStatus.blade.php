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
                        <h1>Air Ticket Payment Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Air Ticket Payment Management</li>
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
                                <h3 class="card-title">Update Air Ticket Payment</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'updateAirTicketPaymentStatus',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
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
            format: 'YYYY-DD-MM HH:mm:ss',
            icons: { time: 'far fa-clock' }
        });
        $('#d_time1,#a_time1').datetimepicker({
            format: 'YYYY-DD-MM HH:mm:ss',
            icons: { time: 'far fa-clock' }
        });

    </script>
@endsection

@extends('mainLayout.layout')
@section('title','Trip Designer || SMS Management ')
@section('sender','active')
@section('senderMenu','menu-open')
@section('smsSender','active')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SMS Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">SMS Management</li>
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
                                <h3 class="card-title">Send New SMS</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'sendSMS',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
                                        <label>Select SMS Group</label>
                                        <div class="form-group">
                                            <select class="form-control select2bs4 group" name="group_name" id="group_name" style="width: 100%;">
                                                <option value="" selected>Select SMS Group</option>
                                                <option value="all">All Number in Software</option>
                                                <option value="contacts">All Contacts</option>
                                                <option value="tickets">All Air Ticket</option>
                                                <option value="hotel">All Hotel</option>
                                                <option value="visa">All Visa</option>
                                                <option value="tour">All Tour</option>
                                                <option value="hajj">All Hajj & Umrah</option>
                                                <option value="manpower">All Work Permit</option>
                                                <option value="agent">All Agent</option>
                                                <option value="employee">All Employee</option>
                                                <option value="b2c">All B2C Customer</option>
                                                <option value="passengers">All Passengers</option>
                                                <option value="order_req">All Order Request</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 single">
                                        <div class="form-group">
                                            <label>Phone Number (Enter number with comma seperated)</label>
                                            <input type="text" class="form-control singlee" id="number" name="number" placeholder="Enter Phone Number (01715185966,01835963589,01915....)" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Message</label>
                                            <textarea type="text" onkeyup="countChar(this)" class="form-control" id="sms" name="sms" rows="4" placeholder="Enter Message" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div> <label>Count: </label><b> <span id="charNum" style="color: red;">0</span></b></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div> <label>Number Format: +8801707011562,8801707011562,01707011562,8801707-011562,+8801707-011562</label></div>
                                            <div> <label>Conditions: No Space , Character or Special Character Allowed</label></div>
                                            <div> <label> 1 SMS: 155 Character</label></div>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-warning">Send SMS</button>
                                </div>
                                <!-- /.card-footer -->
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('js')
    <script>
        $('.select2').select2()

        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
        $(function () {
            $('#dobDiv').datetimepicker({
                format: 'Y-M-D',
                maxDate: new Date()
            });
        })
        $(function () {
            $('#passExpDiv').datetimepicker({
                format: 'Y-M-D',
                minDate: new Date()
            });
        })
        function countChar(val) {
            var len = val.value.length;
            if (len >= 5000) {
                val.value = val.value.substring(0, 5000);
            } else {
                $('#charNum').text(len);
            }
        };
        $(function() {
            $('.group').change(function(){
                if($("option[value='']").is(":checked"))
                    $('.single').show();
                else
                    $('.singlee').removeAttr('required');
                    $('.single').hide();

            });
        });
    </script>
@endsection

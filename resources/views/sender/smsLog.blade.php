@extends('mainLayout.layout')
@section('title','Trip Designer || SMS Management ')
@section('sender','active')
@section('senderMenu','menu-open')
@section('smsLog','active')
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
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">SMS Management</h3>
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
                                        <th>Number</th>
                                        <th>SMS</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($sms as $s)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$s->number}}</td>
                                            <td>{{$s->sms}}</td>
                                            <td><button type="button" class="btn btn-success">{{$s->status}}</button></td>
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
    </script>
@endsection

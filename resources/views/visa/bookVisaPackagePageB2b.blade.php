@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('mainDashboard','active')
@section('css')
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid"></br>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-warning">
                            <div class="card-header" style="background-color: #D9E0FF;">
                                <center><h5 style="text-align:; color: #00000;"><b>  {{$package->title}}</b></h5></center>
                                <center><p style="text-align:; color: #00000;">{{@$c_info->name}}  Authorized Visa Submitting Agents of Embassy in Dhaka, Bangladesh</p></center>

                            </div>
                            <div class="card-body"
                                {{ Form::open(array('url' => 'book-visa-package-b2b',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><b>Primary Passenger Details</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @for($i=0; $i<$adult; $i++)
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Adult Name {{$i+1}}</label>
                                                                <select class="form-control select2bs4" name="name[]" id="a_name{{$i}}" style="width: 100%;" required>
                                                                    <option value="">Select Guest Name</option>
                                                                    @foreach($passengers as $passenger)
                                                                        <option value="{{$passenger->id}}">{{$passenger->f_name.' '.$passenger->l_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                    @for($i=0; $i<$child; $i++)
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Child Name {{$i+1}}</label>
                                                                <select class="form-control select2bs4" name="name[]" id="c_name{{$i}}" style="width: 100%;" required>
                                                                    <option value="">Select Guest Name</option>
                                                                    @foreach($passengers as $passenger)
                                                                        <option value="{{$passenger->id}}">{{$passenger->f_name.' '.$passenger->l_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <p class="font12 lh-1 mb-0">
                                                    <span class="text-dark fs-3 fw-bold">
                                                        <span style="font-size: 16px;"><b>Adult Fare: {{$package->a_price.'*'.$adult.' '}} = {{number_format((float)$package->a_price*$adult, 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                    </span>
                                                </p><hr>
                                                @if($child > 0)
                                                    <p class="font12 lh-1 mb-0">
                                                        <span class="text-dark fs-3 fw-bold">
                                                            <span style="font-size: 16px;"><b>Child Fare: {{$package->c_price.'*'.$child.' '}} = {{number_format((float)$package->c_price*$child, 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                        </span>
                                                    </p><hr>
                                                @endif
                                                <p class="font12 lh-1 mb-0">
                                                    <span class="text-dark fs-3 fw-bold">
                                                        <span style="font-size: 16px; color: red;"><b>Total Fare: {{number_format((float)($package->a_price*$adult + $package->c_price*$child), 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                    </span>
                                                </p><hr>
                                                <input type="hidden" name="id" value="{{$package->id}}">
                                                <input type="hidden" name="adult" value="{{$adult}}">
                                                <input type="hidden" name="child" value="{{$child}}">
                                                <button type="submit" class="btn btn-block btn-success">Book Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
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

    </script>
@endsection

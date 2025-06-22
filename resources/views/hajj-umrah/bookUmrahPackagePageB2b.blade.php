@extends('mainLayout.layout')
@section('title','Trip Designer || Dashboard')
@section('mainDashboard','active')
@section('css')
    <link rel="stylesheet" href="{{url('/public/plugins/ekko-lightbox/ekko-lightbox.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid"></br>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="card card-warning">
                            <div class="card-header" style="background-color: #D9E0FF;">
                                <h5 style="text-align:; color: #00000;"><b>Package Name:</b>  {{$package->p_name}}</h5>
                                <span style="color: #00000;""><b>Package Type:</b> {{$package->night +1 }} Days {{$package->night }} Nights  {{$package->type }}</span>
                            </div>
                            <?php
                            $m_photo = json_decode($package->p_m_photo);
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <?php
                                    for($i=0; $i<4; $i++) {?>
                                    <div class="col-sm-3">
                                        <a href="{{@$domain.'/'.@$m_photo[$i]}}" data-toggle="lightbox" data-title="{{$package->p_name}}" data-gallery="gallery">
                                            <img src="{{@$domain.'/'.@$m_photo[$i]}}" class="img-fluid mb-2" alt="white sample" style="height: 170px; width: 100%; border-radius: 8px"/>
                                        </a>
                                    </div>
                                    <?php }?>
                                </div><hr><br>
                                {{ Form::open(array('url' => 'book-umrah-package-b2b',  'method' => 'post' ,'class' =>'form-horizontal')) }}
                                <div class="row">
                                    <div class="col-xl-8 col-lg-8 col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><b>Primary Passenger Details</b></h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>Start Date</label>
                                                            <div class="input-group date" id="start_date" data-target-input="nearest">
                                                                <input type="text" class="form-control datetimepicker-input" data-target="#start_date" name="start_date" placeholder="Enter Start Date" required/>
                                                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label>End Date</label>
                                                            <div class="input-group date" id="end_date" data-target-input="nearest">
                                                                <input type="text" class="form-control datetimepicker-input" data-target="#end_date" name="end_date" placeholder="Enter End Date" required/>
                                                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                    @for($i=0; $i<$infant; $i++)
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label>Infant Name {{$i+1}}</label>
                                                                <select class="form-control select2bs4" name="name[]" id="i_name{{$i}}" style="width: 100%;" required>
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
                                                        <span style="font-size: 16px;"><b>Adult Fare: {{$package->p_p_adult.'*'.$adult.' '}} = {{number_format((float)$package->p_p_adult*$adult, 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                    </span>
                                                </p><hr>
                                                @if($child > 0)
                                                    <p class="font12 lh-1 mb-0">
                                                        <span class="text-dark fs-3 fw-bold">
                                                            <span style="font-size: 16px;"><b>Child Fare: {{$package->p_p_child.'*'.$child.' '}} = {{number_format((float)$package->p_p_child*$child, 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                        </span>
                                                    </p><hr>
                                                @endif
                                                @if($infant > 0)
                                                    <p class="font12 lh-1 mb-0">
                                                        <span class="text-dark fs-3 fw-bold">
                                                            <span style="font-size: 16px;"><b>Infant Fare: {{$package->p_p_infant.'*'.$infant.' '}} = {{number_format((float)$package->p_p_infant*$infant, 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                        </span>
                                                    </p><hr>
                                                @endif
                                                <p class="font12 lh-1 mb-0">
                                                    <span class="text-dark fs-3 fw-bold">
                                                        <span style="font-size: 16px; color: red;"><b>Total Fare: {{number_format((float)($package->p_p_adult*$adult + $package->p_p_child*$child + $package->p_p_infant*$infant), 2, '.', '')}} {{$c_info->currency}}</b></span>
                                                    </span>
                                                </p><hr>
                                                <input type="hidden" name="id" value="{{$package->id}}">
                                                <input type="hidden" name="adult" value="{{$adult}}">
                                                <input type="hidden" name="child" value="{{$child}}">
                                                <input type="hidden" name="infant" value="{{$infant}}">
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
    <script src="{{url('/public/plugins/filterizr/jquery.filterizr.min.js')}}"></script>
    <script src="{{url('/public/plugins/ekko-lightbox/ekko-lightbox.min.js')}}"></script>
    <script>
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $('#start_date,#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true,
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
@endsection

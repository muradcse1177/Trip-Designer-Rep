@extends('mainLayout.layout')
@section('title','Trip Designer || Manpower Management')
@section('webSettings','active')
@section('b2cManpowerManagement','active')
@section('websiteMenu','menu-open')
@section('css')
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/public/plugins/summernote/summernote-bs4.min.css')}}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{url('/public/plugins/codemirror/codemirror.css')}}">
    <link rel="stylesheet" href="{{url('/public/plugins/codemirror/theme/monokai.css')}}">
    <!-- SimpleMDE -->
    <link rel="stylesheet" href="{{url('/public/plugins/simplemde/simplemde.min.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manpower Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Manpower Management</li>
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
                                <h3 class="card-title">Tour Package </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'editB2CManpowerPackage',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Country Name</label>
                                            <select class="form-control select2bs4" name="c_name" id="c_name" style="width: 100%;" required>
                                                <option value="">Select Country Name</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}" <?php if($country->name == $package->country) echo 'selected'; ?> >{{$country->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cover Photo</label>
                                            <input type="file" class="form-control" id="c_photo" accept="image/*"  name="c_photo" placeholder="Enter Package Cover Photo" <?php if($package->c_photo) echo ''; else echo 'required'; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Salary (Approximate)</label>
                                            <input type="text" class="form-control" id="salary" value="{{@$package->salary}}" name="salary" placeholder="Enter Package Salary" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Period</label>
                                            <input type="text" class="form-control" id="period" value="{{@$package->period}}"  name="period" placeholder="Enter Contact Period" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Accommodation</label>
                                            <input type="text" class="form-control" id="accommodation" value="{{@$package->accommodation}}"  name="accommodation" placeholder="Enter Accommodation Type" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{{@$package->slug}}" placeholder="Enter Slug" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Requirements</label>
                                            <textarea class="form-control" name="requirements"> {{json_decode($package->requirements)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Responsibilities</label>
                                            <textarea class="form-control" name="responsibilities">{{json_decode($package->responsibilities)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Process Time</label>
                                            <textarea class="summernote" name="p_time">{{json_decode($package->p_time)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <textarea class="summernote" name="p_method">{{json_decode($package->p_method)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Refund Policy</label>
                                            <textarea class="summernote" name="r_policy">{{json_decode($package->r_policy)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Terms & Conditions</label>
                                            <textarea class="summernote" name="tnt">{{json_decode($package->tnt)}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Package  Exclusion</label>
                                            <textarea class="summernote" name="exclusion">{{json_decode($package->exclusion)}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{@$package->id}}">
                                    <button type="submit" class="btn btn-warning float-right">Save</button>
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
    <script src="{{url('/public/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- CodeMirror -->
    <script src="{{url('/public/plugins/codemirror/codemirror.js')}}"></script>
    <script src="{{url('/public/plugins/codemirror/mode/css/css.js')}}"></script>
    <script src="{{url('/public/plugins/codemirror/mode/xml/xml.js')}}"></script>
    <script src="{{url('/public/plugins/codemirror/mode/htmlmixed/htmlmixed.js')}}"></script>
    <script>
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $(function () {
            $('.summernote').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection

@extends('mainLayout.layout')
@section('title','Trip Designer || Company ')
@section('webSettings','active')
@section('b2cCompany','active')
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
                        <h1>Company Info Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Company Info Management</li>
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
                                <h3 class="card-title">Company Info </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'addCompanyInfo',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" class="form-control" id="name" value="{{@$info->name}}" name="name" placeholder="Enter Company Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="email" class="form-control" id="email" value="{{@$info->email}}" name="email" placeholder="Enter Company Email" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Company Phone 1</label>
                                            <input type="text" class="form-control" id="phone1" value="{{@$info->phone1}}" name="phone1" placeholder="Enter Company Phone 1" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Company Phone 2</label>
                                            <input type="text" class="form-control" id="phone2" value="{{@$info->phone1}}" name="phone2" placeholder="Enter Company Phone 2">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Currency Name</label>
                                            <input type="text" class="form-control" id="currency" value="{{@$info->currency}}" name="currency" placeholder="Enter Currency Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Currency Symbol</label>
                                            <input type="text" class="form-control" id="symbol" value="{{@$info->symbol}}" name="symbol" placeholder="Enter Currency Symbol">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Company Address </label>
                                            <input type="text" class="form-control" id="address" value="{{@$info->address}}" name="address" placeholder="Enter Company Address" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Company Tag Line </label>
                                            <input type="text" class="form-control" id="tagline" value="{{@$info->tagline}}" name="tagline" placeholder="Enter Company Tag Line">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Company Logo (Size: 800px * 240px) </label>
                                            <input type="file" class="form-control" id="logo" name="logo" accept="image/*"  placeholder="Enter Company Logo" <?php if(@$info->logo) echo ''; else  echo 'required' ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Facebook Link </label>
                                            <input type="text" class="form-control" id="f_link" value="{{@$info->f_link}}" name="f_link" placeholder="Enter Facebook Link">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Intagram Link </label>
                                            <input type="text" class="form-control" id="in_link"  value="{{@$info->in_link}}" name="in_link" placeholder="Enter Facebook Link">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Youtube Link </label>
                                            <input type="text" class="form-control" id="y_link" value="{{@$info->y_link}}" name="y_link" placeholder="Enter Youtube Link">
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>About Us</label>
                                            <textarea class="summernote" name="about_us">{!! json_decode(@$info->about_us) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Privacy Policy</label>
                                            <textarea class="summernote" name="privacy_policy">{!! json_decode(@$info->privacy_policy) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Terms & Conditions</label>
                                            <textarea class="summernote" name="tnt">{!! json_decode(@$info->tnt) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Refund Policy</label>
                                            <textarea class="summernote" name="r_policy">{!! json_decode(@$info->r_policy) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Cookie Policy</label>
                                            <textarea class="summernote" name="c_policy">{!! json_decode(@$info->c_policy) !!}</textarea>
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
        $(function () {
            $('.summernote').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
    </script>
@endsection

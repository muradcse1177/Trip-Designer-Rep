@extends('mainLayout.layout')
@section('title','Trip Designer || Blog ')
@section('webSettings','active')
@section('blogManagement','active')
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
                        <h1>Blog Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Blog Management</li>
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
                                <h3 class="card-title">Blog Management </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                {{ Form::open(array('url' => 'editB2CBlog',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Blog Title</label>
                                            <input type="text" class="form-control" id="b_title" value="{{@$blog->b_title}}"  name="b_title" placeholder="Enter Blog Title" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Blog Category</label>
                                            <input type="text" class="form-control" id="b_category" value="{{@$blog->b_category}}"  name="b_category" placeholder="Enter Blog Category" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug"  value="{{@$blog->slug}}" placeholder="Enter Slug" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Published By</label>
                                            <input type="text" class="form-control" id="p_by"  name="p_by" value="{{@$blog->p_by}}"   placeholder="Enter Published By" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Blog Cover Photo (800px * 600px)</label>
                                            <input type="file" class="form-control" id="b_c_photo" accept="image/*"  name="b_c_photo" placeholder="Enter Blog Cover Photo" <?php if(@$blog->b_c_photo) echo ''; else echo 'required'; ?> >
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Visa Meta Keyword</label>
                                            <input type="text" class="form-control" id="keyword"   name="keyword" value="{{json_decode(@$blog->keyword)}}" placeholder="Enter Meta Keyword" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Visa Meta Description</label>
                                            <input type="text" class="form-control" id="description" value="{{@json_decode(@$blog->description)}}" name="description" placeholder="Enter Visa description" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Short Description</label>
                                            <input type="text" class="form-control" id="s_description" value="{{@$blog->s_description}}" name="s_description" maxlength="250" placeholder="Enter Blog Short Description" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Blog  Details</label>
                                            <textarea class="summernote" name="details">{!! json_decode(@$blog->details) !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Map Location If Needed</label>
                                            <input type="text" class="form-control" value="{{json_decode(@$blog->map_location)}}" id="map_location" name="map_location" placeholder="Enter Map Location with Iframe">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="hidden" name="id" value="{{$_GET['id']}}">
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

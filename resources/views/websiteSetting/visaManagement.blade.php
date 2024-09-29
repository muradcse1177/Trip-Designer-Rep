@extends('mainLayout.layout')
@section('title','Trip Designer || Visa Processing')
@section('webSettings','active')
@section('b2cVisaManagement','active')
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
                                <h3 class="card-title">Add New Visa Requirement </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'createNewB2CVisa',  'method' => 'post' ,'class' =>'form-horizontal','enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-6">
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Visa Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Visa Slug" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Visa Title</label>
                                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Visa Title" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Visa Cover Photo (1100px * 800px)</label>
                                            <input type="file" class="form-control" id="v_c_photo" name="v_c_photo" accept="image/*"  placeholder="Enter Company Logo" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Visa Meta Keyword</label>
                                            <input type="text" class="form-control" id="keyword" name="keyword" placeholder="Enter Visa Keyword" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Visa Meta Description</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="Enter Visa description" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Visa Requirements</label>
                                            <textarea id="summernote" class="summernote" name="requirements"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Price Details</label>
                                            <textarea id="summernote" class="summernote" name="p_details"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Embassy Info</label>
                                            <textarea id="summernote" class="summernote" name="em_info"></textarea>
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
                                        <th>Country</th>
                                        <th>B2C View</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($visas as $visa)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$visa->country}}</td>
                                            <td><a href="{{'visa/'.$visa->slug}}" target="_blank">B2C View</a></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editB2CVisaPage?id='.$visa->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$visa->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteB2CVisaManagement?id='.$visa->id)}}">Delete</a>
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
                    <div class="modal fade" id="modal-danger">
                        <div class="modal-dialog">
                            <div class="modal-content bg-danger">
                                <div class="modal-body">
                                    <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                </div>
                                {{ Form::open(array('url' => 'deleteB2CVisaManagement',  'method' => 'post')) }}
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
        $('.select2').select2()
        $('.select2bs4').select2({
            theme: 'bootstrap4',
        })
        $(function () {
            $('.summernote').summernote()
            CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                mode: "htmlmixed",
                theme: "monokai"
            });
        })
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
    </script>
@endsection

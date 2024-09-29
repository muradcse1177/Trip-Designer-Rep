@extends('mainLayout.layout')
@section('title','Trip Designer || Manpower Management ')
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
                        <h1>Manpower Package Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Manpower Package Management</li>
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
                                <h3 class="card-title">Manpower Package </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'addB2CManpower',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-4">
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Cover Photo</label>
                                            <input type="file" class="form-control" id="c_photo" accept="image/*"  name="c_photo" placeholder="Enter Package Cover Photo" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Salary (Approximate)</label>
                                            <input type="text" class="form-control" id="salary"  name="salary" placeholder="Enter Package Salary" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Contact Period</label>
                                            <input type="text" class="form-control" id="period"  name="period" placeholder="Enter Contact Period" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Accommodation</label>
                                            <input type="text" class="form-control" id="accommodation"  name="accommodation" placeholder="Enter Accommodation Type" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Requirements</label>
                                            <textarea class="form-control" name="requirements" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Responsibilities</label>
                                            <textarea class="form-control" name="responsibilities" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Process Time</label>
                                            <textarea class="summernote" name="p_time"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Payment Method</label>
                                            <textarea class="summernote" name="p_method"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Refund Policy</label>
                                            <textarea class="summernote" name="r_policy"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Terms & Conditions</label>
                                            <textarea class="summernote" name="tnt"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12" >
                                        <div class="form-group">
                                            <label>Package  Exclusion</label>
                                            <textarea class="summernote" name="exclusion"></textarea>
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
                                <h3 class="card-title">Tour Country Management</h3>
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
                                        <th>Country Name</th>
                                        <th>Job Category</th>
                                        <th>Salary</th>
                                        <th>View</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($packages as $package)
                                        <tr>
                                            <td>{{$i}}</td>
                                            <td>{{$package->country}}</td>
                                            <td>
                                                <?php
                                                $output = '<ul style="list-style-type: disc !important; adding-left:1em !important;">';
                                                $listformat = explode("\n", json_decode($package->requirements));
                                                foreach ($listformat as $test => $line) {
                                                    $output .= "<li>".$line."</li>";
                                                };
                                                $output .='</ul>';
                                                ?>
                                                {!! $output !!}
                                            </td>
                                            <td>
                                                Price Per Adult : {{$package->salary}}/-
                                            </td>
                                            <td>
                                                <a href="{{url('manpower/'.$package->slug)}}">View Package</a>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editB2CManpowerPackagePage?id='.$package->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$package->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteB2CManpowerPackage?id='.$package->id)}}">Delete</a>
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

                        <div class="modal fade" id="modal-danger">
                            <div class="modal-dialog">
                                <div class="modal-content bg-danger">
                                    <div class="modal-body">
                                        <p style="text-align: center; font-size: 25px;">Are You Sure!!</p>
                                    </div>
                                    {{ Form::open(array('url' => 'deleteB2CManpowerPackage',  'method' => 'post')) }}
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

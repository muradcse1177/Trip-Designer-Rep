@extends('mainLayout.layout')
@section('title','Trip Designer || Hajj & Umrah ')
@section('webSettings','active')
@section('b2cHajjUmrahManagememt','active')
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
                        <h1>Hajj & Umrah Package Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Hajj & Umrah Package Management</li>
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
                                <h3 class="card-title">Hajj & Umrah Package </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: none;">
                                {{ Form::open(array('url' => 'addB2CHajjUmrahPackage',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Service Type</label>
                                            <select class="form-control select2bs4" name="type" id="type" style="width: 100%;" required>
                                                <option value="">Select Service Name</option>
                                                <option value="Umrah">Umrah</option>
                                                <option value="Hajj">Hajj</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Name</label>
                                            <input type="text" class="form-control" id="p_name"  name="p_name" placeholder="Enter Package Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Code</label>
                                            <input type="text" class="form-control" id="p_code"  name="p_code" placeholder="Enter Package Code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Night</label>
                                            <select class="form-control select2bs4 night" name="night" id="night" style="width: 100%;" required>
                                                <option value="">Select Package Night</option>
                                                <option value="1">1 Night</option>
                                                <option value="2">2 Night</option>
                                                <option value="3">3 Night</option>
                                                <option value="4">4 Night</option>
                                                <option value="5">5 Night</option>
                                                <option value="6">6 Night</option>
                                                <option value="7">7 Night</option>
                                                <option value="8">8 Night</option>
                                                <option value="9">9 Night</option>
                                                <option value="10">10 Night</option>
                                                <option value="11">11 Night</option>
                                                <option value="12">12 Night</option>
                                                <option value="13">13 Night</option>
                                                <option value="14">14 Night</option>
                                                <option value="15">15 Night</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Cover Photo</label>
                                            <input type="file" class="form-control" id="p_c_photo" accept="image/*"  name="p_c_photo" placeholder="Enter Package Cover Photo" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package More Photo</label>
                                            <input type="file" class="form-control" id="p_m_photo" accept="image/*"  name="p_m_photo[]" placeholder="Enter Package More Photo" required multiple>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price Per Adult</label>
                                            <input type="number" class="form-control" id="p_p_adult" min="0" name="p_p_adult" placeholder="Enter Price Per Adult" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price Per Child</label>
                                            <input type="number" class="form-control" id="p_p_child" min="0" name="p_p_child" placeholder="Enter Price Per Child" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price Per Infant</label>
                                            <input type="number" class="form-control" id="p_p_infant" min="0" name="p_p_infant" placeholder="Enter Price Per Infant" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter Slug" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Highlights</label>
                                        <textarea class="summernote" name="highlights"></textarea>
                                    </div>
                                </div>
                                <div class="highlights">

                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Inclusion</label>
                                        <textarea class="summernote" name="inclusion"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Exclusion</label>
                                        <textarea class="summernote" name="exclusion"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Terms & Conditions</label>
                                        <textarea class="summernote" name="tnt"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="include[]" value="Hotel" checked>
                                            <label for="customCheckbox1" class="custom-control-label">Hotel</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox2" name="include[]" value="SightSeeing" checked>
                                            <label for="customCheckbox2" class="custom-control-label">SightSeeing</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="include[]" value="Transfer" checked>
                                            <label for="customCheckbox3" class="custom-control-label">Transfer</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="include[]" value="Meal" checked>
                                            <label for="customCheckbox4" class="custom-control-label">Meal</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="include[]" value="Visa" checked>
                                            <label for="customCheckbox5" class="custom-control-label">Visa</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox6" name="include[]" value="Flight" checked>
                                            <label for="customCheckbox6" class="custom-control-label">Flight</label>
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
                                        <th>Cover Photo</th>
                                        <th>Type</th>
                                        <th>Package Name</th>
                                        <th>Price</th>
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
                                            <td><img src="{{url('/'.$package->p_c_photo)}}" height="80" width="129"></td>
                                            <td>{{$package->type}}</td>
                                            <td>{{$package->p_name}} - {{$package->p_code}}</td>
                                            <td>
                                                Price Per Adult : {{$package->p_p_adult}}/- <br>
                                                Price Per Child:  {{$package->p_p_child}}/- <br>
                                                Price Per Infant:  {{$package->p_p_infant}}/-
                                            </td>
                                            <td>
                                                <a href="{{url('hajj-umrah/'.$package->slug)}}" target="_blank">View Package</a>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-info">Action</button>
                                                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" role="menu" style="">
                                                        <a class="dropdown-item" href="{{url('editB2CHajjUmrahPage?id='.$package->id)}}">Edit</a>
                                                        <a class="dropdown-item delete" data-id="{{$package->id}}" data-toggle="modal" data-target="#modal-danger" href="{{url('deleteB2CTourPackage?id='.$package->id)}}">Delete</a>
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
                                    {{ Form::open(array('url' => 'deleteB2CHajjUmrahPackage',  'method' => 'post')) }}
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
        $('.night').on('change', function() {
            var night  = parseInt(this.value);
            var day = night + 1 ;
            var html = "";
            for (var i = 0; i<day; i++ ){
                html += '<div class="col-sm-12"> <div class="form-group"> <label>Title</label><input type="text" class="form-control"   name="title[]" placeholder="Enter Title" required> </div> </div>';
                html += '<div class="col-sm-12"> <div class="form-group"> <label>Description</label><textarea type="text" class="form-control"   name="description[]" placeholder="Enter Description" rows="3" required></textarea> </div> </div>';
            }
            $(".highlights").empty().append(html);
        });
    </script>
@endsection

@extends('mainLayout.layout')
@section('title','Trip Designer || Tour Package ')
@section('webSettings','active')
@section('b2cTourPackage','active')
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
                        <h1>Tour Package Management</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item">
                                <a href="{{url('/')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Tour Package Management</li>
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
                                {{ Form::open(array('url' => 'editB2CTourPackage',  'method' => 'post' ,'class' =>'form-horizontal' ,'enctype'=>"multipart/form-data")) }}
                                {{ csrf_field() }}
                                <div class="card-body row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Country Name</label>
                                            <select class="form-control select2bs4" name="c_name" id="c_name" style="width: 100%;" required>
                                                <option value="">Select Country Name</option>
                                                @foreach($countries as $country)
                                                    <option value="{{$country->name}}" <?php if($country->name == $package->c_name) echo 'selected'; ?> >{{$country->name}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Name</label>
                                            <input type="text" class="form-control" id="p_name" value="{{@$package->p_name}}"  name="p_name" placeholder="Enter Package Name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Code</label>
                                            <input type="text" class="form-control" id="p_code" value="{{@$package->p_code}}"  name="p_code" placeholder="Enter Package Code" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Night</label>
                                            <select class="form-control select2bs4 night" name="night" id="night" style="width: 100%;" required>
                                                <option value="">Select Package Night</option>
                                                <option value="1" <?php if($package->night == 1) echo 'selected'; ?> >1 Night</option>
                                                <option value="2" <?php if($package->night == 2) echo 'selected'; ?> >2 Night</option>
                                                <option value="3" <?php if($package->night == 3) echo 'selected'; ?>>3 Night</option>
                                                <option value="4" <?php if($package->night == 4) echo 'selected'; ?>>4 Night</option>
                                                <option value="5" <?php if($package->night == 5) echo 'selected'; ?>>5 Night</option>
                                                <option value="6" <?php if($package->night == 6) echo 'selected'; ?>>6 Night</option>
                                                <option value="7" <?php if($package->night == 7) echo 'selected'; ?>>7 Night</option>
                                                <option value="8" <?php if($package->night == 8) echo 'selected'; ?>>8 Night</option>
                                                <option value="9" <?php if($package->night == 9) echo 'selected'; ?>>9 Night</option>
                                                <option value="10" <?php if($package->night == 10) echo 'selected'; ?>>10 Night</option>
                                                <option value="11" <?php if($package->night == 11) echo 'selected'; ?>>11 Night</option>
                                                <option value="12" <?php if($package->night == 12) echo 'selected'; ?>>12 Night</option>
                                                <option value="13" <?php if($package->night == 13) echo 'selected'; ?>>13 Night</option>
                                                <option value="14" <?php if($package->night == 14) echo 'selected'; ?>>14 Night</option>
                                                <option value="15" <?php if($package->night == 15) echo 'selected'; ?>>15 Night</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package Cover Photo</label>
                                            <input type="file" class="form-control" id="p_c_photo" accept="image/*"  name="p_c_photo" placeholder="Enter Package Cover Photo" <?php if($package->p_c_photo) echo ''; else echo 'required'; ?>>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Package More Photo</label>
                                            <input type="file" class="form-control" id="p_m_photo" accept="image/*"  name="p_m_photo[]" placeholder="Enter Package More Photo" <?php if($package->p_m_photo) echo ''; else echo 'required'; ?>  multiple>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price Per Adult</label>
                                            <input type="number" class="form-control" id="p_p_adult" value="{{@$package->p_p_adult}}" min="0" name="p_p_adult" placeholder="Enter Price Per Adult" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Price Per Child</label>
                                            <input type="number" class="form-control" id="p_p_child" value="{{@$package->p_p_child}}" min="0" name="p_p_child" placeholder="Enter Price Per Child" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Vendors</label>
                                            <select class="form-control select2bs4" name="vendor" id="vendor" style="width: 100%;" required>
                                                <option value="">Select Vendor</option>
                                                @foreach($vendors as $vendor)
                                                    <option value="{{$vendor->name}}" <?php if($package->vendor == $vendor->name) echo 'selected';?>>{{$vendor->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Slug</label>
                                            <input type="text" class="form-control" value="{{@$package->slug}}" id="slug" name="slug" placeholder="Enter Slug" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"  value="{{@$package->slug}}" placeholder="Enter Slug" required>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Highlights</label>
                                        <textarea class="summernote" name="highlights"> {{json_decode($package->highlights)}}</textarea>
                                    </div>
                                </div>
                                <?php
                                $itinary = json_decode($package->itinary);
                                $title = json_decode($package->title);
                                ?>
                                <div class="highlights">
                                    @for($i =0; $i<=$package->night; $i++)
                                        <div class="col-sm-12"> <div class="form-group"> <label>Title</label><input type="text" class="form-control"  value="{{$title[$i]}}" name="title[]" placeholder="Enter Title" required> </div> </div>
                                        <div class="col-sm-12"> <div class="form-group"> <label>Description</label><textarea type="text" class="form-control"   name="description[]" placeholder="Enter Description" rows="3" required>{{$itinary[$i]}}</textarea> </div> </div>
                                    @endfor
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Inclusion</label>
                                        <textarea class="summernote" name="inclusion"> {{json_decode($package->inclusion)}} </textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Exclusion</label>
                                        <textarea class="summernote" name="exclusion"> {{json_decode($package->exclusion)}}</textarea>
                                    </div>
                                </div>
                                <div class="col-sm-12" >
                                    <div class="form-group">
                                        <label>Package  Terms & Conditions</label>
                                        <textarea class="summernote" name="tnt">{{json_decode($package->tnt)}}</textarea>
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
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox3" name="include[]" value="Transfer">
                                            <label for="customCheckbox3" class="custom-control-label">Transfer</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox4" name="include[]" value="Meal">
                                            <label for="customCheckbox4" class="custom-control-label">Meal</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox5" name="include[]" value="Visa">
                                            <label for="customCheckbox5" class="custom-control-label">Visa</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="customCheckbox6" name="include[]" value="Flight">
                                            <label for="customCheckbox6" class="custom-control-label">Flight</label>
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

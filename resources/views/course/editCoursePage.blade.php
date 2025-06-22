@extends('mainLayout.layout')
@section('title','Trip Designer || Edit Course')
@section('course','active')
@section('academy','active')
@section('academyMenu','menu-open')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Course</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Course</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Edit Course</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('updateCourse') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $course->id }}">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Course Title</label>
                                                <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Course Type</label>
                                                <select name="type" class="form-control" required>
                                                    <option value="Live Course" {{ $course->type == 'Live Course' ? 'selected' : '' }}>Live Course</option>
                                                    <option value="Recorded Course" {{ $course->type == 'Recorded Course' ? 'selected' : '' }}>Recorded Course</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Star</label>
                                                <input type="number" step="0.01" max="5" min="0" name="star" class="form-control" value="{{ $course->star }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Price</label>
                                                <input type="number" name="price" class="form-control" value="{{ $course->c_price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Discounted Price</label>
                                                <input type="number" name="d_price" class="form-control" value="{{ $course->d_c_price }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Class Number</label>
                                                <input type="number" name="class" class="form-control" value="{{ $course->class_no }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Batch Number</label>
                                                <input type="text" name="batch" class="form-control" value="{{ $course->batch_no }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Class Time</label>
                                                <input type="text" name="time" class="form-control" value="{{ $course->class_time }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Seats Remaining</label>
                                                <input type="number" name="seats" class="form-control" value="{{ $course->seat_remain }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Course Cover Photo</label><br>
                                                <img src="{{ url(json_decode($course->c_c_photo)) }}" width="100">
                                                <input type="file" name="c_photo" class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Course Page Photo</label><br>
                                                <img src="{{ url(json_decode($course->c_p_photo)) }}" width="100">
                                                <input type="file" name="p_photo" class="form-control mt-2">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Youtube Link</label>
                                                <input type="text" name="link" class="form-control" value="{{ json_decode($course->y_link) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="description" class="form-control" required>{{ json_decode($course->c_descripsion) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="card card-info collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Course Curriculum</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                        $i=1;
                                    ?>
                                    <div class="row add-more">
                                        @foreach($course->curriculum as $index => $item)
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Module Name</label>
                                                    <input type="text" class="form-control" name="module[]" value="{{ $item['module'] }}" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-7">
                                                <div class="form-group">
                                                    <label>Module Details</label>
                                                    <input type="text" class="form-control" name="details[]" value="{{ $item['details'] }}" required>
                                                </div>
                                            </div>
                                            @if($i == 1)
                                                <div class="col-sm-2" id="add" style=" margin-top: 30px;">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success float-right ">Add More</button>
                                                    </div>
                                                </div>
                                            @endif
                                                <?php
                                                $i++;
                                                ?>
                                        @endforeach
                                            <?php
                                            $i=1;
                                            ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card card-info collapsed-card">
                                                <div class="card-header">
                                                    <h3 class="card-title">Course Instructor</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row add-more-ins">
                                        @foreach($course->instructor as $index => $inst)
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Instructor Name</label>
                                                    <input type="text" class="form-control" name="name[]" value="{{ $inst['name'] }}" placeholder="Enter Instructor Name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Instructor Designation</label>
                                                    <input type="text" class="form-control" name="designation[]" value="{{ $inst['designation'] }}" placeholder="Enter Instructor Designation" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Instructor Institute</label>
                                                    <input type="text" class="form-control" name="institute[]" value="{{ $inst['institute'] }}" placeholder="Enter Instructor Institute" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Instructor Photo</label>
                                                    <img src="{{ url($inst['photo']) }}" width="60"><br>
                                                    <input type="file" class="form-control mt-2" name="photo[]" accept="image/*">
                                                    <input type="hidden" name="existing_photo[]" value="{{ $inst['photo'] }}">
                                                </div>
                                            </div>
                                            @if($i == 1)
                                                <div class="col-sm-2 d-flex align-items-end" id="add_ins">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success float-right">Add More</button>
                                                    </div>
                                                </div>
                                            @endif

                                                <?php
                                                $i++;
                                                ?>
                                        @endforeach
                                        <?php
                                        $i=1;
                                        ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">In the course you get</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row add-more-get">
                                        @php $j = 1; @endphp
                                        @foreach($course->g_course as $item)
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <label>Get Details</label>
                                                    <input type="text" class="form-control" name="g_details[]" value="{{ $item }}" placeholder="Enter Get Details" required>
                                                </div>
                                            </div>
                                            @if($j == 1)
                                                <div class="col-sm-2 d-flex align-items-end" id="add_get">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success float-right">Add More</button>
                                                    </div>
                                                </div>
                                            @endif
                                            @php $j++; @endphp
                                        @endforeach
                                        @php $j = 1; @endphp
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">Course Review</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row add-more-stu">
                                        @php $k = 1; @endphp
                                        @foreach($course->review as $index => $rev)
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label>Students Name</label>
                                                    <input type="text" class="form-control" name="s_name[]" value="{{ $rev['name'] }}" placeholder="Enter Students Name" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Review</label>
                                                    <input type="text" class="form-control" name="review[]" value="{{ $rev['review'] }}" placeholder="Enter Review" required>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label>Students Photo</label><br>
                                                    <img src="{{ url($rev['photo']) }}" width="60"><br>
                                                    <input type="file" class="form-control mt-2" name="s_photo[]" accept="image/*">
                                                    <input type="hidden" name="existing_s_photo[]" value="{{ $rev['photo'] }}">
                                                </div>
                                            </div>
                                            @if($k == 1)
                                                <div class="col-sm-1 d-flex align-items-end" id="add_stu">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success float-right">Add</button>
                                                    </div>
                                                </div>
                                            @endif
                                            @php $k++; @endphp
                                        @endforeach
                                        @php $k = 0; @endphp
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="card card-info">
                                                <div class="card-header">
                                                    <h3 class="card-title">Next Approximate Course Date</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row add-more-date">
                                        @php $d = 1; @endphp
                                        @foreach($course->app_date as $date)
                                            <div class="col-sm-10">
                                                <div class="form-group">
                                                    <label>Approximate Course Date</label>
                                                    <input type="date" class="form-control" name="date[]" value="{{ $date }}" placeholder="Enter Approximate course Date" required>
                                                </div>
                                            </div>
                                            @if($d == 1)
                                                <div class="col-sm-2 d-flex align-items-end" id="add_date">
                                                    <div class="form-group">
                                                        <button type="button" class="btn btn-success float-right">Add More</button>
                                                    </div>
                                                </div>
                                            @endif
                                            @php $d++; @endphp
                                        @endforeach
                                        @php $d = 0; @endphp
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-warning float-right">Update Course</button>
                                    </div>
                                </form>
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
        $(function () {
            $('#dobDiv').datetimepicker({
                format: 'Y-M-D',
                maxDate: new Date()
            });
        })
        $(document).on('click', '.delete', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('.id').val(id);
        });
        $("body").on("click", "#add", function () {
            var html = '<div class="row removee">';
            html += '<div class="col-sm-3"><div class="form-group"><label>Module Name</label><input type="text" class="form-control" name="module[]" placeholder="Enter Module Name" required></div></div>';
            html += '<div class="col-sm-7"><div class="form-group"><label>Module Details</label><input type="text" class="form-control" name="details[]" placeholder="Enter Module Details" required></div></div>';
            html += '<div class="col-sm-2 remove" style="margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right">Remove</button></div></div>';
            html += '</div>';
            $(".add-more").last().after(html);
        });
        $("body").on("click", ".remove", function () {
            $(this).closest(".removee").remove();
        });

        // Add Instructor
        $("body").on("click", "#add_ins", function () {
            var html = '<div class="row removee_ins">';
            html += '<div class="col-sm-2"><div class="form-group"><label>Instructor Name</label><input type="text" class="form-control" name="name[]" placeholder="Enter Instructor Name" required></div></div>';
            html += '<div class="col-sm-3"><div class="form-group"><label>Instructor Designation</label><input type="text" class="form-control" name="designation[]" placeholder="Enter Instructor Designation" required></div></div>';
            html += '<div class="col-sm-2"><div class="form-group"><label>Instructor Institute</label><input type="text" class="form-control" name="institute[]" placeholder="Enter Instructor Institute" required></div></div>';
            html += '<div class="col-sm-3"><div class="form-group"><label>Instructor Photo</label><input type="file" class="form-control" name="photo[]" accept="image/*" required></div></div>';
            html += '<div class="col-sm-2 remove_ins" style="margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right">Remove</button></div></div>';
            html += '</div>';
            $(".add-more-ins").last().after(html);
        });
        $("body").on("click", ".remove_ins", function () {
            $(this).closest(".removee_ins").remove();
        });

        // Add Course Get Item
        $("body").on("click", "#add_get", function () {
            var html = '<div class="row removee_get">';
            html += '<div class="col-sm-10"><div class="form-group"><label>Get Details</label><input type="text" class="form-control" name="g_details[]" placeholder="Enter Get Details" required></div></div>';
            html += '<div class="col-sm-2 remove_get" style="margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right">Remove</button></div></div>';
            html += '</div>';
            $(".add-more-get").last().after(html);
        });
        $("body").on("click", ".remove_get", function () {
            $(this).closest(".removee_get").remove();
        });

        // Add Student Review
        $("body").on("click", "#add_stu", function () {
            var html = '<div class="row removee_stu">';
            html += '<div class="col-sm-2"><div class="form-group"><label>Students Name</label><input type="text" class="form-control" name="s_name[]" placeholder="Enter Students Name" required></div></div>';
            html += '<div class="col-sm-6"><div class="form-group"><label>Review</label><input type="text" class="form-control" name="review[]" placeholder="Enter Review" required></div></div>';
            html += '<div class="col-sm-2"><div class="form-group"><label>Students Photo</label><input type="file" class="form-control" name="s_photo[]" accept="image/*"></div></div>';
            html += '<div class="col-sm-2 remove_stu" style="margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right">Remove</button></div></div>';
            html += '</div>';
            $(".add-more-stu").last().after(html);
        });
        $("body").on("click", ".remove_stu", function () {
            $(this).closest(".removee_stu").remove();
        });

        // Add Date
        $("body").on("click", "#add_date", function () {
            var html = '<div class="row removee_date">';
            html += '<div class="col-sm-10"><div class="form-group"><label>Approximate Course Date</label><input type="date" class="form-control" name="date[]" placeholder="Enter Approximate course Date" required></div></div>';
            html += '<div class="col-sm-2 remove_date" style="margin-top: 30px;"><div class="form-group"><button type="button" class="btn btn-danger float-right">Remove</button></div></div>';
            html += '</div>';
            $(".add-more-date").last().after(html);
        });
        $("body").on("click", ".remove_date", function () {
            $(this).closest(".removee_date").remove();
        });
    </script>
@endsection

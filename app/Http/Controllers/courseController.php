<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class courseController extends Controller
{
    public function courseManagement(Request $request){
        try{
            $rows1 = DB::table('course_details')
                ->orderBy('id','asc')
                ->get();
            return view('course.courseManagement',['courses' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addNewCourse(Request $request){
        try{
            $request->validate([
                'title' => 'required|string|max:200',
                'type' => 'required|string|max:30',
                'star' => 'required|numeric|min:0|max:5',
                'price' => 'required|numeric',
                'd_price' => 'required|numeric',
                'class' => 'required|integer',
                'batch' => 'required|string|max:20',
                'time' => 'required|string',
                'c_photo' => 'required|image',
                'p_photo' => 'required|image',
                'link' => 'required|string',
                'description' => 'required|string',
            ]);

            // Upload course cover and page photos

            $fileName = time() . '.' . $request->c_photo->extension();
            $request->c_photo->move(public_path('images/upload/course/'), $fileName);
            $cCoverPhoto = 'public/images/upload/course/'.$fileName;

            $fileName = 'A'.time() . '.' . $request->p_photo->extension();
            $request->p_photo->move(public_path('images/upload/course/'), $fileName);
            $cPagePhoto = 'public/images/upload/course/'.$fileName;

            // Prepare structured data
            $curriculum = [];
            if ($request->has('module')) {
                foreach ($request->module as $index => $mod) {
                    $curriculum[] = [
                        'module' => $mod,
                        'details' => $request->details[$index] ?? '',
                    ];
                }
            }

            $instructors = [];
            if ($request->has('name')) {
                foreach ($request->name as $index => $name) {
                    $photoPath = null;
                    if (isset($request->photo[$index])) {
                        $fileName = time() . '.' . $request->photo[$index]->extension();
                        $request->photo[$index]->move(public_path('images/upload/instructor/'), $fileName);
                        $photoPath = 'public/images/upload/instructor/'.$fileName;
                    }

                    $instructors[] = [
                        'name' => $name,
                        'designation' => $request->designation[$index] ?? '',
                        'institute' => $request->institute[$index] ?? '',
                        'photo' => $photoPath,
                    ];
                }
            }
            $getItems = $request->g_details ?? [];

            $reviews = [];
            if ($request->has('s_name')) {
                foreach ($request->s_name as $index => $s_name) {
                    $photoPath = null;
                    if (isset($request->s_photo[$index])) {
                        $fileName = time() . '.' . $request->s_photo[$index]->extension();
                        $request->s_photo[$index]->move(public_path('images/upload/students/'), $fileName);
                        $photoPath = 'public/images/upload/students/'.$fileName;
                    }
                    $reviews[] = [
                        'name' => $s_name,
                        'review' => $request->institute[$index] ?? '',
                        'photo' => $photoPath,
                    ];
                }
            }

            $dates = $request->date ?? [];
            $slug = Str::slug($request->title);
            // Insert data into DB
            $result = DB::table('course_details')->insert([
                'title' => $request->title,
                'type' => $request->type,
                'star' => $request->star,
                'c_price' => $request->price,
                'd_c_price' => $request->d_price,
                'class_no' => $request->class,
                'batch_no' => $request->batch,
                'class_time' => $request->time,
                'seat_remain' => $request->time,
                'c_c_photo' => json_encode($cCoverPhoto),
                'c_p_photo' => json_encode($cPagePhoto),
                'y_link' => json_encode($request->link),
                'c_descripsion' => json_encode($request->description),
                'curriculum' => json_encode($curriculum),
                'instructor' => json_encode($instructors),
                'g_course' => json_encode($getItems),
                'review' => json_encode($reviews),
                'app_date' => json_encode($dates),
                'slug' => $slug,
            ]);

            if($result){
                return back()->with('successMessage', 'Course Details Added Successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editCoursePage(Request $request)
    {
        $id = $request->id;
        $course = DB::table('course_details')->where('id', $id)->first();

        if (!$course) {
            return back()->with('errorMessage', 'Course not found.');
        }

        // Decode JSON fields
        $course->curriculum = json_decode($course->curriculum, true);
        $course->instructor = json_decode($course->instructor, true);
        $course->g_course = json_decode($course->g_course, true);
        $course->review = json_decode($course->review, true);
        $course->app_date = json_decode($course->app_date, true);

        return view('course.editCoursePage', compact('course'));
    }
    public function updateCourse(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:200',
                'type' => 'required|string|max:30',
                'star' => 'required|numeric|min:0|max:5',
                'price' => 'required|numeric',
                'd_price' => 'required|numeric',
                'class' => 'required|integer',
                'batch' => 'required|string|max:20',
                'time' => 'required|string',
                'seats' => 'required|integer',
                'link' => 'required|string',
                'description' => 'required|string',
            ]);

            $course = DB::table('course_details')->where('id', $request->id)->first();
            if (!$course) {
                return back()->with('errorMessage', 'Course not found');
            }

            // Cover photo
            if ($request->hasFile('c_photo')) {
                $fileName = time() . '.' . $request->c_photo->extension();
                $request->c_photo->move(public_path('images/upload/course/'), $fileName);
                $cCoverPhoto = 'public/images/upload/course/' . $fileName;
            } else {
                $cCoverPhoto = json_decode($course->c_c_photo);
            }

            // Page photo
            if ($request->hasFile('p_photo')) {
                $fileName = 'A' . time() . '.' . $request->p_photo->extension();
                $request->p_photo->move(public_path('images/upload/course/'), $fileName);
                $cPagePhoto = 'public/images/upload/course/' . $fileName;
            } else {
                $cPagePhoto = json_decode($course->c_p_photo);
            }

            // Curriculum
            $curriculum = [];
            if ($request->has('module')) {
                foreach ($request->module as $index => $mod) {
                    $curriculum[] = [
                        'module' => $mod,
                        'details' => $request->details[$index] ?? '',
                    ];
                }
            }

            // Instructors
            $instructors = [];
            if ($request->has('name')) {
                foreach ($request->name as $index => $name) {
                    if (isset($request->photo[$index])) {
                        $fileName = time() . '_' . $index . '.' . $request->photo[$index]->extension();
                        $request->photo[$index]->move(public_path('images/upload/instructor/'), $fileName);
                        $photoPath = 'public/images/upload/instructor/' . $fileName;
                    } else {
                        $photoPath = $request->existing_photo[$index] ?? null;
                    }

                    $instructors[] = [
                        'name' => $name,
                        'designation' => $request->designation[$index] ?? '',
                        'institute' => $request->institute[$index] ?? '',
                        'photo' => $photoPath,
                    ];
                }
            }

            // Get Items
            $getItems = $request->g_details ?? [];

            // Reviews
            $reviews = [];
            if ($request->has('s_name')) {
                foreach ($request->s_name as $index => $s_name) {
                    if (isset($request->s_photo[$index])) {
                        $fileName = time() . '_' . $index . '.' . $request->s_photo[$index]->extension();
                        $request->s_photo[$index]->move(public_path('images/upload/students/'), $fileName);
                        $photoPath = 'public/images/upload/students/' . $fileName;
                    } else {
                        $photoPath = $request->existing_s_photo[$index] ?? null;
                    }

                    $reviews[] = [
                        'name' => $s_name,
                        'review' => $request->review[$index] ?? '',
                        'photo' => $photoPath,
                    ];
                }
            }

            // Dates
            $dates = $request->date ?? [];

            // Slug
            $slug = Str::slug($request->title);

            // Update
            DB::table('course_details')->where('id', $request->id)->update([
                'title' => $request->title,
                'type' => $request->type,
                'star' => $request->star,
                'c_price' => $request->price,
                'd_c_price' => $request->d_price,
                'class_no' => $request->class,
                'batch_no' => $request->batch,
                'class_time' => $request->time,
                'seat_remain' => $request->seats,
                'c_c_photo' => json_encode($cCoverPhoto),
                'c_p_photo' => json_encode($cPagePhoto),
                'y_link' => json_encode($request->link),
                'c_descripsion' => json_encode($request->description),
                'curriculum' => json_encode($curriculum),
                'instructor' => json_encode($instructors),
                'g_course' => json_encode($getItems),
                'review' => json_encode($reviews),
                'app_date' => json_encode($dates),
                'slug' => $slug,
            ]);

            return redirect()->back()->with('successMessage', 'Course updated successfully!');
        } catch (\Exception $e) {
            return back()->with('errorMessage', $e->getMessage());
        }
    }
    public function toggleCourseStatus($id)
    {
        $course = DB::table('course_details')->where('id', $id)->first();

        if (!$course) {
            return redirect()->back()->with('errorMessage', 'Course not found.');
        }

        $newStatus = $course->status == 1 ? 0 : 1;

        DB::table('course_details')->where('id', $id)->update(['status' => $newStatus]);

        $message = $newStatus ? 'Course activated successfully.' : 'Course deactivated successfully.';
        return redirect()->back()->with('successMessage', $message);
    }
    public function deleteCourse($id)
    {
        $course = DB::table('course_details')->where('id', $id)->first();

        if (!$course) {
            return redirect()->back()->with('errorMessage', 'Course not found.');
        }

        // Optionally delete associated images if stored locally
        if ($course->c_c_photo) {
            @unlink(public_path(str_replace('public/', '', json_decode($course->c_c_photo))));
        }
        if ($course->c_p_photo) {
            @unlink(public_path(str_replace('public/', '', json_decode($course->c_p_photo))));
        }

        DB::table('course_details')->where('id', $id)->delete();

        return redirect()->back()->with('successMessage', 'Course deleted successfully.');
    }

}

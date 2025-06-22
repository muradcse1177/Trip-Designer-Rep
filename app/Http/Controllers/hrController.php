<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class hrController extends Controller
{
    public function designation(Request $request){
        try{
            $rows1 = DB::table('designations')
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            return view('hr.designation',['designations' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addDesignation(Request $request){
        try{
            $row = DB::table('designations')->where('agent_id', Session::get('agent_id')) ->where('name', $request->name)->get();
            if($row->count()>0){
                return back()->with('errorMessage', 'Designation Already Exits!! Please try again!!');
            }
            $result = DB::table('designations')->insert([
                'agent_id' => Session::get('agent_id'),
                'name' => $request->name,
            ]);
            if ($result) {
                return redirect()->to('designation')->with('successMessage', 'Designation added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editDesignationPage(Request $request){
        try{
            $rows = DB::table('designations')->where('id',$request->id)->first();
            return view('hr.editDesignationPage',['designation' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function updateDesignation (Request $request){
        try{

            $result = DB::table('designations')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->update([
                    'name' => $request->name,
                ]);
            if ($result) {
                return redirect()->to('designation')->with('successMessage', 'Designation Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteDesignation(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('designations')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('agent_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('designation')->with('successMessage', 'Designation deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function employeeSettings(Request $request){
        try{
            $rows1 = DB::table('employees')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows2 = DB::table('designations')
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('countries')->get();
            return view('hr.employeeSettings',['employees' => $rows1,'designations' => $rows2,'countries' => $rows3]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addNewEmployee(Request $request){
        try{
            if($request) {
                $name = $request->name;
                $username = $request->name;
                $email = $request->email;
                $phoneCode = '880';
                $phone = $request->phone;
                $password = Hash::make($request->password);
                $address = $request->address;
                $designation = $request->designation;

                $rows = DB::table('users')
                    ->where('company_pnone', $request->phone)
                    ->orwhere('company_email', $request->email)
                    ->distinct()->get()->count();
                if ($rows > 0) {
                    return back()->with('errorMessage', 'Employee already exits!!');
                } else {
                    $result = DB::table('users')->insert([
                        'company_name' => $username,
                        'company_email' => $email,
                        'phone_code' => $phoneCode,
                        'company_pnone' => $phone,
                        'password' => $password,
                        'address' => $address,
                        'status' => 'Active',
                        'role' => 5,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    if ($result) {
                        $result = DB::table('employees')->insert([
                            'agent_id' => Session::get('agent_id'),
                            'name' => $name,
                            'phone' => $phone,
                            'email' => $email,
                            'address' => $address,
                            'designation' => $designation,
                            'role' => 5,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        if ($result) {
                            return redirect()->to('employees')->with('successMessage', 'New employee added successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editEmployeePage(Request $request){
        try{
            $rows1 = DB::table('employees')->where('agent_id',Session::get('agent_id'))->where('id',$request->id)->first();
            $rows2 = DB::table('designations')->where('agent_id',Session::get('agent_id'))->get();
            $rows3 = DB::table('countries')->get();
            return view('hr.employeeEditPage',['employee' => $rows1,'designations' => $rows2,'countries' => $rows3]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editEmployee(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $rows = DB::table('employees')->where('id', $request->id)->first();
                    $rows1 = DB::table('users')->where('company_email', $rows->email)->first();
                    $name = $request->name;
                    $username = $request->name;
                    $email = $request->email;
                    $phoneCode = '880';
                    $phone = $request->phone;
                    $password = Hash::make($request->password);
                    $address = $request->address;
                    $designation = $request->designation;

                    if($password){
                        $password = Hash::make($request->password);
                        $result =DB::table('users')
                            ->where('id', $rows1->id)
                            ->update([
                                'company_name' => $username,
                                'company_email' => $email,
                                'phone_code' => $phoneCode,
                                'company_pnone' => $phone,
                                'password' => $password,
                                'address' => $address,
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        if($result) {
                            $result =DB::table('employees')
                                ->where('id', $request->id)
                                ->update([
                                    'name' => $name,
                                    'phone' => $phone,
                                    'email' => $email,
                                    'address' => $address,
                                    'designation' => $designation,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            if ($result) {
                                return redirect()->to('employees')->with('successMessage', 'Data updated successfully!!');
                            } else {
                                return back()->with('errorMessage', 'Please try again!!');
                            }
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }else{
                        $result =DB::table('users')
                            ->where('id', $rows1->id)
                            ->update([
                                'company_name' => $username,
                                'company_email' => $email,
                                'phone_code' => $phoneCode,
                                'company_pnone' => $phone,
                                'address' => $address,
                                'updated_at' => date('Y-m-d H:i:s'),
                            ]);
                        if($result) {
                            $result =DB::table('employees')
                                ->where('id', $request->id)
                                ->update([
                                    'name' => $name,
                                    'phone' => $phone,
                                    'email' => $email,
                                    'address' => $address,
                                    'designation' => $designation,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            if ($result) {
                                return redirect()->to('employees')->with('successMessage', 'Data updated successfully!!');
                            } else {
                                return back()->with('errorMessage', 'Please try again!!');
                            }
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteEmployee(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $rows = DB::table('employees')->where('id', $request->id)->first();
                    $rows1 = DB::table('users')->where('company_email', $rows->email)->first();
                    $result =DB::table('employees')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        $result =DB::table('users')
                            ->where('id', $rows1->id)
                            ->delete();
                        return redirect()->to('employees')->with('successMessage', 'Data deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function roles(Request $request){
        try{
            $rows1 = DB::table('attribute')->get();
            $rows2 = DB::table('designations')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('assign_role')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            return view('hr.role',['attributes' => $rows1,'designations' => $rows2,'roles' => $rows3]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addRole(Request $request){
        try{
            $row = DB::table('assign_role')->where('agent_id', Session::get('user_id')) ->where('designation', $request->designation)->get();
            if($row->count()>0){
                return back()->with('errorMessage', 'This Role Already Exits!! Please try again!!');
            }
            $result = DB::table('assign_role')->insert([
                'agent_id' => Session::get('user_id'),
                'designation' => $request->designation,
                'details' => json_encode($request->role),
            ]);
            if ($result) {
                return redirect()->to('roles')->with('successMessage', 'Role assigned successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function deleteRole(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('assign_role')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('roles')->with('successMessage', 'Assigned role deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function leaves(Request $request){
        try{
            $rows1 = DB::table('genaral_holiday')->first();
            $user = DB::table('employees')->where('agent_id',Session::get('agent_id'))->get();
            $leaves = DB::table('leave_mngt')->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')->get();
            if(Session::get('user_role') <= 2){
                return view('hr.leaves.leaves',['g_holidays' => $rows1,'user' => $user,'leaves' => $leaves,]);
            }
            else {
                $rows2 = DB::table('users')->where('id', Session::get('user_id'))->first();
                $user = DB::table('employees')->where('email', $rows2->company_email)->first();
                $leaves = DB::table('leave_mngt')->where('user_id', Session::get('user_id'))->orderBy('id','desc')->get();
                return view('hr.leaves.leaves', ['g_holidays' => $rows1, 'user' => $user, 'leaves' => $leaves,]);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function newLeaveRequest(Request $request)
    {
        try {
//             Validate required fields (optional but recommended)
            $request->validate([
                'category' => 'required|string',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'reason' => 'required',
            ]);

            // Calculate the number of days including both start and end date
            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);
            $days = $startDate->diffInDays($endDate) + 1;

            // Insert leave request
            $inserted = DB::table('leave_mngt')->insert([
                'user_id'    => Session::get('user_id'),
                'agent_id'   => Session::get('agent_id'),
                'category'   => $request->category,
                'start_date' => $request->start_date,
                'end_date'   => $request->end_date,
                'days'       => $days,
                'status'     => 'Requested',
                'cause'      => json_encode($request->reason),
            ]);

            if ($inserted) {
                return redirect()->to('leaves')->with('successMessage', 'New Leave Request Sent Successfully!');
            }

            return back()->with('errorMessage', 'Failed to send leave request. Please try again.');

        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function approveLeave(Request $request)
    {
        try {
            $leave = DB::table('leave_mngt')->where('id', $request->id)->first();

            if (!$leave) {
                return redirect()->to('leaves')->with('errorMessage', 'Leave request not found!');
            }

            if ($leave->status === 'Approved') {
                return redirect()->to('leaves')->with('errorMessage', 'Already Approved. Please Check Again!');
            }

            $userAccount = DB::table('users')->where('id', $leave->user_id)->first();
            $employee = DB::table('employees')->where('email', $userAccount->company_email)->first();

            if (!$employee) {
                return redirect()->to('leaves')->with('errorMessage', 'Employee not found!');
            }

            $leaveTypes = [
                'Casual Leave'     => 'casual_leave',
                'Seek Leave'       => 'seek_leave',
                'Marriage Leave'   => 'marriage_leave',
                'Fatherhood Leave' => 'fatherhood',
                'Motherhood Leave' => 'motherhood',
                'Earned Leave'     => 'earned_leave',
            ];

            $leaveType = $leaveTypes[$leave->category] ?? null;

            if (!$leaveType) {
                return redirect()->to('leaves')->with('errorMessage', 'Invalid leave category!');
            }

            $remainingLeave = $employee->$leaveType - $leave->days;

            if ($remainingLeave < 0) {
                return redirect()->to('leaves')->with('errorMessage', 'Your applied leave is greater than your available leave!');
            }

            // Update employee's leave
            DB::table('employees')->where('id', $employee->id)->update([
                $leaveType => $remainingLeave
            ]);

            // Approve the leave
            DB::table('leave_mngt')->where('id', $request->id)->update([
                'status' => 'Approved'
            ]);

            return redirect()->to('leaves')->with('successMessage', 'Your Leave Request Approved Successfully!');
        } catch (\Exception $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function rejectLeave(Request $request)
    {
        try {
            $leave = DB::table('leave_mngt')->where('id', $request->id)->first();

            if (!$leave) {
                return redirect()->to('leaves')->with('errorMessage', 'Leave request not found.');
            }

            if ($leave->status === 'Approved') {
                return redirect()->to('leaves')->with('errorMessage', 'This leave has already been approved.');
            }

            if ($leave->status === 'Rejected') {
                return redirect()->to('leaves')->with('errorMessage', 'This leave has already been rejected.');
            }

            $update = DB::table('leave_mngt')
                ->where('id', $request->id)
                ->update(['status' => 'Rejected']);

            if ($update) {
                return redirect()->to('leaves')->with('successMessage', 'Leave request has been rejected successfully.');
            } else {
                return back()->with('errorMessage', 'Failed to reject leave request. Please try again.');
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function requestEarnedLeave(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        DB::table('leave_mngt')->insert([
            'user_id'    => Session::get('user_id'),
            'agent_id'   => Session::get('agent_id'),
            'category'   => 'Earned Leave',
            'start_date' => $request->start_date,
            'end_date'   => $request->end_date,
            'days'       => (Carbon::parse($request->end_date)->diffInDays(Carbon::parse($request->start_date)) + 1),
            'status'     => 'Requested',
            'cause'      => json_encode($request->reason),
        ]);

        return redirect()->back()->with('successMessage', 'Earned Leave Request Sent Successfully!');
    }

    public function approveEarnedLeave(Request $request)
    {
        try {
            $leave = DB::table('leave_mngt')->where('id', $request->id)->first();

            if (!$leave || $leave->category !== 'Earned Leave') {
                return redirect()->back()->with('errorMessage', 'Invalid or non-earned leave request.');
            }

            $user = DB::table('users')->where('id', $leave->user_id)->first();
            $employee = DB::table('employees')->where('email', $user->company_email)->first();

            if (!$employee) {
                return redirect()->back()->with('errorMessage', 'Employee record not found.');
            }

            // Plus earned leave
            DB::table('employees')->where('id', $employee->id)->update([
                'earned_leave' => $employee->earned_leave + $leave->days,
            ]);

            // Delete leave_mngt row
            DB::table('leave_mngt')->where('id', $leave->id)->delete();

            return redirect()->back()->with('successMessage', 'Earned Leave Approved and Updated Successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('errorMessage', 'Error: ' . $e->getMessage());
        }
    }
    public function attendance(Request $request){
        try{
            $userid = 'user_id';
            $id = Session::get('user_id');
            if(Session::get('user_role') == 2){
                $userid = 'agent_id';
                $id = Session::get('agent_id');
            }
            $employees = DB::table('attendance')
                ->join('users', 'attendance.user_id', '=', 'users.id')
                ->where('attendance.agent_id', $id) // $id = specific employee's ID
                ->where('users.role',5)
                ->distinct()
                ->orderBy('attendance.id', 'desc')
                ->paginate(30);
            //dd($employees);
            $attendance = DB::table('attendance')
                ->where($userid,$id)
                ->distinct()
                ->orderBy('id','desc')->paginate(30);
            //dd($attendance);
            $filter=0;
            return view('hr.attendance', ['atts' => $attendance,'employees' => $employees,'filter' => $filter,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function entryAttendance(Request $request)
    {
        try {
            $userId = Session::get('user_id');
            $agentId = Session::get('agent_id');
            $today = date('Y-m-d');
            $now = now()->setTimezone('Asia/Dhaka');
            $entryDeadline = $now->copy()->setTime(10, 10); // 10:10 AM
            $exitDeadline = $now->copy()->setTime(19, 0);    // 7:00 PM

            // Check if attendance already submitted
            $existingAttendance = DB::table('attendance')
                ->where('user_id', $userId)
                ->where('date', $today)
                ->first();

            if ($existingAttendance) {
                return back()->with('errorMessage', 'Attendance already submitted. Try again tomorrow!');
            }

            // Check if current time is beyond exit time
            if ($now->gt($exitDeadline)) {
                return back()->with('errorMessage', 'Attendance time is over. Entry not allowed after 7:00 PM.');
            }

            // Calculate late only if after 10:10 AM
            $late = '';
            if ($now->gt($entryDeadline)) {
                $diff = $now->diff($entryDeadline);
                $hours = $diff->h > 0 ? $diff->h . 'H :' : '';
                $minutes = $diff->i > 0 ? $diff->i . 'M :' : '';
                $seconds = $diff->s > 0 ? $diff->s . 'S' : '';
                $late = $hours . $minutes . $seconds;
            }

            // Get IP
            $ipAddress = $request->ip();

            // Save attendance
            $result = DB::table('attendance')->insert([
                'user_id' => $userId,
                'agent_id' => $agentId,
                'entry_time' => $now,
                'late' => $late,
                'ip' => $ipAddress,
                'date' => $today,
                'month' => $now->format('F'),
            ]);

            if ($result) {
                return redirect()->to('attendance')->with('successMessage', 'Your attendance was submitted successfully!');
            } else {
                return back()->with('errorMessage', 'Attendance submission failed. Please try again!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function exitAttendance(Request $request)
    {
        try {
            $userId = Session::get('user_id');
            $today = Carbon::now('Asia/Dhaka')->toDateString();

            $attendance = DB::table('attendance')
                ->where('user_id', $userId)
                ->where('date', $today)
                ->first();

            if (!$attendance) {
                return back()->with('errorMessage', 'No entry found. Please mark your entry first.');
            }

            if (!empty($attendance->exit_time)) {
                return back()->with('errorMessage', 'Exit already submitted. Try again tomorrow!');
            }

            $now = Carbon::now('Asia/Dhaka');
            $scheduledExit = Carbon::createFromFormat('Y-m-d H:i:s', $today . ' 19:00:00', 'Asia/Dhaka');

            $earlyExit = null;
            if ($now->lt($scheduledExit)) {
                $interval = $scheduledExit->diff($now);
                $earlyExit = sprintf('%02dH:%02dM:%02dS', $interval->h, $interval->i, $interval->s);
            }

            $result = DB::table('attendance')
                ->where('user_id', $userId)
                ->where('date', $today)
                ->update([
                    'exit_time' => $now->toDateTimeString(),
                    'early_exit' => $earlyExit,
                    'exit_ip' => $request->ip(),
                ]);

            if ($result) {
                return redirect()->to('attendance')->with('successMessage', 'Your exit attendance submitted successfully!');
            } else {
                return back()->with('errorMessage', 'Attendance update failed. Please try again.');
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function filterAttendance(Request $request)
    {
        // Step 1: Validate Inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Step 2: Set employee based on user role
        if(Session::get('user_role') == 2) {
            $employees = DB::table('users')->where('role', 5)->get();
        } else {
            $employees = '';
            $request->employee = Session::get('user_id');
        }

        // Step 3: Get Attendance Records
        $atts = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->orderBy('date', 'desc')
            ->paginate(30)
            ->appends($request->all());

        // Step 4: Office Day Calculation (excluding Fridays)
        $range = CarbonPeriod::create($request->start_date, $request->end_date);
        $rangeOfficeDays = collect($range)->filter(function ($date) {
            return $date->format('l') !== 'Friday';
        })->count();

        // Step 5: Late Entry Count
        $lateCount = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('late')
            ->where('late', '!=', '')
            ->count();

        // Step 6: Early Exit Count
        $earlyExitCount = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('early_exit')
            ->where('early_exit', '!=', '')
            ->count();

        // Step 7: Current Month Office Days (excluding Fridays)
        $now = Carbon::now();
        $currentMonth = CarbonPeriod::create($now->startOfMonth(), $now->endOfMonth());
        $currentMonthOfficeDays = collect($currentMonth)->filter(function ($date) {
            return $date->format('l') !== 'Friday';
        })->count();
        $currentMonthDays = $now->daysInMonth;

        // ✅ Step 8: Total Present Days (Entry Taken)
        $totalPresentDays = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('entry_time') // or use 'entry_time' if that's your column
            ->count();
        $filter = 1;
        // Step 9: Return to View
        return view('hr.attendance', compact(
            'atts',
            'employees',
            'rangeOfficeDays',
            'lateCount',
            'earlyExitCount',
            'currentMonthOfficeDays',
            'currentMonthDays',
            'totalPresentDays',
            'filter',
        ));
    }

    public function downloadAttendancePdf(Request $request)
    {
        // Step 1: Validate Inputs
        $request->validate([
            'start_date' => 'required|date',
            'end_date'   => 'required|date|after_or_equal:start_date',
        ]);

        // Step 2: Get Employee Info
        if(Session::get('user_role') == 2) {
            $employees = DB::table('users')->where('role', 5)->get();
        } else {
            $employees = '';
            $request->employee = Session::get('user_id');
        }

        // Step 3: Get Attendance Data
        $atts = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->orderBy('date', 'asc')
            ->get();

        $employee = DB::table('users')->where('id', $request->employee)->first();

        // Step 4: Office Days (excluding Fridays)
        $range = CarbonPeriod::create($request->start_date, $request->end_date);
        $rangeOfficeDays = collect($range)->filter(fn($date) => $date->format('l') !== 'Friday')->count();

        // Step 5: Late Count
        $lateCount = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('late')
            ->where('late', '!=', '')
            ->count();

        // Step 6: Early Exit Count
        $earlyExitCount = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('early_exit')
            ->where('early_exit', '!=', '')
            ->count();

        // ✅ Step 7: Total Present Days (Entry Taken)
        $totalPresentDays = DB::table('attendance')
            ->whereBetween('date', [$request->start_date, $request->end_date])
            ->where('user_id', $request->employee)
            ->whereNotNull('entry_time') // Adjust this if your column is named differently
            ->count();

        // Step 8: Current Month Days
        $currentMonthDays = Carbon::now()->daysInMonth;

        // Step 9: Get Company Info
        $rows2 = DB::table('users')
            ->where('id', Session::get('agent_id'))
            ->first();

        // Step 10: Generate PDF
        $pdf = Pdf::loadView('hr.attendance_report', [
            'atts' => $atts,
            'company' => $rows2,
            'employee' => $employee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rangeOfficeDays' => $rangeOfficeDays,
            'lateCount' => $lateCount,
            'earlyExitCount' => $earlyExitCount,
            'currentMonthDays' => $currentMonthDays,
            'totalPresentDays' => $totalPresentDays
        ]);

        return $pdf->download("Attendance_Report_{$employee->company_name}.pdf");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class hrController extends Controller
{
    public function designation(Request $request){
        try{
            $rows1 = DB::table('designations')
                ->where('agent_id',Session::get('user_id'))
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
            $row = DB::table('designations')->where('agent_id', Session::get('user_id')) ->where('name', $request->name)->get();
            if($row->count()>0){
                return back()->with('errorMessage', 'Designation Already Exits!! Please try again!!');
            }
            $result = DB::table('designations')->insert([
                'agent_id' => Session::get('user_id'),
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
                ->where('agent_id',Session::get('user_id'))
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
                        ->where('agent_id',Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows2 = DB::table('designations')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            return view('hr.employeeSettings',['employees' => $rows1,'designations' => $rows2]);
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
                            'agent_id' => Session::get('user_id'),
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
            $rows1 = DB::table('employees')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            $rows2 = DB::table('designations')->where('agent_id',Session::get('user_id'))->get();
            return view('hr.employeeEditPage',['employee' => $rows1,'designations' => $rows2]);
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

}

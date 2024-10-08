<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class authController extends Controller
{
    public  function loginPage(Request $request){
        if(Session::get('user_id')){
            return redirect()->to('dashboard');
        }
        else{
            return view('frontend.userAuth.all-login-page');
        }
    }
    public  function allLogin(Request $request){
        $countries = DB::table('countries')->get();
        return view('frontend.userAuth.all-login-page',['countries'=> $countries]);
    }
    public  function customerSignup(Request $request){
        $countries = DB::table('countries')->get();
        return view('frontend.userAuth.customer-signup',['countries'=> $countries]);
    }
    public  function agentSignup(Request $request){
        $countries = DB::table('countries')->get();
        return view('frontend.userAuth.agent-signup',['countries'=> $countries]);
    }
    public  function customerLogin(Request $request){
        return view('frontend.userAuth.customer-login');
    }
    public  function dashboard(Request $request){
        if(Session::get('user_id')){
            $cus_count = DB::table('passengers')->where('upload_by',Session::get('user_id'))->distinct()->get()->count();
            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');
            $monthly_sale_air_ticket = DB::table('air_ticket_invoice')
                ->select(
                    DB::raw('SUM(c_price) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('issue_date', '>=', $first_day_this_month)
                ->where('issue_date', '<=' , $last_day_this_month)
                ->first();
            $yes_d =  date('y-m-d',strtotime("-1 days"));
            $daily_sale_air_ticket = DB::table('air_ticket_invoice')
                ->select(
                    DB::raw('SUM(c_price) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('issue_date', '=', $yes_d)
                ->first();
            $monthly_sale_visa = DB::table('visa_invoice')
                ->select(
                    DB::raw('SUM(v_c_price) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('date', '>=', $first_day_this_month)
                ->where('date', '<=' , $last_day_this_month)
                ->first();
            $daily_sale_visa = DB::table('visa_invoice')
                ->select(
                    DB::raw('SUM(v_c_price) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('date', '=', $yes_d)
                ->first();
            $monthly_sale_tour = DB::table('package_details')
                ->select(
                    DB::raw('SUM(p_c_details) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('date', '>=', $first_day_this_month)
                ->where('date', '<=' , $last_day_this_month)
                ->first();
            $daily_sale_tour = DB::table('package_details')
                ->select(
                    DB::raw('SUM(p_c_details) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('date', '=', $yes_d)
                ->first();
            //dd($daily_sale_air_ticket);
            return view('dashboard', [
                'users' => $cus_count,
                'monthly_sale_air_ticket' => $monthly_sale_air_ticket->cost ?? 0,
                'daily_sale_air_ticket' => $daily_sale_air_ticket->cost ?? 0,
                'monthly_sale_visa' => $monthly_sale_visa->cost ?? 0,
                'daily_sale_visa' => $daily_sale_visa->cost ?? 0,
                'monthly_sale_tour' => $monthly_sale_tour->cost ?? 0,
                'daily_sale_tour' => $daily_sale_tour->cost ?? 0,
                ]);
        }
        else{
            return redirect()->to('login');
        }
    }
    public function createNewCustomer(Request $request){
        try{
            if($request) {
                $rows = DB::table('users')
                    ->where('company_pnone', $request->phone)
                    ->orwhere('company_email', $request->email)
                    ->distinct()->get()->count();
                if ($rows > 0) {
                    return back()->with('errorMessage', 'User already exits!!');
                } else {
                    $username = $request->name;
                    $email = $request->email;
                    $phone = $request->phone;
                    $phoneCode = $request->phoneCode;
                    $password = Hash::make($request->password);
                    $result = DB::table('users')->insert([
                        'company_name' => $username,
                        'company_email' => $email,
                        'phone_code' => $phoneCode,
                        'company_pnone' => $phone,
                        'password' => $password,
                        'role' => 3,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    if ($result) {
                        return redirect()->to('all-login')->with('errorMessage', 'Registered successfully. Please log in.');
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
    public function createNewUser(Request $request){
        try{
            if($request) {
                $rows = DB::table('users')
                    ->where('company_pnone', $request->phone)
                    ->orwhere('company_email', $request->email)
                    ->distinct()->get()->count();
                if ($rows > 0) {
                    return back()->with('errorMessage', 'User already exits!!');
                } else {
                    $username = $request->name;
                    $email = $request->email;
                    $phoneCode = $request->phoneCode;
                    $phone = $request->phone;
                    $password = Hash::make($request->password);
                    $result = DB::table('users')->insert([
                        'company_name' => $username,
                        'company_email' => $email,
                        'phone_code' => $phoneCode,
                        'company_pnone' => $phone,
                        'password' => $password,
                        'role' => 2,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    if ($result) {
                        return redirect()->to('all-login')->with('errorMessage', 'Registered successfully. Please log in.');
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
    public function verifyUsers(Request $request){
        try{
            //$this->logout();
            if(Session::get('user_id')){
                if(Session::get('admin')){
                    return redirect()->to('dashboard');
                }
                if(Session::get('admin')){
                    return redirect()->to('dashboard');
                }
                if(Session::get('customer')){
                    return redirect()->to('/');
                }
            }
            else{
                $email = $request->email;
                $password = $request->password;
                $rows = DB::table('users')
                    ->where('company_email', $email)
                    ->get()->count();
                if ($rows > 0) {
                    $rows = DB::table('users')
                        ->where('company_email', $email)
                        ->first();
                    if (Hash::check($password, $rows->password)) {
                        $role = $rows->role;
                        if($role == $request->password)
                        Session::put('user_info', $rows);
                        Session::put('user_id', $rows->id);
                        Cookie::queue('user', $rows->id, time()+31556926 ,'/');
                        if($role == 1){
                            Session::put('superAdmin', $rows->id);
                            return redirect()->to('dashboard');
                        }
                        if($role == 2){
                            Session::put('admin', $rows->id);
                            return redirect()->to('dashboard');
                        }
                        if($role == 3){
                            Session::put('customer', $rows->id);
                            if(Session::get('reference_url')){
                                return redirect()->to(Session::get('reference_url'));
                            }
                            return redirect()->to('/');
                        }
                    }
                    else{
                        return back()->with('errorMessage', 'Password is wrong!!');
                    }
                } else {
                    return back()->with('errorMessage', 'Users not exits!!');
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public  function logout(){
        Session::flush();
        Cookie::queue(Cookie::forget('user'));
        return redirect('/');
    }
}

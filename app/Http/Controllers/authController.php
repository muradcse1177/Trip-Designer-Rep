<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Schema;

class authController extends Controller
{
    function get_client_ip() {
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
    public function domainCheck(){
        try{
            //$c_domain = $_SERVER['SERVER_NAME'];
            $c_domain = 'tripdesigner.net';
            $rows = DB::table('domain')->where('name',$c_domain)->first();
            $row['domain'] = @$rows->name;
            $row['agent_id'] = @$rows->agent_id;
            return @$row;
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
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
    public  function forgotPassword(Request $request){
        return view('frontend.userAuth.forgot-password');
    }
    public  function emailCheck(Request $request){
        $rows1 = DB::table('users')->where('company_email',$request->email)->first();
        if($rows1){
            $six_digit_random_number = random_int(100000, 999999);
            $result = DB::table('users')
                ->where('id', $rows1->id)
                ->update([
                    'otp' => $six_digit_random_number,
                ]);
            $email = [$request->email,];
            $data = [
                'name' => $rows1->company_name,
                'email' => $rows1->company_email,
                'otp' => $six_digit_random_number,
            ];
            Mail::send('email.forgot-password-email', $data, function ($message) use ($email) {
                $message->subject("Trip Designer: Forgot Password");
                $message->from('sales@tripdesigner.net', 'Trip Designer Tech');
                $message->to($email);
            });
            return view('frontend.userAuth.forgot-password-email');
        }else{
            return redirect()->to('all-login')->with('errorMessage', 'User not found!! Create your account first.');
        }
    }
    public  function otpVerification(Request $request){
        $rows1 = DB::table('users')->where('otp',$request->code)->first();
        if($rows1){
            return view('frontend.userAuth.password-recover',['id'=> $rows1->id]);
        }else{
            return back()->with('errorMessage', 'OTP not matched!! Please try again.');
        }
    }
    public  function passwordRecover(Request $request){
        $password = Hash::make($request->password);
        $result = DB::table('users')
            ->where('id', $request->id)
            ->update([
                'password' => $password,
                'otp' => null,
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if($result){
            return redirect()->to('all-login')->with('successMessage', 'Password changed successfully. Please log in with new password.');
        }else{
            return back()->with('errorMessage', 'Please try again!!');
        }
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
    public  function mainDashboard(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->orderBy('p_p_adult','asc')->inRandomOrder()->get()->take(6);

        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->orderBy('a_price','asc')->inRandomOrder()->get()->take(6);
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();

        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(6);

        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->orderBy('p_p_adult','asc')->inRandomOrder()->get()->take(6);

        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(6);
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,'type' => 'main'

            ]);
    }
    public function dashboard(Request $request)
    {
        if (!Session::get('user_id')) {
            return redirect()->to('all-login');
        }

        $agentId = Session::get('agent_id');
        $today = date('Y-m-d');

        // Filter dates
        $startDate = $request->input('start_date') ?? date('Y-m-01');
        $endDate = $request->input('end_date') ?? date('Y-m-t');

        // Count unique passengers
        $customerCount = DB::table('passengers')
            ->where('upload_by', $agentId)
            ->distinct()
            ->count();

        // Config for each service type
        $invoices = [
            'air_ticket' => [
                'table' => 'air_ticket_invoice',
                'date_field' => 'issue_date',
                'cost_field' => 'c_price',
                'agent_field' => 'a_price',
                'due_field' => 'due_amount'
            ],
            'visa' => [
                'table' => 'visa_invoice',
                'date_field' => 'date',
                'cost_field' => 'v_c_price',
                'agent_field' => 'v_a_price',
                'due_field' => 'v_due'
            ],
            'tour' => [
                'table' => 'package_details',
                'date_field' => 'date',
                'cost_field' => 'p_c_details',
                'agent_field' => 'p_a_price',
                'due_field' => 'due'
            ],
            'hotel' => [
                'table' => 'hotel_invoice',
                'date_field' => 'b_date',
                'cost_field' => 'c_price',
                'agent_field' => 'a_price',
                'due_field' => 'due_amount'
            ],
            'hajj' => [
                'table' => 'umrah_invoice',
                'date_field' => 'date',
                'cost_field' => 'p_c_details',
                'agent_field' => 'p_a_price',
                'due_field' => 'due'
            ],
        ];

        $data = [
            'users' => $customerCount,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_due' => 0
        ];

        foreach ($invoices as $key => $config) {
            // Monthly sale and cost
            $data["monthly_sale_{$key}"] = $this->getInvoiceSum(
                $config['table'], $config['cost_field'], $config['date_field'], $startDate, $endDate, $agentId
            );
            $data["monthly_a_sale_{$key}"] = $this->getInvoiceSum(
                $config['table'], $config['agent_field'], $config['date_field'], $startDate, $endDate, $agentId
            );

            // Daily sale and cost
            $data["daily_sale_{$key}"] = $this->getInvoiceSum(
                $config['table'], $config['cost_field'], $config['date_field'], $today, $today, $agentId
            );
            $data["daily_a_sale_{$key}"] = $this->getInvoiceSum(
                $config['table'], $config['agent_field'], $config['date_field'], $today, $today, $agentId
            );

            // Due amount
            $data["due_{$key}"] = $this->getInvoiceSum(
                $config['table'], $config['due_field'], $config['date_field'], $startDate, $endDate, $agentId
            );
            $data['total_due'] += $data["due_{$key}"];
        }

        return view('dashboard', $data);
    }

    /**
     * Fetches the sum of a specific column from a given table for a date range and agent.
     */
    private function getInvoiceSum($table, $field, $dateField, $startDate, $endDate, $agentId)
    {
        $query = DB::table($table)
            ->where('agent_id', $agentId)
            ->whereBetween($dateField, [$startDate, $endDate]);

        if (Schema::hasColumn($table, 'deleted')) {
            $query->where('deleted', 0);
        }

        $result = $query->select(DB::raw("SUM($field) as total"))->first();

        return $result->total ?? 0;
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
                        'status' => 'Active',
                        'role' => 3,
                        'updated_at' => date('Y-m-d H:i:s'),
                    ]);
                    if ($result) {
                        return redirect()->to('all-login')->with('successMessage', 'Registered successfully. Please log in.');
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
                        return redirect()->to('all-login')->with('successMessage', 'Registered successfully. Please log in.');
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
                $rows = DB::table('users')->where('id',Session::get('user_id'))->first();
                if($rows->address == null){
                    return redirect()->to('companyInfo');
                }
                if(Session::get('superAdmin')){
                    return redirect()->to('main-dashboard');
                }
                if(Session::get('admin')){
                    return redirect()->to('main-dashboard');
                }
                if(Session::get('customer')){
                    return redirect()->to('/');
                }
                if(Session::get('employee')){
                    return redirect()->to('attendance');
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
                    if($rows->status == 'In Active'){
                        return back()->with('errorMessage', 'Your Id is Inactive!! Please contact to admin.');
                    }
                    if (Hash::check($password, $rows->password)) {
                        $role = $rows->role;
                        Session::put('user_info', $rows);
                        Session::put('user_id', $rows->id);
                        Session::put('user_role', $role);
                        Cookie::queue('user', $rows->id, time()+31556926 ,'/');
                        if($role == 1){
                            Session::put('superAdmin', $rows->id);
                            return redirect()->to('main-dashboard');
                        }
                        if($role == 2){
                            Session::put('admin', $rows->id);
                            Session::put('agent_id', $rows->id);
                            $rows = DB::table('users')->where('id',$rows->id)->first();
                            if($rows->address == null){
                                return redirect()->to('companyInfo');
                            }
                            return redirect()->to('main-dashboard');
                        }
                        if($role == 3){
                            Session::put('customer', $rows->id);
                            if(Session::get('reference_url')){
                                return redirect()->to(Session::get('reference_url'));
                            }
                            return redirect()->to('/');
                        }
                        if($role == 5){
                            $emp = DB::table('employees')->where('email', $email)->first();
                            Session::put('agent_id', $emp->agent_id);
                            Session::put('employee', $rows->id);
                            return redirect()->to('attendance');
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

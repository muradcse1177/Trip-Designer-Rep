<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class usersController extends Controller
{
    public function importCsv(){
        $file = public_path('AAA.csv');
        $csvData = file_get_contents($file);
        $rows = array_map('str_getcsv', explode("\n", $csvData));
        array_shift($rows);
        //dd($rows[0][1]);
        $data = [];
        foreach ($rows as $row) {
            $int= mt_rand(1262055681,1262055681);
            $a = date("Y-m-d",$int);
            $data[] = [
                'title' => 'Mr',
                'f_name' => @$row[1] ? $row[1] :'Example',
                'l_name' => @$row[2]  ? $row[2] :'Example',
                'gender' => 'Male',
                'phone' => @$row[3],
                'email' => @$row[4],
                //'dob' => $a,
                'nationality' => 'Bangladesh',
                'p_number' => "",
                't_type' => 'Adult',
                //'p_exp_date' => '',
                'upload_by' => 4,
            ];
        }
        //dd($data);
        DB::table('passengers')->insert($data);
        return 'Jobi done or what ever';
    }
    public function customerProfile (Request $request){
        try{
            $user_id = Session::get('user_id');
            $row = DB::table('users')->where('id',$user_id)->first();
            $countries = DB::table('countries')->get();
            return view('frontend.customer.customer-profile',['user' => $row,'countries' => $countries,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateCustomerProfile (Request $request){
        try{
            if($request) {
                $username = $request->name;
                $email = $request->email;
                $phoneCode = $request->phoneCode;
                $phone = $request->phone;
                if($request->address)
                    $address = $request->address;
                else
                    $address="";
                $rows = DB::table('users')->where('id',Session::get('user_id'))->first();
                if($request->photo){
                    $fileName = time() . '.' . $request->photo->extension();
                    $request->photo->move(public_path('images/upload/company/'), $fileName);
                    $photo = 'public/images/upload/company/'.$fileName;
                }
                else{
                    $photo = $rows->logo;
                }
//                dd(Session::get('user_id'));
                $result = DB::table('users')
                    ->where('id',Session::get('user_id'))
                    ->update([
                        'company_name' => $username,
                        'company_email' => $email,
                        'phone_code' => $phoneCode,
                        'company_pnone' => $phone,
                        'address' => $address,
                        'logo' => $photo,
                    ]);
                if ($result) {
                    return back()->with('successMessage', 'Profile Updated Successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
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
    public function updatePassword (Request $request){
        try{
            if($request) {
                $o_pass = $request->o_pass;
                $n_pass = $request->n_pass;
                $rows = DB::table('users')->where('id',Session::get('user_id'))->first();
                if (Hash::check($o_pass, $rows->password)) {
                    $result = DB::table('users')
                        ->where('id', Session::get('user_id'))
                        ->update([
                            'password' => Hash::make($n_pass),
                        ]);
                    if ($result) {
                        Session::flush();
                        Cookie::queue(Cookie::forget('user'));
                        return redirect('all-login')->with('successMessage', 'Password Updated Successfully. Login in with New Password!!');
                    } else {
                        return back()->with('errorMessage1', 'Please try again!!');
                    }
                }
                else{
                    return back()->with('errorMessage1', 'Your Old Password Wrong. Please Contact with Admin !!');
                }
            }
            else{
                return back()->with('errorMessage1', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function users(Request $request){
        try{
            $rows = DB::table('country')->get();
            $rows1 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
                ->orderBy('id','desc')
                ->paginate(20);
            return view('users.users',['countries' => $rows,'passengers' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function agency(Request $request){
        try{
            $rows1 = DB::table('users')
                ->orderBy('id','desc')
                ->paginate(20);
            return view('agency.agency',['users' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function contacts(Request $request){
        try{
            $rows1 = DB::table('contacts')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            return view('contacts.contacts',['passengers' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewContacts(Request $request){
        try{
            if($request) {
                $row = DB::table('contacts')
                    ->where('agent_id',Session::get('user_id'))
                    ->where('phone',$request->phone)
                    ->get();
                if($row->count()>= 1){
                    return back()->with('errorMessage', 'Contacts already exits!!');
                }
                else{
                    $result = DB::table('contacts')->insert([
                        'agent_id' => Session::get('user_id'),
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'dob' => $request->dob,
                    ]);
                    if ($result) {
                        return redirect()->to('contacts')->with('successMessage', 'New contacts added successfully!!');
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
    public function updateContacts (Request $request){
        try{
            if($request) {
                $result = DB::table('contacts')
                    ->where('id', $request->id)
                    ->where('agent_id',Session::get('user_id'))
                    ->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'email' => $request->email,
                        'dob' => $request->dob,
                    ]);
                if ($result) {
                    return redirect()->to('contacts')->with('successMessage', 'Contacts Updated Successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
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
    public function editContactsPage(Request $request){
        try{
            $rows = DB::table('contacts')->where('id',$request->id)->first();
            return view('contacts.editContactsPage',['contact' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPDetails(Request $request){
        try{
            $rows = DB::table('country')->get();
            $rows1 = DB::table('passengers')
                ->orwhere('f_name',$request->s)
                ->orWhere('l_name',$request->s)
                ->orWhere('phone',$request->s)
                ->orWhere('email',$request->s)
                ->orWhere('p_number',$request->s)
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
                ->orderBy('id','desc')
                ->paginate(20);
            return view('users.users',['countries' => $rows,'passengers' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchUsersDetails(Request $request){
        try{
            //dd($request);
            $rows1 = DB::table('users')
                ->orWhere('company_name', 'like', '%' . $request->s . '%')
                ->orWhere('company_pnone', 'like', '%' . $request->s . '%')
                ->orWhere('company_email', 'like', '%' . $request->s . '%')
                ->orWhere('address', 'like', '%' . $request->s . '%')
                ->orWhere('contact_person', 'like', '%' . $request->s . '%')
                ->orWhere('con_phone', 'like', '%' . $request->s . '%')
                ->orderBy('id','desc')
                ->paginate(20);
            return view('agency.agency',['users' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewPassenger(Request $request){
        try{
            if($request) {
                $title = $request->title;
                $f_name = $request->f_name;
                $l_name = $request->l_name;
                $phone = $request->phone;
                $email = $request->email;
                $gender = $request->gender;
                $nationality = $request->nationality;
                $dob = $request->dob;
                $ffn = $request->ffn;
                $p_number = $request->p_number;
                $p_exp_date = $request->p_exp_date;
                $t_type = $request->t_type;
                $result = DB::table('passengers')->insert([
                    'title' => $title,
                    'f_name' => $f_name,
                    'l_name' => $l_name,
                    'phone' => $phone,
                    'email' => $email,
                    'gender' => $gender,
                    'nationality' => $nationality,
                    'dob' => $dob,
                    'ffn' => $ffn,
                    'p_number' => $p_number,
                    'p_exp_date' => $p_exp_date,
                    't_type' => $t_type,
                    'upload_by' => Session::get('user_id'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                if ($result) {
                    return redirect()->to('users')->with('successMessage', 'Registered done successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
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
    public function isPassengerInActive(Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->status== 'Active')
                    $result =DB::table('passengers')
                        ->where('id', $request->id)
                        ->update([
                            'status' => 'In Active',
                        ]);
                    if ($result) {
                        return redirect()->to('passengers')->with('successMessage', 'Data update successfully!!');
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
    public function isAgencyInActive(Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->status== 'Active')
                    $result =DB::table('users')
                        ->where('id', $request->id)
                        ->update([
                            'status' => 'In Active',
                        ]);
                    if ($result) {
                        return redirect()->to('agency')->with('successMessage', 'Agency update successfully!!');
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
    public function isPassengerActive(Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->status== 'In Active')
                    $result =DB::table('passengers')
                        ->where('id', $request->id)
                        ->update([
                            'status' => 'Active',
                        ]);
                    if ($result) {
                        return redirect()->to('passengers')->with('successMessage', 'Data update successfully!!');
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
    public function isAgencyActive (Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->status== 'In Active')
                    $result =DB::table('users')
                        ->where('id', $request->id)
                        ->update([
                            'status' => 'Active',
                        ]);
                    if ($result) {
                        return redirect()->to('agency')->with('successMessage', 'Agency update successfully!!');
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
    public function editCompanyInfo(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',$request->id)
                ->first();
            return view('agency.editAgencyInfo',['company' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateCompanyInfo(Request $request){
        try{
            if($request) {
                $rows = DB::table('users')
                    ->where('company_pnone', $request->phone)
                    ->orwhere('company_email', $request->email)
                    ->distinct()->get()->count();
                if ($rows > 0) {
                    $rows = DB::table('users')
                        ->where('company_pnone', $request->phone)
                        ->orwhere('company_email', $request->email)
                        ->first();
                    if($request->password == ''){
                        $password = $rows->password;
                    }
                    else{
                        $password = Hash::make($request->password);
                    }
                    if($request->hasFile('logo')){
                        $targetFolder = 'public/images/upload/company/';
                        $file = $request->file('logo');
                        $pname = time() . '.' . $file->getClientOriginalName();
                        $image['filePath'] = $pname;
                        $file->move($targetFolder, $pname);
                        $c_logo = $targetFolder . $pname;
                    }
                    else{
                        $c_logo = $rows->logo;
                    }
                    $result =DB::table('users')
                        ->where('id', $request->id)
                        ->update([
                            'company_email' => $request->email,
                            'company_pnone' => $request->phone,
                            'address' => $request->address,
                            'contact_person' => $request->contact_person,
                            'con_phone' => $request->con_phone,
                            'password' => $password,
                            'logo' => $c_logo,
                            'updated_at' => date('Y-m-d H:i:s'),
                        ]);
                    if ($result) {
                        return redirect()->to('agency')->with('successMessage', 'Data updated successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Company not exits.Please try again!!');
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
    public function editPassengerInfo(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $title = $request->title;
                    $f_name = $request->f_name;
                    $l_name = $request->l_name;
                    $phone = $request->phone;
                    $email = $request->email;
                    $gender = $request->gender;
                    $nationality = $request->nationality;
                    $dob = $request->dob;
                    $ffn = $request->ffn;
                    $p_number = $request->p_number;
                    $p_exp_date = $request->p_exp_date;
                    $t_type = $request->t_type;
                    $result =DB::table('passengers')
                        ->where('id', $request->id)
                        ->update([
                            'title' => $title,
                            'f_name' => $f_name,
                            'l_name' => $l_name,
                            'phone' => $phone,
                            'email' => $email,
                            'gender' => $gender,
                            'nationality' => $nationality,
                            'dob' => $dob,
                            'ffn' => $ffn,
                            'p_number' => $p_number,
                            'p_exp_date' => $p_exp_date,
                            't_type' => $t_type,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    if ($result) {
                        return redirect()->to('users')->with('successMessage', 'Data update successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
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
    public function editPassengerPage(Request $request){
        try{
            $rows = DB::table('country')->get();
            $rows1 = DB::table('passengers')->where('upload_by',Session::get('user_id'))->where('id',$request->id)->orderBy('id','desc')->first();
            //dd($rows1);
            return view('users.editPassengerPage',['countries' => $rows,'passengers' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deletePassenger(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('passengers')
                        ->where('id', $request->id)
                        ->update([
                            'deleted' => 1,
                        ]);
                    if ($result) {
                        return redirect()->to('users')->with('successMessage', 'Data deleted successfully!!');
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
    public function orderReceiver(Request $request){
        try{
            $rows1 = DB::table('order_request')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            return view('orderReceiver.orderReceiver',['orders' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function changeB2COrderStatus(Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->status)
                        $result =DB::table('order_request')
                            ->where('id', $request->id)
                            ->update([
                                'status' => $request->status,
                            ]);
                    if ($result) {
                        return redirect()->to('orderReceiver')->with('successMessage', 'Order status updated successfully!!');
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

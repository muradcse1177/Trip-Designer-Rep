<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class manpowerController extends Controller
{
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
    public function newManPowerPackage(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('work_permit_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('updated_at','desc')
                ->get();
            return view('manpower.newManPowerPackage',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visas' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addNewWorkPermit(Request $request){
        try{
            $result = DB::table('work_permit_invoice')->insert([
                'agent_id' => Session::get('agent_id'),
                'visa_country' => $request->c_name,
                'date' => $request->date,
                'vendor' => $request->vendor,
                'issued_by' => $request->issued_by,
                'v_details' => $request->s_details,
                'pax_number' => $request->pax_number,
                'p_details' => json_encode($request->pax_name),
                'pass_number' => json_encode($request->pass_number),
                'w_details' => json_encode($request->w_details),
                'v_a_price' => $request->a_price,
                'v_c_price' => $request->c_price,
                'v_vat' => $request->vat,
                'v_ait' => $request->ait,
                'v_p_type' => $request->payment_type,
                'v_due' => $request->due,
                'v_p_details' => $request->p_details,
                'status' => $request->status,
            ]);
            if ($result) {
                $id = DB::getPdo()->lastInsertId();
                $result1 = DB::table('accounts')->insert([
                    'agent_id' => Session::get('agent_id'),
                    'invoice_id' =>$id,
                    'date' => $request->date,
                    'transaction_type' => 'Debit',
                    'source' => 'Work Permit',
                    'purpose' => 'Work Permit'.'---'.$request->c_name,
                    'buying_price' => $request->a_price,
                    'selling_price' =>$request->c_price + $request->vat + $request->ait,
                ]);
                return redirect()->to('newManPowerPackage')->with('successMessage', 'New work permit added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function viewManPowerVisa(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('work_permit_invoice')
                ->where('id',$request->id)
                ->first();
            return view('manpower.viewManPowerVisa',['company' => $rows1,'visa' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editManPowerVisaPage(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('work_permit_invoice')->where('id',$request->id)->first();
            return view('manpower.editManPowerVisaPage',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visa' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editManPowerVisa (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('work_permit_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'visa_country' => $request->c_name,
                            'date' => $request->date,
                            'vendor' => $request->vendor,
                            'issued_by' => $request->issued_by,
                            'v_details' => $request->s_details,
                            'pax_number' => $request->pax_number,
                            'p_details' => json_encode($request->pax_name),
                            'pass_number' => json_encode($request->pass_number),
                            'w_details' => json_encode($request->w_details),
                            'v_a_price' => $request->a_price,
                            'v_c_price' => $request->c_price,
                            'v_vat' => $request->vat,
                            'v_ait' => $request->ait,
                            'v_p_type' => $request->payment_type,
                            'v_due' => $request->due,
                            'v_p_details' => $request->p_details,
                            'status' => $request->status,
                        ]);
                    if ($result) {
                        return redirect()->to('newManPowerPackage')->with('successMessage', 'Work Permit Visa Update successfully!!');
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

    public function deleteManPowerVisa(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('work_permit_invoice')
                        ->where('id', $request->id)
                        ->delete();
                    if ($result) {
                        return redirect()->to('newManPowerPackage')->with('successMessage', 'Data deleted successfully!!');
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
    public function editManPowerVisaPaymentStatus (Request $request){
        try{
            $rows1 = DB::table('work_permit_invoice')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('manpower.editManPowerVisaPaymentStatus',['visa' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function updateManpowerVisaPaymentStatus  (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('work_permit_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'v_p_type' => $request->payment_type,
                            'v_due' => $request->due,
                            'v_p_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newManPowerPackage')->with('successMessage', 'Payment Updated successfully!!');
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
    public function downloadWorkPermit (Request $request){
        try{
            $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
            $package = DB::table('b2c_manpower')->where('agent_id',Session::get('agent_id'))->where('slug',$request->slug)->first();
            $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
            $result = DB::table('order_request')->insert([
                'agent_id' => Session::get('agent_id'),
                'r_ref' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' => '1 Person',
                'view' => 'https://tripdesigner.net/manpower-b2b/'.$package->slug,
                'date' => date('Y-m-d'),
                'r_type' => 'Work Permit',
                'status' => 'Requested',
                'order_type' => 'B2B',
                'adult' => 1,
                'child' => 0,
                'remarks' => json_encode('Need Work Permit for ' .$package->country),
            ]);
            $to = 'tripdesigner.xyz@gmail.com';
            $email_cus = [$agent->company_email];
            $email_admin = [$to];
            $data = [
                'tracking' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' => '1 Person',
                'r_type' => 'Work Permit',
                'status' => 'Requested',
                'remarks' => json_encode('Need Work Permit for ' .$package->country),
            ];
            if ($result) {
                Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                    $message->subject("Trip Designer: Work Permit Order Request");
                    $message->from('sales@tripdesigner.net', 'Work Permit Order');
                    $message->to($email_cus);
                });
                Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                    $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                    $message->from('sales@tripdesigner.net', 'Work Permit Order');
                    $message->to($email_admin);
                });
                return redirect()->to('orderReceiver')->with('successMessage', 'Work Permit ordered request sent successfully!!');

            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
            //return view('manpower.printB2bWorkPermit',['company' => $rows1,'package' => $rows2,'adult' => $request->adult,'child' => $request->child,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printWorkPermit (Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('b2c_manpower')
                ->where('slug',$request->slug)
                ->first();
            return view('manpower.printB2bWorkPermit',['company' => $rows1,'package' => $rows2,'adult' => $request->adult,'child' => $request->child,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

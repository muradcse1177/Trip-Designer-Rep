<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class umrahController extends Controller
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
    public function newUmrahPackage(Request $request){
        try{
            $rows1 = DB::table('country')->get();
            $rows2 = DB::table('umrah_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('updated_at','desc')
                ->get();
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows5 = DB::table('vendors') ->where('agent_id',Session::get('agent_id'))->get();
            return view('hajj-umrah.newUmrahPackage',['countries' => $rows1,'packages' => $rows2,'payment_types' => $rows3,'passengers' => $rows4,'vendors' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewUmrahPackage(Request $request){
        try{
            if($request) {
                //dd($request);
                $result = DB::table('umrah_invoice')->insert([
                    'agent_id' => Session::get('agent_id'),
                    'p_countries' => $request->country,
                    'title' => $request->title,
                    'p_code' => $request->p_code,
                    'night' => $request->night,
                    'vendor' => $request->vendor,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'highlights' => json_encode($request->highlights),
                    'traveler' => json_encode($request->pax_name),
                    'day_title' => json_encode($request->d_title),
                    'dat_itinary' => json_encode($request->description),
                    'g_details' => $request->pax_number,
                    'p_a_price' => $request->a_price,
                    'p_c_details' => $request->c_price,
                    'p_vat' => $request->vat,
                    'p_ait' => $request->ait,
                    'p_inclusions' => json_encode($request->p_inclusions),
                    'p_exclusions' => json_encode($request->p_exclusions),
                    'p_tnt' => json_encode($request->p_tnt),
                    'payment_type' => $request->payment_type,
                    'due' => $request->due,
                    'pay_details' => $request->pay_details,
                ]);
                if ($result) {
                    $id = DB::getPdo()->lastInsertId();
                    $result1 = DB::table('accounts')->insert([
                        'agent_id' => Session::get('agent_id'),
                        'invoice_id' =>$id,
                        'date' => date('Y-m-d'),
                        'transaction_type' => 'Debit',
                        'source' => $request->country.' Package',
                        'purpose' => $request->country.' Package'.'---'.$request->title,
                        'buying_price' => $request->a_price,
                        'selling_price' =>$request->c_price + $request->vat + $request->ait,
                    ]);
                    if($result1){
                        return redirect()->to('newUmrahPackage')->with('successMessage', 'New invoice created successfully!!');
                    }
                    else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
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

    public function editUmrahPackagePage(Request $request){
        try{
            $rows1 = DB::table('country')->get();
            $rows7 = DB::table('vendors') ->where('agent_id',Session::get('agent_id'))->get();
            $rows5 = DB::table('umrah_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows6 = DB::table('payment_type')
                ->get();
            return view('hajj-umrah.editUmrahPackagePage',['countries' => $rows1,'package' => $rows5,'passengers' => $rows4,'payment_types' => $rows6,'vendors' => $rows7]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateUmrahPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('umrah_invoice')
                        ->where('id', $request->id)
                        ->where('agent_id', Session::get('agent_id'))
                        ->update([
                            'p_countries' => $request->country,
                            'title' => $request->title,
                            'p_code' => $request->p_code,
                            'night' => $request->night,
                            'vendor' => $request->vendor,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'highlights' => json_encode($request->highlights),
                            'traveler' => json_encode($request->pax_name),
                            'day_title' => json_encode($request->d_title),
                            'dat_itinary' => json_encode($request->description),
                            'g_details' => $request->pax_number,
                            'p_a_price' => $request->a_price,
                            'p_c_details' => $request->c_price,
                            'p_vat' => $request->vat,
                            'p_ait' => $request->ait,
                            'p_inclusions' => json_encode($request->p_inclusions),
                            'p_exclusions' => json_encode($request->p_exclusions),
                            'p_tnt' => json_encode($request->p_tnt),
                            'payment_type' => $request->payment_type,
                            'due' => $request->due,
                            'pay_details' => $request->pay_details,
                            'updated_at' => date('Y-m-d H:i:s')

                        ]);
                    if ($result) {
                        $result =DB::table('accounts')
                            ->where('invoice_id', $request->id)
                            ->where('agent_id', Session::get('agent_id'))
                            ->update([
                                'buying_price' =>$request->a_price,
                                'selling_price' =>$request->c_price + $request->vat + $request->ait,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                        if($result){
                            return redirect()->to('newUmrahPackage')->with('successMessage', 'Data Updated successfully!!');
                        }
                        else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }

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
    public function deleteUmrahPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('umrah_invoice')
                        ->where('id', $request->id)
                        ->delete();
                    if ($result) {
                        return redirect()->to('newUmrahPackage')->with('successMessage', 'Data deleted successfully!!');
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
    public function viewUmrahPackage(Request $request){
        try{
            $rows1 = DB::table('umrah_invoice')
                ->where('deleted',0)
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            return view('hajj-umrah.viewUmrahPackage',['package' => $rows1,'company' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editUmrahPackagePayment (Request $request){
        try{
            $rows1 = DB::table('umrah_invoice')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('hajj-umrah.editUmrahPackagePayment',['visa' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function updateUmrahPackagePaymentStatus (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('umrah_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'payment_type' => $request->payment_type,
                            'due' => $request->due,
                            'pay_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newUmrahPackage')->with('successMessage', 'Payment Updated successfully!!');
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

    public  function bookUmrahPackagePageB2b(Request $request){
        if($request->adult >= 2 && $request->child >= 0 && $request->infant >= 0){
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows1 = DB::table('b2c_hajj_umrah')
                ->where('agent_id',Session::get('agent_id'))
                ->where('slug',$request->slug)
                ->first();
            if($rows1)
                return view('hajj-umrah.bookUmrahPackagePageB2b',['package' => $rows1,'passengers' => $rows4,'adult' => $request->adult,'child' =>  $request->child,'infant' =>  $request->infant]);
            else
                return back()->with('errorMessage', 'Bad Request!!');
        }
        else{
            return back()->with('errorMessage', 'Adult must greater than 2 PAX!!');
        }
    }


    public  function bookUmrahPackageB2b(Request $request){
        try {
            if ($request) {
                $package = DB::table('b2c_hajj_umrah')->where('agent_id',Session::get('agent_id'))->where('id',$request->id)->first();
                $total = $package->p_p_adult * $request->adult + $package->p_p_child * $request->child + $package->p_p_infant * $request->infant;
                $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
                $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
                if($total > $agent->agency_amount){
                    return back()->with('errorMessage', 'Please recharge your account to book this package!!');
                }
                if($agent->agency_amount > $total){
                    $result = DB::table('users')
                        ->where('id', Session::get('agent_id'))
                        ->update([
                            'agency_amount' => $agent->agency_amount - $total,
                        ]);
                    if($result){
                        $invoice = DB::table('umrah_invoice')->insert([
                            'agent_id' => Session::get('agent_id'),
                            'p_countries' => $package->type,
                            'title' => $package->p_name,
                            'p_code' => $package->p_code,
                            'night' => $package->night,
                            'vendor' => 'Trip Designer',
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'highlights' => $package->highlights,
                            'traveler' => json_encode($request->name),
                            'day_title' => $package->title,
                            'dat_itinary' => $package->itinary,
                            'g_details' => $request->adult + $request->child + $request->infant,
                            'p_a_price' => $total,
                            'p_c_details' => $total,
                            'p_vat' => 0,
                            'p_ait' => 0,
                            'p_inclusions' => $package->inclusion,
                            'p_exclusions' => $package->exclusion,
                            'p_tnt' => $package->tnt,
                            'payment_type' => 'Bank Transfer',
                            'due' => 0,
                            'pay_details' => 'Balanced from wallet - '.$total .'BDT',
                        ]);
                        if ($invoice) {
                            $result1 = DB::table('accounts')->insert([
                                'agent_id' => Session::get('agent_id'),
                                'invoice_id' => $num,
                                'date' => date('Y-m-d'),
                                'transaction_type' => 'Debit',
                                'head' => 'Umrah Package',
                                'source' => 'Umrah Package',
                                'purpose' => 'Umrah Package' . '---' . $package->p_name,
                                'buying_price' => $total,
                                'selling_price' => $total,
                            ]);
                            if ($result1) {
                                $domain =$this->domainCheck();
                                if($domain['agent_id']) {
                                    //dd($request);
                                    $result = DB::table('order_request')->insert([
                                        'agent_id' => $domain['agent_id'],
                                        'r_ref' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant,
                                        'view' => 'https://tripdesigner.net/hajj-umrah-b2b/'.$package->slug,
                                        'date' => date('Y-m-d'),
                                        'r_type' => "Umrah Package",
                                        'status' => 'Ordered',
                                        'order_type' => 'B2B',
                                        'adult' => $request->adult,
                                        'child' => $request->child,
                                        'infant' => $request->infant,
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant),
                                    ]);
                                    $to = 'tripdesigner.xyz@gmail.com';
                                    $email_cus = [$agent->company_email];
                                    $email_admin = [$to];
                                    $data = [
                                        'tracking' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant,
                                        'r_type' => "Umrah Package",
                                        'status' => 'Ordered',
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant),
                                    ];
                                    if ($result) {
                                        Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                                            $message->subject("Trip Designer: Order Request Confirmation");
                                            $message->from('sales@tripdesigner.net', 'Umrah Package Order');
                                            $message->to($email_cus);
                                        });
                                        Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                                            $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                                            $message->from('sales@tripdesigner.net', 'Umrah Package Order');
                                            $message->to($email_admin);
                                        });
                                        return redirect()->to('newUmrahPackage')->with('successMessage', 'Umrah Package Ordered successfully!!');

                                    } else {
                                        return back()->with('errorMessage', 'Please try again!!');
                                    }
                                }
                                else{
                                    return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
                                }

                            } else {
                                return back()->with('errorMessage', 'Please try again!!');
                            }
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                }else{
                    return back()->with('errorMessage', 'Please recharge your account to book this tour package!!');
                }

            } else {
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function printUmrahPackageInvoice(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('umrah_invoice')
                ->where('id',$request->id)
                ->first();
            return view('hajj-umrah.printUmrahPackageInvoice',['company' => $rows1,'package' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function printB2bUmrahPackage (Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('b2c_hajj_umrah')
                ->where('slug',$request->slug)
                ->first();
            return view('hajj-umrah.printB2bUmrahPackage',['company' => $rows1,'package' => $rows2,'adult' => $request->adult,'child' => $request->child,'infant' => $request->infant,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());  
        }
    }
    public function downloadB2bUmrahPackage(Request $request){
        try{
            $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
            $package = DB::table('b2c_hajj_umrah')->where('agent_id',Session::get('agent_id'))->where('slug',$request->slug)->first();
            $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
            $result = DB::table('order_request')->insert([
                'agent_id' => Session::get('agent_id'),
                'r_ref' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' => 'Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant,
                'view' => 'https://tripdesigner.net/hajj-umrah-b2b/'.$package->slug,
                'date' => date('Y-m-d'),
                'r_type' => 'Umrah Package',
                'status' => 'Requested',
                'order_type' => 'B2B',
                'adult' => $request->adult,
                'child' => $request->child,
                'infant' => $request->infant,
                'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant),
            ]);
            $to = 'tripdesigner.xyz@gmail.com';
            $email_cus = [$agent->company_email];
            $email_admin = [$to];
            $data = [
                'tracking' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' => 'Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant,
                'r_type' => 'Umrah Package',
                'status' => 'Requested',
                'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child.'Infant:'. $request->infant),
            ];
            if ($result) {
                Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                    $message->subject("Trip Designer: Umrah Package Order Request");
                    $message->from('sales@tripdesigner.net', 'Umrah Package Order');
                    $message->to($email_cus);
                });
                Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                    $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                    $message->from('sales@tripdesigner.net', 'Umrah Package Order');
                    $message->to($email_admin);
                });
                return redirect()->to('orderReceiver')->with('successMessage', 'Umrah Package ordered request sent successfully!!');

            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

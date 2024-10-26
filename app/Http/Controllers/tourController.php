<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class tourController extends Controller
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
    public function newTourPackage(Request $request){
        try{
            $rows1 = DB::table('country')->get();
            $rows2 = DB::table('package_details')
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
            return view('tourPackage.newTourPackage',['countries' => $rows1,'packages' => $rows2,'payment_types' => $rows3,'passengers' => $rows4,'vendors' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewTourPackage(Request $request){
        try{
            if($request) {
                //dd($request);
                $result = DB::table('package_details')->insert([
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
                        'source' => 'Tour Package',
                        'purpose' => 'Tour Package'.'---'.$request->title,
                        'buying_price' => $request->a_price,
                        'selling_price' =>$request->c_price + $request->vat + $request->ait,
                    ]);
                    if($result1){
                        return redirect()->to('newTourPackage')->with('successMessage', 'New invoice created successfully!!');
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
    public function editPackagePage(Request $request){
        try{
            $rows1 = DB::table('country')->get();
            $rows7 = DB::table('vendors') ->where('agent_id',Session::get('agent_id'))->get();
            $rows5 = DB::table('package_details')
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
            return view('tourPackage.editTourPackage',['countries' => $rows1,'package' => $rows5,'passengers' => $rows4,'payment_types' => $rows6,'vendors' => $rows7]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateTourPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('package_details')
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
                            return redirect()->to('newTourPackage')->with('successMessage', 'Data Updated successfully!!');
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
    public function deleteTourPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('package_details')
                        ->where('id', $request->id)
                        ->update([
                            'deleted' => 1,
                        ]);
                    if ($result) {
                        return redirect()->to('newTourPackage')->with('successMessage', 'Data deleted successfully!!');
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
    public function viewTourPackage(Request $request){
        try{
            $rows1 = DB::table('package_details')
                ->where('deleted',0)
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            return view('tourPackage.viewTourPackage',['package' => $rows1,'company' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editTourPackagePayment (Request $request){
        try{
            $rows1 = DB::table('package_details')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('tourPackage.editTourPackagePayment',['visa' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateTourPackagePaymentStatus (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('package_details')
                        ->where('id', $request->id)
                        ->update([
                            'payment_type' => $request->payment_type,
                            'due' => $request->due,
                            'pay_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newTourPackage')->with('successMessage', 'Payment Updated successfully!!');
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
    public  function searchTourPackageB2b(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')
            ->where('agent_id',$domain['agent_id'])
            ->where('c_name',$request->country)
            ->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->get();
        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,
                'type' => $request->type,
            ]);
    }
    public  function bookTourPackagePageB2b(Request $request){
        if($request->adult >= 2 && $request->child >= 0){
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows1 = DB::table('b2c_tour_package')
                ->where('agent_id',Session::get('agent_id'))
                ->where('slug',$request->slug)
                ->first();
            if($rows1)
                return view('tourPackage.bookTourPackagePageB2b',['package' => $rows1,'passengers' => $rows4,'adult' => $request->adult,'child' =>  $request->child]);
            else
                return back()->with('errorMessage', 'Bad Request!!');
        }
        else{
            return back()->with('errorMessage', 'Adult must greater than 1 PAX!!');
        }
    }
    public  function bookTourPackageB2b(Request $request){
        try {
            if ($request) {
                $package = DB::table('b2c_tour_package')->where('agent_id',Session::get('agent_id'))->where('id',$request->id)->first();
                $total = $package->p_p_adult * $request->adult + $package->p_p_child * $request->child;
                $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
                if($total > $agent->agency_amount){
                    return back()->with('errorMessage', 'Please recharge your account to book this tour package!!');
                }
                //dd($package);
                if($agent->agency_amount > $total){
                    $result = DB::table('users')
                        ->where('id', Session::get('agent_id'))
                        ->update([
                            'agency_amount' => $agent->agency_amount - $total,
                        ]);
                    if($result){
                        $invoice = DB::table('package_details')->insert([
                            'agent_id' => Session::get('agent_id'),
                            'p_countries' => $package->c_name,
                            'title' => $package->p_name,
                            'p_code' => $package->p_code,
                            'night' => $package->night,
                            'vendor' => $package->vendor,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'highlights' => $package->highlights,
                            'traveler' => json_encode($request->name),
                            'day_title' => $package->title,
                            'dat_itinary' => $package->itinary,
                            'g_details' => $request->adult + $request->child,
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
                            $id = DB::getPdo()->lastInsertId();
                            $result1 = DB::table('accounts')->insert([
                                'agent_id' => Session::get('agent_id'),
                                'invoice_id' => $id,
                                'date' => date('Y-m-d'),
                                'transaction_type' => 'Debit',
                                'head' => 'Tour Package',
                                'source' => 'Tour Package',
                                'purpose' => 'Tour Package' . '---' . $request->title,
                                'buying_price' => $total,
                                'selling_price' => $total,
                            ]);
                            if ($result1) {
                                $domain =$this->domainCheck();
                                $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
                                if($domain['agent_id']) {
                                    //dd($request);
                                    $result = DB::table('order_request')->insert([
                                        'agent_id' => $domain['agent_id'],
                                        'r_ref' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child,
                                        'view' => 'https://tripdesigner.net/tour-package-b2b/'.$package->slug,
                                        'date' => date('Y-m-d'),
                                        'r_type' => "Tour Package",
                                        'status' => 'Ordered',
                                        'order_type' => 'B2B',
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child),
                                    ]);
                                    $to = 'tripdesigner.xyz@gmail.com';
                                    $email_cus = [$agent->company_email];
                                    $email_admin = [$to];
                                    $data = [
                                        'tracking' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child,
                                        'r_type' => "Tour Package",
                                        'status' => 'Ordered',
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child),
                                    ];
                                    if ($result) {
                                        Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                                            $message->subject("Trip Designer: Order Request Confirmation");
                                            $message->from('sales@tripdesigner.net', 'Tour Package Order');
                                            $message->to($email_cus);
                                        });
                                        Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                                            $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                                            $message->from('sales@tripdesigner.net', 'Tour Package Order');
                                            $message->to($email_admin);
                                        });
                                        return redirect()->to('newTourPackage')->with('successMessage', 'Tour Package Ordered successfully!!');

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
    public function printTourPackageInvoice(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('package_details')
                ->where('id',$request->id)
                ->first();
            return view('tourPackage.printTourPackageInvoice',['company' => $rows1,'package' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

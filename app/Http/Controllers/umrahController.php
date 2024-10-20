<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('updated_at','desc')
                ->get();
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows5 = DB::table('vendors') ->where('agent_id',Session::get('user_id'))->get();
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
                    'agent_id' => Session::get('user_id'),
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
                        'agent_id' => Session::get('user_id'),
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
            $rows7 = DB::table('vendors') ->where('agent_id',Session::get('user_id'))->get();
            $rows5 = DB::table('umrah_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('id',$request->id)
                ->first();
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
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
                        ->where('agent_id', Session::get('user_id'))
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
                            ->where('agent_id', Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
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
}

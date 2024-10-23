<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
}

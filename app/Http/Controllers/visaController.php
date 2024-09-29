<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class visaController extends Controller
{
    public function newVisaProcess(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('user_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('user_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('visa_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('updated_at','desc')
                ->get();
            return view('visa.newVisaProcess',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visas' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewVisa(Request $request){
        try{
            $result = DB::table('visa_invoice')->insert([
                'agent_id' => Session::get('user_id'),
                'visa_country' => $request->c_name,
                'date' => $request->date,
                'vendor' => $request->vendor,
                'issued_by' => $request->issued_by,
                'v_details' => $request->s_details,
                'pax_number' => $request->pax_number,
                'p_details' => json_encode($request->pax_name),
                'pass_number' => json_encode($request->pass_number),
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
                    'agent_id' => Session::get('user_id'),
                    'invoice_id' =>$id,
                    'date' => $request->date,
                    'transaction_type' => 'Debit',
                    'source' => 'Visa',
                    'purpose' => 'Visa Processing'.'---'.$request->c_name,
                    'buying_price' => $request->a_price,
                    'selling_price' =>$request->c_price + $request->vat + $request->ait,
                ]);
                return redirect()->to('newVisaProcess')->with('successMessage', 'New visa added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editVisaPage(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('user_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('user_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('visa_invoice')->where('id',$request->id)->first();
            return view('visa.editVisaPage',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visa' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editVisa (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('visa_invoice')
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
                        return redirect()->to('newVisaProcess')->with('successMessage', ' Visa Update successfully!!');
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
    public function deleteVisa(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('visa_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'deleted' => 1,
                        ]);
                    if ($result) {
                        return redirect()->to('newVisaProcess')->with('successMessage', 'Data deleted successfully!!');
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
    public function viewVisa(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('visa_invoice')
                ->where('id',$request->id)
                ->first();
            return view('visa.viewVisa',['company' => $rows1,'visa' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printVisaInvoice(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('visa_invoice')
                ->where('id',$request->id)
                ->first();
            return view('visa.printVisaInvoice',['company' => $rows1,'visa' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editVisaPaymentStatus (Request $request){
        try{
            $rows1 = DB::table('visa_invoice')
                ->where('agent_id',Session::get('user_id'))
                ->where('id',$request->id)
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('visa.editPaymentStatus',['visa' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateVisaPaymentStatus (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('visa_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'v_p_type' => $request->payment_type,
                            'v_due' => $request->due,
                            'v_p_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newVisaProcess')->with('successMessage', 'Payment Updated successfully!!');
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class tourController extends Controller
{
    public function newTourPackage(Request $request){
        try{
            $rows1 = DB::table('tour_countries')->get();
            $rows2 = DB::table('package_details')
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
            return view('tourPackage.newTourPackage',['countries' => $rows1,'packages' => $rows2,'payment_types' => $rows3,'passengers' => $rows4]);
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
                    'agent_id' => Session::get('user_id'),
                    'p_countries' => $request->country,
                    'title' => $request->title,
                    'p_cover' => $request->p_cover,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'traveler' => json_encode($request->pax_name),
                    'g_details' => $request->pax_number,
                    'p_a_price' => $request->a_price,
                    'p_c_details' => $request->c_price,
                    'p_vat' => $request->vat,
                    'p_ait' => $request->ait,
                    'p_details' => $request->p_details,
                    'p_inclusions' => $request->p_inclusions,
                    'p_exclusions' => $request->p_exclusions,
                    'p_tnt' => $request->p_tnt,
                    'p_policy' => $request->p_cancel,
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
            $rows1 = DB::table('tour_countries')->get();
            $rows5 = DB::table('package_details')
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
            return view('tourPackage.editTourPackage',['countries' => $rows1,'package' => $rows5,'passengers' => $rows4,'payment_types' => $rows6]);
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
                        ->where('agent_id', Session::get('user_id'))
                        ->update([
                            'p_countries' => $request->country,
                            'title' => $request->title,
                            'p_cover' => $request->p_cover,
                            'start_date' => $request->start_date,
                            'end_date' => $request->end_date,
                            'traveler' => json_encode($request->pax_name),
                            'g_details' => $request->pax_number,
                            'p_a_price' => $request->a_price,
                            'p_c_details' => $request->c_price,
                            'p_vat' => $request->vat,
                            'p_ait' => $request->ait,
                            'p_details' => $request->p_details,
                            'p_inclusions' => $request->p_inclusions,
                            'p_exclusions' => $request->p_exclusions,
                            'p_tnt' => $request->p_tnt,
                            'p_policy' => $request->p_cancel,
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
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            return view('tourPackage.viewTourPackage',['package' => $rows1,'company' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

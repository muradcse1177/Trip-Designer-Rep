<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class manpowerController extends Controller
{
    public function newManPowerPackage(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('user_id'))
                ->where('deleted',0)
                ->get();
            return view('manpower.newManPowerPackage',['payment_types' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

<?php

namespace App\Http\Controllers;


use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class statemntController extends Controller
{
    public function ucbSolvency (Request $request){
        try{
            return view('bankStatement.ucbSolvency');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function generatePDF (Request $request){
        try{
            $data = [
                'date' => $request->date,
                'name' => $request->name,
                'address' => $request->address,
                'ac_type' => $request->ac_type,
                'ac_no' => $request->ac_no,
                'ac_balance' => $request->ac_balance,
                'e_date' => $request->e_date,
            ];

            $pdf = PDF::loadView('/bankStatement/ucbSolvencyPDF', $data);

            return $pdf->download('ucbSolvencyPDF.pdf');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function ucbStatement (Request $request){
        try{
            return view('bankStatement.ucbStatement');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function generatePDFStatement (Request $request){
        try{
            $data = [
                'name' => $request->name,
                'j_name' => $request->j_name,
                'fhp' => $request->fhp,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
                'c_id' => $request->c_id,
                'ac_no' => $request->ac_no,
                'ac_type' => $request->ac_type,
                'currency' => $request->currency,
                'a_status' => $request->a_status,
                's_date' => $request->s_date,
                'e_date' => $request->e_date,
                'f_balance' => $request->f_balance,
                't_number' => $request->t_number,
            ];
            $i=0;
            $t_number = $request->t_number;
            for($t=0; $t<$t_number; $t++){
                $cause = array('Debit','Credit');
                $d_cause = array('Cash Withdraw','Purchase','Purchase with card','Balance Transfer');
                $c_cause = array('Cash Deposit','Balance Transfer');
                $random_keys_cause = $cause[array_rand($cause, 1)];
                $random_keys_d_cause = $d_cause[array_rand($d_cause, 1)];
                $random_keys_c_cause = $c_cause[array_rand($c_cause, 1)];
                if($random_keys_cause == 'Debit'){
                    $date  = $this->randomDate($request->s_date, $request->e_date);
                    $digit_rand16 = $this->rand_string_16();
                    $digit_rand8 = $this->rand_string_8();
                    $digit_rand64 = $this->rand_6().'******'.$this->rand_4();
                    $digit_rand3 = $this->rand_3();
                    $digit_rand12 = $this->rand_12();
                    $json64 = json_encode( array($digit_rand3,$digit_rand64,$digit_rand8,$digit_rand12));
                    $cause = $random_keys_d_cause;
                    $debit_amount= number_format((float)$this->rand_5(), 2, '.', '');
                    $credit_amount = number_format((float)0, 2, '.', '');
                }
                if($random_keys_cause == 'Credit'){
                    $date  = $this->randomDate($request->s_date, $request->e_date);
                    $digit_rand16 = $this->rand_string_16();
                    $digit_rand8 = $this->rand_string_8();
                    $digit_rand64 = $this->rand_6().'******'.$this->rand_4();
                    $digit_rand3 = $this->rand_3();
                    $digit_rand12 = $this->rand_12();
                    $json64 = json_encode( array($digit_rand3,$digit_rand64,$digit_rand8,$digit_rand12));
                    $cause = $random_keys_c_cause;
                    $credit_amount= number_format((float)$this->rand_5(), 2, '.', '');
                    $debit_amount = number_format((float)0, 2, '.', '');
                }
                $result1 = DB::table('statement')->insert([
                    'date' =>$date,
                    'ref' => $digit_rand16,
                    'narration' => $json64,
                    'details' => $cause,
                    'debit' => $debit_amount,
                    'credit' =>$credit_amount,
                ]);
            }

            $pdf = PDF::loadView('/bankStatement/ucbStatementPDF', $data);
            return $pdf->download('ucbStatementDF.pdf');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    function randomDate($s_date, $e_date)
    {
        $min = strtotime($s_date);
        $max = strtotime($e_date);
        $val = rand($min, $max);
        return date('Y-m-d', $val);
    }
    function rand_string_16() {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,16);
    }
    function rand_string_8() {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        return substr(str_shuffle($chars),0,8);
    }
    function rand_3() {
        $chars = "0123456789";
        return substr(str_shuffle($chars),0,3);
    }
    function rand_6() {
        $chars = "0123456789";
        return substr(str_shuffle($chars),0,6);
    }
    function rand_4() {
        $chars = "0123456789";
        return substr(str_shuffle($chars),0,4);
    }
    function rand_12() {
        $chars = "0123456789";
        return substr(str_shuffle($chars),0,12);
    }
    function rand_5() {
        $chars = "0123456789";
        return substr(str_shuffle($chars),0,5);
    }
}

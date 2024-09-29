<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class senderController extends Controller
{
    public function smsSender(Request $request){
            try{
                return view('sender.smsSender');
            }
            catch(\Illuminate\Database\QueryException $ex){
                return back()->with('errorMessage', $ex->getMessage());
            }
    }
    function sms_send($number,$msg) {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "1Nosb4Kj8zSU5iuoCqP4";
        $senderid = "8809617611061";
        $number = $number;
        $message = $msg;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    public function sendSMS(Request $request){
        try{

            $msg = $request->sms;
            $numbers = $request->number;
            $result = DB::table('sms_log')->insert([
                'agent_id' =>Session::get('user_id'),
                'number' => $numbers,
                'sms' => $msg,
                'status' => 'Sent',
            ]);
            $res_val = $this->sms_send($numbers,$msg);
            if ($result) {
                return redirect()->to('smsSender')->with('successMessage', 'SMS Sent Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function smsLog(Request $request){
        try{
            $rows = DB::table('sms_log')->where('agent_id',Session::get('user_id'))->get();
            return view('sender.smsLog', ['sms' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

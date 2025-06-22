<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

            //All
            if($request->group_name == 'all'){

                //dd('All');
                $orders = DB::table('order_request')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('phone')
                    ->toArray();

                $contacts = DB::table('contacts')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('phone')
                    ->toArray();

                $passengers = DB::table('passengers')
                    ->where('upload_by',Session::get('agent_id'))
                    ->pluck('phone')
                    ->toArray();

                $rows3 = DB::table('users')
                    ->where('role',2)
                    ->select('company_pnone','phone_code')
                    ->get();
                $merged2 = [];
                // Step 2: Merge the two columns per row
                foreach ($rows3 as $row) {
                    // Concatenate without space and trim
                    $fullNumber = str_replace(' ', '', trim($row->phone_code . $row->company_pnone));
                    $users[] = $fullNumber;
                }

                // Step 1: Merge all arrays
                $merged = array_merge($orders, $contacts, $passengers, $users);

                // Step 2: Remove duplicates
                $unique = array_unique($merged);

                // Step 3: Convert to comma-separated string
                $commaSeparated = implode(',', $unique);
                $numbers = $commaSeparated;
            }
            if($request->group_name == 'contacts'){
                $rows1 = DB::table('contacts')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('phone')
                    ->toArray();
                $commaSeparatedNumbers = implode(',', $rows1);
                $numbers = $commaSeparatedNumbers;
            }

            //Tickets
            if($request->group_name == 'tickets'){

                //dd('tickets');
                $rows = DB::table('air_ticket_invoice')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('pax_name') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                 //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }

            //Hotel
            if($request->group_name == 'hotel'){

                //dd('Hotel');
                $rows = DB::table('hotel_invoice')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('pax') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }
            if($request->group_name == 'visa'){

                //dd('visa');
                $rows = DB::table('visa_invoice')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('p_details') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }
            if($request->group_name == 'tour'){

                //dd('tour');
                $rows = DB::table('package_details')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('traveler') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }
            if($request->group_name == 'hajj'){

                //dd('hajj');
                $rows = DB::table('umrah_invoice')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('traveler') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;

            }
            if($request->group_name == 'manpower'){

                //dd('manpower');
                $rows = DB::table('work_permit_invoice')
                    ->where('agent_id',Session::get('agent_id'))
                    ->pluck('p_details') // Get only the JSON field
                    ->toArray();

                $merged = [];

                // Step 2: Decode and merge all arrays
                foreach ($rows as $json) {
                    $items = json_decode($json, true);

                    if (is_array($items)) {
                        $merged = array_merge($merged, $items);
                    }
                }

                // Step 3: Clean each element (remove inner spaces and trim)
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $merged);

                //Optional: remove duplicates
                $air_ticket_phone_array=[];
                $cleaned = array_unique($cleaned);
                foreach ($cleaned as $id) {
                    $rows = DB::table('passengers')
                        ->where('id',$id)
                        ->pluck('phone')
                        ->first();
                    $air_ticket_phone_array[] = $rows;
                }
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $air_ticket_phone_array);
                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }

            //Agent
            if($request->group_name == 'agent'){

                //dd('agent');
                $rows = DB::table('users')
                    ->where('role',2)
                    ->select('company_pnone','phone_code')
                    ->get();
                $merged = [];

                // Step 2: Merge the two columns per row
                foreach ($rows as $row) {
                    // Concatenate without space and trim
                    $fullNumber = str_replace(' ', '', trim($row->phone_code . $row->company_pnone));
                    $merged[] = $fullNumber;
                }

                // Step 3: Remove duplicates (optional)
                $uniqueNames = array_unique($merged);

                // Step 4: Implode into a comma-separated string
                $commaSeparated = implode(',', $uniqueNames);

                $numbers = $commaSeparated;
            }

            //Employee
            if($request->group_name == 'employee'){

                //dd('agent');
                $rows = DB::table('users')
                    ->where('role',5)
                    ->select('company_pnone','phone_code')
                    ->get();
                $merged = [];

                // Step 2: Merge the two columns per row
                foreach ($rows as $row) {
                    // Concatenate without space and trim
                    $fullNumber = str_replace(' ', '', trim($row->phone_code . $row->company_pnone));
                    $merged[] = $fullNumber;
                }

                // Step 3: Remove duplicates (optional)
                $uniqueNames = array_unique($merged);

                // Step 4: Implode into a comma-separated string
                $commaSeparated = implode(',', $uniqueNames);

                $numbers = $commaSeparated;

            }

            //B2c Customer
            if($request->group_name == 'b2c'){

                //dd('B2c Customer');
                $rows = DB::table('users')
                    ->where('role',3)
                    ->select('company_pnone','phone_code')
                    ->get();
                $merged = [];

                // Step 2: Merge the two columns per row
                foreach ($rows as $row) {
                    // Concatenate without space and trim
                    $fullNumber = str_replace(' ', '', trim($row->phone_code . $row->company_pnone));
                    $merged[] = $fullNumber;
                }

                // Step 3: Remove duplicates (optional)
                $uniqueNames = array_unique($merged);

                // Step 4: Implode into a comma-separated string
                $commaSeparated = implode(',', $uniqueNames);

                $numbers = $commaSeparated;
            }

            //All Passengers
            if($request->group_name == 'passengers'){

                //dd('Passengers');
                $rows = DB::table('passengers')
                    ->where('upload_by',Session::get('agent_id'))
                    ->pluck('phone')
                    ->toArray();
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $rows);

                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }

            //Order Request
            if($request->group_name == 'order_req'){

                //dd('Order request');
                $rows = DB::table('order_request')
                    ->pluck('phone')
                    ->toArray();
                $cleaned = array_map(function ($item) {
                    return str_replace(' ', '', trim($item));
                }, $rows);

                $uniqueTags = array_unique($cleaned);
                $commaSeparatedNumbers = implode(',', $uniqueTags);
                $numbers = $commaSeparatedNumbers;
            }
            if($request->group_name == ''){
                $numbers = $request->number;
            }
            $numberArray = explode(',', $numbers);
            $count = count($numberArray);

            $char_count = strlen($msg);
            $result = ceil($char_count / 155);
            $price = $result*.50*$count;

            $agent_infoo = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            if($agent_infoo->agency_amount >= $price){
                $result = DB::table('users')
                    ->where('id', Session::get('user_id'))
                    ->update([
                        'agency_amount' => $agent_infoo->agency_amount - $price
                    ]);
            }
            else{
                return redirect()->to('smsSender')->with('errorMessage', 'You have not enough money in your account!! Please recharge and try again!!');
            }
            $result = DB::table('sms_log')->insert([
                'agent_id' =>Session::get('agent_id'),
                'number' => $numbers,
                'sms' => $msg,
                'status' => 'Sent',
            ]);
            $res_val = $this->sms_send($numbers,$msg);
            if ($result) {
                return redirect()->to('smsSender')->with('successMessage', '<b>Total SMS:'.$count. '<b>'.'<br> SMS Sent Successfully!!');
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
            $rows = DB::table('sms_log')->where('agent_id',Session::get('agent_id'))->orderBy('id','desc')->get();
            return view('sender.smsLog', ['sms' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function allPaxNumber(Request $request)
    {
        //dd($request->slug);
        if($request->slug == 'pax'){
            $rows = DB::table('passengers')
                ->where('upload_by',Session::get('agent_id'))
                ->pluck('phone')
                ->toArray();
        }
        if($request->slug == 'contact'){
            $rows = DB::table('contacts')
                ->where('agent_id',Session::get('agent_id'))
                ->pluck('phone')
                ->toArray();
        }
        if($request->slug == 'all'){
            $orders = DB::table('order_request')
                ->pluck('phone')
                ->toArray();

            $contacts = DB::table('contacts')
                ->where('agent_id',Session::get('agent_id'))
                ->pluck('phone')
                ->toArray();

            $passengers = DB::table('passengers')
                ->where('upload_by',Session::get('agent_id'))
                ->pluck('phone')
                ->toArray();

            $rows3 = DB::table('users')
                ->where('role',2)
                ->select('company_pnone','phone_code')
                ->get();
            $merged2 = [];
            // Step 2: Merge the two columns per row
            foreach ($rows3 as $row) {
                // Concatenate without space and trim
                $fullNumber = str_replace(' ', '', trim($row->phone_code . $row->company_pnone));
                $users[] = $fullNumber;
            }

            // Step 1: Merge all arrays
            $merged = array_merge($orders, $contacts, $passengers, $users);

            // Step 2: Remove duplicates
            $rows = array_unique($merged);
        }


        $rawNumbers = $rows;
        $formattedNumbers = array_filter(array_map(function ($number) {
            // Remove all non-digit characters
            $cleaned = preg_replace('/\D/', '', $number);

            // Discard if less than 10 digits
            if (strlen($cleaned) < 10) {
                return null;
            }

            // Valid 13-digit format already (starting with 8801)
            if (preg_match('/^8801\d{9}$/', $cleaned)) {
                return $cleaned;
            }

            // 11-digit starting with 01 → prepend 88
            if (preg_match('/^01\d{9}$/', $cleaned)) {
                return '88' . $cleaned;
            }

            // 10-digit starting with 1 → assume missing '0' and prepend 880
            if (preg_match('/^1\d{9}$/', $cleaned)) {
                return '880' . $cleaned;
            }

            // Invalid
            return null;
        }, $rawNumbers));
        $uniqueNumbers = array_unique($formattedNumbers);

        // Join with new lines only
        $output = implode("\n", $uniqueNumbers);
        dd($output);
    }
}

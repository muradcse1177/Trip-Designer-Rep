<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class hotelController extends Controller
{
    public function hotelBooking(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows2 = DB::table('payment_type')->get();
            $rows3 = DB::table('passengers')->get();
            $rows4 = DB::table('vendors')->get();
            return view('hotel.hotelBooking',['bookings' => $rows1,'payment_types' => $rows2,'passengers' => $rows3,'vendors' => $rows4]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewHotelBooking(Request $request){
        try{
            if($request) {
                //dd($request);
                $result = DB::table('hotel_invoice')->insert([
                    'agent_id' => Session::get('user_id'),
                    'h_name' => $request->h_name,
                    'h_address' => $request->h_address,
                    'h_phone' => $request->h_phone,
                    'reservation' => $request->reservation,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                    'b_date' => $request->b_date,
                    'vendor' => $request->vendor,
                    'pax_number' => $request->pax_number,
                    'pax' => json_encode($request->pax),
                    'h_details' => json_encode($request->h_details),
                    'a_price' => $request->a_price,
                    'c_price' => $request->c_price,
                    'vat' => $request->vat,
                    'ait' => $request->ait,
                    'p_type' => $request->p_type,
                    'p_details' => $request->p_details,
                    'due_amount' => $request->due_amount,
                ]);
                if ($result) {
                    $id = DB::getPdo()->lastInsertId();
                    $result1 = DB::table('accounts')->insert([
                        'agent_id' => Session::get('user_id'),
                        'invoice_id' =>$id,
                        'date' => date('Y-m-d'),
                        'transaction_type' => 'Debit',
                        'source' => 'Hotel Booking',
                        'purpose' => 'Hotel Booking'.'---'.$request->reservation,
                        'buying_price' => $request->a_price,
                        'selling_price' =>$request->c_price + $request->vat + $request->ait,
                    ]);
                    if($result1){
                        return redirect()->to('hotelBooking')->with('successMessage', 'New invoice created successfully!!');
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
    public function viewHotelBooking(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            return view('hotel.viewHotelBooking',['package' => $rows1,'company' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editHotelBookingPage(Request $request){
        try{
            $rows5 = DB::table('hotel_invoice')
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
            $rows3 = DB::table('vendors')->get();
            return view('hotel.editHotelBookingPage',['vendors' => $rows3,'package' => $rows5,'passengers' => $rows4,'payment_types' => $rows6]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateHotelBooking(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('hotel_invoice')
                        ->where('id', $request->id)
                        ->where('agent_id', Session::get('user_id'))
                        ->update([
                            'h_name' => $request->h_name,
                            'h_address' => $request->h_address,
                            'h_phone' => $request->h_phone,
                            'reservation' => $request->reservation,
                            'check_in' => $request->check_in,
                            'check_out' => $request->check_out,
                            'b_date' => $request->b_date,
                            'vendor' => $request->vendor,
                            'pax_number' => $request->pax_number,
                            'pax' => json_encode($request->pax),
                            'h_details' => json_encode($request->h_details),
                            'a_price' => $request->a_price,
                            'c_price' => $request->c_price,
                            'vat' => $request->vat,
                            'ait' => $request->ait,
                            'p_type' => $request->p_type,
                            'p_details' => $request->p_details,
                            'due_amount' => $request->due_amount,
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
                            return redirect()->to('hotelBooking')->with('successMessage', 'Data Updated successfully!!');
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

    public function deleteHotelBooking(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('hotel_invoice')
                        ->where('id', $request->id)
                        ->delete();
                    if ($result) {
                        return redirect()->to('hotelBooking')->with('successMessage', 'Data deleted successfully!!');
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
    public function editHotelBookingPayment(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('hotel.editHotelBookingPayment',['tickets' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateHotelBookingPaymentStatus(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('hotel_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'p_type' => $request->p_type,
                            'due_amount' => $request->due,
                            'p_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('hotelBooking')->with('successMessage', 'Payment Updated successfully!!');
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

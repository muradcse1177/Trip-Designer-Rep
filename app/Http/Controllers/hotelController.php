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
                ->where('agent_id',Session::get('agent_id'))
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
    public function createNewHotelBooking(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insert hotel booking into hotel_invoice table
            $invoiceId = DB::table('hotel_invoice')->insertGetId([
                'agent_id'    => Session::get('agent_id'),
                'h_name'      => $request->h_name,
                'h_address'   => $request->h_address,
                'h_phone'     => $request->h_phone,
                'reservation' => $request->reservation,
                'check_in'    => $request->check_in,
                'check_out'   => $request->check_out,
                'b_date'      => $request->b_date,
                'vendor'      => $request->vendor,
                'pax_number'  => $request->pax_number,
                'pax'         => json_encode($request->pax),
                'h_details'   => json_encode($request->h_details),
                'a_price'     => $request->a_price,
                'c_price'     => $request->c_price,
                'vat'         => $request->vat,
                'ait'         => $request->ait,
                'p_type'      => $request->p_type,
                'p_details'   => $request->p_details,
                'due_amount'  => $request->due_amount,
            ]);

            // Calculate total selling price
            $sellingPrice = $request->c_price + $request->vat + $request->ait;

            // Insert financial record into accounts table
            $accountInserted = DB::table('accounts')->insert([
                'agent_id'         => Session::get('agent_id'),
                'invoice_id'       => $invoiceId,
                'date'             => date('Y-m-d'),
                'transaction_type' => 'Debit',
                'source'           => 'Hotel Booking',
                'purpose'          => 'Hotel Booking --- ' . $request->reservation,
                'buying_price'     => $request->a_price,
                'selling_price'    => $sellingPrice,
            ]);

            if ($accountInserted) {
                DB::commit();
                return redirect()->to('hotelBooking')->with('successMessage', 'New invoice created successfully!!');
            } else {
                DB::rollBack();
                return back()->with('errorMessage', 'Please try again!!');
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function viewHotelBooking(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
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
            $rows3 = DB::table('vendors')->get();
            return view('hotel.editHotelBookingPage',['vendors' => $rows3,'package' => $rows5,'passengers' => $rows4,'payment_types' => $rows6]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateHotelBooking(Request $request)
    {
        try {
            if (!$request->id) {
                return back()->with('errorMessage', 'Bad Request!!');
            }

            DB::beginTransaction();

            // Update hotel_invoice table
            $invoiceUpdated = DB::table('hotel_invoice')
                ->where('id', $request->id)
                ->where('agent_id', Session::get('agent_id'))
                ->update([
                    'h_name'      => $request->h_name,
                    'h_address'   => $request->h_address,
                    'h_phone'     => $request->h_phone,
                    'reservation' => $request->reservation,
                    'check_in'    => $request->check_in,
                    'check_out'   => $request->check_out,
                    'b_date'      => $request->b_date,
                    'vendor'      => $request->vendor,
                    'pax_number'  => $request->pax_number,
                    'pax'         => json_encode($request->pax),
                    'h_details'   => json_encode($request->h_details),
                    'a_price'     => $request->a_price,
                    'c_price'     => $request->c_price,
                    'vat'         => $request->vat,
                    'ait'         => $request->ait,
                    'p_type'      => $request->p_type,
                    'p_details'   => $request->p_details,
                    'due_amount'  => $request->due_amount,
                ]);

            if (!$invoiceUpdated) {
                DB::rollBack();
                return back()->with('errorMessage', 'Failed to update hotel invoice. Please try again!!');
            }

            // Calculate total selling price
            $sellingPrice = $request->c_price + $request->vat + $request->ait;

            // Update accounts table
            $accountUpdated = DB::table('accounts')
                ->where('invoice_id', $request->id)
                ->where('agent_id', Session::get('agent_id'))
                ->where('source', 'Hotel Booking')
                ->update([
                    'buying_price'  => $request->a_price,
                    'selling_price' => $sellingPrice,
                    'updated_at'    => now(),
                ]);

            if (!$accountUpdated) {
                DB::rollBack();
                return back()->with('errorMessage', 'Failed to update accounts. Please try again!!');
            }

            DB::commit();
            return redirect()->to('hotelBooking')->with('successMessage', 'Data updated successfully!!');

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return back()->with('errorMessage', 'Database Error: ' . $ex->getMessage());
        }
    }
    public function deleteHotelBooking(Request $request)
    {
        try {
            if (!$request->id) {
                return back()->with('errorMessage', 'Bad Request!!');
            }

            DB::beginTransaction();
            $hotel = DB::table('hotel_invoice')
                ->leftJoin('accounts', function ($join) {
                    $join->on('hotel_invoice.id', '=', 'accounts.invoice_id')
                        ->where('accounts.source', '=', 'Hotel Booking');
                })
                ->where('hotel_invoice.id', $request->id)
                ->first();
            // Delete from hotel_invoice
            $invoiceDeleted = DB::table('hotel_invoice')
                ->where('id', $request->id)
                ->where('agent_id', Session::get('agent_id'))
                ->delete();

            if (!$invoiceDeleted) {
                DB::rollBack();
                return back()->with('errorMessage', 'Failed to delete hotel invoice. Please try again!!');
            }

            // Delete related accounts entry
            DB::table('accounts')
                ->where('invoice_id', $hotel->invoice_id)
                ->where('agent_id', Session::get('agent_id'))
                ->where('source', 'Hotel Booking')
                ->delete();

            DB::commit();
            return redirect()->to('hotelBooking')->with('successMessage', 'Data deleted successfully!!');

        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editHotelBookingPayment(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
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
    public function printHotelBookingB2b(Request $request){
        try{
            $rows1 = DB::table('hotel_invoice')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            return view('hotel.printHotelBookingB2b',['package' => $rows1,'company' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

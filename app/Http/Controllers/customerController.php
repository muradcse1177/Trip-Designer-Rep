<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class customerController extends Controller
{
    public function myBooking()
    {
        // Check if user is logged in
        if (!session()->has('user_id')) {
            return redirect()->to('all-login')->with('errorMessage', 'Please log in to view your bookings.');
        }
        if (Session::get('user_role') != 3) {
            return redirect()->to('all-login')->with('errorMessage', 'Access denied. You are not authorized to view this page.');
        }

        $userId = session('user_id');
        $user = DB::table('users')->where('id',$userId)->first();
        // Fetch all orders for the user
        $orders = DB::table('payment_orders')
            ->where('user_id', $userId)
            ->orderByDesc('id')
            ->get();

        return view('frontend.customer.my-booking', compact('orders','user'));
    }
    public function customerProfile (Request $request){
        try{
            $user_id = Session::get('user_id');
            $row = DB::table('users')->where('id',$user_id)->first();
            $countries = DB::table('countries')->get();
            return view('frontend.customer.customer-profile',['user' => $row,'countries' => $countries,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateCustomerProfile (Request $request){
        try{
            if($request) {
                $username = $request->name;
                $email = $request->email;
                $phoneCode = $request->phoneCode;
                $phone = $request->phone;
                if($request->address)
                    $address = $request->address;
                else
                    $address="";
                $rows = DB::table('users')->where('id',Session::get('user_id'))->first();
                if($request->photo){
                    $fileName = time() . '.' . $request->photo->extension();
                    $request->photo->move(public_path('images/upload/company/'), $fileName);
                    $photo = 'public/images/upload/company/'.$fileName;
                }
                else{
                    $photo = $rows->logo;
                }
//                dd(Session::get('user_id'));
                $result = DB::table('users')
                    ->where('id',Session::get('user_id'))
                    ->update([
                        'company_name' => $username,
                        'company_email' => $email,
                        'phone_code' => $phoneCode,
                        'company_pnone' => $phone,
                        'address' => $address,
                        'logo' => $photo,
                    ]);
                if ($result) {
                    return back()->with('successMessage', 'Profile Updated Successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updatePassword (Request $request){
        try{
            if($request) {
                $o_pass = $request->o_pass;
                $n_pass = $request->n_pass;
                $rows = DB::table('users')->where('id',Session::get('user_id'))->first();
                if (Hash::check($o_pass, $rows->password)) {
                    $result = DB::table('users')
                        ->where('id', Session::get('user_id'))
                        ->update([
                            'password' => Hash::make($n_pass),
                        ]);
                    if ($result) {
                        Session::flush();
                        Cookie::queue(Cookie::forget('user'));
                        return redirect('all-login')->with('successMessage', 'Password Updated Successfully. Login in with New Password!!');
                    } else {
                        return back()->with('errorMessage1', 'Please try again!!');
                    }
                }
                else{
                    return back()->with('errorMessage1', 'Your Old Password Wrong. Please Contact with Admin !!');
                }
            }
            else{
                return back()->with('errorMessage1', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function downloadInvoice($tran_id)
    {
        // ✅ 1. Get order data
        $order = DB::table('payment_orders')->where('transaction_id', $tran_id)->first();

        if (!$order) {
            return redirect()->back()->with('errorMessage', 'Invoice not found.');
        }

        // ✅ 2. Load view with data
        $pdf = PDF::loadView('frontend.customer.invoice-pdf', compact('order'));

        // ✅ 3. Return PDF download response
        return $pdf->download('invoice_' . $tran_id . '.pdf');
    }
    public function viewBooking($tran_id)
    {
        $order = DB::table('payment_orders')
            ->join('course_details', 'payment_orders.local_id', '=', 'course_details.id')
            ->where('payment_orders.transaction_id', $tran_id)
            ->select('payment_orders.*', 'course_details.*')
            ->first();

        if (!$order) {
            abort(404);
        }
        return view('frontend.customer.course-booking-view', compact('order'));
    }
    public function downloadCourseDetails($tran_id)
    {
        $order = DB::table('payment_orders')
            ->join('course_details', 'payment_orders.local_id', '=', 'course_details.id')
            ->where('payment_orders.transaction_id', $tran_id)
            ->select('payment_orders.*', 'course_details.*')
            ->first();

        if (!$order) {
            return back()->with('errorMessage', 'Booking not found.');
        }

        $pdf = Pdf::loadView('frontend.customer.course-booking-pdf', compact('order'))->setPaper('a4', 'portrait');

        return $pdf->download('booking-details-' . $tran_id . '.pdf');
    }

}

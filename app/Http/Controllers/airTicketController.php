<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class airTicketController extends Controller
{
    public function newAirTicket(Request $request){
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
            $rows3 = DB::table('airport_details')
                ->get();
            $rows4 = DB::table('airlines_details')
                ->get();
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->paginate(50);
            $rows6 = DB::table('payment_type')
                ->get();
            return view('airTicket.newAirTicket',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'airports' => $rows3,'airlines' => $rows4,'tickets' => $rows5,'payment_types' => $rows6]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewAirTicket(Request $request){
        try{
            if($request) {
                $reservation_pnr = $request->reservation_pnr;
                $airline_pnr = $request->airline_pnr;
                $issue_date = ''.$request->issue_date.'';
                $vendor = $request->vendor;
                $issued_by = $request->issued_by;
                $f_type = $request->f_type;
                $f_class = $request->f_class;
                $a_from = json_encode($request->a_from);
                $a_to = json_encode($request->a_to);
                $d_time = json_encode($request->d_time);
                $a_time = json_encode($request->a_time);
                $f_number = json_encode($request->f_number);
                $airlines = json_encode($request->airlines);
                $pax_number = $request->pax_number;
                $pax_name = json_encode($request->pax_name);
                $t_number = json_encode($request->t_number);
                $luggage = json_encode($request->luggage);
                $a_price = $request->a_price;
                $c_price = $request->c_price;
                $vat = $request->vat;
                $ait = $request->ait;
                $payment_type = $request->payment_type;
                $p_details = $request->p_details;
                $due = $request->due;
                $result = DB::table('air_ticket_invoice')->insert([
                    'agent_id' => Session::get('user_id'),
                    'reservation_pnr' => $reservation_pnr,
                    'airline_pnr' => $airline_pnr,
                    'issue_date' => $issue_date,
                    'vendor' => $vendor,
                    'issued_by' => $issued_by,
                    'f_type' => $f_type,
                    'f_class' => $f_class,
                    'a_from' => $a_from,
                    'a_to' => $a_to,
                    'd_time' => $d_time,
                    'a_time' => $a_time,
                    'f_number' => $f_number,
                    'airlines' => $airlines,
                    'pax_number' => $pax_number,
                    'pax_name' => $pax_name,
                    't_number' => $t_number,
                    'luggage' => $luggage,
                    'a_price' => $a_price,
                    'c_price' => $c_price,
                    'vat' => $vat,
                    'ait' => $ait,
                    'payment_type' => $payment_type,
                    'p_details' => $p_details,
                    'due_amount' => $due,
                ]);
                if ($result) {
                    $id = DB::getPdo()->lastInsertId();
                    $result1 = DB::table('accounts')->insert([
                        'agent_id' => Session::get('user_id'),
                        'invoice_id' =>$id,
                        'date' => $issue_date,
                        'transaction_type' => 'Debit',
                        'source' => 'Air Ticket',
                        'purpose' => 'Air Ticket'.'---'.$reservation_pnr.'---'.$airline_pnr,
                        'buying_price' => $a_price,
                        'selling_price' =>$c_price + $vat + $ait,
                    ]);
                    return redirect()->to('newAirTicket')->with('successMessage', 'New invoice created successfully!!');
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
    public function editTicketPage(Request $request){
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
            $rows3 = DB::table('airport_details')
                ->get();
            $rows4 = DB::table('airlines_details')
                ->get();
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('id',$request->id)
                ->first();
            $rows6 = DB::table('payment_type')
                ->get();
            return view('airTicket.editAirTicket',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'airports' => $rows3,'airlines' => $rows4,'tickets' => $rows5,'payment_types' => $rows6]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateNewAirTicket(Request $request){
        try{
            if($request) {
                if($request->id) {
                    if($request->reissue == 1){
                        $rows = DB::table('air_ticket_invoice')
                            ->where('agent_id',Session::get('user_id'))
                            ->where('id',$request->id)
                            ->where('deleted',0)
                            ->first();
                        $reservation_pnr = $request->reservation_pnr;
                        $airline_pnr = $request->airline_pnr;
                        $issue_date = ''.$request->issue_date.'';
                        $vendor = $request->vendor;
                        $issued_by = $request->issued_by;
                        $f_type = $request->f_type;
                        $f_class = $request->f_class;
                        $a_from = json_encode($request->a_from);
                        $a_to = json_encode($request->a_to);
                        $d_time = json_encode($request->d_time);
                        $a_time = json_encode($request->a_time);
                        $f_number = json_encode($request->f_number);
                        $airlines = json_encode($request->airlines);
                        $pax_number = $rows->pax_number;
                        $pax_name = $rows->pax_name;
                        $t_number = $rows->t_number;
                        $luggage = $rows->luggage;
                        $a_price = $request->a_price;
                        $c_price = $request->c_price;
                        $vat = $request->vat;
                        $ait = $request->ait;
                        $payment_type = $request->payment_type;
                        $p_details = $request->p_details;
                        $due = $request->due;
                        $result = DB::table('air_ticket_invoice')->insert([
                            'agent_id' => Session::get('user_id'),
                            'reservation_pnr' => $reservation_pnr,
                            'airline_pnr' => $airline_pnr,
                            'issue_date' => date('Y-m-d'),
                            'vendor' => $vendor,
                            'issued_by' => $issued_by,
                            'f_type' => $f_type,
                            'f_class' => $f_class,
                            'a_from' => $a_from,
                            'a_to' => $a_to,
                            'd_time' => $d_time,
                            'a_time' => $a_time,
                            'f_number' => $f_number,
                            'airlines' => $airlines,
                            'pax_number' => $pax_number,
                            'pax_name' => $pax_name,
                            't_number' => $t_number,
                            'luggage' => $luggage,
                            'a_price' => $a_price,
                            'c_price' => $c_price,
                            'vat' => $vat,
                            'ait' => $ait,
                            'payment_type' => $payment_type,
                            'p_details' => $p_details,
                            'due_amount' => $due,
                            'status' => 'Reissued',
                        ]);
                        if ($result) {
                            $result =DB::table('accounts')
                                ->where('invoice_id', $request->id)
                                ->where('agent_id', Session::get('user_id'))
                                ->update([
                                    'date' => date('Y-m-d'),
                                    'transaction_type' => 'Debit',
                                    'source' => 'Reissue Ticket',
                                    'purpose' => 'Reissue Ticket'.'---'.$reservation_pnr.'---'.$airline_pnr,
                                    'buying_price' => $a_price,
                                    'selling_price' =>$c_price + $vat + $ait,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            return redirect()->to('reissueAirTicket')->with('successMessage', 'Data update successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                    if($request->refund == 1){
                        $rows = DB::table('air_ticket_invoice')
                            ->where('agent_id',Session::get('user_id'))
                            ->where('id',$request->id)
                            ->where('deleted',0)
                            ->first();
                        $reservation_pnr = $request->reservation_pnr;
                        $airline_pnr = $request->airline_pnr;
                        $issue_date = date('Y-m-d');
                        $vendor = $rows->vendor;
                        $issued_by = $rows->issued_by;
                        $f_type = $rows->f_type;
                        $f_class = $rows->f_class;
                        $a_from = $rows->a_from;
                        $a_to = $rows->a_to;
                        $d_time = $rows->d_time;
                        $a_time = $rows->a_time;
                        $f_number = $rows->f_number;
                        $airlines = $rows->airlines;
                        $pax_number = $rows->pax_number;
                        $pax_name = $rows->pax_name;
                        $t_number = $rows->t_number;
                        $luggage = $rows->luggage;
                        $a_price = $request->a_price;
                        $c_price = $request->c_price;
                        $vat = $request->vat;
                        $ait = $request->ait;
                        $payment_type = $request->payment_type;
                        $p_details = $request->p_details;
                        $due = $request->due;
                        $result = DB::table('air_ticket_invoice')->insert([
                            'agent_id' => Session::get('user_id'),
                            'reservation_pnr' => $reservation_pnr,
                            'airline_pnr' => $airline_pnr,
                            'issue_date' => $issue_date,
                            'vendor' => $vendor,
                            'issued_by' => $issued_by,
                            'f_type' => $f_type,
                            'f_class' => $f_class,
                            'a_from' => $a_from,
                            'a_to' => $a_to,
                            'd_time' => $d_time,
                            'a_time' => $a_time,
                            'f_number' => $f_number,
                            'airlines' => $airlines,
                            'pax_number' => $pax_number,
                            'pax_name' => $pax_name,
                            't_number' => $t_number,
                            'luggage' => $luggage,
                            'a_price' => $a_price,
                            'c_price' => $c_price,
                            'vat' => $vat,
                            'ait' => $ait,
                            'payment_type' => $payment_type,
                            'p_details' => $p_details,
                            'due_amount' => $due,
                            'status' => 'Refunded',
                        ]);
                        if ($result) {
                            $result =DB::table('accounts')
                                ->where('invoice_id', $request->id)
                                ->where('agent_id', Session::get('user_id'))
                                ->update([
                                    'date' => date('Y-m-d'),
                                    'transaction_type' => 'Debit',
                                    'source' => 'Refund Ticket',
                                    'purpose' => 'Refund Ticket'.'---'.$reservation_pnr.'---'.$airline_pnr,
                                    'buying_price' => $a_price,
                                    'selling_price' =>$c_price + $vat + $ait,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            return redirect()->to('refundAirTicket')->with('successMessage', 'Data update successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                    if($request->cancel == 1){
                        $rows = DB::table('air_ticket_invoice')
                            ->where('agent_id',Session::get('user_id'))
                            ->where('id',$request->id)
                            ->where('deleted',0)
                            ->first();
                        $reservation_pnr = $request->reservation_pnr;
                        $airline_pnr = $request->airline_pnr;
                        $issue_date = date('Y-m-d');
                        $vendor = $rows->vendor;
                        $issued_by = $rows->issued_by;
                        $f_type = $rows->f_type;
                        $f_class = $rows->f_class;
                        $a_from = $rows->a_from;
                        $a_to = $rows->a_to;
                        $d_time = $rows->d_time;
                        $a_time = $rows->a_time;
                        $f_number = $rows->f_number;
                        $airlines = $rows->airlines;
                        $pax_number = $rows->pax_number;
                        $pax_name = $rows->pax_name;
                        $t_number = $rows->t_number;
                        $luggage = $rows->luggage;
                        $a_price = $request->a_price;
                        $c_price = $request->c_price;
                        $vat = $request->vat;
                        $ait = $request->ait;
                        $payment_type = $request->payment_type;
                        $p_details = $request->p_details;
                        $due = $request->due;
                        $result = DB::table('air_ticket_invoice')->insert([
                            'agent_id' => Session::get('user_id'),
                            'reservation_pnr' => $reservation_pnr,
                            'airline_pnr' => $airline_pnr,
                            'issue_date' => $issue_date,
                            'vendor' => $vendor,
                            'issued_by' => $issued_by,
                            'f_type' => $f_type,
                            'f_class' => $f_class,
                            'a_from' => $a_from,
                            'a_to' => $a_to,
                            'd_time' => $d_time,
                            'a_time' => $a_time,
                            'f_number' => $f_number,
                            'airlines' => $airlines,
                            'pax_number' => $pax_number,
                            'pax_name' => $pax_name,
                            't_number' => $t_number,
                            'luggage' => $luggage,
                            'a_price' => $a_price,
                            'c_price' => $c_price,
                            'vat' => $vat,
                            'ait' => $ait,
                            'payment_type' => $payment_type,
                            'p_details' => $p_details,
                            'due_amount' => $due,
                            'status' => 'Cancelled',
                        ]);
                        if ($result) {
                            $result =DB::table('accounts')
                                ->where('invoice_id', $request->id)
                                ->where('agent_id', Session::get('user_id'))
                                ->update([
                                    'date' => date('Y-m-d'),
                                    'transaction_type' => 'Debit',
                                    'source' => 'Cancel Ticket',
                                    'purpose' => 'Cancel Ticket'.'---'.$reservation_pnr.'---'.$airline_pnr,
                                    'buying_price' => $a_price,
                                    'selling_price' =>$c_price + $vat + $ait,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            return redirect()->to('cancelAirTicket')->with('successMessage', 'Data update successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                    else{
                        $reservation_pnr = $request->reservation_pnr;
                        $airline_pnr = $request->airline_pnr;
                        $issue_date = ''.$request->issue_date.'';
                        $vendor = $request->vendor;
                        $issued_by = $request->issued_by;
                        $f_type = $request->f_type;
                        $f_class = $request->f_class;
                        $a_from = json_encode($request->a_from);
                        $a_to = json_encode($request->a_to);
                        $d_time = json_encode($request->d_time);
                        $a_time = json_encode($request->a_time);
                        $f_number = json_encode($request->f_number);
                        $airlines = json_encode($request->airlines);
                        $a_price = $request->a_price;
                        $c_price = $request->c_price;
                        $vat = $request->vat;
                        $ait = $request->ait;
                        $payment_type = $request->payment_type;
                        $p_details = $request->p_details;
                        $due = $request->due;
                        $result =DB::table('air_ticket_invoice')
                            ->where('id', $request->id)
                            ->update([
                                'reservation_pnr' => $reservation_pnr,
                                'airline_pnr' => $airline_pnr,
                                'issue_date' => $issue_date,
                                'vendor' => $vendor,
                                'issued_by' => $issued_by,
                                'f_type' => $f_type,
                                'f_class' => $f_class,
                                'a_from' => $a_from,
                                'a_to' => $a_to,
                                'd_time' => $d_time,
                                'a_time' => $a_time,
                                'f_number' => $f_number,
                                'airlines' => $airlines,
                                'a_price' => $a_price,
                                'c_price' => $c_price,
                                'vat' => $vat,
                                'ait' => $ait,
                                'payment_type' => $payment_type,
                                'p_details' => $p_details,
                                'due_amount' => $due,
                                'updated_at' => date('Y-m-d h:i:s'),
                            ]);
                        if ($result) {
                            $result =DB::table('accounts')
                                ->where('invoice_id', $request->id)
                                ->where('agent_id', Session::get('user_id'))
                                ->update([
                                    'buying_price' => $a_price,
                                    'selling_price' =>$c_price + $vat + $ait,
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            return redirect()->to('newAirTicket')->with('successMessage', 'Data update successfully!!');
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
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
    public function deleteAirTicket(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('air_ticket_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'deleted' => 1,
                        ]);
                    if ($result) {
                        return redirect()->to('newAirTicket')->with('successMessage', 'Data deleted successfully!!');
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
    public function reissueAirTicket(Request $request){
        try{
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('status','Reissued')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('updated_at','desc')
                ->get();
            return view('airTicket.reissueAirTicket',['tickets' => $rows5,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPNRforReissue(Request $request){
        try{
            $rows = DB::table('air_ticket_invoice')
                ->where('agent_id',Session::get('user_id'))
                ->where('reservation_pnr',$request->pnr)
                ->orWhere('airline_pnr',$request->pnr)
                ->where('status','Issued')
                ->where('deleted',0)
                ->first();
            if($rows){
                return redirect()->to('editTicketPage?id='.$rows->id.'&reissue=1');
            }
            else{
                return back()->with('errorMessage', 'No data found. Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function refundAirTicket(Request $request){
        try{
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('status','Refunded')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('updated_at','desc')
                ->get();
            return view('airTicket.refundAirTicket',['tickets' => $rows5,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPNRforRefund(Request $request){
        try{
            $rows = DB::table('air_ticket_invoice')
                ->where('agent_id',Session::get('user_id'))
                ->where('reservation_pnr',$request->pnr)
                ->orWhere('airline_pnr',$request->pnr)
                ->where('status','Issued')
                ->where('deleted',0)
                ->first();
            if($rows){
                return redirect()->to('editTicketPage?id='.$rows->id.'&refund=1');
            }
            else{
                return back()->with('errorMessage', 'No data found. Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function cancelAirTicket(Request $request){
        try{
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('status','Cancelled')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('updated_at','desc')
                ->get();
            return view('airTicket.cancelAirTicket',['tickets' => $rows5,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPNRforCancel(Request $request){
        try{
            $rows = DB::table('air_ticket_invoice')
                ->where('agent_id',Session::get('user_id'))
                ->where('reservation_pnr',$request->pnr)
                ->orWhere('airline_pnr',$request->pnr)
                ->where('status','Issued')
                ->where('deleted',0)
                ->first();
            if($rows){
                return redirect()->to('editTicketPage?id='.$rows->id.'&cancel=1');
            }
            else{
                return back()->with('errorMessage', 'No data found. Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function viewTicket(Request $request){
        try{
            $rows1 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            $rows3 = DB::table('air_ticket_tnt')->first();
            return view('airTicket.viewTicket',['ticket' => $rows1,'company' => $rows2,'airTicketTnT' => $rows3,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printAirTicket(Request $request){
        try{
            $rows1 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            $rows3 = DB::table('air_ticket_tnt')->first();
            return view('airTicket.printAirTicket',['ticket' => $rows1,'company' => $rows2,'airTicketTnT' => $rows3,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function generateAirInvoicePDF(Request $request){
        try{
            //dd($request->id);
            $rows1 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('id',120)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('user_id'))
                ->first();
            $rows3 = DB::table('air_ticket_tnt')->first();
            $data = [
                'ticket' => $rows1,
                'company' => $rows2,
                'airTicketTnT' => $rows3,
            ];
           // return view('airTicket.airTicketInvoicePdf',['ticket' => $rows1,'company' => $rows2,'airTicketTnT' => $rows3,]);
            $pdf = PDF::loadView('/airTicket/airTicketInvoicePdf', $data);

            return $pdf->download('air_ticket_invoice.pdf');
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse
     */
    public function editPaymentStatus(Request $request){
        try{
            $rows1 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('airTicket.editPaymentStatus',['tickets' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateAirTicketPaymentStatus(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('air_ticket_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'payment_type' => $request->payment_type,
                            'due_amount' => $request->due,
                            'p_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newAirTicket')->with('successMessage', 'Payment Updated successfully!!');
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
    public function filterAirTicket(Request $request){
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
            $rows3 = DB::table('airport_details')
                ->get();
            $rows4 = DB::table('airlines_details')
                ->get();
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows5 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where(function ($query) use($request) {
                    if($request->pnr  != '')
                        $query->where('reservation_pnr', $request->pnr) ;
                    if($request->pnr  != '')
                        $query->orWhere('airline_pnr', $request->pnr) ;
                    if($request->from_issue_date  != '')
                        $query->where('issue_date', '>=', $request->from_issue_date);
                    if( $request->to_issue_date  != '')
                        $query->where('issue_date', '<=' , $request->to_issue_date);
                    if($request->c_status  != '' )
                        $query->where('status', '=', $request->c_status);
                    if($request->p_status  == '1' )
                        $query->where('due_amount', '=<', 0);
                    if($request->p_status  == '2' )
                        $query->where('due_amount', '>', 0);
                    })
                ->orderBy('id','desc')
                ->paginate(50);
            $rows6 = DB::table('payment_type')
                ->get();
            return view('airTicket.newAirTicket',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'airports' => $rows3,'airlines' => $rows4,'tickets' => $rows5,'payment_types' => $rows6]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getAirportCode(Request $request){
        try{
            $row = DB::table('airport_details')
                ->where('iata_codes',$request->from)
                ->first();
            return Response::json($row);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function salesDataGraph(Request $request){
        try{
            $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
            $last_day_this_month  = date('Y-m-t');
            $rows = DB::table('air_ticket_invoice')
                ->select(
                    DB::raw('issue_date as date, SUM(c_price) as cost ')
                )
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('issue_date', '>=', $first_day_this_month)
                ->where('issue_date', '<=' , $last_day_this_month)
                ->groupBy('issue_date')
                ->get();
            return json_encode($rows);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

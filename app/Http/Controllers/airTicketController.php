<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class airTicketController extends Controller
{
    public function newAirTicket(Request $request)
    {
        try {
            $agentId = Session::get('agent_id');

            if (!$agentId) {
                return redirect()->route('all-login')->with('errorMessage', 'Unauthorized access.');
            }

            $vendors = DB::table('vendors')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $employees = DB::table('employees')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $passengerss = DB::table('passengers')
                ->where('upload_by', $agentId)
                ->where('deleted', 0)
                ->orderByDesc('id')
                ->get();

            $airports = DB::table('airport_details')->get();

            $airlines = DB::table('airlines_details')->get();

            $tickets = DB::table('air_ticket_invoice')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->orderByDesc('id')
                ->paginate(10);

            $payment_types  = DB::table('payment_type')->get();

            return view('airTicket.newAirTicket', compact(
                'vendors',
                'employees',
                'passengerss',
                'airports',
                'airlines',
                'tickets',
                'payment_types'
            ));
        } catch (\Throwable $ex) {
            return back()->with('errorMessage', 'Something went wrong: ' . $ex->getMessage());
        }
    }

    public function createNewAirTicket(Request $request)
    {
        try {
            if (!$request->reservation_pnr || !$request->issue_date || !$request->vendor || !$request->issued_by || !$request->f_type || !$request->f_class || !$request->pax_number || !$request->a_price || !$request->c_price || !$request->payment_type) {
                return back()->with('errorMessage', 'Required fields are missing!');
            }

            $agentId = Session::get('agent_id');

            $ticketId = DB::table('air_ticket_invoice')->insertGetId([
                'agent_id'        => $agentId,
                'reservation_pnr' => $request->reservation_pnr,
                'airline_pnr'     => $request->airline_pnr,
                'issue_date'      => $request->issue_date,
                'vendor'          => $request->vendor,
                'issued_by'       => $request->issued_by,
                'f_type'          => $request->f_type,
                'f_class'         => $request->f_class,
                'a_from'          => json_encode($request->a_from ?? []),
                'a_to'            => json_encode($request->a_to ?? []),
                'd_time'          => json_encode($request->d_time ?? []),
                'a_time'          => json_encode($request->a_time ?? []),
                'f_number'        => json_encode($request->f_number ?? []),
                'airlines'        => json_encode($request->airlines ?? []),
                'pax_number'      => $request->pax_number,
                'pax_name'        => json_encode($request->pax_name ?? []),
                't_number'        => json_encode($request->t_number ?? []),
                'luggage'         => json_encode($request->luggage ?? []),
                'a_price'         => $request->a_price,
                'c_price'         => $request->c_price,
                'vat'             => $request->vat ?? 0,
                'ait'             => $request->ait ?? 0,
                'payment_type'    => $request->payment_type,
                'p_details'       => $request->p_details,
                'due_amount'      => $request->due ?? 0,
            ]);

            DB::table('accounts')->insert([
                'agent_id'         => $agentId,
                'invoice_id'       => $ticketId,
                'date'             => $request->issue_date,
                'transaction_type' => 'Debit',
                'source'           => 'Air Ticket',
                'purpose'          => 'Air Ticket --- ' . $request->reservation_pnr . ' --- ' . $request->airline_pnr,
                'buying_price'     => $request->a_price,
                'selling_price'    => $request->c_price + ($request->vat ?? 0) + ($request->ait ?? 0),
            ]);

            return redirect()->to('newAirTicket')->with('successMessage', 'New air ticket invoice created successfully!');
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', 'Database Error: ' . $ex->getMessage());
        } catch (\Exception $e) {
            return back()->with('errorMessage', 'Unexpected Error: ' . $e->getMessage());
        }
    }
    public function editTicketPage(Request $request)
    {
        try {
            $agentId = Session::get('agent_id');
            $ticketId = $request->id;

            if (!$ticketId) {
                return back()->with('errorMessage', 'Ticket ID is missing.');
            }

            // Fetch common resources
            $vendors = DB::table('vendors')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $employees = DB::table('employees')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $paymentTypes = DB::table('payment_type')->get();

            // Only fetch these if it's not a reissue
            $passengers = $airports = $airlines = collect();

            if ($request->reissue != 1) {
                $passengers = DB::table('passengers')
                    ->where('deleted', 0)
                    ->where('upload_by', $agentId)
                    ->orderByDesc('id')
                    ->get();

                $airports = DB::table('airport_details')->get();
                $airlines = DB::table('airlines_details')->get();
            }

            // Fetch ticket by ID
            $ticket = DB::table('air_ticket_invoice')
                ->where('deleted', 0)
                ->where('agent_id', $agentId)
                ->where('id', $ticketId)
                ->first();

            if (!$ticket) {
                return back()->with('errorMessage', 'Ticket not found.');
            }

            return view('airTicket.editAirTicket', [
                'vendors'      => $vendors,
                'employees'    => $employees,
                'passengers'   => $passengers,
                'airports'     => $airports,
                'airlines'     => $airlines,
                'tickets'      => $ticket,
                'payment_types'=> $paymentTypes,
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', 'Database error: ' . $ex->getMessage());
        } catch (\Exception $ex) {
            return back()->with('errorMessage', 'Unexpected error: ' . $ex->getMessage());
        }
    }

    public function updateNewAirTicket(Request $request)
    {
        try {
            if (!$request->id) {
                return back()->with('errorMessage', 'Missing invoice ID.');
            }

            $agentId = Session::get('agent_id');
            $invoice = DB::table('air_ticket_invoice')
                ->where('agent_id', $agentId)
                ->where('id', $request->id)
                ->where('deleted', 0)
                ->first();

            if (!$invoice) {
                return back()->with('errorMessage', 'Invoice not found.');
            }

            // Common fields
            $reservationPNR = $request->reservation_pnr;
            $airlinePNR     = $request->airline_pnr;
            $issueDate      = now()->format('Y-m-d');
            $aPrice         = $request->a_price;
            $cPrice         = $request->c_price;
            $vat            = $request->vat ?? 0;
            $ait            = $request->ait ?? 0;
            $paymentType    = $request->payment_type;
            $pDetails       = $request->p_details;
            $due            = $request->due ?? 0;

            $status = null;
            $redirectPath = 'newAirTicket';
            $sourceLabel = 'Air Ticket';

            if ($request->reissue == 1) {
                $status = 'Reissued';
                $redirectPath = 'reissueAirTicket';
                $sourceLabel = 'Reissue Ticket';
            } elseif ($request->refund == 1) {
                $status = 'Refunded';
                $redirectPath = 'refundAirTicket';
                $sourceLabel = 'Refund Ticket';
            } elseif ($request->cancel == 1) {
                $status = 'Cancelled';
                $redirectPath = 'cancelAirTicket';
                $sourceLabel = 'Cancel Ticket';
            }

            // If Reissue, Refund, or Cancel
            if ($status) {
                $newInvoiceId = DB::table('air_ticket_invoice')->insertGetId([
                    'agent_id'       => $agentId,
                    'reservation_pnr'=> $reservationPNR,
                    'airline_pnr'    => $airlinePNR,
                    'issue_date'     => $issueDate,
                    'vendor'         => $invoice->vendor,
                    'issued_by'      => $invoice->issued_by,
                    'f_type'         => $invoice->f_type,
                    'f_class'        => $invoice->f_class,
                    'a_from'         => $invoice->a_from,
                    'a_to'           => $invoice->a_to,
                    'd_time'         => $invoice->d_time,
                    'a_time'         => $invoice->a_time,
                    'f_number'       => $invoice->f_number,
                    'airlines'       => $invoice->airlines,
                    'pax_number'     => $invoice->pax_number,
                    'pax_name'       => $invoice->pax_name,
                    't_number'       => $invoice->t_number,
                    'luggage'        => $invoice->luggage,
                    'a_price'        => $aPrice,
                    'c_price'        => $cPrice,
                    'vat'            => $vat,
                    'ait'            => $ait,
                    'payment_type'   => $paymentType,
                    'p_details'      => $pDetails,
                    'due_amount'     => $due,
                    'status'         => $status,
                ]);

                DB::table('accounts')
                    ->where('invoice_id', $request->id)
                    ->where('agent_id', $agentId)
                    ->update([
                        'date'             => $issueDate,
                        'transaction_type' => 'Debit',
                        'source'           => $sourceLabel,
                        'purpose'          => "$sourceLabel --- $reservationPNR --- $airlinePNR",
                        'buying_price'     => $aPrice,
                        'selling_price'    => $cPrice + $vat + $ait,
                        'updated_at'       => now()
                    ]);

                return redirect()->to($redirectPath)->with('successMessage', 'Ticket updated successfully!');
            }

            // Normal Update
            DB::table('air_ticket_invoice')
                ->where('id', $request->id)
                ->update([
                    'reservation_pnr'=> $reservationPNR,
                    'airline_pnr'    => $airlinePNR,
                    'issue_date'     => $request->issue_date,
                    'vendor'         => $request->vendor,
                    'issued_by'      => $request->issued_by,
                    'f_type'         => $request->f_type,
                    'f_class'        => $request->f_class,
                    'a_from'         => json_encode($request->a_from),
                    'a_to'           => json_encode($request->a_to),
                    'd_time'         => json_encode($request->d_time),
                    'a_time'         => json_encode($request->a_time),
                    'f_number'       => json_encode($request->f_number),
                    'airlines'       => json_encode($request->airlines),
                    'a_price'        => $aPrice,
                    'c_price'        => $cPrice,
                    'vat'            => $vat,
                    'ait'            => $ait,
                    'payment_type'   => $paymentType,
                    'p_details'      => $pDetails,
                    'due_amount'     => $due,
                    'updated_at'     => now()
                ]);

            DB::table('accounts')
                ->where('invoice_id', $request->id)
                ->where('agent_id', $agentId)
                ->update([
                    'buying_price'  => $aPrice,
                    'selling_price' => $cPrice + $vat + $ait,
                    'updated_at'    => now()
                ]);

            return redirect()->to($redirectPath)->with('successMessage', 'Ticket updated successfully!');
        } catch (\Exception $ex) {
            return back()->with('errorMessage', 'Error: ' . $ex->getMessage());
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
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('updated_at','desc')
                ->paginate(30);
            return view('airTicket.reissueAirTicket',['tickets' => $rows5,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPNRforReissue(Request $request){
        try{
            $rows = DB::table('air_ticket_invoice')
                ->where('agent_id',Session::get('agent_id'))
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
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('updated_at','desc')
                ->paginate(30);
            return view('airTicket.refundAirTicket',['tickets' => $rows5,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchPNRforRefund(Request $request){
        try{
            $rows = DB::table('air_ticket_invoice')
                ->where('agent_id',Session::get('agent_id'))
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
                ->where('agent_id',Session::get('agent_id'))
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
                ->where('agent_id',Session::get('agent_id'))
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
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
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
                ->where('agent_id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows3 = DB::table('air_ticket_tnt')->first();
            return view('airTicket.printAirTicket',['ticket' => $rows1,'company' => $rows2,'airTicketTnT' => $rows3,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function generateAirInvoicePDF(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|integer|exists:air_ticket_invoice,id',
            ]);

            $agentId = Session::get('agent_id');

            $rows1 = DB::table('air_ticket_invoice')
                ->where('deleted', 0)
                ->where('id', $request->id)
                ->where('agent_id', $agentId)
                ->first();

            $rows2 = DB::table('users')->where('id', $agentId)->first();
            $rows3 = DB::table('air_ticket_tnt')->first();

            if (!$rows1 || !$rows2 || !$rows3) {
                return back()->with('errorMessage', 'Required data not found.');
            }

            $data = [
                'ticket' => $rows1,
                'company' => $rows2,
                'airTicketTnT' => $rows3,
            ];

            $pdf = PDF::loadView('airTicket.airTicketInvoicePdf', $data);
            return $pdf->download('air_ticket_invoice.pdf');
        } catch (\Illuminate\Database\QueryException $ex) {
            \Log::error($ex->getMessage());
            return back()->with('errorMessage', 'Database error occurred.');
        } catch (\Exception $ex) {
            \Log::error($ex->getMessage());
            return back()->with('errorMessage', 'An unexpected error occurred.');
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
                ->where('agent_id',Session::get('agent_id'))
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
    public function filterAirTicket(Request $request)
    {
        try {
            $agentId = Session::get('agent_id');

            $vendors = DB::table('vendors')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $employees = DB::table('employees')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->get();

            $passengers = DB::table('passengers')
                ->where('upload_by', $agentId)
                ->where('deleted', 0)
                ->orderByDesc('id')
                ->get();

            $airports = DB::table('airport_details')->get();
            $airlines = DB::table('airlines_details')->get();
            $paymentTypes = DB::table('payment_type')->get();

            // Filtered air ticket invoices
            $tickets = DB::table('air_ticket_invoice')
                ->where('agent_id', $agentId)
                ->where('deleted', 0)
                ->when($request->pnr, function ($query, $pnr) {
                    $query->where(function ($q) use ($pnr) {
                        $q->where('reservation_pnr', $pnr)
                            ->orWhere('airline_pnr', $pnr);
                    });
                })
                ->when($request->from_issue_date, fn($query, $date) => $query->where('issue_date', '>=', $date))
                ->when($request->to_issue_date, fn($query, $date) => $query->where('issue_date', '<=', $date))
                ->when(!is_null($request->c_status), fn($query) => $query->where('status', $request->c_status))
                ->when($request->p_status === '1', fn($query) => $query->where('due_amount', '<=', 0))
                ->when($request->p_status === '2', fn($query) => $query->where('due_amount', '>', 0))
                ->orderByDesc('id')
                ->paginate(10)
                ->appends($request->all());

            return view('airTicket.newAirTicket', [
                'vendors' => $vendors,
                'employees' => $employees,
                'passengerss' => $passengers,
                'airports' => $airports,
                'airlines' => $airlines,
                'tickets' => $tickets,
                'payment_types' => $paymentTypes
            ]);

        } catch (\Illuminate\Database\QueryException $ex) {
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
            $startDate = $request->input('start_date') ?? date('Y-m-01');
            $endDate   = $request->input('end_date') ?? date('Y-m-t');
            $agentId   = Session::get('agent_id');

            $queries = [
                ['table' => 'air_ticket_invoice', 'date' => 'issue_date', 'cost' => 'c_price', 'deleted' => true],
                ['table' => 'visa_invoice',       'date' => 'date',       'cost' => 'v_c_price', 'deleted' => true],
                ['table' => 'package_details',    'date' => 'date',       'cost' => 'p_c_details', 'deleted' => false],
                ['table' => 'hotel_invoice',      'date' => 'b_date',     'cost' => 'c_price', 'deleted' => false],
                ['table' => 'umrah_invoice',      'date' => 'date',       'cost' => 'p_c_details', 'deleted' => false],
            ];

            $combined = collect();

            foreach ($queries as $q) {
                $query = DB::table($q['table'])
                    ->select(DB::raw("{$q['date']} as date, SUM({$q['cost']}) as cost"))
                    ->whereBetween($q['date'], [$startDate, $endDate])
                    ->where('agent_id', $agentId)
                    ->groupBy($q['date']);

                if ($q['deleted'] && Schema::hasColumn($q['table'], 'deleted')) {
                    $query->where('deleted', 0);
                }

                $combined = $combined->merge($query->get());
            }

            // Merge by date
            $grouped = $combined->groupBy('date')->map(function ($items) {
                return [
                    'date' => $items[0]->date,
                    'cost' => $items->sum('cost'),
                ];
            })->values();

            return response()->json($grouped);


        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}

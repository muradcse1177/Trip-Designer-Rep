<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class visaController extends Controller
{
    public function domainCheck(){
        try{
            //$c_domain = $_SERVER['SERVER_NAME'];
            $c_domain = 'tripdesigner.net';
            $rows = DB::table('domain')->where('name',$c_domain)->first();
            $row['domain'] = @$rows->name;
            $row['agent_id'] = @$rows->agent_id;
            return @$row;
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function newVisaProcess(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('visa_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('date','desc')
                ->paginate(20);
            return view('visa.newVisaProcess',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visas' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewVisa(Request $request)
    {
        try {
            // Insert into visa_invoice table
            $inserted = DB::table('visa_invoice')->insert([
                'agent_id'      => Session::get('agent_id'),
                'visa_country'  => $request->c_name,
                'date'          => $request->date,
                'vendor'        => $request->vendor,
                'issued_by'     => $request->issued_by,
                'v_details'     => $request->s_details,
                'pax_number'    => $request->pax_number,
                'p_details'     => json_encode($request->pax_name),
                'pass_number'   => json_encode($request->pass_number),
                'v_a_price'     => $request->a_price,
                'v_c_price'     => $request->c_price,
                'v_vat'         => $request->vat,
                'v_ait'         => $request->ait,
                'v_p_type'      => $request->payment_type,
                'v_due'         => $request->due,
                'v_p_details'   => $request->p_details,
                'status'        => $request->status,
            ]);

            // If visa invoice inserted successfully
            if ($inserted) {
                $invoiceId = DB::getPdo()->lastInsertId();

                // Insert into accounts table
                DB::table('accounts')->insert([
                    'agent_id'        => Session::get('agent_id'),
                    'invoice_id'      => $invoiceId,
                    'date'            => $request->date,
                    'transaction_type'=> 'Debit',
                    'source'          => 'Visa',
                    'purpose'         => 'Visa Processing --- ' . $request->c_name,
                    'buying_price'    => $request->a_price,
                    'selling_price'   => $request->c_price + $request->vat + $request->ait,
                ]);

                return redirect()->to('newVisaProcess')->with('successMessage', 'New visa added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editVisaPage(Request $request){
        try{
            $rows = DB::table('vendors')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows1 = DB::table('employees')
                ->where('agent_id',Session::get('agent_id'))
                ->where('deleted',0)
                ->get();
            $rows2 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('payment_type')
                ->get();
            $rows4 = DB::table('country')
                ->get();
            $rows5 = DB::table('visa_invoice')->where('id',$request->id)->first();
            return view('visa.editVisaPage',['vendors' => $rows,'employees' => $rows1,'passengers' => $rows2,'payment_types' => $rows3,'countries' => $rows4,'visa' => $rows5]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editVisa(Request $request)
    {
        try {
            if (!$request || !$request->id) {
                return back()->with('errorMessage', 'Invalid request!');
            }

            // Update visa_invoice
            $updated = DB::table('visa_invoice')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->update([
                    'visa_country'  => $request->c_name,
                    'date'          => $request->date,
                    'vendor'        => $request->vendor,
                    'issued_by'     => $request->issued_by,
                    'v_details'     => $request->s_details,
                    'pax_number'    => $request->pax_number,
                    'p_details'     => json_encode($request->pax_name),
                    'pass_number'   => json_encode($request->pass_number),
                    'v_a_price'     => $request->a_price,
                    'v_c_price'     => $request->c_price,
                    'v_vat'         => $request->vat,
                    'v_ait'         => $request->ait,
                    'v_p_type'      => $request->payment_type,
                    'v_due'         => $request->due,
                    'v_p_details'   => $request->p_details,
                    'status'        => $request->status,
                ]);

            if ($updated) {
                $visa = DB::table('visa_invoice')
                    ->join('accounts', function ($join) {
                        $join->on('visa_invoice.id', '=', 'accounts.invoice_id')
                        ->where('accounts.source', '=', 'Visa');
                    })
                    ->where('visa_invoice.id', $request->id)
                    ->first();
                // Update accounts entry linked to this visa_invoice
                DB::table('accounts')
                    ->where('agent_id',Session::get('agent_id'))
                    ->where('invoice_id', $visa->invoice_id)
                    ->where('source', 'Visa')
                    ->update([
                        'date'           => $request->date,
                        'purpose'        => 'Visa Processing --- ' . $request->c_name,
                        'buying_price'   => $request->a_price,
                        'selling_price'  => $request->c_price + $request->vat + $request->ait,
                    ]);

                return redirect()->to('newVisaProcess')->with('successMessage', 'Visa updated successfully!');
            } else {
                return back()->with('errorMessage', 'No changes were made. Please try again!');
            }
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function deleteVisa(Request $request)
    {
        try {
            if (!$request || !$request->id) {
                return back()->with('errorMessage', 'Invalid request!');
            }
            $visa = DB::table('visa_invoice')
                ->leftJoin('accounts', function ($join) {
                    $join->on('visa_invoice.id', '=', 'accounts.invoice_id')
                        ->where('accounts.source', '=', 'Visa');
                })
                ->where('visa_invoice.id', $request->id)
                ->first();
//             Soft delete visa_invoice
            $deleted = DB::table('visa_invoice')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id', $request->id)
                ->delete();

            if ($deleted) {
                // Hard delete related account entry
                DB::table('accounts')
                    ->where('agent_id',Session::get('agent_id'))
                    ->where('invoice_id', $visa->invoice_id)
                    ->where('source', 'Visa')
                    ->delete();
                return redirect()->to('newVisaProcess')->with('successMessage', 'Visa data deleted successfully!');
            } else {
                return back()->with('errorMessage', 'Please try again!');
            }

        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function viewVisa(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('visa_invoice')
                ->where('id',$request->id)
                ->first();
            return view('visa.viewVisa',['company' => $rows1,'visa' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printVisaInvoice(Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('visa_invoice')
                ->where('id',$request->id)
                ->first();
            return view('visa.printVisaInvoice',['company' => $rows1,'visa' => $rows2,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editVisaPaymentStatus (Request $request){
        try{
            $rows1 = DB::table('visa_invoice')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            $rows2 = DB::table('payment_type')
                ->get();
            return view('visa.editPaymentStatus',['visa' => $rows1,'payment_types' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateVisaPaymentStatus (Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('visa_invoice')
                        ->where('id', $request->id)
                        ->update([
                            'v_p_type' => $request->payment_type,
                            'v_due' => $request->due,
                            'v_p_details' => $request->p_details,
                        ]);
                    if ($result) {
                        return redirect()->to('newVisaProcess')->with('successMessage', 'Payment Updated successfully!!');
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

    public function filterVisa(Request $request)
    {
        $agentId = Session::get('agent_id');

        // Base query for visa_invoice
        $query = DB::table('visa_invoice')
            ->where('deleted', 0)
            ->where('agent_id', $agentId)
            ->orderBy('updated_at', 'desc');

        // Filter: Country Name
        if ($request->filled('c_name')) {
            $query->where('visa_country', $request->c_name);
        }

        // Filter: From Date
        if ($request->filled('from_date')) {
            $query->whereDate('date', '>=', $request->from_date);
        }

        // Filter: To Date
        if ($request->filled('to_date')) {
            $query->whereDate('date', '<=', $request->to_date);
        }

        // Filter: Visa Status (not payment status)
        if ($request->filled('visa_status')) {
            $query->where('status', $request->visa_status);
        }

        // Filter: Payment Status
        if ($request->payment_status === 'Paid') {
            $query->where('v_due', '=', 0);
        } elseif ($request->payment_status === 'Due') {
            $query->where('v_due', '>', 0);
        }

        // Paginated results
        $visas = $query->orderBy('date', 'desc')->paginate(10)->appends($request->all());;

        // Related data for dropdowns or views
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
            ->orderBy('id', 'desc')
            ->get();

        $payment_types = DB::table('payment_type')->get();

        $countries = DB::table('country')->get();

        // Return view with data
        return view('visa.newVisaProcess', compact(
            'vendors', 'employees', 'passengers',
            'payment_types', 'countries', 'visas'
        ));
    }
    public  function searchVisaB2b(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->where('country',$request->country)->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->get();
        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,
                'type' => $request->type,
            ]);
    }

    public  function searchManpowerB2b(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->where('country',$request->country)->get();
        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,
                'type' => $request->type,
            ]);
    }
    public  function searchHajjUmrahB2b(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->get();
        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->where('type',$request->h_type)->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,
                'type' => $request->type,
            ]);
    }
    public  function serviceB2b(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows6 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->get();
        $rows7 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->where('name',$request->name)->get();
        return view('main-dashboard',
            [
                't_country' => $rows1,'t_package' => $rows2,
                'visas' => $rows3, 'v_country' => $rows4,
                'permits' => $rows6,'m_country' => $rows5,
                'u_package' => $rows7,'services' => $rows8,
                'type' => $request->type,
            ]);
    }
    public  function tourPackageB2bBySlug(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows2 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->where('slug',$request->slug)->first();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('tourPackage.tour-package-details-b2b',
            [
                't_country' => $rows1,
                'package' => $rows2,
                'v_country' => $rows4,
                'm_country' => $rows5,
                'services' => $rows8,
                'type' => 'f_tour',
            ]);
    }
    public  function visaB2bBySlug(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->where('slug',$request->slug)->first();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('visa.visa-details-b2b',
            [
                't_country' => $rows1,
                'visa' => $rows3,
                'v_country' => $rows4,
                'm_country' => $rows5,
                'services' => $rows8,
                'type' => 'f_visa',
            ]);
    }
    public  function manpowerB2bBySlug(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->where('slug',$request->slug)->first();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('manpower.work-permit-details-b2b',
            [
                't_country' => $rows1,
                'permit' => $rows3,
                'v_country' => $rows4,
                'm_country' => $rows5,
                'services' => $rows8,
                'type' => 'f_permit',
            ]);
    }
    public  function hajjUmrahB2bBySlug(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows3 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->where('slug',$request->slug)->first();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('hajj-umrah.hajj-umrah-details-b2b',
            [
                't_country' => $rows1,
                'package' => $rows3,
                'v_country' => $rows4,
                'm_country' => $rows5,
                'services' => $rows8,
                'type' => 'f_umrah',
            ]);
    }
    public  function serviceB2bBySlug(Request $request){
        $domain =$this->domainCheck();
        $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
        $rows4 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();
        $rows5 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
        $rows8 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->where('slug',$request->slug)->first();
        $rows3 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();
        return view('service.service-details-b2b',
            [
                't_country' => $rows1,
                'v_country' => $rows4,
                'm_country' => $rows5,
                'services' => $rows3,
                'visa' => $rows8,
                'type' => 'f_service',
            ]);
    }
    public  function bookVisaPackagePageB2b(Request $request){
        if($request->adult >= 1 && $request->child >= 0){
            $rows4 = DB::table('passengers')
                ->where('deleted',0)
                ->where('upload_by',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows1 = DB::table('b2c_visa')
                ->where('agent_id',Session::get('agent_id'))
                ->where('slug',$request->slug)
                ->first();
            if($rows1)
                return view('visa.bookVisaPackagePageB2b',['package' => $rows1,'passengers' => $rows4,'adult' => $request->adult,'child' =>  $request->child]);
            else
                return back()->with('errorMessage', 'Bad Request!!');
        }
        else{
            return back()->with('errorMessage', 'Adult must greater than 1 PAX!!');
        }
    }
    public  function bookVisaPackageB2b(Request $request){
        try {
            if ($request) {
                $package = DB::table('b2c_visa')->where('agent_id',Session::get('agent_id'))->where('id',$request->id)->first();
                $total = $package->a_price * $request->adult + $package->c_price * $request->child;
                $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
                $emp = DB::table('employees')->where('id', Session::get('user_id'))->first();
                $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
                if($total > $agent->agency_amount){
                    return back()->with('errorMessage', 'Please recharge your account to book this Visa!!');
                }
                //dd($request);
                if($agent->agency_amount > $total){
                    $result = DB::table('users')
                        ->where('id', Session::get('agent_id'))
                        ->update([
                            'agency_amount' => $agent->agency_amount - $total,
                        ]);
                    if($result){
                        $invoice = DB::table('visa_invoice')->insert([
                            'agent_id' => Session::get('agent_id'),
                            'visa_country' => $package->country,
                            'date' => date('Y-m-d'),
                            'vendor' => 'Trip Designer',
                            'issued_by' => $emp->name,
                            'v_details' => $package->title,
                            'pax_number' => $request->adult + $request->child,
                            'p_details' => json_encode($request->name),
                            'pass_number' => json_encode($request->name),
                            'v_a_price' => $package->a_price,
                            'v_c_price' => $package->c_price,
                            'v_vat' => 0,
                            'v_ait' => 0,
                            'v_p_type' => 'Bank Transfer',
                            'v_due' => 0,
                            'v_p_details' => 'Balanced from wallet - '.$total .'BDT',
                            'status' => 'Received',
                        ]);
                        if ($invoice) {
                            $result1 = DB::table('accounts')->insert([
                                'agent_id' => Session::get('agent_id'),
                                'invoice_id' => $num,
                                'date' => date('Y-m-d'),
                                'transaction_type' => 'Debit',
                                'head' => 'Visa',
                                'source' => 'Visa B2B',
                                'purpose' => 'Visa B2B' . '---' . $package->title,
                                'buying_price' => $total,
                                'selling_price' => $total,
                            ]);
                            if ($result1) {
                                $domain =$this->domainCheck();
                                if($domain['agent_id']) {
                                    //dd($request);
                                    $result = DB::table('order_request')->insert([
                                        'agent_id' => $domain['agent_id'],
                                        'r_ref' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child,
                                        'view' => 'https://tripdesigner.net/visa-b2b/'.$package->slug,
                                        'date' => date('Y-m-d'),
                                        'r_type' => "Visa",
                                        'status' => 'Received',
                                        'order_type' => 'B2B',
                                        'adult' => $request->adult,
                                        'child' => $request->child,
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child),
                                    ]);
                                    $to = 'tripdesigner.xyz@gmail.com';
                                    $email_cus = [$agent->company_email];
                                    $email_admin = [$to];
                                    $data = [
                                        'tracking' => $num,
                                        'name' => $agent->company_name,
                                        'email' => $agent->company_email,
                                        'phone' => $agent->company_pnone,
                                        'person' => 'Adult:'.$request->adult .'Child:'. $request->child,
                                        'r_type' => "Visa",
                                        'status' => 'Received',
                                        'remarks' =>json_encode('Adult:'.$request->adult .'Child:'. $request->child),
                                    ];
                                    if ($result) {
                                        Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                                            $message->subject("Trip Designer: Order Request Confirmation");
                                            $message->from('sales@tripdesigner.net', 'Visa Order');
                                            $message->to($email_cus);
                                        });
                                        Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                                            $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                                            $message->from('sales@tripdesigner.net', 'Visa Order');
                                            $message->to($email_admin);
                                        });
                                        return redirect()->to('newVisaProcess')->with('successMessage', 'Visa Ordered successfully!!');

                                    } else {
                                        return back()->with('errorMessage', 'Please try again!!');
                                    }
                                }
                                else{
                                    return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
                                }

                            } else {
                                return back()->with('errorMessage', 'Please try again!!');
                            }
                        } else {
                            return back()->with('errorMessage', 'Please try again!!');
                        }
                    }
                }else{
                    return back()->with('errorMessage', 'Please recharge your account to book this tour package!!');
                }

            } else {
                return back()->with('errorMessage', 'Please fill up the form!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function downloadB2bVisaPackage(Request $request){
        try{
            $package = DB::table('b2c_visa')->where('agent_id',Session::get('agent_id'))->where('slug',$request->slug)->first();
            $agent = DB::table('users')->where('id', Session::get('agent_id'))->first();
            $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
            $result = DB::table('order_request')->insert([
                'agent_id' => Session::get('agent_id'),
                'r_ref' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' => $request->adult.' adults and '.$request->child.' child',
                'view' => 'https://tripdesigner.net/visa-b2b/'.$package->slug,
                'date' => date('Y-m-d'),
                'r_type' => 'Visa',
                'status' => 'Requested',
                'order_type' => 'B2B',
                'adult' => $request->adult,
                'child' => $request->child,
                'remarks' => json_encode('Need Visa for '.$request->adult.' adults and '.$request->child.' child'),
            ]);
            $to = 'tripdesigner.xyz@gmail.com';
            $email_cus = [$agent->company_email];
            $email_admin = [$to];
            $data = [
                'tracking' => $num,
                'name' => $agent->company_name,
                'email' => $agent->company_email,
                'phone' => $agent->phone_code.$agent->company_pnone,
                'person' =>$request->adult.' adults and '.$request->child.' child',
                'r_type' => 'Visa',
                'status' => 'Requested',
                'remarks' => json_encode('Need Visa for '.$request->adult.' adults and '.$request->child.' child'),
            ];
            if ($result) {
                Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                    $message->subject("Trip Designer: Visa Order Request");
                    $message->from('sales@tripdesigner.net', 'Visa Order');
                    $message->to($email_cus);
                });
                Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                    $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                    $message->from('sales@tripdesigner.net', 'Visa Order');
                    $message->to($email_admin);
                });
                return redirect()->to('orderReceiver')->with('successMessage', 'Visa ordered request sent successfully!!');

            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function prinB2bVisa (Request $request){
        try{
            $rows1 = DB::table('users')
                ->where('id',Session::get('agent_id'))
                ->first();
            $rows2 = DB::table('b2c_visa')
                ->where('slug',$request->slug)
                ->first();
            return view('visa.printB2bVisa',['company' => $rows1,'package' => $rows2,'adult' => $request->adult,'child' => $request->child,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function downloadInvoice(Request $request)
    {
        $visaId = $request->id;

        // Visa Info
        $visa = DB::table('visa_invoice')->where('id', $visaId)->first();

        if (!$visa) {
            abort(404, 'Visa Invoice Not Found');
        }

        // Company Info
        $company =  DB::table('users')
            ->where('id',Session::get('agent_id'))
            ->first();

        // Decode passenger IDs and get passenger data
        $passenger_ids = json_decode($visa->p_details);
        $passengers = DB::table('passengers')
            ->whereIn('id', $passenger_ids)
            ->where('upload_by', Session::get('agent_id'))
            ->get();

        // Load PDF view
        $pdf = Pdf::loadView('visa.visa_pdf', [
            'visa' => $visa,
            'company' => $company,
            'passengers' => $passengers
        ]);

        return $pdf->download('Visa-Invoice-TV-' . $visa->id . '.pdf');
    }

}

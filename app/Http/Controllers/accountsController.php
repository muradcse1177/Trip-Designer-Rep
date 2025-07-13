<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class accountsController extends Controller
{
    public function transactions(Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('date','desc')
                ->paginate(20);
            return view('accounts.transactions',['transactions' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function officeExpenses(Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('agent_id',Session::get('agent_id'))
                ->where('source','Office Accounts')
                ->orderBy('date','desc')
                ->paginate(20);
            $rows2 = DB::table('accounts_head')
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            return view('accounts.officeExpenses',['transactions' => $rows1,'heads' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function filterOfficeExpense(Request $request)
    {
        try {
            // Load head types for dropdown
            $heads = DB::table('accounts_head')
                ->where('agent_id', Session::get('agent_id'))
                ->orderBy('id', 'desc')
                ->get();

            // Build base query
            $query = DB::table('accounts')
                ->where('agent_id', Session::get('agent_id'))
                ->where('source', 'Office Accounts');

            // Apply filters
            if (!empty($request->acc_type)) {
                $query->where('transaction_type', $request->acc_type);
            }

            if (!empty($request->head)) {
                $query->where('head', $request->head);
            }

            if (!empty($request->from_issue_date) && !empty($request->to_issue_date)) {
                $query->whereBetween('date', [$request->from_issue_date, $request->to_issue_date]);
            } elseif (!empty($request->from_issue_date)) {
                $query->whereDate('date', $request->from_issue_date);
            } elseif (!empty($request->to_issue_date)) {
                $query->whereDate('date', $request->to_issue_date);
            }

            // If download requested, fetch all data (no pagination)
            if ($request->has('download')) {
                $downloadData = $query->orderBy('date', 'desc')->get();
                $company = DB::table('users')->where('id', Session::get('agent_id'))->first();
                $pdf = PDF::loadView('accounts.office_expense_report', [
                    'transactions' => $downloadData,
                    'from' => $request->from_issue_date,
                    'to' => $request->to_issue_date,
                    'company' => $company,
                ]);

                return $pdf->download('office_expense_report.pdf');
            }

            // Else, paginate for normal view
            $transactions = $query->orderBy('date', 'desc')->paginate(20);

            return view('accounts.officeExpenses', [
                'transactions' => $transactions,
                'heads' => $heads
            ]);
        } catch (\Illuminate\Database\QueryException $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function addOfficeExpense(Request $request){
        try{
            $type = $request->type;
            if($type == 'Debit'){
                $debit = $request->amount;
                $credit = 0;
            }
            if($type == 'Credit'){
                $debit = 0;
                $credit = $request->amount;
            }
            $invoice = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,5);
            $result = DB::table('accounts')->insert([
                'invoice_id' => $invoice,
                'date' => $request->date,
                'head' => $request->head,
                'agent_id' => Session::get('agent_id'),
                'transaction_type' => $request->type,
                'source' => 'Office Accounts',
                'purpose' => $request->purpose,
                'buying_price' => $debit,
                'selling_price' => $credit,
                'status' => 'Approved',
            ]);
            if ($result) {
                return redirect()->to('officeExpenses')->with('successMessage', 'Office Income/Expense added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function bankAccounts(Request $request){
        try{
            $rows1 = DB::table('bank_accounts')
                ->where('agent_id',Session::get('agent_id'))
                ->orderBy('id','desc')
                ->get();
            $rows2 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->where('due_amount','>',0)
                ->orderBy('id','desc')
                ->get();
            $rows3 = DB::table('visa_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->where('v_due','>',0)
                ->orderBy('id','desc')
                ->get();
            $rows4 = DB::table('package_details')
                ->where('deleted',0)
                ->where('agent_id',Session::get('agent_id'))
                ->where('due','>',0)
                ->orderBy('id','desc')
                ->get();

            return view('accounts.bankAccounts',['accounts' => $rows1,'tickets' => $rows2, 'visas' => $rows3, 'packages' => $rows4]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function bankAccountsSuper(Request $request){
        try{
            $domain = app('App\Http\Controllers\homeController')->domainCheck();
            $rows1 = DB::table('bank_account_super')
                ->where('agent_id',$domain['agent_id'])
                ->orderBy('id','asc')
                ->get();
            return view('accounts.bank-accounts-super',['accounts' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addBankAccounts(Request $request){
        try{

            $result = DB::table('bank_accounts')->insert([
                'name' => $request->name,
                'agent_id' => Session::get('agent_id'),
                'amount' => $request->amount,
            ]);
            if ($result) {
                return redirect()->to('bankAccounts')->with('successMessage', 'Bank account  added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addBankAccountsSuper(Request $request){
        try{

            $fileName = time() . '.' . $request->logo->extension();
            $request->logo->move(public_path('images/upload/company/'), $fileName);
            $photo = 'public/images/upload/company/'.$fileName;

            $result = DB::table('bank_account_super')->insert([
                'name' => $request->name,
                'agent_id' => Session::get('agent_id'),
                'branch' => $request->branch,
                'acc_name' => $request->acc_name,
                'acc_number' => $request->acc_number,
                'routing' => $request->routing,
                'method' => $request->methods,
                'logo' => $photo,
            ]);
            if ($result) {
                return redirect()->to('bank-accounts')->with('successMessage', 'Bank account  added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editBankAccount(Request $request){
        try{
            $rows1 = DB::table('bank_accounts')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            return view('accounts.editBankAccountPage',['account' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editBankAccountSuperPage(Request $request){
        try{
            $rows1 = DB::table('bank_account_super')
                ->where('agent_id',Session::get('agent_id'))
                ->where('id',$request->id)
                ->first();
            return view('accounts.editBankAccountSuper',['account' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateBankAccountsSuper(Request $request){
        try {
            if ($request) {
                $rows = DB::table('bank_account_super')->where('agent_id', Session::get('agent_id'))->where('id', $request->id)->first();
                if ($request->logo) {
                    $fileName = time() . '.' . $request->logo->extension();
                    $request->logo->move(public_path('images/upload/company/'), $fileName);
                    $logo = 'public/images/upload/company/'. $fileName;
                } else {
                    $logo = $rows->logo;
                }
                $result = DB::table('bank_account_super')
                    ->where('id', $rows->id)
                    ->where('agent_id', Session::get('agent_id'))
                    ->update([
                        'name' => $request->name,
                        'agent_id' => Session::get('agent_id'),
                        'branch' => $request->branch,
                        'acc_name' => $request->acc_name,
                        'acc_number' => $request->acc_number,
                        'routing' => $request->routing,
                        'method' => $request->methods,
                        'logo' => $logo,
                    ]);
                if ($result) {
                    return redirect()->to('bank-accounts')->with('successMessage', 'Bank account updated successfully!!');
                } else {
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateBankAccountsAmount(Request $request){
        try{
            $result =DB::table('bank_accounts')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->update([
                    'amount' => $request->amount,
                ]);
            if ($result) {
                return redirect()->to('bankAccounts')->with('successMessage', 'Data update successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteBankAccount(Request $request){
        try{
            $result =DB::table('bank_accounts')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->delete();
            if ($result) {
                return redirect()->to('bankAccounts')->with('successMessage', 'Data update successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteBankAccountSuper(Request $request){
        try{
            $result =DB::table('bank_account_super')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->delete();
            if ($result) {
                return redirect()->to('bank-accounts')->with('successMessage', 'Bank account deleted successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function filterTransaction(Request $request)
    {
        try {
            $query = DB::table('accounts')
                ->where('status', 'Approved')
                ->where('agent_id', Session::get('agent_id'));

            // Filters (optional)
            if ($request->filled('from_issue_date')) {
                $query->whereDate('date', '>=', $request->from_issue_date);
            }

            if ($request->filled('to_issue_date')) {
                $query->whereDate('date', '<=', $request->to_issue_date);
            }

            if ($request->filled('acc_type') && $request->acc_type !== 'All') {
                $query->where('source', $request->acc_type);
            }

            // If Download PDF requested
            if ($request->has('download')) {
                $data = $query->orderBy('date', 'desc')->get();
                $company = DB::table('users')->where('id', Session::get('agent_id'))->first(); // if needed

                $pdf = PDF::loadView('accounts.pdf_ledger_report', [
                    'transactions' => $data,
                    'from' => $request->from_issue_date,
                    'to' => $request->to_issue_date,
                    'company' => $company,
                ]);

                return $pdf->download('transactions_report.pdf');
            }

            // Otherwise return normal view
            $transactions = $query->orderBy('date', 'desc')->paginate(20);

            return view('accounts.transactions', compact('transactions'));

        } catch (\Exception $ex) {
            return back()->with('errorMessage', $ex->getMessage());
        }
    }


    public function generalInvoice (Request $request){
        try{
            $rows1 = DB::table('g_invoice')->where('agent_id',Session::get('agent_id'))->orderBy('id','desc')->get();
            return view('invoice.gInvoice',['invoices' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printGInvoice (Request $request){
        try{
            $rows1 = DB::table('g_invoice')->where('agent_id',Session::get('agent_id'))->where('id', $request->id)->first();
            return view('invoice.printGInvoice',['invoice' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function insertGInvoice (Request $request){
        try{
            $invoice = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,5);
            $result = DB::table('g_invoice')->insert([
                'invoice_id' => $invoice,
                'agent_id' => Session::get('agent_id'),
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'date' => $request->date,
                'p_method' => $request->p_method,
                'acc_number' => $request->acc_number,
                'due_amount' => $request->due_amount,
                'purpose' => json_encode($request->purpose),
                'reference' => json_encode($request->reference),
                'amount' => json_encode($request->amount),
                'pax_number' => json_encode($request->pax_number),
            ]);
            if ($result) {
                return redirect()->to('g_invoice')->with('successMessage', 'New Invoice created successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteGInvoice(Request $request){
        try{
            $result =DB::table('g_invoice')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->delete();
            if ($result) {
                return redirect()->to('g_invoice')->with('successMessage', 'Data Delete successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function paymentRequest (Request $request){
        try{
            $domain = app('App\Http\Controllers\homeController')->domainCheck();
            $rows1 = DB::table('bank_account_super')->where('agent_id',$domain['agent_id'])->orderBy('id','asc')->get();
            $rows2 = DB::table('payment_history')->where('agent_id',Session::get('agent_id'))->orderBy('id','desc')->get();
            return view('accounts.payment-request',['banks' => $rows1,'accounts' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addManualPayment (Request $request){
        try{
            $invoice = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,8);
            $result = DB::table('payment_history')->insert([
                'dep_ref_number' => $invoice,
                'agent_id' => Session::get('agent_id'),
                'deposit_time' =>date('Y-m-d h:i:s'),
                'p_type' => $request->p_type,
                'type' => 'Manual',
                'dep_bank' => $request->dep_bank,
                'amount' => $request->amount,
                'date' => $request->date,
                'from_bank' => $request->from_bank,
                'from_acc_number' => $request->from_acc_number,
                'ref' => $request->ref,
            ]);
            if ($result) {
                return redirect()->to('payment-request')->with('successMessage', 'Payment request submitted successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editManualPaymentPage(Request $request){
        try{
            $rows1 = DB::table('payment_history')
                ->where('id',$request->id)
                ->first();
            return view('accounts.editManualPaymentPage',['account' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function updateManualPayment(Request $request){
        try{
            $rows2 = DB::table('payment_history')
                ->where('id',$request->id)
                ->first();
            if($rows2->status == "Approved"){
                return back()->with('errorMessage', 'Payment Already Approved.Please contact with admin!!');
            }
            else{
                $rows1 = DB::table('users')
                    ->where('id',Session::get('user_id'))
                    ->first();
                $result =DB::table('payment_history')
                    ->where('id', $request->id)
                    ->update([
                        'status' => $request->status,
                        'remarks' => $request->remarks,
                        'approved_by' =>$rows1->company_name,
                    ]);
                $rows3 = DB::table('users')
                    ->where('id', $rows2->agent_id)
                    ->first();
                if ($result) {
                    $result1 =DB::table('users')
                        ->where('id', $rows2->agent_id)
                        ->update([
                            'agency_amount' => $rows2->amount + $rows3->agency_amount - $rows3->auth_amount - $rows3->fine,
                        ]);
                    if($result1){
                        return redirect()->to('payment-request')->with('successMessage', 'Payment updated successfully!!');
                    }
                    else{
                        return back()->with('errorMessage', 'Please contact with admin!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Please try again!!');
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function accountsHead (Request $request){
        try{
            $rows1 = DB::table('accounts_head')->where('agent_id',Session::get('agent_id'))->orderBy('id','desc')->get();
            return view('accounts.accountsHead',['heads' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addAccountsHead (Request $request){
        try{
            $row = DB::table('accounts_head')->where('agent_id', Session::get('agent_id')) ->where('head', $request->name)->get();
            if($row->count()>0){
                return back()->with('errorMessage', 'Head Name Already Exits!! Please try again!!');
            }
            $result = DB::table('accounts_head')
            ->insert([
                'agent_id' => Session::get('agent_id'),
                'head' => $request->name,
            ]);
            if ($result) {
                return redirect()->to('accountsHead')->with('successMessage', 'Accounts head added successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editAccountHead(Request $request){
        try{
            $rows1 = DB::table('accounts_head')
                ->where('id',$request->id)
                ->first();
            return view('accounts.editAccountsHead',['account' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function updateAccountsHead(Request $request){
        try{
            $result =DB::table('accounts_head')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->update([
                    'head' => $request->name,
                ]);
            if ($result) {
                return redirect()->to('accountsHead')->with('successMessage', 'Data update successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function deleteAccountHead(Request $request){
        try{
            $result =DB::table('accounts_head')
                ->where('id', $request->id)
                ->where('agent_id',Session::get('agent_id'))
                ->delete();
            if ($result) {
                return redirect()->to('accountsHead')->with('successMessage', 'Data Delete successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}


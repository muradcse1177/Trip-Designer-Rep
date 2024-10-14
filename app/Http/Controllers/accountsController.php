<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class accountsController extends Controller
{
    public function transactions(Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            return view('accounts.transactions',['transactions' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function officeExpenses(Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('agent_id',Session::get('user_id'))
                ->where('source','Office Accounts')
                ->orderBy('id','desc')
                ->get();
            return view('accounts.officeExpenses',['transactions' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function filterOfficeExpense(Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('agent_id',Session::get('user_id'))
                ->where('source','Office Accounts')
                ->where(function ($query) use($request) {
                    if($request->acc_type  != '' )
                        $query->where('transaction_type', '=', $request->acc_type);
                    if($request->from_issue_date  != '' and $request->to_issue_date  != ''){
                        $query->whereBetween('date', [$request->from_issue_date, $request->to_issue_date]);
                    }
                    elseif($request->from_issue_date  != '' ){
                        $query->where('date', $request->from_issue_date);
                    }
                    else {
                        $query->where('date', $request->to_issue_date);
                    }
                })
                ->orderBy('date','desc')
                ->get();
            return view('accounts.officeExpenses',['transactions' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
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
            $invoice =  rand(1111111111,9999999999);
            $result = DB::table('accounts')->insert([
                'invoice_id' => $invoice,
                'date' => $request->date,
                'agent_id' => Session::get('user_id'),
                'transaction_type' => $request->type,
                'source' => 'Office Accounts',
                'purpose' => $request->purpose,
                'buying_price' => $debit,
                'selling_price' => $credit,
                'status' => 'Approved',
            ]);
            if ($result) {
                return redirect()->to('transactions')->with('successMessage', 'Office Income/Expense added successfully!!');
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
                ->where('agent_id',Session::get('user_id'))
                ->orderBy('id','desc')
                ->get();
            $rows2 = DB::table('air_ticket_invoice')
                ->where('deleted',0)
                ->where('agent_id',Session::get('user_id'))
                ->where('due_amount','>',0)
                ->orderBy('id','desc')
                ->get();
            return view('accounts.bankAccounts',['accounts' => $rows1,'tickets' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function bankAccountsSuper(Request $request){
        try{
            $rows1 = DB::table('bank_account_super')
                ->where('agent_id',Session::get('user_id'))
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

            $result = DB::table('bank_account_super')->insert([
                'name' => $request->name,
                'agent_id' => Session::get('user_id'),
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
                'agent_id' => Session::get('user_id'),
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
                ->where('agent_id',Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
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
                $rows = DB::table('bank_account_super')->where('agent_id', Session::get('user_id'))->where('id', $request->id)->first();
                if ($request->logo) {
                    $fileName = time() . '.' . $request->logo->extension();
                    $request->logo->move(public_path('images/upload/company/'), $fileName);
                    $logo = 'public/images/upload/company/'. $fileName;
                } else {
                    $logo = $rows->logo;
                }
                $result = DB::table('bank_account_super')
                    ->where('id', $rows->id)
                    ->where('agent_id', Session::get('user_id'))
                    ->update([
                        'name' => $request->name,
                        'agent_id' => Session::get('user_id'),
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
                ->where('agent_id',Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
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
                ->where('agent_id',Session::get('user_id'))
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
    public function filterTransaction (Request $request){
        try{
            $rows1 = DB::table('accounts')
                ->where('status','Approved')
                ->where('agent_id',Session::get('user_id'))
                ->where(function ($query) use($request) {
                    if($request->from_issue_date  != '')
                        $query->where('date', '>=', $request->from_issue_date);
                    if( $request->to_issue_date  != '')
                        $query->where('date', '<=' , $request->to_issue_date);
                    if($request->acc_type  != '' )
                        $query->where('source', '=', $request->acc_type);
                })
                ->orderBy('id','desc')
                ->get();
            return view('accounts.transactions',['transactions' => $rows1,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function generalInvoice (Request $request){
        try{
            $rows1 = DB::table('g_invoice')->where('agent_id',Session::get('user_id'))->orderBy('id','desc')->get();
            return view('invoice.gInvoice',['invoices' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function printGInvoice (Request $request){
        try{
            $rows1 = DB::table('g_invoice')->where('agent_id',Session::get('user_id'))->where('id', $request->id)->first();
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
                'agent_id' => Session::get('user_id'),
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
                ->where('agent_id',Session::get('user_id'))
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

}

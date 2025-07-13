<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class loanController extends Controller
{
    public function index()
    {
        $loans = DB::table('loan')
            ->join('employees', 'loan.emp_id', '=', 'employees.id')
            ->select('loan.*', 'employees.name as employee_name')
            ->orderBy('loan.id', 'desc')
            ->paginate(10);

        return view('hr.loan.loan', compact('loans'));
    }

    public function create()
    {
        $employees = DB::table('employees')->where('agent_id',Session::get('agent_id'))->get();
        return view('hr.loan.create', compact('employees'));
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'employee_id'  => 'required|integer|exists:employees,id',
            'loan_amount'  => 'required|numeric|min:0',
            'paid_on'      => 'required|date',
        ]);
        // Check if employee has any unpaid loan
        $existingLoan = DB::table('loan')
            ->where('emp_id', $request->employee_id)
            ->whereColumn('loan_amount', '>', 'paid_amount') // still due
            ->exists();

        if ($existingLoan) {
            return redirect()->to('loan')->with('errorMessage', 'This employee already has an unpaid loan.');
        }

        // Insert into `loans` table
        DB::table('loan')->insert([
            'agent_id'      => Session::get('agent_id'),
            'emp_id'      => $request->employee_id,
            'loan_amount' => $request->loan_amount,
            'paid_amount' => 0,
            'paid_on'     => $request->paid_on,
            'status'     => 'Approved',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
        return redirect()->to('loan')->with('successMessage', 'Loan entry submitted successfully.');
    }

    public function edit($id)
    {
        $employees = DB::table('employees')->where('agent_id',Session::get('agent_id'))->get();
        $loan = DB::table('loan')->where('id', $id)->first();
        if (!$loan) abort(404);
        return view('hr.loan.create', compact('loan','employees'));
    }

    public function update(Request $request, $id)
    {
        // Validation
        $request->validate([
            'employee_id'  => 'required|integer|exists:employees,id',
            'loan_amount'  => 'required|numeric|min:0',
            'paid_on'      => 'required|date',
        ]);

        // Optional: Check if loan entry exists
        $loan = DB::table('loan')->where('id', $id)->first();
        if (!$loan) {
            return redirect()->to('loan')->with('errorMessage', 'Loan entry not found.');
        }

        // Update loan record
        DB::table('loan')->where('id', $id)->update([
            'emp_id'      => $request->employee_id,
            'loan_amount' => $request->loan_amount,
            'paid_on'     => $request->paid_on,
            'updated_at'  => now(),
        ]);

        return redirect()->to('loan')->with('successMessage', 'Loan entry updated successfully.');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Closed', // Only allow "Closed"
        ]);

        $loan = DB::table('loan')->where('id', $id)->first();

        if (!$loan) {
            return redirect()->to('loan')->with('errorMessage', 'Loan not found.');
        }

        if ($loan->status === 'Closed') {
            return redirect()->to('loan')->with('errorMessage', 'Loan is already closed.');
        }

        DB::table('loan')->where('id', $id)->update([
            'status'        => 'Closed',
            'emp_paid_on'   => now()->toDateString(),
            'paid_amount'   => $loan->loan_amount,
            'updated_at'    => now(),
        ]);

        return redirect()->to('loan')->with('successMessage', 'Loan closed successfully.');
    }
    public function addPayment(Request $request, $id)
    {
        $request->validate([
            'amount'   => 'required|numeric|min:1',
            'paid_on'  => 'required|date',
        ]);

        // Get loan row
        $loan = DB::table('loan')->where('id', $id)->first();
        if (!$loan) {
            return back()->with('errorMessage', 'Loan not found.');
        }

        // নতুন total paid amount হিসাব করো
        $newPaidAmount = $loan->paid_amount + $request->amount;

        // Check: overpayment allow না
        if ($newPaidAmount > $loan->loan_amount) {
            return back()->with('errorMessage', 'Payment exceeds remaining loan balance.');
        }

        // ✅ UPDATE `loan` টেবিল
        $updateData = [
            'paid_amount' => $newPaidAmount,
            'updated_at'  => now(),
        ];

        // যদি পুরো loan পরিশোধ হয়ে যায়
        if ($newPaidAmount == $loan->loan_amount) {
            $updateData['status'] = 'Closed';
            $updateData['emp_paid_on'] = $request->paid_on;
        }

        // Apply update
        DB::table('loan')->where('id', $id)->update($updateData);

        return redirect()->to('loan')->with('successMessage', 'Loan payment updated successfully.');
    }
}

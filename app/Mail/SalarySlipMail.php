<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalarySlipMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee, $salary, $company;

    public function __construct($employee, $salary, $company)
    {
        $this->employee = $employee;
        $this->salary = $salary;
        $this->company = $company;
    }

    public function build()
    {
        $monthName = date("F", mktime(0, 0, 0, $this->salary->month, 1));
        return $this->subject('Salary Slip - ' . $monthName . ' ' . $this->salary->year)
            ->view('hr.salary.email_salary_slip');
    }
}

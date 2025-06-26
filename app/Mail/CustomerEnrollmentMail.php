<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerEnrollmentMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $password, $order)
    {
        $this->user = $user;
        $this->password = $password;
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Course Enrollment')
            ->view('frontend.emails.customer_enrollment')
            ->with([
                'user'     => $this->user,
                'password' => $this->password,
                'order'    => $this->order,
            ]);
    }
}

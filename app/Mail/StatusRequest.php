<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $borrowerName;
    public $borrowerEmail;
    public function __construct($borrowerName, $borrowerEmail)
    {
        $this->borrowerName = $borrowerName;
        $this->borrowerEmail = $borrowerEmail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('statusRequest.userstatusrequest')
        ->subject('Application Loan Notification')
        ->from('info@getpesa.co.tz', 'GetPesa Limited');
    }
}

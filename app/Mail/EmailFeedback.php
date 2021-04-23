<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailFeedback extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $sendName;
    public $sendTicket;
    public function __construct($sendName,$sendTicket)
    {
        $this->sendName = $sendName;
        $this->sendTicket = $sendTicket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('compareProducts.emailcontent')
        ->subject('Comparison Product Summary Report')
        ->from('info@getpesa.co.tz', 'GetPesa Limited');
    }
}

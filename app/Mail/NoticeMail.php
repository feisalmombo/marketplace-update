<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class NoticeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    //creating two public properties
    public $users;
    public $count;

    public $compareloans;
    public $averagePeriod;
    public $averageAmount;
    public $downloadReport;
    public $callMeReport;
    public $totalApplication;
    public $loancompares;
    public $yesterdayCount;
    public $dailyCountApplication;
    public $yesterdayCountApplication;
    public function __construct($var1,$var2,$compareloans, $averagePeriod, $averageAmount, $downloadReport, $callMeReport, $totalApplication, $loancompares, $yesterdayCount, $dailyCountApplication, $yesterdayCountApplication)
    {
        $this->users = $var1; 
        $this->count = $var2;

        $this->compareloans = $compareloans;
        $this->averagePeriod = $averagePeriod;
        $this->averageAmount = $averageAmount;
        $this->downloadReport = $downloadReport;
        $this->callMeReport = $callMeReport;
        $this->totalApplication = $totalApplication;

        $this->loancompares = $loancompares;
        $this->yesterdayCount = $yesterdayCount;
        $this->dailyCountApplication = $dailyCountApplication;
        $this->yesterdayCountApplication = $yesterdayCountApplication;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mailCommandNotify.notifyme')
        ->subject('MarketPlace Daily Report For '. Carbon::yesterday()->format('d-m-Y'))
        ->from('info@getpesa.co.tz', 'GetPesa Limited');
    }
}

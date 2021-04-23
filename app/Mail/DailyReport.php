<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class DailyReport extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $compareloans;
    public $averagePeriod;
    public $averageAmount;
    public $downloadReport;
    public $callMeReport;
    public $totalApplication;
    public $loancompares;
    public $count; 
    public $yesterdayCount; 
    public $dailyCountApplication;
    public $yesterdayCountApplication;


    public function __construct($compareloans, $averagePeriod, $averageAmount, $downloadReport, $callMeReport, $totalApplication, $loancompares, $count, $yesterdayCount, $dailyCountApplication, $yesterdayCountApplication)
    {
        $this->compareloans = $compareloans;
        $this->averagePeriod = $averagePeriod;
        $this->averageAmount = $averageAmount;
        $this->downloadReport = $downloadReport;
        $this->callMeReport = $callMeReport;
        $this->totalApplication = $totalApplication;
        $this->loancompares = $loancompares;
        $this->count = $count;
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
        return $this->view('dailyReportviaEmail.dailyreport')
        ->subject('MarketPlace Summary Report For ' . Carbon::now()->format('d-m-Y H:i:s'))
        ->from('info@getpesa.co.tz', 'GetPesa Limited');
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/* Need to use user app, mail and mailable class "NoticeMail" */
use App\User;
use App\CompareLoan;
use Mail;
use App\Mail\NoticeMail;
use Carbon\Carbon;

class MailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:me';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'MarketPlace Daily Report';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = User::whereDate('created_at', now())
                      ->get(); 

        $count =  $users->count('id'); 

        $compareloans = DB::table('compare_loans')
        ->whereDate('created_at','=', Carbon::yesterday())
        ->count();

        $averagePeriod = DB::table('compare_loans')
        ->latest()
        ->avg('duration');

        $averageAmount = DB::table('compare_loans')
        ->latest()
        ->avg('loan_amount');

        $downloadReport = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Download Report')
        ->whereDate('created_at','=', Carbon::yesterday())
        ->count();

        $callMeReport = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Call Me')
        ->whereDate('created_at','=', Carbon::yesterday())
        ->count();

        $totalApplication = DB::table('users')
        ->where('users.applied_status','=','Apply')
        ->whereDate('created_at','=', Carbon::yesterday())
        ->count();

        $loancompares = CompareLoan::whereDate('created_at', now())
        ->get();
        $count =  $loancompares->count('id');

        $yesterdayLoanCompares = CompareLoan::whereDate('created_at','=', Carbon::yesterday())
        ->get();
        $yesterdayCount =  $yesterdayLoanCompares->count('id');

        $dailyApplication = DB::table('users')
        ->where('users.applied_status','=','Apply')
        ->whereDate('created_at', today())
        ->get();
        $dailyCountApplication =  $dailyApplication->count('id');

        $yesterdayApplication = DB::table('users')
        ->where('users.applied_status','=','Apply')
        ->whereDate('created_at','=', Carbon::yesterday())
        ->get();
        $yesterdayCountApplication =  $yesterdayApplication->count('id');

        Mail::to('feisal.mombo@getpesa.co.tz')
        ->cc(['imani.alfayo@getpesa.co.tz','info@getpesa.co.tz'])
        ->send(new NoticeMail($users,$count,$compareloans, $averagePeriod, $averageAmount, $downloadReport, $callMeReport, $totalApplication, $loancompares, $count, $yesterdayCount, $dailyCountApplication, $yesterdayCountApplication));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\LoanRequestApprove;
use App\Mail\BankerRequestApprove;
use App\User;
use Carbon\Carbon;
use Mail;
use AfricasTalking\SDK\AfricasTalking;

class LoanRequestApprovesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $loanRequestApproves = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')

        ->select(
        'loan_request_approves.id',
        'loan_request_approves.loan_requests_description',
        'loan_request_approves.loan_requests_status',
        'users.full_name',
        'users.email',
        'users.phone_number',
        'loan_rates.product_name',
        'loan_rates.product_code',
        'cities.city_name',
        'products.institution_name',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'loan_request_approves.created_at')
        ->where('loan_request_approves.loan_requests_status', '=', "Pending")
        ->latest()
        ->get();

        return view('manageLoanRequestApproves.allloanrequestapproves')
        ->with('loanRequestApproves', $loanRequestApproves);
    }

    public function bankerApproved()
    {
        $loanApprovedByBankers = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')

        ->select(
        'loan_request_approves.id',
        'loan_request_approves.loan_requests_description',
        'loan_request_approves.loan_requests_status',
        'users.full_name',
        'users.email',
        'users.phone_number',
        'loan_rates.product_name',
        'loan_rates.product_code',
        'cities.city_name',
        'products.institution_name',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'loan_request_approves.created_at')
        ->where('loan_request_approves.loan_requests_status', '=', "Approved")
        ->latest()
        ->get();

        return view('manageLoanRequestApproves.allloanrequestApprovedbyBanker')
        ->with('loanApprovedByBankers', $loanApprovedByBankers);
    }

    public function singleBankerApproved()
    {
        $borrower_id = Auth::user()->id;

        $singleLoanApprovedByBankers = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')

        ->select(
        'loan_request_approves.id',
        'loan_request_approves.loan_requests_description',
        'loan_request_approves.loan_requests_status',
        'users.full_name',
        'users.email',
        'users.phone_number',
        'loan_rates.product_name',
        'loan_rates.product_code',
        'cities.city_name',
        'products.institution_name',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'loan_request_approves.created_at')
        ->where('loan_request_approves.borrower_id', '=', $borrower_id)
        ->where('loan_request_approves.loan_requests_status', '=', "Approved")
        ->latest()
        ->get();

        return view('manageLoanRequestApproves.singleloanrequestbankerApprove')
        ->with('singleLoanApprovedByBankers', $singleLoanApprovedByBankers);
    }

    public function replyApprove(Request $request)
    {
        $this->validate(request(), [
            'description' => 'required',
            'requestsStatus' => 'required',
        ]);

        $loanRequestApprove = new LoanRequestApprove();

        # This check the existing email and pass the id to the database
        $user = DB::table('users')->where('email', $request->email)->value('id');

        $loanRequestApprove->borrower_id = $user;
        $loanRequestApprove->loan_requests_description = $request->description;
        $loanRequestApprove->loan_requests_status = $request->requestsStatus;
        $st = $loanRequestApprove->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to insert LoanRequest data');
        }
       else{

        $borrowerName = $request->full_name;
        $borrowerEmail = $request->email;

        Mail::to($borrowerEmail)->send(new BankerRequestApprove($borrowerName,$borrowerEmail));

        $sendSms = $this->sendBankerSMS($request->phone_number);

          return redirect()->back()->with('message', 'LoanRequest is successfully added');
       }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loanRequestApprove = LoanRequestApprove::findOrFail($id);

        $loanRequestApprove = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')

        ->select(
        'loan_request_approves.id',
        'loan_request_approves.loan_requests_description',
        'loan_request_approves.loan_requests_status',
        'users.full_name',
        'users.email',
        'users.phone_number',
        'loan_rates.product_name',
        'loan_rates.product_code',
        'cities.city_name',
        'products.institution_name',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'loan_request_approves.created_at')
        ->where('loan_request_approves.id', '=', $id)
        ->first();

        return view('manageLoanRequestApproves.show')
        ->with('loanRequestApprove', $loanRequestApprove);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function sendBankerSMS($phone_number)
    {
         // Set your app credentials
         $username   = "getpesasms";
         $apiKey     = "77a7d4b633e3cd88976bc498a5f358c05902c2f7c2c4c1e58bb51818078084bd";

         // Initialize the SDK
         $AT = new AfricasTalking($username, $apiKey);

         // Get the SMS service
         $sms        = $AT->sms();

         // Set the numbers you want to send to in international format
         $mssid = $phone_number;

         // Set your message
         $message = "Your loan request is approved  by Bank officer.";
         try {
             // Thats it, hit send and we'll take care of the rest
             $result = $sms->send([
                 'to'      => $mssid,
                 'message' => $message
             ]);

             print_r($result);
         } catch (Exception $e) {
             echo "Error: ".$e->getMessage();
         }
    }
}

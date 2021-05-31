<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Role;
use App\Permission;
use App\UserStatus;
use App\ActivityLog;
use App\EmploymentDetail;
use App\Mail\EmailFeedback;
use App\LoanRate;
use App\LoanRequestApprove;
use App\City;
use App\Mail\ApplyRequest;
use App\Mail\StatusRequest;
use App\Mail\PendingRequestMail;
use Mail;
use Auth;
use App\Otp;
use AfricasTalking\SDK\AfricasTalking;

class PlaceRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_request')) {
                return $next($request);
            }
            return redirect()->back();
        });

        return view('applyRequest.applyrequests');
    }

    public function employmentInfo()
    {
        $employmentData = DB::table('employment_details')
        ->latest()
        ->get();

        return view('accountInfo.employmentinfo')
        ->with('employmentDatas', $employmentData);
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
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_request')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $this->validate(request(), [
            'full_name' => 'required',
            'email' => 'required',
            // 'email' => 'required|unique:users,email',
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'dob' => 'date_format:Y-m-d|before:2002-01-01',
            'id_number' => 'required|unique:users,government_id_number',
            // 'city' => 'required',
            'cityID' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'workplace' => 'required',
            'address' => 'required',
            'employernumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|max:10',
            'netsalary' => 'required',
            'jobtitle' => 'required',
            'status' => 'required',
            'terms' => 'required',
        ]);

        $check_otp = $request->otp;
        if(empty($check_otp)) {
            $otpBoth = $this->otpGenerator($request->email, strtolower("+255". substr($request->phone_number, 1)));

            $otpWithSms = $this->sendSmswithOtp(strtolower("+255". substr($request->phone_number, 1)));

            if ($otpBoth) {
                return redirect()->back()->withInput($request->input())->with('msg1', 'Please Enter OTP is sent to your mobile phone');
            }else{
                return redirect()->back()->withInput($request->input())->with('msg', 'Please try again');
            }

        }

        $check = Otp::where("email", $request->email)->where('otp', $request->otp)->exists();

        if(!$check){
            return redirect()->back()->withInput($request->input())->with('msg', 'Invalid OTP, Please click apply button to get new OTP');
        }

        Otp::where("email", $request->email)->where('otp', $request->otp)->delete();

        $dev_role = Role::where('slug', 'borrower')->first();
        $dev_perm = Permission::where('slug', 'create_inquiries')->first();

        $citiesData  = DB::table('cities')->select('id', 'city_name')->where('id', '=', $request->cityID)->value('id');

        $borrowers = new User();

        $employmentDetail = new EmploymentDetail();

        $borrowersEmail = $request->email;
        $borrowers->full_name = $request->full_name;
        $borrowers->email = $borrowersEmail;
        // $borrowers->phone_number = $request->phone_number;
        $borrowers->phone_number = strtolower("+255". substr($request->phone_number, 1));
        $borrowers->date_of_birth = $request->dob;
        $borrowers->government_id_number = $request->id_number;
        $borrowers->city_id = $citiesData;
        $borrowers->password = bcrypt($request->password);
        $borrowers->status = $request->status;
        $borrowers->bank_name = $request->bank_name;
        $borrowers->applied_status = "Apply";
        $borrowers->loanrates_id = 72;
        $st = $borrowers->save();

        $borrowers->roles()->attach($dev_role);
        $borrowers->permissions()->attach($dev_perm);

        $borrowerstatus = new UserStatus();
        $borrowerstatus->user_id = $borrowers->id;
        $borrowerstatus->slug = false;
        $st2 = $borrowerstatus->save();
        if ($st2) {
            $usersId  = DB::table('users')->select('id')->where('full_name', '=', $request->full_name)->value('id');

            $employmentDetail->workplace = $request->workplace;
            $employmentDetail->address = $request->address;
            // $employmentDetail->phone_number = $request->employernumber;
            $employmentDetail->phone_number = strtolower("+255". substr($request->employernumber, 1));
            $employmentDetail->net_salary = str_replace(',','',$request->netsalary);
            $employmentDetail->job_title = $request->jobtitle;
            $employmentDetail->user_id = $usersId;
            $st3 = $employmentDetail->save();

            if (!$st3) {
                 return redirect()->back()->with('msg', 'Failed to Apply');
             }
            else{
                $borrowerName = $request->full_name;
                $borrowerEmail = $request->email;

               Mail::to('feisalmombo29@gmail.com')->send(new ApplyRequest($borrowerName,$borrowerEmail));
               Mail::to($borrowerEmail)->send(new StatusRequest($borrowerName,$borrowerEmail));

               $sendSms = $this->sendSMS(strtolower("+255". substr($request->phone_number, 1)));
                  return redirect('/login')->with('message', 'Your Application has successfully been submitted. To view you application please sign in.');
            }
        }
    }

    public function getloanRequests()
    {
        // All Information user Applied for a Loan
        $loanrequests = DB::table('users')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'users.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'products.institution_name',
            'institution_types.institution_type_name',
            'users.applied_status',
            'users.created_at',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'loan_types.loan_name',
            'institution_types.institution_type_name'
        )
        ->where('users.applied_status','=','Apply')
        ->latest()
        ->get();

        return view('loanRequests.viewloanrequests')
        ->with('loanrequests', $loanrequests);
    }

    public function loanApplied()
    {
        $customer_id = Auth::id();

        $loanapplied = DB::table('users')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'users.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'products.institution_name',
            'institution_types.institution_type_name',
            'users.applied_status',
            'users.created_at',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'loan_types.loan_name',
            'institution_types.institution_type_name'
        )
        ->where('users.applied_status','=','Apply')
        ->where('users.id','=', $customer_id)
        ->latest()
        ->get();

        return view('myLoans.loanapplied')
        ->with('loanapplied', $loanapplied);
    }

    public function loanApproved()
    {
        $customer_id = Auth::id();

        $loanapproved = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->select(
            'loan_request_approves.id',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'loan_request_approves.created_at'
        )
        ->where('loan_request_approves.borrower_id', '=', $customer_id)
        ->where('loan_request_approves.loan_requests_status','=','Accept')
        ->latest()
        ->get();

        return view('myLoans.loanapproved')
        ->with('loanapproved', $loanapproved);
    }

    public function loanPending()
    {
        $customer_id = Auth::id();

        $loanpending = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->select(
            'loan_request_approves.id',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'loan_request_approves.created_at'
        )
        ->where('loan_request_approves.borrower_id', '=', $customer_id)
        ->where('loan_request_approves.loan_requests_status','=','Pending')
        ->latest()
        ->get();

        return view('myLoans.loanpending')
        ->with('loanpending', $loanpending);
    }

    public function allLoanRejected()
    {
        $allLoanrejected = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'loan_request_approves.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            // 'users.bank_name',
            // 'products.product_name',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'loan_types.loan_name',
            'institution_types.institution_type_name',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_request_approves.created_at'
        )
        ->where('loan_request_approves.loan_requests_status','=','Reject')
        ->latest()
        ->get();

        return view('manageAllLoanRejected.viewallLoanRejected')
        ->with('allLoanrejected', $allLoanrejected);
    }

    public function loanRejected()
    {
        $customer_id = Auth::id();

        $loanRejected = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'loan_request_approves.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'loan_types.loan_name',
            'institution_types.institution_type_name',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_request_approves.created_at'
        )
        ->where('loan_request_approves.borrower_id', '=', $customer_id)
        ->where('loan_request_approves.loan_requests_status','=','Reject')
        ->latest()
        ->get();

        return view('manageAllLoanRejected.viewloanRejected')
        ->with('loanRejected', $loanRejected);
    }

    public function showloanRequests($id)
    {
        $loanrequest = User::findOrFail($id);

        $eligibilities = DB::table('users')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'users.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'products.institution_name',
            'loan_rates.eligibility',
            'institution_types.institution_type_name',
            'users.applied_status',
            'users.created_at',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'loan_types.loan_name',
            'institution_types.institution_type_name'
        )
        ->where('users.applied_status','=','Apply')
        ->where('users.id','=', $id)
        ->latest()
        ->first();

        return view('loanRequests.showloanrequests')
        ->with('loanrequest', $loanrequest)
        ->with('eligibilities', $eligibilities)
        ->with('borrowerId', $id);
    }

    public function postloanRequests(Request $request)
    {
        $data =  $request->all();

        $BorrowerId = $data['borrowerId'];

        $this->validate(request(), [
            'description' => 'required',
            'requestsStatus' => 'required',
        ]);

        $loanrequests = new LoanRequestApprove();
        $loanrequests->borrower_id = $BorrowerId;
        $loanrequests->loan_requests_description = $request->description;
        $loanrequests->loan_requests_status = $request->requestsStatus;
        $st = $loanrequests->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to insert LoanRequest data');
        } else {
            $borrowerName = $request->full_name;
            $borrowerEmail = $request->email;

           Mail::to($borrowerEmail)->send(new PendingRequestMail($borrowerName,$borrowerEmail));

           $sendpendingSms = $this->sendPendingSMS(strtolower("+255". substr($request->phone_number, 1)));
            return redirect()->back()->with('message', 'LoanRequest is successfully added');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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


    public function deleteLoanrequests(Request $request, $id)
    {
        $loanrequest = User::findOrFail($id);

        $loanrequest->delete();

        return redirect('/loan/requests')->with('message', 'LoanRequest with full name is successfully deleted');
    }

    public function totalRejectedApproved()
    {
        $totalrejectedApprovedDatas= DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'loan_request_approves.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'loan_types.loan_name',
            'institution_types.institution_type_name',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_request_approves.created_at'
        )
        ->latest()
        ->get();
        return view('totalrejectedandapproved.managerejectedandapproved')
        ->with('totalrejectedApprovedDatas', $totalrejectedApprovedDatas);
    }

    public function TotalFromloanApproved()
    {
        $totalFromloanApprovedDatas= DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->select(
            'loan_request_approves.id',
            'users.full_name',
            'users.email',
            'users.phone_number',
            'users.date_of_birth',
            'users.government_id_number',
            'cities.city_name AS city',
            'users.status',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'products.institution_name',
            'loan_types.loan_name',
            'institution_types.institution_type_name',
            'loan_request_approves.loan_requests_description',
            'loan_request_approves.loan_requests_status',
            'loan_request_approves.created_at'
        )
        ->where('loan_request_approves.loan_requests_status', '=', 'Accept')
        ->latest()
        ->get();
        return view('totalfromloanApproved.loanApproved')
        ->with('totalFromloanApprovedDatas', $totalFromloanApprovedDatas);
    }

    private function otpGenerator($email, $phone_number)
    {
        $otpTodatabase = $this->otpWithRandom();
        // This return the original OTP and send directly to the database
        Otp::create([
            'email' => $email,
            'phone_number' => $phone_number,
            'otp' => $otpTodatabase
        ]);
        // dd($otpTodatabase);
        return true;
    }

    private function otpWithRandom()
    {
        $otp = mt_rand(100000, 999999);
        if ($this->checkOtp($otp)) {
            return $this->otpWithRandom();
        }else{
            return $otp;
        }
    }

    private function checkOtp($otp)
    {
        $check = Otp::where('otp',$otp)->exists();
        if ($check) {
            return true;
        } else {
            return false;
        }
    }

    public function sendSmswithOtp($phone_number)
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

        $OtpFromDatabase = DB::table('otps')
            ->select('otps.otp')
            ->latest()
            ->first();

         // Set your message
         $message = "Your One Time Password is " . $OtpFromDatabase->otp;

         // Set your shortCode or senderId
         try {
             // Thats it, hit send and we'll take care of the rest
             $result = $sms->send([
                 'to'      => $mssid,
                 'message' => $message
                 // 'from'    => $from
             ]);

             // dd($result);
             print_r($result);
         } catch (Exception $e) {
             echo "Error: ".$e->getMessage();
         }
    }

    public function sendSMS($phone_number)
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
         $message = "Thank you for applying. Your Loan request has been submitted successfully.";
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

    public function sendPendingSMS($phone_number)
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
         $message = "Your loan request is pending bank’s approval.";
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

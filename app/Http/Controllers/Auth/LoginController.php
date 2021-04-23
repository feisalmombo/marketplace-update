<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use DB;
use App\OTPLogin;
use AfricasTalking\SDK\AfricasTalking;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->user = new User;
    }

    public function login(Request $request)
    {
        // Check validation
        $this->validate($request, [
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13',
            'password' => 'required|min:6',
        ]);

        $check_otp = $request->otp;
        if(empty($check_otp)) {
            $otpBoth = $this->otpGenerator($request->phone_number, $request->password);

            $otpWithSms = $this->sendSmswithOtp($request->phone_number);

            if ($otpBoth) {
                return redirect()->back()->withInput($request->input())->with('messagelogin', 'Please enter Login code is sent to your mobile phone');
            }else{
                return redirect()->back()->withInput($request->input())->with('errorlogin', 'Please try again');
            }

        }

        $check = OTPLogin::where("phone_number", $request->phone_number)->where('otp', $request->otp)->exists();

        if(!$check){
            return redirect()->back()->withInput($request->input())->with('errorlogin', 'Invalid Login code, Please click Sign in to get new Login code');
        }

        OTPLogin::where("phone_number", $request->phone_number)->where('otp', $request->otp)->delete();

        // Get user record
        $user = \Auth::attempt(array('phone_number' => $request->phone_number, 'password' => $request->password));

        // Check Condition Phone Number. Found or Not
        if (!$user) {
        // user doesn't exist
        return redirect()->back()->with('errorlogin', 'These credentials do not match our records.');
        }
        return redirect()->route('home');
    }

    private function otpGenerator($phone_number, $password)
    {
        $otpTodatabase = $this->otpWithRandom();
        OTPLogin::create([
            'phone_number' => $phone_number,
            'password' => $password,
            'otp' => $otpTodatabase
        ]);
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
        $check = OTPLogin::where('otp',$otp)->exists();
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

        $OtpFromDatabase = DB::table('o_t_p_logins')
            ->select('o_t_p_logins.otp')
            ->latest()
            ->first();

        // Set your message
        $message = "Your Login code is " . $OtpFromDatabase->otp;

        // Set your shortCode or senderId
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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoanType;
use App\LoanRate;
use App\Product;
use App\CompareLoan;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Mail\DailyReport;
use Mail;
use App\Mail\EmailFeedback;
use DB;
use App\ProductInquiry;
use Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Session;
use Carbon\Carbon;

class SearchComparesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function showComparesearchloan(){
        $loan_types = LoanType::all();

        return view('compareProducts.searchatwelcome')
        ->with('loan_types', $loan_types);
    }

    public function comparesearchloan(Request $request)
    {

        $loan_types = LoanType::all();

        $loantype = $request->loantype;
        $loan_amount = str_replace(',','',$request->loan_amount);
        $duration = str_replace(',','',$request->duration);
        $net_salary = str_replace(',','',$request->net_salary);

        $products = Product::with(['loan_type'])
                    ->whereHas('loan_type', function($query) use ($loantype){
                        $query->where('loan_type_id',$loantype);
                    })
                    ->paginate(3);

        if (count($products) > 0) {
            $inst_products = [];

            foreach ($products as $key => $item) {
                $repayment = round($this->repaPyment($item->loan_type[0]['interest_rate'],$duration,$loan_amount),2);
                $facility = round($this->facility($item->loan_type[0]['facility_rate']/100,$loan_amount),2);
                $insurance = round($this->insurance($loan_amount,$duration,$item->loan_type[0]['insurance_rate']/100));
                $net_amount = round($this->netAmount($loan_amount,$facility,$insurance),2);
                $dir = round($this->dir($repayment,$net_salary),2);
                $inst_products[$key] = [
                    'id' => $item->id,
                    'institution_type_id' => $item->institution_type_id,
                    'institution_logo' => $item->institution_logo,
                    'institution_street_city' => $item->institution_street_city,
                    'institution_contact_email' => $item->institution_contact_email,
                    'institution_contact_phone_number' => $item->institution_contact_phone_number,
                    'institution_social_media_links' => $item->institution_social_media_links,
                    'product_name' => $item->product_name,
                    'product_code' => $item->product_code,
                    'institution_name' => $item->institution_name,
                    'interest_rate' => $item->loan_type[0]['interest_rate'],
                    'facilite_fee' => $facility,
                    'repayment' => $repayment,
                    'insurance_fee' => $insurance,
                    'dir' => $dir,
                    'net_amount' => $net_amount,
                    'duration' => $duration,
                    'institution_interest_rate' => $item->loan_type[0]['interest_rate'],
                    'minimum_net_salary' => $item->loan_type[0]['minimum_net_salary'],
                    'product_name' => $item->loan_type[0]['product_name'],
                    'product_code' => $item->loan_type[0]['product_code'],
                    'minimum_amount' => $item->loan_type[0]['minimum_amount'],
                    'maxmum_amount' => $item->loan_type[0]['maxmum_amount'],
                    'turn_around_time' => $item->loan_type[0]['turn_around_time'],
                    'institution_facility_rate' => $item->loan_type[0]['facility_rate'],
                    'institution_insurance_rate' => $item->loan_type[0]['insurance_rate'],
                    'eligibility' => $item->loan_type[0]['eligibility']
                ];
            }
        }else{
            return redirect()->back()->with('msg100', 'No Institution provide product loan for comparison');
        }
        $sort_products = collect($inst_products)->sortBy('repayment')->values()->all();
        {
            $loantype =  LoanType::where('id', $request->loantype)->first();

            $comparison = new CompareLoan();
            $comparison->loan_amount = str_replace(',','',$request->loan_amount);
            $comparison->duration = str_replace(',','',$request->duration);
            $comparison->net_salary = str_replace(',','',$request->net_salary);
            $comparison->loan_type_id = $loantype->id;
            $st = $comparison->save();
        }

        $compareloans = DB::table('compare_loans')
        ->count();

        $averagePeriod = DB::table('compare_loans')
        ->latest()
        ->avg('duration');

        $averageAmount = DB::table('compare_loans')
        ->latest()
        ->avg('loan_amount');

        $downloadReport = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Download Report')
        ->count();

        $callMeReport = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Call Me')
        ->count();

        $totalApplication = DB::table('users')
        ->where('users.applied_status','=','Apply')
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

        return redirect()->back()->with('data', $sort_products);
    }

    public function showAllcomparisonLoan($id)
    {
        $products = LoanRate::all()
        ->where('id','=',$id)
        ->first();

        $cities = DB::table('cities')
        ->select('cities.id', 'city_name')
        ->get();

        $documentsDatas = DB::table('documents')
        ->join('users', 'documents.user_id', '=', 'users.id')

        ->select(
        'documents.id',
        'documents.name',
        'documents.file_path',
        'documents.created_at')
        ->latest()
        ->get();

        return view('applyRequest.applyrequests')
        ->with('products', $products)
        ->with('cities', $cities)
        ->with('documentsDatas', $documentsDatas);
    }

    public function exploreDetails($id)
    {

        return view('exploreDetails.exploredetailsdocuments');
    }

    // 1
    private function repaPyment($interest,$duration,$loan){

        $interest = $interest / 100;
        $result = $interest / 12 * pow(1 + $interest / 12,$duration) / (pow(1 + $interest / 12,$duration) - 1) * $loan;
        return $result;
    }

    // 2
    private function facility($facility_rate,$loan){

        return $facility_rate*$loan;
    }

    // 3
    private function insurance($loan,$duration,$insurance_rate){

        return $loan * ($duration/12) * $insurance_rate;
    }

    // 4
    private function dir($repayment,$net_salary){

        return ($repayment/$net_salary) * 100;
    }

    // 5
    private function netAmount($loan,$facility,$insurance){

        return $loan - $facility - $insurance;
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

    public function viewdownloadreport()
    {
        $productinquiries = DB::table('product_inquiries')
        ->latest()
        ->get();

        return view('productInquiries.viewproductinquiries')
        ->with('productinquiries', $productinquiries);
    }

    public function downloadOnlyForInquiries()
    {
        $downloadOnlyDatas = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Download Report')
        ->latest()
        ->get();

        return view('productInquiries.downloadonly')
        ->with('downloadOnlyDatas', $downloadOnlyDatas);
    }

    public function callMeOnlyForInquiries()
    {
        $callMeOnlyDatas = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Call Me')
        ->latest()
        ->get();
        return view('productInquiries.callmeonly')
        ->with('callMeOnlyDatas', $callMeOnlyDatas);
    }

    public function deleteviewdownloadreport(Request $request, $id)
    {
        $productinqury = ProductInquiry::findOrFail($id);

        $productinqury->delete();

        return redirect('/product/inquries')->with('message', 'Product Inquiries is successfully deleted');;
    }

    public function downloadreport(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'name' => 'required',
            'phonenumber' => 'required',
            'email' => 'required',
            'terms' => 'required',
        ]);
           if($validator -> fails()){
            return redirect('/compare/search/loan')->withErrors($validator)->withInput();
        }
        $productinquiry = new ProductInquiry;

        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $ticket = substr(str_shuffle($chars), 0, 8);

        $productinquiry->full_name = $request->name;
        $reporterEmail = $request->email;
        $productinquiry->email = $reporterEmail;
        $productinquiry->phone_number = $request->phonenumber;
        $productinquiry->product_inquiries_status = "Download Report";
        $st3 = $productinquiry->save();

        if (!$st3) {
            return redirect()->back()->with('msg12', 'Failed to send a summary report.');
        }else{
            $sendName = $request->name;
            $sendEmail = $request->email;
            $sendTicket = $ticket;

            $data = json_decode($request->tad);

            $pdf = PDF::loadView('compareProducts.report', ['data' => $data]);


            try{
                Mail::send('compareProducts.emailcontent', $data, function($message)use($data,$pdf,$request) {
                $message->to($productinquiry=($request->email), $productinquiry=($request->name), $productinquiry=($request->phonenumber))
                ->subject('Comparison Product Summary Report')
                ->from('info@getpesa.co.tz', 'GetPesa Limited')
                ->attachData($pdf->output(), "compareProducts.pdf");
                });

            }catch(JWTException $exception){
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail";
                $this->statuscode  =   "0";

           }else{

              $this->statusdesc  =   "Message sent Succesfully";
              $this->statuscode  =   "1";
           }
        return redirect()->back()->with('msg12', 'Thank you a copy of this comparison summary will be emailed to the address provided:');
        }
    }

    public function callmerequest(Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'fullname' => 'required',
            'pnumber' => 'required',
            'emailaddress' => 'required',
            'conditionsterms' => 'required',
        ]);
           if($validator -> fails()){
            return redirect('/compare/search/loan')->withErrors($validator)->withInput();
        }
        $productCallMe = new ProductInquiry;
        $productCallMe->full_name = $request->fullname;
        $productCallMe->email = $request->emailaddress;
        $productCallMe->phone_number = $request->pnumber;
        $productCallMe->product_inquiries_status = "Call Me";
        $productCallMe->save();
        return redirect()->back()->with('msgCallMe','Thank you one of our representatives will contact you within 12 hours.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'loantype' => 'required',
            'loan_amount' => 'required',
            'duration' => 'required',
            'net_salary' => 'required',
        ]);

        $loantype =  LoanType::where('id', $request->loantype)->first();

        $comparison = new CompareLoan();
        $comparison->loan_amount = str_replace(',','',$request->loan_amount);
        $comparison->duration = str_replace(',','',$request->duration);
        $comparison->net_salary = str_replace(',','',$request->net_salary);
        $comparison->loan_type_id = $loantype->id;
        $st = $comparison->save();

        if (!$st) {
            return redirect()->back()->with('message', 'Failed to insert data');
        } else {
            return redirect()->back()->with('message', 'Successfully added');
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
        return view('applyRequest.applyrequests');
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

    public function report(Request $request)
    {

        $tad = json_decode($request->tad);

     if($request->view_type === 'downloadPdf'){
       $pdf = PDF::loadView('compareProducts.report', compact('tad'));
       return $pdf->download('compareProducts.pdf');
    }
    }
}



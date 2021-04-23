<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Auth;
use DB;
use App\User;
use App\CompareLoan;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $activity = Auth::user()->activiti;

        $borrower_id = Auth::user()->id;

        $loanscomparisonCount = DB::select('SELECT COUNT(*) as "loanscomparisonCount" FROM compare_loans');

        $applicationsCount = DB::select('SELECT COUNT(*) as "applicationsCount" FROM users');

        $comparisonCount = DB::select('SELECT COUNT(*) as "comparisonCount" FROM loan_rates');

        $numberofInquiriesCount = DB::select('SELECT COUNT(*) as "numberofInquiriesCount" FROM product_inquiries');

        $downloadReportCount = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Download Report')
        ->count();

        $callMeCount = DB::table('product_inquiries')
        ->where('product_inquiries.product_inquiries_status', '=', 'Call Me')
        ->count();

        $numberofSubcribersCount = DB::select('SELECT COUNT(*) as "numberofSubcribersCount" FROM subscribers');

        $totalLoansAssignedCount = DB::select('SELECT COUNT(*) as "totalLoansAssignedCount" FROM loan_request_approves');

        if($activity === 'borrower'){
            $loanappliedCount = DB::table('users')
            ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
            ->join('products', 'loan_rates.product_id', '=', 'products.id')
            ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
            ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.applied_status',
                'users.created_at',
                'loan_rates.product_name',
                'loan_rates.product_code',
                'products.institution_name',
                'loan_types.loan_name',
                'institution_types.institution_type_name'
            )
            ->where('users.applied_status','=','Apply')
            ->where('users.id','=', $borrower_id)
            ->latest()
            ->count();
        }else{
            $loanappliedCount = DB::table('users')
            ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
            ->join('products', 'loan_rates.product_id', '=', 'products.id')
            ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
            ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.applied_status',
                'users.created_at',
                'loan_rates.product_name',
                'loan_rates.product_code',
                'products.institution_name',
                'loan_types.loan_name',
                'institution_types.institution_type_name'
            )
            ->where('users.applied_status','=','Apply')
            ->where('users.id','=', $borrower_id)
            ->latest()
            ->count();
        }

        if($activity === 'borrower'){
            $loanapprovedCount = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->where('loan_request_approves.borrower_id', '=', $borrower_id)
        ->where('loan_request_approves.loan_requests_status','=','Accept')
        ->count();
    }else{
            $loanapprovedCount = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->where('loan_request_approves.borrower_id', '=', $borrower_id)
        ->where('loan_request_approves.loan_requests_status','=','Accept')
        ->count();
    }

    if($activity === 'borrower'){
        $loanRejectCount = DB::table('loan_request_approves')
    ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
    ->where('loan_request_approves.borrower_id', '=', $borrower_id)
    ->where('loan_request_approves.loan_requests_status','=','Reject')
    ->count();
}else{
        $loanRejectCount = DB::table('loan_request_approves')
    ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
    ->where('loan_request_approves.borrower_id', '=', $borrower_id)
    ->where('loan_request_approves.loan_requests_status','=','Reject')
    ->count();
}

    $loanappliedDashboardCount = DB::table('users')
            ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
            ->join('products', 'loan_rates.product_id', '=', 'products.id')
            ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
            ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.applied_status',
                'users.created_at',
                'loan_rates.product_name',
                'loan_rates.product_code',
                'products.institution_name',
                'loan_types.loan_name',
                'institution_types.institution_type_name'
            )
            ->where('users.applied_status','=','Apply')
            ->latest()
            ->count();

    $loanapprovedDashboardCount = DB::table('loan_request_approves')
        ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
        ->where('loan_request_approves.loan_requests_status','=','Accept')
        ->count();

    $allloanRejectedDashboardCount = DB::table('loan_request_approves')
    ->join('users', 'loan_request_approves.borrower_id', '=', 'users.id')
    ->where('loan_request_approves.loan_requests_status','=','Reject')
    ->count();


    $totalLoansCount = DB::select('SELECT COUNT(*) as "totalLoansCount" FROM loan_request_approves');

    $institutionTypeCount = DB::select('SELECT COUNT(*) as "institutionTypeCount" FROM institution_types');

    $loanTypeCount = DB::select('SELECT COUNT(*) as "loanTypeCount" FROM loan_types');

    $numberofusersCount = DB::select('SELECT COUNT(*) as "numberofusersCount" FROM users');

    $compareloans = CompareLoan::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
    				->get();
        $chart = Charts::database($compareloans, 'bar', 'highcharts')
        ->title("Monthly Compare Report")
        ->elementLabel("Number of Comapres")
        ->dimensions(1000, 500)
        ->responsive(true)
        ->groupByMonth(date('Y'), true);

        $systemusers= User::where(DB::raw("(DATE_FORMAT(created_at,'%Y'))"),date('Y'))
        ->get();
            $systemuserchart = Charts::database($systemusers, 'bar', 'highcharts')
            ->title("System Users")
            ->elementLabel("users")
            ->dimensions(1000, 500)
            ->responsive(true)
            ->groupByMonth(date('Y'), true);

            $averagePeriod = DB::table('compare_loans')
            ->latest()
            ->paginate(3)
            ->avg('duration');

            $averageAmount = DB::table('compare_loans')
            ->latest()
            ->paginate(3)
            ->avg('loan_amount');

            $averageNetSalary = DB::table('compare_loans')
            ->latest()
            ->paginate(3)
            ->avg('net_salary');

            $loanRequestApprovesCount = DB::table('loan_request_approves')
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
        ->where('loan_request_approves.loan_requests_status', '=', "Accept")
        ->latest()
        ->count();

        $loanpendingCount = DB::table('loan_request_approves')
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
        ->where('loan_request_approves.borrower_id', '=', $borrower_id)
        ->where('loan_request_approves.loan_requests_status','=','Pending')
        ->latest()
        ->count();

        $singleLoanApprovedByBankersCount = DB::table('loan_request_approves')
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
        ->count();


        $borrowerApplyCount = DB::table('users')
            ->join('loan_rates', 'users.loanrates_id', '=', 'loan_rates.id')
            ->join('products', 'loan_rates.product_id', '=', 'products.id')
            ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
            ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
            ->select(
                'users.id',
                'users.full_name',
                'users.applied_status',
                'users.created_at',
                'loan_rates.product_name',
                'loan_rates.product_code',
                'products.institution_name',
                'loan_types.loan_name',
                'institution_types.institution_type_name'
            )
            ->where('users.applied_status','=','Apply')
            ->where('users.id','=', $borrower_id)
            ->latest()
            ->count();

        $borrowerPendingCount = DB::table('loan_request_approves')
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
        ->where('loan_request_approves.borrower_id', '=', $borrower_id)
        ->where('loan_request_approves.loan_requests_status','=','Pending')
        ->latest()
        ->count();

        $borrowerApprovedCount = DB::table('loan_request_approves')
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
        ->count();

    return view('home')
    ->with('applicationsCount', $applicationsCount)
    ->with('comparisonCount', $comparisonCount)
    ->with('loanappliedCount', $loanappliedCount)
    ->with('loanapprovedCount', $loanapprovedCount)
    ->with('loanRejectCount', $loanRejectCount)
    ->with('loanappliedDashboardCount', $loanappliedDashboardCount)
    ->with('loanapprovedDashboardCount', $loanapprovedDashboardCount)
    ->with('allloanRejectedDashboardCount', $allloanRejectedDashboardCount)
    ->with('numberofInquiriesCount', $numberofInquiriesCount)
    ->with('numberofSubcribersCount', $numberofSubcribersCount)
    ->with('totalLoansAssignedCount', $totalLoansAssignedCount)
    ->with('loanscomparisonCount', $loanscomparisonCount)
    ->with('downloadReportCount', $downloadReportCount)
    ->with('callMeCount', $callMeCount)
    ->with('chart', $chart)
    ->with('systemuserchart', $systemuserchart)
    ->with('totalLoansCount', $totalLoansCount)
    ->with('institutionTypeCount', $institutionTypeCount)
    ->with('loanTypeCount', $loanTypeCount)
    ->with('numberofusersCount', $numberofusersCount)
    ->with('averagePeriod', $averagePeriod)
    ->with('averageAmount', $averageAmount)
    ->with('averageNetSalary', $averageNetSalary)
    ->with('loanRequestApprovesCount', $loanRequestApprovesCount) 
    ->with('loanpendingCount', $loanpendingCount)
    ->with('singleLoanApprovedByBankersCount', $singleLoanApprovedByBankersCount)
    ->with('borrowerApplyCount', $borrowerApplyCount)
    ->with('borrowerPendingCount', $borrowerPendingCount)
    ->with('borrowerApprovedCount', $borrowerApprovedCount);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\LoanType;
use App\Duration;
use App\LoanRate;
use DB;
use App\LoanPurpose;
use Auth;
class LoanRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_loanrate')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $loanrate = DB::table('loan_rates')
        ->join('products', 'loan_rates.product_id', '=', 'products.id')
        ->join('loan_types', 'loan_rates.loan_type_id', '=', 'loan_types.id')
        ->join('durations', 'loan_rates.duration_id', '=', 'durations.id')
        ->select(
            'loan_rates.id',
            'products.institution_name',
            'loan_types.loan_name',
            'loan_rates.product_name',
            'loan_rates.product_code',
            'loan_rates.minimum_net_salary',
            'loan_rates.minimum_amount',
            'loan_rates.maxmum_amount',
            'loan_rates.turn_around_time',
            'loan_rates.facility_rate',
            'loan_rates.insurance_rate',
            'loan_rates.eligibility',
            'loan_rates.loan_option',
            'loan_rates.created_at')
        ->latest()
        ->get();

        return view('manageProductUploads.viewloanrates')
        ->with('loanrates', $loanrate);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_loanrate')) {
                return $next($request);
            }
            return redirect()->back();
        });
            $productType = DB::table('products')
            ->select('id', 'institution_name')
            ->get();

            $loanType = DB::table('loan_types')
            ->select('id', 'loan_name')
            ->get();

            $duration = DB::table('durations')
            ->select('id', 'duration_name')
            ->get();

            $loanpurpose = DB::table('loan_purposes')
            ->select('id', 'loan_purpose_name')
            ->get();

        return view('manageProductUploads.addloanrates')
        ->with('productType', $productType)
        ->with('loanType', $loanType)
        ->with('duration', $duration)
        ->with('loanpurposes', $loanpurpose);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_loanrate')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $this->validate(request(), [
            'product_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|alpha_num',
            'loan_type_id' => 'required',
            'duration' => 'required',
            'loanpurpose' => 'required',
            'interest_rate' => 'required',
            'minimum_salary' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
            'turn_time' => 'required',
            'facility_fee' => 'required',
            'insurance_rate' => 'required',
            'eligibility' => 'required',
            'loanpurchase' => 'required',
        ]);

        $productType =  Product::where('institution_name', $request->product_id)->first();
        $loanType =  LoanType::where('loan_name', $request->loan_type_id)->first();
        $duration =  Duration::where('id', $request->duration)->first();
        $loanpurpose =  LoanPurpose::where('loan_purpose_name', $request->loanpurpose)->first();

        $loanRate = new LoanRate();
        $loanRate->product_id = $productType->id;
        $loanRate->product_name = $request->product_name;
        $loanRate->product_code = $request->product_code;
        $loanRate->loan_type_id = $loanType->id;
        $loanRate->duration_id  = $duration->id;
        $loanRate->user_id  = Auth::user()->id;
        $loanRate->loanpurpose_type_id = $loanpurpose->id;
        $loanRate->interest_rate = $request->interest_rate;
        $loanRate->minimum_net_salary = $request->minimum_salary;
        $loanRate->minimum_amount = $request->minimum_amount;
        $loanRate->maxmum_amount = $request->maximum_amount;
        $loanRate->turn_around_time = $request->turn_time;
        $loanRate->facility_rate = $request->facility_fee;
        $loanRate->insurance_rate = $request->insurance_rate;
        $loanRate->eligibility = $request->eligibility;
        $loanRate->loan_purchase = $request->loanpurchase;
        $st = $loanRate->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Upload Product');
        } else {
            return redirect()->back()->with('message', 'Upload Product is successfully');
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
        $productUpload = LoanRate::findOrFail($id);

        $productTypes = DB::table('products')
        ->get();

        $loanTypes = DB::table('loan_types')
        ->get();

        $durations = DB::table('durations')
        ->get();

        return view('manageProductUploads.editproductuploads')
        ->with('productTypes', $productTypes)
        ->with('loanTypes', $loanTypes)
        ->with('durations', $durations)
        ->with('productUploads', $productUpload);
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
        $this->validate(request(), [
            'product_id' => 'required',
            'product_name' => 'required',
            'product_code' => 'required|alpha_num',
            'loan_type_id' => 'required',
            'duration_id' => 'required',
            'interest_rate' => 'required',
            'minimum_salary' => 'required',
            'minimum_amount' => 'required',
            'maximum_amount' => 'required',
            'turn_time' => 'required',
            'facility_fee' => 'required',
            'insurance_rate' => 'required',
            'loanpurchase' => 'required',
        ]);

        $productUpload = LoanRate::findOrFail($id);

        $productTypesData  = DB::table('products')->select('id', 'institution_name')->where('id', '=', $request->product_id)->value('product_id');

        $loanTypeData  = DB::table('loan_types')->select('id', 'loan_name')->where('id', '=', $request->loan_type_id)->value('loan_type_id');

        $durationData  = DB::table('durations')->select('id', 'duration_name')->where('id', '=', $request->duration_id)->value('duration_id');

        $productUpload->product_id = $productTypesData;
        $productUpload->product_name = $request->product_name;
        $productUpload->product_code = $request->product_code;
        $productUpload->loan_type_id = $loanTypeData;
        $productUpload->duration_id  = $durationData;
        $productUpload->interest_rate = $request->interest_rate;
        $productUpload->minimum_net_salary = $request->minimum_salary;
        $productUpload->minimum_amount = $request->minimum_amount;
        $productUpload->maxmum_amount = $request->minimum_amount;
        $productUpload->turn_around_time = $request->turn_time;
        $productUpload->facility_rate = $request->facility_fee;
        $productUpload->insurance_rate = $request->insurance_rate;
        $productUpload->loan_purchase = $request->loanpurchase;
        $st = $productUpload->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update Product data');
        } else {
            return redirect()->back()->with('message', 'Product is successfully updated');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $product = LoanRate::findOrFail($id);
        $product->delete();

        $request->session()->flash('message', 'Product is successfully deleted');
        return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InstitutionType;
use App\LoanType;
use App\Duration;
use App\Product;
use DB;

class ProductUploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_product')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $productData = DB::table('products')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')

        ->select('products.id',
        'products.institution_name',
        'institution_types.institution_type_name',
        'products.institution_logo',
        'products.institution_street_city',
        'products.institution_contact_email',
        'products.institution_contact_phone_number',
        'products.institution_social_media_links',
        'products.created_at',
        'products.updated_at')
        ->latest()
        ->get();

        $count=1;
        $count2=1;

        $search_loanType  = DB::table('loan_types')
        ->select('id','loan_name')
        ->get();

        $search_institutiontype  = DB::table('institution_types')
        ->select('id','institution_type_name')
        ->get();

        $search_duration  = DB::table('durations')
        ->select('id','duration_name')
        ->get();

        return view('manageInstitutionUploads.viewproductuploads')
        ->with('productDatas', $productData)
        ->with('search_loanType', $search_loanType)
        ->with('search_institutiontype', $search_institutiontype)
        ->with('search_duration', $search_duration)
        ->with('count', $count)
        ->with('count2', $count2);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_product')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $institutionType = DB::table('institution_types')
            ->select('id', 'institution_type_name')
            ->get();

        $duration = DB::table('durations')
            ->select('id', 'duration_name')
            ->get();

        $loantype = DB::table('loan_types')
            ->select('id', 'loan_name')
            ->get();

        return view('manageInstitutionUploads.addproductuploads')
        ->with('institutionTypes', $institutionType)
        ->with('durations', $duration)
        ->with('loantypes', $loantype);
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
            if (\Auth::user()->can('create_product')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $this->validate(request(), [
            'institution_name' => 'required',
            'institution_type_id' => 'required',
            'institution_logo' => 'mimes:jpeg,jpg,png|required|max:2048',
            'institution_street_city' => 'required',
            'institution_contact_email' => 'required',
            'institution_contact_phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'institution_social_media_links' => 'nullable',
        ]);

        $institutionType =  InstitutionType::where('institution_type_name', $request->institution_type_id)->first();

        $product = new Product();
        $product->institution_name = $request->institution_name;
        $product->institution_type_id = $institutionType->id;
        $product->institution_logo = $request->institution_logo->store('InstitutionLogo', 'public');
        $product->institution_street_city = $request->institution_street_city;
        $product->institution_contact_email = $request->institution_contact_email;
        $product->institution_contact_phone_number = $request->institution_contact_phone_number;
        $product->institution_social_media_links = $request->institution_social_media_links;
        $st = $product->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to upload Institution data');
        } else {
            return redirect()->back()->with('message', 'Institution is successfully uploaded');
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
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('edit_product')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $product = Product::findOrFail($id);

        $institutionType =  InstitutionType::all();

        return view('manageInstitutionUploads.editproductuploads')
        ->with('products', $product)
        ->with('institutionTypes', $institutionType);
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
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('update_product')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $this->validate(request(), [
            'institution_name' => 'required',
            'institution_type_id' => 'required',
            'institution_street_city' => 'required',
            'institution_contact_email' => 'required',
            'institution_contact_phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12',
            'institution_social_media_links' => 'required',
        ]);

        $product = Product::findOrFail($id);
        $institutionType =  InstitutionType::where('institution_type_name', $request->institution_type_id)->first();

        $product->institution_name = $request->institution_name;
        $product->institution_type_id = $institutionType->id;
        $product->institution_street_city = $request->institution_street_city;
        $product->institution_contact_email = $request->institution_contact_email;
        $product->institution_contact_phone_number = $request->institution_contact_phone_number;
        $product->institution_social_media_links = $request->institution_social_media_links;
        $st = $product->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update Institution data');
        } else {
            return redirect()->back()->with('message', 'Institution is successfully updated');
        }
    }


    public function search_by_loanType()
    {
        $productData = DB::table('products')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('durations', 'products.duration_id', '=', 'durations.id')
        ->join('loan_types', 'products.loan_type_id', '=', 'loan_types.id')
        ->select(
        'products.id',
        'loan_types.loan_name',
        'products.institution_name',
        'institution_types.institution_type_name',
        'products.institution_logo',
        'products.institution_street_city',
        'products.institution_contact_email',
        'products.institution_contact_phone_number',
        'products.institution_social_media_links',
        'products.product_name',
        'products.product_code',
        'products.interest_rate',
        'products.minimum_amount',
        'products.maximum_amount',
        'durations.duration_name',
        'products.insurance_fee',
        'products.loan_processing_fee',
        'products.minimum_net_salary',
        'products.turn_around_time',
        'products.created_at')
        ->where('products.loan_type_id', '=', $_POST['loantype'])
        ->get();

        $count=1;
        $count2=2;

        return view('manageInstitutionUploads.viewproductuploads')
        ->with('productDatas', $productData)
        ->with('count', $count)
        ->with('count2', $count2);
    }


    public function search_by_institutionType()
    {
        $productData = DB::table('products')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('durations', 'products.duration_id', '=', 'durations.id')
        ->join('loan_types', 'products.loan_type_id', '=', 'loan_types.id')
        ->select(
        'products.id',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'products.institution_name',
        'products.institution_logo',
        'products.institution_street_city',
        'products.institution_contact_email',
        'products.institution_contact_phone_number',
        'products.institution_social_media_links',
        'products.product_name',
        'products.product_code',
        'products.interest_rate',
        'products.minimum_amount',
        'products.maximum_amount',
        'durations.duration_name',
        'products.insurance_fee',
        'products.loan_processing_fee',
        'products.eligibility',
        'products.minimum_net_salary',
        'products.turn_around_time',
        'products.loan_option',
        'products.created_at')
        ->where('products.institution_type_id', '=', $_POST['institutiontype'])
        ->get();

        $count=1;
        $count2=2;

        return view('manageInstitutionUploads.viewproductuploads')
        ->with('productDatas', $productData)
        ->with('count', $count)
        ->with('count2', $count2);
    }


    public function search_by_durationType()
    {
        $productData = DB::table('products')
        ->join('institution_types', 'products.institution_type_id', '=', 'institution_types.id')
        ->join('durations', 'products.duration_id', '=', 'durations.id')
        ->join('loan_types', 'products.loan_type_id', '=', 'loan_types.id')
        ->select(
        'products.id',
        'durations.duration_name',
        'institution_types.institution_type_name',
        'loan_types.loan_name',
        'products.institution_name',
        'products.institution_logo',
        'products.institution_street_city',
        'products.institution_contact_email',
        'products.institution_contact_phone_number',
        'products.institution_social_media_links',
        'products.product_name',
        'products.product_code',
        'products.interest_rate',
        'products.minimum_amount',
        'products.maximum_amount',
        'products.insurance_fee',
        'products.loan_processing_fee',
        'products.eligibility',
        'products.minimum_net_salary',
        'products.turn_around_time',
        'products.loan_option',
        'products.created_at')
        ->where('products.duration_id', '=', $_POST['duration'])
        ->get();

        $count=1;
        $count2=2;

        return view('manageInstitutionUploads.viewproductuploads')
        ->with('productDatas', $productData)
        ->with('count', $count)
        ->with('count2', $count2);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('delete_product')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $product = Product::findOrFail($id);
        $product->delete();
        $request->session()->flash('message', 'Institution is successfully deleted');
        
        return back();
    }
}

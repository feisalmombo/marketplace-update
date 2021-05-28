<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use DB;
use App\Role;
use App\Permission;
use App\UserStatus;
use Excel;
use App\ActivityLog;
use App\LoanRequestApprove;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;
use App\City;

class ViewUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $customer_id = Auth::id();

        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $userData = DB::select(
            "SELECT
            users.id,
            users.full_name,
            users.email,
            users.phone_number,
            roles.slug,
            users.government_id_number,
            cities.city_name AS city,
            users.date_of_birth,
            users.userphoto_path,
            users.created_at
        FROM
            users,
            roles,
            users_roles,
            cities
        WHERE
            users_roles.role_id = roles.id
            AND users_roles.user_id = users.id
            AND users.id = $customer_id
            AND users.city_id = cities.id
        ORDER BY users.id DESC"
        );
        return view('manageUser.viewuser')->with('userData', $userData);
    }

    public function allSystemsUsers()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('view_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $userData = DB::select(
            "SELECT
            users.id,
            users.full_name,
            users.email,
            users.phone_number,
            roles.slug,
            users.government_id_number,
            cities.city_name AS city,
            users.date_of_birth,
            users.userphoto_path,
            users.created_at
        FROM
            users,
            roles,
            users_roles,
            cities
        WHERE
            users_roles.role_id = roles.id
            AND users_roles.user_id = users.id
            AND users.city_id = cities.id
        ORDER BY users.id DESC"
        );
        return view('manageUser.viewallsystemUsers')
        ->with('userData', $userData);
    }

    public function personalInfo()
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('person_info')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $personalData = DB::select(
            "SELECT
            users.id,
            users.full_name,
            users.email,
            users.phone_number,
            users.government_id_number,
            cities.city_name AS city,
            users.date_of_birth,
            roles.slug,
            users.created_at
        FROM
            users,
            roles,
            users_roles,
            cities
        WHERE
            users_roles.role_id = roles.id
            AND users_roles.user_id = users.id
            AND users.city_id = cities.id
        ORDER BY users.id DESC"
        );

        return view('accountInfo.personalinfo')->with('personalDatas', $personalData);
    }

    public function getloanRequests()
    {
        $loanrequests = DB::table('users')
        ->where('users.applied_status','=','Apply')
        ->latest()
        ->get();

        return view('loanRequests.viewloanrequests')
        ->with('loanrequests', $loanrequests);
    }

    public function showloanRequests($id)
    {
        $loanrequest = User::findOrFail($id);

        return view('loanRequests.showloanrequests')
        ->with('loanrequest', $loanrequest)
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
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('create_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $role = DB::table('roles')
            ->select('id', 'slug')
            ->get();

        $cities = DB::table('cities')
            ->select('id', 'city_name')
            ->get();

        return view('manageUser.createuser')
        ->with('roles', $role)
        ->with('cities', $cities);
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
            if (\Auth::user()->can('create_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $this->validate(request(), [
            'fullname' => 'required|string|max:255',
            'phonenumber' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:13',
            'dob' => 'required',
            'nidanumber' => 'required',
            'cityID' => 'required',
            'privilege' => 'required',
        ]);

        $dev_role = Role::where('slug', $request->privilege)->first();
        $dev_perm = Permission::where('slug', 'create')->first();

        $citiesData = City::where('city_name', $request->cityID)->first();

        $users = new User();
        $users->full_name = $request->fullname;
        $user_email = $users->email = strtolower($request->fullname)."@marketplace.co.tz";
        $users->phone_number = $request->phonenumber;
        $users->date_of_birth = $request->dob;
        $users->government_id_number = $request->nidanumber;
        $users->city_id = $citiesData->id;
        $users->password = bcrypt('marketplace');
        $st = $users->save();
        $users->roles()->attach($dev_role);
        $users->permissions()->attach($dev_perm);
        $userstatus = new UserStatus();
        $userstatus->user_id = $users->id;
        $userstatus->slug = false;
        $userstatus->save();
        if (!$st) {
            return redirect('/view-users/create')->with('message', 'Failed to insert User data');
        }
        return redirect('/view-users/create')->with('message', 'User is successfully added with email:' . strtolower($user_email) . '  Password: ' . 'marketplace');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $customer_id = Auth::user()->id;

        $userProfile = DB::select(
            "SELECT
            users.id,
            users.full_name,
            users.email,
            users.phone_number,
            users.date_of_birth,
            users.government_id_number,
            users.userphoto_path,
            cities.city_name AS city,
            roles.slug,
            users.created_at
        FROM
            users,
            roles,
            users_roles,
            cities
        WHERE
            users_roles.role_id = roles.id
            AND users_roles.user_id = users.id
            AND users.city_id = cities.id
            AND users.id = $customer_id"
        );

        return view('manageUser.showuserProfile')
        ->with('userProfile', $userProfile);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('edit_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $user = User::findOrFail($id);
        $leve = Role::all();

        $cities = DB::table('cities')
        ->select('id', 'city_name')
        ->get();

        return view('manageUser.edituser')
        ->with('users', $user)
        ->with('leve', $leve)
        ->with('cities', $cities);
    }

    public function resetpwd($id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('reset_password')) {
                return $next($request);
            }
            return redirect()->back();
        });

        $user = User::findOrFail($id);
        $st = User::findOrFail($id)->update(['password' => bcrypt('123456')]);
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Reset User Password for ' . $user->first_name);
        }

        return redirect('/view-users')->with('message', 'Password is Successfully Reseted to 123456 for User  ' . $user->first_name);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('edit_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $user = User::findOrFail($id);
        $this->validate(request(), [
            'fullname' => 'required',
            'useremail' => 'required',
            'phonenumber' => 'required',
            'dob' => 'required',
            'nidanumber' => 'required',
            'cityID' => 'required',
            'userprofile' => 'mimes:jpeg,jpg,png|required|max:2048',
        ]);

        $citiesData = City::where('city_name', $request->cityID)->first();

        $user->full_name = $request->fullname;
        $user->email = $request->useremail;
        $user->phone_number = $request->phonenumber;
        $user->date_of_birth = $request->dob;
        $user->government_id_number = $request->nidanumber;
        $user->city_id = $citiesData->id;
        $user->userphoto_path = $request->userprofile->store('Userprofilephoto', 'public');
        $st = $user->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to Update User data');
        }

        return redirect('/view-users')->with('message', 'User is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('delete_user')) {
                return $next($request);
            }
            return redirect()->back();
        });
        $uid = \Auth::id();
        $user = User::findOrFail($id);
        $user->delete();
        ActivityLog::where('changetype', 'Delete User')->update(['user_id' => $uid]);


        $request->session()->flash('message', 'User is successfully deleted');
        return back();
    }

    public function report(Request $request)
    {
        $str_var = $_POST['tad'];
        $userData = unserialize(base64_decode($str_var));

        if ($request->view_type === 'downloadPdf') {
            $pdf = PDF::loadView('manageUser.report', ['userData' => $userData]);
            return $pdf->download('users.pdf');
        }
    }

    public function downloadExcel(Request $request)
    {
        $str_var = $_POST['tadas'];
        $data = unserialize(base64_decode($str_var));

        $count = 0;
        // Initialize the array which will be passed into the Excel
        // generator.
        $userArray = [];

        // Define the Excel spreadsheet headers
        $userArray[] = ['S/N', 'FULL NAME', 'EMAIL', 'PHONE NUMBER' ,'PRIVILEGE'];

        // Convert each member of the returned collection into an array,
        // and append it to the atms array.
        foreach ($data as $datas) {
            $count++;
            $userArray[] = [$count, $datas->full_name, $datas->email, $datas->phone_number, $datas->slug];
        }


        // Generate and return the spreadsheet
        Excel::create('User(s)', function ($excel) use ($userArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('User');
            $excel->setCreator(\Auth::user()->full_name . ' ' . \Auth::user()->full_name)->setCompany('GetPesa PLC');
            $excel->setDescription('User file');

            // Build the spreadsheet, passing in the task array
            $excel->sheet('sheet1', function ($sheet) use ($userArray) {
                $sheet->fromArray($userArray, null, 'A1', false, false);
            });
        })->download('xlsx');
    }
}

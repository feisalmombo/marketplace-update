<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use App\Permission;
use App\User;
use DB;
use Excel;
use Barryvdh\DomPDF\Facade as PDF;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (\Auth::user()->can('manage_privileges')) {
                return $next($request);
            }
            return redirect()->back();
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = DB::table('roles')
            ->select('id', 'slug', 'name', 'created_at')
            ->latest()
            ->get();

        return view('admin.roles.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::All();
        return view('admin.roles.entrust_user', compact('users'));
    }
    public function add()
    {
        $permissions = Permission::All();
        return view('admin.roles.create', compact('permissions'));
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
        //
    }
    public function get_roles(Request $request)
    {
        $roles = Role::All();
        $id = $_GET['user'];
        $users = User::where('id', $id)->with('roles')->first();
        return json_encode([$users, $roles]);
    }
    public function post_roles(Request $request)
    {
        $user = User::where('id', $request->users)->with('roles')->first();
        $arr = $request->role;
        $ar = array();
        foreach ($user as $key => $users) {
            if (!empty($arr)) {
                foreach ($arr as $key => $role) {
                    foreach ($user->roles as $key => $value) {

                        if ($value->id == $role) {
                            $user->deleteRoles($value->id);
                        }
                        $user->deleteRoles($value->id);
                    }
                }
                $check = $user->giveRolesTo($arr);
                if ($check) {

                    return redirect()->back()->with('message', 'successfull entrusted');
                } else {
                    return redirect()->back()->with('message', 'There Was an error during entrusting Role(s)');
                }
            } else {
                foreach ($user->roles as $key => $value) {
                    $user->deleteRoles($value->id);
                }
                return redirect()->back()->with('message', 'User was successfull detached with Role(s)');
            }
        }

    }

    public function report(Request $request)
    {
        $roles = Role::all();

        if ($request->view_type === 'downloadPdf') {
            $pdf = PDF::loadView('admin.roles.report', ['roles' => $roles]);
            return $pdf->download('roles.pdf');
        }
    }

    public function downloadExcel(Request $request)
    {
        $count = 0;
        $roles = Role::all();

        $rolesArray = array();

        foreach ($roles as $role) {
            $count++;
            $rolesArray[] = array(
                'S/N' => $count,
                'Name' => $role->name,
                'Descriptions' => $role->slug,
                'Created Day' => ($role->created_at)->diffForHumans(),
            );
        }
        $rolesArray[] = array(

            'S/N' => '',
            'Name' => '',
            'Descriptions' => '',
            'Created Day' => '',
        );


        Excel::create('Report for Role', function ($excel) use ($rolesArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Role Report');
            $excel->setCreator(\Auth::user()->first_name . ' ' . \Auth::user()->last_name)->setCompany('UmojaSwitch Company Limited');
            $excel->setDescription('Role file');
            $excel->sheet('mySheet', function ($sheet) use ($rolesArray) {
                $sheet->fromArray($rolesArray);
            });
        })->download('xlsx');
    }
}

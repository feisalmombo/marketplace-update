<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use App\Role;
use Auth;
use DB;
use App\User;
use Excel;
use Barryvdh\DomPDF\Facade as PDF;

class PermissionsController extends Controller
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
        $permissions = DB::table('permissions')
            ->select('id', 'slug', 'name', 'created_at')
            ->latest()
            ->get();

        return view('admin.permissions.index', compact('permissions'));
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

    public function entrust_user(Request $request)
    {
        $permissions = Permission::All();
        $users = User::with('permissions')->get();

        return view('admin.permissions.entrust_user', compact('permissions', 'users'));
    }
    public function entrust(Request $request)
    {
        $permissions = Permission::All();
        $id = $_GET['user'];
        $users = User::where('id', $id)->with('permissions')->first();

        return json_encode([$users, $permissions]);
    }
    public function entrust_user_permissions(Request $request)
    {
        $user = User::where('id', $request->users)->with('permissions')->first();
        $arr = $request->permission;
        $ar = array();
        foreach ($user as $key => $users) {
            if (!empty($arr)) {
                foreach ($arr as $key => $permission) {
                    foreach ($user->permissions as $key => $value) {

                        if ($value->id == $permission) {
                            $user->deletePermissions($value->id);
                        }
                        $user->deletePermissions($value->id);
                    }
                }
                $check = $user->givePermissionsTo($arr);
                if ($check) {

                    return redirect()->back()->with('message', 'successfull entrusted');
                } else {
                    return redirect()->back()->with('message', 'There Was an error during entrusting permission(s)');
                }
            } else {
                foreach ($user->permissions as $key => $value) {
                    $user->deletePermissions($value->id);
                }
                return redirect()->back()->with('message', 'User was successfull detached with Permission(s)');
            }
        }




    }
    public function entrust_role()
    {
        $roles = Role::All();
        return view('admin.permissions.entrust_role', compact('roles'));
    }
    public function entrust_roles()
    {
        $permissions = Permission::All();
        $id = $_GET['role'];
        $roles = Role::where('id', $id)->with('permissions')->first();
        return json_encode([$roles, $permissions]);
    }
    public function entrust_role_permissions(Request $request)
    {
        $role = Role::where('id', $request->roles)->with('permissions')->first();
        $arr = $request->permission;
        $ar = array();
        foreach ($role as $key => $roles) {
            if (!empty($arr)) {
                foreach ($arr as $key => $permission) {
                    foreach ($role->permissions as $key => $value) {
                        
                        if ($value->id == $permission) {
                            $role->deletePermissions($value->id);
                        }
                        $role->deletePermissions($value->id);
                    }
                }
                $check = $role->givePermissionsTo($arr);
                if ($check) {

                    return redirect()->back()->with('message', 'successfull entrusted');
                } else {
                    return redirect()->back()->with('message', 'There Was an error during entrusting permission(s)');
                }
            } else {
                foreach ($role->permissions as $key => $value) {
                    $role->deletePermissions($value->id);
                }
                return redirect()->back()->with('message', 'Role was successfull detached with Permission(s)');
            }
        }

    }


    public function report(Request $request)
    {
        $permissions = Permission::all();

        if ($request->view_type === 'downloadPdf') {
            $pdf = PDF::loadView('admin.permissions.report', ['permissions' => $permissions]);
            return $pdf->download('permissions.pdf');
        }
    }

    public function downloadExcel(Request $request)
    {
        $count = 0;
        $permissions = Permission::all();

        $permissionsArray = array();

        foreach ($permissions as $permission) {
            $count++;
            $permissionsArray[] = array(
                'S/N' => $count,
                'Name' => $permission->name,
                'Descriptions' => $permission->slug,
                'Created Day' => ($permission->created_at)->diffForHumans(),
            );
        }
        $permissionsArray[] = array(

            'S/N' => '',
            'Name' => '',
            'Descriptions' => '',
            'Created Day' => '',
        );


        Excel::create('Report for Permission', function ($excel) use ($permissionsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Permission Report');
            $excel->setCreator(\Auth::user()->first_name . ' ' . \Auth::user()->last_name)->setCompany('UmojaSwitch Company Limited');
            $excel->setDescription('Permission file');
            $excel->sheet('mySheet', function ($sheet) use ($permissionsArray) {
                $sheet->fromArray($permissionsArray);
            });
        })->download('xlsx');
    }
}

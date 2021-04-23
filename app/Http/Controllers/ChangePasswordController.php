<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\UserStatus;
use App\User;
use App\ChangePassword;


class ChangePasswordController extends Controller
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
        return view('auth.passwords.changepassword');
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
     * @param  \App\ChangePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function show(ChangePassword $changePassword)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ChangePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function edit(ChangePassword $changePassword)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ChangePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::find(Auth::id());
        $pass = $user->password;

        $this->validate(request(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'conf_password' => 'required|min:6',
        ]);

        if (strcmp($request->new_password, $request->conf_password) == 0) {
            if (Hash::check($request->old_password, $pass)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();

                return redirect()->back()->with('message', 'Your password has been changed.');
            } else {
                $request->session()->flash('message', 'Your new or current password   is incorrect.');
                return back();
            }
        } else {
            $request->session()->flash('message', 'Your new password does not match.');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ChangePassword  $changePassword
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChangePassword $changePassword)
    {
        //
    }
    public function updateNewuser(Request $request, User $user)
    {
        $user = User::find(Auth::id());
        $pass = $user->password;

        $this->validate(request(), [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'conf_password' => 'required|min:6',
        ]);

        if (strcmp($request->new_password, $request->conf_password) == 0) {
            $status = UserStatus::where('user_id', $user->id)->first();
            $newstatus = new UserStatus();
            if (Hash::check($request->old_password, $pass)) {
                $user->fill([
                    'password' => Hash::make($request->new_password)
                ])->save();

                $status->slug = true;
                $status->save();

                return redirect('/home')->with('message', 'Your password has been changed.');
            } else {
                $request->session()->flash('message', 'Your new or current password   is incorrect.');
                return back();
            }
        } else {
            $request->session()->flash('message', 'Your new password does not match.');
            return redirect()->back();
        }
    }
}

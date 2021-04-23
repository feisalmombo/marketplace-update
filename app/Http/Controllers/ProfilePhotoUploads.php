<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProfilephotoUpload;
use Auth;
use DB;

class ProfilePhotoUploads extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = Auth::id();

        $profilephotos = DB::table('profilephoto_uploads')
        ->join('users', 'profilephoto_uploads.user_id', '=', 'users.id')
        ->select(
            'profilephoto_uploads.id',
            'profilephoto_uploads.profile_image_path',
            'profilephoto_uploads.user_id',
            'profilephoto_uploads.created_at'
        )
        ->where('profilephoto_uploads.user_id',$user_id)
        ->latest()
        ->paginate(1);
        return view('manageProfilephotoUploads.profilephotouploads')
        ->with('profilephotos', $profilephotos);
    }

    public function profileNavbar()
    {
        $user_id = Auth::id();


        $profilephotos = DB::table('profilephoto_uploads')
        ->join('users', 'profilephoto_uploads.user_id', '=', 'users.id')
        ->select(
            'profilephoto_uploads.id',
            'profilephoto_uploads.profile_image_path',
            'profilephoto_uploads.user_id',
            'profilephoto_uploads.created_at'
        )
        ->where('profilephoto_uploads.user_id',$user_id)
        ->latest()
        ->get();
        return view('partials.navbar')
        ->with('profilephotos', $profilephotos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manageProfilephotoUploads.addprofileuploads');
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
            'profilephoto' => 'mimes:jpeg,jpg,png|required|max:2048',
        ]);

        $profilePhoto = new ProfilephotoUpload();
        $profilePhoto->profile_image_path = $request->profilephoto->store('ProfilePhoto', 'public');
        $profilePhoto->user_id = Auth::user()->id;
        $st = $profilePhoto->save();
        if (!$st) {
            return redirect()->back()->with('message', 'Failed to upload profile photo');
        } else {
            return redirect()->back()->with('message', 'Profile photo is successfully uploaded');
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
}

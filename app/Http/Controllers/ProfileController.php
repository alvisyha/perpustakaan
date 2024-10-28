<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function admin()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

    public function aboutUs()
    {
        $user = auth()->user();
        return view('about');
    }

    public function editProfile() {
        $user = auth()->user();
        // dd($user);
        if($user->role == 'admin' || $user->role == 'karyawan') {
            return view('admin.profile.edit', compact('user'));
        } else {
            return view('profile.edit', compact('user'));
        }
    }

    public function updateProfile(Request $request) {
        $user = auth()->user();
        $user_id = $request->user_id;
        $input = $request->all();

        // dd($request);
        $updated = User::find($user_id)->update($input);
        if($user->role == 'admin' || $user->role == 'karyawan') {
            return redirect("/dashboard/profile");
        } else {
            return redirect("/profile");
        }
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
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}

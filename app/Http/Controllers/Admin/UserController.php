<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Activity;
use App\User;
use App\Http\Requests\UpdateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('accept');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(25);
        return view('admin.user.index', compact('users'));
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function activity($uuid)
    {
        $activities = Activity::orderByDesc('id')->paginate(25);
        return view('admin.activity', compact('activities'));
    }

    /**
     * Display the specified resource.
     *
     * @param  uuid  $uuid
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        $user = User::findOrFail($uuid);
        $roles = Role::all();
        $activities = Activity::where('causer_id', $user->uuid)
            ->orderByDesc('id')->paginate(25);
        return view('admin.user.show',
            compact(
                'activities',
                'roles',
                'user'
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        $user = User::findOrFail($uuid);
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request)
    {
        $validated = $request->validated();
        
        $user = User::findOrFail($request->input('user_uuid'));
        $user->gender = $request->input('user_gender');
        $user->fname = $request->input('user_fname');
        $user->mname = $request->input('user_mname');
        $user->lname = $request->input('user_lname');
        $user->email = $request->input('user_email');
        $user->password = Hash::make($request->input('user_password'));
        $user->save();
        return redirect()->route('admin.user.show', ['uuid' => $user->uuid]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function permission(Request $request)
    {
        $user = User::findOrFail($uuid);
        $role = $request->input('role');
        $user->assignRole($role);
        return redirect()->route('admin.user.show', ['uuid' => $user->uuid]);
    }
	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
    }
}

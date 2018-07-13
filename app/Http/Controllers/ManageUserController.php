<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Redirect;
use Auth;

class ManageUserController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return Redirect::to('/login');
        }
        if (Auth::check() && User::isSuperAdmin(Auth::user())) {
            return view('users.index');
        }
        if (!User::isSuperAdmin(Auth::user())) {
            return Redirect::to('');
        }
    }

    public function getAllUsers()
    {
        return User::get();
    }

    public function activateUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_active = 1;
        $user->save();
    }

    public function disabledUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->is_active = 0;
        $user->save();
    }

    public function changeToAdmin($id)
    {
        $user = User::where('id', $id)->first();
        $user->roleId = User::ADMIN_ID;
        $user->save();
    }

    public function changeToUser($id)
    {
        $user = User::where('id', $id)->first();
        $user->roleId = User::COMMON_USER;
        $user->save();
    }
}

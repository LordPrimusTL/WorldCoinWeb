<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function Dashboard()
    {
        //dd(Auth::user());
        return view('User.dashboard',['title' => "Dashboard"]);
    }

    public function Profile()
    {
        return view('User.profile',['title' => 'Profile']);
    }

    public function Account()
    {
        return view('User.Account.dashboard',['title' => 'Accounts']);
    }
}

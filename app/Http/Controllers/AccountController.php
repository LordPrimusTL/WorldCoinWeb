<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    //
    public function Register()
    {
        return view('Account.register',['title' => 'Register']);
    }

    public function Login()
    {
        return view('Account.login',['title' => 'Login']);
    }


    //Post
    public function RegisterPost(Request $request)
    {
        dd($request->all());
    }

    public function LoginPost(Request $request)
    {
        dd($request->all());
    }
}

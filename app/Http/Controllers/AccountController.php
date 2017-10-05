<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    private function getLogger()
    {
        return new Logger();
    }

    //GET
    public function Register()
    {
        return view('Account.register',['title' => 'Register']);
    }

    public function Login()
    {
        Auth::logout();
        return view('Account.login',['title' => 'Login']);
    }


    //Post
    public function RegisterPost(Request $request)
    {
        $this->validate($request,
            [
               'fullname' => 'required',
               'reg_type' => 'required',
               'pay_type' => 'required',
                'email' => 'required|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required|same:password'


            ],
            ['confirm_password.same' => '  Passwords Does Not Match']
        );
        //dd($request->all());
        $u = new User();
        $u->fullname = $request->fullname;
        $u->email = $request->email;
        $u->password = Hash::make($request->password);
        $u->referrer_id = $request->referrer;
        $u->class_id = 0;
        $u->r_mark = 0;
        $u->r_link = explode(' ', $request->fullname)[0] . time();
        $u->payment_id = $request->pay_type;
        try{
            $u->save();
            Log::info('Account Created',['user' => $u]);
            Session::flash('success','An Activation Email Has Been Sent To The Email You Provided');
            //Send Mail
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Registration Error', $ex,['User' => $u]);
            Session::flash('error','Oops, An Error Occurred. Please Try again Later');
        }
        return redirect()->back();
    }

    public function LoginPost(Request $request)
    {
        //dd($request->all());
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password]))
        {
            //dd(Auth::user());
            if(Auth::user()->is_active)
            {
                if(Auth::user()->role_id == 3)
                {
                    return redirect()->action('UserController@Dashboard');
                }

                if(Auth::user()->role_id < 3)
                {
                    return redirect()->action('AdminController@Dashboard');
                }
            }
        }
    }

    public function Logout()
    {
        if(Auth::Check())
        {
            Auth::logout();
            return redirect()->action('AccountController@Login');
        }
    }
}

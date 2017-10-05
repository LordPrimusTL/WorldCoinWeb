<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    private function getId($id)
    {
        return $id/(8009 * 8009);
    }

    private function getLogger()
    {
        return new Logger();
    }
    //
    public function Dashboard()
    {
        return view('Admin.dashboard',['title' => 'Dashboard', 'users' => User::where(['role_id' => 3])->get()]);
    }
    public function UserView($id)
    {
        $u = User::find($this->getId($id));
        return view('Admin.user_view',['title' => 'User View','user' =>  $u]);
    }

    public function UserEdit(Request $request, $id)
    {
        $this->validate($request,[
            'password' => 'required'
        ]);
        try{
            $u = User::find($this->getId($id));
            $old = $u;
            if(Hash::check($request->password, $u->password))
            {
                $u->class_id = $request->class_id == null ? 0 : $request->class_id;
                $u->is_active = (bool)$request->is_active;
                $u->activated = (bool)$request->activated;
                $u->save();
                Session::flash('success','User Profile Updated Succuessfully');
                Log::info('User Profile Updated',['old_user' => $old,'new_user' => $u]);
            }
            else{
                Session::flash('error','Incorrect Password');
            }

        }
        catch(\Exception $ex)
        {
            Session::flash('error','Unable to Update User Profile');
            $this->getLogger()->LogError('Admin: User Profile Update','Unable to Update User Profile',$ex,['old_user' => $old,'new_user' => $u]);
        }
        return redirect()->back();
    }
}

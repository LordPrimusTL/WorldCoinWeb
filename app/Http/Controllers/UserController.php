<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Investments;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    private function getLogger()
    {
        return new Logger();
    }

    //

    public function Dashboard()
    {
        //dd(Auth::user());
        return view('User.dashboard',['title' => "Dashboard"]);
    }


    //Profile
    public function Profile()
    {
        return view('User.profile',['title' => 'Profile','user' => Auth::user()]);
    }
    public function ProfileEdit(Request $request)
    {
        $this->validate($request,[
            'fullname' => 'required',
            'reg_type' => 'required',
            'pay_type' => 'required'
        ],
        [   'fullname.required' => 'Full Name Field Is Required',
            'reg_type.required' => 'Registration Type Field is Required',
            'pay_type.required' => 'Payment Type Field is Required'
        ]);
        //dd($request->all());
        $user = User::find(Auth::id());
        $old_user = $user;
        $user->fullname = $request->fullname;
        $user->reg_type = $request->reg_type;
        $user->payment_id = $request->pay_type;
        try{
            $user->save();
            Session::flash('success','Profile Updated Successfully');
            Log::info('Profile Update Successful',['old-user' => $old_user,'new-user' => $user,'by' => Auth::id()]);
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('ERROR Profile Update Error',$ex, ['old-user' => $old_user,'new-user' => $user,'by' => Auth::id()]);
            Session::flash('error','An Error Occurred, Please Try Again');
        }
        return redirect()->back();
        //validate and save

    }
    public function ProfileEditPassword(Request $request)
    {
        $this->validate($request,[
            'password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'required|same:new_password'
        ], [
            'password.required' => 'Old Password Field Is Required',
            'new_password.required' => 'New Password Field Is Required',
            'new_confirm_password.required' => 'Confirm New Password Field Is Required',
            'new_confirm_password.same' => 'New Pasword Mismatch'
        ]);

        $user = User::find(Auth::id());
        if(Hash::check($request->password, $user->password))
        {
            $user->password = Hash::make($request->new_password);

            try{
                $user->save();
                Session::flash('success','Password Successfully Changed');
            }
            catch(\Exception $ex){
                Session::flash('error','An Error Occurred, Please Try Again Later');
                $this->getLogger()->LogError('Password Change Error', $ex);
            }
            //dd($request->all());
        }
        else{
            Session::flash('error','Password Does Not Match');
        }

        return redirect()->back();

    }

    public function Account()
    {
        return view('User.Account.dashboard',['title' => 'Accounts']);
    }


    //InvestmentsMode
    public function Invest()
    {
        return view('User.invest',['title' => 'Investment','inv' => Investments::orderBy('created_at','DESC')->get()]);
    }
    public function InvestPost(Request $request)
    {
        $this->validate($request,[
            'duration' => 'required|numeric',
            'amount' => 'required|numeric',
        ]);
        $i = new Investments();
        $i->inv_id = $this->generateInv();
        $i->user_id = Auth::id();
        $i->amount = $request->amount;
        $i->duration = $request->duration;
        $i->ts_id = 3;
        try{
            $i->save();
            Session::flash('success','Investment Application Pending Authorization');
            Log::info('Investment Successful',['by' => Auth::id(),'Inv' => $i]);
        }
        catch(\Exception $ex)
        {
            $this->getLogger()->LogError('Investment Application error',$ex,['by' => Auth::id(),'Inv' => $i]);
        }
        return redirect()->back();
        //dd($request->all(),$i);
    }




    //Utilities
    private function generateInv()
    {
        $inv_id = str_random(20);
        if(Investments::FindByInv($inv_id))
        {
            $this->generateInv();
        }
        else{
            return $inv_id;
        }
    }
}

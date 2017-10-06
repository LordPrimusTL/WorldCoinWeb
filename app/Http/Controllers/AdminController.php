<?php

namespace App\Http\Controllers;

use App\Helpers\Logger;
use App\Investments;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function Trade()
    {
        return view('Admin.tradings',['title' => 'Tradings','trades' => Investments::orderBy('created_at','DESC')->get()]);
    }

    public function TradeAction($id, $aid)
    {

        try{
            $a = decrypt($aid);
            $i = Investments::FindbyInvD($id);
            $old = $i;
            if($a == 1)
            {
                $i->ts_id = 6;
                $i->start_date = Carbon::now();
                $i->save();
                //Put In Transaction

            }

            if($a == 2)
            {
                $i->ts_id = 5;
                $i->save();
                $t = new Transaction();
                $t->t_id = Transaction::GenerateTID();
                $t->user_id = $i->user_id;
                $t->amount = $i->amount;
                $t->descn = 'Trade-' . $i->inv_id;
                $t->tn_id = 1;
                $t->t_type = 2;
                $t->ts_id = 1;
                $t->save();
                Log::info('Yransaction saved',['Trans' => $t]);
            }
            $i->save();
            Log::info('Operation completed succesfully',['old' =>$old,'i' => $i,'action' => $a,'by' =>Auth::id()]);
            Session::flash('success','Operation Completed Successfully');
        }
        catch(\Exception $ex){
            $this->getLogger()->LogError('Trade Action: An Error Occurred',$ex,['old' =>$old,'i' => $i,'action' => $a,'by' =>Auth::id()]);
            Session::flash('error','Oops An Error Occured, Please Try Again');
        }
        return redirect()->back();

    }
}

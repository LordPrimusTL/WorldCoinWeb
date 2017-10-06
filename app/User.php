<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function FindRefferer($link)
    {
        $user = User::where(['r_link' => $link,'activated' => true])->get();
        if(count($user) > 0)
        {
            return $user[0];
        }
        else{
            return null;
        }

    }

    public function Reg()
    {
        return $this->belongsTo(RegistrationType::class,'reg_type');
    }

    public function Tclass()
    {
        return $this->belongsTo(TClass::class,'class_id');
    }

    public function Trade()
    {
        return $this->hasMany(Investments::class,'user_id');
    }

}

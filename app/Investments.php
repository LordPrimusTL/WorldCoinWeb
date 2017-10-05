<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investments extends Model
{
    //
    public static function FindbyInv($inv_id)
    {
        $i = Investments::where(['inv_id' => $inv_id])->first();
        if($i==null || count($i) < 1)
            return false;
        else
            return true;
    }

    public function status()
    {
        return $this->belongsTo(TStatus::class,'ts_id');
    }
}

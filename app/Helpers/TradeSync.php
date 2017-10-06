<?php
/**
 * Created by PhpStorm.
 * User: LordPrimus
 * Date: 10/6/2017
 * Time: 6:05 AM
 */

namespace App\Helpers;


use App\Investments;

class TradeSync
{
    private function TradeSync()
    {
        $trades = Investments::where(['ts_id' => 6])->get();
        if(count($trades) == 0)
        {
            return;
        }
        else{
            //dd($trades);
            foreach ($trades as $trade)
            {
                $old_trade = $trade;
                $sd = Carbon::parse($trade->start_date);
                $diff = $sd->diffInMonths(Carbon::now());
                if($diff > $trade->month_count)
                {
                    $trade->month_count = $diff;
                    try{
                        if($trade->month_count < $trade->duration)
                        {
                            $trade->profit = $trade->profit + $trade->amount/$trade->irate;
                            //$trade->total_inv = $trade->amount + $trade->profit_acc;
                            $trade->save();
                            //$this->UpdateTransMain($trade,1);
                        }

                        if($trade->month_used == $trade->duration)
                        {
                            $trade->profit_acc = $trade->profit + $trade->amount/$trade->irate;
                            $trade->total_inv = $trade->amount + $trade->profit_acc;
                            $trade->active = false;
                            $trade->save();
                            //Move Funds TO Main Account
                            //$this->UpdateTransMain($trade,3);
                            $trans = transaction::FindByTID($trade->t_id)[0];
                            $old_t = $trans;
                            $trans->ts_id = 1;
                            try{
                                $trans->save();
                                Log::info('Trade Sync: Transaction Updated',['Old Trans'=> $old_t,'trans' => $trans,'trade'=>$trade,'user'=>Auth::user()]);
                            }
                            catch(\Exception $ex){
                                $this->getLogger()->LogError('Trade Sync: Transaction Update Failed',$ex,['trans' => $trans,'trade'=>$trade,'user'=>Auth::user()]);
                            }

                        }
                        Log::info('Trade Sync: Trade Updated Successfully',['old_trade' => $old_trade,'trade' => (array)$trade, 'user'=>Auth::id()]);
                    }
                    catch(\Exception $ex)
                    {
                        $this->getLogger()->LogError('Trade Sync: Error occured while saving trade', $ex, ['old_trade' => $old_trade,'trade' => (array)$trade, 'user'=>Auth::id()]);
                    }
                }
                else{

                }
                //$this->MyEcho(Carbon::parse($trade->start_date));
                //$this->MyEcho(Carbon::parse($trade->start_date)->diffInMonths(Carbon::now()));
            }
            Session::flash('success','Trade Sync Completed Sucessfully');
            return;

        }
    }
}
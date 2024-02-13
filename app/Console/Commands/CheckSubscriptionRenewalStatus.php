<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Carbon\Carbon;
use App\Models\UserSubscriptionMails;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;
use App\Events\RenewUserSubscription;
use Mail;


class CheckSubscriptionRenewalStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-subscription-renewal-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'With this command i can check susbcription is over or not or if it is then with this command we will send mail to customer to get renew its subscription.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try{
            Log::info('subscription cron job is running');
            $orderWithSubscription = Order::where([['logo_for_future_status','=',1],['subscription_renew_status','=',1]])->get();
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');
            $downloadUptoDayLimit = 30 ;  //days 
            $timePeriodForRecharge = 30 ; // Days
            // dd($orderWithSubscription);
            foreach($orderWithSubscription as $order){
                
                $orderMakeAt = $order->created_at;
                $dateObj = Carbon::parse($orderMakeAt);
    
                $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);
    
                $dateObj3 = Carbon::parse($orderMakeAt);
                $checkRenewDateStatus  = $dateObj3->addDays($downloadUptoDayLimit + $timePeriodForRecharge);
    
                // dd($checkRenewDateStatus , $currentDate , $orderMakeAt);
    
                if($checkRenewDateStatus > $currentDate ){
                    // One month is over after order now checking the further more payments .
                    // Log::info('checkRenewDateStatus is lesser than current');
                   
                    $renewUpto = $checkRenewDateStatus->format('Y-m-d');
                    
                    $userMailList = UserSubscriptionMails::where([['user_id','=',$order->user_id],['status','=',1]])->orderBy('created_at','DESC')->first();
                    
                    if(!$userMailList){
                        
                        if($donwloadUpTo < $currentDate){
    
                            $paymentData = Payment::where([['order_id','=',$order->id],['payment_type','=','logo-backup']])->latest()->first();
    
                            if($paymentData){
                                $dateObj2 = Carbon::parse($paymentData->created_at);
                                $paymentDurValidUpto = $dateObj2->addDays($downloadUptoDayLimit);
    
                                if($paymentDurValidUpto < $currentDate){
                                    
                                    $data = [
                                        'order_id' => $order->id,
                                        'renew_last_date' => $renewUpto,
                                        'customer_id' => $order->user_id,
                                    ];
    
                                    event(new RenewUserSubscription($data));
                                }
                            }else{
                                // There is no single payment for that order .
                                $data = [
                                    'order_id' => $order->id,
                                    'renew_last_date' => $renewUpto,
                                    'customer_id' => $order->user_id,
                                ];
    
                                event(new RenewUserSubscription($data));
                            }
                        }
                    }else{
    
                        $nextTryAfter = 6 ; //days
                        $lastTryForSubs = Carbon::parse($userMailList->created_at);
                        $nextTryOn = $lastTryForSubs->addDays($nextTryAfter);
    
                        if($nextTryOn == $currentDate || $nextTryOn < $currentDate){
                            $data = [
                                'order_id' => $order->id,
                                'renew_last_date' => $renewUpto,
                                'customer_id' => $order->user_id,
                            ];
    
                            event(new RenewUserSubscription($data));
                        }
                    }
    
                }else{
                    Log::info('checkRenewDateStatus is greater than current');
                    // Update order subscription renew status = 0 , means now we have deleted its logo from db.
                    $orderObj = Order::find($order->id);
                    $orderObj->subscription_renew_status = 0;
                    $orderObj->update();
                } 
            }
        }catch(\Exception $e) {
            Log::error('Error in Renew user subscription process -> ' . $e->getMessage());
        }
    }
}

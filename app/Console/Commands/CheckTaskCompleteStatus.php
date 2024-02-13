<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Notifications;
use App\Models\Order;
use Carbon\Carbon;
use Mail;
use App\Mail\DesignerAssignedMail;

class CheckTaskCompleteStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-task-complete-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will check that special designer has complete his task with in given time or not if he is not then task will be assign to backup designer.';

    /**
     * Execute the console command.
     */
    public function handle(){
        try{
            $orderWithSubscription = Order::where([['logo_for_future_status','=',1],['subscription_renew_status','=',1]])->get();
            foreach($orderWithSubscription as $order){
                
            }
            Log::info('Cron job is running ...');

        }catch(\Exception $e){
            $error_message = $e->getMessage();
            Log::error('Error in assigned job : '.$error_message);

        }
    }
}

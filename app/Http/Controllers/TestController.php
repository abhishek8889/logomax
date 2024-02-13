<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;
use App\Models\Logo;
use App\Models\Whishlist;
use Carbon\Carbon;
use App\Models\SpecialDesignerTask;
use App\Models\User;
use App\Models\Notifications;
use App\Models\Order;
use App\Models\Payment;
use App\Models\UserSubscriptionMails;
use App\Events\RenewUserSubscription;

use App\Events\SpecialDesignerNotification;


use App\Mail\RegisterConfirmationMail;
use App\Mail\DesignerAssignedMail;
use App\Mail\RenewLogoBackupSubscription;

use Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Stripe\Stripe;
use App\Models\CurrencyRate;

class TestController extends Controller
{  
    // public function index(Request $req){
        // $cloudconvert = new CloudConvert([
        //     'api_key' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNGQ0ZGJlN2Y2NzFiNjg1NzQ1MDE0YzM2YTBhN2VhZTg5NjdkOWQ5NDNiNzgxNDA1ZmE5MmMwMmU0MWMwNzM1ZTI4NGE0YjdjY2M5NDBkMTQiLCJpYXQiOjE3MDQ2OTI5NTAuNTU4OSwibmJmIjoxNzA0NjkyOTUwLjU1ODkwMiwiZXhwIjo0ODYwMzY2NTUwLjU1NDA0Mywic3ViIjoiNjY3NDQ4NzciLCJzY29wZXMiOlsidXNlci5yZWFkIiwidXNlci53cml0ZSIsInRhc2sucmVhZCIsInRhc2sud3JpdGUiLCJ3ZWJob29rLnJlYWQiLCJ3ZWJob29rLndyaXRlIiwicHJlc2V0LnJlYWQiLCJwcmVzZXQud3JpdGUiXX0.ocjqjNWqWT9TH_QgSqWXGI7E_96o1TwItugMon1eKf6zhXRuR3MwTWEVTJUEGO_skMczi9lj35eSGYVjeUublO5I4wIewIFtiyJCpHCpg2V0PIo4J7jTaqtVpBeTF6i6Olu9AW2SU7UUSAxfj7qgblFKb5by8PhsHKO1D2HCIaUN9dlkgjE8slhHDEtA6iKftHYbBPZZOssCaJ1uhYqEQpXiuzs-Xm32X1yrBpOemg23ua3uUBqfBm_uXcfsEjOrrqJCeyYIwEscuKy-e7VDayQ-vYPmeX2Qi2k9Gw66z1DH1GN_4I9zbdlYJjjxIb6ZbaW5KdqQFW5QoVKoKrdPqY2KO23FE9EMWCiV5tUfx5TqjaBmnWwCaRvCRkjWWP08xJQ32AXEUoFzzJuzw7IaggGQxp68aC1UHE7pIJ4U3XwE6XIjritDicnFAunMUoDzMYp_0hhvNI_8nkZQQjR9901jwIqvwdHWsN8kqvTr5pKQ_kLEzQnunE1rNdBvy7yDtAYZIX1ecV3TP_1rx5I1s1MWOx83jcZYAJAmUgIypZWKsTT2ND1OcFtJzU7Y9yIyAjvpE44H64GLN6l2u9kZ4kw_PIXfxd5YDa8n6f5qmTxWRCBNTyFZx9CLoRFo26Z7323PfwkCg3gSG61DMGLEjQp6mKW5awvc7N4osMx9R_Q',
        //     'sandbox' => false
        // ]);
        
        // $signingSecret = 'eHbBL0v3AvtAkk79nVpMMjp8FibVa1Ib'; // You can find it in your webhook settings
        
        // $payload = @file_get_contents('php://input');
        // $signature = $_SERVER['HTTP_CLOUDCONVERT_SIGNATURE'];
        
        // try {
        //     $webhookEvent = $cloudconvert->webhookHandler()->constructEvent($payload, $signature, $signingSecret);
        // } catch(\CloudConvert\Exceptions\UnexpectedDataException $e) {
        //     // Invalid payload
        //     http_response_code(400);
        //     exit();
        // } catch(\CloudConvert\Exceptions\SignatureVerificationException $e) {
        //     // Invalid signature
        //     http_response_code(400);
        //     exit();
        // }
        
        // $job = $webhookEvent->getJob();
        
        // $job->getTag(); // can be used to store an ID
        
        // $exportTask = $job->getTasks()
        //             ->whereStatus(Task::STATUS_FINISHED) // get the task with 'finished' status ...
        //             ->whereName('export-it')[0];        // ... and with the name 'export-it'
        // // ...

        // return $job;
        





        // app()->setLocale('de');
        // $test = app()->getLocale();
        // dd($test);
        // $directory = public_path('LogoDirectory/Logo_902_1702547898');
        // $extension = 'jpeg';

        // $files = File::allFiles($directory);


        // $filteredFiles = array_filter($files, function ($file) use ($extension) {
        //     return pathinfo($file, PATHINFO_EXTENSION) === $extension;
        // });
        // echo $filteredFiles[0];
        
        // $stripe = new \Stripe\StripeClient([
        //     "api_key" => env('STRIPE_SEC_KEY'),
        //     "stripe_version" => "2023-10-16"
        //   ]);
        //   $payments = $stripe->balanceTransactions->all([]);
        //   echo '<pre>';
        //   print_r($payments);
        //   echo '</pre>';
            // return view('users.test');

        // $order = Order::find(12);
        // dd($order->reviosions);

    // }
    // public function index(Request $req){

    //     $orderWithSubscription = Order::where([['logo_for_future_status','=',1],['subscription_renew_status','=',1]])->get();
    //     $currentDate = Carbon::now()->format('Y-m-d H:i:s');
    //     $downloadUptoDayLimit = 2 ;  //days 
    //     $timePeriodForRecharge = 30 ; // Days
    //     // dd($orderWithSubscription);
    //     foreach($orderWithSubscription as $order){

    //         // User id 
            
    //         $orderMakeAt = $order->created_at;
    //         $dateObj = Carbon::parse($orderMakeAt);

    //         $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);

    //         $dateObj3 = Carbon::parse($orderMakeAt);
    //         $checkRenewDateStatus  = $dateObj3->addDays($downloadUptoDayLimit + $timePeriodForRecharge);

    //         // dd($checkRenewDateStatus , $currentDate , $orderMakeAt);

    //         if($checkRenewDateStatus > $currentDate ){
    //             // One month is over after order now checking the further more payments .
    //             $renewUpto = $checkRenewDateStatus->format('Y-m-d');
                
    //             $userMailList = UserSubscriptionMails::where([['user_id','=',$order->user_id],['status','=',1]])->orderBy('created_at','DESC')->first();
             
    //             if(!$userMailList){
    //                 dd('hello');
    //                 if($donwloadUpTo < $currentDate){

    //                     $paymentData = Payment::where([['order_id','=',$order->id],['payment_type','=','logo-backup']])->latest()->first();

    //                     if($paymentData){
    //                         $dateObj2 = Carbon::parse($paymentData->created_at);
    //                         $paymentDurValidUpto = $dateObj2->addDays($downloadUptoDayLimit);

    //                         if($paymentDurValidUpto < $currentDate){
                                
    //                             $data = [
    //                                 'order_id' => $order->id,
    //                                 'renew_last_date' => $renewUpto,
    //                                 'customer_id' => $order->user_id,
    //                             ];

    //                             event(new RenewUserSubscription($data));
    //                         }
    //                     }else{
    //                         // There is no single payment for that order .
    //                         $data = [
    //                             'order_id' => $order->id,
    //                             'renew_last_date' => $renewUpto,
    //                             'customer_id' => $order->user_id,
    //                         ];

    //                         event(new RenewUserSubscription($data));
    //                     }
    //                 }
    //             }else{

    //                 $nextTryAfter = 6 ; //days
    //                 $lastTryForSubs = Carbon::parse($userMailList->created_at);
    //                 $nextTryOn = $lastTryForSubs->addDays($nextTryAfter);

    //                 if($nextTryOn == $currentDate || $nextTryOn < $currentDate){
    //                     $data = [
    //                         'order_id' => $order->id,
    //                         'renew_last_date' => $renewUpto,
    //                         'customer_id' => $order->user_id,
    //                     ];

    //                     event(new RenewUserSubscription($data));
    //                 }
    //             }

    //         }else{
    //             // Update order subscription renew status = 0 , means now we have deleted its logo from db.
    //             $orderObj = Order::find($order->id);
    //             $orderObj->subscription_renew_status = 0;
    //             $orderObj->update();
    //         } 
    //     }
    // }

    // public function index(Request $request){
        // echo 'done';
        // try {
            // Log::info('Update currency cron running.....');
            // $apikey = env('CURRENCY_API_KEY');

            // $from_Currency = 'USD';
            // $response_json = file_get_contents("https://v6.exchangerate-api.com/v6/{$apikey}/latest/{$from_Currency}");
            // dd($response_json);
            // if($response_json){
            //     $response = json_decode($response_json);
            // }
            
            // $allcurrencyrates = (array)$response->conversion_rates;
        //     $currencies = ['AED','AUD','CAD','CHF','CLP','COP','GBP','HKD','ILS','INR','MYR','MXN','NZD','PEN','PHP','PKR','SGD','ZAR'];
        //     print_r($currencies);
        //     foreach($currencies as $currency){
        //         $price = CurrencyRate::where('currency',$currency)->first();
                
        //         if($price){
        //             $price->usd_price = 1;
        //             $price->currency = $currency;
        //             $price->exchange_price	= 3.6725;
        //             $price->update();
        //             dd($price);
        //         }else{
        //             $price = new CurrencyRate;
        //             $price->usd_price = 1;
        //             $price->currency = $currency;
        //             $price->exchange_price	= 3.6725;
        //             $price->save();
        //         }
                
        //     }       
        // } catch (\Exception $e) {
        //     $error_message = $e->getMessage();
        //     Log::error('Error in assigned job : '.$error_message);
        // }
    // }
    public function index(){
        
        curl -v -X POST https://api-m.sandbox.paypal.com/v1/catalogs/products
        -H "Content-Type: application/json"   -H "Authorization: Bearer ACCESS-TOKEN"   -H "PayPal-Request-Id: REQUEST-ID"   -d '{
        "name": "Video Streaming Service",
        "description": "A video streaming service",
        "type": "SERVICE",
        "category": "SOFTWARE",
        "image_url": "https://example.com/streaming.jpg",
        "home_url": "https://example.com/home"
        }'

    }
}

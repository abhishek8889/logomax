<?php

namespace App\Listeners;

use App\Events\RenewUserSubscription;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Carbon\Carbon;

use App\Models\UserSubscriptionMails;
use App\Mail\RenewLogoBackupSubscription;

use Stripe\Stripe;
use Mail;

use Illuminate\Support\Facades\Log;


class ListenRenewUserSubscription
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(RenewUserSubscription $event): void
    {
        try{
            Log::info('Listener Call.....');
            $data = $event->data;
            $orderID = $data['order_id'];
            $renewUpto = $data['renew_last_date'];
            $customerID = $data['customer_id'];
        
            $userDetail = User::find($customerID);
            $orderDetail = Order::find($orderID);
            $subscriptionPrice = $orderDetail->logo_for_future_price;
            $currency = $orderDetail->currency;
            $payment_type = 'logo-backup';

            $stripe_customer_ID = $userDetail->stripe_customer_id;

            
            $stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));
            $stripeCustomerDetail = $stripe->customers->retrieve($stripe_customer_ID, []); 

            if($stripeCustomerDetail){
                $customerDefaultPaymentMethod = $stripeCustomerDetail->invoice_settings->default_payment_method;
                if($customerDefaultPaymentMethod != '' ||  $customerDefaultPaymentMethod != null){
                
                    $paymentMethodId = $customerDefaultPaymentMethod; 

                    $paymentIntentObject = $stripe->paymentIntents->create([
                        'amount' => (int)$subscriptionPrice * 100,
                        'currency' => $currency,
                        'customer' => $stripe_customer_ID,
                        'payment_method_types' => ['card'],
                        'payment_method' => $paymentMethodId,
                        'metadata' => ['order_id' => $orderDetail->order_num,'payment_type' => 'Subscription renew for save logo.'],
                        'capture_method' => 'automatic',
                        'confirm' => true,
                        'off_session'=> true,
                        'description' => 'Susbscription renew for save logo.',
                        'shipping' => [
                            'name' => 'Digital Product',
                            'address' => [
                                'line1' => 'NA',
                                'city' => 'NA',
                                'country' => 'NA',
                                'postal_code' => 'NA',
                            ],
                        ],
                    ]);

                    // Save payment data :
                    $payment_status = $paymentIntentObject->status;
                    $payment_intent_id = $paymentIntentObject->id;

                    if($payment_status == 'succeeded'){
                        $payment = new Payment;
                        $payment->order_id = $orderID;
                        $payment->payment_type = $payment_type;
                        $payment->payment_gateway = 'stripe';
                        $payment->stripe_customer_id = $stripe_customer_ID;
                        $payment->stripe_payment_intent = $payment_intent_id;
                        $payment->stripe_payment_method =  $customerDefaultPaymentMethod;
                        $payment->currency = $currency;
                        $payment->total_amount = (float)$subscriptionPrice;
                        $payment->status = $payment_status ;
                        $payment->save();

                        // Send success mail that your account has beeen charged for rs. and enjoy the logo backup service .
                        $nextRenewDate = Carbon::now()->addDays(30);

                        $mailData = [
                            'status' => 'success',
                            'title' => 'Subscription renewed succesfully!',
                            'message' => 'Your subscription for logo backup has been renewed. You can now enjoy the logo backup service until ' . $nextRenewDate . ' for the next month.',
                        ];

                        try {

                            Mail::to($userDetail->email)->send(new RenewLogoBackupSubscription($mailData));

                            $userSubscriptionMails = new UserSubscriptionMails;
                            $userSubscriptionMails->user_id = $customerID;
                            $userSubscriptionMails->status = 1;
                            $userSubscriptionMails->save();
                            
                        } catch (\Exception $e) {
                            Log::error('error in mail -> ' . $e->getMessage());
                        }

                    }else{
                        // Send error mail that change your payment method we are not able to charge your default payment method 

                        $mailData = [
                            'status' => 'error',
                            'title' => 'Error in subscription renewal process',
                            'message' => 'Please ensure payment for your logo backup service is completed before '.$renewUpto.'. Failure to do so may result in the removal of your logo backup service, and your logo could be deleted from our system. We appreciate your prompt attention to this matter. If you have already made the payment, kindly disregard this message.',
                        ];

                        try {
                            
                            Mail::to($userDetail->email)->send(new RenewLogoBackupSubscription($mailData));

                            $userSubscriptionMails = new UserSubscriptionMails;
                            $userSubscriptionMails->user_id = $customerID;
                            $userSubscriptionMails->status = 1;
                            $userSubscriptionMails->save();
                            
                        } catch (\Exception $e) {
                            Log::error('error in mail -> ' . $e->getMessage());
                        }
                    }

                }else{

                    $mailData = [
                        'status' => 'error',
                        'title' => 'Error in subscription renewal process',
                        'message' => 'Please ensure payment for your logo backup service is completed before '.$renewUpto.'. Failure to do so may result in the removal of your logo backup service, and your logo could be deleted from our system. We appreciate your prompt attention to this matter. If you have already made the payment, kindly disregard this message.',
                    ];

                    try {
                        
                        Mail::to($userDetail->email)->send(new RenewLogoBackupSubscription($mailData));

                        $userSubscriptionMails = new UserSubscriptionMails;
                        $userSubscriptionMails->user_id = $customerID;
                        $userSubscriptionMails->status = 1;
                        $userSubscriptionMails->save();
                        
                    } catch (\Exception $e) {
                        Log::error('error in mail -> ' . $e->getMessage());
                    }
                    // $paymentMethods = $stripe->customers->allPaymentMethods(auth()->user()->stripe_customer_id,['limit'=>1]);
                }
            } 
        }catch(\Exception $e){
            Log::error('There is error in listener :: ' . $e->getMessage());
        }
    }
}

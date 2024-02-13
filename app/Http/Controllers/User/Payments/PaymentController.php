<?php

namespace App\Http\Controllers\User\Payments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdditionalRevision;
use App\Models\Payment;
use App\Models\Order;
use App\Models\AdditionalOptions;


class PaymentController extends Controller
{
    public function payment_page(Request $request){
        $order_num = $request->slug;
        // dd($order_num);
        $orderDetail = Order::where('order_num',$order_num)->first();
        $stripe = new \Stripe\StripeClient( env('STRIPE_SEC_KEY') );
        #################### Create setupintent ##########################
        $intent =  $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
        ]);

        #################### End setupintent #############################

        return view('user_dashboard_view.payment.payment',compact('request','intent','orderDetail'));
    }
    // public function logoBackupPayment(Request $req){
    //     return 

    // }
    public function extraRevisionPayment(Request $req){
        if($req->session()->get('currency')){
            $currency = $req->session()->get('currency');
        }else{
            $currency = 'USD';
        }
        // dd($req->payment_type);
        $orderDetail = Order::find($req->order_id);
        $order_num = $orderDetail->order_num;
        $payment_type = $req->payment_type;
        // $price = (int)$req->price;
        // $currency = $req->currency;
        $order_id = $req->order_id;
        ////////////////////////// Check customer stripe id /////////////////////
        $stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));
        $stripe_customer_id = '';

        
        if(!empty(auth()->user()->stripe_customer_id) ){

            $stripe_customer = $stripe->customers->retrieve(auth()->user()->stripe_customer_id, []);
            if($stripe_customer->id){

                $stripe_customer_id = auth()->user()->stripe_customer_id;
        
            }else{
                $stripeCustomer = $stripe->customers->create([
                    'name' => $req->name_on_card, 
                    'email' => auth()->user()->email,
                    'address' => [
                        'line1' => auth()->user()->address,
                        'city' => auth()->user()->city,
                        'postal_code' => auth()->user()->city,
                        'state' => auth()->user()->state,
                        'country' => auth()->user()->country
                    ],
                    'payment_method' => $req->token,
                ]);
                $stripe_customer_id = $stripeCustomer->id;
            }
        }

        // Set up intent and attach default payment method to customer invoice details 

        $stripe->paymentMethods->attach(
            $req->token,
            ['customer' => $stripe_customer_id]
        );


        $stripe->customers->update(
            $stripe_customer_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $req->token,
                ],
            ],
        );

        $setup_intent = $stripe->setupIntents->create([
            'customer' => $stripe_customer_id,
            'payment_method' => $req->token,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
            'confirm' => true,
        ]);

        // dd($setup_intent);

        # Confirm the SetupIntent to attach the payment method to the customer
     
        ////////////////////////// Stripe Integration ///////////////////////////
        
        $stripeDesc = '';
        $price = '';
        $currency = '';

        if($req->payment_type == 'logo_revision'){
            $stripeDesc = 'Additional Logo Revision Request Payment';
            $additionalOptions = AdditionalOptions::where('option_type','addition-logo-revision-price')->select('amount','currency')->first();
            $price = $additionalOptions->amount;
            $currency = $additionalOptions->currency;
        }

        if($req->payment_type == 'favicon_revision'){
            $stripeDesc = 'Additional Favicon Revision Request Payment';
            $additionalOptions = AdditionalOptions::where('option_type','addition-favicon-revision-price')->select('amount','currency')->first();
            $price = $additionalOptions->amount;
            $currency = $additionalOptions->currency;
        }

        if($req->payment_type == 'logo-backup'){
            $stripeDesc = 'Payment For Logo Backup.';
            $additionalOptions = AdditionalOptions::where('option_type','save-logo-for-future')->select('amount','currency')->first();
            $price = $additionalOptions->amount;
            $currency = $additionalOptions->currency;
        }


        $paymentMethodId = $req->token; 
        $paymentIntentObject = $stripe->paymentIntents->create([
            'amount' =>  $price * 100,
            'currency' => $currency,
            'customer' => $stripe_customer_id,
            'payment_method_types' => ['card'],
            'payment_method' => $paymentMethodId,
            'metadata' => [],
            'capture_method' => 'automatic',
            'confirm' => true,
            'off_session'=> true,
            'description' => $stripeDesc,
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
        // dd($paymentIntentObject);
        $payment_status = $paymentIntentObject->status;
        $payment_intent_id = $paymentIntentObject->id;

     
        $payment = new Payment;
        $payment->order_id = $order_id;
        // $payment->addition_revision_id = $additionRevision->id;
        $payment->payment_type = $payment_type;
        $payment->payment_gateway = $req->payment_gateway;
        $payment->stripe_customer_id = $stripe_customer_id;
        $payment->stripe_payment_intent = $payment_intent_id;
        $payment->stripe_payment_method =  $req->token;
        $payment->currency = $currency;
        $payment->total_amount = (float)$price;
        $payment->status = $payment_status ;
        $payment->save();

        if( $req->payment_type == 'logo_revision' ||  $req->payment_type == 'favicon_revision' ){
            $additionRevision = new AdditionalRevision;
            $additionRevision->order_id = $order_id;
            $additionRevision->revision_type = $req->payment_type;
            $additionRevision->user_id = auth()->user()->id;
            $additionRevision->revision_count = 1; 
            $additionRevision->amount = $price ;
            $additionRevision->status = 0; // 0 not used yet - 1 is used 
            $additionRevision->save();
        }

        $payment_response = [];
        if($payment_status == 'succeeded'){
            
            if($req->payment_type == 'logo_revision'){
                $payment_response = [
                    'status' => 'success',
                    'message' => 'Congratulations You have succesfully purchase a new logo revision request !' 
                ];
            }
            if($req->payment_type == 'favicon_revision'){
                $payment_response = [
                    'status' => 'success',
                    'message' => 'Congratulations You have succesfully purchase a new favicon revision request !' 
                ];
            }
            if($req->payment_type == 'logo-backup'){
                $payment_response = [
                    'status' => 'success',
                    'message' => 'Congratulations! You have successfully purchased a logo backup service for one month.', 
                ];
            }
                /* mail to user ..... */
                // $mailData = array(
                //     'for' => 'user',
                //     'msg' => 'Thankyou ! your logo has been succesfully purchased',
                //     'title' => 'Succesfully purchased',
                //     'mail' => auth()->user()->email,
                // );
                // $mail = Mail::to(auth()->user()->email)->send(new LogoPurchaseMail($mailData));

                // /* Mail to admin ......*/
                // $mailData = array(
                //     'for' => 'admin',
                //     'msg' => $req->name . ' has purchased a new logo',
                //     'title' => 'Logo purchased',
                //     'mail' => $req->email
                // );

                // $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoPurchaseMail($mailData));
        }else{
            if($req->payment_type == 'logo_revision'){
                $payment_response = [
                    'status' => 'error',
                    'message' => 'There is error in payment.' 
                ];
            }
            if($req->payment_type == 'favicon_revision'){
                $payment_response = [
                    'status' => 'error',
                    'message' => 'There is error in payment.' 
                ];
            }
            if($req->payment_type == 'logo-backup'){
                $payment_response = [
                    'status' => 'error',
                    'message' => 'There is error in payment.', 
                ];
            }
        }
        return redirect(app()->getlocale().'/download-logo/'.$order_num)->with($payment_response['status'],$payment_response['message']);
    }

    public function paymentResponesView(Request $request){

        return view('user_dashboard_view.payment.payment_response',compact('request'));
    }

    public function updateSubscriptionPaymentMethod(Request $req){

        // Set up intent and attach default payment method to customer invoice details 
        $stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));

        $stripe_customer_id = auth()->user()->stripe_customer_id;

        $stripe->paymentMethods->attach(
            $req->token,
            ['customer' => $stripe_customer_id]
        );


        $stripe->customers->update(
            $stripe_customer_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $req->token,
                ],
            ],
        );

        $setup_intent = $stripe->setupIntents->create([
            'customer' => $stripe_customer_id,
            'payment_method' => $req->token,
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
            'confirm' => true,
        ]);
        // dd($setup_intent);
        # Confirm the SetupIntent to attach the payment method to the customer
        return redirect()->back()->with('success','You have succesfully update your card');
    }
}

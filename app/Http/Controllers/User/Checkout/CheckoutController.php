<?php

namespace App\Http\Controllers\User\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use Hash;
use App\Models\Order;
use Auth;
use App\Mail\LogoPurchaseMail;
use Mail;
use App\Models\OrderMeta;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;

class CheckoutController extends Controller
{
    public function checkoutView(Request $request){
        $slug = $request->slug;
        $stripe = new \Stripe\StripeClient( env('STRIPE_SEC_KEY') );
        #################### Create setupintent ##########################
        $intent =  $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
        ]);
        #################### End setupintent #############################
        $logo = Logo::where('logo_slug',$slug)->with('media')->first();
      
        return view('users.logos.checkout',compact('request','logo','intent'));
    }
    public function checkoutProcess(Request $req){
        if($req->billing_address_confirm == 'on'){
            $validated = $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'organization' => 'required',
                'additional_address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                // 'name_on_card' => 
                // 'token'
            ]);

            $address = $req->address;
            $organization = $req->organization;
            $additionaladdress = $req->additional_address;
            $city = $req->city;
            $country = $req->country;
            $state = $req->state;
            $zipcodes = $req->zip_code;
       
            
        }else{ 
          

            $validated = $req->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'billing_address' => 'required',
                'billing_organization' => 'required',
                'billing_additional_address' => 'required',
                'billing_city' => 'required',
                'billing_country' => 'required',
                'billing_state' => 'required',
                'billing_zip_code' => 'required',
                'taxid' => 'required',
                // 'token'
            ]);
            $address = $req->billing_address;
            $organization = $req->billing_organization;
            $additionaladdress = $req->billing_additional_address;
            $city = $req->billing_city;
            $country = $req->billing_country;
            $state = $req->billing_state;
            $zipcodes = $req->billing_zip_code;
            
        }
        $user_id = '';
        
        if(Auth::check() && (auth()->user()->role_id == 1)){
            ////////////////////   Already user is logged in //////////////////
            $user_id = auth()->user()->id ; 
        }else{
            $user  = User::where([['email','=',$req->email],['role_id','=',1]])->first();
            if(!empty($user)){
                ////////////////// user is already exist ////////////////////// 
                Auth::login($user);
                $user_id = auth()->user()->id ; 
            }else{
                ////////////////// Create new user   /////////////////////////
                $new_user = new User;
                $new_user->first_name = $req->first_name; 
                $new_user->last_name = $req->last_name;
                $new_user->email = $req->email;
                $new_user->role_id = 1; // Simple  user role id = 1 
                $new_user->password = Hash::make($req->email);
                $new_user->save();
                $user_id = $new_user->id;
                $creds = array(
                    'email' => $req->email,
                    'password' => $req->email,
                );
                if(!empty($user_id)){
                    Auth::attempt($creds); // User Logged in 
                }
            }
        }
        $order = new Order;
        $orderNum = $this->random_strings(7);
        $order->order_num = $orderNum;
        $order->user_id = $user_id;
        $order->logo_id = $req->logo_id;
        $order->price = (float)$req->logo_price;
        $order->tax_percent = $req->taxe_percent; // condition
        // $order->discount_coupon_code = // condition
        // $order->discount_amount
        $total_price =  0;

        ////////////// LOGO FOR FUTURE STATUS /////////////////////
        if($req->save_logo_for_future_status == 'on' && $req->get_favicon_status == 'on'){
            $order->logo_for_future_status = 1;
            $order->logo_for_future_price = $req->save_logo_for_future_price; 

            $order->get_favicon_status = 1;
            $order->get_favicon_price = $req->get_favicon_price; 

            $total_price = (float)$req->logo_price + (float)$req->save_logo_for_future_price + (float)$req->get_favicon_price;

        }else{
            if($req->save_logo_for_future_status == 'on'){
                $order->logo_for_future_status = 1;
                $order->logo_for_future_price = $req->save_logo_for_future_price; 
                $total_price = (float)$req->logo_price + (float)$req->save_logo_for_future_price;
            }else{
                $order->logo_for_future_status = 0;
                $order->logo_for_future_price = null; 
                $total_price = (float)$req->logo_price;
            } 
            ////////////// LOGO FOR FUTURE STATUS END /////////////////////

            ////////////// GET FAVICON STATUS ////////////////////////////
            if($req->get_favicon_status == 'on'){
                $order->get_favicon_status = 1;
                $order->get_favicon_price = $req->get_favicon_price; 
                $total_price = $total_price + (float)$req->get_favicon_price;
            }else{
                $order->get_favicon_status = 0;
                $order->get_favicon_price = null; 
                $total_price = $total_price ;
            }
            ////////////// GET FAVICON STATUS END /////////////////////////
        }

        $gst_cut = ($total_price * (float)$req->taxe_percent ) / 100;
       

        $order->taxes = $gst_cut; // all tax cut 
        $new_total_price = $gst_cut + $total_price;
        $order->total_payment_amount = $new_total_price;
        ////////////////////////// Stripe Integration ///////////////////////////
        $stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));
        $stripeCustomer = $stripe->customers->create([
            'name' => $req->name_on_card, 
            'email' => $req->email,
            'address' => [
                'line1' => $address,
                'city' => $city,
                'postal_code' => $zipcodes,
                'state' => $state,
                'country' => $country
            ],
            'payment_method' => $req->token,
        ]);
        $paymentMethodId = $req->token; 
        $paymentIntentObject = $stripe->paymentIntents->create([
            'amount' => (int)$new_total_price * 100,
            'currency' => 'usd',
            'customer' => $stripeCustomer->id,
            'payment_method_types' => ['card'],
            'payment_method' => $paymentMethodId,
            'metadata' => ['order_id' => $orderNum],
            'capture_method' => 'automatic',
            'confirm' => true,
            'off_session'=> true,
            'description' => 'Logo purchase payment',
        ]);

        // dd($paymentIntentObject);
        $payment_status = $paymentIntentObject->status;
        $payment_intent_id = $paymentIntentObject->id;

        //////////////////////////// End Stripe //////////////////////////////////////

        if($payment_status == 'succeeded'){
            $order->status = 1;
        }else{
            $order->status = 0;
        }
        $order->save();

        ///////////////////////////////// Order Save //////////////////////////////////

        ////////////////////////////////  Save Order Meta /////////////////////////////

        $order_meta = new OrderMeta;
        $order_meta->order_id = $order->id;
        $order_meta->user_first_name = $req->first_name;
        $order_meta->user_last_name = $req->last_name;
        $order_meta->user_email = $req->email;
        $order_meta->name_on_card = $req->name_on_card;
        $order_meta->street_num = $address;
        $order_meta->additional_address = $additionaladdress;
        $order_meta->organization = $organization;
        $order_meta->city = $city;
        $order_meta->state = $state;
        $order_meta->zip = $zipcodes;
        $order_meta->country = $country;
        $order_meta->taxid = $req->taxid;
        
        $order_meta->save();

        //////update user addresss

            $user = User::find($user_id);
            $user->address = $req->address;
            $user->organization = $req->organization;
            $user->additional_address = $req->additional_address;
            $user->city = $req->city;
            $user->state = $req->state;
            $user->zip_code = $req->zip_code;
            $user->country = $req->country;
            $user->update();
        
        //////////////////////// Save in payment table //////////////////////////////

        $payment = new Payment;
        $payment->order_id = $order->id;
        $payment->payment_type = 'logo_purchase';
        if(isset($req->payment_gateway)){
            if($req->payment_gateway == 'stripe'){
                $payment->payment_gateway = 'stripe';
            }
        }else{
            $payment->payment_gateway = 'paypal';
        }
        $payment->stripe_payment_intent = $payment_intent_id;
        $payment->stripe_payment_method = $req->token;
        $payment->currency = 'usd';
        $payment->total_amount = $new_total_price;
        $payment->status = $payment_status ;
        $payment->save();

        //////////////////////// End payment table /////////////////////////////////

        
        // Update logo status 1 to 3 
        //  status = 1 => For sale
        //  status = 2 => On rivision
        //  status = 3 => sold 

        if($payment_status == 'succeeded'){
            $logo = Logo::find($req->logo_id);
            $logo->status = 3;
            $logo->update();  

            /* mail to user ..... */
            $mailData = array(
                'for' => 'user',
                'msg' => 'Thankyou ! your logo has been succesfully purchased',
                'title' => 'Succesfully purchased',
                'mail' => $req->email
            );
            $mail = Mail::to($req->email)->send(new LogoPurchaseMail($mailData));

            /* Mail to admin ......*/
            $mailData = array(
                'for' => 'admin',
                'msg' => $req->name . ' has purchased a new logo',
                'title' => 'Logo purchased',
                'mail' => $req->email
            );

            $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoPurchaseMail($mailData));

            return redirect('/download-logo/'.$orderNum)->with('success','Congratulations You have succesfully buy a logo !');

        }else{
            return redirect()->back()->with('error','Your payment is not done please try again.');
        }
    }

    public function random_strings($length_of_string){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
}

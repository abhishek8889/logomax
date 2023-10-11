<?php

namespace App\Http\Controllers\User\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

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
        return $req->all();
        // echo "hello";
    }
}

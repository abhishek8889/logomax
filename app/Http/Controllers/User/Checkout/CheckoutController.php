<?php

namespace App\Http\Controllers\User\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use Hash;
use App\Models\Order;
use Auth;

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
        // return $req->all();
        // $validated = $req->validate([
        //     'name' => 'required',
        //     'email' => 'required',
        //     'address' => 'required',
        //     'city' => 'required',
        //     'country' => 'required',
        //     'state' => 'required',
        //     'zip_code' => 'required',
        //     'name_on_card' => 
        //     'token'
        // ]);
        $user_id = '';
        if(Auth::check() && (auth()->user()->role_id == 1)){
            ////////////////////   Already user is logged in //////////////////
            $user = User::find(auth()->user()->id);
            $user->address = $req->address;
            $user->city = $req->city;
            $user->state = $req->state;
            $user->zip_code = $req->zip_code;
            $user->country = $req->country;
            $user->update();
            $user_id = $user->id ; 
        }else{
            $user  = User::where([['email','=',$req->email],['role_id','=',1]])->first();
            if(!empty($user)){
                ////////////////// user is already exist ////////////////////// 
                $user->address = $req->address;
                $user->city = $req->city;
                $user->state = $req->state;
                $user->zip_code = $req->zip_code;
                $user->country = $req->country;
                $user->update();
                // if(!empty($user->id)){
                //     Auth::attempt([$user->email , $user->password]); // User Logged in 
                // }
                $user_id = $user->id ; 
            }else{
                ////////////////// Create new user   /////////////////////////
                $new_user = new User;
                $new_user->name = $req->name;
                $new_user->email = $req->email;
                $new_user->role_id = 1; // Simple  user role id = 1 
                $new_user->password = Hash::make($req->email);
                $new_user->address = $req->address;
                $new_user->city = $req->city;
                $new_user->state = $req->state;
                $new_user->zip_code = $req->zip_code;
                $new_user->country = $req->country;
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
        $order->price = $req->logo_price;
        $order->taxes = $req->taxes; // condition
        $order->tax_percent = $req->taxe_percent; // condition
        // $order->discount_coupon_code = // condition
        // $order->discount_amount
        $total_price =  (float)$req->total_price;
        ////////////// LOGO FOR FUTURE STATUS /////////////////////
        if($req->save_logo_for_future_status == 'on'){
            $order->logo_for_future_status = 1;
            $order->logo_for_future_price = $req->save_logo_for_future_price; 
            $total_price = $total_price + (float)$req->save_logo_for_future_price;
        }else{
            $order->logo_for_future_status = 0;
            $order->logo_for_future_price = null; 
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
        }
        ////////////// GET FAVICON STATUS END /////////////////////////
        $order->total_payment_amount = $total_price;
        $order->save();
        return redirect()->back()->with('success','Congratulations You have succesfully buy a logo !');
    }

    public function random_strings($length_of_string){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
}

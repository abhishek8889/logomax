<?php

namespace App\Http\Controllers\User\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use App\Models\LogoRevision;
use Hash;
use App\Models\Order;
use Auth;
use App\Mail\LogoPurchaseMail;
use Mail;
use App\Models\OrderMeta;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Payment;
use App\Models\Price;
use App\Models\CurrencyRate;
use App\Events\SendMessages;

use PayPal\Api\Agreement;
use PayPal\Api\AgreementStateDescriptor;

// use App\Events\PayWithStripe;
// use App\Events\PayWithPaypal;
use App\Services\AllServices;
use App\Models\Message;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\Discount;
use Carbon\Carbon;
use App\Models\UserBillingAddress;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    protected $allServices;

    public function __construct(AllServices $allServices){
        $this->allServices = $allServices;
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));

    }

    public function checkoutView(Request $request , $lang){
    
        $checkout_page = true;                      ////////for fixed nav

        $slug = $request->slug;
        $stripe = new \Stripe\StripeClient( env('STRIPE_SEC_KEY') );

        #################### Create setupintent ##########################

        $intent =  $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
        ]);
        // dd($intent);

        #################### End setupintent #############################

        $logo = Logo::where([['logo_slug',$slug],['approved_status',1],['status',1]])->with('media')->first();
        if(!$logo){
            abort(404);
        }
        if($request->session()->get('currency')){
            $currency = $request->session()->get('currency');
        }else{
            $currency = 'USD';
        }
        //////discount code ////////
        $active_discount = Discount::where('default_discount',1)->first();
        $today_date = Carbon::now()->format('Y-m-d');
        $active_discount = Discount::where('default_discount', 0)
                ->whereDate('from_date', '<=', $today_date)
                ->whereDate('to_date', '>=', $today_date)
                ->first() ?? $active_discount;

        if($currency != 'USD' && $currency != 'EUR'){
            if($logo->logo_type == 'low-price'){
                $price = Price::where('currency','USD')->first()->simple_price;
            }else{
                $price = Price::where('currency','USD')->first()->premium_price;
            }
            
            $coversion_price = CurrencyRate::where('currency',$currency)->first()->exchange_price; 
        }else{
            if($logo->logo_type == 'low-price'){
                $price = Price::where('currency',$currency)->first()->simple_price;
            }else{
                $price = Price::where('currency',$currency)->first()->premium_price;
            }
            $coversion_price = 1;
        }

        return view('users.logos.checkout',compact('request','logo','intent','checkout_page','price','currency','coversion_price','active_discount'));
    }


    
    public function checkoutProcess(Request $request ){
        
        // return redirect()->back()->with('success','working...............');
        // dd('hello');
     
        if($request->billing_address_confirm == 'on'){
            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'address' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
            ]);
        }else{ 
            $validated = $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required',
                'billing_address' => 'required',
                'billing_city' => 'required',
                'billing_country' => 'required',
                'billing_state' => 'required',
                'billing_zip_code' => 'required',
                'taxid' => 'required',
            ]);
        }
        $req = $request->all();
       
        $services = $this->allServices;
       
        if($request->session()->get('currency')){
            $currency = $request->session()->get('currency');
        }else{
            $currency = 'USD';
        }
        $req['currency'] = $currency;
       
        ////////////////////  Check user //////////////////

        if(Auth::check() && (auth()->user()->role_id == 1)){
            $user_id = auth()->user()->id ; 
        }else{
            $user_id = $this->findOrMakeUser($req);
        }

        $orderOBJ = $this->saveOrderData($req,$user_id);

        ///////////////////////////////////   End ////////////////////////////////////////////
        $paymentDataArr = [
            'total_price' => $orderOBJ->total_payment_amount,
            'currency' => $currency,
            'order_id' => $orderOBJ->id,
            'order_num' => $orderOBJ->order_num,
            'payment_gateway' => $req['payment_gateway'],
            'logo_id' => $req['logo_id'],
            'subscription' => false,
            'customer_fname' => $req['first_name'],
            'customer_lname' => $req['last_name'],
            'customer_email' => $req['email'],
            'customer_id' => $user_id,
        ];


        if(isset($req['save_logo_for_future_status']) && $req['save_logo_for_future_status'] == 'on'){
            $paymentDataArr['subscription'] = true;
            $paymentDataArr['subscription_amount'] = $req['save_logo_for_future_price'];
        }

        //  :::::::::::::::::::: Pay With Stripe ::::::::::::::::::::: 

        if($req['payment_gateway'] == 'stripe'){
            $stripe_customer_id = $this->getStripeCustomerID($req);
           
            $paymentDataArr['stripe_payment_method'] = $req['token'];
            $paymentDataArr['stripe_customer_id'] = $stripe_customer_id;
            $payment_response = $services->payWithStripe($paymentDataArr);
           
            $paymentData = array(
                'order_id' => $orderOBJ->id,
                'payment_type' => 'logo_purchase',
                'payment_gateway' => 'stripe',
                'stripe_customer_id' => $stripe_customer_id,
                'stripe_payment_intent' => $payment_response['paymentObjID'],
                'currency' => $currency,
                'total_amount' => $orderOBJ->total_payment_amount,
                'status' => $payment_response['paymentStatus'],
                'subscription_status' => $payment_response['subscriptionStatus'],
                'stripe_subscription_id' => $payment_response['subscriptionID'],
                'payment_method' => $req['token'],
                'paypal_account_id' => null,
                'paypal_transaction_id' => null,
                'paypal_subscription_id' => null,
            );

            $this->savePaymentData($paymentData);

            if($payment_response['paymentStatus'] == 'succeeded'){
                $logo = Logo::find($req['logo_id']);
                $logo->status = 3; //  status = 1 => For sale , 2 => On rivision , 3 => sold 
                $logo->update(); 

                // Make order status = 1 

                $orderData = Order::find($orderOBJ->id);
                $orderData->status = 1;
                $orderData->update();


                if(isset($req['get_favicon_status']) && $req['get_favicon_status'] == 'on'){
                    // Send revision Request
                    $dataArr = array(
                        'order_id' => $orderOBJ->id,
                        'logo_id' => $req['logo_id'],
                        'customer_first_name' => $req['first_name'],
                        'customer_last_name' => $req['last_name'],
                        'customer_email' => $req['email'],
                        'customer_id' => $user_id,
                    );
                    $this->sendFaviconRevisionReq($dataArr);
                } 

                $this->sendMail($req['first_name'] , $req['email']);
                return redirect(app()->getlocale().'/download-logo/'.$orderOBJ->order_num)->with('success','Congratulations You have succesfully buy a logo !');
            }else{
                return redirect()->back()->with('error','Your payment is not done please try again.');
            }
        }

        // :::::::::::::::::::::: Pay With Paypal ::::::::::::::::::::: 

        if($req['payment_gateway'] == 'paypal'){
            $logo = Logo::find($req['logo_id']);
            $paymentDataArr['payment_success_url'] = url(app()->getlocale().'/download-logo/'.$orderOBJ->order_num);
            $paymentDataArr['payment_success_msg'] = 'Congratulations You have succesfully buy a logo !';

            $paymentDataArr['payment_error_url'] = url(app()->getLocale().'/logos/checkout/'.$logo->logo_slug);
            $paymentDataArr['payment_error_msg'] = 'Error in payment please try again';

            $paymentDataArr['request_for_favicon'] = false;

            if(isset($req['get_favicon_status']) && $req['get_favicon_status'] == 'on'){
                $paymentDataArr['request_for_favicon'] = true;
            }

            $payment_response = $services->payWithPaypal($paymentDataArr);
            // dd($payment_response);
            if (isset($payment_response['id']) && $payment_response['id'] != null) {
                // Redirect to PayPal approval URL
                foreach ($payment_response['links'] as $link) {
                    if ($link['rel'] == 'approve') {
                        $redirectLink = $link['href'];
                        return redirect()->away($redirectLink);
                    }
                }
                return redirect()->back()->with('error','something went wrong please try again.');
            } else {
                return redirect()->back()->with('error','something went wrong please try again.');
            }
        }
    }
    public function paymentCancel(Request $request)
    {
        $redirect_to = url(app()->getLocale().'/logos/search?search=');
        return redirect($redirect_to)->with('error','You have canceled the transaction.');
    }

    public function paymentSuccess(Request $request)
    {
        //  ::::::::::::::::  Logic to save data ::::::::::::: 
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        
        $subscriptionDetails = '';
        $paymentResponse = '';
        $responseData = json_decode(base64_decode($request->meta_data));

        $paymentData = array(
            'order_id' => $responseData->order_id,
            'payment_type' => 'logo_purchase',
            'payment_gateway' => $responseData->payment_gateway,
            'stripe_customer_id' => null,
            'stripe_payment_intent' => null,
            'currency' => $responseData->currency,
            'total_amount' => $responseData->total_price,
            'status' => null,
            'subscription_status' => null,
            'stripe_subscription_id' => null,
            'payment_method' => null,
            'paypal_account_id' => null,
            'paypal_transaction_id' => null,
            'paypal_subscription_id' => null,
        );

        if(isset($request['subscription_id'])){
            $subscriptionDetails = $provider->showSubscriptionDetails($request['subscription_id']);
         
            $paymentData['subscription_status'] = $subscriptionDetails['status'];
            $paymentData['paypal_account_id'] = $subscriptionDetails['subscriber']['payer_id'];
            $paymentData['paypal_subscription_id'] = $subscriptionDetails['id'];
            $paymentData['status'] = $subscriptionDetails['status'];
            $this->savePaymentData($paymentData);
            if($subscriptionDetails['status'] == 'ACTIVE'){
                $logo = Logo::find($responseData->logo_id);
                $logo->status = 3; //  status = 1 => For sale , 2 => On rivision , 3 => sold 
                $logo->update(); 

                // Make order status = 1 
                $orderData = Order::find($responseData->order_id);
                $orderData->status = 1;
                $orderData->update();

                if(isset($responseData->request_for_favicon) && $responseData->request_for_favicon == true){
                    // Send revision Request
                    $dataArr = array(
                        'order_id' => $responseData->order_id,
                        'logo_id' => $responseData->logo_id,
                        'customer_first_name' => $responseData->customer_fname,
                        'customer_last_name' => $responseData->customer_lname,
                        'customer_email' => $responseData->customer_email,
                        'customer_id' => $responseData->customer_id,
                    );
                    $this->sendFaviconRevisionReq($dataArr);
                } 
                $this->sendMail($responseData->customer_fname , $responseData->customer_email);
                return redirect($responseData->payment_success_url)->with('success',$responseData->payment_success_msg);
            } else {
                return redirect($responseData->payment_error_url)->with('error',$responseData->payment_error_msg);
            }
        }else{
            $payment_response = $provider->capturePaymentOrder($request['token']);
            // Save payment data 
            $paymentData['status'] = $payment_response['status'];
            $paymentData['paypal_account_id'] = $request->PayerID;
            
            $this->savePaymentData($paymentData);

            if (isset($payment_response['status']) && $payment_response['status'] == 'COMPLETED') {
                
                $logo = Logo::find($responseData->logo_id);
                $logo->status = 3; //  status = 1 => For sale , 2 => On rivision , 3 => sold 
                $logo->update(); 

                // Make order status = 1 

                $orderData = Order::find($responseData->order_id);
                $orderData->status = 1;
                $orderData->update();

                if(isset($responseData->request_for_favicon) && $responseData->request_for_favicon == true){
                    // Send revision Request
                    $dataArr = array(
                        'order_id' => $responseData->order_id,
                        'logo_id' => $responseData->logo_id,
                        'customer_first_name' => $responseData->customer_fname,
                        'customer_last_name' => $responseData->customer_lname,
                        'customer_email' => $responseData->customer_email,
                        'customer_id' => $responseData->customer_id,
                    );
                    $this->sendFaviconRevisionReq($dataArr);
                } 
                $this->sendMail($responseData->customer_fname , $responseData->customer_email);
                return redirect($responseData->payment_success_url)->with('success',$responseData->payment_success_msg);
            } else {
                return redirect($responseData->payment_error_url)->with('error',$responseData->payment_error_msg);
            }
        }
    }

    public function sendFaviconRevisionReq($data):void{
        // logic for select designer to assign job.
        $specialDesigner = User::where('role_id',4)->get(); 
        $work_load = [];

        foreach($specialDesigner as $designer){
            $designerID = $designer->id;
            $work_load[$designerID] = LogoRevision::where([['assigned_designer_id','=', $designerID],['status','=',0]])->count();
        }

        // Find the minimum value
        $minValue = min($work_load);
        // Find the key(s) with the minimum value
        $minKeys = array_keys($work_load, $minValue);
        // If there are multiple keys with the minimum value, select the first one
        $assignedDesigner = $minKeys[0];

        $logoRevision = new LogoRevision;
        $logoRevision->order_id = $data['order_id'];
        $logoRevision->what_you_revised = 'favicon';  // 
        $logoRevision->request_title = 'Customer buy a new logo with favicon' ;
        $logoRevision->request_description = 'Customer buy a new logo with favicon please provide him a favicon for this.';
        $logoRevision->logo_id = $data['logo_id'];
        $logoRevision->assigned_designer_id = $assignedDesigner;
        $logoRevision->assigned = 1;
        $logoRevision->status = 0;  // 0  When request on revision // 1 approved by customer // 2 sent for approval // 3 denied by designer
        $logoRevision->save();

        // Enable order status on revision 
        if($logoRevision->id){
            $orderData = Order::find($data['order_id']);
            $orderData->on_revision = 1;
            $orderData->update();
        }

        /////////// :::::::::::::::::: Send message direct to Assigned Designer :::::::::::::::::::::::::

        $revision_type = 'favicon';
        $messageText = '<ul> 
                        <li><strong>Request for :</strong> '.strtoupper($revision_type).'</li> 
                        <li><strong>Company name :</strong> Customer buy a new logo with favicon</li>
                        <li><strong>Subtitle title :</strong> </li>';
        ////////////// Check if $revisionFilePath is not empty
        $messageText .='<li><strong>Colors :</strong> </li>
                        <li><strong>Change description :</strong> Customer buy a new logo please provide him a favicon of this .</li>
                        <li><strong>Customer name :</strong> '. $data['customer_first_name']. ' ' .$data['customer_last_name'].'</li>
                        <li><strong>Customer email :</strong> '. $data['customer_email'].'</li>
                    </ul>';
                    
        $userdata = User::find($data['customer_id']);
        $date = date('h:i A', time());

        $message = array(
            'sender_id' => $data['customer_id'],
            'reciever_id' => $assignedDesigner,
            'message' => $messageText,
            'userdata' => $userdata,
            'current_time' => $date,
            // 'files' => $allfilenames,
        );

        $savmessage = new Message;
        $savmessage->sender_id = $data['customer_id'];
        $savmessage->reciever_id = $assignedDesigner;
        $savmessage->message = $messageText;
        // $savmessage->files = json_encode($allfilenames);
        $savmessage->seen_status = 0;
        $savmessage->save();
        array_push($message,$savmessage);
        event(new SendMessages($message));
    }

    public function sendMail($customerName , $customerEmail):void{
        /* mail to user ..... */
        $mailData = array(
            'for' => 'user',
            'msg' => 'Thankyou ! your logo has been succesfully purchased',
            'title' => 'Succesfully purchased',
            'mail' => $customerEmail
        );
        $mail = Mail::to($customerEmail)->send(new LogoPurchaseMail($mailData));

        /* Mail to admin ......*/
        $mailData = array(
            'for' => 'admin',
            'msg' => $customerName . ' has purchased a new logo',
            'title' => 'Logo purchased',
            'mail' => $customerEmail
        );

        $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoPurchaseMail($mailData));
    }
    
    public function savePaymentData($data):void{
        $payment = new Payment;
        $payment->order_id = $data['order_id'];
        $payment->payment_type = $data['payment_type'];
        $payment->payment_gateway = $data['payment_gateway'];
        $payment->stripe_customer_id = $data['stripe_customer_id'];
        $payment->stripe_payment_intent = $data['stripe_payment_intent'];
        $payment->stripe_payment_method = $data['payment_method'];
        $payment->currency = $data['currency'];
        $payment->total_amount = $data['total_amount'];
        $payment->status = $data['status'] ;
        $payment->subscription_status = $data['subscription_status'];
        $payment->stripe_subscription_id = $data['stripe_subscription_id'];
        $payment->paypal_account_id =  $data['paypal_account_id'];
        $payment->paypal_transaction_id = $data['paypal_transaction_id'];
        $payment->paypal_subscription_id = $data['paypal_subscription_id'];
        
        $payment->save();
    }

    public function saveOrderData($req , $user_id){
        if($req['currency']){
            $currency = $req['currency'];
        }else{
            $currency = 'USD';
        }

        if(isset($req['billing_address_confirm']) && $req['billing_address_confirm'] == 'on'){
            $address = $req['address'];
            $organization = $req['organization'];
            $additionaladdress = $req['additional_address'];
            $city = $req['city'];
            $country = $req['country'];
            $state = $req['state'];
            $zipcodes = $req['zip_code'];
        }else{ 
            $address = $req['billing_address'];
            $organization = $req['billing_organization'];
            $additionaladdress = $req['billing_additional_address'];
            $city = $req['billing_city'];
            $country = $req['billing_country'];
            $state = $req['billing_state'];
            $zipcodes = $req['billing_zip_code'];
        }

        $order = new Order;
        $orderNum = $this->random_strings(7);
        $order->order_num = $orderNum;
        $order->user_id = $user_id;
        $order->logo_id = $req['logo_id'];
        $order->price = (float)$req['logo_price'];
        $order->tax_percent = $req['taxe_percent']; // condition
        // $order->discount_coupon_code = // condition
        // $order->discount_amount
        $total_price =  0;

        ////////////// LOGO FOR FUTURE STATUS /////////////////////
      
        if(isset($req['save_logo_for_future_status']) && $req['save_logo_for_future_status'] == 'on' && isset($req['get_favicon_status']) && $req['get_favicon_status'] == 'on'){
            $order->logo_for_future_status = 1;
            $order->logo_for_future_price = $req['save_logo_for_future_price']; 

            $order->get_favicon_status = 1;
            $order->get_favicon_price = $req['get_favicon_price']; 

            // $total_price = (float)$req->logo_price + (float)$req->save_logo_for_future_price + (float)$req->get_favicon_price;
            $total_price = (float)$req['logo_price'] + (float)$req['get_favicon_price'];

        }else{
            if(isset($req['save_logo_for_future_status']) && $req['save_logo_for_future_status'] == 'on'){
                $order->logo_for_future_status = 1;
                $order->logo_for_future_price = $req['save_logo_for_future_price']; 
                // $total_price = (float)$req->logo_price + (float)$req->save_logo_for_future_price;
                $total_price = (float)$req['logo_price'];
            }else{
                $order->logo_for_future_status = 0;
                $order->logo_for_future_price = null; 
                $total_price = (float)$req['logo_price'];
            } 
            ////////////// LOGO FOR FUTURE STATUS END /////////////////////

            ////////////// GET FAVICON STATUS ////////////////////////////
            if(isset($req['get_favicon_status']) && $req['get_favicon_status'] == 'on'){
                $order->get_favicon_status = 1;
                $order->get_favicon_price = $req['get_favicon_price']; 
                $total_price = $total_price + (float)$req['get_favicon_price'];
            }else{
                $order->get_favicon_status = 0;
                $order->get_favicon_price = null; 
                $total_price = $total_price ;
            }
            ////////////// GET FAVICON STATUS END /////////////////////////
        }

        $gst_cut = ($total_price * (float)$req['taxe_percent'] ) / 100;
       

        $order->taxes = $gst_cut; // all tax cut 
        $new_total_price = $gst_cut + $total_price;

        $order->currency = $currency;
        $order->total_payment_amount = $new_total_price;

        $order->status = 0;
        $order->save();

        // ::::::::::::::::::::: Save Order Meta ::::::::::::::::::::: 

        $order_meta = new OrderMeta;
        $order_meta->order_id = $order->id;
        $order_meta->user_first_name = $req['first_name'];
        $order_meta->user_last_name = $req['last_name'];
        $order_meta->user_email = $req['email'];
        $order_meta->name_on_card = $req['name_on_card'];
        $order_meta->street_num = $address;
        $order_meta->additional_address = $additionaladdress;

        $order_meta->organization = $organization;
        $order_meta->city = $city;
        $order_meta->state = $state;
        $order_meta->zip = $zipcodes;
        $order_meta->country = $country;
        $order_meta->taxid = $req['taxid'];
        $order_meta->save();
        // Update user data 
        $this->updateUser($req,$user_id);
        $this->saveCustomerBillingAddress($req , $user_id);

        return $order;
    }

    public function saveCustomerBillingAddress($req,$user_id):void {
        if(isset($req['billing_address_confirm']) && $req['billing_address_confirm'] == 'on'){
            $address = $req['address'];
            $organization = $req['organization'];
            $additionaladdress = $req['additional_address'];
            $city = $req['city'];
            $country = $req['country'];
            $state = $req['state'];
            $zipcodes = $req['zip_code'];
        }else{ 
            $address = $req['billing_address'];
            $organization = $req['billing_organization'];
            $additionaladdress = $req['billing_additional_address'];
            $city = $req['billing_city'];
            $country = $req['billing_country'];
            $state = $req['billing_state'];
            $zipcodes = $req['billing_zip_code'];
        }

        $existingBilling = UserBillingAddress::where('user_id',$user_id)->first();
        if($existingBilling){
            $existingBilling->first_name = $req['first_name'];
            $existingBilling->last_name = $req['last_name'];
            // $existingBilling->email = $req->email
            $existingBilling->organization = $organization;
            $existingBilling->address_1 = $address;
            $existingBilling->address_2 = $additionaladdress;
            $existingBilling->city = $city;
            $existingBilling->state = $state;
            $existingBilling->zip_code =  $zipcodes;
            $existingBilling->country = $country;
            $existingBilling->tax_id = $req['taxid'];
            $existingBilling->update();
        }else{
            $existingBilling = new UserBillingAddress;
            $existingBilling->user_id = $user_id;
            $existingBilling->first_name = $req['first_name'];
            $existingBilling->last_name = $req['last_name'];
            // $existingBilling->email = $req->email
            $existingBilling->organization = $organization;
            $existingBilling->address_1 = $address;
            $existingBilling->address_2 = $additionaladdress;
            $existingBilling->city = $city;
            $existingBilling->state = $state;
            $existingBilling->zip_code =  $zipcodes;
            $existingBilling->country = $country;
            $existingBilling->tax_id = $req['taxid'];
            $existingBilling->save();
        }
        // :::::::::::::::::::::  Update user billing address ::::::::::::::::: 
    }

    public function updateUser($req,$user_id):void {
        $user = User::find($user_id);
        $user->address = $req['address'];
        $user->organization = $req['organization'];
        $user->additional_address = $req['additional_address'];
        $user->city = $req['city'];
        $user->state = $req['state'];
        $user->zip_code = $req['zip_code'];
        $user->country = $req['country'];
        // $user->stripe_customer_id = $stripe_customer_id;
        $user->update();
    }
    
    public function findOrMakeUser($req){
        $user  = User::where([['email','=',$req['email']],['role_id','=',1]])->first();
        if(!empty($user)){
            ////////////////// user is already exist ////////////////////// 
            Auth::login($user);
            $user_id = auth()->user()->id ; 
        }else{
            ////////////////// Create new user   /////////////////////////
            $new_user = new User;
            $new_user->first_name = $req['first_name']; 
            $new_user->last_name = $req['last_name'];
            $new_user->email = $req['email'];
            $new_user->role_id = 1; // Simple  user role id = 1 
            $new_user->password = Hash::make($req['email']);
            $new_user->save();

            $user_id = $new_user->id;
            $creds = array(
                'email' => $req['email'],
                'password' => $req['email'],
            );
            if(!empty($user_id)){
                Auth::attempt($creds); // User Logged in 
            }
        }
        return $user_id;
    }

    public function getStripeCustomerID($req){
        if(Auth::check() && isset(auth()->user()->stripe_customer_id) && !empty(auth()->user()->stripe_customer_id)){
            $stripe_customer = $this->stripe->customers->retrieve(auth()->user()->stripe_customer_id, []);
            if($stripe_customer->id){
                $stripe_customer_id = auth()->user()->stripe_customer_id;
            }else{
                $stripeCustomer = $this->stripe->customers->create([
                    'name' => $req['name_on_card'], 
                    'email' => auth()->user()->email,
                    'address' => [
                        'line1' => auth()->user()->address,
                        'city' => auth()->user()->city,
                        'postal_code' => auth()->user()->city,
                        'state' => auth()->user()->state,
                        'country' => auth()->user()->country
                    ],
                    'payment_method' => $req['token'],                   
                ]);

                $stripe_customer_id = $stripeCustomer->id;
            }

        }else{
            $stripeCustomer = $this->stripe->customers->create([
                'name' => $req['name_on_card'], 
                'email' => $req['email'],
                'address' => [
                    'line1' => $req['address'],
                    'city' => $req['city'],
                    'postal_code' => $req['zip_code'],
                    'state' => $req['state'],
                    'country' => $req['country']
                ],
                'payment_method' => $req['token'],             
            ]);

            $stripe_customer_id = $stripeCustomer->id;
        }

        ////// Attach payment methods //////////////

        $this->stripe->paymentMethods->attach(
            $req['token'],
            ['customer' => $stripe_customer_id]
        ); 

        $this->stripe->customers->update(       //////   Attach default payment method to customer invoice setting .
            $stripe_customer_id,
            [
                'invoice_settings' => [
                    'default_payment_method' => $req['token'],
                ],
            ],
        );

        $setup_intent =  $this->stripe->setupIntents->create([   //// Confirm setup intent . 
            'customer' => $stripe_customer_id,
            'payment_method' => $req['token'],
            'automatic_payment_methods' => [
                'enabled' => true,
                'allow_redirects' => 'never',
            ],
            'confirm' => true,
        ]);

        $user = User::find(auth()->user()->id);
        $user->stripe_customer_id = $stripe_customer_id;
        $user->update();

        return $stripe_customer_id;
    }


    // public function saveOrderMeta($req,$orderID){
        

    // }

    public function random_strings($length_of_string){
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        return substr(str_shuffle($str_result), 0, $length_of_string);
    }
    public function change_currency_format(Request $request){

        if($request->session()->get('currency')){
            $currency = $request->session()->get('currency');
        }else{
            $currency = 'USD';
        }
        $round_prcnt_cut = round($request->prcnt_cut);
        $format_prcnt_cut = Money::$currency($round_prcnt_cut,true)->format();

        $round_subtotal_price = round($request->subtotal_price);
        $format_subtotal_price = Money::$currency($round_subtotal_price,true)->format();

        $round_price = round($request->price);
        $format_price = Money::$currency($round_price,true)->format();

        $round_new_total = round($request->new_total);
        $format_new_total = Money::$currency($round_new_total,true)->format();

        $formatofprice = Money::$currency($round_new_total,true);
        $decimal_value = $formatofprice->getCurrency()->getDecimalMark().'00';

        return response()->json(['format_prcnt_cut'=>str_replace($decimal_value,"",$format_prcnt_cut),'format_subtotal_price'=>str_replace($decimal_value,"",$format_subtotal_price),'format_price'=>str_replace($decimal_value,"",$format_price),'format_new_total'=>str_replace($decimal_value,"",$format_new_total)]);
    }

    public function handlePayment(Request $req){
        // dd('hello');
        return redirect()->back()->with('error','Working....');
        $services = $this->allServices;

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $provider->setAccessToken($paypalToken);

        // Create product in paypal 
        // $data =  json_decode('{
        //     "name": "Kodak Logo",
        //     "description": "Logo",
        //     "type": "DIGITAL",
        //     "category": "GRAPHIC_AND_COMMERCIAL_DESIGN",
        //     "image_url": "https://logomax.com/public/LogoDirectory/Logo_170607655524/Logo_170607655524.png",
        //     "home_url": "https://logomax.com/en-us"
        //   }', true);
          
        //   $request_id = 'create-product-'.time();
          
        //   $product = $provider->createProduct($data, $request_id);
        //   dd($product);

        //////////////////////////// End ///////////////////
        // Create plan in paypal 
           
        // $data = json_decode('{
        //     "product_id": "PROD-6EN06921WT9504437",
        //     "name": "Logo With Backup feature",
        //     "description": "Here customer buy logo with the backup feature.",
        //     "status": "ACTIVE",
            // "billing_cycles": [
            //     {
            //         "frequency": {
            //             "interval_unit": "MONTH",
            //             "interval_count": 1
            //         },
            //         "tenure_type": "REGULAR",
            //         "sequence": 1,
            //         "total_cycles": 0,
            //         "pricing_scheme": {
            //             "fixed_price": {
            //                 "value": "5",
            //                 "currency_code": "USD"
            //             }
            //         }
            //     }
            // ],
            // "billing_cycles": [
            //     {
            //         "frequency": {
            //             "interval_unit": "MONTH",
            //             "interval_count": 1
            //         },
            //         "tenure_type": "TRIAL",
            //         "sequence": 1,
            //         "total_cycles": 1,  // Number of trial cycles
            //         "pricing_scheme": {
            //             "fixed_price": {
            //                 "value": "0",  // Trial period should be free
            //                 "currency_code": "USD"
            //             }
            //         }
            //     },
            //     {
            //         "frequency": {
            //             "interval_unit": "MONTH",
            //             "interval_count": 1
            //         },
            //         "tenure_type": "REGULAR",
            //         "sequence": 2,
            //         "total_cycles": 0,  // Continue indefinitely
            //         "pricing_scheme": {
            //             "fixed_price": {
            //                 "value": "5",
            //                 "currency_code": "USD"
            //             }
            //         }
            //     }
            // ],
        //     "payment_preferences": {
        //         "auto_bill_outstanding": true,
        //         "setup_fee": {
        //             "value": "200",
        //             "currency_code": "USD"
        //         },
        //         "setup_fee_failure_action": "CONTINUE",
        //         "payment_failure_threshold": 3
        //     }
        //     }', true);
          
        //   $plan = $provider->createPlan($data);
        //   P-9NU24038SY833872FMW6PKCA

        //  Create Subscription  ///////////////////////////////////////
        $currentTime = Carbon::create(2024, 2, 6, 0, 0, 0);

        // Format the date and time in ISO 8601
        $iso8601String = $currentTime->toIso8601String();
        // $currentTim = $currentTime->format('Y-m-d H:i:s');
        // dd($currentTim);
        // dd($iso8601String);
        $data = json_decode('{
            "plan_id": "P-9NU24038SY833872FMW6PKCA",
            "start_time": "'.$iso8601String.'",
            "quantity": "1",
            "shipping_amount": {
                "currency_code": "USD",
                "value": "0"
            },
            "subscriber": {
              "name": {
                "given_name": "DEVELOPER",
                "surname": "DEV"
              },
              "email_address": "dev@expert.com",
              "shipping_address": {
                "name": {
                  "full_name": "DEVELOPER eXP"
                },
                "address": {
                  "address_line_1": "2211 N First Street",
                  "address_line_2": "Building 17",
                  "admin_area_2": "San Jose",
                  "admin_area_1": "CA",
                  "postal_code": "95131",
                  "country_code": "US"
                }
              }
            },
            "application_context": {
              "brand_name": "walmart",
              "locale": "en-US",
              "shipping_preference": "SET_PROVIDED_ADDRESS",
              "user_action": "SUBSCRIBE_NOW",
        
              "payment_method": {
                "payer_selected": "PAYPAL",
                "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
              },
              "return_url": "'.route('success.payment',['locale'=>app()->getLocale()]).'",
              "cancel_url": "'.route('cancel.payment',['locale'=>app()->getLocale()]).'"
            }
          }', true);

        $subscription = $provider->createSubscription($data);
        dd($subscription);
        if (isset($subscription['id']) && $subscription['id'] != null) {
            // Redirect to PayPal approval URL
            foreach ($subscription['links'] as $link) {
                if ($link['rel'] == 'approve') {
                    return redirect()->away($link['href']);
                }
            }
    
            return redirect()->back()->with('error','something went wrong.');
              
        } else {
            return redirect()->back()->with('error','something went wrong.');
        }
        //   dd($subscription);
        ///////////////// End /////////////////////////////////////////
        // End plan 
    }
    function getAccessToken($clientId, $clientSecret) {
        $url = 'https://api-m.sandbox.paypal.com/v1/oauth2/token';
        $headers = [
            'Accept: application/json',
            'Accept-Language: en_US',
        ];
        $data = [
            'grant_type' => 'client_credentials',
        ];
    
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERPWD, "$clientId:$clientSecret");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);
    
        return $response['access_token'];
    }
    
    function createSubscriptionOrder($accessToken) {

        $subscriptionOrderData = [
            'intent' => 'CAPTURE',
            // Add other necessary data for subscription order
            // ...
        ];
    
        $subscriptionOrderUrl = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $subscriptionOrderHeaders = [
            'Content-Type: application/json',
            "Authorization: Bearer $accessToken",
        ];
    
        $subscriptionOrderResponse = $this->makePayPalApiCall($subscriptionOrderUrl, 'POST', $subscriptionOrderData, $subscriptionOrderHeaders);
        // dd($subscriptionOrderResponse);
    }
    
    function createRegularOrder($accessToken) {
        // Implement logic to create a regular order
        // Use the PayPal REST API to create a regular order
        // ...
    
        // Example: Creating a regular order (this is just a placeholder)
        $regularOrderData = [
            'intent' => 'CAPTURE',
            // Add other necessary data for regular order
            // ...
        ];
    
        $regularOrderUrl = 'https://api-m.sandbox.paypal.com/v2/checkout/orders';
        $regularOrderHeaders = [
            'Content-Type: application/json',
            "Authorization: Bearer $accessToken",
        ];
    
        $regularOrderResponse = $this->makePayPalApiCall($regularOrderUrl, 'POST', $regularOrderData, $regularOrderHeaders);
    
        return $regularOrderResponse['id'];
    }
    
    function makePayPalApiCall($url, $method, $data, $headers) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }
    
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);
    
        return $response;
    }

    // ::::::::::::::::::::::::::: END ::::::::::::::::::::::::::::: 
   

    // /download-logo/{order_num}
}

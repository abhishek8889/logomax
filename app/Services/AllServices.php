<?php 
namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Torann\GeoIP\Facades\GeoIP;
use App\Models\User;
use App\Models\Logo;
use Carbon\Carbon;
use Auth;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class AllServices
{
    public function __construct(){
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));
        $this->provider = new PayPalClient;
    }
    
    function getIpDetails($ip){
        $client = new Client();
        $response = $client->get("http://ip-api.com/json/$ip");
        if ($response->getStatusCode() === 200) {
            $ipDetails = json_decode($response->getBody());
            if($ipDetails->status === 'fail'){
                return null;
            }else{
                return $ipDetails;
            }
        }else{
            return null; 
        }
        return null; 
    }
    // ::::::::::::::::: STRIPE :::::::::::::::
    public function payWithStripe($data){
        // $stripeSubscriptionSetupPriceID = $this->createStripeSetupPrice($data);
        $stripeSubscriptionPriceID = '';
        $subscriptionID = null;
        if($data['subscription'] == true){
            $stripeSubscriptionPriceID = $this->createsStripePriceForSubscription($data);
        }
        $subscriptionOBJ = '';
        $paymentOBj ='';

        if($data['subscription'] == true){
            $subscriptionOBJ = $this->createSubscriptionWithStripe($data,$stripeSubscriptionPriceID);
            $paymentObj = $this->createPaymentWithStripe($data);
            return array('paymentObjID' => $paymentObj->id ,'paymentStatus' => $paymentObj->status , 'subscriptionID' => $subscriptionOBJ->id , 'subscriptionStatus' => $subscriptionOBJ->status);

        }else{
            $paymentObj = $this->createPaymentWithStripe($data);
            return array('paymentObjID' => $paymentObj->id ,'paymentStatus' => $paymentObj->status , 'subscriptionID' => null , 'subscriptionStatus' => null);
        }
    }
    public function createPaymentWithStripe($data){
        $paymentIntentObject = $this->stripe->paymentIntents->create([
            'amount' => (int)$data['total_price'] * 100,
            'currency' => $data['currency'],
            'customer' => $data['stripe_customer_id'],
            'payment_method_types' => ['card'],
            'payment_method' => $data['stripe_payment_method'],
            'metadata' => ['order_id' => $data['order_id']],
            'capture_method' => 'automatic',
            'confirm' => true,
            'off_session'=> true,
            'description' => 'Logo purchase payment',
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
        return $paymentIntentObject;
    }
    public function createSubscriptionWithStripe($data,$subscPriceID){
        if($subscPriceID !== false || $subscPriceID !== '' || $subscPriceID !== null){
            $subscriptionOBJ = $this->stripe->subscriptions->create([
                'customer' => $data['stripe_customer_id'],
                'collection_method'=>'charge_automatically',
                'items' => [
                    ['price' => $subscPriceID],
                ],
                'payment_settings' => [
                    'save_default_payment_method' => 'on_subscription',
                ],
                'trial_from_plan' => true,

            ]);  
            return $subscriptionOBJ;
        }
    }
    public function getStripeInvoice($inoviceID){
       return $this->stripe->invoices->retrieve($inoviceID, []);
    }
   
    public function createsStripePriceForSubscription($data){
       
        $price = $this->stripe->prices->create([
            'currency' => $data['currency'],
            'unit_amount' => (int)$data['subscription_amount'] * 100,
            'recurring' => [
                'interval' => 'month',
                'interval_count' => 1,
                'trial_period_days' => 30,
            ],
            'product_data' => ['name' => 'logo-backup-subscription'],
        ]);
        return $price->id;
    }

    // ::::::::::::::::: END ::::::::::::::::::::::::::

    // ::::::::::::::::: PAYPAL :::::::::::::::::::::::

    public function payWithPaypal($data){
        // Replace these with your actual values
        if(isset($data['subscription']) && $data['subscription'] == true){
            $productID = $this->createPaypalProduct($data);
            if(isset($productID)){
                $planID = $this->createSubscriptionPaypalPlan($productID,$data);
                if(isset($planID)){
                    $subscription = $this->getSubscribedWithPaypal($data,$planID);
                    if(isset($subscription['id'])){
                        // dd($subscription);
                        return  $subscription;
                    }
                }
            }
        }else{
            // Simple payment //////////////////
           $paymentObj = $this->makePaymentWithPaypal($data);    
           return $paymentObj;                       
        }
    }
    public function makePaymentWithPaypal($data){
        // dd($data);
        $this->provider->setApiCredentials(config('paypal'));
        $paypalToken = $this->provider->getAccessToken();
        $successData = base64_encode(json_encode($data));
        $cancelData = base64_encode(json_encode($data['payment_error_url']));
        $jsonData = json_decode('{
            "intent": "CAPTURE",
            "purchase_units": [
                {
                    "amount": {
                        "currency_code": "'.$data['currency'].'",
                        "value": "'.$data['total_price'].'"
                    }
                }
            ],
            "application_context" : {
                "user_action" : "PAY_NOW",
                "return_url": "'.route('success.payment',['locale'=>app()->getLocale() ,'meta_data' => $successData ]).'",
                "cancel_url": "'.route('cancel.payment',['locale'=>app()->getLocale() ,'redirect_to' => $cancelData ]).'"    
            }
        }', true);
        $order = $this->provider->createOrder($jsonData);
        return $order;
    }
    
    public function createPaypalProduct($data){
        $logo = Logo::find($data['logo_id']); 
        $logoPath = asset('/LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.png');
        
        $this->provider->setApiCredentials(config('paypal'));
        $paypalToken = $this->provider->getAccessToken();
        $this->provider->setAccessToken($paypalToken);

        $jsonData =  json_decode('{
            "name": "'.$logo->logo_name.'",
            "description": "Logo",
            "type": "DIGITAL",
            "category": "GRAPHIC_AND_COMMERCIAL_DESIGN",
            "image_url": "'.$logoPath.'",
            "home_url": "'.url('/').'"
          }', true);
          
        $request_id = 'create-product-'.time();
        $product = $this->provider->createProduct($jsonData, $request_id);

        return $product['id'];
        // dd($product);
    }

    public function createSubscriptionPaypalPlan($productID,$data){
        
        $jsonData = json_decode('{
            "product_id": "'.$productID.'",
            "name": "Logo With Backup feature",
            "description": "Here customer buy logo with the backup feature.",
            "status": "ACTIVE",
            "billing_cycles": [
                {
                    "frequency": {
                        "interval_unit": "MONTH",
                        "interval_count": 1
                    },
                    "tenure_type": "TRIAL",
                    "sequence": 1,
                    "total_cycles": 1,
                    "pricing_scheme": {
                        "fixed_price": {
                            "value": "0",
                            "currency_code": "'.$data['currency'].'"
                        }
                    }
                },
                {
                    "frequency": {
                        "interval_unit": "MONTH",
                        "interval_count": 1
                    },
                    "tenure_type": "REGULAR",
                    "sequence": 2,
                    "total_cycles": 0,
                    "pricing_scheme": {
                        "fixed_price": {
                            "value": "'.$data['subscription_amount'].'",
                            "currency_code": "'.$data['currency'].'"
                        }
                    }
                }
            ],
            "payment_preferences": {
                "auto_bill_outstanding": true,
                "setup_fee": {
                    "value": "'.$data['total_price'].'",
                    "currency_code": "'.$data['currency'].'"
                },
                "setup_fee_failure_action": "CONTINUE",
                "payment_failure_threshold": 3
            }
        }', true);
          
        $plan = $this->provider->createPlan($jsonData);
        return $plan['id'];
    }

    public function getSubscribedWithPaypal($data,$planID){
        
        // dd($data,$planID,Auth::user());
        // $currentTime1 = Carbon::create(2024, 2, 8, 0, 0, 0);
        $logo = Logo::find($data['logo_id']); 
        $currentTime = Carbon::now('UTC');
        $currentTime->addMinutes(2);
        // Format the date and time in ISO 8601
        $iso8601String = $currentTime->toIso8601String();
        $subscriberFname = '';
        $subscriberLname = '';
        $subscriberEmail = '';
        $brandName = '';
        if($logo){
            $brandName = $logo->logo_name;
        }

        if(isset($data['customer_fname'])){
            $subscriberFname = $data['customer_fname'];
        }
        if(isset($data['customer_lname'])){
            $subscriberLname = $data['customer_lname'];
        }
        if(isset($data['customer_email'])){
            $subscriberEmail = $data['customer_email'];
        }

        $successData = base64_encode(json_encode($data));
   
        $jsonData = json_decode('{
            "plan_id": "'.$planID.'",
            "start_time": "'.$iso8601String.'",
            "quantity": "1",
            "shipping_amount": {
                "currency_code": "'.$data['currency'].'",
                "value": "0"
            },
            "subscriber": {
              "name": {
                "given_name": "'.$subscriberFname.'",
                "surname": "'.$subscriberLname.'"
              },
              "email_address": "'.$subscriberEmail.'",
              "shipping_address": {
                "name": {
                  "full_name": "'.$subscriberFname.' '. $subscriberLname.'"
                },
                "address": {
                  "address_line_1": "'.(Auth::user()->address ? Auth::user()->address : '')  .'",
                  "address_line_2": "'.(Auth::user()->additional_address ? Auth::user()->additional_address : '') .'",
                  "admin_area_2": "'.(Auth::user()->city ? Auth::user()->city : '') .'",
                  "admin_area_1": "'.(Auth::user()->state ? Auth::user()->state : '') .'",
                  "postal_code": "'.(Auth::user()->zip_code ? Auth::user()->zip_code : '') .'",
                  "country_code": "'.(Auth::user()->country ? Auth::user()->country : '') .'"
                }
              }
            },
            "application_context": {
              "brand_name": "'.$brandName.'",
              "locale": "en-US",
              "shipping_preference": "SET_PROVIDED_ADDRESS",
              "user_action": "SUBSCRIBE_NOW",
        
              "payment_method": {
                "payer_selected": "PAYPAL",
                "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
              },
              "return_url": "'.route('success.payment',['locale'=>app()->getLocale() ,'meta_data' => $successData ]).'",
              "cancel_url": "'.route('cancel.payment',['locale'=>app()->getLocale() ,'meta_data' => $data ]).'"
            }
          }', true);
          $subscription = $this->provider->createSubscription($jsonData);
        return $subscription;
    }
    // :::::::::::::::::: END :::::::::::::::::::::::::

    // 

    // public function handlePayment(Request $req){
    //     // dd('hello');
    //     return redirect()->back()->with('error','Working....');
    //     $services = $this->allServices;

    //     $provider = new PayPalClient;
    //     $provider->setApiCredentials(config('paypal'));
    //     $paypalToken = $provider->getAccessToken();
    //     $provider->setAccessToken($paypalToken);

    //     // Create product in paypal 
    //     // $data =  json_decode('{
    //     //     "name": "Kodak Logo",
    //     //     "description": "Logo",
    //     //     "type": "DIGITAL",
    //     //     "category": "GRAPHIC_AND_COMMERCIAL_DESIGN",
    //     //     "image_url": "https://logomax.com/public/LogoDirectory/Logo_170607655524/Logo_170607655524.png",
    //     //     "home_url": "https://logomax.com/en-us"
    //     //   }', true);
          
    //     //   $request_id = 'create-product-'.time();
          
    //     //   $product = $provider->createProduct($data, $request_id);
    //     //   dd($product);

    //     //////////////////////////// End ///////////////////
    //     // Create plan in paypal 
           
    //     // $data = json_decode('{
    //     //     "product_id": "PROD-6EN06921WT9504437",
    //     //     "name": "Logo With Backup feature",
    //     //     "description": "Here customer buy logo with the backup feature.",
    //     //     "status": "ACTIVE",
    //         // "billing_cycles": [
    //         //     {
    //         //         "frequency": {
    //         //             "interval_unit": "MONTH",
    //         //             "interval_count": 1
    //         //         },
    //         //         "tenure_type": "REGULAR",
    //         //         "sequence": 1,
    //         //         "total_cycles": 0,
    //         //         "pricing_scheme": {
    //         //             "fixed_price": {
    //         //                 "value": "5",
    //         //                 "currency_code": "USD"
    //         //             }
    //         //         }
    //         //     }
    //         // ],
    //         // "billing_cycles": [
    //         //     {
    //         //         "frequency": {
    //         //             "interval_unit": "MONTH",
    //         //             "interval_count": 1
    //         //         },
    //         //         "tenure_type": "TRIAL",
    //         //         "sequence": 1,
    //         //         "total_cycles": 1,  // Number of trial cycles
    //         //         "pricing_scheme": {
    //         //             "fixed_price": {
    //         //                 "value": "0",  // Trial period should be free
    //         //                 "currency_code": "USD"
    //         //             }
    //         //         }
    //         //     },
    //         //     {
    //         //         "frequency": {
    //         //             "interval_unit": "MONTH",
    //         //             "interval_count": 1
    //         //         },
    //         //         "tenure_type": "REGULAR",
    //         //         "sequence": 2,
    //         //         "total_cycles": 0,  // Continue indefinitely
    //         //         "pricing_scheme": {
    //         //             "fixed_price": {
    //         //                 "value": "5",
    //         //                 "currency_code": "USD"
    //         //             }
    //         //         }
    //         //     }
    //         // ],
    //     //     "payment_preferences": {
    //     //         "auto_bill_outstanding": true,
    //     //         "setup_fee": {
    //     //             "value": "200",
    //     //             "currency_code": "USD"
    //     //         },
    //     //         "setup_fee_failure_action": "CONTINUE",
    //     //         "payment_failure_threshold": 3
    //     //     }
    //     //     }', true);
          
    //     //   $plan = $provider->createPlan($data);
    //     //   P-9NU24038SY833872FMW6PKCA

    //     //  Create Subscription  ///////////////////////////////////////
    //     $currentTime = Carbon::create(2024, 2, 6, 0, 0, 0);

    //     // Format the date and time in ISO 8601
    //     $iso8601String = $currentTime->toIso8601String();
    //     // $currentTim = $currentTime->format('Y-m-d H:i:s');
    //     // dd($currentTim);
    //     // dd($iso8601String);
    //     $data = json_decode('{
    //         "plan_id": "P-9NU24038SY833872FMW6PKCA",
    //         "start_time": "'.$iso8601String.'",
    //         "quantity": "1",
    //         "shipping_amount": {
    //             "currency_code": "USD",
    //             "value": "0"
    //         },
    //         "subscriber": {
    //           "name": {
    //             "given_name": "DEVELOPER",
    //             "surname": "DEV"
    //           },
    //           "email_address": "dev@expert.com",
    //           "shipping_address": {
    //             "name": {
    //               "full_name": "DEVELOPER eXP"
    //             },
    //             "address": {
    //               "address_line_1": "2211 N First Street",
    //               "address_line_2": "Building 17",
    //               "admin_area_2": "San Jose",
    //               "admin_area_1": "CA",
    //               "postal_code": "95131",
    //               "country_code": "US"
    //             }
    //           }
    //         },
    //         "application_context": {
    //           "brand_name": "walmart",
    //           "locale": "en-US",
    //           "shipping_preference": "SET_PROVIDED_ADDRESS",
    //           "user_action": "SUBSCRIBE_NOW",
        
    //           "payment_method": {
    //             "payer_selected": "PAYPAL",
    //             "payee_preferred": "IMMEDIATE_PAYMENT_REQUIRED"
    //           },
    //           "return_url": "'.route('success.payment',['locale'=>app()->getLocale()]).'",
    //           "cancel_url": "'.route('cancel.payment',['locale'=>app()->getLocale()]).'"
    //         }
    //       }', true);
    //       $subscription = $provider->createSubscription($data);

    //       if (isset($subscription['id']) && $subscription['id'] != null) {
    //         // Redirect to PayPal approval URL
    //         foreach ($subscription['links'] as $link) {
    //             if ($link['rel'] == 'approve') {
    //                 return redirect()->away($link['href']);
    //             }
    //         }
    
    //         return redirect()->back()->with('error','something went wrong.');
              
    //     } else {
    //         return redirect()->back()->with('error','something went wrong.');
    //     }
    //     //   dd($subscription);
    //     ///////////////// End /////////////////////////////////////////
    //     // End plan 
    // }
}

?>
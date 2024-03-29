<?php

namespace App\Http\Controllers\Authentication;
use Auth;
use DB;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Mail;
use App\Mail\RegisterConfirmationMail;
use App\Rules\ReCaptcha;
use App\Events\RegisterNotificationEvent;
use App\Models\Notifications;

class AuthenticationController extends Controller
{
    //
    public function login(){
        return view('authentication.login');
    }
    public function loginprocess(Request $request){
        
        
            $validate = $request->validate([
                'g-recaptcha-response' => 'required',
                'login_email' => 'required|email',
                'login_password' => 'required',
            ]);
            $recaptcha = $_POST['g-recaptcha-response'];
                    $secret_key = env('GCAPTCHA_SECRET_KEY');
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
                    $response_json = file_get_contents($url);
                    $response = (array)json_decode($response_json);
            if($response['success'] == 1){
                
            }else{
                return redirect()->back()->with(['error'=>'Google recaptcha is not valid']);
            }
            $data = array(
                'email' => $request->login_email,
                'password' => $request->login_password,
            );
        try {
            if (Auth::attempt($data)) {
                if (Auth::user()->email_verified == 1) {
                    switch (Auth::user()->role_id) {
                        case 1:
                            return redirect('/home')->with('success', 'Welcome ' . Auth::user()->name . ' to home page');
                        case 2:
                            return redirect('/designer-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Designer Dashboard');
                        case 3:
                            return redirect('/admin-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Admin Dashboard.');
                        default:
                            Auth::logout();
                            abort(401, 'Invalid user');
                    }
                } else {
                    Auth::logout();
                    return redirect()->back()->with('error', 'You need to verify your email');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid email or password');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
        
    }
    // View for register form
    public function register(Request $request){
        return view('authentication.register',compact('request'));
    }
    public function registerProcess(Request $request){
       
        $remember_token = Str::random(64);
        $validate = $request->validate([
            'g-recaptcha-response' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'experience' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);
         $recaptcha = $_POST['g-recaptcha-response'];
                    $secret_key = env('GCAPTCHA_SECRET_KEY');
                    $url = 'https://www.google.com/recaptcha/api/siteverify?secret='. $secret_key . '&response=' . $recaptcha;
                    $response_json = file_get_contents($url);
                    $response = (array)json_decode($response_json);
            if($response['success'] == 1){
                
            }else{
                return redirect()->back()->with(['error'=>'Google recaptcha is not valid']);
            }

        $user = new User();
        $user->name = $validate['name'];
        $user->email = $validate['email'];
        $user->password = Hash::make($validate['password']);
        $user->experience = $validate['experience'];
        $user->country = $validate['country'];
        $user->address = $validate['address'];
        $user->role_id = 2;
        $user->remember_token = $remember_token;
        $user->status = 1;
        $user->save();

            
            if($user->role_id == 2){
        $mailData = [
            'token' => $remember_token,
            'email' => $validate['email'],
        ];

        $mail = Mail::to($validate['email'])->send(new RegisterConfirmationMail($mailData));
        return redirect()->back()->with('success', 'A varification email has been sent to your email address please verify your email');
    }else{
        return redirect()->back()->with('success','Your account is successfully registered');
    }
    }
    
    public function registerVerify(Request $request ,$token){
        if (!$token) {
            return abort(404); 
        }
    
        $user = User::where('remember_token', $token)->first();
        if (!$user) {
            return abort(404); 
        }
    
        $user->email_verified = 1;
        if (!$user->save()) {
            return abort(404);
        }
         // Call an notification event to admin : 
        $notifications = Notifications::create(array(
            'type' => 'designer-registered',
            'sender_id' => '0',
            'reciever_id' => '0',
            'designer_id' => $user->id,
            'message' => 'New host is registered!'
        )); 
        $eventData = array(
            'type' => 'designer-registered',
            'designer_id' => $user->id,
            'notification_id' => $notifications->id
        );
        
        event(new RegisterNotificationEvent($eventData));
    
        return redirect('/login')->with('success', 'Your account has been verified please login');
    }
    
    

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success',"You have logged out succesfully");
    }

}

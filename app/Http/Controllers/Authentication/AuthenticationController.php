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
use App\Models\LoginContent;
use App\Models\RegisterContent;
use App\Mail\PasswordRecovery;

class AuthenticationController extends Controller
{
    //
    public function login(){
        return view('authentication.login');
    }
    public function loginNew(Request $request){

        $meta_title = LoginContent::where('key','meta-title')->first()->value;
        $meta_description = LoginContent::where('key','meta-description')->first()->value;
        $meta_language = LoginContent::where('key','meta-language')->first()->value;
        $meta_country = LoginContent::where('key','meta-country')->first()->value;

        return view('authentication.new_login',compact('request','meta_title','meta_description','meta_language','meta_country'));
    }
    public function registerNew(Request $request){

        $meta_title = RegisterContent::where('key','meta-title')->first()->value;
        $meta_description = RegisterContent::where('key','meta-description')->first()->value;
        $meta_language = RegisterContent::where('key','meta-language')->first()->value;
        $meta_country = RegisterContent::where('key','meta-country')->first()->value;

        return view('authentication.new-register',compact('request','meta_title','meta_description','meta_language','meta_country'));
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

                if ((Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4 ) && Auth::user()->email_verified == 1) {
                    switch (Auth::user()->role_id) {
                        case 1:
                            return redirect('/home')->with('success', 'Welcome ' . Auth::user()->name . ' to home page');
                        case 2:
                            return redirect('/designer-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Designer Dashboard');
                        case 3:
                            return redirect('/admin-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Admin Dashboard.');
                        case 4:
                            return redirect('special-designer/dashboard/')->with('success', 'Welcome ' . Auth::user()->name . ' to Special Designer Dashboard');
                        default:
                            Auth::logout();
                            abort(401, 'Invalid user');
                    }
                } else {
                    return redirect('/')->with('success', Auth::user()->name . ' you are logged in succesfully !');
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
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // 'experience' => 'required',
            'country' => 'required',
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
        $user->first_name = $validate['fname'];
        $user->last_name = $validate['lname'];
        $user->email = $validate['email'];
        $user->password = Hash::make($validate['password']);

        $user->country = $validate['country'];
        // $user->email_verified = 1;
        $user->role_id = 1;
        $user->remember_token = $remember_token;
        $user->status = 1;
        $user->save();

            
    if($user->role_id == 1){
        $mailData = [
            'title' => 'User Registration',
            'token' => $remember_token,
            'email' => $validate['email'],
        ];
        $mail = Mail::to($validate['email'])->send(new RegisterConfirmationMail($mailData));
        return redirect()->back()->with('success', 'A varification email has been sent to your email address please verify your email');
    }else{
        return redirect()->back()->with('success','Your account is successfully registered');
    }
    }
    
    public function desginerRegister(Request $request){

        return view('authentication.designregister',compact('request'));
    }
    public function designerRegisterProcc(Request $request){
        $remember_token = Str::random(64);
        $validate = $request->validate([
            'g-recaptcha-response' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            // 'experience' => 'required',
            'country' => 'required',
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
        $user->first_name = $validate['fname'];
        $user->last_name = $validate['lname'];
        $user->email = $validate['email'];
        $user->password = Hash::make($validate['password']);

        $user->country = $validate['country'];
        // $user->email_verified = 1;
        $user->role_id = 2;
        $user->remember_token = $remember_token;
        $user->status = 1;
        $user->save();

            
    if($user->role_id == 1){
        $mailData = [
            'title' => 'User Registration',
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
            'message' => 'New host is <span>Registered</span>'
        )); 
        $eventData = array(
            'type' => 'designer-registered',
            'designer_id' => $user->id,
            'notification_id' => $notifications->id,
            'message' => 'New host is <span>Registered !</span>'
        );
        
        event(new RegisterNotificationEvent($eventData));
    
        return redirect('/login')->with('success', 'Your account has been verified please login');
    }
    
    

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success',"You have logged out succesfully");
    }

    public function changePassword(Request $req){
        return view('designer.setting.change_password');
    }
    public function changePasswordProcc(Request $req){ // For designer dashboard
        
        // $validate = $req->validate([
        //     'confirm_pass' => 'required|min:6|confirmed:new_pass',
        // ]);
        if ($req->new_pass === $req->confirm_pass) {
            $new_pass = $req->confirm_pass;

            $user = User::find(auth()->user()->id);
            $user->password = hash::make($new_pass);
            $user->update();

            return redirect()->back()->with('success','You have succesfully update your password');
        }else{
            return redirect()->back()->with('error','Your confirm password is not matched.');
        }
        
    }

    ////////////////////////////////////////////////////////////////////////////////////////

    public function forgotPassword(Request $request){
        return view('authentication.forgotten_password',compact('request'));
    }

    public function sendRecoveryEmail(Request $request){
        $registered_email = $request->login_email;
        $user = User::where('email',$registered_email)->first();
        if($user){
            $recovery_token = base64_encode($registered_email);
            $recovery_url = url("/recover-your-pass/$recovery_token"); 
            $mail = Mail::to($registered_email)->send(new PasswordRecovery($recovery_url));
            return redirect()->back()->with('success','Please check your email to recover your password.');
        }else{
            return redirect()->back()->with('error','We didn\'find this email in our system.');
        }
    }

    public function recoverYourPass(Request $request){
        return view('authentication.recover-password',compact('request'));
    }

    public function changePassProcess(Request $request){
        $validate = $request->validate([ 
            'confirm_new_pass' => 'required|same:new_pass',
        ],[
         'confirm_new_pass.required' => 'Confirm password must be required',
         'confirm_new_pass.same' => 'Confirm password must be match with new password',   
        ]);
        if(isset($request->recovery_token)){
            $recovery_token = $request->recovery_token;
            $user_email = base64_decode($recovery_token);
            $user = User::where('email',$user_email)->first();
            // Update here 
            $user->password = Hash::make($request->confirm_new_pass);
            $user->update();
            return redirect('/login')->with('success','You password is updated');
        }else{
            return redirect('/login');
        }
        
    }
}

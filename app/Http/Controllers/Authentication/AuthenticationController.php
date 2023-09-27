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
class AuthenticationController extends Controller
{
    //
    public function login(){
        return view('authentication.login');
    }
    public function loginprocess(Request $request){
        // dd($request->all());
        
            $validate = $request->validate([
                // 'g-recaptcha-response' => 'required',
                'email' => 'required|email',
                'password' => 'required',
            ]);
        
            $data = array(
                'email' => $request->email,
                'password' => $request->password,
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
        return view('authentication.register');
    }
    public function registerProcess(Request $request){

        
        $eventData = 'hello';
        event(new RegisterNotificationEvent($eventData));

        // $remember_token = Str::random(64);
        // $validate = $request->validate([
        //     'g-recaptcha-response' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email',
        //     'password' => 'required|min:6|confirmed',
        // ]);

        // $user = new User();
        // $user->name = $validate['name'];
        // $user->email = $validate['email'];
        // $user->password = Hash::make($validate['password']);
        // $user->role_id = 2;
        // $user->remember_token = $remember_token;
        // $user->save();

        // $mailData = [
        //     'token' => $remember_token,
        //     'email' => $validate['email'],
        // ];
        // // Call an notification event to admin : 
        // // $eventData = array(
        // //     'type' => 'designer-registered',
        // //     'designer_id' => $user->id
        // // );
        // // event(new RegisterNotificationEvent($eventData));

        // $mail = Mail::to($validate['email'])->send(new RegisterConfirmationMail($mailData));
        // return redirect()->back()->with('success', 'A varification email has been sent to your email address please verify your email');
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
    
        return redirect('/login')->with('success', 'Your account has been verified please login');
    }
    
    

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success',"You have logged out succesfully");
    }

}

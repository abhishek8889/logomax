<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Auth;
use DB;
use Hash;
use Illuminate\Support\Str;
use Mail;
use App\Mail\RegisterConfirmationMail;
use App\Rules\ReCaptcha;

class GoogleController extends Controller
{
    public function redirecttogoogle(){

        return Socialite::driver('google')->redirect();
    }
    public function redirecttofacebook(){
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback(){
        $metadata = Socialite::driver('google')->user();
        echo '<pre>';
        print($metadata);
        echo '</pre>';
    }
    public function handleGoogleCallback(){
    //    try {
        $remember_token = Str::random(64);
        $googledata = Socialite::driver('google')->user();
        $user = User::where('google_id',$googledata->id)->first();
        if($user){
            $data = array(
                'email' => $user->email,
                'password' => $googledata->id,
            );

            $login = $this->login($data);
            
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
                    return redirect('/')->with('error', 'You need to verify your email');
                }
            } else {
                return redirect('/')->with('error', 'Something went wrong');
            }
        }else{
            $user = User::where('email',$googledata->email)->first();
            if($user){
                return redirect('/')->with('error','Already have an account with this email which are you usign please login using its credentials for login');
            }
            $user = new User;
            $user->name = $googledata->name;
            $user->email = $googledata->email;
            $user->password = Hash::make($googledata->id);
            $user->role_id = 2;
            $user->email_verified = 1;
            $user->google_id = $googledata->id;
            $user->remember_token = $remember_token;
            $user->save();
            if($user->save()){
                $data = array(
                    'email' => $user->email,
                    'password' => $googledata->id,
                );
                if (Auth::attempt($data)) {
                    if (Auth::user()->email_verified == 1) {
                        switch (Auth::user()->role_id) {
                            case 1:
                                return redirect('/home')->with('success', 'Welcome ' . Auth::user()->name . ' to home page');
                            case 2:
                                return redirect('/designer-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Designer Dashboard!Currently your account is not verified please wait for admin approval.');
                            case 3:
                                return redirect('/admin-dashboard')->with('success', 'Welcome ' . Auth::user()->name . ' to Admin Dashboard.');
                            default:
                                Auth::logout();
                                abort(401, 'Invalid user');
                        }
                    } else {
                        Auth::logout();
                        return redirect('/')->with('error', 'You need to verify your email');
                    }
                } else {
                    return redirect('/')->with('error', 'Something went wrong');
                }

            }
        }

    }
    protected function login($data){

    }
}


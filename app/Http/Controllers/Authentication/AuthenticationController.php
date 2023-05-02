<?php

namespace App\Http\Controllers\Authentication;
use Auth;
use DB;
use Hash;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    //
    public function index(Request $request){
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $data = array(
            'email' => $request->email,
            'password' => Hash::make($request->password),
        );

        if (Auth::attempt($data)){
            if(Auth::user()->role_id == 1){
                return redirect('/dashboard')->with('success', 'Welcome to home page');
            }elseif(Auth::user()->role_id == 2){
                return redirect('/dashboard')->with('success', 'Welcome to vendor Dashboard');
            }elseif(Auth::user()->role_id == 3){
                return redirect('/dashboard')->with('success', 'Welcome to admin Dashboard.');
            }else{ 
                return redirect()->back()->with('error', 'Failed to login.');
            }
            
        } else {
            return redirect()->back()->with('error', 'Failed to login.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success',"You have logged out succesfully");
    }
}

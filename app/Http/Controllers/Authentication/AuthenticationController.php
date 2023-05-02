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
    public function login(){

        return view('authentication.admin_login');
    }
    public function loginprocess(Request $request){
        // dd($request->all());
        $validate = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $data = array(
            'email' => $request->email,
            'password' => $request->password,
        );

        if (Auth::attempt($data)){
            switch (Auth::user()->role_id) {
                case 1:
                    return redirect('/h')->with('success', 'Welcome to home page');
                case 2:
                    return redirect('/h')->with('success', 'Welcome to vendor Dashboard');
                case 3:
                    return redirect('/admin-dashboard')->with('success', 'Welcome '.Auth::user()->name.' to Admin Dashboard.');
                default:
                    abort(401, 'Invalid user');
            }
            
        } else {
            return redirect()->back()->with('error', 'Invalid email or password');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success',"You have logged out succesfully");
    }

}

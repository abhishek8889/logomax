<?php

namespace App\Http\Controllers\Admin\SpecialDesigner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Mail;
use App\Mail\RegisterConfirmationMail;

class SpecialDesignerController extends Controller
{
    public function addSpecialDesigner(Request $req){
        return view('admin.special-designer.add');
    }
    public function addSpecialDesignerProcess(Request $req){
        $req->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role_id = 4; // special designer
        $user->email_verified = 1;
        $user->is_approved = 1;
        $user->status = 1;
        $user->save();

        $mailData = array(
            'title' => 'Special Designer Registered',
            'name' => $req->name,
            'user_role' => 'Special Designer',
        );

        $mail = Mail::to($req->email)->send(new RegisterConfirmationMail($mailData));

        return redirect()->back()->with('success','You have succesfully added new designer !');
    }
    public function specialDesignerList(Request $req){
        $users = User::where([['role_id','=',4]])->get();
        return view('admin.users.special-designer.special-designer',compact('users'));
    }
}

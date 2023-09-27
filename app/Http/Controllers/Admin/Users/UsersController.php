<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\DesiginerVerifiedMail;
class UsersController extends Controller
{
    //
    public function index(){
        $users = User::where([
            ['role_id', '=', 2],
            ['email_verified', '=', 1],
        ])->orderBy('created_at','desc')->get();
        return view('admin.users.designers.index',compact('users'));
    }
    public function approveUser(Request $request){
    if ($request->has('user_id')) {
        if($request->action == "approve"){
            User::where('id', $request->user_id)->update(['is_approved' => 1]);
            $user = User::find($request->user_id);
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
            ];
            $mail = Mail::to($user->email)->send(new DesiginerVerifiedMail($mailData));
            return response()->json(['success'=> $user->name.' has been approved']);
        }elseif($request->action == "remove"){
            $user = User::find($request->user_id)->delete();
            return response()->json(['success'=>'This request is successfully removed']);
        }
        } else {
            return response()->json(['error' => 'Failed to find user']);
        }
    }

    public function simpleuser(){
        $users = User::where([
            ['role_id', '=', 1],
            ['email_verified', '=', 1],
        ])->get();

      return view('admin.users.simpleuser.index',compact('users'));
    }

}

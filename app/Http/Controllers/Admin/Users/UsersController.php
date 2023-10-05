<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Logo;
use Mail;
use App\Mail\DesiginerVerifiedMail;
class UsersController extends Controller
{
    //
    public function index(){
        $users = User::where([
            ['role_id', '=', 2],
            ['email_verified', '=', 1],
            ['status', '=', 1],
        ])->orderBy('created_at','desc')->get();
        return view('admin.users.designers.index',compact('users'));
    }
    public function designerview($id){
       $designer = User::find($id);
        if(!($designer)){
          abort(404);
        }
        $logos = Logo::where('designer_id',$designer->id)->get();
       return view('admin.users.designers.designerview',compact('designer','logos'));
    }
    public function approveUser(Request $request){
        
    if ($request->has('user_id')) {
            if($request->is_approved == 0 || $request->is_approved == 2){
                User::where('id', $request->user_id)->update(['is_approved' => 1]); 
                $mailtitle =  'DESIGNER ACCOUNT APPROVED';
            }elseif($request->is_approved == 1){
                User::where('id', $request->user_id)->update(['is_approved' => 2]);
                $mailtitle =  'DESIGNER ACCOUNT DISAPPROVED';
            }            
            $user = User::find($request->user_id);
            $mailData = [
                'name' => $user->name,
                'email' => $user->email,
                'is_approved' => $user->is_approved,
                'title' => $mailtitle,
            ];
            $mail = Mail::to($user->email)->send(new DesiginerVerifiedMail($mailData));
            if($request->is_approved == 0 || $request->is_approved == 2){
                return response()->json(['success'=> $user->name.' has been approved']);
            }elseif($request->is_approved == 1){
                return response()->json(['success'=> $user->name.' has been disapproved']);
            } 
        } else {
            return response()->json(['error' => 'Failed to find user']);
        }
    }

    public function delete($id){
        $user = User::find($id)->delete();
        return redirect()->back()->with('success','This request is successfully removed');
    }

    public function simpleuser(){
        $users = User::where([
            ['role_id', '=', 1],
            ['email_verified', '=', 1],
            ['status', '=', 1],
        ])->get();

      return view('admin.users.simpleuser.index',compact('users'));
    }

}

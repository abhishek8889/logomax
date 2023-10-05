<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use App\Mail\DesiginerVerifiedMail;
use App\Events\DesignerNotification;
use App\Models\Notifications;

class UsersController extends Controller
{
    public function index(){
        $users = User::where([
            ['role_id', '=', 2],
            ['email_verified', '=', 1],
            ['status', '=', 1],
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

            $notifications = Notifications::create(array(
                'type' => 'designer-approve',
                'sender_id' => '0',
                'reciever_id' => $user['id'],
                'designer_id' => $user['id'],
                'message' => 'Congratulations ! Your account has been <span>Approved !</span>'
            )); 
            // $eventData = array(
            //     'type' => 'designer-approve',
            //     'designer_id' => $user['id'],
            //     'notification_id' => $notifications->id,
            //     'message' => 'Congratulations ! Your account has been <span>Approved !</span>'
            // );
            // event(new DesignerNotification($eventData));

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
            ['status', '=', 1],
        ])->get();
        return view('admin.users.simpleuser.index',compact('users'));
    }

}

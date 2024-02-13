<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Events\RegisterNotificationEvent;
use App\Models\Notifications;
use Hash;


class AccountSetting extends Controller
{
   public function index(Request $request){
  
    $user = User::find(Auth::user()->id);
    
    return view('designer.setting.accountsetting',compact('request','user'));
   }
   public function update(Request $request){
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        // 'address' => 'required'
    ],[
       'first_name.required' => 'First name is required',
       'last_name.required' => 'Last name is required', 
    ]);

    $user = User::find(Auth::user()->id);
    // if($user->status == 0){
    //       // Call an notification event to admin : 
    //         $notifications = Notifications::create(array(
    //             'type' => 'designer-registered',
    //             'sender_id' => '0',
    //             'reciever_id' => '0',
    //             'designer_id' => $user->id,
    //             'message' => 'New host is <span>Registered</span>'
    //         )); 
    //         $eventData = array(
    //             'type' => 'designer-registered',
    //             'designer_id' => $user->id,
    //             'notification_id' => $notifications->id,
    //             'message' => 'New host is <span>Registered !</span>'
    //         );
    //     event(new RegisterNotificationEvent($eventData)); 
    // }
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->status = 1;
    $user->update();
    return redirect()->back()->with('success','successfully updated profile');
   }
   public function changePassword(Request $req){
    return view('designer.setting.change_password');
}
public function changePasswordProcc(Request $req){ // For designer dashboard
    
    
    // $validate = $req->validate([
    //     'old_pass' => 'required',
    //     'confirm_pass' => 'required|confirmed:new_pass',
    // ]);

    if(!(Hash::check($req->old_pass, Auth::user()->password))){
        return redirect()->back()->with('error','Failed! Your old password is incorrect.');
    }
    if ($req->new_pass === $req->confirm_pass) {
        $new_pass = $req->confirm_pass;

        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($new_pass);
        $user->update();

        return redirect()->back()->with('success','You have succesfully update your password');
    }else{
        return redirect()->back()->with('error','Your confirm password is not matched.');
    }
    
}
  
}

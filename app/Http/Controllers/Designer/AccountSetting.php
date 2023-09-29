<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Events\RegisterNotificationEvent;
use App\Models\Notifications;

class AccountSetting extends Controller
{
   public function index(Request $request){

    $user = User::find(Auth::user()->id);
    return view('designer.setting.accountsetting',compact('request','user'));
   }
   public function update(Request $request){
    $request->validate([
        'experience' => 'required',
        'country' => 'required',
        'address' => 'required'
    ]);
    $user = User::find(Auth::user()->id);
    if($user->status == 0){
 // Call an notification event to admin : 
    $notifications = Notifications::create(array(
        'type' => 'designer-registered',
        'sender_id' => '0',
        'reciever_id' => '0',
        'designer_id' => $user->id,
        'message' => 'New host is registered!'
    )); 
    $eventData = array(
        'type' => 'designer-registered',
        'designer_id' => $user->id,
        'notification_id' => $notifications->id
    );
    
    event(new RegisterNotificationEvent($eventData));
    }
    $user->experience = $request->experience;
    $user->country = $request->country;
    $user->address = $request->address;
    $user->status = 1;
    $user->save();
    return redirect()->back()->with('success','successfully updated profile');
   }
}

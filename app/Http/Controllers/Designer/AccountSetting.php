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
    $user->experience = $request->experience;
    $user->country = $request->country;
    $user->address = $request->address;
    $user->status = 1;
    $user->save();
    return redirect()->back()->with('success','successfully updated profile');
   }
}

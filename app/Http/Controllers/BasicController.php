<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Logo;

class BasicController extends Controller
{
    public function readNotification(Request $req){
        dd('hello');
        $notification_id = $req->notification_id;
        // dd($notification_id);
        if(auth()->user()->role_id == 3){  // All Admin read notification function are here :::::::::::::
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',0]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);

                if($notification->type == 'logo-added'){ // :: new logo is added by designer :::::::::::::
                    $logo = Logo::find($notification->logo_id);
                    $logo_slug = $logo->logo_slug;
                    $notification->is_read = 1;
                    $notification->update();
                    return redirect('admin-dashboard/logo-detail/'.$logo_slug);
                } 
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }elseif(auth()->user()->role_id == 2){  // All Designer read notification function are here ::::::::
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',auth()->user()->id]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('error','Hey buddy where are you.');
        }
    }
}

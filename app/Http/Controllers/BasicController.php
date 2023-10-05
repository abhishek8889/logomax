<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function readNotification(Request $req){
        echo "hello";
        // $notification_id = $req->notification_id;
        // if(auth()->user()->role_id == 3){  // All Admin read notification function are here :::::::::::::
        //     if($notification_id == 'all-read' ){
        //         $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',0]])->update(['is_read'=>1]);
        //         return redirect()->back();
        //     }else{
        //         $notification = Notifications::find($notification_id);
        //         $notification->is_read = 1;
        //         $notification->update();
        //         return redirect()->back();
        //     }
        // }else{  // All Designer read notification function are here :::::::::::::
        //     echo 'for designer';
        //     dd($req);
        //     if($notification_id == 'all-read' ){
        //         $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',0]])->update(['is_read'=>1]);
        //         return redirect()->back();
        //     }else{
        //         $notification = Notifications::find($notification_id);
        //         $notification->is_read = 1;
        //         $notification->update();
        //         return redirect()->back();
        //     }
        // }
       
    }
}

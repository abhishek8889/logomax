<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;


class AdminDashController extends Controller
{
    //
    public function index(Request $request){
        return view('admin.dashboard.index');
    }
    public function readNotification(Request $req){
     
        $notification_id = $req->notification_id;
        if(auth()->user()->role_id == 3){   // All Admin read notification function are here :::::::::::::
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',0]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }else{                            // All Designer read notification function are here :::::::::::::

        }
       
    }
}

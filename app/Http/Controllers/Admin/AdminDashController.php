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
        $notification = Notifications::find($notification_id);
        $notification->is_read = 1;
        $notification->update();
        return redirect()->back();
    }
}

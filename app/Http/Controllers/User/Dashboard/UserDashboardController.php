<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth; 

class UserDashboardController extends Controller
{
    public function userOrders(Request $request){
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where('user_id',auth()->user()->id)->get();
            return view('users.dashboard.order',compact('request','orderDetail'));
        }else{
            return abort(404);
        }
    }
    public function orderDetail(Request $request){
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->get();
            return view('users.dashboard.order_detail',compact('request','orderDetail'));
        }else{
            return abort(404);
        }
    }
}

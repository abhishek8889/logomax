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
            // $orderDetail = Order::with(['logodetail'=>function($query){
            //     $query->select('logo_name');
            // }])->where('user_id',auth()->user()->id)->get();
            $orderDetail = Order::with('logodetail')->where('user_id',auth()->user()->id)->get();
            // dd($orderDetail);
            return view('users.dashboard.index',compact('request','orderDetail'));
        }
    }
}

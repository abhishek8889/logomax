<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserMessageController extends Controller
{
   public function index(Request $request){

    return view('user_dashboard_view.Message.index',compact('request'));
   }
}

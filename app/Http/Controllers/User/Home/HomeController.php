<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    Public function index(Request $request){
        return view('users.home.index',compact('request'));
    }
}

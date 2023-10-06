<?php

namespace App\Http\Controllers\User\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontLogoController extends Controller
{
    public function index(Request $request){
        return view('users.logos.index',compact('request'));
    }
}

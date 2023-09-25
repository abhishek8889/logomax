<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        // echo 'done';
        return view('front.home');
    }
    public function aboutus(Request $request){
        return view('front.aboutus' , compact('request'));
    }
    public function review(Request $request){
        return view('front.review',compact('request'));
    }
    public function blog( Request $request){
        return view('front.blog',compact('request'));
    }
}

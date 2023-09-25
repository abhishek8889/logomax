<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MetaPagesController extends Controller
{
    Public function aboutUs(Request $request){
        return view('users.meta-pages.about_us',compact('request'));
    }
    public function reviews(Request $request){
        return view('users.meta-pages.reviews',compact('request'));
    }
}

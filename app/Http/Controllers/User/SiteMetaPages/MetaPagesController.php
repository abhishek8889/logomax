<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use App\Models\LogoReview;
use Illuminate\Http\Request;

class MetaPagesController extends Controller
{
    Public function aboutUs(Request $request){
        return view('users.meta-pages.about_us',compact('request'));
    }
    public function reviews(Request $request){
        $reviews = LogoReview::all();
        return view('users.meta-pages.reviews',compact('request','reviews'));
    }
    public function support(Request $request){
        return view('users.meta-pages.support',compact('request'));
    }
}

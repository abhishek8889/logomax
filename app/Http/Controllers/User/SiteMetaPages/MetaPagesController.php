<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use App\Models\LogoReview;
use Illuminate\Http\Request;
use App\Models\SupportContent;

class MetaPagesController extends Controller
{
    Public function aboutUs(Request $request){
        return view('users.meta-pages.about_us',compact('request'));
    }
    public function reviews(Request $request){
        $reviews = LogoReview::all();
        $zerorating = LogoReview::where('rating',0)->get();
        $onerating = LogoReview::where('rating',1)->get();
        $tworating = LogoReview::where('rating',2)->get();
        $threerating = LogoReview::where('rating',3)->get();
        $fourrating = LogoReview::where('rating',4)->get();
        $fiverating = LogoReview::where('rating',5)->get();
        return view('users.meta-pages.reviews',compact('request','reviews','zerorating','onerating','tworating','threerating','fourrating','fiverating'));
    }
    public function support(Request $request){
        $support_text = SupportContent::where('meta_key','support_text')->first();
        return view('users.meta-pages.support',compact('request','support_text'));
    }
}

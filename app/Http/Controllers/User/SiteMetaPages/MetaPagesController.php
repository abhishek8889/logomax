<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use App\Models\LogoReview;
use Illuminate\Http\Request;
use App\Models\SupportContent;
use App\Models\ReviewContent;
use App\Models\AboutUsContent;


class MetaPagesController extends Controller
{
    Public function aboutUs(Request $request){
        $meta_title = AboutUsContent::where('key','meta-title')->first()->value;
        $meta_description = AboutUsContent::where('key','meta-description')->first()->value;
        $meta_language = AboutUsContent::where('key','meta-language')->first()->value;
        $meta_country = AboutUsContent::where('key','meta-country')->first()->value;

        return view('users.meta-pages.about_us',compact('request','meta_title','meta_description','meta_language','meta_country'));
    }
    public function reviews(Request $request){
        $reviews = LogoReview::all();
        $zerorating = LogoReview::where('rating',0)->get();
        $onerating = LogoReview::where('rating',1)->get();
        $tworating = LogoReview::where('rating',2)->get();
        $threerating = LogoReview::where('rating',3)->get();
        $fourrating = LogoReview::where('rating',4)->get();
        $fiverating = LogoReview::where('rating',5)->get();


        ///meta
        $meta_title = ReviewContent::where('key','meta-title')->first()->value;
        $meta_description = ReviewContent::where('key','meta-description')->first()->value;
        $meta_language = ReviewContent::where('key','meta-language')->first()->value;
        $meta_country = ReviewContent::where('key','meta-country')->first()->value;

        return view('users.meta-pages.reviews',compact('request','reviews','zerorating','onerating','tworating','threerating','fourrating','fiverating','meta_title','meta_description','meta_language','meta_country'));
    }
    public function support(Request $request){
        $support_text = SupportContent::where('meta_key','support_text')->first();

        $meta_title = SupportContent::where('meta_key','meta-title')->first()->meta_value;
        $meta_description = SupportContent::where('meta_key','meta-description')->first()->meta_value;
        $meta_language = SupportContent::where('meta_key','meta-language')->first()->meta_value;
        $meta_country = SupportContent::where('meta_key','meta-country')->first()->meta_value;

        return view('users.meta-pages.support',compact('request','support_text','meta_title','meta_description','meta_language','meta_country'));
    }
}

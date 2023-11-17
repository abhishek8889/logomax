<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use App\Models\LogoReview;
use Illuminate\Http\Request;
use App\Models\SupportContent;
use App\Models\ReviewContent;
use App\Models\AboutUsContent;
use Auth;


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
        $reviews = LogoReview::where('approved',1)->get();
        $zerorating = LogoReview::where([['rating',0],['approved',1]])->get();
        $onerating = LogoReview::where([['rating',1],['approved',1]])->get();
        $tworating = LogoReview::where([['rating',2],['approved',1]])->get();
        $threerating = LogoReview::where([['rating',3],['approved',1]])->get();
        $fourrating = LogoReview::where([['rating',4],['approved',1]])->get();
        $fiverating = LogoReview::where([['rating',5],['approved',1]])->get();


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
    public function reviewSubmit(Request $request){
        if(!Auth::check()){
            return redirect()->back()->with('error','logged in first');
        }
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rating' => 'required',
        ]);
       $reviews = new LogoReview;
       $reviews->user_id = Auth::user()->id;
       $reviews->logo_id = $request->logo_id;
       $reviews->title = $request->title;
       $reviews->description = $request->description;
       $reviews->rating = $request->rating;
       $reviews->approved = 0;
       $reviews->status = 1;
       $reviews->save();
       return redirect()->back()->with('success','successfully submited review');

    }
}

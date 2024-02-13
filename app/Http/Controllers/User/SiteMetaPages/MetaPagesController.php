<?php

namespace App\Http\Controllers\User\SiteMetaPages;

use App\Http\Controllers\Controller;
use App\Models\LogoReview;
use Illuminate\Http\Request;
use App\Models\SupportContent;
use App\Models\ReviewContent;
use App\Models\AboutUsContent;
use App\Models\Logo;
use App\Models\TermCondition;
use Auth;


class MetaPagesController extends Controller
{
    Public function aboutUs(Request $request){
        
        $meta_title = $meta_description = '';

        if(AboutUsContent::where([['key','=','meta-title'],['lang_code','=',app()->getLocale()]])->first()){
            $meta_title = AboutUsContent::where([['key','=','meta-title'],['lang_code','=',app()->getLocale()]])->first()->value;
        }
        
        if(AboutUsContent::where([['key','=','meta-description'],['lang_code','=',app()->getLocale()]])->first()){
            $meta_description = AboutUsContent::where([['key','=','meta-description'],['lang_code','=',app()->getLocale()]])->first()->value;
        }
        $aboutdata = AboutUsContent::Class::where('lang_code',app()->getLocale())->get();
        $logos = Logo::where([['approved_status',1],['status',1]])->get();

        return view('users.meta-pages.about_us',compact('request','meta_title','meta_description','logos','aboutdata'));
    }
    public function reviews(Request $request){
        $reviews = LogoReview::where('approved',1)->get();           //for count reviews percentage
        if($request->ratingsearch){
            if(count(json_decode($request->ratingsearch)) != 0){
            $reviews_real = LogoReview::whereIn('rating',json_decode($request->ratingsearch))->paginate(3);
            }else{
                $reviews_real = LogoReview::where('approved',1)->paginate(3);
            }
        }else{
           
            $reviews_real = LogoReview::where('approved',1)->paginate(3);   ///for showing reviews in pagination
        }
        
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

        return view('users.meta-pages.reviews',compact('request','reviews','zerorating','onerating','tworating','threerating','fourrating','fiverating','meta_title','meta_description','meta_language','meta_country','reviews_real'));
    }
    public function support(Request $request){
        
        $support_text = SupportContent::where([['meta_key','=','support_text'],['lang_code','=',app()->getLocale()]])->first();
        
        $meta_title = SupportContent::where([['meta_key','=','meta-title'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_description = SupportContent::where([['meta_key','=','meta-description'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_language = SupportContent::where([['meta_key','=','meta-language'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_country = SupportContent::where([['meta_key','=','meta-country'],['lang_code','=',app()->getLocale()]])->first()->meta_value;

        return view('users.meta-pages.support',compact('request','support_text','meta_title','meta_description','meta_language','meta_country'));
    }
    public function faq(Request $request){
        
        $support_text = SupportContent::where([['meta_key','=','support_text'],['lang_code','=',app()->getLocale()]])->first();
        
        $meta_title = SupportContent::where([['meta_key','=','meta-title'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_description = SupportContent::where([['meta_key','=','meta-description'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_language = SupportContent::where([['meta_key','=','meta-language'],['lang_code','=',app()->getLocale()]])->first()->meta_value;
        $meta_country = SupportContent::where([['meta_key','=','meta-country'],['lang_code','=',app()->getLocale()]])->first()->meta_value;

        return view('users.meta-pages.faq',compact('request'));
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
    public function affiliatePage(Request $request){
        return view('users.meta-pages.affiliate',compact('request'));
    }
    public function termsAndConditions(Request $request,$lang,$page_name){
        if($page_name == 'privacy-policy' || $page_name == 'terms-and-conditions' || $page_name == 'cookie-policy'){

            ///////title for matching with geted data///////////
            if($page_name == 'terms-and-conditions'){
                $title = 'Terms & Conditions';
            }elseif($page_name == 'privacy-policy'){
                $title = 'Privacy policy';
            }elseif($page_name == 'cookie-policy'){
                $title = 'Cookie policy';
            }

        }else{
            abort(404);
        }

        $termsandconditions = TermCondition::where([['language',app()->getLocale()],['parent',null]])->get();

        return view('users.meta-pages.terms&conditions',compact('request','termsandconditions','page_name','title'));
    }
}

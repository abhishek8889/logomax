<?php

namespace App\Http\Controllers\User\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Tag;
use App\Models\Logo;
use App\Models\Style;
use App\Models\LogoFacilities;
use App\Models\Wishlist;
use App\Models\ShopContent;
use App\Models\Branch;
use Auth;
use App\Models\LogoReview;
use App\Models\Price;
use App\Models\CurrencyRate;
use Akaunting\Money\Currency;
use Akaunting\Money\Money;
use App\Models\HomeContent;
use Carbon\Carbon;
use App\Models\Discount;

class FrontLogoController extends Controller
{
    public function index(Request $request){
        $categories = Categories::with(['translation' => function($query){
            $query->where('lang_code',app()->getLocale());
        }])->orderBy('name','ASC')->get();

        $tags = Tag::orderBy('name','ASC')->get();
       
        $allbranches = Branch::with(['translation' => function($query){
            $query->where('lang_code',app()->getLocale());
        }])->orderBy('name','ASC')->get();

        $styles = Style::with(['translation' => function($query){
            $query->where('lang_code',app()->getLocale());
        }])->where('status',1)->orderBy('name','ASC')->get();

        $query = Logo::where([['approved_status',1],['status',1]]);
        if($request->search !== null ){
            $search_lower = strtolower(str_replace(" ","-",$request->search));
        $query->where([['logo_slug','like',$search_lower.'%']]);
        }

        if($request->styles){
            $styleslug = json_decode($request->styles);
           if(count($styleslug) > 0){
            foreach($styleslug as $slug){
                $styles1 = Style::where('slug',$slug)->first();
                $styleid[] =  $styles1->id;
            }
            $query->where(function ($query) use ($styleid) {
                foreach ($styleid as $sid) {
                    $query->orWhereJsonContains('style_id', "$sid");
                }
            });
            }
        }
        if($request->categories){
            $categoryslug = json_decode($request->categories);
            // dd($request->categories);
            if(count($categoryslug) > 0){
            foreach($categoryslug as $slug){
                $category = Categories::where('slug',$slug)->first();
                $categoryids[] = $category->id;
            }
            $query->where(function ($query) use ($categoryids) {
                foreach ($categoryids as $cid) {
                    $query->orWhereJsonContains('category_id', "$cid");
                }
            });
        }
    }
    if($request->branches){
        $branchesslug = json_decode($request->branches);
        // dd($request->categories);
        if(count($branchesslug) > 0){
            foreach($branchesslug as $slug){
                $branches = Branch::where('slug',$slug)->first();
                $branchesids[] = $branches->id;
            }
            $query->where(function ($query) use ($branchesids) {
                foreach ($branchesids as $bid) {
                    $query->orWhereJsonContains('branch_id', "$bid");
                }
            });
        }
    }
        // echo $request->tags;
        if($request->tags){
            $tags = str_replace('"',"",$request->tags);
            //    echo $tags;
            if($tags != null){
                $query->where('logo_type',$tags);
            }
        }
            if($request->realtags){
                $tagsslug = json_decode($request->realtags);
                if(count($tagsslug) > 0){
                foreach($tagsslug as $slug){
                    $tag = Tag::where('slug',$slug)->first();
                    $tagsid[] = $tag->id;
                
                }
                // return $tagsid;
                $query->where(function ($query) use ($tagsid) {
                    foreach ($tagsid as $tid) {
                        $query->orWhereJsonContains('tags', "$tid");
                    }
                });
                }
            }
        

        $logos = $query->paginate(20);

        $meta_title = ShopContent::where('key','meta-title')->first()->value;
        $meta_description = ShopContent::where('key','meta-description')->first()->value;
        $meta_language = ShopContent::where('key','meta-language')->first()->value;
        $meta_country = ShopContent::where('key','meta-country')->first()->value;
            
        return view('users.logos.index',compact('request','categories','tags','logos','styles','meta_title','meta_description','meta_language','meta_country','allbranches'));
    }
    public function logodetail(Request $request,$language,$slug){
        $logo = Logo::where([['logo_slug',$slug],['approved_status',1],['status',1]])->first();
       
        if(empty($logo)){
            abort(404);
        }
        $category_slug = array();
        $category_ids = json_decode($logo->category_id);
        if(is_array($category_ids)){
            foreach($category_ids as $categoryID){
                if(isset(Categories::find($categoryID)->slug)){
                    $category_slug[] =  Categories::find($categoryID)->slug;
                }
            }
        }
        $logoFacilities = LogoFacilities::where('lang_code',app()->getLocale())->get();

        $review = LogoReview::where('approved',1)->get(); 
        if($request->session()->get('currency')){
            $currency = $request->session()->get('currency');
        }else{
            $currency = 'USD';
        }
        
        if($currency != 'USD' && $currency != 'EUR'){
            if($logo->logo_type == 'low-price'){
                $price = Price::where('currency','USD')->first()->simple_price;
            }else{
                $price = Price::where('currency','USD')->first()->premium_price;
            }
            
            $coversion_price = CurrencyRate::where('currency',$currency)->first()->exchange_price; 
        }else{
            if($logo->logo_type == 'low-price'){
                $price = Price::where('currency','USD')->first()->simple_price;
            }else{
                $price = Price::where('currency','USD')->first()->premium_price;
            }
            $coversion_price = 1;
        }
        /////get discount ///////
        $active_discount = Discount::where('default_discount',1)->with('translation')->first();
        $today_date = Carbon::now()->format('Y-m-d');
        $active_discount = Discount::with(['translation'=>function($query){ $query->where('lang_code',app()->getlocale()); }])->where('default_discount', 0)
                ->whereDate('from_date', '<=', $today_date)
                ->whereDate('to_date', '>=', $today_date)
                ->first() ?? $active_discount;
                
              
        $homeContent = HomeContent::where([
                ['key','=','customer-review-title'],
                ['lang_code','=',app()->getLocale()]
            ])->orWhere([
                ['key','=','customer-review-text'],
                ['lang_code','=',app()->getLocale()]
            ])->get(['key','value']);
            
        // dd($homeContent);
        $similar_logos = Logo::where([['category_id',$logo->category_id],['approved_status',1],['status',1],['id','!=',$logo->id]])->take(4)->get();
        return view('users.logos.logodetails',compact('request','logo','similar_logos','category_slug','logoFacilities','review','price','currency','coversion_price','homeContent','active_discount'));
    }
    public function download_page(Request $request){

    }
    public function logoFilter(Request $request){
     
        
        if(Auth::check()){
            $query = Logo::with(['media','inWhishlist' => function ($query) {
                $query->where('user_id', auth()->user()->id);
            }])->where([['approved_status',1],['status',1]]);
        }else{
            $query = Logo::with('media')->where([['approved_status',1],['status',1]]);
        }
       
       if($request->searchvalue){
        $search_lower = strtolower(str_replace(" ","-",$request->searchvalue));
        $query->where([['logo_slug','like',$search_lower.'%']]);
       }

       if($request->styles != null){
        $styleslug = $request->styles;
        foreach($styleslug as $slug){
            $styles = Style::where('slug',$slug)->first();
            $styleid[] =  $styles->id;
        }
       $query->where(function ($query) use ($styleid) {
                foreach ($styleid as $sid) {
                    $query->orWhereJsonContains('style_id', "$sid");
                }
            });
       }
        if($request->categories){
            $categoryslug = $request->categories;
            foreach($categoryslug as $slug){
                $category = Categories::where('slug',$slug)->first();
                $categoryids[] = $category->id;
            }
            $query->where(function ($query) use ($categoryids) {
                foreach ($categoryids as $cid) {
                    $query->orWhereJsonContains('category_id', "$cid");
                }
            });
        }
        
        if($request->branches){
            $branchesslug = $request->branches;
            foreach($branchesslug as $slug){
                $branch = Branch::where('slug',$slug)->first();
                $branchids[] = $branch->id;
            }
            $query->where(function ($query) use ($branchids) {
                foreach ($branchids as $bid) {
                    $query->orWhereJsonContains('branch_id', "$bid");
                }
            });
        }
       if($request->tags != ""){
        $query->where('logo_type',$request->tags);
       }
        //    if($request->tags){
        //     $tagsslug = $request->tags;
        //     foreach($tagsslug as $slug){
        //         $tag = Tag::where('slug',$slug)->first();
        //         $tagsid[] = $tag->id;
            
        //     }

            // return $tagsid;
        //     $query->where(function ($query) use ($tagsid) {
        //         foreach ($tagsid as $tid) {
        //             $query->orWhereJsonContains('tags', "$tid");
        //         }
        //     });
        //    }
       return response()->json($query->paginate(20));
    }
    
}

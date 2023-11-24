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

class FrontLogoController extends Controller
{
    public function index(Request $request){
        $categories = Categories::orderBy('name','ASC')->get();
        $tags = Tag::orderBy('name','ASC')->get();

        $allCategory = Categories::orderBy('name','ASC')->get();
        $allStyles = Style::where('status',1)->orderBy('name','ASC')->get();

        $allbranches = Branch::orderBy('name','ASC')->get();
        $styles = Style::where('status',1)->orderBy('name','ASC')->get();
        
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
            $query->whereHas('style', function ($stylesQuery) use ($styleid) {
                $stylesQuery->whereIn('id', $styleid);
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
            $query->whereHas('category',function($categoryQuery) use ($categoryids){
                $categoryQuery->whereIn('id',$categoryids);
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
            $query->whereHas('branches',function($branchQuery) use ($branchesids){
                $branchQuery->whereIn('id',$branchesids);
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
            
        return view('users.logos.index',compact('request','categories','tags','logos','styles','meta_title','meta_description','meta_language','meta_country','allCategory','allStyles','allbranches'));
    }
    public function logodetail(Request $request, $slug){
        $logo = Logo::where([['logo_slug',$slug],['approved_status',1],['status',1]])->first();
      
        if(empty($logo)){
            abort(404);
        }
        $category_slug = '';
        if(isset(Categories::find($logo->category_id)->slug)){
            $category_slug =  Categories::find($logo->category_id)->slug;
        }
        
        $logoFacilities = LogoFacilities::all();

        $similar_logos = Logo::where([['category_id',$logo->category_id],['approved_status',1],['status',1],['id','!=',$logo->id]])->take(4)->get();
        return view('users.logos.logodetails',compact('request','logo','similar_logos','category_slug','logoFacilities'));
    }
    public function download_page(Request $request){

    }
    public function logoFilter(Request $request){
     

        // return $request->tags[0];
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
        $query->whereHas('style', function ($stylesQuery) use ($styleid) {
            $stylesQuery->whereIn('id', $styleid);
        });
       
       }
        if($request->categories){
            $categoryslug = $request->categories;
            foreach($categoryslug as $slug){
                $category = Categories::where('slug',$slug)->first();
                $categoryids[] = $category->id;
            }
            $query->whereHas('category',function($categoryQuery) use ($categoryids){
                $categoryQuery->whereIn('id',$categoryids);
            });
        }
        if($request->branches){
            $branchesslug = $request->branches;
            foreach($branchesslug as $slug){
                $branch = Branch::where('slug',$slug)->first();
                $branchids[] = $branch->id;
            }
            $query->whereHas('branches',function($branchQuery) use ($branchids){
                $branchQuery->whereIn('id',$branchids);
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

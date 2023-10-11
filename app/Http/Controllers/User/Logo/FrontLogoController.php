<?php

namespace App\Http\Controllers\User\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Tag;
use App\Models\Logo;
use App\Models\Style;

class FrontLogoController extends Controller
{
    public function index(Request $request){

        $categories = Categories::all();
        $tags = Tag::all();
        $styles = Style::where('status',1)->get();
        $query = Logo::where([['approved_status',1],['status',1]]);
        if($request->search !== null ){
            $search_lower = strtolower(str_replace(" ","-",$request->search));
        $query->where([['logo_slug','like',$search_lower.'%']]);
        }
        if($request->style){
            $styleslug = json_decode($request->styles);
           if(count($styleslug) > 0){
            foreach($styleslug as $slug){
                $styles = Style::where('slug',$slug)->first();
                $styleid[] =  $styles->id;
            }
            $query->whereHas('style', function ($stylesQuery) use ($styleid) {
                $stylesQuery->whereIn('id', $styleid);
            });
            }
        }

        if($request->categories){
            
            $categoryslug = json_decode($request->categories);
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
        if($request->tags){
            
            $tagsslug = json_decode($request->tags);
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

        return view('users.logos.index',compact('request','categories','tags','logos','styles'));
    }
    public function logodetail(Request $request, $slug){
        $logo = Logo::where([['logo_slug',$slug],['approved_status',1],['status',1]])->first();
        $category_slug = Categories::find($logo->category_id)->slug;
        if(empty($logo)){
            abort(404);
        }
        $similar_logos = Logo::where([['category_id',$logo->category_id],['approved_status',1],['status',1],['id','!=',$logo->id]])->take(4)->get();
        return view('users.logos.logodetails',compact('request','logo','similar_logos','category_slug'));
    }
    public function download_page(Request $request){

    }
    public function logoFilter(Request $request){
        // return $request->all();
       $query = Logo::with('media')->where([['approved_status',1],['status',1]]);
       
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
       if($request->tags){
        $tagsslug = $request->tags;
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
       return response()->json($query->paginate(20));
    }
}

<?php

namespace App\Http\Controllers\User\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Tag;
use App\Models\Logo;

class FrontLogoController extends Controller
{
    public function index(Request $request){
        $categories = Categories::all();
        $tags = Tag::all();
        if($request->search){
            $search_lower = strtolower(str_replace(" ","-",$request->search));
        $logos = Logo::where([['approved_status',1],['status',1],['logo_slug','like',$search_lower.'%']])->paginate(20);
        }else{
        $logos = Logo::where([['approved_status',1],['status',1]])->paginate(20);
        }

        return view('users.logos.index',compact('request','categories','tags','logos'));
    }
    public function logodetail(Request $request, $slug){
        $logo = Logo::where([['logo_slug',$slug],['approved_status',1],['status',1]])->first();
        if(empty($logo)){
            abort(404);
        }
        $similar_logos = Logo::where([['category_id',$logo->category_id],['approved_status',1],['status',1],['id','!=',$logo->id]])->take(4)->get();
        return view('users.logos.logodetails',compact('request','logo','similar_logos'));
    }
    public function download_page(){
        
    }
}

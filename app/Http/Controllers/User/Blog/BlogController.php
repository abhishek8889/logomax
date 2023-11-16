<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogContent;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(Request $request){
        $blogs = Blog::orderBy('created_at', 'desc')->with('user')->get();

        $meta_title = BlogContent::where('key','meta-title')->first()->value;
        $meta_description = BlogContent::where('key','meta-description')->first()->value;
        $meta_language = BlogContent::where('key','meta-language')->first()->value;
        $meta_country = BlogContent::where('key','meta-country')->first()->value;

        return view('users.blog.index',compact('request','blogs','meta_title','meta_description','meta_language','meta_country'));
    }
    public function blogDetail(Request $request, $slug)
    {

        if (!$slug) {
            return redirect()->back()->with('error', 'Invalid blog details!');
        }
    
        $blog = Blog::where('slug', $slug)->with('user')->first();
    
        if (!$blog) {
            return redirect()->back()->with('error', 'Invalid blog details!');
        }
        $relatedBlog = Blog::where('category_id', $blog->category_id)
        ->where('id','!=',$blog->id)
        ->orwhereJsonContains('tags', $blog->tag_id)
        ->take(3)
        ->get();
        return view('users.blog.blog-detail', compact('request', 'blog','relatedBlog'));
    }
    public function blogsearch(Request $request){
        // return $request->all();
        $searchvalue = strtolower(str_replace(" ","-",$request->searchvalue));
        $blogs = Blog::where([['status',1],['slug','like',$searchvalue.'%']])->with('user')->get();
        return response()->json($blogs);
    }
    
}

<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function index(Request $request){
        $blogs = Blog::orderBy('created_at', 'desc')->with('user')->get();
        return view('users.blog.index',compact('request','blogs'));
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
    
}

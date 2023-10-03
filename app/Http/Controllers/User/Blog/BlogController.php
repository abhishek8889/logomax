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
    public function blogDetail(Request $request , $slug){
        return view('users.blog.blog-detail',compact('request'));
    }
}

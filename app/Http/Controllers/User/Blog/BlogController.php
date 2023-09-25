<?php

namespace App\Http\Controllers\User\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request){
        return view('users.blog.index',compact('request'));
    }
    public function blogDetail(Request $request , $slug){
        return view('users.blog.blog-detail',compact('request'));
    }
}

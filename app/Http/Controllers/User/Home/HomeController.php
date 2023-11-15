<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\HomeContent;
use App\Models\Tag;
use App\Models\LogoReview;

class HomeController extends Controller
{
    Public function index(Request $request){
        $tags = Tag::orderBy('created_at', 'desc')->get();
        $categories = Categories::all();
        $review = LogoReview::where([['approved',1],['status',1],['home_page_status',1]])->get();
        $homeContent = HomeContent::all();
        return view('users.home.index',compact('request','categories','tags','homeContent','review'));
    }
}

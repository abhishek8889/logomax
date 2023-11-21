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
        $meta_title = '';
        $meta_description = '';
        $meta_language ='';
        $meta_country = '';
        if(HomeContent::where('key','meta-title')->first()){
            $meta_title = HomeContent::where('key','meta-title')->first()->value;
        }
        if( HomeContent::where('key','meta-description')->first()){
            $meta_description = HomeContent::where('key','meta-description')->first()->value;
        }
        if( HomeContent::where('key','meta-language')->first()){
            $meta_language = HomeContent::where('key','meta-language')->first()->value;
        }
        if(  HomeContent::where('key','meta-country')->first()){
            $meta_country = HomeContent::where('key','meta-country')->first()->value;
        }
        
       

        return view('users.home.index',compact('request','categories','tags','homeContent','review','meta_title','meta_description','meta_language','meta_country'));
    }
}

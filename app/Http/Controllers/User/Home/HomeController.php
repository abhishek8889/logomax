<?php

namespace App\Http\Controllers\User\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Tag;
class HomeController extends Controller
{
    Public function index(Request $request){
        $tags = Tag::orderBy('created_at', 'desc')->get();

        $categories = Categories::all();
        return view('users.home.index',compact('request','categories','tags'));
    }
}

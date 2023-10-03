<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminBlogController extends Controller
{
    public function index(){

        return view('admin.blog.index');
       }
       public function add(){
    
        return view('admin.blog.addblog');
       }
       public function addProcc(Request $request){
        echo '<pre>';
        print_r($request->all());
        echo '</pre>';
       }
}

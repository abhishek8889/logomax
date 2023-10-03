<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlogController extends Controller
{
   public function index(){

   }
   public function add(){

   }
   public function addProc(Request $request){
    echo '<pre>';
    print_r($request->all());
    echo '</pre>';
   }
}

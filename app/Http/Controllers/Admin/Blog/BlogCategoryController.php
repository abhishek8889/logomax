<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{
   public function index(){
    $category = BlogCategory::all();

    return view('admin.blog.blogcategory',compact('category'));
   }
   public function addprocc(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // echo '</pre>';
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:blog_categories,slug,'.$request->id,
        ]);

        if($request->id){
            $category = BlogCategory::find($request->id);
            $category->category_name = $request->name;
            $category->slug = $request->slug;
            $category->update();
            return redirect()->back()->with('success','Successfully save blogs');
        }else{
            $category = new BlogCategory;
            $category->category_name = $request->name;
            $category->slug = $request->slug;
            $category->save();
            return redirect()->back()->with('success','Successfully updated blogs');
        }
   }
   public function delete($id){
    $category = BlogCategory::find($id);
    if(!($category)){
     return redirect()->back()->with('error','Something went wrong');
    }
    $category->delete();
    return redirect()->back()->with('success','successfully deleted category');

   }
}

<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
   public function index(){
    $categories_data = Categories::with('parent_categories')->get();
// dd($categories_data);
    $categories = Categories::with('parent')->get();
    // dd($categories);
    return view('admin.categories.index',compact('categories'));
   }
   public function addCategories($slug = null){
    if($slug){
    $categories = Categories::where([['slug','!=',$slug],['parent_category',null]])->get();
    }else{
    $categories = Categories::where('parent_category',null)->get();
    }
    $edit_category = Categories::where('slug',$slug)->first();
    return view('admin.categories.addcategories',compact('categories','edit_category'));
   }
   public function addproc(Request $request){
    
    if($request->id){
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,id,'.$request->id,
        ]);
        $category = Categories::find($request->id);
        if($request->hasFile('category_image')){
            $file = $request->file('category_image');
            $filename = $category->slug.rand(0,100).'.'.$file->extension();
            $file->move(public_path().'/category_images/', $filename);
        $category->image = $filename;
        }
   
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->parent_category = $request->parent_category;
        
        $category->update();
        return redirect()->back()->with('success','successfully updated categories');  
    }else{
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories',
            'category_image' => 'required'
        ]);
        if($request->hasFile('category_image')){
          
            $file = $request->file('category_image');
            $filename = $request->slug.rand(0,100).'.'.$file->extension();
            $file->move(public_path().'/category_images/', $filename);
        }
        $category = new Categories();
        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->image = $filename;
        $category->parent_category = $request->parent_category;
        $category->save();
        return redirect()->back()->with('success','successfully saved categories');
    }
   }
   public function delete(Request $request ,$id){
    // print_r($id);
    $category = Categories::find($id);
    $parent_cat = Categories::where('parent_category',$id)->get('id');
    foreach($parent_cat as $pc){
      $parent_update = Categories::find($pc->id);
      $parent_update->parent_category = null;
      $parent_update->update();
    }
    $category->delete();
    return redirect()->back()->with('success','successfully deleted data');
}

    public function getCategories(){

        $category = Categories::get();
        $parent_cat = Categories::where('parent_category',null)->with('parent_categories')->get()->toArray();

        echo '<pre>';
        print_r($parent_cat);
        echo '</pre>';
    }

}
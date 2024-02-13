<?php

namespace App\Http\Controllers\Admin\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\CategoriesTranslations;

class CategoriesController extends Controller
{
   public function index(Request $request){
   
    $categories_data = Categories::with('parent_categories')->get();
    // dd($categories_data);
    $categories = Categories::with('parent')->get();
    // dd($categories);
    return view('admin.categories.index',compact('categories'));
   }
   public function addCategories($slug = null){
    if($slug){
    $categories = Categories::with('translation')->where([['slug','!=',$slug],['parent_category',null]])->get();
    }else{
    $categories = Categories::with('translation')->where('parent_category',null)->get();
    }
    $edit_category = Categories::with('translationBackend')->where('slug',$slug)->first();
    // dd($edit_category);
    return view('admin.categories.addcategories',compact('categories','edit_category'));
   }
   public function addproc(Request $request){
    $on_admin_lang_code = $request->session()->get('on_admin_lang_code');
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
        
        $category_translation = new CategoriesTranslations;
        $category_translation->category_id = $category->id;
        $category_translation->lang_code = $on_admin_lang_code;
        $category_translation->name =  $request->name;
        $category_translation->save();

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
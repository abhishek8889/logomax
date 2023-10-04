<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Auth;

class AdminBlogController extends Controller
{
    public function index(){
        $blogs = Blog::all();
        $tags = Tag::all();

        return view('admin.blog.index',compact('blogs','tags'));
       }
       public function add(){
        $category = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blog.addblog',compact('category','tags'));
       }
       public function edit($slug){
        $blogs = Blog::where('slug',$slug)->first();
        if(!($blogs)){
            abort(404);
        }
        $category = BlogCategory::all();
        $tags = Tag::all();
        return view('admin.blog.editblog',compact('blogs','category','tags'));
       }
       public function addProcc(Request $request){
        
        $request->validate([
            'title' => 'required|unique:blogs,title,'.$request->id,
            'subtitle' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);
        if($request->id){
            $blogs = Blog::find($request->id);
            $blogs->title = $request->title;
            $blogs->slug = str_replace(" ","-",strtolower($request->title));
            $blogs->sub_title = $request->subtitle;
            if($request->hasFile('banner_image')){
          
                $file = $request->file('banner_image');
                $filename = $request->title.rand(0,100).'.'.$file->extension();
                $file->move(public_path().'/blog_images/', $filename);
                $blogs->banner_img = $filename;
            }
            $blogs->description = $request->description;
            $blogs->created_by = Auth::user()->id;
            $blogs->category_id = $request->category;
            $blogs->tags = json_encode($request->tags);
            $blogs->update();
            return redirect('admin-dashboard/blogs/edit/'.$blogs->slug)->with('success','successfully updated blog');
        }else{
       $request->validate([
        'banner_image' => 'required',
       ]);
        $blogs = new Blog;
        $blogs->title = $request->title;
        $blogs->slug = str_replace(" ","-",strtolower($request->title));
        $blogs->sub_title = $request->subtitle;
        if($request->hasFile('banner_image')){
          
            $file = $request->file('banner_image');
            $filename = $request->title.rand(0,100).'.'.$file->extension();
            $file->move(public_path().'/blog_images/', $filename);
            $blogs->banner_img = $filename;
        }
        $blogs->description = $request->description;
        $blogs->created_by = Auth::user()->id;
        $blogs->category_id = $request->category;
        $blogs->tags = json_encode($request->tags);
        $blogs->save();
        
        return redirect()->back()->with('success','successfully posted blog');
        }
       }
       
       public function delete($id){
        $blogs = Blog::find($id);
        if($blogs){
            $blogs->delete();
            return redirect()->back()->with('success','successfully added blogs');
        }else{
            return redirect()->back()->with('error','something went wrong');
        }

       }

}

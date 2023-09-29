<?php

namespace App\Http\Controllers\Admin\Tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function addtags(){
    $tags = Tag::where('status',1)->get();
  
    return view('admin.tags.addtags',compact('tags'));
    }
    public function submitProc(Request $request){
        if($request->id){
        
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:tags,slug,'.$request->id,
            ]);
            $tags = Tag::find($request->id);
            $tags->name = $request->name;
            $tags->slug = $request->slug;
            $tags->status = 1;
            $tags->update();
            return redirect()->back()->with('success','successfully updated tag');
        }else{
            $request->validate([
                'name' => 'required',
                'slug' => 'required|unique:tags,slug'
            ]);
            $tags = new Tag;
            $tags->name = $request->name;
            $tags->slug = $request->slug;
            $tags->status = 1;
            $tags->save();
            return redirect()->back()->with('success','successfully saved new tag');
        }
    }
    public function delete($id){
        $tags = Tag::find($id);
        if($tags){
            $tags->delete();
            return redirect()->back()->with('success','successfully deleted');
        }else{
            return redirect()->back()->with('error','something went wrong');
        }
        
    }
}

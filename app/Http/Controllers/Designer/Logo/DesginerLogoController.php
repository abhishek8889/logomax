<?php

namespace App\Http\Controllers\Designer\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Media;
use App\Models\Categories;
use App\Models\Logo;
use File;
use Auth;

class DesginerLogoController extends Controller
{
   public function index(){
        $logos = Logo::with('category','media')->get();
    //   dd($logos);
        return view('designer.logos.index',compact('logos'));
   }
   public function upload(Request $request){
    $categories = Categories::all();
    $tags = Tag::where('status',1)->get();
    return view('designer.logos.addlogos',compact('categories','tags'));
   }
   
   public function uploadProc(Request $request){
    
    if($request->hasFile('file')){
        $request->validate([
            'file' => 'required|mimes:ai,png'
        ]);
        $file = $request->file('file');
        $name = 'Logo_'.time().rand(1,100).'.'.$file->extension();
        $file->move(public_path().'/logos/', $name);

        $media = new Media;
        $media->image_name = $name;
        $media->image_path = '/logos/'.$name;
        $media->save();
        return response()->json($media);
    }else{
        $request->validate([
            'logo_name' => 'required',
            'logo_slug' => 'required|unique:logos',
            'categories' => 'required',
            'tags' => 'required',
            'media_id' => 'required',
        ]);

        $logos = new Logo;
        $logos->logo_name = $request->logo_name;
        $logos->logo_slug = $request->logo_slug;
        $logos->media_id = $request->media_id;
        $logos->tags = json_encode($request->tags);
        $logos->category_id = $request->categories;
        $logos->approved_status = 0;
        $logos->status = 1;
        $logos->designer_id = Auth::user()->id;
        $logos->save();
        return redirect()->back()->with('success','successfully saved data');





    }

    // return $request->file;
}
   public function addtag(Request $request){
    $tags = new Tag;
    $tags->name = $request->name;
    $tags->slug = $request->slug;
    $tags->status = 1;
    $tags->save();
    return response()->json($tags);
   }
   public function deleteimage(Request $request){
    $media = Media::find($request->mediaid);
    if($media){
        $media->delete();
        return response()->json('deleted');
    }else{
        return reponse()->json('something went worng');
    }
   }

}

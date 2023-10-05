<?php

namespace App\Http\Controllers\Designer\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Media;
use App\Models\Categories;
use App\Models\Logo;
use App\Events\RegisterNotificationEvent;
use App\Models\Notifications;
use File;
use Auth;
use App\Mail\LogoAddedByDesigner;
use Mail;

class DesginerLogoController extends Controller
{
   public function index(){
        $logos = Logo::where('designer_id',Auth::user()->id)->with('category','media')->get();
    //   dd($logos);
        return view('designer.logos.index',compact('logos'));
   }
    public function upload(Request $request){
        $categories = Categories::all();
        $tags = Tag::where('status',1)->get();
        return view('designer.logos.addlogos',compact('categories','tags'));
    }
   
    public function uploadProc(Request $request){
        if(auth()->user()->is_approved !== 0 && auth()->user()->is_approved !== 2){
            if($request->hasFile('file')){
                $request->validate([
                    'file' => 'required|mimes:ai,png'
                ]);
                $file = $request->file('file');
                $name = 'Logo_'.time().rand(1,100).'.'.$file->extension();
                $filesize = getimagesize($file);
                $filesizekb = filesize($file);
                // return ($filesizekb/1000).' KB';
                $file->move(public_path().'/logos/', $name);
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                $media->image_size = ($filesizekb/1000).' KB';
                $media->image_dimensions = $filesize[3];
                $media->image_format = $filesize['mime'];
                $media->save();
                return response()->json($media);
            }else{
                $request->validate([
                    'logo_name' => 'required',
                    'logo_slug' => 'required|unique:logos',
                    'categories' => 'required',
                    'tags' => 'required',
                    'media_id' => 'required',
                ],[
                    'logo_name.required' => 'logo name is required',
                    'logo_slug.required' => 'logo slug is required',
                    'categories.required' => 'logo category is required',
                    'tags.required' => 'tag is required',
                    'media_id.required' => 'Please upload your logo',
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
                    // Send notification to admin ::::::::: 

                    $notifications = Notifications::create(array(
                        'type' => 'logo-added',
                        'sender_id' => '0',
                        'reciever_id' => '0',
                        'designer_id' => Auth::user()->id,
                        'logo_id' => $logos->id,
                        'message' => 'New logo is <span>Added !</span>'
                    )); 
                    $eventData = array(
                        'type' => 'logo-added',
                        'designer_id' => Auth::user()->id,
                        'notification_id' => $notifications->id,
                        'logo_id' =>$logos->id,
                        'message' => 'New logo is <span>Added !</span>'
                    );
                
                event(new RegisterNotificationEvent($eventData));
                $mailData = array(
                    'data' => ''
                );
                $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoAddedByDesigner($mailData));

                return redirect()->back()->with('success','You have succesfully uploaded the logo !');
            }
        }else{
            return redirect()->back()->with('error','You are not able to upload any logo until your account is not approved !');
        }
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

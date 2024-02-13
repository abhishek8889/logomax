<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use App\Models\Logo;
use App\Models\Media;
use App\Models\Wishlist;
use Illuminate\Http\RedirectResponse;
use Session;


class BasicController extends Controller
{
    public function readNotification(Request $req){
        $notification_id = $req->notification_id;
        if(auth()->user()->role_id == 3){  // All Admin read notification function are here :::::::::::::
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',0]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);

                if($notification->type == 'logo-added'){ // :: new logo is added by designer :::::::::::::
                    $logo = Logo::find($notification->logo_id);
                    $logo_slug = $logo->logo_slug;
                    $notification->is_read = 1;
                    $notification->update();
                    return redirect('admin-dashboard/logo-detail/'.$logo_slug);
                } 
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }elseif(auth()->user()->role_id == 2){  // All Designer read notification function are here ::::::::
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',auth()->user()->id]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }elseif(auth()->user()->role_id == 4){
            if($notification_id == 'all-read' ){
                $admin_notifications = Notifications::where([['is_read' ,'=' , 0],['reciever_id','=',auth()->user()->id]])->update(['is_read'=>1]);
                return redirect()->back();
            }else{
                $notification = Notifications::find($notification_id);
                $notification->is_read = 1;
                $notification->update();
                return redirect()->back();
            }
        }else{
            return redirect()->back()->with('error','Hey buddy where are you.');
        }
    }
    public function downloadFile(Request $req){
        // dd('adsfadfs');
        $media_id = $req->media_id;
        $mediaObj = Media::find($media_id);
        if($mediaObj){
            // dd($mediaObj);
            $filePath = public_path($mediaObj->image_path);
            // dd($filePath);
            if (file_exists($filePath)) {
                return response()->download($filePath,$mediaObj->image_name);
            } else {
                return redirect()->back()->with('error','There is some error in downloading please contact with support.');
            }
        }else{
            return redirect()->back()->with('error','There is some error in downloading please contact with support.');
        }
    }
    public function addToWishlist(Request $request){
        // return $request->all();
        $user_id = $request->user_id;
        $logo_id = $request->logo_id;
        $wishlist_data = Wishlist::where([['user_id','=',$user_id],['logo_id','=',$logo_id]])->first();
        if($wishlist_data){
            $wishlist_data->delete();
            $response = array(
                'status' => 204,
                'message' => 'logo remove from wishlist',
            );
            return response()->json($response , 204);
        }else{
            $wishlist = new Wishlist;
            $wishlist->logo_id = $logo_id;
            $wishlist->user_id = $user_id;
            $wishlist->save();
            $response = array(
                'status' => 201,
                'message' => 'logo added to wishlist',
            );
            return response()->json($response , 201);
        }
    }
    public function changeLaguage(Request $request,$language){

        app()->setLocale($language);
        $previousUrl = $request->headers->get('referer');
        
        $pattern = '/\/\/logomax\.com\/([a-z]+-[a-z]+)\b/';
        if (preg_match($pattern, $previousUrl, $matches)) {
            $firstSegment = $matches[1];
            $urlWithLanguage =  preg_replace($pattern, "//logomax.com/$language", $previousUrl,-1);
        } else {
            $baseurl = url('');
            $urlWithLanguage = $baseurl . '/' . $language . '/' . ltrim($previousUrl, $baseurl);
            $firstSegment = $language;
        }
        // echo 'url with lang -> ' . $urlWithLanguage;
        return redirect($urlWithLanguage)->with('from','change_lang');     
    }
    
    public function changeCurrency(Request $request,$currency){
        $session = $request->session()->put('currency',$currency);
 
        return redirect()->back();
    }

    // public function sendSearchRequest(Request $req){
      
    //     return  $req->urlpath;
    // }
}

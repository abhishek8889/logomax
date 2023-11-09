<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMeta;
use App\Models\SupportContent;

class SiteContentController extends Controller
{
    public function siteConfiguration(Request $req){
        $siteMetas = SiteMeta::all();
        return view('admin/configuration.site_setting',compact('siteMetas'));
    }
    public function updateSiteConfiguration(Request $req){
        dd($req);
    }
    public function updateImage(Request $req){
        if($req->hasFile('image') && !empty($req->fileID)){
            $meta_row = SiteMeta::find($req->fileID);
           
            if($meta_row->meta_type == 'image'){
                $existing_file = $meta_row->meta_value;
                if(\File::exists(public_path('siteMeta/'.$existing_file))){
                    \File::delete(public_path('siteMeta/'.$existing_file));
                    // echo "fileexist";
                }
            }
            $file = $req->file('image');
            $filename = str_replace(" ","_",$meta_row->meta_name).'_'.time().'.'.$file->extension();
            $file->move(public_path().'/siteMeta/', $filename);
            $meta_row->meta_value = $filename;
            $meta_row->update();
            $response = array(
                'success' => 'Succesfully updated image !',
                'status' => 201,
            );
            return response()->json($response,201);
        }else{
            return false;
        }
        return "no file";
    }
    public function homeContent(){
        return true;
    }

    public function aboutContent(){
        return true;
    }

    public function supportContent(){
        $support_text =  SupportContent::where('meta_key','support_text')->first();
        

        return view('admin.site_content.support.index',compact('support_text'));
    }
    public function supportContentSubmit(Request $request){
        $supportContent = SupportContent::find($request->id);
        $supportContent->type = $request->meta_type;
        $supportContent->meta_value = $request->meta_value;
        $supportContent->update();
        return redirect()->back()->with('success','Successfully updated support page content');        
    }
}

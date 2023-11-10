<?php

namespace App\Http\Controllers\Admin\SiteMeta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMeta;
use App\Models\SupportContent;

class SiteMetaController extends Controller
{
    public function index(){
        $sitemeta = SiteMeta::all();
        return view('admin.sitemeta.index',compact('sitemeta'));
    }
    public function addMeta($meta_key = null){
        if($meta_key){
            $meta = SiteMeta::where('meta_key',$meta_key)->first();
        }else{
            $meta = null;
        }
        return view('admin.sitemeta.addmeta',compact('meta'));
    }
    public function addProcc(Request $request){
       
        $request->validate([
            'meta_name' => 'required|unique:site_metas,meta_name,'.$request->id,
            'meta_type' => 'required',
            'meta_value' => 'required',
        ]);
        if($request->id){
            $sitemeta = SiteMeta::find($request->id);
            $sitemeta->meta_name = $request->meta_name;
            $sitemeta->meta_type = $request->meta_type;
            if($request->meta_type == 'image'){
                if($request->hasFile('meta_value')){
                    if(\File::exists(public_path('siteMeta/'.$sitemeta->meta_value))){
                        \File::delete(public_path('siteMeta/'.$sitemeta->meta_value));
                    }
                    $file = $request->file('meta_value');
                    $filename = str_replace(" ","_",$request->meta_name).'_'.time().'.'.$file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $sitemeta->meta_value = $filename;
                }
            }elseif($request->meta_type == 'textarea'){
               $sitemeta->meta_value = $request->meta_value;
            }
            $sitemeta->update();
            return redirect()->back()->with('success','Successfully updated new site meta');
        }else{
            $sitemeta = new SiteMeta;
            $sitemeta->meta_name = $request->meta_name;
            $sitemeta->meta_key = str_replace(" ","-",strtolower($request->meta_name));
            $sitemeta->meta_type = $request->meta_type;
            if($request->meta_type == 'image'){
                if($request->hasFile('meta_value')){
                    $file = $request->file('meta_value');
                    $filename = str_replace(" ","_",$request->meta_name).'_'.time().'.'.$file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $sitemeta->meta_value = $filename;
                }
            }elseif($request->meta_type == 'textarea'){
               $sitemeta->meta_value = $request->meta_value;
            }
            $sitemeta->save();
            return redirect()->back()->with('success','Successfully saved new site meta');
        }

    }
    public function sitemetadelete($id){
        $sitemeta = SiteMeta::find($id);
        if(!$sitemeta){
            abort(404);
        }
        $sitemeta->delete();
        return redirect()->back()->with('success','Successfully deleted sitemeta');
    }
    public function SupportContent($sitekey = null){
    
        if($sitekey){
            $meta = SupportContent::where('meta_key',$sitekey)->first();;
        }else{
            $meta = null;
        }

        $supportmeta = SupportContent::all();
        
        return view('admin.site_content.support.index',compact('meta','supportmeta'));
    }
    public function supportSubmit(Request $request){
      
        $request->validate([
            'meta_name' => 'required|unique:support_contents,meta_name,'.$request->id,
            'meta_type' => 'required',
            'meta_value' => 'required',
        ]);
        if($request->id){
            $sitemeta = SupportContent::find($request->id);
            $sitemeta->meta_name = $request->meta_name;
            $sitemeta->type = $request->meta_type;
            if($request->meta_type == 'image'){
                if($request->hasFile('meta_value')){
                    if(\File::exists(public_path('siteMeta/'.$sitemeta->meta_value))){
                        \File::delete(public_path('siteMeta/'.$sitemeta->meta_value));
                    }
                    $file = $request->file('meta_value');
                    $filename = str_replace(" ","_",$request->meta_name).'_'.time().'.'.$file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $sitemeta->meta_value = $filename;
                }
            }elseif($request->meta_type == 'textarea'){
               $sitemeta->meta_value = $request->meta_value;
            }
            $sitemeta->update();
            return redirect()->back()->with('success','Successfully updated new site meta');
        }else{
            $sitemeta = new SupportContent;
            $sitemeta->meta_name = $request->meta_name;
            $sitemeta->meta_key = str_replace(" ","-",strtolower($request->meta_name));
            $sitemeta->type = $request->meta_type;
            if($request->meta_type == 'image'){
                if($request->hasFile('meta_value')){
                    $file = $request->file('meta_value');
                    $filename = str_replace(" ","_",$request->meta_name).'_'.time().'.'.$file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $sitemeta->meta_value = $filename;
                }
            }elseif($request->meta_type == 'textarea'){
               $sitemeta->meta_value = $request->meta_value;
            }
            $sitemeta->save();
            return redirect()->back()->with('success','Successfully saved new site meta');
        }

    }
    public function supportmetaDelete($id){
        $meta = SupportContent::where('meta_key',$id)->first();
        if(!$meta){
            abort(404);
        }
        $meta->delete();
        return redirect()->back()->with('successfully deleted');
    }
}

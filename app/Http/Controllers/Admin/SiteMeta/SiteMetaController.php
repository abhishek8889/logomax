<?php

namespace App\Http\Controllers\Admin\SiteMeta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMeta;

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
}

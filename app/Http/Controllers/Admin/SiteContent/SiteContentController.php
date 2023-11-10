<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use App\Models\SiteMeta;

class SiteContentController extends Controller
{

    public function homeContentPage(){

        return view('admin.site_content.home.add_home_content');
    }
    public function siteConfiguration(Request $req){
        $siteMetas = SiteMeta::all();
        return view('admin/configuration.site_setting',compact('siteMetas'));
    }

    public function updateHomeConfiguration(Request $req){
        foreach ($req->all() as $key => $value) {
            $content = HomeContent::find($key);
    
            if ($content) {
                if ($req->hasFile($key)) {
                    $req->validate([
                        $key => 'image|mimes:jpeg,png,jpg,gif|max:5048', 
                    ]);
                    $file = $req->file($key);
                    $filename = str_replace(" ", "_", $key) . '_' . time() . '.' . $file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $content->value = $filename;
                } elseif ($content->type == 'textarea') {
                    $content->value = $value;
                }
    
                $content->save();
            }
        }
    return redirect()->back()->with('success','Updated Home Content Successfully');
    }


    public function homeConfigurationContent(){
        $sitecontent = HomeContent::all();
        return view('admin/configuration.site_content',compact('sitecontent'));
    }

    public function homeContentList(){
        $sitecontent = HomeContent::all();
        return view('admin.site_content.home.list_home_content',compact('sitecontent'));
    }
    public function homeContent(Request $req){
        $req->validate([
            'field_name'=>'required',
            'field_slug'=>'required',
            'field_type'=>'required'
        ]);
        $content = new HomeContent;
        $content->name = $req->field_name;
        $content->key = $req->field_slug;
        if($req->field_type == 'image'){
            $content->type = $req->field_type;
            if($req->hasFile('field_value')){
                    $file = $req->file('field_value');
                    $filename = str_replace(" ","_",$req->field_name).'_'.time().'.'.$file->extension();
                    $file->move(public_path().'/siteMeta/', $filename);
                    $content->value = $filename;

        }
        }
        elseif($req->field_type == 'textarea'){
            $content->type = $req->field_type;
            $content->value = $req->field_value;
        }
        $content->save();
        return redirect()->back()->with('success','Successfully added Site Content');
    }

}

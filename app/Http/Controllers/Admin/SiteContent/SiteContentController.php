<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{

    public function homeContentPage(){

        return view('admin.site_content.home.add_home_content');
    }
    public function homeContentList(){
        $sitecontent = SiteContent::all();
        return view('admin.site_content.home.list_home_content',compact('sitecontent'));
    }
    public function addHomeContent(Request $req){
        $req->validate([
            'field_name'=>'required',
            'field_slug'=>'required',
            'field_type'=>'required'
        ]);
        $content = new SiteContent;
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
    public function aboutContent(){
        return true;
    }
}

<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMeta;

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

    }
    public function homeContent(){
        return true;
    }

    public function aboutContent(){
        return true;
    }

    public function supportContent(Request $request){
        
    }
}

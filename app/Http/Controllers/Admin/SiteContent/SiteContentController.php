<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\AboutUsContent;
use Illuminate\Http\Request;
use App\Models\SiteMeta;
use App\Models\SupportContent;

class SiteContentController extends Controller
{

    public function siteConfiguration(Request $req)
    {
        $siteMetas = SiteMeta::all();
        return view('admin/configuration.site_setting', compact('siteMetas'));
    }
    public function updateSiteConfiguration(Request $req)
    {
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
    public function homeContent()
    {
        return true;
    }
    //////////////////////// about page function \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function aboutContent()
    {

        return view('admin.site_content.about_us.add_about_us_content');
    }

    public function supportContent(){
        $support_text =  SupportContent::where('meta_key','support_text')->first();
        

        return view('admin.configuration.support_page',compact('support_text'));
    }
    public function supportContentSubmit(Request $request){
        $supportContent = SupportContent::find($request->id);
        $supportContent->type = $request->meta_type;
        $supportContent->meta_value = $request->meta_value;
        $supportContent->update();
        return redirect()->back()->with('success','Successfully updated support page content');   
    }     
    public function aboutAddProcess(Request $request)
    {
        //   dd($request->all());
        $request->validate([
            'content_name' => 'required',
            'slug' => 'required|unique:about_us_contents,key',
            'content_type' => 'required',
            'content_value' => 'required'
        ]);
        $data = new AboutUsContent;
        $data->name = $request->content_name;
        $data->key = $request->slug;
        if ($request->content_type == 'textarea') {
            $data->value = $request->content_value;
        } else if ($request->content_type == 'file') {
            if ($request->hasFile('content_value')) {
                $file = $request->file('content_value');
                $timestamp = now()->format('Y-m-d_His');
                $filename = $timestamp . '_' . $file->getClientOriginalName();
                $file->move(public_path() . '/siteMeta/', $filename);
                $data->value = $filename;
            }
        } else { 
            $data->value = $request->content_value;
        }
        $data->type = $request->content_type;
        $data->save();
        return redirect()->back()->with('success', 'content added successfully');
    }

    public function aboutPageSetting()
    {
        $aboutdata = AboutUsContent::all();
        return view('admin.configuration.about_page', compact('aboutdata'));
    }

    public function aboutPageupdate(Request $req)
    {
        // dd($req->all());
        foreach ($req->all() as $key => $value) {
            $data = AboutUsContent::find($key);
            if ($data) {
                if ($req->hasFile($key)) {
                    $file = $value;
                    $timestamp = now()->format('Y-m-d_His');
                    $filename = $timestamp . '_' . $file->getClientOriginalName();
                    $file->move(public_path() . '/siteMeta/', $filename);
                    $img = $filename;
                    $data->update(['value' => $img]);
                } else {
                    $data->update(['value' => $value]);
                }
            }
        }
        return redirect()->back()->with('success', 'content added successfully');
    }
    //////////////////////////////////////////////////////////////////////////////////////

}

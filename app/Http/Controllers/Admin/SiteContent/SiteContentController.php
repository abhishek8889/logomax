<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\AboutUsContent;
use Illuminate\Http\Request;
use App\Models\SiteMeta;

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
    public function updateImage(Request $req)
    {

    }
    public function homeContent()
    {
        return true;
    }
    //////////////////////// about page function \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function aboutContent()
    {
        $meta = '';
        return view('admin.site_content.about_us.add_about_us_content', compact('meta'));
    }

    public function aboutAddProcess(Request $request)
    {
        // dd($request->all());
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
        //  dd($req->all());

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

    }
    //////////////////////////////////////////////////////////////////////////////////////


    public function supportContent(Request $request)
    {

    }
}

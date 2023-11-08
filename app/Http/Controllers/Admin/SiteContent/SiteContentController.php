<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\AboutUsContent;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
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
        // dd($request);
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
        } else {
            if ($request->hasFile('content_value')) {
                $file = $request->file('content_value');
                $timestamp = now()->format('Y-m-d_His');
                $filename = $timestamp . '_' . $file->getClientOriginalName();
                 $file->move(public_path() . '/siteMeta/', $filename);
                $data->value = $filename;
            }
        }
        $data->type = $request->content_type;
        $data->save();
        return redirect()->back()->with('success', 'content added successfully');
    }


}

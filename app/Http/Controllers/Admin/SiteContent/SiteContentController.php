<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use App\Models\AboutUsContent;
use App\Models\HomeContent;
use Illuminate\Http\Request;
use App\Models\SiteMeta;
use App\Models\SupportContent;
use App\Models\LoginContent;
use App\Models\RegisterContent;
use App\Models\BlogContent;
use App\Models\ReviewContent;
use App\Models\ShopContent;
use App\Models\TermCondition;
use File;

class SiteContentController extends Controller
{

    public function homeContentPage(){

        return view('admin.site_content.home.add_home_content');
    }
    public function siteConfiguration(Request $req){
        $siteMetas = SiteMeta::all();
        $lowpricedlogoprice = SiteMeta::where('meta_key','low_price')->first();
        $premiumprice = SiteMeta::where('meta_key','premium_price')->first();
       
        return view('admin/configuration.site_setting', compact('siteMetas','lowpricedlogoprice','premiumprice'));
    }
    public function updateSiteConfiguration(Request $req)
    {
        $req->validate([
            'premium_price' => 'required',
            'low_price' => 'required',
        ]);

        $sitemeta = SiteMeta::where('meta_key','premium_price')->first();
        $sitemeta->meta_value = $req->premium_price;
        $sitemeta->update();

        $sitemeta1 = SiteMeta::where('meta_key','low_price')->first();
        $sitemeta1->meta_value = $req->low_price;
        $sitemeta1->update();

        return redirect()->back()->with('success','Successfully updated');

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
    //////////////////////// about page function \\\\\\\\\\\\\\\\\\\\\\\\\\\\
    public function aboutContent()
    {
        return view('admin.site_content.about_us.add_about_us_content');
    }
    
    public function supportContent(Request $request){
        $admin_selected_lang_code = $request->session()->get('on_admin_lang_code');

        $support_text =  SupportContent::where('lang_code',$admin_selected_lang_code)->get();
        // dd($support_text);
        return view('admin.configuration.support_page',compact('support_text'));
    }

    public function supportContentSubmit(Request $request){
        
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = SupportContent::find($key);
          
            $supportContent->meta_value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated support page content');   
    }     
    public function aboutAddProcess(Request $request)
    {
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

    public function aboutPageSetting(Request $request)
    {
        $admin_selected_lang_code = $request->session()->get('on_admin_lang_code');
        
        $aboutdata = AboutUsContent::where('lang_code',$admin_selected_lang_code)->get();
        
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

    public function homeConfigurationContent(Request $request){
        $admin_selected_lang_code = $request->session()->get('on_admin_lang_code');
        // dd($admin_selected_lang_code);
        $sitecontent = HomeContent::where('lang_code',$admin_selected_lang_code)->get();
   
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

    public function login(){
        $content = LoginContent::all();
        return view('admin.configuration.login_content',compact('content'));
    }
    public function register($lang = null){
        $content = RegisterContent::all();
        if($lang == null){
            $lang = 'en-au';
        }
        return view('admin.configuration.register_content',compact('content','lang'));
    }
    public function blogs($lang = null){
        $content = BlogContent::all();
        if($lang == null){
            $lang = 'en-au';
        }
        return view('admin.configuration.blogs_content',compact('content','lang'));
    }
    public function reviews($lang = null){
        $content = ReviewContent::all();
        if($lang == null){
            $lang = 'en-au';
        }
        return view('admin.configuration.reviews_content',compact('content','lang'));
    }
    public function shop($lang = null){
        $content = ShopContent::all();
        if($lang == null){
            $lang = 'en-au';
        }
        return view('admin.configuration.shop_content',compact('content','lang'));
    }
    public function reviewsSubmit(Request $request){
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = ReviewContent::find($key);
          
            $supportContent->value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated review page content');  
    }
    public function loginSubmit(Request $request){
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = LoginContent::find($key);
          
            $supportContent->value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated login page content');  
    }
    public function registerSubmit(Request $request){
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = RegisterContent::find($key);
          
            $supportContent->value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated register page content');  
    }
    public function blogsSubmit(Request $request){
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = BlogContent::find($key);
          
            $supportContent->value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated blogs page content');  
    }
    public function shopSubmit(Request $request){
        foreach($request->all() as $key=>$value){
            if($key == '_token'){
                continue;
            }
            $supportContent = ShopContent::find($key);
          
            $supportContent->value = $value;
            $supportContent->update();
        }

        return redirect()->back()->with('success','Successfully updated blogs page content');

    }

    public function siteText(Request $request){
        // dd(app()->getLocale());
        $session_lang = $request->session()->get('on_admin_lang_code');
        app()->setLocale($session_lang);
        return view('admin.configuration.site_text');
    }
    public function siteTextUpdate(Request $request){
        // return "hello from ";
        // return $request->session();
        $textVal = $request->data['textVal'];
        $textID = $request->data['textID'];
        $session_lang = $request->session()->get('on_admin_lang_code');
        $filepath = base_path('resources/lang/'.$session_lang.'/file.php');
        $content =File::get($filepath);
        $content = preg_replace("/'$textID' => '(.*)'/", "'$textID' => '$textVal'", $content);
        File::put($filepath, $content);
        return response()->json(['success' => 'succesfully updated!'], 200);
        
    }

    public function termsConditionsContent(Request $request,$id=null){
        $lang_code = $request->session()->get('on_admin_lang_code');
        $terms = TermCondition::where([['language',$lang_code],['parent',null]])->get();
        
        // dd($terms);
        $edit_term = TermCondition::find($id);
        
        return view('admin.site_content.terms_conditions.index',compact('terms','edit_term'));
    }
    public function termsConditionsProcc(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ],[
            'title.required' => 'Title field is required',
            'description.required' => 'Description is required',
        ]);
        $languageList = array(
                'en-us'=>'United States - English',
                'en-au'=>'Australia - English',
                'es-ar' =>'Argentina-Español',
                'en-ca'=>'Canada - English',
                'es-ch'=>'Chile - Español',
                'es-co'=>'Colombia - Español',
                'de-de'=>'Deutschland - Deutsch',
                'es-es'=>'España - Español',
                'es-esu'=>'Estados Unidos - Español',
                'en-hok'=>'Hong Kong - English',
                'en-in'=>'India - English',
                'en-ir'=>'Ireland - English',
                'en-is'=>'Israel - English',
                'en-ma'=>'Malaysia - English',
                'es-me'=>'México - Español',
                'en-nez'=>'New Zealand - English',
                'de-os'=>'Österreich - Deutsch',
                'en-pak'=>'Pakistan - English',
                'es-pe'=>'Perú - Español',
                'en-ph'=>'Philippines - English',
                'de-sc'=>'Schweiz - Deutsch',
                'en-sin'=>'Singapore - English',
                'en-sa'=>'South Africa - English',
                'en-uae'=>'United Arab Emirates - English',
                'en-uk'=>'United Kingdom - English',
                'es-ven'=>'Venezuela - Español'
        );
        if($request->id){
            $terms = TermCondition::find($request->id);
            $terms->title = $request->title;
            $terms->parent = $request->parent;
            $terms->language = $request->session()->get('on_admin_lang_code');
            $terms->description = $request->description;
            $terms->update();
            return redirect()->back()->with('success','Successfully saved terms and conditions');
        }else{
            // foreach($languageList as $key => $value){
                $terms = new TermCondition;
                $terms->title = $request->title;
                $terms->parent = $request->parent;
                $terms->language = app()->getLocale();
                $terms->description = $request->description;
                $terms->save();
            // }


        /////// Upload logo for multiple languages with multi parent regions start ////////
            // for($x=$request->parent; $x < count($languageList)+$request->parent; $x++){
            //     $parent = TermCondition::find($x);
            //     $terms = new TermCondition;
            //     $terms->title = $request->title;
            //     $terms->parent = $parent->id;
            //     $terms->language = $parent->language;
            //     $terms->description = $request->description;
            //     $terms->save();
            // }
                        ////////// end ////////////
            return redirect()->back()->with('success','Successfully saved terms and conditions');
        }
    }
    public function deleteTerms($id){
        $terms = TermCondition::find($id);
        if(!$terms){
            abort(404);
        }
    //     $allanguageterms = TermCondition::where('title',$terms->title)->get();
    //    foreach($allanguageterms as $all){
    //     $languageterm = TermCondition::find($all->id);
        if($terms->parent !== null){
            $child_terms = TermCondition::where('parent',$terms->id)->delete();
        }
        // $languageterm->delete();
        // }
        $terms->delete();
        return redirect('admin-dashboard/configuration/terms-conditions')->with('success','Successfully deleted');


    }
}
<?php

namespace App\Http\Controllers\Admin\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use Auth;
use App\Models\BlogTranslation;

class AdminBlogController extends Controller
{   protected $siteLanguagesList;
    public function __construct(){
        $siteLanguagesList = array(
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
        $this->siteLanguagesList = $siteLanguagesList;
        // return 
    }
        public function index(){
            $blogs = Blog::all();
            $tags = Tag::all();

            return view('admin.blog.index',compact('blogs','tags'));
        }
        public function add(){
            $category = BlogCategory::all();
            $tags = Tag::all();
            return view('admin.blog.addblog',compact('category','tags'));
        }
        public function edit($slug){
            $blogs = Blog::where('slug',$slug)->first();
            if(!($blogs)){
                abort(404);
            }
            $category = BlogCategory::all();
            $tags = Tag::all();
            return view('admin.blog.editblog',compact('blogs','category','tags'));
        }
        public function blogTranslate(Request $request,$slug){
            $blog = Blog::where('slug',$slug)->first();
            $admin_session_lang = $request->session()->get('on_admin_lang_code');
            $blog_id = $slug;
            $blogs = BlogTranslation::where([['blog_id','=',$blog->id],['lang_code','=',$admin_session_lang]])->first();
            // dd($blogs);
            if(!($blogs)){
                abort(404);
            }
            return view('admin.blog.blog_translate',compact('blogs'));
        }
        public function blogTranslateProcess(Request $request){
            // dd($request); 
            $blog_id = $request->blog_id;
            $title = $request->title;
            $subtitle = $request->subtitle;
            $description = $request->description;
            BlogTranslation::where('id',$blog_id)->update([
                'title' => $title,
                'sub_title' => $subtitle,
                'description' => $description,
            ]);
            return redirect()->back()->with('success','Translation text added successfully');

        }
        public function addProcc(Request $request){
            $request->validate([
                'title' => 'required|unique:blogs,title,'.$request->id,
                'subtitle' => 'required',
                'category' => 'required',
                'description' => 'required',
            ]);
            if($request->id){
                $blogs = Blog::find($request->id);
                $blogs->title = $request->title;
                $blogs->slug = str_replace(" ","-",strtolower($request->title));
                $blogs->sub_title = $request->subtitle;
                if($request->hasFile('banner_image')){
            
                    $file = $request->file('banner_image');
                    $filename = $request->title.rand(0,100).'.'.$file->extension();
                    $file->move(public_path().'/blog_images/', $filename);
                    $blogs->banner_img = $filename;
                }
                $blogs->description = $request->description;
                $blogs->created_by = Auth::user()->id;
                $blogs->category_id = $request->category;
                $blogs->tags = json_encode($request->tags);
                $blogs->update();
                return redirect('admin-dashboard/blogs/edit/'.$blogs->slug)->with('success','successfully updated blog');
            }else{
                $request->validate([
                    'banner_image' => 'required',
                ]);
                $blogs = new Blog;
                $blogs->title = $request->title;
                $blogs->slug = str_replace(" ","-",strtolower($request->title));
                $blogs->sub_title = $request->subtitle;
                if($request->hasFile('banner_image')){
                
                    $file = $request->file('banner_image');
                    $filename = $request->title.rand(0,100).'.'.$file->extension();
                    $file->move(public_path().'/blog_images/', $filename);
                    $blogs->banner_img = $filename;
                }
                $blogs->description = $request->description;
                $blogs->created_by = Auth::user()->id;
                $blogs->category_id = $request->category;
                $blogs->tags = json_encode($request->tags);
                $blogs->save();
                // BlogTranslation
                if(isset($this->siteLanguagesList) && is_array($this->siteLanguagesList)){
                    foreach($this->siteLanguagesList as $lang_code => $language){
                        BlogTranslation::create([
                            'blog_id' => $blogs->id,
                            'title' => $request->title,
                            'language' => $language,
                            'lang_code' => $lang_code,
                            'sub_title' => $request->subtitle,
                            'description' => $request->description,
                        ]);
                    }
                }

                return redirect()->back()->with('success','successfully posted blog');
            }
        }
       
       public function delete($id){
        $blogs = Blog::find($id);
        if($blogs){
            $blogs->delete();
            return redirect()->back()->with('success','successfully added blogs');
        }else{
            return redirect()->back()->with('error','something went wrong');
        }

       }

}

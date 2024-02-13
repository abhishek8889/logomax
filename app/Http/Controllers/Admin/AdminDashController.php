<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifications;
use Illuminate\Support\Facades\Session;
use App\Models\HomeContent;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use DB;


class AdminDashController extends Controller
{
    public function index(Request $request){
        if(!Session::has('on_admin_lang_code') && Session::get('on_admin_lang_code') == '' ){
            Session::put('on_admin_lang_code', app()->getLocale());
        }
        return view('admin.dashboard.index');
    }
    public function selectLanguage(Request $request,$lang_code){
        Session::put('on_admin_lang_code', $lang_code);
        return Redirect::back()->with('success', 'Language is changed');
    }
    public function addTranslateValue(Request $request){
        // dd($request );
        $type = $request->type;
        $tableName = $type.'_translation';

        $lang_data = $request->lang_code;
        $referenceID = $request->referenceID;
        $req_type = $request->req_type;
        $reference_id = '';

        if($tableName == 'categories_translation'){
            $reference_id = 'category_id';
        }
        if($type == 'styles'){
            $tableName = 'styles_translations';
            $reference_id = 'style_id';
        }
        if($type == 'branches'){
            $tableName = 'branches_translation';
            $reference_id = 'branch_id';
        }
        if($type == 'discount'){
            $reference_id = 'discount_id';
        }

        if($req_type == 'add'){
            foreach($lang_data as $lang_code => $name){
                DB::table($tableName)->insert(
                    [
                        $reference_id => $referenceID,
                        'lang_code' => $lang_code,
                        'name' => $name
                    ]
                );
            }
        }else{
            foreach($lang_data as $lang_id => $name){
                DB::table($tableName)->where('id',$lang_id)->update(
                    [
                        'name' => $name
                    ]
                );
            }
        }
        return redirect()->back()->with('success','Translated text added successfully !');
    }
    public function getDetail(Request $request){
        $table_name = $request->table;
        $data_id = $request->dataID;
        if($table_name == 'branches_translation'){
            $reference_name = 'branch_id';
        }
        if($table_name == 'styles_translations'){
            $reference_name = 'style_id';
        }
        
        $tableData = DB::table($table_name)->where($reference_name,$data_id)->get();
        if(count($tableData) > 0){
            $data = DB::table($table_name)->where($reference_name,$data_id)->get();
        }else{
            $data = 'no-data';
        }
        return $data;
    }
    public function testLangdata(Request $req){
        
    }
    
    
}

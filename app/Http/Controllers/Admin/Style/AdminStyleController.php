<?php

namespace App\Http\Controllers\Admin\Style;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Style;

class AdminStyleController extends Controller
{
    public function index(){
        $styles = Style::where('status',1)->get();
       
       return view('admin.style.index',compact('styles'));
    }
    public function addProcc(Request $request){
        
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:styles,slug,'.$request->id
        ]);
        if($request->id){
            $style = Style::find($request->id);
            $style->name = $request->name;
            $style->slug = $request->slug;
            $style->status = 1;
            $style->update();
            return redirect()->back()->with('success','Successfully updated styles');
        }else{
            $style = new Style;
            $style->name = $request->name;
            $style->slug = $request->slug;
            $style->status = 1;
            $style->save();
            return redirect()->back()->with('success','Successfully saved styles');
        }
    }
    public function delete($id){
        $style = Style::find($id);
        if($style){
            $style->delete();
                return redirect()->back()->with('success','Successfully deleted style'); 
            }else{
                return redirect()->back()->with('error','Failed! Something went wrong...');
            }
    }
}

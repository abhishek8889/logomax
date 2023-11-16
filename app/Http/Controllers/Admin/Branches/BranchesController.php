<?php

namespace App\Http\Controllers\Admin\Branches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchesController extends Controller
{
    public function index(){
        $branches = Branch::all();

        return view('admin.branches.index',compact('branches'));
    }
    public function addProcc(Request $request){
        $request->validate([
            'name'=>'required|unique:branches'
        ]);
        if($request->id){
            $branch = Branch::find($request->id);
            $branch->name = $request->name;
            $branch->slug = $request->slug;
            $branch->update();
            return redirect()->back()->with('success','Successfully updated branch');
        }else{
            $branch = new Branch;
            $branch->name = $request->name;
            $branch->slug = $request->slug;
            $branch->save();
            return redirect()->back()->with('success','Successfully saved new branch');
        }
        
    }
    public function delete($id){
        $branch = Branch::find($id);
        if(!$branch){
            abort(404);
        }
        $branch->delete();
        return redirect()->back()->with('success','successfully deleted branch');
    }
}

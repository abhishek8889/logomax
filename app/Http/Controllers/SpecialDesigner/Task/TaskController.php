<?php

namespace App\Http\Controllers\SpecialDesigner\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecialDesignerTask;

class TaskController extends Controller
{
    public function taskList(Request $req){
        $taskList = SpecialDesignerTask::with('revisionRequestDetail','logoDetail')->where('assigned_designer_id',auth()->user()->id)->get(); 
        
        return view('special_designer.tasks.task_list',compact('taskList'));
    }
    public function taskDetail(Request $req){
        // dd($this->siteData['user_timezone']);
        $siteData = $this->siteData;
        $task_id = $req->task_id;
        $taskDetails = SpecialDesignerTask::with('revisionRequestDetail','logoDetail','clientDetail')->find($task_id); 
        // dd($taskDetails);
        return view('special_designer.tasks.task_detail',compact('taskDetails','siteData'));
    }

    public function uploadProc(Request $request){
        return $request->all();
        if(auth()->user()->is_approved !== 0 && auth()->user()->is_approved !== 2){
            if($request->hasFile('file')){
                $request->validate([
                    'file' => 'required|mimes:ai,png'
                ]);
                $file = $request->file('file');
                $name = 'Logo_'.time().rand(1,100).'.'.$file->extension();
                $filesize = getimagesize($file);
                $filesizekb = filesize($file);
                // return ($filesizekb/1000).' KB';
                $file->move(public_path().'/logos/', $name);
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                $media->image_size = ($filesizekb/1000).' KB';
                $media->image_dimensions = $filesize[3];
                $media->image_format = $filesize['mime'];
                $media->save();
                return response()->json($media);
            }
        }else{
            return redirect()->back()->with('error','You are not able to upload any logo until your account is not approved !');
        }
    }
    public function deleteimage(Request $request){
        $media = Media::find($request->mediaid);
        if($media){
            $media->delete();
            return response()->json('deleted');
        }else{
            return reponse()->json('something went worng');
        }
    }
}

<?php

namespace App\Http\Controllers\SpecialDesigner\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecialDesignerTask;
use App\Models\Media;
use App\Models\CompletedTask;

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
       
        if(auth()->user()->is_approved !== 0 && auth()->user()->is_approved !== 2){
            if($request->hasFile('file')){
                $request->validate([
                    'file' => 'required|mimetypes:application/postscript,image/png,image/jpeg'
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
    
    public function uploadIcon(Request $request){
        $task_id = $request->task_id;
        $order_id = $request->order_id;
        $revision_id = $request->revision_id;
        $assigned_task = SpecialDesignerTask::find($task_id); 
       
        if($request->hasFile('icon_list')){
            $request->validate([
                'icon_list.*' => 'required|file|mimetypes:application/postscript,image/png,image/jpeg'
            ]);
            $media_id = [];
            foreach ($request->file('icon_list') as $file) {
                // $path = $file->store('public');
                $name = 'Logo_'.time().rand(1,100).'.'.$file->extension();
                $filesize = getimagesize($file);
                $filesizekb = filesize($file);
                // echo "<pre>";
                // echo $filesize[3];
                // echo "</pre>";

                // echo "<pre>";
                // print_r($filesizekb);
                // echo "</pre>";
                // die();
                // return ($filesizekb/1000).' KB';
                $image_dimensions = '';
                $image_format = '';
                if($filesize){
                    foreach($filesize as $ind => $v){
                        if($ind == 3){
                            $image_dimensions = $v;
                        }
                        if($ind == 'mime'){
                            $image_format = $v;
                        }
                    }
                }
                $file->move(public_path().'/logos/', $name);
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                $media->image_size = ($filesizekb/1000).' KB';
                $media->image_dimensions =  $image_dimensions ;
                $media->image_format = $image_format ;
                $media->save();
                $media_id[] = $media->id;
            }
            $completedTask = new CompletedTask;
            $completedTask->task_id = $task_id;
            $completedTask->order_id = $order_id;
            $completedTask->revision_id = $revision_id;
            $completedTask->client_id = $assigned_task->client_id;
            $completedTask->designer_id = auth()->user()->id; // Special designer id 
            $completedTask->logo_id = $assigned_task->logo_id;
            $completedTask->media_id = serialize($media_id);
            $completedTask->status =  0; // status 0 mean not approved by customer 
            $completedTask->save();

            $assigned_task->status = 1;
            $assigned_task->update();
           
            return redirect()->back()->with('success','Your job is submit please wait for client approval.');
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

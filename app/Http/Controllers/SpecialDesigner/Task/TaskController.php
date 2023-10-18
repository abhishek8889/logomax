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
        $task_id = $req->task_id;
        $taskDetails = SpecialDesignerTask::with('revisionRequestDetail','logoDetail','clientDetail')->find($task_id); 
        // dd($taskDetails);
        return view('special_designer.tasks.task_detail',compact('taskDetails'));
    }
}

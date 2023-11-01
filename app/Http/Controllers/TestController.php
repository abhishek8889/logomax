<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;
use App\Models\Logo;
use App\Models\Whishlist;
use Carbon\Carbon;
use App\Models\SpecialDesignerTask;
use App\Models\User;
use App\Models\Notifications;
use App\Events\SpecialDesignerNotification;

use App\Mail\RegisterConfirmationMail;
use App\Mail\DesignerAssignedMail;
use Mail;
use Illuminate\Support\Facades\Log;



class TestController extends Controller
{
    // public function index(){
       
    //     // $notifications = Notifications::create(array(
    //     //     'type' => 'designer-registered',
    //     //     'sender_id' => '0',
    //     //     'reciever_id' => '0',
    //     //     'designer_id' => $user->id,
    //     //     'message' => 'New host is <span>Registered</span>'
    //     // )); 
    //     // $eventData = array(
    //     //     'type' => 'designer-registered',
    //     //     'designer_id' => 2,
    //     //     'notification_id' => 1,
    //     //     'message' => 'New host is <span>Registered</span>'
    //     // );
        
    //     // event(new RegisterNotificationEvent($eventData));
    //     // $mailData = array(
    //     //     'title' => 'Special Designer Registered',
    //     //     'name' => 'Abhishek',
    //     //     'user_role' => 'Special Designer',
    //     // );
    //     // $mail = Mail::to('abhishek@sagmetic.com')->send(new RegisterConfirmationMail($mailData));
    //     // $userId = auth()->user()->id;

    //     // $data = Logo::with(['inWhishlist' => function ($query) {
    //     //     $query->where('user_id', auth()->user()->id);
    //     // }])->where([['approved_status',1],['status',1]])->get();
    //     // dd($data);
    //     $now = Carbon::now();

    //     dd($now);

      
    //     // $host_schedule = HostAppointments::where([['host_id','=',Auth::user()->_id],['questionrie_status',1]])->with('usermessages',function($response){ $response->where([['reciever_id',Auth::user()->id],['status',1]]); } )->with('answers')->orderBy('created_at','desc')->with('payments')->paginate(10);
    // }
    public function index(){
        try{
            $specialDesignerTask = SpecialDesignerTask::where('status',0)->get();
            if(isset($specialDesignerTask)){
                if(!empty($specialDesignerTask) && count($specialDesignerTask) > 0){
                    foreach($specialDesignerTask as $task){
                        $task_created_at = $task->created_at;
                        $task_duration = (int)$task->task_duration;
                        $task_backup_designer = unserialize($task->backup_designer_id);
                        $now = Carbon::now();
                        $currentTime = $now->toDateTimeString();
                        $taskValidUptTo = Carbon::parse($task_created_at)->addMinutes($task_duration);

                        // Check that if current time is more than task validity time 
                        // if it is then terminate the job and assign to another backup designer
                        if($currentTime > $taskValidUptTo){
                            if(count($task_backup_designer) > 0){
                                $task->status = 4; // 4 status mean terminate job from that designer
                                $task->update();
                                $newAssignedDesigner = $task_backup_designer[0];
                                $newArr = $task_backup_designer;
                                unset($newArr[0]);
                                $newBackupDesigner = array_values($newArr);
                                $newTask = new SpecialDesignerTask;
                                $newTask->logo_revision_id = $task->logo_revision_id;
                                $newTask->logo_id = $task->logo_id;
                                $newTask->client_id = $task->client_id;
                                $newTask->assigned_designer_id = $newAssignedDesigner;
                                $newTask->backup_designer_id = serialize($newBackupDesigner);
                                $newTask->task_duration = $task_duration;
                                $newTask->status = 0;
                                $newTask->save();
                                $mailData = array(
                                    'msg' => ' You have new logo for revision please check your dashboard. ',
                                    'title' => 'New logo Revision request',
                                );
                                $user = User::find($newAssignedDesigner);
                                $mail = Mail::to($user->email)->send(new DesignerAssignedMail($mailData));

                                /* try to send notification to assigned designer : */

                            $notifications = Notifications::create(array(
                                'type' => 'designer-aproved-for-logo',
                                'sender_id' => '0',
                                'reciever_id' => $newAssignedDesigner,
                                'designer_id' => $newAssignedDesigner,
                                'logo_id' => $task->logo_id,
                                'message' => 'You have new task for <span>logo revision </span>.'
                            )); 
                            $eventData = array(
                                'type' => 'designer-aproved-for-logo',
                                'designer_id' => $newAssignedDesigner,
                                'notification_id' => $notifications->id,
                                'logo_id' => $task->logo_id,
                                'read_url' => url('read-notification/'.$notifications->id),
                                'message' => 'You have new task for <span>logo revision </span>.'
                            );
                            event(new SpecialDesignerNotification($eventData));
                            /* assigned designer notification end here : */
                            }else{
                                $task->status = 5; // 5 status mean terminate job from that designer and no backup designer left.
                                $task->update();
                            }
                            Log::info('Assigned new task');
                        }
                    }
                }
            }
        }catch(\Exception $e){
            $error_message = $e->getMessage();
            Log::error('Error in assigned job : '.$error_message);

        }
    }
}

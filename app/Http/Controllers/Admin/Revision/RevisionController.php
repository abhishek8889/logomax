<?php

namespace App\Http\Controllers\Admin\Revision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogoRevision;
use App\Models\User;
use App\Models\SpecialDesignerTask;
use App\Mail\DesignerAssignedMail;
use Mail;
use App\Models\Notifications;
use App\Events\DesignerNotification;
use App\Events\SpecialDesignerNotification;

class RevisionController extends Controller
{
    public function revisionRequest(Request $req){
        // return view();
        $logo_on_revision = LogoRevision::with('logoDetail','orderDetail','customerDetail')->where([['status','=',0],['assigned','=',0]])->orderBy('created_at', 'DESC')->get();
        
        return view('admin.revision.revision_request',compact('logo_on_revision'));
    }
    public function onRevisionTask(Request $req){
        $logo_on_revision = LogoRevision::with('logoDetail','orderDetail','customerDetail')->where([['status','=',0],['assigned','=',1]])->orderBy('created_at', 'DESC')->get();
        
        return view('admin.revision.on_revision',compact('logo_on_revision'));
    }
    public function onRevisionDetail(Request $req){
        $revision_id = $req->revision_id;
        // Get detail of revision logo 
        // Get track of what work should be done here by special designer 
        $revisionDetail = LogoRevision::with('logoDetail','orderDetail','customerDetail','assignedTaskList.completeTask')->find($revision_id);
        $revision_logo_id = $revisionDetail->logo_id;
        
        return view('admin.revision.on_revision_detail',compact('revisionDetail'));
    }
    public function revisionRequestDetail(Request $req){
        
        $specialDesigners = User::where('role_id',4)->get();
        
        $req_id = $req->request_id;
        $revisionDetail = LogoRevision::with('logoDetail','orderDetail','customerDetail')->find($req_id);
        
        return view('admin.revision.revision_request_detail',compact('revisionDetail','specialDesigners'));
    }
    public function assignToSpecialDesigner(Request $req){
        // return $req->all();
        $taskAssigned = SpecialDesignerTask::where([['logo_revision_id','=',$req->revision_request_id],['assigned_designer_id','!=',''],['status','=',0]])->first();
        if($taskAssigned){
            $user = User::find($taskAssigned->assigned_designer_id);
            $responseData = array(
                'status'=> 409,
                'title' => 'Already assigned !',
                'message'=> 'You have already assigned this task to '.$user->name,
                'statusMessage' => 'error'
            );
            return response()->json($responseData);
        }
        $serializeBackupDesigner = '';
        if(!empty($req->backup_designer_list) && is_array($req->backup_designer_list)){
            $serializeBackupDesigner = serialize($req->backup_designer_list);
        }

        $specialDesignerTask = new SpecialDesignerTask;
        $specialDesignerTask->logo_revision_id = $req->revision_request_id;
        $specialDesignerTask->logo_id = $req->logo_id;
        $specialDesignerTask->client_id = $req->client_id;
        $specialDesignerTask->assigned_designer_id = $req->selectedDesigner;
        $specialDesignerTask->backup_designer_id = $serializeBackupDesigner;
        $specialDesignerTask->task_duration = $req->duration_for_complete;
        $specialDesignerTask->status = 0;  // assigned or on working , 1 done but not approved by customer , 2 disapproved by customer , 3 Approved by cutomer
        $specialDesignerTask->save();

        // Change assigned status in logo revision table 
        $logoRevision = LogoRevision::find($req->revision_request_id);
        $logoRevision->assigned = 1;
        $logoRevision->update();

        /* mail to designer : */
        if($req->revision_request_id){
            $userId =  LogoRevision::with('order.user')->where('id',$req->revision_request_id)->first();
            if($userId){
                $mailData = array(
                    'msg' => 'Designer has been assigned for your logo revision.',
                    'title' => 'Logo Revision',
                );
                $mail = Mail::to($userId->order->user->email)->send(new DesignerAssignedMail($mailData));
            }
            
        }
        if($req->selectedDesigner){
            $specialDesigners = User::where('id',$req->selectedDesigner)->first();
            if($specialDesigners){
                    $mailData = array(
                        'msg' => ' A new Logo assigned you for revision ',
                        'title' => 'Logo Revision',
                    );

                $mail = Mail::to($specialDesigners->email)->send(new DesignerAssignedMail($mailData));
            }
        }

        /* try to send notification to assigned designer : */

            $notifications = Notifications::create(array(
                'type' => 'designer-aproved-for-logo',
                'sender_id' => '0',
                'reciever_id' => $specialDesignerTask->assigned_designer_id,
                'designer_id' => $specialDesignerTask->assigned_designer_id,
                'logo_id' => $req->logo_id,
                'message' => 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.'
            )); 
            $eventData = array(
                'type' => 'designer-aproved-for-logo',
                'designer_id' => $specialDesignerTask->assigned_designer_id,
                'notification_id' => $notifications->id,
                'logo_id' => $req->logo_id,
                'read_url' => url('read-notification/'.$notifications->id),
                'message' => 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.'
            );
            event(new SpecialDesignerNotification($eventData));

        /* assigned designer notification end here : */


        return response()->json(['status'=>200,'title'=>'Job Assigned','message'=>'You have successfully assign this work to special designer.']);
    }
    // Revised Logo Llist 

    public function revisedLogoList(){
        $logo_on_revision = LogoRevision::with('logoDetail','orderDetail','customerDetail')->where([['status','=',1],['assigned','=',1]])->orderBy('created_at', 'DESC')->get();
        
        return view('admin.revision.revised_logo_list',compact('logo_on_revision'));
    }

    public function revisedLogoDetail(Request $req){
        $revision_id = $req->revision_id;
        // Get detail of revision logo 
        // Get track of what work should be done here by special designer 
        $revisionDetail = LogoRevision::with('logoDetail','orderDetail','customerDetail','assignedTaskList.completeTask')->find($revision_id);
        $revision_logo_id = $revisionDetail->logo_id;
        
        return view('admin.revision.revisedLogoDetail',compact('revisionDetail'));
    }
}

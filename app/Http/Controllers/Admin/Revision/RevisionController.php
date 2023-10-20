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
        $logo_on_revision = LogoRevision::with('logoDetail','orderDetail','customerDetail')->orderBy('created_at', 'DESC')->get();
       
        return view('admin.revision.revision_request',compact('logo_on_revision'));
    }
    public function revisionRequestDetail(Request $req){
        
        $specialDesigners = User::where('role_id',4)->get();
        
        $req_id = $req->request_id;
        $revisionDetail = LogoRevision::with('logoDetail','orderDetail','customerDetail')->find($req_id);
        // dd($revisionDetail);
        return view('admin.revision.revision_request_detail',compact('revisionDetail','specialDesigners'));
    }
    public function assignToSpecialDesigner(Request $req){
        // return $req->all();
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


        return response()->json(['status'=>200,'success'=>'You have successfully assign this work to special designer.' ,'requestData' => $req->all()]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use App\Mail\ApproveLogoMail;
use App\Mail\DeapproveLogoMail;
use Mail;
use App\Events\DesignerNotification;
use App\Models\Notifications;

class LogosController extends Controller
{
    public function index(){
        $logos = Logo::where([['status',1],['approved_status',0]])->get();

        return view('admin.logos.logosrequest',compact('logos'));
    }
    public function approvedLogos(){
        $logos = Logo::where([['status',1],['approved_status',1]])->get();
        return view('admin.logos.approvedlogos',compact('logos'));
    }
    public function disapprovedLogos(){
        $logos = Logo::where([['status',1],['approved_status',2]])->get();
       
        return view('admin.logos.disapprovedlogos',compact('logos'));
    }
    public function updateStatus(Request $request){
        if($request->action == 'approved'){
            $logos = Logo::find($request->id);
            $logos->approved_status = 1;
            $logos->update(); 
            $designer_detail = User::find($logos->designer_id);
            $mailData = [
                'logo_name' => $logos->logo_name,
                'designer_name' => $designer_detail->name,
            ];
            $mail = Mail::to($designer_detail['email'])->send(new ApproveLogoMail($mailData));

            // Send notification to Designers ::::::::: 

            $notifications = Notifications::create(array(
                'type' => 'logo-approved',
                'sender_id' => '0',
                'reciever_id' => $designer_detail['id'],
                'designer_id' => $designer_detail['id'],
                'logo_id' => $logos->id,
                'message' => 'Congratulations ! Your logo is <span>Approved !</span>'
            )); 
            $eventData = array(
                'type' => 'logo-approved',
                'designer_id' => $designer_detail['id'],
                'notification_id' => $notifications->id,
                'logo_id' => $request->id,
                'message' => 'Congratulations ! Your logo is <span>Approved !</span>'
            );
            event(new DesignerNotification($eventData));

            return response()->json('You have approved this logo successfully !');
        }else{
            $logos = Logo::find($request->logo_id);
            $logos->approved_status = 2;
            $logos->admin_review = $request->review;
            $logos->update();
            $designer_detail = User::find($logos->designer_id);
            $mailData = [
                'logo_name' => $logos->logo_name,
                'designer_name' => $designer_detail->name,
            ];
            $mail = Mail::to($designer_detail['email'])->send(new DeapproveLogoMail($mailData));

            // Send notification to Designers ::::::::: 

                $notifications = Notifications::create(array(
                    'type' => 'logo-disapproved',
                    'sender_id' => '0',
                    'reciever_id' => $designer_detail['id'],
                    'designer_id' => $designer_detail['id'],
                    'logo_id' => $logos->id,
                    'message' => 'Congratulations ! Your logo is <span>Approved !</span>'
                )); 
                $eventData = array(
                    'type' => 'logo-disapproved',
                    'designer_id' => $designer_detail['id'],
                    'notification_id' => $notifications->id,
                    'logo_id' => $request->id,
                    'message' => 'Oops ! Your logo is <span>Disapproved !</span>'
                );
                event(new DesignerNotification($eventData));
            
            return redirect()->back()->with('success','You have disapproved this logo.');
        }
    }
}

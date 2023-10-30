<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;
use App\Mail\RegisterConfirmationMail;
use Mail;
use App\Models\Logo;
use App\Models\Whishlist;
class TestController extends Controller
{
    public function index(){
       
        // $notifications = Notifications::create(array(
        //     'type' => 'designer-registered',
        //     'sender_id' => '0',
        //     'reciever_id' => '0',
        //     'designer_id' => $user->id,
        //     'message' => 'New host is <span>Registered</span>'
        // )); 
        // $eventData = array(
        //     'type' => 'designer-registered',
        //     'designer_id' => 2,
        //     'notification_id' => 1,
        //     'message' => 'New host is <span>Registered</span>'
        // );
        
        // event(new RegisterNotificationEvent($eventData));
        // $mailData = array(
        //     'title' => 'Special Designer Registered',
        //     'name' => 'Abhishek',
        //     'user_role' => 'Special Designer',
        // );
        // $mail = Mail::to('abhishek@sagmetic.com')->send(new RegisterConfirmationMail($mailData));
        // $userId = auth()->user()->id;

        $data = Logo::with(['inWhishlist' => function ($query) {
            $query->where('user_id', auth()->user()->id);
        }])->where([['approved_status',1],['status',1]])->get();
        dd($data);

      
        // $host_schedule = HostAppointments::where([['host_id','=',Auth::user()->_id],['questionrie_status',1]])->with('usermessages',function($response){ $response->where([['reciever_id',Auth::user()->id],['status',1]]); } )->with('answers')->orderBy('created_at','desc')->with('payments')->paginate(10);
    }
}

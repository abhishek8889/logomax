<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;
use App\Mail\RegisterConfirmationMail;
use Mail;
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
        $eventData = array(
            'type' => 'designer-registered',
            'designer_id' => 2,
            'notification_id' => 1,
            'message' => 'New host is <span>Registered</span>'
        );
        
        event(new RegisterNotificationEvent($eventData));
        // $mailData = array(
        //     'title' => 'Special Designer Registered',
        //     'name' => 'Abhishek',
        //     'user_role' => 'Special Designer',
        // );
        // $mail = Mail::to('abhishek@sagmetic.com')->send(new RegisterConfirmationMail($mailData));

    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;

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
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;

class TestController extends Controller
{
    public function index(){
       
        $eventData = array(
            'type' => 'designer-registered',
            'designer_id' => 1,
            'notification_id' => 241
        );
        
        event(new RegisterNotificationEvent($eventData));
    }
}

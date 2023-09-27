<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\RegisterNotificationEvent;

class TestController extends Controller
{
    public function index(){
       
       
        $eventData = 'hello';
        broadcast(new RegisterNotificationEvent($eventData));
    }
}

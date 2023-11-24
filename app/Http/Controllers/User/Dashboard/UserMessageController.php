<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\SendMessages;
use App\Models\Message;
use App\Models\User;
use Auth;

class UserMessageController extends Controller
{
   public function index(Request $request,$code = null){
   $messages = Message::where('reciever_id',Auth::user()->id)->orWhere('sender_id',Auth::user()->id)->orderBy('created_at','desc')->get();
    $userids = [];
    foreach($messages as $message){
        array_push($userids,$message->sender_id);
        array_push($userids,$message->reciever_id);
    }
    $unique_ids = array_unique($userids);
    $users = User::whereIn('id',$unique_ids)->where('id','!=',Auth::user()->id)->get();
    if($code){
        $email = base64_decode($code);
        $userdata = User::where('email',$email)->first();
        if(!$userdata){
            abort(404);
        }
        $message_seen = Message::where([['reciever_id',Auth::user()->id],['sender_id',$userdata->id]])->update(['seen_status'=>1]);
        $message = Message::where([['sender_id',$userdata->id],['reciever_id',Auth::user()->id]])->orWhere([['sender_id',Auth::user()->id],['reciever_id',$userdata->id]])->get();
    }else{
        $userdata = null;
        $message = array();
    }
    return view('user_dashboard_view.Message.index',compact('request','users','userdata','message'));
   }
   public function sendMessage(Request $request){
    
    $userdata = User::find($request->reciever_id);
    $date = date('m/d/Y h:i:s a', time());
    $message = array(
        'sender_id' => $request->sender_id,
        'reciever_id' => $request->reciever_id,
        'message' => $request->message,
        'userdata' => $userdata,
        'current_time' => $date,
    );
    event(new SendMessages($message));

    $savmessage = new Message;
    $savmessage->sender_id = $request->sender_id;
    $savmessage->reciever_id = $request->reciever_id;
    $savmessage->message = $request->message;
    $savmessage->seen_status = 0;
    $savmessage->save();
    return 'done';
   }
   public function sendMessageDirect(Request $request){
    
    $userdata = User::find($request->reciever_id);
    $date = date('m/d/Y h:i:s a', time());
    $message = array(
        'sender_id' => $request->sender_id,
        'reciever_id' => $request->reciever_id,
        'message' => $request->message,
        'userdata' => $userdata,
        'current_time' => $date,
    );
    event(new SendMessages($message));

    $savmessage = new Message;
    $savmessage->sender_id = $request->sender_id;
    $savmessage->reciever_id = $request->reciever_id;
    $savmessage->message = $request->message;
    $savmessage->seen_status = 0;
    $savmessage->save();
    return redirect()->back()->with('success','succcesfully sent message');
   }
   public function seenMessage(Request $request){
    $message = Message::where([['sender_id',$request->sender_id],['reciever_id',$request->reciever_id]])->update(['seen_status'=>1]);
    return $message;
   }
}

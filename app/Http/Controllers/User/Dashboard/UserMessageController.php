<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\SendMessages;
use App\Models\Message;
use App\Models\LogoRevision;
use App\Models\Order;
use App\Models\User;
use Auth;

class UserMessageController extends Controller
{
   public function index(Request $request,$lang,$code = null){
   $messages = Message::where('reciever_id',Auth::user()->id)->orWhere('sender_id',Auth::user()->id)->orderBy('created_at','desc')->get();
   
   $userids = [];
    foreach($messages as $message){
        array_push($userids,$message->sender_id);
        array_push($userids,$message->reciever_id);
    }
    $unique_ids = array_unique($userids); 
    // print_r($unique_ids);
   $users = [];
   
   if($unique_ids){
    foreach($unique_ids as $ids){
        if($ids == Auth::user()->id){
            continue;
        }
    
        $users[] = User::where('id',$ids)->with('unseenmessages',function($query){ $query->where('reciever_id',Auth::user()->id)->get();   })->first();
    }
   }
   $chat = false;
    // $users = User::whereIn('id',$unique_ids)->where('id','!=',Auth::user()->id)->get();
    if($code){
        $email = base64_decode($code);
        $userdata = User::where('email',$email)->first();
        if(!$userdata){
            abort(404);
        }
        $logo_revision =  LogoRevision::where([['assigned_designer_id',$userdata->id],['status',0]])->whereHas('orderDetail',function($query) use ($userdata){ $query->where([['user_id',Auth::user()->id],['on_revision',1]]); })->with('orderDetail')->get();
            if($logo_revision->isNotEmpty()){
                $chat = true;
            }
        $message_seen = Message::where([['reciever_id',Auth::user()->id],['sender_id',$userdata->id]])->update(['seen_status'=>1]);
        $message = Message::where([['sender_id',$userdata->id],['reciever_id',Auth::user()->id]])->orWhere([['sender_id',Auth::user()->id],['reciever_id',$userdata->id]])->get();
    }else{
        $userdata = null;
        $message = array();
    }
    // $logo_revision = LogoRevision::whereHas('orderDetail', function ($query) use ($userdata) {
    //     $query->where('assigned_designer_id', $userdata->id);
    // })->with('orderDetail')->get();
    
    return view('user_dashboard_view.Message.index',compact('request','users','userdata','message','chat'));
   }
   public function sendMessage(Request $request){
    // return $request->all();
    $allfilenames = []; 
    if($request->hasFile('files'))
    {
        $files = $request->file('files');
        foreach($files as $file){
        $filename = $file->getClientOriginalName();
        $file->move(public_path('logos1'),$filename);
        $allfilenames[] = $filename; 
        }
    }else{
        $request->validate([
            'message' => 'required',
        ]);
    }
    
    $userdata = User::find($request->sender_id);
    $date = date('h:i A', time());
    $message = array(
        'sender_id' => $request->sender_id,
        'reciever_id' => $request->reciever_id,
        'message' => $request->message,
        'userdata' => $userdata,
        'current_time' => $date,
        'files' => $allfilenames,
    );

    $savmessage = new Message;
    $savmessage->sender_id = $request->sender_id;
    $savmessage->reciever_id = $request->reciever_id;
    $savmessage->message = $request->message;
    $savmessage->files = json_encode($allfilenames);
    $savmessage->seen_status = 0;
    $savmessage->save();
    
    array_push($message,$savmessage);

    event(new SendMessages($message));
    return response()->json($message);
   }
   
   public function sendMessageDirect(Request $request){
    
    $userdata = User::find($request->sender_id);
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
   public function uploadFiles(Request $request){
    if($request->hasFile('file')){
        $file = $request->file('file');
        $name = 'File'.time().'.'.$file->extension();
        $file->move(public_path().'/revision_files/',$name);
        $file->save();
        return $name;
    }
    return 'Something went wrong';
   }
   public function seenMessage(Request $request){
    $message = Message::where([['sender_id',$request->sender_id],['reciever_id',$request->reciever_id]])->update(['seen_status'=>1]);
    return $message;
   }
    public function download_file(Request $request,$locale,$filename){
     
        $file = public_path('/logos1/'.$filename);
        if(!file_exists($file)){
            abort(404);
        }
        $mime = mime_content_type($file);

        // Set the response headers
        $headers = [
            'Content-Type' => $mime,
            'Content-Disposition' => 'inline; filename="' . basename($file) . '"',
        ];
        // return $headers;
        return response()->download($file, basename($file), $headers);
    }
    public function delete(Request $request){
        $message_id = $request->message_id;
        $message = Message::find($message_id);
        if(!$message){
           return response()->json(['error'=>'Something went wrong']);
        }
        $event = array(
            'message_id' => $message->id,
            'action' => 'delete',
            'sender_id' => $message->sender_id,
            'reciever_id' => $message->reciever_id,
        );
        event(new SendMessages($event));
        $message->delete();

        return response()->json('deleted');
    }
    public function updateMessage(Request $request){
        $message = Message::find($request->id);
        if(!$message){
            return response()->json(['error'=>'Something went wrong']);
        }
        $message->message = $request->message;
        $message->update();
        $event = array(
            'message_id' => $message->id,
            'action' => 'update',
            'sender_id' => $message->sender_id,
            'reciever_id' => $message->reciever_id,
            'message' => $message->message,
        );
        event(new SendMessages($event));
        return response()->json('updated');
    }
}

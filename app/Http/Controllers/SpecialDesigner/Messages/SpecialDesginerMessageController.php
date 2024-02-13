<?php

namespace App\Http\Controllers\SpecialDesigner\Messages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\SendMessages;
use App\Models\User;
use App\Models\LogoRevision;
use App\Models\Order;
use Auth;
use Response;
use File;
use Illuminate\Support\Facades\Storage;

class SpecialDesginerMessageController extends Controller
{
    public function index($code = null){
       
        $messages = Message::where('reciever_id',Auth::user()->id)->orWhere('sender_id',Auth::user()->id)->orderBy('created_at','desc')->get();
      
        $userids = [];
        foreach($messages as $message){
            array_push($userids,$message->sender_id);
            array_push($userids,$message->reciever_id);
        }
        // dd($userids);
        $unique_ids = array_unique($userids);
        // dd($unique_ids);
        $users = [];
        if($unique_ids){
         foreach($unique_ids as $ids){
             if($ids == Auth::user()->id){
                 continue;
             }
         
             $users[] = User::where('id',$ids)->with('unseenmessages', function($query){ $query->where('reciever_id',Auth::user()->id)->get(); })->first();
         }
        }
        $chat = false;
        // dd($users[0]->unseenmessages);
        if($code){
            $email = base64_decode($code);
            $userdata = User::where('email',$email)->first();
            if(!$userdata){
                abort(404);
            }
            $logo_revision =  LogoRevision::where([['assigned_designer_id',Auth::user()->id],['status',0]])->whereHas('orderDetail',function($query) use ($userdata){ $query->where([['user_id',$userdata->id],['on_revision',1]]); })->with('orderDetail')->get();
            if($logo_revision->isNotEmpty()){
                $chat = true;
            }
            
        $message_seen = Message::where([['reciever_id',Auth::user()->id],['sender_id',$userdata->id]])->get();
          
        $message = Message::where([['sender_id',$userdata->id],['reciever_id',Auth::user()->id]])->orWhere([['sender_id',Auth::user()->id],['reciever_id',$userdata->id]])->get();
            
        }else{
            $userdata = null;
            $message = array();
        }
        // dd($users[0]->unseenmessages);


        return view('special_designer.messages.index',compact('users','userdata','message','chat'));
    }
    public function messageProcc(Request $request){
        
        $sender_id = Auth::user()->id;
        $userdata = User::find($sender_id);
        $date = date('h:i A', time());
        $filenames = [];
        if($request->hasFile('file')){
            $files = $request->file('file');
            foreach($files as $file){
                $name = $file->getClientOriginalName();
                $file->move(public_path('logos1'),$name);
                $filenames[] = $name;
            }
            
        }else{
            $request->validate([
                'message' => 'required',
            ]);
        }
        $message = array(
            'sender_id' => $sender_id,
            'reciever_id' => $request->reciever_id,
            'message' => $request->message,
            'userdata' => $userdata,
            'current_time' => $date,
            'files' => $filenames
        );

        $savmessage = new Message;
        $savmessage->sender_id = $sender_id;
        $savmessage->reciever_id = $request->reciever_id;
        $savmessage->message = $request->messagesend;
        $savmessage->files = json_encode($filenames);
        $savmessage->seen_status = 0;
        $savmessage->save();

        array_push($message,$savmessage);
        event(new SendMessages($message));

        return response()->json($message);
    }
    public function seenMessage(Request $request){
        $message = Message::where([['sender_id',$request->sender_id],['reciever_id',$request->reciever_id]])->update(['seen_status'=>1]);
        return $message;
    }
    public function uploadFiles(Request $request){
        if($request->hasFile('file')){
            $file = $request->file('file');
            $name = 'file'.time().'.'.$file->extension();
            $file->move(public_path().'/revision_files/',$name);
            return $name;
        }
        return 'Something went wrong';
    }
    public function download_file(Request $request,$filename){
        // echo $filename;
        // die();
        
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
    public function delete(Request $request){
        
        $message_id = $request->message_id;
        $message = Message::find($request->message_id);
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
}

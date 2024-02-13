<?php

namespace App\Http\Controllers\SpecialDesigner\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpecialDesignerTask;
use App\Models\Media;
use App\Models\CompletedTask;
use App\Models\LogoRevision;
use App\Mail\SendTaskDeniedMail;
use App\Models\Message;
use App\Events\SendMessages;
use Mail;
use Auth;
use \CloudConvert\CloudConvert;
use \CloudConvert\Models\Job;
use \CloudConvert\Models\Task;
use App\Models\Order;
use Illuminate\Support\Facades\File;
use ZipArchive;
 
class TaskController extends Controller
{
    public function taskList(Request $req){
        $taskList = LogoRevision::with('logoDetail','logoDetail.media')->where([['assigned_designer_id','=',auth()->user()->id],['status','=',0]])->get();
        // dd($taskList);
        return view('special_designer.tasks.task_list',compact('taskList'));
    }
    public function taskDetail(Request $req){
        $siteData = $this->siteData;
        $revision_req_id = $req->task_id;
        $taskDetails = LogoRevision::with('logoDetail','logoDetail.media','order.user')->find($revision_req_id);

        /////////////////////////// Message ///////////////////////////

        $first_name = $taskDetails->order->user->first_name ;
        $last_name = $taskDetails->order->user->last_name ;
        $first_name_frstChar =  strtoupper(mb_substr($first_name, 0, 1));
        $last_name_frstChar = strtoupper(mb_substr($last_name, 0, 1));
        $fullName = $first_name . ' '. $last_name;
        $shortName = $first_name_frstChar.$last_name_frstChar;
        $customerEmail = $taskDetails->order->user->email ;
        $customerID = $taskDetails->order->user->id ;


        $allMessages = Message::where([['sender_id',$customerID],['reciever_id',Auth::user()->id]])->orWhere([['sender_id',Auth::user()->id],['reciever_id',$customerID]])->orderBy('created_at','ASC')->get();
        $message_seen = Message::where([['reciever_id',Auth::user()->id],['sender_id',$customerID]])->update(['seen_status'=>1]);

        $order_id =  $taskDetails->order->id;
        $order_data = Order::find($order_id);
        // dd($order_data);
        $last_accepted_revision = LogoRevision::where([['order_id',$order_id],['updates_by_designer','!=',null],['what_you_revised','logo']])->orderBy('created_at','desc')->first();
        // dd($last_accepted_revision);
        
        
        // dd($allMessages);
        // $userids = [];
        // $userids

        //////////////////////////   END   /////////////////////////////
       
        return view('special_designer.tasks.task_detail',compact('taskDetails','siteData','allMessages','last_accepted_revision'));
    }
    public function completeTask(){
        $taskList = LogoRevision::with('logoDetail','logoDetail.media')->where('assigned_designer_id',auth()->user()->id)->where('status',1)->get(); 
      
        return view('special_designer.tasks.complete_task',compact('taskList'));
    }

    public function waitingForReply(Request $req){
        $taskList = LogoRevision::with('logoDetail','logoDetail.media')->where('assigned_designer_id',auth()->user()->id)->where('status',2)->get(); 
      
        return view('special_designer.tasks.waiting_for_reply',compact('taskList'));
    }

    public function uploadProc(Request $request){
       
        if(auth()->user()->is_approved !== 0 && auth()->user()->is_approved !== 2){
            if($request->hasFile('file')){
                $request->validate([
                    'file' => 'required|mimetypes:application/postscript,image/png,image/jpeg'
                ]);
                $file = $request->file('file');
                $name = 'Logo_'.time().rand(1,100).'.'.$file->extension();
                $filesize = getimagesize($file);
                $filesizekb = filesize($file);
                // return ($filesizekb/1000).' KB';
                $file->move(public_path().'/logos/', $name);
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                $media->image_size = ($filesizekb/1000).' KB';
                $media->image_dimensions = $filesize[3];
                $media->image_format = $filesize['mime'];
                $media->save();
                return response()->json($media);
            }
        }else{
            return redirect()->back()->with('error','You are not able to upload any logo until your account is not approved !');
        }
    }
    
    public function uploadIcon(Request $request){
        // dd($request->all());
        $revision_id = $request->revision_id;
        $revision = LogoRevision::find($revision_id);
        
        if($revision->what_you_revised == 'favicon'){
            
            if($request->hasFile('icon_list')){
                
                $directory_name = 'Favicon_'.time().rand(1,100);
                $folderPath = public_path('LogoDirectory/'.$directory_name);
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }
                foreach($request->file('icon_list') as $file){
                // $file = $request->file('icon_list');
                $name = $directory_name.'.'.$file->extension();
                $file->move(public_path().'/LogoDirectory/'.$directory_name, $name);
                // $file->storeAs('logos', $name, 'public');
                }
                $namewithoutextension = $directory_name;
            }else{
                return redirect()->back()->with('error','Something went wrong');
            }
        }else{
        if($request->hasFile('icon_list')){
            
            // $request->validate([
            //     'icon_list' => 'required|file|mimetypes:application/postscript,image/eps'
            // ]);
            // foreach ($request->file('icon_list') as $file) {
                // $path = $file->store('public');
                $file = $request->file('icon_list');
                if($file->getClientOriginalExtension() != 'eps'){
                    return redirect()->back()->with(['error'=>'The provided file format is incompatible for upload; kindly submit the document in the EPS format exclusively.']);
                }
                $namewithoutextension = 'Logo_'.time().rand(1,100);
                $name = $namewithoutextension.'.'.$file->extension();
                
                // $filesize = getimagesize($file);
                // $filesizekb = filesize($file);
               
                $image_dimensions = '';
                $image_format = '';
                // if($filesize){
                //     foreach($filesize as $ind => $v){
                //         if($ind == 3){
                //             $image_dimensions = $v;
                //         }
                //         if($ind == 'mime'){
                //             $image_format = $v;
                //         }
                //     }
                // }
                // $file->move(public_path().'/logos/', $name);
                $file->storeAs('logos', $name, 'public');

                $ImageConvertion = $this->convertImageNewApi($request,$name,$namewithoutextension);
            }
        }
                $media = new Media;
                $media->image_name = $name;
                $media->image_path = '/logos/'.$name;
                // $media->image_size = ($filesizekb/1000).' KB';
                // $media->image_dimensions =  $image_dimensions ;
                // $media->image_format = $image_format ;
                $media->directory_name = $namewithoutextension;
                $media->save();
                $media_id = $media->id;
            // }
             
            $logoRevision = LogoRevision::find($revision_id);
            $logoRevision->updates_by_designer = $media_id ; // updated media from special designer
            $logoRevision->status =  2;  // 2 sent for approval 
            $logoRevision->update();
           
            return redirect()->back()->with('success','Your job is submit please wait for client approval.');
        
    }
  
    public function deleteimage(Request $request){
        $media = Media::find($request->mediaid);
        if($media){
            $media->delete();
            return response()->json('deleted');
        }else{
            return reponse()->json('something went worng');
        }
    }
    public function sendTaskDeniedEmail(Request $request){
        $designer_name = auth()->user()->first_name . ' '. auth()->user()->last_name;
        $mailData = [
            'type' => 'denied-for-task',
            'name' => $designer_name,
            'email' => auth()->user()->email,
            'message' => "$designer_name ask for denied task",
            // 'order_id' => 
        ];

        //  Mail::to(env('ADMIN_MAIL'))->send(new SendTaskDeniedMail($mailData));s

    }

        public function convertImageNewApi($request,$name,$namewithoutextension){
            $imgurl = asset('logos/'.$name);
            // $name = $namewithoutextension;
            $folderPath = public_path('LogoDirectory') . '/' . $namewithoutextension;
            $imageName = $name;
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);
            }
            if($request->hasFile('file')){
                $file = $request->file('file');
                $file->move(public_path().'/LogoDirectory/'.$namewithoutextension, $name);
            }
            $formats = ['jpg','png','pdf','svg'];
            foreach($formats as $format){
                $cloudconvert = new CloudConvert([
                    'api_key' => env('CLOUDCONVERT_API_KEY'),
                    'sandbox' => false
                ]);
        
                    $job = (new Job())
                    ->setTag('myjob-1')
                    ->addTask(
                        (new Task('import/url', 'import-my-file'))
                            ->set('url',$imgurl)
                    )
                    ->addTask(
                        (new Task('convert', 'convert-my-file'))
                            ->set('input', 'import-my-file')
                            ->set('output_format', $format)
                            ->set('some_other_option', 'value')
                    )
                    ->addTask(
                        (new Task('export/url', 'export-my-file'))
                            ->set('input', 'convert-my-file')
                    );
                    $cloudconvert->jobs()->create($job);
        
                    $cloudconvert->jobs()->wait($job); // Wait for job completion
                        foreach ($job->getExportUrls() as $file) {
        
                            $source = $cloudconvert->getHttpTransport()->download($file->url)->detach();
                            $dest = fopen(public_path('LogoDirectory/'.$namewithoutextension.'/') . $file->filename, 'w');
                            
                            stream_copy_to_stream($source, $dest);
                        }
            }
            return true;
        }
        public function downloadLogo($media_id){
            $media = Media::find($media_id);
            if(!$media){
                return false;
            }
            // $logo = Logo::find($order->logo_id);
           
            // return $logo->media;
            // Create a temporary directory to store the copied images
            $tempDirectory = storage_path('temp'.$media->id);
            File::makeDirectory($tempDirectory);

            // Copy the images to the temporary directory
            foreach(File::glob(public_path('LogoDirectory/'.$media->directory_name).'/*') as $imagePath){
                $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
                $newImagePath = $tempDirectory . '/' . $imageName;
                File::copy($imagePath, $newImagePath);
            }

            // Create a zip file containing the copied images
            $zipFileName = $media->directory_name.'.zip';
            $zipFilePath = storage_path($zipFileName);

            $zip = new ZipArchive;
            if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                foreach(File::glob(public_path('LogoDirectory/'.$media->directory_name).'/*') as $imagePath){
                    $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
                    $newImagePath = $tempDirectory . '/' . $imageName;
                    $zip->addFile($newImagePath, $imageName);
                }
                $zip->close();
            }
            // Remove the temporary directory
            File::deleteDirectory($tempDirectory);
            return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);

        }

}

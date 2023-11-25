<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth; 
use App\Models\SpecialDesignerTask;
use App\Models\CompletedTask;
use App\Models\LogoRevision;
use App\Models\Logo;
use App\Models\Media;
use App\Mail\LogoRevisionRequest;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Notifications;
use App\Models\Wishlist;
use App\Events\SpecialDesignerNotification;
use App\Models\LogoReview;
use App\Mail\DesignerAssignedMail;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Hash;


class UserDashboardController extends Controller
{
    public function userOrders(Request $request){
        // dd(auth()->user()->id);
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where('user_id',auth()->user()->id)->get();
            if($orderDetail){
                return view('users.dashboard.order',compact('request','orderDetail'));
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
    public function orderDetail(Request $request){
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->get();
           
            if($orderDetail){
                return view('user_dashboard_view.Mylogoslist.order_detail',compact('request','orderDetail'));
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
    public function downloadLogo(Request $request){
        // Complete Task
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->first();
            $completeTask = CompletedTask::where([['client_id','=',auth()->user()->id],['logo_id','=',$orderDetail->logo_id]])->latest('created_at')->first();
           
            $previousRevision = LogoRevision::where('order_id',$orderDetail->id)->get();
            $previousRevisionCount = 0;
            if(isset($previousRevision)){
                $previousRevisionCount = count($previousRevision);
            }

            if($completeTask){
                $completedTask = $completeTask; 
            }else{
                $completedTask = '';
            }
            if($orderDetail){
                $assigneDesginer = SpecialDesignerTask::where('logo_id',$orderDetail->logo_id)->latest('created_at')->first();
                
                // return view('users.dashboard.download_logo',compact('request','orderDetail','completedTask','previousRevisionCount'));
                return view('user_dashboard_view.Mylogoslist.download_logo',compact('request','orderDetail','completedTask','previousRevisionCount','assigneDesginer'));
            }else{
                return abort(404);
            }
        }else{
            return abort(404);
        }
    }
    public function requestForRevision(Request $request){
        
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->first();
            
            // Check how many days it is done to make this order if it exceeds more than 60 days then no revision is allowed.
            
            $orderMakeAt = $orderDetail->created_at;
            $dateObj = Carbon::parse($orderMakeAt);
            $revisionValidUpto = $dateObj->addDays(60);
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');
            if($currentDate > $revisionValidUpto){
                return response()->json(['status' => 403 , 'error' => "Sorry ! You can't make request for revision after 60 days."]);
            }else{

                $logo_id = $orderDetail->logo_id;
          
                $orderDetail->on_revision = 1;
                $orderDetail->save();

                ///////////////// Send Logo Revision Request ////////////////////

                /////////////////// Check previous Revision Request ////////////
                $previousRevision = LogoRevision::where('order_id',$orderDetail->id)->get();
                $previousRevisionCount = 0;
                if(!empty($previousRevision) && count($previousRevision) > 0){
                    $previousRevisionCount = count($previousRevision);
                }
                $logoRevision = new LogoRevision;
                $logoRevision->order_id = $orderDetail->id;
                $logoRevision->request_title = $request->request_title ;
                $logoRevision->request_description = $request->request_description ;
                $logoRevision->logo_id = $logo_id;
                $logoRevision->revision_time = $previousRevisionCount;
                $logoRevision->status = 0; // status 0 mean  revision request sent by user  
                $logoRevision->save();
                // ::::::::::::::::::  Send mail from here ::::::::::::::::: 
                $mailData = array(
                    'msg' => auth()->user()->name.' ask for revision for his order.',
                    'title' => 'Logo Revision',
                );
        
                $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoRevisionRequest($mailData));

                return response()->json(['status'=>200,'success' => 'You revision request is sent.']);
            }
        }else{
            return abort(404);
        }
    }
    public function downloadProcess(Request $request){
        // return $request->complete_task_id;
        $complete_task_id = $request->complete_task_id;
        $completedTask = CompletedTask::find($complete_task_id);
        $order_num = Order::find($completedTask->order_id)->value('order_num');
        $directory_name = "Order_".$order_num;
        $media = unserialize($completedTask->media_id);
        
        $media_in_response = array();

        if(!empty($media)){
            $filePathArr = array();
            $imagePaths  = array();
            if(is_array($media)){

                foreach($media as $m){
                    $media_data = Media::find($m);
                    $imagePaths[] = public_path($media_data->image_path);
                }

                // Create a temporary directory to store the copied images
                $tempDirectory = storage_path('temp');
                File::makeDirectory($tempDirectory);

                // Copy the images to the temporary directory
                foreach ($imagePaths as $imagePath) {
                    $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
                    $newImagePath = $tempDirectory . '/' . $imageName;
                    File::copy($imagePath, $newImagePath);
                }

                // Create a zip file containing the copied images
                $zipFileName = $directory_name.'.zip';
                $zipFilePath = storage_path($zipFileName);

                $zip = new ZipArchive;
                if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
                    foreach ($imagePaths as $imagePath) {
                        $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
                        $newImagePath = $tempDirectory . '/' . $imageName;
                        $zip->addFile($newImagePath, $imageName);
                    }
                    $zip->close();
                }

                // Remove the temporary directory
                File::deleteDirectory($tempDirectory);

                // Create a downloadable response for the zip file
                return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
            }
        }else{
            return redirect()->back()->with('error','There is an error in system please talk with support');
        }
        return redirect()->back();
    }
    public function approveLogo(Request $request){
        $complete_task_id = $request->complete_task_id;
        $completedTask = CompletedTask::find($complete_task_id);
        $specialDesignerTaskID =  $completedTask->task_id;
        $specialDesignerTask = SpecialDesignerTask::find($specialDesignerTaskID);
        $logoRevisionID = $specialDesignerTask->logo_revision_id;
        $logoRevision = LogoRevision::find($logoRevisionID);
        $orderDetail = Order::find($logoRevision->order_id);
        
        //Update order status 1 -> 0
        $orderDetail->on_revision = 0; // O means completely done // 1 is on revision
        $orderDetail->update(); 

        // Update status Complete task table 
        $completedTask->status = 1; // Approved by cutomer 
        $completedTask->update();

        // Update status in special designer task
        $specialDesignerTask->status = 2; // Approved by customer 
        $specialDesignerTask->update();

        // Update in Logo Revision table
        $revision_time = (int)$logoRevision->revision_time;
        if(empty($revision_time) || $revision_time == null || $revision_time == ''){
            $revision_time = 0 ;
        }
        $revision_time = $revision_time + 1 ;
        $logoRevision->revision_time = $revision_time;
        $logoRevision->status = 1;
        $logoRevision->update();

        return redirect()->back()->with('success','You have successfully approved all changes.');
        // dd($logoRevision);
    }
    public function disapproveLogo(Request $request){
        
        $complete_task_id = $request->complete_task_id;
        $completedTask = CompletedTask::find($complete_task_id);
        $specialDesignerTaskID =  $completedTask->task_id;
        $specialDesignerTask = SpecialDesignerTask::find($specialDesignerTaskID);
        $logoRevisionID = $specialDesignerTask->logo_revision_id;
        $logoRevision = LogoRevision::find($logoRevisionID);

        // // Update status Complete task table 
        $completedTask->status = 2; // Not Approved by cutomer 
        $completedTask->update();

        // // Update status in special designer task
        $specialDesignerTask->status = 3; // Not Approved by customer 
        $specialDesignerTask->update();
        $assignedIndex = 0;
        $task_backup_designer = unserialize($specialDesignerTask->backup_designer_id);
        // $newAssignedDesigner = $task_backup_designer[0];
        $newAssignedDesigner = '';

        foreach($task_backup_designer as $ind => $designer_id){
            $user = User::find($designer_id);
            if($user){
                $newAssignedDesigner = $designer_id;
                $assignedIndex = $ind;
                break; 
            }else{
                unset($task_backup_designer[$ind]);
                continue;
            }
        }

        $newArr = $task_backup_designer;
        unset($newArr[$assignedIndex]);
        $newBackupDesigner = array_values($newArr);
        $task_duration = $specialDesignerTask->task_duration;

        // Assign task to new designer 
        $newTask = new SpecialDesignerTask;
        $newTask->logo_revision_id = $logoRevisionID;
        $newTask->logo_id = $specialDesignerTask->logo_id;
        $newTask->client_id = $specialDesignerTask->client_id;
        $newTask->assigned_designer_id = $newAssignedDesigner;
        $newTask->backup_designer_id = serialize($newBackupDesigner);
        $newTask->task_duration = $task_duration;
        $newTask->status = 0;
        $newTask->save();
        $mailData = array(
            'msg' => ' You have new logo for revision please check your dashboard. ',
            'title' => 'New logo Revision request',
        );
        $user = User::find($newAssignedDesigner);
        $mail = Mail::to($user->email)->send(new DesignerAssignedMail($mailData));

        /* try to send notification to assigned designer : */

        $notifications = Notifications::create(array(
            'type' => 'designer-aproved-for-logo',
            'sender_id' => '0',
            'reciever_id' => $newAssignedDesigner,
            'designer_id' => $newAssignedDesigner,
            'logo_id' => $specialDesignerTask->logo_id,
            'message' => 'You have new task for <span>logo revision </span>.'
        )); 
        $eventData = array(
            'type' => 'designer-aproved-for-logo',
            'designer_id' => $newAssignedDesigner,
            'notification_id' => $notifications->id,
            'logo_id' => $specialDesignerTask->logo_id,
            'read_url' => url('read-notification/'.$notifications->id),
            'message' => 'You have new task for <span>logo revision </span>.'
        );
        event(new SpecialDesignerNotification($eventData));
        return redirect()->back()->with('success','You have disapproved these changes.');
    }
   
    public function termsAndConditions(Request $request){
        return view('users.meta-pages.terms&conditions',compact('request'));
    }
    public function userDashboardIndex(Request $request){
       $wishlist = Wishlist::where('user_id',auth()->user()->id)->take(3)->orderBy('created_at','desc')->get();
       $mylogos = Order::where([['user_id',Auth::user()->id],['status',1]])->take(3)->orderBy('created_at','desc')->get();

        return view('user_dashboard_view.userDashboard.index',compact('request','wishlist','mylogos'));
    }

    public function UserFavouritelist(Request $request){
        $wishlist = Wishlist::where('user_id',auth()->user()->id)->orderBy('created_at','desc')->get();

        return view('user_dashboard_view.MyFavouriteList.index',compact('request','wishlist'));
    }

    public function UserLogoslist(Request $request){
        $mylogos = Order::where([['user_id',Auth::user()->id],['status',1]])->orderBy('created_at','desc')->get();

        return view('user_dashboard_view.Mylogoslist.index',compact('request','mylogos'));
    }

    public function UserConfiguration(Request $request){
        return view('user_dashboard_view.configuration.index',compact('request'));
    }

    public function UserSubscription(Request $request){
        return view('user_dashboard_view.subscription.index',compact('request'));
    }

    // public function UserMessages(Request $request){
    //     return view('user_dashboard_view.Message.index',compact('request'));
    // }
    public function changePassword(Request $request){
        $request->validate([
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ]);
        $password = Hash::make($request->password);

        $user = User::find(Auth::user()->id);
        $user->password = $password;
        $user->update();
        return redirect()->back()->with('success','Successfully updated password');
    }
    public function reviewSubmit(Request $request){
    
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'rating' => 'required',
        ]);
        $review = new LogoReview;
        $review->title = $request->title;
        $review->description = $request->description;
        $review->logo_id = $request->logo_id;
        $review->rating = $request->rating;
        $review->user_id = Auth::user()->id;
        $review->approved = 0;
        $review->status = 1;
        $review->save();
        return redirect()->back()->with('success','Successfully added review');

    }
    public function removeWhislist(Request $request){
        $wishlist = Wishlist::find($request->id);
        if($wishlist){
            $wishlist->delete();
            return response()->json(['success'=>'Successfully removed']);
        }else{
            return response()->json(['error'=>"Can't find in your wishlist"]);
        }
    }
}

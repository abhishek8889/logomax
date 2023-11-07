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
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use ZipArchive;




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
                return view('users.dashboard.order_detail',compact('request','orderDetail'));
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
            $completeTask = CompletedTask::where([['client_id','=',auth()->user()->id],['logo_id','=',$orderDetail->logo_id],['status','=',0]])->first();
            
            if($completeTask){
                $completedTask = $completeTask; 
            }else{
                $completedTask = '';
            }
            if($orderDetail){
                return view('users.dashboard.download_logo',compact('request','orderDetail','completedTask'));
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
                // $logo = Logo::find($logo_id);
                // $logo->status = 2 ; //  status = 2 => on revision 
                // $logo->update(); 
                $orderDetail->on_revision = 1;
                $orderDetail->save();

                ///////////////// Send Logo Revision Request ////////////////////

                $logoRevision = new LogoRevision;
                $logoRevision->order_id = $orderDetail->id;
                $logoRevision->request_title = $request->request_title ;
                $logoRevision->request_description = $request->request_description ;
                $logoRevision->logo_id = $logo_id;
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
        

        // Update status Complete task table 
        $completedTask->status = 1; // Approved by cutomer 
        $completedTask->update();

        // Update status in special designer task
        $specialDesignerTask->status = 2; // Approved by customer 
        $specialDesignerTask->update();

        // Update in Logo Revision table
        $revision_time = $logoRevision->revision_time;
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
        // $complete_task_id = $request->complete_task_id;
        // $completedTask = CompletedTask::find($complete_task_id);
        // $specialDesignerTaskID =  $completedTask->task_id;
        // $specialDesignerTask = SpecialDesignerTask::find($specialDesignerTaskID);
        // $logoRevisionID = $specialDesignerTask->logo_revision_id;
        // $logoRevision = LogoRevision::find($logoRevisionID);

        // // Update status Complete task table 
        // $completedTask->status = 1; // Approved by cutomer 
        // $completedTask->update();

        // // Update status in special designer task
        // $specialDesignerTask->status = 2; // Approved by customer 
        // $specialDesignerTask->update();

        // // Update in Logo Revision table
        // $revision_time = $logoRevision->revision_time;
        // if(empty($revision_time) || $revision_time == null || $revision_time == ''){
        //     $revision_time = 0 ;
        // }
        // $revision_time = $revision_time + 1 ;
        // $logoRevision->revision_time = $revision_time;
        // $logoRevision->status = 1;
        // $logoRevision->update();


        // return redirect()->back()->with('success','You have disapproved these changes.');
    }
    public function termsAndConditions(Request $request){
        return view('users.meta-pages.terms&conditions');
    }
    public function userDashboardIndex(Request $req){
        return view('user_dashboard_view.userDashboard.index');
    }

    public function UserFavouritelist(){
        return view('user_dashboard_view.MyFavouriteList.index');
    }

    public function UserLogoslist(){
        return view('user_dashboard_view.Mylogoslist.index');
    }

    public function UserConfiguration(){
        return view('user_dashboard_view.configuration.index');
    }

    public function UserSubscription(){
        return view('user_dashboard_view.subscription.index');
    }

    public function UserMessages(){
        return view('user_dashboard_view.Message.index');
    }
    
}
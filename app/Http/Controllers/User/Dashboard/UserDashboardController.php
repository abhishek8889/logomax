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
use App\Models\UserBillingAddress;
use App\Models\Notifications;
use App\Models\Wishlist;
use App\Events\SpecialDesignerNotification;
use App\Events\SendMessages;
use App\Models\Message;
use App\Models\LogoReview;
use App\Models\AdditionalRevision;
use App\Models\AdditionalOptions;
use App\Mail\DesignerAssignedMail;
use Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Hash;
use Stripe\Stripe;


class UserDashboardController extends Controller
{
    public function __construct()
    {
        // $this->middleware('throttle:1,1')->only('requestForRevision');
    }
    public function userOrders(Request $request)
    {
        // dd(auth()->user()->id);
        if (Auth::check()) {
            $orderDetail = Order::with('logodetail')->where('user_id', auth()->user()->id)->get();
            if ($orderDetail) {
                return view('users.dashboard.order', compact('request', 'orderDetail'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
    public function orderDetail(Request $request)
    {
        $order_num = $request->order_num;
        if (Auth::check()) {
            $orderDetail = Order::with('logodetail')->where([['user_id', '=', auth()->user()->id], ['order_num', '=', $order_num]])->get();

            if ($orderDetail) {
                return view('user_dashboard_view.Mylogoslist.order_detail', compact('request', 'orderDetail'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
    public function downloadLogo(Request $request)
    {

        // Complete Task
        $order_num = $request->order_num;
        if (Auth::check()) {
            $orderDetail = Order::with('logodetail')->where([['user_id', '=', auth()->user()->id], ['order_num', '=', $order_num]])->first();

            $freeRevisionDayLimit = 7;
            $orderMakeAt = $orderDetail->created_at;
            $dateObj = Carbon::parse($orderMakeAt);
            $freeRevisionValidUpto = $dateObj->addDays($freeRevisionDayLimit); // Revision request allowed with in 7 days of buying .
            $freeRevisionLimit = 3; // 3 revision will be free  
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');

            $previousLogoRevision = LogoRevision::where([['order_id', '=', $orderDetail->id], ['what_you_revised', '=', 'logo']])->get();
            $previousFaviconRevision = LogoRevision::where([['order_id', '=', $orderDetail->id], ['what_you_revised', '=', 'favicon']])->get();

            $previousLogoRevisionCount = 0;
            $previousFaviconRevisionCount = 0;

            $lastRevisionLogo = '';
            $lastRevision_user_logo = '';

            $lastRevisionFavicon = '';
            $lastRevision_user_favicon = '';

            if ($previousLogoRevision->isNotEmpty()) {
                $previousLogoRevisionCount = count($previousLogoRevision);

                $lastRevisionLogo = $previousLogoRevision->last();
                $lastRevision_user_logo = User::find($lastRevisionLogo->assigned_designer_id);
            }


            if ($previousFaviconRevision->isNotEmpty()) {
                $previousFaviconRevisionCount = count($previousFaviconRevision);

                $lastRevisionFavicon = $previousFaviconRevision->last();
                $lastRevision_user_favicon = User::find($lastRevisionFavicon->assigned_designer_id);
            }
            // dd($previousFaviconRevisionCount);


            // dd($previousRevisionCount);
            // 3 Revisions are free .
            // dd($freeRevisionValidUpto);
            $revisionAllowed = '';
            $availableRevisionID = '';

            $faviconRevisionAllowed = '';
            $availableFaviconRevisionID = '';
            // Check revision allowed for logo 
            if ($currentDate < $freeRevisionValidUpto) {
                // Free revision limit is there
                if ($previousLogoRevisionCount < 3) {
                    $revisionAllowed = true;
                    // dd();
                } else {
                    $availableRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', 'logo_revision']])->get();
                    $availableRevisionCount = count($availableRevision);
                    if ($availableRevisionCount > 0) {
                        foreach ($availableRevision as $revision) {
                            $availableRevisionID = $revision->id;
                        }
                        $revisionAllowed = true;
                    } else {
                        $revisionAllowed = false;
                    }
                }
            } else {
                // Free revision time is over
                $availableRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', 'logo_revision']])->get();
                $availableRevisionCount = count($availableRevision);

                if ($availableRevisionCount > 0) {
                    foreach ($availableRevision as $revision) {
                        $availableRevisionID = $revision->id;
                    }
                    $revisionAllowed = true;
                } else {
                    $revisionAllowed = false;
                }
            }
            // dd($currentDate , $freeRevisionValidUpto);

            // Check revision allowed for favicon 

            // dd($currentDate , $freeRevisionValidUpto,$orderMakeAt);

            if ($currentDate < $freeRevisionValidUpto) {
                if ($previousFaviconRevisionCount < 3) {
                    $faviconRevisionAllowed = [
                        'status' => true
                    ];
                } else {
                    $availableFaviconRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', 'favicon_revision']])->get();
                    $availableFaviconRevisionCount = count($availableFaviconRevision);
                    if ($availableFaviconRevisionCount > 0) {
                        foreach ($availableFaviconRevision as $revision) {
                            $availableFaviconRevisionID = $revision->id;
                        }
                        $faviconRevisionAllowed = [
                            'status' => true,
                        ];
                    } else {
                        $faviconRevisionAllowed = [
                            'status' => false,
                            'title' => 'Revision request is over',
                            'message' => 'You have used all revision request for further more you need to buy .',
                        ];
                    }
                    // dd($availableFaviconRevision);
                }
            } else {
                $availableFaviconRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', 'favicon_revision']])->get();
                $availableFaviconRevisionCount = count($availableFaviconRevision);
                if ($availableFaviconRevisionCount > 0) {
                    foreach ($availableFaviconRevision as $revision) {
                        $availableFaviconRevisionID = $revision->id;
                    }
                    $faviconRevisionAllowed = [
                        'status' => true,
                    ];

                } else {
                    $faviconRevisionAllowed = [
                        'status' => false,
                        'title' => 'Revision request is over',
                        'message' => 'You have used all revision request for further more you need to buy .',
                    ];
                }
            }

            $logoOnRevisionStatus = false;
            $faviconOnRevisionStatus = false;

            $checkLogoOnRevision = LogoRevision::where([['order_id', '=', $orderDetail->id], ['what_you_revised', '=', 'logo'], ['status', '=', 0]])->first();
            $checkFaviconOnRevision = LogoRevision::where([['order_id', '=', $orderDetail->id], ['what_you_revised', '=', 'favicon'], ['status', '=', 0]])->first();

            if ($checkLogoOnRevision) {
                $logoOnRevisionStatus = true;
            }

            if ($checkFaviconOnRevision) {
                $faviconOnRevisionStatus = true;
            }
            // dd($faviconOnRevisionStatus , $logoOnRevisionStatus);
            // dd($availableFaviconRevisionID);
            return view('user_dashboard_view.Mylogoslist.download_logo', compact('request', 'orderDetail', 'lastRevisionLogo', 'lastRevisionFavicon', 'revisionAllowed', 'availableRevisionID', 'availableFaviconRevisionID', 'lastRevision_user_logo', 'lastRevision_user_favicon', 'faviconRevisionAllowed', 'logoOnRevisionStatus', 'faviconOnRevisionStatus'));
        } else {
            return abort(404);
        }
    }

    public function checkRevisionStatus(Request $req)
    {

        $request_type = $req->request_type;
        $order_id = $req->order_id;
        $orderDetail = Order::find($order_id);

        // Check that revision request is already on revision or not ?

        $alreadyOnRevision = false;
        $checkAlreadyOnRevision = LogoRevision::where([['order_id', '=', $order_id], ['what_you_revised', '=', $request_type], ['status', '=', 0]])->first();

        if ($checkAlreadyOnRevision) {
            $alreadyOnRevision = true;
            $revisionAllowed = [
                'status' => false,
                'message' => 'Your request is already on revision.',
            ];
            return $revisionAllowed;
        }


        $freeRevisionDayLimit = 7;
        $orderMakeAt = $orderDetail->created_at;
        $dateObj = Carbon::parse($orderMakeAt);
        $freeRevisionValidUpto = $dateObj->addDays($freeRevisionDayLimit); // Revision request allowed with in 7 days of buying .
        $freeRevisionLimit = 3;
        $currentDate = Carbon::now()->format('Y-m-d H:i:s');

        $previousRevision = LogoRevision::where([['order_id', '=', $orderDetail->id], ['what_you_revised', '=', $request_type]])->get();
        $previousRevisionCount = 0;


        $lastRevision = '';
        $lastRevisionAssignedUser = '';

        // If revision is already assigned to user so get that user id .
        if ($previousRevision->isNotEmpty()) {
            $previousRevisionCount = count($previousRevision);

            $lastRevision = $previousRevision->last();
            $lastRevisionAssignedUser = User::find($lastRevision->assigned_designer_id);
        }


        $revisionAllowed = []; // Check now that revision is allowed or not ?
        $availableRevisionID = '';  // all free revision request is over and if customer buy new one than that id is here ...

        // there is two type of revision we are checking logo_revision  and favicon_revision

        $revision_type = $request_type . '_revision';
        // return $request_type;

        if ($currentDate < $freeRevisionValidUpto) {
            // Free revision limit is there
            if ($previousRevisionCount < 3) {
                $revisionAllowed = [
                    'status' => true,     // user didn't use there 3 free revision request .
                ];
            } else {
                $availableRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', $revision_type]])->get();
                $availableRevisionCount = count($availableRevision);

                if ($availableRevisionCount > 0) {
                    foreach ($availableRevision as $revision) {
                        $availableRevisionID = $revision->id;
                    }
                    $revisionAllowed = [
                        'status' => true,     // user buy more revision request .
                    ];
                } else {
                    $revisionAllowed = [
                        'status' => false,     // user dont have any revision request .
                        'title' => 'Revision request is over.',
                        'message' => "Sorry you complete your revision request for furthermore revision you have to buy.",
                        'url' => url(app()->getLocale() . '/payments/' . $revision_type . '/' . $orderDetail->order_num),
                    ];
                }
            }
        } else {
            // Free revision time is over
            $availableRevision = AdditionalRevision::where([['user_id', auth()->user()->id], ['order_id', $orderDetail->id], ['status', '=', 0], ['revision_type', '=', $revision_type]])->get();
            $availableRevisionCount = count($availableRevision);

            if ($availableRevisionCount > 0) {
                foreach ($availableRevision as $revision) {
                    $availableRevisionID = $revision->id;
                }
                $revisionAllowed = [
                    'status' => true,
                ];
            } else {
                $revisionAllowed = [
                    'status' => false,     // user dont have any revision request .
                    'title' => 'Revision request is over.',
                    'message' => "Sorry you complete your revision request for furthermore revision you have to buy.",
                    'url' => url(app()->getLocale() . '/payments/' . $revision_type . '/' . $orderDetail->order_num),
                ];
            }
        }

        if ($revisionAllowed['status'] == true) {
            $uriArr = [
                'order_id' => $orderDetail->id,
                'availableRevisionID' => $availableRevisionID
            ];

            $uriParam = base64_encode(urlencode(json_encode($uriArr)));

            $revisionAllowed['url'] = url(app()->getLocale() . '/revision/logo_revision?detail=' . $uriParam);
        }

        return $revisionAllowed;
        //////////////////////////////////////////////////////////////////////////////////////////////////////


    }


    public function revisionRequestPage(Request $request)
    {

        $receivedParams = $_GET['detail'];
        $receivedParams = json_decode(urldecode(base64_decode($receivedParams)));
        // dd($receivedParams);
        $revision_type = $request->revision_type;

        // dd($order_num , $revision_type);
        $orderDetail = '';
        if (Auth::check()) {
            $orderDetail = Order::find($receivedParams->order_id);
        }
 
        return view('user_dashboard_view.Mylogoslist.revision_request', compact('request', 'orderDetail', 'receivedParams'));
    }

    /////////////////////////////////////  Request for revision function ///////////////////////////////////

    public function requestForRevision(Request $request)
    {
        // dd($request->file('file'));
        // return response()->json(['status' => 200 ,'status_title' => 'success','title'=> 'Request Sent!', 'message' => "We are working on it."]);

        $revision_type = $request->type;
        $order_num = $request->order_id;
        if (Auth::check()) {
            $orderDetail = Order::where([['user_id', '=', auth()->user()->id], ['id', '=', $order_num]])->first();

            // Check how many days it is done to make this order if it exceeds more than 7 days then no revision is allowed.

            $freeRevisionDayLimit = 7;
            $orderMakeAt = $orderDetail->created_at;
            $dateObj = Carbon::parse($orderMakeAt);
            $revisionValidUpto = $dateObj->addDays($freeRevisionDayLimit); // Revision request allowed with in 7 days of buying .
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');

            $logo_id = $orderDetail->logo_id;

            $orderDetail->on_revision = 1;
            $orderDetail->save();

            ///////////////// Send Logo Revision Request ////////////////////

            /////////////////// Check previous Revision Request ////////////

            $previousRevision = LogoRevision::where('order_id', $orderDetail->id)->get();
            // dd($previousRevision);
            $assignedDesigner = '';
            if (count($previousRevision) > 0) {
                // $previousRevisionCount = count($previousRevision);
                foreach ($previousRevision as $revision) {
                    $assignedDesigner = $revision->assigned_designer_id;
                }
            } else {
                // logic for select designer to assign job.
                $specialDesigner = User::where('role_id', 4)->get();
                $work_load = [];

                foreach ($specialDesigner as $designer) {
                    $designerID = $designer->id;
                    $work_load[$designerID] = LogoRevision::where([['assigned_designer_id', '=', $designerID], ['status', '=', 0]])->count();
                }
                // Find the minimum value
                $minValue = min($work_load);
                // Find the key(s) with the minimum value
                $minKeys = array_keys($work_load, $minValue);
                // If there are multiple keys with the minimum value, select the first one
                $assignedDesigner = $minKeys[0];
            }
            // dd($assignedDesigner);
            $logoRevision = new LogoRevision;
            $logoRevision->order_id = $orderDetail->id;
            $logoRevision->what_you_revised = $revision_type;
            $logoRevision->request_title = $request->request_subtitle;
            $logoRevision->company_name = $request->company_name;
            if (is_array($request->selectedFonts)) {
                if (count($request->selectedFonts) > 0) {
                    $logoRevision->fonts = json_encode($request->selectedFonts);
                }
            } else {
                $logoRevision->fonts = json_encode($request->fonts);
            }
            $logoRevision->colors = json_encode($request->colors);
            $revisionFilePath = '';
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $name = 'file' . time() . '.' . $file->extension();
                $file->move(public_path() . '/revision_files', $name);
                $revisionFilePath = 'revision_files/' . $name;
                $logoRevision->file_path = 'revision_files/' . $name;
            }
            $logoRevision->request_description = $request->request_description;
            $logoRevision->logo_id = $logo_id;
            $logoRevision->assigned_designer_id = $assignedDesigner;
            $logoRevision->assigned = 1;
            $logoRevision->status = 0;  // 0  When request on revision // 1 approved by customer // 2 sent for approval // 3 denied by designer
            $logoRevision->save();

            if ($logoRevision->id) {
                if (isset($request->availableRevisionID) && !empty($request->availableRevisionID)) {
                    AdditionalRevision::destroy($request->availableRevisionID);
                }
            }

            // :::::::::::::::::: Send message direct to Assigned Designer :::::::::::::::::::::::::
            // $allfilenames = [];

            $messageText = '<ul> 
                            <li><strong>Request for :</strong> ' . strtoupper($revision_type) . '</li> 
                            <li><strong>Company name :</strong> ' . $request->company_name . '</li>
                            <li><strong>Subtitle title :</strong> ' . $request->request_subtitle . '</li>';
            // Check if $revisionFilePath is not empty
            $messageText .= (!empty($revisionFilePath)) ? '<li><strong>File :</strong> <a href="' . asset($revisionFilePath) . '">view</a></li>' : '';

            $messageText .= '<li><strong>Colors :</strong> ' . implode(",", $request->colors) . '</li>
                            <li><strong>Change description :</strong> ' . $request->request_description . '</li>
                            <li><strong>Customer name :</strong> ' . auth()->user()->first_name . ' ' . auth()->user()->last_name . '</li>
                            <li><strong>Customer email :</strong> ' . auth()->user()->email . '</li>
                        </ul>';
            $userdata = User::find(auth()->user()->id);
            $date = date('h:i A', time());

            $message = array(
                'sender_id' => auth()->user()->id,
                'reciever_id' => $assignedDesigner,
                'message' => $messageText,
                'userdata' => $userdata,
                'current_time' => $date,
                // 'files' => $allfilenames,
            );

            $savmessage = new Message;
            $savmessage->sender_id = auth()->user()->id;
            $savmessage->reciever_id = $assignedDesigner;
            $savmessage->message = $messageText;
            // $savmessage->files = json_encode($allfilenames);
            $savmessage->seen_status = 0;
            $savmessage->save();
            array_push($message, $savmessage);

            event(new SendMessages($message));

            // :::::::::::::::::::            End                        ::::::::::::::::::::::::::

            // ::::::::::::::::::  Send mail from here ::::::::::::::::: 
            $mailData = array(
                'msg' => auth()->user()->name . ' ask for ' . $revision_type . ' revision for his order.',
                'title' => $revision_type . ' Revision Request.',
            );

            $mail = Mail::to(env('ADMIN_MAIL'))->send(new LogoRevisionRequest($mailData));
            return redirect(app()->getLocale() . '/download-logo/' . $orderDetail->order_num)->with('success', 'You revision request is sent.');
            // return response()->json(['status' => 200 ,'status_title' => 'success','title'=> 'Request Sent!', 'message' => "You revision request is sent."]);

        } else {
            return abort(404);
        }
    }

    // After revision when special designer send the logo with changes then he can download from here .
    public function downloadProcess(Request $request)
    {
        // dd($request->all());
        $revision_id = $request->revision_id;
        $revisionDetail = LogoRevision::find($revision_id);
        // dd($revisionDetail);
        // if($revisionDetail->what_you_revised == 'logo'){
        $tempDirectory = storage_path('temp' . $revisionDetail->id);
        if (!File::exists($tempDirectory)) {
            File::makeDirectory($tempDirectory);
        }
        $media = Media::find($revisionDetail->updates_by_designer);
        foreach (File::glob(public_path('LogoDirectory/' . $media->directory_name) . '/*') as $imagePath) {
            $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
            $newImagePath = $tempDirectory . '/' . $imageName;
            File::copy($imagePath, $newImagePath);
        }

        // Create a zip file containing the copied images
        $zipFileName = $media->directory_name . '.zip';
        $zipFilePath = storage_path($zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach (File::glob(public_path('LogoDirectory/' . $media->directory_name) . '/*') as $imagePath) {
                $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
                $newImagePath = $tempDirectory . '/' . $imageName;
                $zip->addFile($newImagePath, $imageName);
            }
            $zip->close();
        }
        // Remove the temporary directory
        File::deleteDirectory($tempDirectory);
        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);

        // }elseif($revisionDetail->what_you_revised == 'favicon'){
        //     $media = Media::find($revisionDetail->updates_by_designer);

        //     return response()->download(public_path($media->image_path));
        // }


    }


    // public function downloadProcess(Request $request){
    //     $revision_id = $request->revision_id;
    //     $revisionDetail = LogoRevision::find($revision_id);
    //     // dd($revisionDetail);
    //     $order_num = Order::find($revisionDetail->order_id)->value('order_num');
    //     $directory_name = "Order_".$order_num;
    //     $media = json_decode($revisionDetail->updates_by_designer);

    //     $media_in_response = array();

    //     if(!empty($media)){
    //         $filePathArr = array();
    //         $imagePaths  = array();
    //         if(is_array($media)){

    //             foreach($media as $m){
    //                 $media_data = Media::find($m);
    //                 $imagePaths[] = public_path($media_data->image_path);
    //             }

    //             // Create a temporary directory to store the copied images
    //             $tempDirectory = storage_path('temp');
    //             File::makeDirectory($tempDirectory);

    //             // Copy the images to the temporary directory
    //             foreach ($imagePaths as $imagePath) {
    //                 $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
    //                 $newImagePath = $tempDirectory . '/' . $imageName;
    //                 File::copy($imagePath, $newImagePath);
    //             }

    //             // Create a zip file containing the copied images
    //             $zipFileName = $directory_name.'.zip';
    //             $zipFilePath = storage_path($zipFileName);

    //             $zip = new ZipArchive;
    //             if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
    //                 foreach ($imagePaths as $imagePath) {
    //                     $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
    //                     $newImagePath = $tempDirectory . '/' . $imageName;
    //                     $zip->addFile($newImagePath, $imageName);
    //                 }
    //                 $zip->close();
    //             }

    //             // Remove the temporary directory
    //             File::deleteDirectory($tempDirectory);

    //             // Create a downloadable response for the zip file
    //             return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    //         }
    //     }else{
    //         return redirect()->back()->with('error','There is an error in system please talk with support');
    //     }
    //     return redirect()->back();
    // }
    public function approveLogo(Request $request, $revision_id)
    {

        $revision_id = $request->revision_id;

        $logoRevision = LogoRevision::find($revision_id);

        $order = Order::find($logoRevision->order_id);
        $logoRevision->status = 1;
        $logoRevision->update();
        if ($logoRevision->what_you_revised == 'logo') {
            $order->on_revision = 0; // 1 is on revision , 0 is not in revision
            $order->update();
        }

        return redirect()->back()->with('success', 'You have successfully approved all changes.');
    }
    public function disapproveLogo(Request $request, $revision_id)
    {

        $revision_id = $request->revision_id;

        $logoRevision = LogoRevision::find($revision_id);
        $order = Order::find($logoRevision->order_id);
        $logoRevision->status = 0;
        $logoRevision->update();
        // $order->on_revision = 1; // 1 is on revision , 0 is not in revision
        // $order->update();
        return redirect()->back()->with('success', 'You have disapproved these changes.');
    }


    public function userDashboardIndex(Request $request)
    {
        $wishlist = Wishlist::with('logos')->where('user_id', auth()->user()->id)->whereHas('logos',function($query){ $query->where('status',1); })->take(3)->orderBy('created_at', 'desc')->get();
        
        $mylogos = Order::where([['user_id', Auth::user()->id], ['status', 1]])->orderBy('created_at', 'desc')->get();

        $messages = Message::where('reciever_id', Auth::user()->id)->orWhere('sender_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();

        $userids = [];
        foreach ($messages as $message) {
            array_push($userids, $message->sender_id);
            array_push($userids, $message->reciever_id);
        }
        $unique_ids = array_unique($userids);
        // print_r($unique_ids);
        $users = [];

        if ($unique_ids) {
            foreach ($unique_ids as $ids) {
                if ($ids == Auth::user()->id) {
                    continue;
                }

                $users[] = User::where('id', $ids)->with('unseenmessages', function ($query) {
                    $query->where('reciever_id', Auth::user()->id)->get();
                })->with('messages')->first();
            }
        }

        // dd($users[0]['messages']);

        return view('user_dashboard_view.userDashboard.index', compact('request', 'wishlist', 'mylogos', 'users'));
    }

    public function UserFavouritelist(Request $request)
    {
        $wishlist = Wishlist::with('logos')->where('user_id', auth()->user()->id)->whereHas('logos',function($query){ $query->where('status',1); })->orderBy('created_at', 'desc')->get();
        // dd($wishlist);
        return view('user_dashboard_view.MyFavouriteList.index', compact('request', 'wishlist'));
    }

    public function UserLogoslist(Request $request)
    {
        $mylogos = Order::where([['user_id', Auth::user()->id], ['status', 1]])->orderBy('created_at', 'desc')->get();

        return view('user_dashboard_view.Mylogoslist.index', compact('request', 'mylogos'));
    }

    public function UserConfiguration(Request $request)
    {
        $stripe = new \Stripe\StripeClient(env('STRIPE_SEC_KEY'));
        // Stripe::setApiKey(env('STRIPE_SEC_KEY'));
        $logos_for_futures = Order::where([['user_id', Auth::user()->id], ['status', 1], ['logo_for_future_status', 1]])->get();
        $paymentMethodDetailArr = [];

        if (!empty(auth()->user()->stripe_customer_id)) {
            $stripe_customer = $stripe->customers->retrieve(auth()->user()->stripe_customer_id, []);

            $customerDefaultPyamentMethod = $stripe_customer->invoice_settings->default_payment_method;

            $paymentMethodDetail = $stripe->customers->retrievePaymentMethod(
                auth()->user()->stripe_customer_id,
                $customerDefaultPyamentMethod,
                []
            );

            $paymentMethodDetailArr = array(
                'brand' => $paymentMethodDetail->card->brand,
                'exp_month' => $paymentMethodDetail->card->exp_month,
                'exp_year' => $paymentMethodDetail->card->exp_year,
                'last4' => $paymentMethodDetail->card->last4,
            );

            // $paymentMethods = $stripe->customers->allPaymentMethods(auth()->user()->stripe_customer_id,['limit'=>1]);
        }

        #################### Create setupintent ##########################
        $intent = $stripe->setupIntents->create([
            'payment_method_types' => ['card'],
        ]);
        #################### End setupintent #############################


        return view('user_dashboard_view.configuration.index', compact('request', 'logos_for_futures', 'paymentMethodDetailArr', 'intent'));
    }

    public function UserSubscription(Request $request)
    {
        $orders_with_memberships = Order::where([['user_id',Auth::user()->id],['logo_for_future_status',1]])->get();
        $logo_backup_data = AdditionalOptions::where('option_type','save-logo-for-future')->first();

        // dd($logo_backup_data);
        return view('user_dashboard_view.subscription.index', compact('request','orders_with_memberships','logo_backup_data'));
    }
    public function cancelSubscription(Request $request){
        $order_id = $request->order_id;
        $order = Order::find($order_id);
        if(!$order){
            return response()->json(['error'=>'Error found Failed to cancel subscription']);
        }
        if($order->subscription_renew_status == 0){
            return response()->json(['error'=>'Error subscription is already cancelled']);
        }
        $order->subscription_renew_status = 0;
        $order->update();
        return response()->json(['success'=>'Subscription cancelled successfully']);

    }
    // public function UserMessages(Request $request){
    //     return view('user_dashboard_view.Message.index',compact('request'));
    // }

    public function changePassword(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|confirmed|min:6',
                'new_password_confirmation' => 'required'
            ],
            [
                'old_password.required' => 'The password field is required.',
                'new_password.required' => 'The password field is required.',
                'new_password.confirmed' => 'The password confirmation does not match.',
                'new_password.min' => 'The password must be at least :min characters.',
                'new_password_confirmation.required' => 'The password confirmation field is required.',
            ]
        );

        $user = User::find(Auth::user()->id);
        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            return redirect()->back()->with('success', 'Password updated successfully.');
        }

        return redirect()->back()->with(['error' => 'The old password is incorrect.']);
    }
    public function reviewSubmit(Request $request)
    {

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
        return redirect()->back()->with('success', 'Successfully added review');

    }
    public function removeWhislist(Request $request)
    {
        $wishlist = Wishlist::find($request->id);
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['success' => 'Successfully removed']);
        } else {
            return response()->json(['error' => "Can't find in your wishlist"]);
        }
    }

    //////////   simple logo download  /////
    public function downloadLogoProcc(Request $request)
    {
        // dd($request);
        $order = Order::find($request->order_id);
        if (!$order) {
            return false;
        }
        $logo = Logo::find($order->logo_id);
        // return $logo->media;
        // Create a temporary directory to store the copied images
        $tempDirectory = storage_path('temp' . $logo->id);
        File::makeDirectory($tempDirectory);

        // Copy the images to the temporary directory
        foreach (File::glob(public_path('LogoDirectory/' . $logo->media->directory_name) . '/*') as $imagePath) {
            $imageName = pathinfo($imagePath, PATHINFO_BASENAME);
            $newImagePath = $tempDirectory . '/' . $imageName;
            File::copy($imagePath, $newImagePath);
        }

        // Create a zip file containing the copied images
        $zipFileName = $logo->media->directory_name . '.zip';
        $zipFilePath = storage_path($zipFileName);

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE) === true) {
            foreach (File::glob(public_path('LogoDirectory/' . $logo->media->directory_name) . '/*') as $imagePath) {
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

    // Update user configuration
    public function updateUserConfiguration(Request $request)
    {

        $request->validate(
            [
                'first_name' => 'required',
                'last_name' => 'required',
                'address' => 'required',
                'additional_address' => 'required',
                'zip_code' => 'required',
                'city' => 'required',
                'state' => 'required',
                'country' => 'required',
            ],
            [
                'first_name.required' => 'The first name field is required.',
                'last_name.required' => 'The last name field is required.',
                'address.required' => 'The address line 1 field is required.',
                'additional_address.required' => 'The address line 2 field is required.',
                'zip_code.required' => 'The zip code field is required.',
                'city.required' => 'The city field is required.',
                'state.required' => 'The state field is required.',
                'country.required' => 'The country field is required.',
            ]
        );

        $user = User::find(Auth::user()->id);

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'organization' => $request->organization,
            'address' => $request->address,
            'additional_address' => $request->additional_address,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        return redirect()->back()->with('success', 'record updated successfully');
    }

    public function updatePersonalInfo(Request $request)
    {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required|email'
        ], [
            'f_name.required' => 'The first name field is required.',
            'l_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required',
        ]);


        $user = User::find(Auth::user()->id);

        $user->update([
            'first_name' => $request->f_name,
            'last_name' => $request->l_name,
            'email' => $request->email
        ]);

        return redirect()->back()->with('success', 'record updated successfully');
    }

    public function updateUserBillingAddress(Request $request)
    {
        $request->validate(
            [
                'address_first_name' => 'required',
                'address_last_name' => 'required',
                'address_1' => 'required',
                'address_2' => 'required',
                'address_zip_code' => 'required',
                'address_city' => 'required',
                'address_state' => 'required',
                'tax_id' => 'required',
                'country' => 'required',
            ],
            [
                'address_first_name.required' => 'The first name field is required.',
                'address_last_name.required' => 'The last name field is required.',
                'address_1.required' => 'The address line 1 field is required.',
                'address_2.required' => 'The address line 2 field is required.',
                'address_zip_code.required' => 'The zip code field is required.',
                'address_city.required' => 'The city field is required.',
                'address_state.required' => 'The state field is required.',
                'tax_id.required' => 'The tax ID field is required.',
                'country.required' => 'The country field is required.',
            ]
        );

        $user = User::find(Auth::user()->id);
        $billingaddress = $user->billingaddress;

        if ($billingaddress === null) {
            $address = new UserBillingAddress();
            $address->user_id = $user->id;
            $address->first_name = $request->address_first_name;
            $address->last_name = $request->address_last_name;
            $address->organization = $request->address_organization;
            $address->address_1 = $request->address_1;
            $address->address_2 = $request->address_2;
            $address->zip_code = $request->address_zip_code;
            $address->city = $request->address_city;
            $address->state = $request->address_state;
            $address->tax_id = $request->tax_id;
            $address->country = $request->country;
            $address->save();

            return redirect()->back()->with('success', 'Billing address added successfully');
        } else {
            $billingaddress->update([
                'first_name' => $request->address_first_name,
                'last_name' => $request->address_last_name,
                'organization' => $request->address_organization,
                'address_1' => $request->address_1,
                'address_2' => $request->address_2,
                'zip_code' => $request->address_zip_code,
                'city' => $request->address_city,
                'state' => $request->address_state,
                'tax_id' => $request->tax_id,
                'country' => $request->country,
            ]);

            return redirect()->back()->with('success', 'Billing address updated successfully');
        }

    }
}
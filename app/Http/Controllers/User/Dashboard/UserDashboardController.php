<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth; 
use App\Models\LogoRevision;
use App\Models\Logo;
use App\Mail\LogoRevisionRequest;
use Mail;
use Carbon\Carbon;


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
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::with('logodetail')->where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->first();
            if($orderDetail){
                return view('users.dashboard.download_logo',compact('request','orderDetail'));
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
                $logo = Logo::find($logo_id);
                $logo->status = 2 ; //  status = 2 => on revision 
                $logo->update(); 

                ///////////////// Send Logo Revision Request ////////////////////

                $logoRevision = new LogoRevision;
                $logoRevision->order_id = $orderDetail->id;
                $logoRevision->request_title = $request->request_title ;
                $logoRevision->request_description = $request->request_description ;
                $logoRevision->logo_id = $logo_id;$logoRevision->status = 0; // status 0 mean  revision request sent by user  
                $logoRevision->save();
                // ::::::::::::::::::  Send mail from here ::::::::::::::::: 
                // $mailData = array(
                //     ''
                // );
                // Mail::to(env('ADMIN_MAIL'))->send(new LogoRevisionRequest());
                return response()->json(['status'=>200,'success' => 'You have succesfully send revision request.']);
            }
        }else{
            return abort(404);
        }
    }
}
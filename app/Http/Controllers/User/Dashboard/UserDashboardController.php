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
        // return response()->json(['status'=>200,'success' => 'You have succesfully send revision request.']);
    
        $order_num = $request->order_num;
        if(Auth::check()){
            $orderDetail = Order::where([['user_id','=',auth()->user()->id],['order_num','=',$order_num]])->first();
            $logo_id = $orderDetail->logo_id;
            $logo = Logo::find($logo_id);
            $logo->status = 2 ; //  status = 2 => on revision 
            $logo->update(); 

            $logoRevision = LogoRevision::where('order_num',$order_num)->first();
            if($logoRevision){
                $revisionTime = (int)$logoRevision->revision_time;
                if($revisionTime == 3){
                    // return redirect()
                }else{

                }
            }else{
                $logoRevision = new LogoRevision;
                $logoRevision->order_id = $orderDetail->id;
                $logoRevision->order_num = $orderDetail->order_num;
                $logoRevision->request_title = $request->request_title ;
                $logoRevision->request_description = $request->request_description ;
                $logoRevision->logo_id = $logo_id;
                $logoRevision->client_id = $orderDetail->user_id;
                // $logoRevision->designer_id = '';
                $logoRevision->revision_time = 0; // When customer approve revision then revision time convert to 1.
                $logoRevision->status = 0; // status 0 mean  revision request sent by user  
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
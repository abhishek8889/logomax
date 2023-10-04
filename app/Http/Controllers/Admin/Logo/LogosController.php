<?php

namespace App\Http\Controllers\Admin\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use App\Mail\ApproveLogoMail;
use App\Mail\DeapproveLogoMail;
use Mail;

class LogosController extends Controller
{
    public function index(){
        $logos = Logo::where([['status',1],['approved_status',0]])->get();

        return view('admin.logos.logosrequest',compact('logos'));
    }
    public function approvedLogos(){
        $logos = Logo::where([['status',1],['approved_status',1]])->get();
        return view('admin.logos.approvedlogos',compact('logos'));
    }
    public function disapprovedLogos(){
        $logos = Logo::where([['status',1],['approved_status',2]])->get();
       
        return view('admin.logos.disapprovedlogos',compact('logos'));
    }
    public function updateStatus(Request $request){
        if($request->action == 'approved'){
            $logos = Logo::find($request->id);
            $logos->approved_status = 1;
            $logos->update(); 
            $designer_detail = User::find($logos->designer_id);
            $mailData = [
                'logo_name' => $logos->logo_name,
                'designer_name' => $designer_detail->name,
            ];
            $mail = Mail::to($designer_detail['email'])->send(new ApproveLogoMail($mailData));
            return response()->json('successfully approved logos');
        }else{
            $logos = Logo::find($request->logo_id);
            $logos->approved_status = 2;
            $logos->admin_review = $request->review;
            $logos->update();
            $designer_detail = User::find($logos->designer_id);
            $mailData = [
                'logo_name' => $logos->logo_name,
                'designer_name' => $designer_detail->name,
            ];
            $mail = Mail::to($designer_detail['email'])->send(new DeapproveLogoMail($mailData));
            
            return redirect()->back()->with('success','successfully deapproved status');
        }
    }
}

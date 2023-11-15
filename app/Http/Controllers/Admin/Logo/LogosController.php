<?php

namespace App\Http\Controllers\Admin\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\User;
use App\Mail\ApproveLogoMail;
use App\Mail\DeapproveLogoMail;
use Mail;
use App\Events\DesignerNotification;
use App\Models\Notifications;
use App\Models\LogoFacilities;
use App\Models\AdditionalOptions;

class LogosController extends Controller
{
    public function index(){
        $logos = Logo::where([['status',1],['approved_status',0]])->get();
        return view('admin.logos.logosrequest',compact('logos'));
    }
    public function logodetail($slug){
        $logos = Logo::where('logo_slug',$slug)->first();
        if(empty($logos)){
            abort(404);
        }
       
        return view('admin.logos.logodetail',compact('logos'));
    }
    public function approvedLogos(){
        $logos = Logo::where([['status',1],['approved_status',1]])->get();
        return view('admin.logos.approvedlogos',compact('logos'));
    }
    public function disapprovedLogos(){
        $logos = Logo::where([['status',1],['approved_status',2]])->get();
       
        return view('admin.logos.disapprovedlogos',compact('logos'));
    }
    public function soldLogos(){
        $logos = Logo::where('status',3)->get();
        return view('admin.logos.sold-logos',compact('logos'));
    }
    public function updateStatus(Request $request){
        if($request->action == 'approved'){
            $logos = Logo::find($request->id);
            $logos->approved_status = 1;
            if(!empty($request->customer_price)){
                $logos->price_for_customer = $request->customer_price;
            }
            if(!empty($request->designer_price)){
                $logos->price_for_designer = $request->designer_price;
            }
            $logos->update(); 
            $designer_detail = User::find($logos->designer_id);
            $mailData = [
                'logo_name' => $logos->logo_name,
                'designer_name' => $designer_detail->name,
            ];
            $mail = Mail::to($designer_detail['email'])->send(new ApproveLogoMail($mailData));

            // Send notification to Designers ::::::::: 
                
            $notifications = Notifications::create(array(
                'type' => 'logo-approved',
                'sender_id' => '0',
                'reciever_id' => $designer_detail['id'],
                'designer_id' => $designer_detail['id'],
                'logo_id' => $logos->id,
                'message' => 'Congratulations ! Your logo is <span>Approved !</span>'
            )); 
            $eventData = array(
                'type' => 'logo-approved',
                'designer_id' => $designer_detail['id'],
                'notification_id' => $notifications->id,
                'logo_id' => $request->id,
                'read_url' => url('read-notification/'.$notifications->id),
                'message' => 'Congratulations ! Your logo is <span>Approved !</span>'
            );
            event(new DesignerNotification($eventData));

            return response()->json('You have approved this logo successfully !');
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

            // Send notification to Designers ::::::::: 

                $notifications = Notifications::create(array(
                    'type' => 'logo-disapproved',
                    'sender_id' => '0',
                    'reciever_id' => $designer_detail['id'],
                    'designer_id' => $designer_detail['id'],
                    'logo_id' => $logos->id,
                    'message' => 'Oops ! Your logo is <span>Disapproved !</span>'
                )); 
                $eventData = array(
                    'type' => 'logo-disapproved',
                    'designer_id' => $designer_detail['id'],
                    'notification_id' => $notifications->id,
                    'logo_id' => $request->id,
                    'read_url' => url('read-notification/'.$notifications->id),
                    'message' => 'Oops ! Your logo is <span>Disapproved !</span>'
                );
                event(new DesignerNotification($eventData));
            
            return redirect()->back()->with('success','You have disapproved this logo.');
        }
    }
    public function logoFacilities(Request $req){
        $logoFacilities  = LogoFacilities::all();
        return view('admin.logos.logo_facilities',compact('logoFacilities'));
    }
    public function logoFacilitiesAdd(Request $req){
        // return $req->all();
        $id = $req->id;
        if(!empty($id)){
            $facility = LogoFacilities::find($id);
            if(!empty($facility)){
                $facility->facilities_name	 = $req->name;
                $facility->description = $req->description;
                $facility->update();
                return redirect()->back()->with('success','Facility is successfully updated !');
            }else{
                $facility = new LogoFacilities;
                $facility->facilities_name	 = $req->name;
                $facility->description = $req->description;
                $facility->status = 1;
                $facility->save();
                return redirect()->back()->with('success','Facility is successfully added !');
            }
        }else{
            $facility = new LogoFacilities;
            $facility->facilities_name	 = $req->name;
            $facility->description = $req->description;
            $facility->status = 1;
            $facility->save();
            return redirect()->back()->with('success','Facility is successfully added !');
        }
    }

    public function logoFacilitiesDelete(Request $req){
        $facility = LogoFacilities::find($req->id);
        $facility->delete();
        return redirect()->back()->with('success','You have succesfully deleted one item.');
    }
    public function additionalOptions(Request $req){
        $addtionaloption = AdditionalOptions::where('status',1)->get();
        $editoption = AdditionalOptions::find($req->id);

        return view('admin.logos.additional-options',compact('addtionaloption','editoption'));
    }
    public function additionalOptionsSave(Request $request){
        // $request->validate([
        //     'text' => 'required',
        //     'duration' => 'required',
        //     'amount' => 'required',
        // ]);
        if(!$request->id){
            $options = new AdditionalOptions;
            $options->option_text = $request->text;
            $options->option_type = $request->option_type;
            $options->pricing_duration = $request->duration;
            $options->percentage = $request->percentage;
            $options->amount = $request->amount;
            $options->currency = $request->currency;
            $options->save();
            return redirect()->back()->with('success','successfully saved additional option');
        }else{
            $options = AdditionalOptions::find($request->id);
            $options->option_text = $request->text;
            $options->option_type = $request->option_type;
            $options->pricing_duration = $request->duration;
            $options->percentage = $request->percentage;
            $options->amount = $request->amount;
            $options->currency = $request->currency;
            $options->update();
            return redirect()->back()->with('success','successfully updated additional option');
        }
    }
    public function deleteAdditionlaOption($id){
        $addtionaloption = AdditionalOptions::find($id);
        if($addtionaloption){
            $addtionaloption->delete();
            return redirect()->back()->with('success','successfully deleted options');
        }else{
            return redirect()->back()->with('error','Failed! Something went wrong');

        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Revision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogoRevision;
use App\Models\User;
use App\Models\SpecialDesignerTask;

class RevisionController extends Controller
{
    public function revisionRequest(Request $req){
        // return view();
        $logo_on_revision = LogoRevision::with('logoDetail','orderDetail','customerDetail')->orderBy('created_at', 'DESC')->get();
       
        return view('admin.revision.revision_request',compact('logo_on_revision'));
    }
    public function revisionRequestDetail(Request $req){
        $specialDesigners = User::where('role_id',4)->get();
        
        $req_id = $req->request_id;
        $revisionDetail = LogoRevision::with('logoDetail','orderDetail','customerDetail')->find($req_id);
        // dd($revisionDetail);
        return view('admin.revision.revision_request_detail',compact('revisionDetail','specialDesigners'));
    }
    public function assignToSpecialDesigner(Request $req){
        // return $req->all();
        $serializeBackupDesigner = '';
        if(!empty($req->backup_designer_list) && is_array($req->backup_designer_list)){
            $serializeBackupDesigner = serialize($req->backup_designer_list);
        }

        $specialDesignerTask = new SpecialDesignerTask;
        $specialDesignerTask->logo_revision_id = $req->revision_request_id;
        $specialDesignerTask->logo_id = $req->logo_id;
        $specialDesignerTask->client_id = $req->client_id;
        $specialDesignerTask->assigned_designer_id = $req->selectedDesigner;
        $specialDesignerTask->backup_designer_id = $serializeBackupDesigner;
        $specialDesignerTask->task_duration = $req->duration_for_complete;
        $specialDesignerTask->status = 0;  // assigned or on working , 1 done but not approved by customer , 2 disapproved by customer , 3 Approved by cutomer
        $specialDesignerTask->save();
        return response()->json(['status'=>200,'success'=>'You have successfully assign this work to special designer.' ,'requestData' => $req->all()]);
    }
}

<?php

namespace App\Http\Controllers\Admin\Revision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LogoRevision;
use App\Models\User;

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
        return view('admin.revision.revision_request_detail',compact('revisionDetail','specialDesigners'));
    }
}

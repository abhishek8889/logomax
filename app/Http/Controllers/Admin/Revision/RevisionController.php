<?php

namespace App\Http\Controllers\Admin\Revision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function revisionRequest(Request $req){
        // return view();
        return view('admin.revision.revision_request');
    }
}

<?php

namespace App\Http\Controllers\Admin\Logo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;

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
}

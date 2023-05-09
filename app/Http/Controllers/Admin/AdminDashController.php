<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashController extends Controller
{
    //
    public function index(Request $request){
        return view('admin.dashboard.index');
    }
}

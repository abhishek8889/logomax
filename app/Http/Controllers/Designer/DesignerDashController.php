<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DesignerDashController extends Controller
{
    public function index(Request $request){
        return view('designer.dashboard.index');
    }
    
}

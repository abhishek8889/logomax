<?php

namespace App\Http\Controllers\SpecialDesigner\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SpecialDesignerDashboardController extends Controller
{
    //
    public function index(Request $req){
        return view('special_designer.dashboard.index');
    }
}

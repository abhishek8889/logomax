<?php

namespace App\Http\Controllers\User\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageCropperController extends Controller
{
    public function index(Request $request){

        return view('user_dashboard_view.image_cropper.index',compact('request'));
    }
}

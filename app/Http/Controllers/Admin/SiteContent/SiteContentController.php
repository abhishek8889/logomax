<?php

namespace App\Http\Controllers\Admin\SiteContent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteContentController extends Controller
{
    public function homeContent(){
        return true;
    }

    public function aboutContent(){
        return true;
    }
}

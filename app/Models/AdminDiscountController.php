<?php

namespace App\Http\Controllers\Admin\Discount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discount;

class AdminDiscountController extends Controller
{
    public function index(){

        return view('admin.discount.discount');
    }
}

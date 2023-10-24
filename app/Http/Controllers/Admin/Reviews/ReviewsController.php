<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    public function addReview(Request $req){
        return view('admin.reviews.add_review');
    }
    public function addReviewProcc(Request $req){
        return $req->all();
    }
}

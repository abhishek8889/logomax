<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoReview;

class ReviewsController extends Controller
{
    public function addReview(Request $req){
        $soldLogoList = Logo::where('status',3)->orWhere('status',2)->get();
        return view('admin.reviews.add_review',compact('soldLogoList'));
    }
    public function addReviewProcc(Request $req){
        if($req->review_by =='admin'){
            $review = new LogoReview;
            $review->user_id = $req->review_by;
            $review->logo_id = $req->logo_id;
            $review->title = $req->title;
            $review->description = $req->description;
            $review->approved = 1;
            $review->rating = $req->star_rating;
            $review->status = 1;
            $response = array(
                'status' => 201,
                'message' => 'Review is added successfully'
            );
            $review->save();
            return response()->json($response , 201);
        }else{

        }
    }
}

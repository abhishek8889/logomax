<?php

namespace App\Http\Controllers\Admin\Reviews;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logo;
use App\Models\LogoReview;

class ReviewsController extends Controller
{
    public function editReview($id = null){
        $review = LogoReview::find($id);
        $soldLogoList = Logo::where('status',3)->orWhere('status',2)->get();
        return view('admin.reviews.add_review',compact('soldLogoList','review'));
    }
    public function reviewlist(){
        $reviews = LogoReview::where('approved',1)->get();

        return view('admin.reviews.reviews_list',compact('reviews'));
    }
    public function addReviewProcc(Request $req){
        $req->validate([
            'title' => 'required',
            'logo_id' => 'required',
            'description' => 'required',
            'rating' => 'required'
        ]);
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
            $review = LogoReview::find($req->id);
            $review->title = $req->title;
            $review->description = $req->description;
            $review->logo_id = $req->logo_id;
            $review->rating = $req->rating;
            $review->update();
            return redirect()->back()->with('success','Successfully updated');
        }
    }
    public function updatestatus(Request $request){
        $review = LogoReview::find($request->id);
        $review->home_page_status = $request->status;
        $review->update();
        return $review;
    }
    public function delete($id){
        $review = LogoReview::find($id);
        if(!$review){
            abort(404);
        }
        $review->delete();
        return redirect()->back()->with('success','Successfully deleted');
    }

    public function reviewsrequest(){
        $reviews = LogoReview::where('approved',0)->get();

        return view('admin.reviews.reviews_requests',compact('reviews'));
    }
    public function reviewsStatus($id){
        $review = LogoReview::find($id);
        $review->approved = 1;
        $review->update();
        return redirect()->back()->with('success','Successfully updated');
    }
}

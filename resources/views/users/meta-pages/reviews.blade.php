@extends('user_layout.master')
@section('content')

<?php 
$ratingget = 0;
foreach($reviews as $review){
    $ratingget += $review->rating;
}
 $totalrating =  $ratingget/count($reviews);
 $totalrate = count($reviews);
 $onerate = count($onerating);
 $zerorate = count($zerorating);
 $tworate = count($tworating);
 $threerate = count($threerating);
 $fourrate = count($fourrating);
 $fiverate = count($fiverating);
?>
<div class="container">
    <div class="col-lg-6">
        <img src="https://sagmetic.site/2023/laravel/logomax/public/siteMeta/Other_pages_Site_Logo_1699956563.svg" alt="" height="150px">
        <div class="reviewsite p-4 d-flex justify-content-between">
			<p  style="font-size:40px;">
			<span>{{ number_format(round($totalrating),2) ?? '5.0' }}</span> | <span id="post_rev_btn_opn">{{ count($reviews) ?? 0 }} opinión</span>
			</p>
			
			<div class="str_rate">
			<img src="https://cdn.trustpilot.net/brand-assets/4.1.0/stars/stars-{{ round($totalrating) ?? 5 }}.svg" alt="" height="40px" />
          </div>
            </div>
		</div>
    </div>
</div>

<hr class="px-5">

<div class="container p-5 my-4" style="border: 1px solid black;">
    <div class="first d-flex justify-content-between">
        <h3>0 Star</h3>
        <h3>{{ round($zerorate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
    <div class="first d-flex justify-content-between">
        <h3>1 Star</h3>
        <h3>{{ round($onerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
    <div class="first d-flex justify-content-between">
        <h3>2 Star</h3>
        <h3>{{ round($tworate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
    <div class="first d-flex justify-content-between">
        <h3>3 Star</h3>
        <h3>{{ round($threerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
    <div class="first d-flex justify-content-between">
        <h3>4 Star</h3>
        <h3>{{ round($fourrate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
    <div class="first d-flex justify-content-between">
        <h3>5 Star</h3>
        <h3>{{ round($fiverate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</h3>
    </div>
</div>
@foreach($reviews as $review)
<div class="container p-5 my-4" style="border: 1px solid black;">
    <div class="col-lg-3 d-flex ">
        <div class="image">
            <img src="https://user-images.trustpilot.com/653dcb4dc334c7001279dc1c/64x64.png" alt="" />
        </div>
        <div class="name px-3">
            <h3>{{ $review->title ?? '' }}</h3>
            <img src="https://cdn.trustpilot.net/brand-assets/4.1.0/stars/stars-{{ $review->rating ?? 0 }}.svg" alt="" height="30px" />
        </div>
    </div>
    <div class="col-lg-3 ml-5">
       <p>{{ $review->description ?? '' }}</p>
    </div>
</div>
@endforeach
@endsection
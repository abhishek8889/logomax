@extends('user_layout.master')
@section('content')

<?php 
$ratingget = 0;
foreach($reviews as $review){
    $ratingget += $review->rating;
}
if(count($reviews) == 0){

    $totalrate = 1;
}else{

    $totalrate = count($reviews);
}
 $totalrating =  $ratingget/$totalrate;
 if($totalrating == 0){
    $totalrating = 5;
 }
 
 
 $onerate = count($onerating);
 $zerorate = count($zerorating);
 $tworate = count($tworating);
 $threerate = count($threerating);
 $fourrate = count($fourrating);
 $fiverate = count($fiverating);
?>


<section class="reviews-sec">
    <div class="container">
      <div class="review-heading">
        <div class="review-site-logo">
            <img src="{{ asset('logomax_pages/img/logomax.png') }}" class="img-fluid" alt="....">
        </div>
        <div class="review-site-text">
                <!-- <h1>Documentos-Legales.mx</h1> -->
                <p>
                <span>5.00</span> | <span id="post_rev_btn_opn">12 opinión</span>
                </p>
                <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>
                   <span class="blankstar"></span>
                   <span class="blankstar"></span>			
               </div>
            </div>
      </div>
      <div class="review-comment-us">
         <div class="rate-nd-per">
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" checked id="checkbox" />
                  <label for="checkbox"></label>
                  <span>5 stars</span>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-5"></div>
              </div>
              <div class="ryt-side">
                <div class="per-txt">20%</div>
              </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" checked id="checkbox4" />
                  <label for="checkbox4"></label>
                  <span>4 stars</span>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-4"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">20%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" checked id="checkbox3" />
                  <label for="checkbox3"></label>
                  <span>3 stars</span>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-3"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">20%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" checked id="checkbox2" />
                  <label for="checkbox2"></label>
                  <span>2 stars</span>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-2"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">20%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" checked id="checkbox1" />
                  <label for="checkbox1"></label>
                  <span>1 stars</span>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-1"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">20%</div>
             </div>
            </div>
          </div>
        <div class="all-reviews">
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">b</span></div>
            <div class="al-rw-rating">
              <h4>Burno</h4>
              <div class="mp">
              <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">j</span></div>
            <div class="al-rw-rating">
              <h4>Jenny</h4>
              <div class="mp">
                <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">j</span></div>
            <div class="al-rw-rating">
              <h4>Jack</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">b</span></div>
            <div class="al-rw-rating">
              <h4>Beverly Gibson</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">m</span></div>
            <div class="al-rw-rating">
              <h4>Michael Warren</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">b</span></div>
            <div class="al-rw-rating">
              <h4>Barbara Strange</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">rt</span></div>
            <div class="al-rw-rating">
              <h4>Rachel Tara</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">hf</span></div>
            <div class="al-rw-rating">
              <h4>Hajara Faruk Tukur</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">w</span></div>
            <div class="al-rw-rating">
              <h4>Wayne Burrows</h4>
              <div class="mp">
                <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">j</span></div>
            <div class="al-rw-rating">
              <h4>Janet Lytle</h4>
              <div class="mp">
                <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">ts</span></div>
            <div class="al-rw-rating">
              <h4>Tricia Sproles</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">ad</span></div>
            <div class="al-rw-rating">
              <h4>Burno</h4>
              <div class="mp">
                <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
          <div class="al-rw d-flex">
            <div class="al-rw-txt"><span class="rw-ad-txt">s</span></div>
            <div class="al-rw-rating">
              <h4>Samish murugesan</h4>
              <div class="mp">
               <i class="fa-solid fa-location-dot"></i>
                <span>MX</span>
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="fullstar"></span>
                   <span class="blankstar"></span>			
                 </div>
                  <p>
                   Hace 22 horas									
                 </p>
              </div>
              <p>test review</p>
            </div>
          </div>
        </div>
      </div>
      </div>
  </section>
@endsection
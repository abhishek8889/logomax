@extends('user_layout.master')
@section('content')

<?php 
  if(isset($_GET['ratingsearch'])){
      $filterRating = $_GET['ratingsearch'];
  }else{
      $filterRating = json_encode([]);
  }
  $filterratingdecode =json_decode($filterRating);
  


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
 $ratingnumber = number_format($totalrating,0);
 
 
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
        <div class="review-site-logo ">
            <img src="{{ asset('logomax-front-asset/img/logomax-icon.svg') }}" class="img-fluid" alt="....">
        </div>
        <div class="review-site-text heading">
                <h1>Logomax.com</h1>
                <p>
                <span>{{ number_format($totalrating,2) ?? '' }}</span> | <span id="post_rev_btn_opn">{{ count($reviews) ?? 0 }}@if(count($reviews) == 1) opinion @else opinions @endif</span>
                </p>
                <div class="str_rate ">
                   <span class="@if($totalrating >= 1) fullstar @else blankstar @endif"></span>
                   <span class="@if($totalrating >= 2) fullstar @else blankstar @endif"></span>
                   <span class="@if($totalrating >= 3) fullstar @else blankstar @endif"></span>
                   <span class="@if($totalrating >= 4) fullstar @else blankstar @endif"></span>
                   <span class="@if($totalrating >= 5) fullstar @else blankstar @endif"></span>			
               </div>
            </div>
      </div>
      <div class="review-comment-us">
         <div class="rate-nd-per">
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" name="rating" @if(in_array(5,$filterratingdecode)) checked @endif id="checkbox5" value="5"/>
                  <label for="checkbox5"></label>
                  <div class="star_Av review-site-text">
                  <div class="str_rate ">
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>			
                  </div>
                </div>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-5" style="width:{{ round($fiverate/$totalrate*100,0,PHP_ROUND_HALF_DOWN) ?? 0 }}%;"></div>
              </div>
              <div class="ryt-side">
                <div class="per-txt">{{ round($fiverate/$totalrate*100,0,PHP_ROUND_HALF_DOWN) ?? 0 }}%</div>
              </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" name="rating" @if(in_array(4,$filterratingdecode)) checked @endif id="checkbox4" value="4" />
                  <label for="checkbox4"></label>
                  <div class="star_Av review-site-text">
                  <div class="str_rate ">
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>			
                  </div>
                </div>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-4" style="width:{{ round($fourrate/$totalrate*100,0,PHP_ROUND_HALF_DOWN) ?? 0 }}%;"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">{{ round($fourrate/$totalrate*100,0,PHP_ROUND_HALF_DOWN) ?? 0 }}%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" name="rating" @if(in_array(3,$filterratingdecode)) checked @endif id="checkbox3" value="3" />
                  <label for="checkbox3"></label>
                  <div class="star_Av review-site-text">
                  <div class="str_rate ">
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>			
                  </div>
                </div>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-3" style="width:{{ round($threerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%;"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">{{ round($threerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" name="rating" @if(in_array(2,$filterratingdecode)) checked @endif id="checkbox2" value="2" />
                  <label for="checkbox2"></label>
                  <div class="star_Av review-site-text">
                  <div class="str_rate ">
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="fullstar" style="color:#FBBC04;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>
                    <span class="blankstar" style="color:#ccc;"></span>			
                  </div>
                </div>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-2" style="width:{{ round($tworate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%;"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">{{ round($tworate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</div>
             </div>
            </div>
            <div class="rating-with-perct">
              <div class="left-side">
                <div class="round">
                  <input type="checkbox" name="rating" @if(in_array(1,$filterratingdecode)) checked @endif id="checkbox1" value="1" />
                  <label for="checkbox1"></label>
                  <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="fullstar" style="color:#FBBC04;"></span>
                   <span class="blankstar" style="color:#ccc;"></span>
                   <span class="blankstar" style="color:#ccc;"></span>
                   <span class="blankstar" style="color:#ccc;"></span>
                   <span class="blankstar" style="color:#ccc;"></span>			
                 </div>
              </div>
                </div>
              </div>
              <div class="mid-line">
                <div class="bar-1" style="width:{{ round($onerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%;"></div>
              </div>
             <div class="ryt-side">
                <div class="per-txt">{{ round($onerate/$totalrate*100,PHP_ROUND_HALF_DOWN) ?? 0 }}%</div>
             </div>
            </div>
          </div>
        <div class="all-reviews">
          @foreach($reviews_real as $review)
          <?php
             if(isset($review->user)){
              $name = $review->user->first_name.' '.$review->user->last_name;
              $span_text = substr(strtoupper($review->user->first_name), 0, 1).''.substr(strtoupper($review->user->last_name), 0, 1);
            }else{
              $name = $review->title;
              $span_text = substr(strtoupper($review->title), 0, 2);
            }

            $reviewtime = strtotime($review->created_at);
            $currentime = strtotime(date('m/d/Y h:i:s a', time()));
            $diffrence = abs($currentime - $reviewtime);
            $years = floor($diffrence / (365*60*60*24)); 
            $months = floor(($diffrence - $years * 365*60*60*24) / (30*60*60*24));
            $days = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
            $hours = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
            $minutes = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

            // $color_codes = ['#543932','#535FAC','#5D8F33','#2E5E1B','#3E515A','#004439','#D76100','#AE1552',];
            $color_codes = ['#4cce5f'];
            ?>
          <div class="review-box al-rw d-flex" rating="{{ $review->rating ?? '' }}">
            <div class="al-rw-txt"><span class="rw-ad-txt" style="background-color:{{ $color_codes[array_rand($color_codes)] }}; color: white; font-size: x-large;">{{ $span_text }}</span></div>
            
            <div class="al-rw-rating">
              <h4 style="text-transform:capitalize;">{{ $name ?? '' }}</h4>
              <div class="mp">
              @if($years == 1) {{ $years }} year ago @elseif($years > 1) {{ $years }} years ago @elseif($months == 1) {{ $months }} month ago @elseif($months > 1) {{ $months }} months ago @elseif($days == 1) {{ $days }} day ago @elseif($days > 1) {{ $days }} days ago @elseif($hours == 1) {{ $hours }} hour ago @elseif($hours > 1) {{ $hours }} hours ago @elseif($minutes == 1) {{ $minutes }} minute ago @elseif($minutes > 1) {{ $minutes }} minutes ago @else Just Now @endif	
              </div>
              <div class="star_Av review-site-text">
                 <div class="str_rate ">
                   <span class="@if($review->rating >= 1) fullstar @else blankstar @endif"></span>
                   <span class="@if($review->rating >= 2) fullstar @else blankstar @endif"></span>
                   <span class="@if($review->rating >= 3) fullstar @else blankstar @endif"></span>
                   <span class="@if($review->rating >= 4) fullstar @else blankstar @endif"></span>
                   <span class="@if($review->rating >= 5) fullstar @else blankstar @endif"></span>			
                 </div>
                  <p>
                    {{ number_format($review->rating ?? 5,1) }}
                   								
                 </p>
              </div>
              <p>{{ $review->description ?? '' }}</p>
            </div>
          </div>
          @endforeach
          @if ($reviews_real->hasPages())
                    <div class="pro_navigation">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                               
                                <li class="page-item arrow_wreap">
                                @if($reviews_real->previousPageUrl() !== null)
                                    <a class="page-link" href="?page={{ $reviews_real->currentPage()-1 }}&ratingsearch={{ urlencode($filterRating) ?? '' }}" aria-label="Previous">
                                        <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                                    </a>
                                @else
                                    <a class="page-link" aria-label="Previous" disabled>
                                        <span aria-hidden="true"><i class="fa-solid fa-chevron-left"></i></span>
                                    </a>
                                @endif
                                </li>
                               <?php $count = 0; ?>
                                @for($i = $reviews_real->currentPage()-2; $i < $reviews_real->currentPage(); $i++)
                                <?php 
                                $count = $count+1;
                                ?>
                                @if($i > 0)
                                @if($count < 3)
                                <li class="page-item @if($i == $reviews_real->currentPage()) active @endif"><a class="page-link" href="?page={{ $i }}&ratingsearch={{ urlencode($filterRating) ?? '' }}">{{ $i }}</a></li>
                                @endif
                                @endif
                                @endfor
                                <?php  
                                $num = 0;
                                ?>                                
                                @for($x = $reviews_real->currentPage(); $x <= $reviews_real->lastPage(); $x++)
                                <?php 
                                $num = $num+1;
                                ?>
                                @if($num < 4)
                                <li class="page-item @if($x == $reviews_real->currentPage()) active @endif"><a class="page-link" href="?page={{ $x }}&ratingsearch={{ urlencode($filterRating) ?? '' }}">{{ $x }}</a></li>
                                @endif
                                @endfor
                                <li class="page-item arrow_wreap">
                                    @if($reviews_real->nextPageUrl() !== null)
                                    <a class="page-link" href="?page={{ $reviews_real->currentPage()+1 }}&ratingsearch={{ urlencode($filterRating) ?? '' }}" aria-label="Next">
                                        <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                                    </a>
                                    @else
                                    <a class="page-link" aria-label="Next" Disabled>
                                        <span aria-hidden="true"><i class="fa-solid fa-chevron-right"></i></span>
                                    </a>
                                    @endif
                                </li>
                            </ul>
                        </nav>
                    </div>
                    @endif
      <!-- {{ $reviews_real->links('pagination::bootstrap-4') }} -->
        </div>
      </div>
      </div>
  </section>
  
  <script>
    $(document).ready(function(){

      ratingsearch = <?php print_r($filterRating); ?>;
      console.log(ratingsearch);
      $('input[name="rating"]').on('change',function(){
        // $('#checkbox'+value).prop('checked',true);
        value = $(this).val();
        if($(this).prop('checked')){
          ratingsearch.push(value);
          let ratinglink = encodeURIComponent(JSON.stringify(ratingsearch));
         
          location.href = "{{ url(app()->getLocale().'/reviews') }}?ratingsearch="+ratinglink;
          // $('div.review-box').addClass('d-none');
          // $('div.review-box').removeClass('d-flex');
          
          // $('div[rating="'+value+'"]').addClass('d-flex');
          // $('div[rating="'+value+'"]').removeClass('d-none');
        }else{
          ratingsearch = jQuery.grep(ratingsearch, function(value1) {
                            return value1 != value;
                            }); 
          let ratinglink = encodeURIComponent(JSON.stringify(ratingsearch));
         
          location.href = "{{ url(app()->getLocale().'/reviews') }}?ratingsearch="+ratinglink;

          // $('div.review-box').removeClass('d-none');
          // $('div.review-box').addClass('d-flex');
        }
      });
    });
  </script>
@endsection
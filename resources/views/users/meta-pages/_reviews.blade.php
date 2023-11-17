@extends('user_layout.master')
@section('content')
<style>
  .review_head {
    display: flex;
    align-items: center;
    gap: 10px;
    padding-bottom: 14px;
  }

  img {
    max-width: 100%;
    height: auto;
  }

  .review_rate img {
    max-width: 130px;
    width: 100%;
    margin: auto;
  }

  .review_list {
    padding: 7px;
  }

  .review_box {
    max-width: 400px;
    width: 100%;
    padding: 24px;
    background: #fff;
    margin: 0px 0px 16px;
    border: 1px solid #e5e5dd;
    border-radius: 10px;
    transition: transform .25s, box-shadow .25s;
  }

  .review_box:hover {
    box-shadow: 0 12px 20px 0 rgba(0, 0, 50, .12);
    transform: scale(1.05);
  }

  .review_text p {
    margin: 0px;
    font-size: 14px;
  }

  .review_text h3 {
    font-size: 12px;
  }

  .review_text h3 a {
    color: #000;
  }

  .review_img img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    overflow: hidden;
  }

  .review_sec {
    background: #fcfbf3;
    padding: 100px 0px;
  }

  .review_slider {
    position: relative;
  }

  /* .review_slider:hover .review_slider {
      animation-play-state: paused;
    } */
</style>
<section class="blog-sec">
  <div class="container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="#">Reviews</a></li>
      </ol>
    </nav>

  </div>
</section>
<section class="slider-sec customer-logomax-sec recent-blog-sec">
  <div class="container">
    <div class="logomax-content">
      <h2>Why our customers love Logomax</h2>
      <p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and
        grow a brand they love.</p>
      <!-- <div class="logomax-img">
          <img src="{{-- asset('/logomax-front-asset/img/trustpilot.png') --}}" alt="">
        </div> -->
    </div>
  </div>
</section>
<!-- Review slider -->
<section class="review_sec">
  <div class="review_slider">
    <?php 
      $reviewCount = count($reviews);
      $count = 0;
      foreach($reviews as $ind => $review){
        $refreshCount = false;
    ?>
    <div class="review_list">
      <?php 
        $firstInd = $count + $count;
        if(isset($reviews[$firstInd])){
          $firstReview = $reviews[$firstInd];
        }else{
          $count = 0;
          $firstReview = $reviews[$count];
          $refreshCount = true;
        }
      ?>
      <div class="review_box">
        <div class="review_head">
          <div class="review_img">
            <img src="https://user-images.trustpilot.com/653dcb4dc334c7001279dc1c/64x64.png" alt="" />
          </div>
          <div class="review_rate">
            <img src="https://cdn.trustpilot.net/brand-assets/4.1.0/stars/stars-{{ $firstReview->rating }}.svg" alt="" />
          </div>
        </div>
        <div class="review_text">
          <h3><a href="#">{{ $firstReview->title ?? '' }}</a></h3>
          <p>
            {{ $firstReview->description ?? '' }}
          </p>
        </div>
      </div>
      <?php 
        $secondInd = $firstInd + 1;
        
        if(isset($reviews[$secondInd])){
          $secondReview = $reviews[$secondInd];
        }else{
          $count = 0;
          $secondReview = $reviews[$count];
          $refreshCount = true;
        }
      ?>
      <div class="review_box">
        <div class="review_head">
          <div class="review_img">
            <img src="https://user-images.trustpilot.com/653dcb4dc334c7001279dc1c/64x64.png" alt="" />
          </div>
          <div class="review_rate">
            <img src="https://cdn.trustpilot.net/brand-assets/4.1.0/stars/stars-{{ $secondReview->rating }}.svg" alt="" />
          </div>
        </div>
        <div class="review_text">
          <h3><a href="#">{{ $secondReview->title ?? '' }}</a></h3>
          <p>
            {{ $secondReview->description ?? '' }}
          </p>
        </div>
      </div>
    </div>
    <?php 
      if($refreshCount == true){
        $count = 0;
      }else{
        $count = $count + 1;
      }
    }
    ?>
  </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
  integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script>
  $(document).ready(function () {
    $(".review_slider").slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      dots: false,
      arrows: false,
      speed: 10000,
      autoplay: true,
      autoplaySpeed: 0,
      cssEase: "linear",
      slidesToShow: 5,
      slidesToScroll: 1,
      infinite: true,
      swipeToSlide: true,
      centerMode: true,
      focusOnSelect: true,
      pauseOnHover: true,
    });
  });
  $(".review_slider").on('mouseenter', function () {
    slider.slick('slickPause');
  });

  // Resume on mouse leave
  $(".review_slider").on('mouseleave', function () {
    slider.slick('slickPlay');
  });

</script>

@endsection
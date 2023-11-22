@extends('user_layout/master')
@section('content')
  <!-- ================= banner section start ====================== -->
<style>
  input.form-control.search-box::placeholder {
      font-size: 15px;
  }
</style>
<?php $home_banner = \App\Models\SiteMeta::where('meta_key','home-banner')->first();

?>
@if(isset($home_banner) && !empty($home_banner))
  @if(!empty($home_banner->meta_value))
  <section class="banner-sec banner-new-sec" style="background-image: url({{ asset('siteMeta') }}/{{ $home_banner->meta_value ?? '' }});">
  @else
  <section class="banner-sec banner-new-sec" style="background-image: url({{ asset('/logomax-front-asset/img/banner-img.png') }});">
  @endif
@else
  <section class="banner-sec banner-new-sec" style="background-image: url({{ asset('/logomax-front-asset/img/banner-img.png') }});">
@endif
    <div class="container-fluid">
      <div class="banner-content">
        <div class="Select-text">
          <div class="all-select">
            <div class="search">
           
              <input type="search" class="form-control search-box" placeholder="Search logo by branch or style">
            </div>
          </div>
          <div class="Search-bar">
            <button id="button-addon5" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <div class="trending-wrapper">
          <div class="trending-btn">
            <ul>
              <li class="simple"> Trending:</li>
            @if($tags->IsNotEmpty())
              @foreach ($tags as $t => $tag)
              @if($t < 6)
                <li>
                  <a class="design-btn" href="{{ url('logos/search?tags=%5B"'.$tag->slug.'"%5D') }}">{{ $tag->name ?? '' }}</a>
                </li>
              @endif
              @endforeach
            @endif
            
            </ul>
          </div>
        </div>
      </div>
      <div class="content-wrapper">
        <div class="logos-text">
          @foreach ($homeContent as $content)
          @if ($content->key == 'unique-logos-from-text')
            <?php echo $content->value; ?>
          @endif
          @endforeach
        </div>    
        <div class="try-btn">
          <a class="login-btn" href="{{ url('/logos/search') }}">Try Now</a>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= banner section end ====================== -->

  <!-- ================= templates section start ====================== -->

  <section class="templates-sec p-110">
    <div class="container">
      <div class="template-content">
        @foreach ($homeContent as $content)
            
        @if($content->key == 'professional-logos-title')
        <h2><?php echo $content->value ?></h2>
 
        @endif
        @if($content->key == 'professional-logos-text')
        <p><?php echo $content->value ?></p>

        @endif
        @endforeach
      </div>


  


      <div class="tab-wrapper">
        <div class="grid-wrapp">
        @if ($categories->IsNotEmpty())
          @foreach ($categories as $category)
            <div class="img__wrapper_boxs">
              <a href="{{ url('logos/search?categories=%5B"'.$category->slug.'"%5D') }}">
                <div class="img_logs">
                  <img src="{{ asset('category_images') }}/{{ $category->image ?? '' }}" alt="">
                </div>
                <div class="img__wrapper_boxs_text">
                  <h5>{{ $category->name }}</h5>
                </div>
              </a>
            </div>
          @endforeach
        @else
          <p>No categories found!</p>
        @endif

          <!-- <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs2.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 02</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs3.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 03</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs3.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 03</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs4.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 04</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs5.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 05</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs6.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 06</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs7.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 07</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs4.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 04</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs5.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 05</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs6.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 06</h5>
            </div>
          </div>
          <div class="img__wrapper_boxs">
            <div class="img_logs">
              <img src="{{ asset('logomax-front-asset/img/logs7.png') }}" alt="">

            </div>
            <div class="img__wrapper_boxs_text">
              <h5>Category Name 07</h5>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </section>

  <!-- ================= templates section end ====================== -->

  <!-- ================= join logo section start ====================== -->
@foreach ($homeContent as $content)
    @if($content->key == 'register-background-image')
<section class="join-logo-sec" style="background-image: url({{ asset('siteMeta') }}/{{ $content->value ?? '' }});">
  @endif
  @endforeach
    <div class="container">
      <div class="join-logo-text">
        <div class="download-text">
          <h6>
          @foreach ($homeContent as $content)
          @if($content->key == 'register-banner-title-desc')
          <?php echo $content->value; ?>
            @endif
            @endforeach
          </h6>
          <div class="quote-img"><img src="{{ asset('logomax-front-asset/img/Group.png') }}" alt=""></div>
            @foreach ($homeContent as $content)
            @if($content->key == 'register-banner-title-text-desc')
            
            <?php echo  ($content->value) ? $content->value :'' ; ?>
           
            @endif
            @endforeach
        </div>
        <div class="register-text">
          @foreach ($homeContent as $content)
          @if($content->key == 'registerbanner-title')
          <h6><?php echo $content->value ?></h6>
            @endif
            @endforeach
          <div class="join-btn">
            <a class="g-btn" href="{{ url('authorized/google') }}"><i class="fa-solid fa-g"></i>Register with <strong>Google</strong> </a>
          </div>
          <div class="join-btn">
            <a class="fb-btn" href="{{ url('authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i>Register with <strong>Facebook</strong>
            </a>
          </div>
          <div class="join-btn">
            <a class="email-btn" href="{{ url('/register') ?? '' }}"><i class="fa-solid fa-envelope"></i>Register by email</a>
          </div>
          <p>By creating an account, you're agreeing to our Terms and Conditions.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= join logo section start ====================== -->

  <!-- ================= Popular search section start ====================== -->


  <section class="popular-sec p-110">
    <div class="container">
      <div class="popular-text">
        <h2>Discover what's Trending</h2>
      </div>
      <div class="popular-btn-box">
        <div class="popular-btn">
          <ul>
            @if($tags->IsNotEmpty())
              @foreach ($tags as $t => $tag)
                <li class="{{ $t >= 10 ? 'tags-data d-none' : '' }}">
                  <a href="{{ url('logos/search?tags=%5B"'.$tag->slug.'"%5D') }}">{{ $tag->name ?? '' }}</a>
                </li>
              @endforeach
            @else
            <span>No tag found !</span>
            @endif
            <li class="show-more {{ count($tags) > 10 ? '' : 'd-none' }}">
              <a class="show-btn" data-for="showmore" href="#">Show More</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= Popular search section end ====================== -->

  <!-- ================= slider section start ====================== -->

  <section class="slider-sec">
    <div class="container">
      <div class="logomax-content">
        @foreach ($homeContent as $content)
        @if($content->key == 'customer-review-title')
        <h2><?php echo $content->value ?></h2>
        @endif
        @endforeach
        @foreach ($homeContent as $content)
        @if($content->key == 'customer-review-text')
        <p><?php echo $content->value ?></p>
          @endif
          @endforeach
        <div class="logomax-img">
          <!-- <img src="img/trustpilot.png" alt="">aakjdhfk -->
        </div>
      </div>
      @if($review->IsNotEmpty())
      <div class="slick-wrapper">
        <div class="slick-test">
        @foreach($review as $r)
          <div class="slider-box">
            <div class="slider-content">
              <p>
                {{ $r->description ?? '' }}
              </p>
            </div>
            <div class="choice_star">
              <h6> {{ $r->title ?? ''}} </h6>
              <div class="choice-text">
                <!-- <div class="slick-img">
                  <img src="{{-- asset('logomax-front-asset/img/review-images/stars-'.$r->rating.'.svg') --}}" alt="stars-{{-- $r->rating --}}" width="50%">
                </div> -->
                <!--  -->
                <div class="rating-str d-flex">
                  <div class="review-site-text">
                    <div class="str_rate ">
                      <?php 
                        switch ($r->rating) {
                          case 1:
                            echo '<span class="fullstar"></span><span class="blankstar"></span><span class="blankstar"></span><span class="blankstar"></span><span class="blankstar"></span>	';
                          break;

                          case 2:
                            echo '
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="blankstar"></span>
                            <span class="blankstar"></span>
                            <span class="blankstar"></span>	
                            ';
                          break;

                          case 3:
                            echo ' 
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="blankstar"></span>
                            <span class="blankstar"></span>	
                            ';
                          break;

                          case 4:
                            echo '
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="blankstar"></span>	
                            ';
                          break;

                          case 5 :
                            echo '<span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>
                            <span class="fullstar"></span>';
                          break;

                          default:
                          echo '<span class="fullstar"></span> <span class="fullstar"></span><span class="fullstar"></span><span class="fullstar"></span> <span class="fullstar"></span>';
                        }
                      ?>
                    </div>
                  </div>
                  <div class="opn-rt">
                    <a href="#">
                      <span class="text text-dark">{{ $r->rating }}.0</span>
                      <!-- <span style="text-decoration: underline;">1 opinion</span> -->
                    </a>
                  </div>
                </div>
                <!--  -->
              </div>
            </div>
          </div>
      @endforeach
        </div>
      </div>
      @endif
    </div>
  </section>

  <!-- ================= slider section end ====================== -->


<script>
  $(document).ready(function() {
      $('.show-btn').on('click', function(e) {
        e.preventDefault();
        var dataFor = $(this).attr('data-for');
        $('.tags-data').toggleClass('d-none');
        $(this).html(dataFor === 'showmore' ? 'Show Less' : 'Show More').attr('data-for', dataFor === 'showmore' ? 'showless' : 'showmore');
      });
  });
</script>
<script>
  $(document).ready(function(){
    $('#button-addon5').on('click',function(e){
      e.preventDefault();
      searchvalue = $('input[type="search"]').val();
      if(searchvalue == null || searchvalue == ""){
        return false;
      }
      console.log(searchvalue);
      url = '{{ url("/logos/search=") }}'+searchvalue;
    
      console.log(url);
    });
    
  });

</script>
  @endsection
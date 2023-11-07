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
@if(isset($home_banner))
  <section class="banner-sec" style="background-image: url({{ asset('siteMeta') }}/{{ $home_banner->meta_value ?? '' }});">
@else
  <section class="banner-sec" style="background-image: url({{ asset('/logomax-front-asset/img/banner-img.png') }});">
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
          <h5>Unique logos from
            <span>$149</span>
          </h5>
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
        <h2>Thousands of Professional Logo Templates</h2>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
          industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
          scrambled it to make a type specimen book.</p>
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

  <section class="join-logo-sec" style="background-image: url({{ asset('/logomax-front-asset/img/banner-img.png') }});">
    <div class="container">
      <div class="join-logo-text">
        <div class="download-text">
          <h6>What is <br>
            Lorem Ipsum?</h6>
          <p> <strong>Lorem Ipsum is simply</strong> dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of
            type and scrambled it.</p>
        </div>
        <div class="register-text">
          <h6>Register to download Logos
            from Logomax.</h6>
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
          <p>By clicking "Create Account" or registering using Facebook or
            Google, you agree to the Membership Agreement *</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= join logo section start ====================== -->

  <!-- ================= Popular search section start ====================== -->


  <section class="popular-sec p-110">
    <div class="container">
      <div class="popular-text">
        <h2>Popular search requests:</h2>
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
        <h2>Why our customers love Logomax</h2>
        <p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and
          grow a brand they love.</p>
        <div class="logomax-img">
          <img src="img/trustpilot.png" alt="">
        </div>
      </div>
      <div class="slick-wrapper">
        <div class="slick-test">
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
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
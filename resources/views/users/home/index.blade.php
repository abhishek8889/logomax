@extends('user_layout/master')
@section('content')
  <!-- ================= banner section start ====================== -->

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
              <input type="search" class="form-control search-box" id="search_val" placeholder="{{ __('file.placeholder_search_for_perfct_logo') }}">
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
              <li class="simple"> {{ __('file.trending_text') }}</li>
            @if($tags->IsNotEmpty())
              @foreach ($tags as $t => $tag)
              @if($t < 6)
                <li>
                  <a class="design-btn" href="{{ url(app()->getLocale().'/logos/search?search='.$tag->slug) }}">{{ $tag->name ?? '' }}</a>
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
          <a class="login-btn" href="{{ url(app()->getLocale().'/logos/search') }}">{{ __('file.browse_logo_text') }}</a>
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
        <?php echo $content->value ?>
        @endif
        @endforeach
      </div>
      <div class="tab-wrapper">
        <div class="grid-wrapp">
        @if ($categories->IsNotEmpty())
          @foreach ($categories as $category)
            <div class="img__wrapper_boxs">
              <a href="{{ url(app()->getLocale().'/logos/search?categories=%5B"'.$category->slug.'"%5D') }}">
                <div class="img_logs">
                  <img src="{{ asset('category_images') }}/{{ $category->image ?? '' }}" alt="">
                </div>
                <div class="img__wrapper_boxs_text">
                  <h5>{{ $category->name }}</h5>
                </div>
              </a>
            </div>
          @endforeach
        @endif
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
    <div class="container ">
      <div class="join-logo-text home-box">
        <!-- <div class="download-text">
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
        </div> -->
        <div class="register-text">
          @foreach ($homeContent as $content)
          @if($content->key == 'registerbanner-title')
          <h6><?php echo $content->value ?></h6>
            @endif
            @endforeach
          <div class="join-btn">
            <a class="g-btn" href="{{ url(app()->getLocale().'/authorized/google') }}"><i class="fa-solid fa-g"></i><?php echo __('file.register_with_google_text'); ?></a>
          </div>
          <div class="join-btn">
            <a class="fb-btn" href="{{ url(app()->getLocale().'/authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i><?php echo __('file.register_with_fb_text'); ?></a>
          </div>
          <div class="join-btn">
            <a class="email-btn" href="{{ url(app()->getLocale().'/register') ?? '' }}"><i class="fa-solid fa-envelope"></i><?php echo __('file.register_with_email'); ?></a>
          </div>
          <p>{{ __('file.agreeing_term_and_condition_text') }}</p>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= join logo section start ====================== -->

  <!-- ================= Popular search section start ====================== -->


  <section class="popular-sec p-110">
    <div class="container">
      <div class="popular-text">
        @foreach ($homeContent as $content)
        @if($content->key == 'discover-trending-title')
        <h2><?php echo $content->value ?></h2>
        @endif
        @endforeach
      </div>
      <div class="popular-btn-box">
        <div class="popular-btn">
          <ul>
            @if($tags->IsNotEmpty())
              @foreach ($tags as $t => $tag)
                <li class="{{ $t >= 10 ? 'tags-data d-none' : '' }}">
                  <a href="{{ url(app()->getLocale().'/logos/search?search='.$tag->slug) }}">{{ $tag->name ?? '' }}</a>
                </li>
              @endforeach
            @endif
            <li class="show-more {{ count($tags) > 10 ? '' : 'd-none' }}">
              <a class="show-btn" data-for="showmore" href="#">{{ __('file.tag_show_more_text') }}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- ================= Popular search section end ====================== -->

  <!-- ================= slider section start ====================== -->

  <section class="slider-sec p-110">
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
        <!-- $r->created_at -->
        <?php 
          $review_created_at = date('F j, Y', strtotime($r->created_at));
          $myTitle = $r->title;
          // $firstLetter = substr($myTitle, 0, 2);
          if(isset($r->user)){
            $name = $r->user->first_name.' '.$r->user->last_name;
            $span_text = substr(strtoupper($r->user->first_name), 0, 1).''.substr(strtoupper($r->user->last_name), 0, 1);
          }else{
            $name = $r->title;
            $span_text = substr(strtoupper($r->title), 0, 2);
          }

          // $color_codes = ['#543932','#535FAC','#5D8F33','#2E5E1B','#3E515A','#004439','#D76100','#AE1552'];
          $color_codes = ['#4cce5f'];
        ?>

          <div class="slider-box">
            <div class="slider-content ">
              <div class="review-head">
                <div class="img-box-head" style="background-color:{{ $color_codes[array_rand($color_codes)] }}">
                  {{ strtoupper($span_text) }}
                </div>
                <?php 
                $reviewtime = strtotime($r->created_at);
                $currentime = strtotime(date('m/d/Y h:i:s a', time()));
                $diffrence = abs($currentime - $reviewtime);
                $years = floor($diffrence / (365*60*60*24)); 
                $months = floor(($diffrence - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $hours = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                $minutes = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
                
                ?>
                <div class="title">
                  <h6> {{ $name ?? ''}} </h6>
                  <p>@if($years == 1) {{ $years }} year ago @elseif($years > 1) {{ $years }} years ago @elseif($months == 1) {{ $months }} month ago @elseif($months > 1) {{ $months }} months ago @elseif($days == 1) {{ $days }} day ago @elseif($days > 1) {{ $days }} days ago @elseif($hours == 1) {{ $hours }} hour ago @elseif($hours > 1) {{ $hours }} hours ago @elseif($minutes == 1) {{ $minutes }} minute ago @elseif($minutes > 1) {{ $minutes }} minutes ago @else Just Now @endif	</p>
                </div>
              </div>
              <div class="rating-star">
                <!-- rating -->
                <div class="choice_star">
                  <div class="choice-text">
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
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!--  -->
              </div>
              <div class="review-text">
                <p>{{ $r->description ?? '' }}</p>
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
        $(this).html(dataFor === 'showmore' ? '{{ __("file.tag_show_less_text") }}' : '{{ __("file.tag_show_more_text") }}').attr('data-for', dataFor === 'showmore' ? 'showless' : 'showmore');
      });
  });
</script>
<script>
    $('.Search-bar #button-addon5').on('click',function(e){
      e.preventDefault();
      searchvalue = $('#search_val').val();
      // if(searchvalue == null || searchvalue == ""){
      //   return false;
      // }
      url = '{{ url(app()->getLocale()."/logos/search?search=") }}'+searchvalue;
      window.location.href=url;
    });

</script>
  @endsection
@extends('user_layout/master')
@section('content')
<style>
.cus_tooltip {
  /* position: relative; */
  display: inline-block;
  line-height: 0px;
}
.new-ctx{
  position: relative;
}
.cus_tooltip .tooltiptext {
  visibility: hidden;
  background-color: #000;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px;
  position: absolute;
  z-index: 1;
  font-size: 12px;
  bottom: calc(100% + 6px);
  left: 0;
  right: 0;
  margin: auto;
  opacity: 0;
  transition: opacity 0.3s;
}

.cus_tooltip .tooltiptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #000 transparent transparent transparent;
}
.cus_tooltip a{
   color: #656F79;
   display: inline-block;
   font-size: 14px;
   line-height: normal;
}
/* .cus_tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
} */
.new-ctx:hover .tooltiptext{
  visibility: visible;
  opacity: 1;
}
.new-ctx:hover .cus_tooltip a{
  color: #fff;
}


button.swal2-cancel.swal2-styled.swal2-default-outline {
    color: #000 !important;
    background: #fff !important;
    border-radius: 130px;
    border: 1px solid #000000;
    padding: 10px 26px;
}

button.swal2-confirm.swal2-styled.swal2-default-outline {
    color: #fff !important;
    background: #000 !important;
    border-radius: 130px;
    border: 1px solid #000000;
    padding: 10px 26px;
    }

button.swal2-cancel.swal2-styled.swal2-default-outline:hover {
    background: #000 !important;
    color: #fff !important;
    transition: 0.5s;
}

button.swal2-confirm.swal2-styled.swal2-default-outline:hover {
    background: #fff !important;
    color: #000 !important;
    transition: 0.5s;
}


</style>
<section class="logo-detail-sec">
          <div class="container">
            <div class="brand-logo">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ url(app()->getLocale().'/logos/search') }}">Logos</a></li>
                      <li class="breadcrumb-item"><a > {{ $logo->logo_name ?? '' }}</a>
                      </li>
                  </ol>
              </nav>
            </div>
            <div class="logo_wrapper">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        @if(isset($logo->media['image_name']))
                        <div class="vita-img">
                            @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                @if(file_exists( public_path('LogoDirectory/' . $logo->media->directory_name . '/' . $logo->media->directory_name . '.png')))
                                    <img src="{{ asset('LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.png')  }}" alt="">
                                @else
                                    <img src="{{ asset('LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.jpg')  }}" alt="">
                                @endif
                            @else
                            <img src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                            @endif
                            @if($logo->logo_type == 'premium')  <div class="logo_type_div">{{ __('file.premium_banner_text') }}</div>@endif
                        </div>
                        @endif
                        <!-- start file box -->
                  <div class="file_box">
                    <div class="file_wrapper" id="copy_to_clipboard" logo_unique_id="{{ $logo->logo_unique_id }}">
                      <div
                        class=" new-ctx tip_btn button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                        <span class="copy-asset-id__icon__container container-relative">
                          <button class="copy-asset-id__icon js-copy-asset-id hover-trigger">
                            <i class="fa-solid fa-file"></i>
                          </button>
                        </span>
                        <!-- <a class="asset-id-link__button" href="#" id="tooltip-copy-box" data-toggle="tooltip" title="Copy to clipboard!">
                          <strong class="text-up">File :&nbsp;</strong>
                          <span>{{ $logo->logo_unique_id }}</span>
                        </a> -->
                        <div class = "cus_tooltip">
                        <a href="#" class = "tool_text"  logo_unique_id="{{ $logo->logo_unique_id }}"> 
                          <span class="tooltiptext" id ="myTooltip">{{ __('file.copy_to_clipboard_text') }}</span>
                          {{ $logo->logo_unique_id }}
                        </a>
                        </div>
                      </div>
                    </div>
                    <div class="file_wrapper" id="find-similar-btn">
                      <div class="new-ctx button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                        <span class="copy-asset-id__icon__container container-relative">
                            <button class="copy-asset-id__icon js-copy-asset-id hover-trigger">
                              <i class="fa-solid fa-camera"></i>
                            </button>
                        </span>
                        <a class="asset-id-link__button" href="#" title="Go to content details page">
                            <span>{{ __('file.find_similar_text') }}</span>
                        </a>
                      </div>
                    </div>
                    <?php 
                    $wishlistItem = '';
                    if(Auth::check()){
                      $wishlistItem = App\Models\Wishlist::class::where([['user_id','=',auth()->user()->id],['logo_id','=',$logo->id]])->first();
                    }
                    ?>
                    <div class="file_wrapper add_to_wishlist_button">
                      <div class="new-ctx button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                        <span class="copy-asset-id__icon__container container-relative">
                          <button class="copy-asset-id__icon js-copy-asset-id hover-trigger" id="favorite_box">
                              <!-- <i class="fa-regular fa-heart"></i> -->
                              <?php
                                  if(!empty($wishlistItem)){
                                    ?>
                                      <i class="fa-solid fa-heart"></i>
                               <?php }else{?>
                                <i class="fa-regular fa-heart"></i>
                                <?php } ?>
                          </button>
                        </span>
                        <a class="asset-id-link__button" href="#" 
                          title="Add to favorite list">
                          <span>{{ __('file.add_to_favorites_text') }}</span>
                        </a>
                      </div>
                    </div>
                  </div>
                  <!-- end  file_box-->
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="brand-text">
                            <h4>{{ $logo->logo_name ?? '' }}</h4>
                            <div class="template_content">
                                <div class="icon">
                                    <i class="fa-solid fa-file"></i>
                                </div>
                                <div class="">
                                    <p>AI, EPS, PDF, SVG, PNG, JPG, TIF</p>
                                </div>
                            </div>
                            <span class="badge">{{ $active_discount->translation->name ?? $active_discount->name }}</span>
                          <?php 
                          $total_price = round($price*$coversion_price);
                          if($logo->logo_type == 'low-price'){
                            $discount_price = $total_price * $active_discount->normal_logo_price/100;
                            $discount_percentage = $active_discount->normal_logo_price;
                          }else{
                            $discount_price = $total_price * $active_discount->premium_logo_price/100;
                            $discount_percentage = $active_discount->premium_logo_price;
                          }
                          $price = Akaunting\Money\Money::$currency($total_price,true);
                          $actual_price = $total_price - $discount_price;
                          $discount_price_format = Akaunting\Money\Money::$currency(round($actual_price),true);
                          
                          $decimal_value = $discount_price_format->getCurrency()->getDecimalMark().'00';

                          ?>
                           
                           
                            <div class="num ">
                              <h3>-{{ $discount_percentage ?? 0}} %</h3>
                              
                            <div class="num numr"><h2>{{ str_replace($decimal_value,"",$discount_price_format) ?? 0}}</h2>
                          <p><del> {{ str_replace($decimal_value,"",$price) ?? 0 }}</del></p>
                            </div></div>

                            <div class="dropdown_data">
                                <div id="accordion">
                                  <?php $first = true; ?>
                                  @foreach($logoFacilities as $ind =>  $facility)
                                  <div class="card @if($first == true) card_open @endif">
                                    <?php $first = false; ?>
                                      <div class="card-header pointer" data-toggle="collapse"
                                          data-target="#collapse-{{ $facility->id }}">
                                          <h5 class="text text-dark">{{ $facility->facilities_name ?? '' }}</h5>
                                      </div>
                                      <div id="collapse-{{ $facility->id }}" class="collapse <?php if($ind == 0){ echo "show";} ?>" data-parent="#accordion">
                                          <div class="card-body">
                                            {{ $facility->description ?? '' }}
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                </div>
                                <div class="cta-btn">
                                  @if($logo->status == 1)
                                  <a href="{{ url(app()->getLocale().'/logos/checkout/'.$logo->logo_slug) }}" class="now-btn">{{ __('file.buy_now_text') }}</a>
                                  @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="similar-logos p-110" id="similar-logo-box">
                @if($similar_logos->IsNotEmpty())
                    <div class="similar_text">
                        <h5>{{ __('file.similar_logos_text') }}</h5>
                    </div>
                @endif
                    <div class=" row">
                        @foreach($similar_logos as $ind => $similar)
                        <div class="col-md-3 col-sm-6 mb-4">
                            <div class="logo_img">
                              <a href="{{ url(app()->getLocale().'/logo/'.$similar->logo_slug) }}">
                              @if($similar->media->directory_name != null || $similar->media->directory_name != "")
                                    <img src="{{ asset('LogoDirectory/'.$similar->media->directory_name.'/'.$similar->media->directory_name.'.png') }}" alt="">
                              @else
                                <img src="{{ asset('logos/'.$similar->media['image_name']) }}" alt="">
                              @endif
                                @if($similar->logo_type == 'premium')  <div class="logo_type_div">{{ __('file.premium_banner_text') }}</div>@endif
                              </a>
                            </div>
                        </div>
                        @if($ind == 2)
                          <div class="col-md-3 col-sm-6 mb-4">
                            <a href="{{ url(app()->getLocale().'/logos/search?categories='.urlencode(json_encode($category_slug))) }}">
                              <div class=" logo_img white logo-img-simi">
                                  <img src="{{ asset('logomax-front-asset/img/see-more.svg') }}" alt="">
                              </div>
                            </a>
                          </div>
                          @break;
                        @endif
                        @endforeach
                    </div>

                </div>
            </div>
                 
    </section>
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
      </div>
      @if($review->IsNotEmpty())
      <div class="slick-wrapper">
        <div class="slick-test">
        @foreach($review as $r)
        <!-- $r->created_at -->
        <?php 
          $review_created_at = date('F j, Y', strtotime($r->created_at));
          $myTitle = $r->title;
          $firstLetter = substr($myTitle, 0, 2);

                $reviewtime = strtotime($r->created_at);
                $currentime = strtotime(date('m/d/Y h:i:s a', time()));
                $diffrence = abs($currentime - $reviewtime);
                $years = floor($diffrence / (365*60*60*24)); 
                $months = floor(($diffrence - $years * 365*60*60*24) / (30*60*60*24));
                $days = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $hours = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
                $minutes = floor(($diffrence - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);
          // $color_codes = ['#543932','#535FAC','#5D8F33','#2E5E1B','#3E515A','#004439','#D76100','#AE1552'];
          $color_codes = ['#4cce5f'];
        ?>

          <div class="slider-box">
            <div class="slider-content ">
              <div class="review-head">
                <div class="img-box-head" style="background-color:{{ $color_codes[array_rand($color_codes)] }};">
                  {{ strtoupper($firstLetter) }}
                </div>
                <div class="title">
                  <h6> {{ $r->title ?? ''}} </h6>
                  <p>@if($years == 1) {{ $years }} year ago @elseif($years > 1) {{ $years }} years ago @elseif($months == 1) {{ $months }} month ago @elseif($months > 1) {{ $months }} months ago @elseif($days == 1) {{ $days }} day ago @elseif($days > 1) {{ $days }} days ago @elseif($hours == 1) {{ $hours }} hour ago @elseif($hours > 1) {{ $hours }} hours ago @elseif($minutes == 1) {{ $minutes }} minute ago @elseif($minutes > 1) {{ $minutes }} minutes ago @else Just Now @endif</p>
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

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).on('click','.add_to_wishlist_button',function(e){
        e.preventDefault();
        @if(Auth::check())
            let logo_id = "{{ $logo->id }}";
            let user_id = "{{ auth()->user()->id }}";
            let url = "{{ url('/add-to-wishlist') }}";
            let objId = 'logo_wish_'+logo_id;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
              method: 'POST',
              url: url,
              data: { 
                logo_id:logo_id,
                user_id:user_id,
                _token:csrfToken,
              },
              success: function(data, status, xhr){
                let thisObj = $("#favorite_box");
                if(xhr.status == 204){
                  thisObj.html('<i class="fa-regular fa-heart"></i>');                              
                }
                if(xhr.status == 201){
                  thisObj.html('<i class="fa-solid fa-heart"></i>');
                }
              }
            });
        @else
        Swal.fire({
                title: '{{ __("file.please_log_in_text") }}',
                text: "{{ __('file.you_have_to_log_in_text') }}",
                // icon: 'info',
                showCancelButton: true,
                showCloseButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{ __("file.log_in_text") }}',
                confirmButtonText: '{{ __("file.sign_up_text") }}',
                reverseButtons:true,
                customClass: {
                    popup: 'swal_custom_class', // Add your custom class for additional styling
                },
                }).then((result) => {
                    console.log(result);
                if (result.isConfirmed) {
                    location.href="{{ url(app()->getLocale().'/login') }}";
                }else if(result.dismiss == "cancel"){
                    location.href="{{ url(app()->getLocale().'/register') }}";
                }
            })
        @endif
    });


    $("#find-similar-btn").on('click',function(e){
      e.preventDefault();
      console.log('helo');
      let categoryName = <?php echo json_encode($category_slug); ?>;
      window.location.href="{{ url(app()->getLocale().'/logos/search') }}?categories=" + encodeURIComponent(JSON.stringify(categoryName));
    });

    // $("#copy_to_clipboard").on('click',function(e){
    //   e.preventDefault();
    //   let copy_text = $(this).attr('logo_unique_id');
    //   navigator.clipboard.writeText(copy_text);
    //   var tooltip = $("#tooltip-copy-box");
    //   tooltip.attr('data-original-title',`Copied : ${copy_text}`);
    // })
    
    // $(document).ready(function(){
    //   $('[data-toggle="tooltip"]').tooltip();   
    // });

    // var tooltip = document.querySelector("#myTooltip")
    // var element = document.querySelector(".tool_text")
    // var tooltext = element.getAttribute('logo_unique_id');
    // var tipbtn = document.querySelector(".tip_btn")
    // tooltip.innerHTML = "Copy to clipboard !";
    //  navigator.clipboard.writeText(tooltext)  
    //   tipbtn.addEventListener("click", function(e){
    //     e.preventDefault()
    //     tooltip.innerHTML = "Copied";
    //   })
    $('#myTooltip').html('Copy to clipboard !');
    $('.tip_btn').on('click',function(e){
      e.preventDefault();
      tooltip = $('#myTooltip');
      element = $('.tool_text');
      tooltext = element.attr('logo_unique_id');
      navigator.clipboard.writeText(tooltext);  
      tooltip.html('{{ __("file.copied_text") }}');
    })
 </script>
@endsection
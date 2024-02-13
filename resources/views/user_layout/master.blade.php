<!DOCTYPE html>
<html lang="en-{{ $userIPDetails['countryCode'] }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- ICON -->
  <link rel="icon" href="{{ asset('Logomax-Favicon/favicon.ico') ?? '' }}" type="image/x-icon">
  <!-- Icon - end -->
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
  {{-- Bootstrap files --}}
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  
  <link rel='stylesheet'  href="{{asset('/logomax-front-asset/css/dashicons.min.css?'.time() ) }}" media='all' />
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/style.css?'.time())}}">
  <!-- <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/filter.css')}}"> -->
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/blog1.css?'.time())}}">
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/custom.css?'.time())}}">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
 

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->
  <!-- meta for fb : -->
  <meta property="og:url" content="{{ url()->current() ?? '' }}" />
  <meta property="og:type" content="article" />
  @if (isset($blog) && isset($blog->title))
  <meta property="og:image" content="{{ $blog->title ?? '' }}" />
  @endif
  @if (isset($blog) && isset($blog->sub_title))
  <meta property="og:image" content="{{ $blog->sub_title ?? '' }}" />
  @endif
  @if (isset($blog) && isset($blog->banner_img))
  <meta property="og:image" content="{{ asset('blog_images/' . $blog->banner_img) }}" />
  @endif
  @if(isset($meta_description))
  <?php  print_r($meta_description); ?>
  @endif
  @if(isset($meta_country))
  <?php print_r($meta_country);  ?>
  @endif


  <!-- end meta fb -->
  <title>{{ $meta_title ?? 'Logomax' }} </title>
</head>

<body>
  <style>
    .spinner-container {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background-color: rgba(0, 0, 0, 0.5);
  display: none;
}

.spinner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  border: 5px solid #f3f3f3;
  border-top: 5px solid #3498db;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
}
.nav-link i {
    color: black;
}
input[type="search"]::-webkit-search-cancel-button {
  display: none;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
  </style>
<div class="spinner-container">
  <div class="spinner"></div>
</div>
  <div class="site"></div>
  <!-- ================= header section start ====================== -->
  <?php 
  $siteMeta = App\Models\SiteMeta::all();

  $homePageSiteLogo =  asset('logomax-front-asset/img/logomax-logo-white.svg'); 
  $otherPageSiteLogo =    asset('logomax-front-asset/img/logomax-logo-colored.svg');
  $footer_logo = asset('logomax-front-asset/img/logomax-logo-white.svg');

  foreach($siteMeta as $metaData){
    if($metaData->meta_key == 'home-page-site-logo'){
      if(!empty($metaData->meta_value)){
        $homePageSiteLogo = asset('/siteMeta/'.$metaData->meta_value); 
      }
    }
    if($metaData->meta_key == 'other-pages-site-logo'){
      if(!empty($metaData->meta_value)){
        $otherPageSiteLogo = asset('/siteMeta/'.$metaData->meta_value);
      }
    }
    if($metaData->meta_key == 'footer-logo'){
      if(!empty($metaData->meta_value)){
        $footer_logo = asset('/siteMeta/'.$metaData->meta_value);
      }
    }
  }
  if(isset(auth()->user()->id) ){
    $user_fname = auth()->user()->first_name; 
    $user_lname = auth()->user()->last_name;
    $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 1));
    $last_name_frstChar = strtoupper(mb_substr($user_lname, 0, 1));
    if(empty($last_name_frstChar)){
        $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 2));
    }
    $user_shorter_name = $first_name_frstChar.$last_name_frstChar;
  }
?>

  <header class="header <?php if(isset($request)){
    if($request->url() != url(app()->getLocale().'/')){ if(isset(auth()->user()->id)){ echo "logged_in_header";}
    echo " custom-header "; 
    }}  ?>">
    <div class="top-header <?php if($request->segment(3) == 'checkout'){ echo 'd-none'; } ?> <?php if(isset($request)){if($request->url() == url(app()->getLocale().'/')){ echo " home-page-se"; }} ?>">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-md">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="ham">
              <div class="bars bar1"></div>
              <div class="bars bar2"></div>
              <div class="bars bar3"></div>
            </div>
          </button>
          <?php 
          
            $categories = App\Models\Categories::with(['translation'=> function($query){
                $query->where('lang_code',app()->getLocale());
            }])->orderBy('name','ASC')->get();
            
            $styles = App\Models\Style::with(['translation'=> function($query){
                $query->where('lang_code',app()->getLocale());
            }])->where('status',1)->orderBy('name','ASC')->get();

            $branches = App\Models\Branch::with(['translation'=> function($query){
                $query->where('lang_code',app()->getLocale());
            }])->where('status',1)->orderBy('name','ASC')->get();
            // foreach($categories as $cat){
            //   echo $cat->translation;
            // }
          ?>
           
          <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ __('file.logomark_text') }}
                </a>
                <span class="cus-drop"><i class="fa-thin fa-angle-down"></i></span>
                <div class="custom-dropdown-menu" aria-labelledby="navbarDropdown">
                  @if($styles->isNotEmpty())
                  @foreach($styles as $ind => $style)
                  <a class="dropdown-item" href="{{ url(app()->getLocale().'/logos/search?styles=%5B"'.$style->slug.'"%5D') }}">
                   
                        {{ $style->translation->name ?? $style->name }}
                  </a>
                  @endforeach
                  @endif
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ __('file.style_text') }}
                </a>
                <span class="cus-drop"><i class="fa-thin fa-angle-down"></i></span>
                <div class="custom-dropdown-menu" aria-labelledby="navbarDropdown">
                  @if($categories->isNotEmpty())
                    @foreach($categories as $ind => $cat)
                      <a class="dropdown-item" href="{{ url(app()->getLocale().'/logos/search?categories=%5B"'.$cat->slug.'"%5D') }}">
                        {{ $cat->translation->name ?? $cat->name }}
                      </a>
                    @endforeach
                  @endif
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{ __('file.branch_text') }}
                </a>
                <span class="cus-drop"><i class="fa-thin fa-angle-down"></i></span>
                <div class="custom-dropdown-menu" aria-labelledby="navbarDropdown">
                  @if($branches->isNotEmpty())
                  @foreach($branches as $ind => $branch)
                  <a class="dropdown-item" href="{{ url(app()->getLocale().'/logos/search?branches=%5B"'.$branch->slug.'"%5D') }}">
                      {{ $branch->translation->name ?? $branch->name }}
                  </a>
                  @endforeach
                  @endif
                </div>
              </li>
            </ul>
            <div class="side-menu">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('reviews',app()->getLocale()) }}">{{ __('file.reviews_text') }}</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('blogs',app()->getLocale()) }}">{{ __('file.blog_text') }}</a>
                </li>
              </ul>
            </div>
            <!-- Dashboard and login btn  -->
            @if(Auth::user())
              <!-- <div class="header-btn mr-1">
            </div> -->
            <div class="header-btn in-mobile">
              <!-- Dashboard after login icon  -->
              <a class="login-btn cta-btn" href="{{ url(app()->getLocale().'/user-dashboard') }}">{{ __('file.dashboard_text') }}</a>
              <a class="login-btn cta-register" href="{{ url('/logout') }}">{{ __('file.log_out_text') }}</a>
            </div>
            @else
            <div class="header-btn in-mobile">
              <a class="login-btn cta-btn" href="{{ url(app()->getLocale().'/login') }}">{{ __('file.log_in_text') }}</a>
              <a class="login-btn cta-register" href="{{ url(app()->getLocale().'/register') }}">{{ __('file.sign_up_text') }}</a>
            </div>
            @endif
            <!--  -->
          </div>
        </nav>
      </div>
    </div>
    @if(isset($checkout_page))
    <div class="main-header">
      @else
      <div class="main-header <?php if(isset($request)){if($request->url() != url(app()->getLocale().'/')){ echo " sticky-header"; }} ?>">
        @endif
        <div class="container-fluid">
          <div class="navbar navbar-expand-lg">
            <div class="logo">
              <a href="{{ url(app()->getLocale().'/') ?? '' }}">
                <?php if(isset($request)){
                      if($request->url() != url(app()->getLocale().'/')){?>
                <img src="{{ $otherPageSiteLogo}}" alt="" />
                <?php }else{?>
                <img src="{{ $homePageSiteLogo }}" alt="" />
                <?php }} ?>
              </a>
            </div>
            <?php if(isset($request)){
                      if($request->url() != url(app()->getLocale().'/')){?>
            <div class="banner-content <?php if($request->segment(3) == 'checkout'){ echo 'd-none'; } ?>">
              <div class="Select-text">
                <div class="all-select">
                  <div class="search">
                    <input type="search" name="search_field" class="form-control" value="{{ $request->search ?? '' }}"
                      placeholder="{{ __('file.placeholder_search_for_perfct_logo') }}">
                  </div>
                </div>
                <div class="Search-bar">
                  <button id="button-addon5" type="submit">
                    <i class="fa fa-search"></i>
                  </button>
                </div>
              </div>
            </div>
            <?php } }?>

            @if(Auth::user())
            <!-- <div class="header-btn mr-1">
          </div> -->
            <div class="header-btn in-desktop">
              <!-- Dashboard in desktop after login icon  -->
              <?php 
              
              if(isset($request)){
                if($request->url() != url(app()->getLocale().'/')){
                  // dd('hello');
              ?>
              <!-- Notify Icons Start -->

              <div class="notify-icons">
                <ul class="navbar-nav">
                  <!--  -->
                  <li class="nav-item align-content-center mobile">
                    <a class="nav-link"  id="dropdownMenuButton4" data-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-search"></i>
                    </a>
                  </li>
                  <li class="nav-item align-content-center notification">
                    <a class="nav-link niks-nav-li" href="#" id="dropdownMenuButton2" data-toggle="dropdown" aria-expanded="false">
                      <i class="fas fa-bell"></i>
                      <span class="badge custom-badge badge-success">6</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                      <div class="notify">
                        <div class="dropdown-head"><span class="sub-title nk-dropdown-title">Notifications</span><a
                            href="#">Mark All as Read</a></div>
                        <div class="dropdown-body">
                          <div class="nk-notification">
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                              <div class="icon">
                                <i class="fas fa-arrow-left"></i>
                                </div>
                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                                <div class="icon">
                                <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                              <div class="icon">
                                <i class="fas fa-arrow-left"></i>
                                </div>
                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                              <div class="icon">
                                <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                              <div class="icon">
                                <i class="fas fa-arrow-left"></i>
                                </div>
                                <div class="nk-notification-text">You have requested to <span>Widthdrawl</span></div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                            <div class="nk-notification-item dropdown-inner">
                              <div class="nk-notification-content">
                              <div class="icon">
                                <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="nk-notification-text">Your <span>Deposit Order</span> is placed</div>
                                <div class="nk-notification-time">2 hrs ago</div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="dropdown-foot center"><a href="#">View All</a></div>
                      </div>
                    </div>
                  </li>
                  <li class="nav-item align-content-center message">
                    <a class="nav-link niks-nav-li" href="#" id="dropdownMenuButton3" data-toggle="" aria-expanded="false">
                      <i class="fas fa-envelope"></i>
                      <span class="badge custom-badge badge-success" id="totalMessages27">0</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton3">
                      <a class="dropdown-item" href="https://logomax.com/logout">messages</a>
                    </div>
                  </li>
                  <!--  -->
                  <!-- <li class="nav-item align-content-center">
                                  <a class="nav-link" href="#">
                                      <i class="fas fa-bell"></i> 
                                      <span class="badge custom-badge badge-success">6</span>
                                  </a>
                              </li>
                              <li class="nav-item align-content-center">
                                  <a class="nav-link" href="#">
                                      <i class="fas fa-envelope"></i>
                                      <span class="badge custom-badge badge-success" id="totalMessages27">0</span> 
                                  </a>
                              </li> -->
                  <li class="nav-item profile">
                    <div id="dropdownMenuButton1" class="niks-nav-li" data-toggle="" aria-expanded="false">
                      {{ $user_shorter_name ?? '' }}
                    </div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1"
                      style="margin-right: 20px">
                      <a class="dropdown-item" href="{{ url(app()->getLocale().'/user-dashboard') }}">{{ __('file.dashboard_text') }}</a>

                      <a class="dropdown-item" href="{{ url(app()->getLocale().'/user-dashboard/configuration') }}">Configuration</a>
                      <a class="dropdown-item" href="{{ url(app()->getLocale().'/user-dashboard/subscriptions') }}">Subscription</a>

                      <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- Notify Icons End  -->
              <?php }else{?>
                <a class="login-btn cta-btn" href="{{ url(app()->getLocale().'/user-dashboard') }}">{{ __('file.dashboard_text') }}</a> 
                <a class="login-btn cta-register" href="{{ url('/logout') }}">{{ __('file.log_out_text') }}</a>
              <?php } } ?>
              </div>
            @else
            <div class="header-btn in-desktop">
              <a class="login-btn cta-btn" href="{{ url(app()->getLocale().'/login') }}">{{ __('file.log_in_text') }}</a>
              <a class="login-btn cta-register" href="{{ url(app()->getLocale().'/register') }}">{{ __('file.sign_up_text') }}</a>
            </div>
            @endif
          </div>
        </div>
      </div>
      <div class="search-bar-mobile" id="search-input" style="display:none;">
        <div class="banner-content new">
          <div class="Select-text">
            <div class="all-select">
              <div class="search">
                <input type="search" name="search_field" class="form-control" value="{{ $request->search ?? '' }}"
                  placeholder="{{ __('file.placeholder_search_for_perfct_logo') }}" />
              </div>
            </div>
            <div class="Search-bar">
              <button id="button-addon5" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
  </header>

  <!-- ================= header section end ====================== -->

  @yield('content')

  <!-- ================= footer section start ====================== -->

  <footer>
    <div class="top-footer p-110">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-6">
            <div class="footer-text">
              <div class="footer-logo">
                <img src="{{ $footer_logo }}" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="business-text social-media-text">
              <h6>{{ __('file.our_company_text') }}</h6>
              <ul>
                <li> <a href="{{ url(app()->getLocale().'/designer-register') }}">{{ __('file.sell_your_logos_text') }}</a></li> <!-- Register designer path  -->
                <li> <a href="{{ url(app()->getLocale().'/about-us') }}">{{ __('file.about_us_text') }}</a></li>
                <li> <a href="{{ url(app()->getLocale().'/blogs') }}">{{ __('file.blog_footer_text') }} </a></li>
                <li> <a href="{{ url(app()->getLocale().'/affiliate') }}">{{ __('file.affiliates_text') }}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="business-text social-media-text">
              <h6>{{ __('file.legal_text') }}</h6>
              <ul>
                <li> <a href="{{ url(app()->getLocale().'/legal/terms-and-conditions') }}">{{ __('file.terms_and_conditions_text') }}</a></li>
                <li> <a href="{{ url(app()->getLocale().'/legal/privacy-policy') }}">{{ __('file.privacy_policy_text') }}</a></li>
                <li> <a href="{{ url(app()->getLocale().'/legal/cookie-policy') }}">{{ __('file.cookie_policy_text') }}</a></li>
                <!-- <li> <a href="#">{{ __('file.cookies_setings_text') }}</a></li> -->
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="business-text social-media-text">
              <h6>{{ __('file.contact_us_text') }}</h6>
              <ul>
               
             
                <li> <a href="{{ url(app()->getLocale().'/faq') }}">{{ __('file.questions_and_answers_text') }}</a></li>
                <li> <a href="{{ url(app()->getLocale().'/support') }}">{{ __('file.support_text') }}</a></li>
                <li> <a href="{{ url(app()->getLocale().'/reviews') }}">{{ __('file.reviews_footer_text') }}</a></li>
      
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="site-footer-wrapper">
      <div class="container">
        <div class = "site-footer d-flex justify-content-between">
        <div class="Copyright-text">
          <p>{{ __('file.footer_copy_right_text') }}</p>
        </div>
        <?php 
        // $languages = ['en-au'=>'Australia-English' ,'es-ar' =>'Argenina-Español' , 'en-ca'=>'Canada-English' , 'es-ch'=>'Chile-Español' ,'es-co'=>'Colombia-Español' , 'de-de'=>'Deutschland-Deutsch' , 'es-es'=>'España-Español' , 'es-esu'=>'Estados Unidos-Español' , 'en-hok'=>'Hong Kong-English' , 'en-in'=>'India-English' , 'en-ir'=>'Ireland-English' , 'en-is'=>'Israel-English' , 'en-ma'=>'Malaysia-English', 'es-me'=>'México-Español' , 'en-nez'=>'New Zealand-English' ,'de-os'=>'Österreich-Deutsch' ,'en-pak'=>'Pakistan-English' , 'es-pe'=>'Perú-Español' ,'en-ph'=>'Philippines-English' ,'de-sc'=>'Schweiz-Deutsch' , 'en-sin'=>'Singapore-English' , 'en-sa'=>'South Africa-English' , 'en-uae'=>'United Arab  Emirates-English' ,' en-uk'=>'United Kingdom-English' , 'en-us'=>'United States-English' ,' es-ven'=>'Venezuela-Español' ];
        $currencies = ['USD','AED','AUD','CAD','CHF','CLP','COP','EUR','GBP','HKD','ILS','INR','MYR','MXN','NZD','PEN','PHP','PKR','SGD','ZAR'];
        // echo app()->getLocale();
        if(app()->getLocale()){
        $current_language = app()->getLocale();
        }else{
          $current_language = 'en-us';
        }
        ?>
        <div class="d-flex">
        <div class="cus_dropdown">
          <button class="btn btn-secondary dropdown-toggle">
          <?php 
            $lang_count = 0;
          ?>
        {{ $siteLanguagesList[$current_language] ?? '' }}
          <span class="cus-drop"><i class="fa-thin fa-angle-down"></i></span>
          </button>
          <div class="cus_dropdown_menu">
            <div class ="container">
              <h2>Choose your Country/Region</h2>
            <div class = "cus_m_wrapper">
              <?php $first = true; ?>
            @foreach($siteLanguagesList as $key=>$value) 
            <a class="cus_dropdown-item @if($key == app()->getLocale()) selected @endif" href="{{ url('changelagnuage/'.$key) }}">{{ $value ?? '' }}</a>
            <?php $first = false; ?>
            @endforeach
            </div>
            </div>
          </div>
        </div>
        <?php  
        if($request->session()->get('currency')){
          $Currentcurrency = $request->session()->get('currency');
        }else{
          $Currentcurrency = 'USD';
        }
        
        
        ?>
        <div class="cus_dropdown price_cust">
          <button class="btn btn-secondary dropdown-toggle">
          {{ $Currentcurrency ?? 'USD' }}
          <span class="cus-drop"><i class="fa-thin fa-angle-down"></i></span>
          </button>
          <div class="cus_dropdown_menu">
            
            <div class = "cus_m_wrapper">
            <?php $first = true; ?>
            @foreach($currencies as $currency)
            
            <a class="cus_dropdown-item @if($Currentcurrency == $currency) selected @endif" href="{{ url('changeCurrency/'.$currency) }}">{{ $currency ?? '' }}</a>
            
            @endforeach
            </div>
          </div>
        </div>
        </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Show more filter option modal  -->
  <div class="modal fade" id="show_more_modal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog show_more_modal_box  modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text text-dark" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

        </div>
        <!-- <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
        </div> -->
      </div>
    </div>
  </div>
  <!--  -->
  <script>
    $(document).ready(function () {
      var w = window.innerWidth;
      // console.log(w);
      if(w > 767){
        $('.niks-nav-li').attr('data-toggle','');
      }else{
        $('.niks-nav-li').attr('data-toggle','dropdown');
      }
    });
    
    $(document).ready(function () {

      $('#button-addon5').click(function () {
        val = $('input[type="search"]').val();
        var currentUrl = window.location.href;
        var localeVal = "<?php echo app()->getLocale(); ?>";
        var position = currentUrl.indexOf(localeVal);

        // Extract the substring up to and including "lang-code"
        var extractedUrl = (position !== -1) ? currentUrl.substring(0, position + localeVal.length) : currentUrl;

        // console.log(result);
        // console.log(currentUrl);
        
        url = extractedUrl +"/logos/search?search="+val;
        location.href = url;
      });
    })
    
  </script>
  <!-- <script>
    $(document).ready(function () {
        $('a').on('click', function (event) {
            event.preventDefault();
            var href = $(this).attr('href');

            var segments = href.split('/');
            var lan = "{{ app()->getLocale() ?? 'en' }}";

            if (segments.length < 4 || (segments[3] !== 'en' && segments[3] !== 'fr')) {
                currentUrl = href.replace(/(http:\/\/[^\/]+\/)/, '$1' + lan + '/');
                window.location.href = currentUrl;
            } else {
                window.location.href = href;
            }
        });
    });
</script> -->


  <!-- ================= footer section start ====================== -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"  crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
  <script src="{{ asset('logomax-front-asset/js/script.js?'.time()) }}"></script>

  <script>
    $(document).ready(function(){
      $(".dropdown-toggle").click(function(){
        $(this).toggleClass("toggle_show");
        $(this).parent().siblings().children().removeClass("toggle_show");
        $(".site").addClass("over");
      });
    
      $(".cus_dropdown-item, .cus_dropdown_menu").click(function(e){
        e.stopPropagation();
        // e.preventDefault();
        // if ($(this).hasClass("cus_dropdown-item")) {
          $(this).addClass("selected").siblings().removeClass("selected");
        // }
      });

      $(document).click(function(e){
        var drop = $(".dropdown-toggle");
        if(!drop.is(e.target) && drop.has(e.target).length === 0){
          drop.removeClass("toggle_show");
        }
      });
    });
 
    /////////////////// Show More Button code  //////////////////////
    
    $(document).on('click', '.show_more_btn', function (e) {
      e.preventDefault();
      let thisObj = $(this);
      let dataType = thisObj.attr('type');
      let modal = $("#show_more_modal").modal();
      let modalHeading = $("#show_more_modal .modal-title");
      let modalBody = $("#show_more_modal .modal-body");
      modalBody.html('');

      modalHeading.html(`Search by ${dataType}`);
      let dataToShow = '';
      let letterCat = {};
      if (dataType == 'categories') {
        let categoriesData = <?php echo  json_encode($categories);  ?>;
        dataToShow = categoriesData;
      }
      if (dataType == 'styles') {
        let stylesData = <?php echo  json_encode($styles);  ?>;
        // console.log(stylesData);
        dataToShow = stylesData;
      }
      if (dataType == 'branches') {
        let branchData = <?php echo  json_encode($branches);  ?>;
        // console.log(stylesData);
        dataToShow = branchData;
      }
      $.each(dataToShow, function (ind, val) {
        let firstLetter = val.name.charAt(0).toUpperCase();
        if (!letterCat[firstLetter]) {
          letterCat[firstLetter] = [];
          letterCat[firstLetter].push(val);
        } else {
          letterCat[firstLetter].push(val);
        }
      });
      // console.log(letterCat);
      $.each(letterCat, function (ind, val) {
        var newElement = $("<div>");
        newElement.addClass('lett-cat-box');
        newElement.append(`<div class="cat-head"> ${ind} </div>`);
        var newElementCatData = $("<div>");
        newElementCatData.addClass('cat-wrapper');
        $.each(val, function (key, value) {
          newElementCatData.append(`<div class="cat-data"><a href="" type="${dataType}" slug="${value.slug}" >${value.name}</a></div>`);
        });
        newElement.append(newElementCatData);
        modalBody.append(newElement);
      });
      modal.show();
    });

    $(document).on('click', '.cat-data a', function (e) {
      e.preventDefault();
      let thisObj = $(this);
      let thisType = thisObj.attr('type');
      let thisSlug = thisObj.attr('slug');


      let categoriesString = [];
      let stylestring = [];
      let tagsstring = [];
      let branchString = [];
      let stateObj = { id: "100" };
      let categories = [];
      let styles = [];
      let tags = [];
      let searchvalue = [];
      let search_slug = '';

      // console.log(thisSlug);

      if (thisType == 'categories') {
        categoriesString.push(thisSlug);
        // categories = categoriesString;
        search_slug = encodeURIComponent(JSON.stringify(categoriesString));
      }
      if (thisType == 'styles') {
        stylestring.push(thisSlug);
        // styles = stylestring;
        search_slug = encodeURIComponent(JSON.stringify(stylestring));
      }

      if (thisType == 'tags') {
        tagsstring.push(thisSlug);
        // tags = tagsstring;
        search_slug = encodeURIComponent(JSON.stringify(tagsstring));
      }
      if (thisType == 'branches') {
        branchString.push(thisSlug);
        // branch = branchString;
        search_slug = encodeURIComponent(JSON.stringify(branchString));
      }

      window.location.href = "{{ url('/logos/search') }}?" + thisType + "=" + search_slug;

    })

    $(document).ready(function () {
      $("#dropdownMenuButton4").click(function () {
        var currentDisplay = $("#search-input").css("display");
        $("#search-input").css("display", currentDisplay === "none" ? "block" : "none");
        $("#dropdownMenuButton4").html(currentDisplay === "none" ? '<i class="fas fa-times"></i>' : '<i class="fas fa-search"></i>');
      });
    });
    //////////////// Show more button code end //////////////
  </script>
  <!-- facebook code : -->
  <!-- show login model on email or password error -->
  @if ($errors->has('email') || $errors->has('password') || $errors->has('name') || $errors->has('experience') ||
  $errors->has('country') || $errors->has('address') || $errors->has('g-recaptcha-response'))
  <script>
    console.log('error-accoured');
    $('#exampleModal').modal('show');
  </script>
  @endif
  @if ($errors->has('login_email') || $errors->has('login_password'))
  <script>
    $('#exampleloginModal').modal('show');
  </script>
  @endif
  <!-- end open login model code : -->
  <!-- session error -->
  @if(Session::get('error'))
  <script>
    iziToast.error({
      message: "{{ Session::get('error') }}",
      position: 'topRight'
    });
  </script>
  @endif
  @if(Session::get('success'))
  <script>
    iziToast.success({
      message: "{{ Session::get('success') }}",
      position: 'topRight'
    });
  </script>
  @endif
  <script>
    $(document).ready(function(){
      $(".nav-item .cus-drop").click(function(){
        $(this).next(".custom-dropdown-menu").slideToggle('slow');
      });
    });
  </script>
  <!-- session error end : -->
</body>

</html>
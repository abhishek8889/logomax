<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" href="{{ asset('Logomax-Favicon/favicon.ico') ?? '' }}" type="image/x-icon" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" /> -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playball&family=Roboto:ital,wght@0,100;0,300;1,100;1,300&display=swap"
    rel="stylesheet" />

  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css"
    rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('logomax_pages/css/custom.css?'.time()) }}" />
  <!-- <link rel="stylesheet" type="text/css" href="{{ asset('logomax_pages/css/responsive.css?'.time()) }}"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- vite(['resources/css/app.css' , 'resources/js/usermessage.js']) -->
  <!-- <link rel="stylesheet" href="{{ asset('build/assets/app-041e359a.css') }}" /> -->
  <script type="module" src="{{ asset('build/assets/usermessage-8e2f260c.js?'.time()) }}"></script>
  <title>Dashboard</title>
</head>

<body>
  <div class="site"></div>
  <?php
    $otherPageSiteLogo =    asset('logomax-front-asset/img/logomax-logo-colored.svg');
    $footer_logo = asset('logomax-front-asset/img/logomax-logo-white.svg');
    
    $user_fname = auth()->user()->first_name; 
    $user_lname = auth()->user()->last_name;
    $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 1));
    $last_name_frstChar = strtoupper(mb_substr($user_lname, 0, 1));
    if(empty($last_name_frstChar)){
        $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 2));
    }
    $user_shorter_name = $first_name_frstChar.$last_name_frstChar;
    ?>
 
  <!-- Header Start -->
  <header class="header main-header sticky-header">
    <div class="container-fluid">
      <nav class="navbar main-navbar navbar-expand-lg navbar-dark">
        <div class="mobile-menu">
          <input type="checkbox" class="openSidebarMenu" id="openSidebarMenu" />
          <label for="openSidebarMenu" class="sidebarIconToggle">
            <div class="spinner diagonal part-1"></div>
            <div class="spinner horizontal"></div>
            <div class="spinner diagonal part-2"></div>
          </label>
          <div id="sidebarMenu">
            <div class="col-lg-3 bg-b pr-0 sidebar" id="target">
              <div class="container-fluid">
                <div class="left-text">
                  <ul class="list-unstyled dash-tab mb-0" id="menu">
                    <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard') }}"
                        class="nav-link @if($request->url() == url('user-dashboard')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-home"></i></span>
                          <span class="icons-text">Dashboard</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard/logo') }}"
                        class="nav-link @if($request->url() == url('user-dashboard/logo')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-shopping-cart"></i></span>
                          <span class="icons-text">My Logos</span>
                        </div>
                      </a>
                    </li>

                    <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard/favourites') }}"
                        class="nav-link @if($request->url() == url('user-dashboard/favourites')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-heart"></i></span>
                          <span class="icons-text">My Favorites</span>
                        </div>
                      </a>
                    </li>

                    <!-- <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard/messages') }}"
                        class="nav-link @if($request->url() == url('user-dashboard/messages')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-envelope"></i></span>
                          <span class="icons-text">Messages</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard/configuration') }}"
                        class="nav-link @if($request->url() == url('user-dashboard/configuration')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-cog"></i></span>
                          <span class="icons-text">Configuration</span>
                        </div>
                      </a>
                    </li>
                    <li class="nav-links">
                      <a href="{{ url(app()->getlocale().'/user-dashboard/subscriptions') }}"
                        class="nav-link @if($request->url() == url('user-dashboard/subscriptions')) active @endif">
                        <div class="side-links">
                          <span class="icons-links"><i class="fas fa-dollar-sign"></i></span>
                          <span class="icons-text">Subscriptions</span>
                        </div>
                      </a>
                    </li> -->
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- start -->
        <div class="logo">
          <a href="{{ url(app()->getLocale().'/') ?? '' }}">
            <img src="{{ $otherPageSiteLogo }}" alt="" />
          </a>
        </div>

        <div class="banner-content">
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
        <!-- end -->
        <input type="hidden" name="user_id" id="userid" value="{{ auth()->user()->id ?? '' }}" />
        <input type="hidden" id="base_url" value="{{ url('') }}" />
        <?php 
                    $unseen_messages = App\Models\Message::where([['reciever_id',auth()->user()->id],['seen_status',0]])->get();
          ?>
        <div class="notify-icons">
          <ul class="navbar-nav">
            <!--  -->
            <li class="nav-item align-content-center mobile">
              <a class="nav-link "  id="dropdownMenuButton4" data-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-search"></i>
              </a>
            </li>
            <li class="nav-item align-content-center notification">
              <a class="nav-link niks-nav-li" href="#" data-toggle="dropdown" id="dropdownMenuButton2" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge custom-badge badge-success">6</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                <div class="notify">
                  <div class="dropdown-head"><span class="sub-title nk-dropdown-title">Notifications</span><a
                      href="#">Mark All as Read</a></div>
                  <div class="dropdown-body">
                    <div class="nk-notification">
                      <!-- <div class="nk-notification-item dropdown-inner">
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
                      </div> -->
                    </div>
                  </div>
                  <div class="dropdown-foot center"><a href="#">View All</a></div>
                </div>
              </div>
            </li>
            <?php $unseen_messages = App\Models\Message::where([['reciever_id',Auth::user()->id],['seen_status',0]])->distinct('sender_id')->pluck('sender_id');
                  $total_unseen_message = App\Models\Message::where([['reciever_id',Auth::user()->id],['seen_status',0]])->get();
             ?>
            <li class="nav-item align-content-center message">
              <a class="nav-link niks-nav-li" href="#" data-toggle="dropdown" id="dropdownMenuButton3"  aria-expanded="false">
                <i class="fas fa-envelope"></i>
                <span class="badge custom-badge badge-success" id="totalMessages27">{{ count($total_unseen_message) ?? 0 }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton3">
               
              @if($unseen_messages->isNotEmpty())
                  @foreach($unseen_messages as $messages)
                  <?php $message_data = App\Models\Message::where([['sender_id',$messages],['seen_status',0]])->get();
                  $userdata = App\Models\User::find($messages);
                  $code = base64_encode($userdata->email);
                  ?>
                  <a class="dropdown-item" href="{{ url(app()->getlocale().'/user-dashboard/messages/'.$code) }}">{{ count($message_data) }} new @if(count($message_data) ==1) message @else messages @endif from {{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</a>
                  @endforeach
                @else
                <a class="dropdown-item" href="">No message found</a>
                @endif
                
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
              <div class="niks-nav-li" id="dropdownMenuButton1"  data-toggle="dropdown" aria-expanded="false">
                {{ $user_shorter_name ?? '' }}
              </div>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton1"
                style="margin-right: 20px">
                <a class="dropdown-item" href="https://logomax.com">Dashboard</a>

                <a class="dropdown-item"
                  href="{{ url(app()->getLocale().'/user-dashboard/configuration') }}">Configuration</a>
                <a class="dropdown-item"
                  href="{{ url(app()->getLocale().'/user-dashboard/subscriptions') }}">Subscriptions</a>
                <a class="dropdown-item"
                  href="#">Invoices</a>
                <a class="dropdown-item" href="https://logomax.com/logout">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>
      <!-- Mobile search bar  -->
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
    </div>
  </header>
  <!-- Header End  -->
  <?php 
    $customClass = '';
    if(isset($request)){
      if($request->segment(2) == 'user-dashboard' &&  $request->segment(3) == 'messages'){
        $customClass = 'nik-sec';
      }
    }
    ?>
  <section class="new-sec {{ $customClass }}">
    <div class="container-fluid">
      <div class="new-main-content">
        <div class="row">

          <div class="col-lg-3 bg-b pr-0 sidebar desktop" id="target">
            <div class="container-fluid">
              <div class="left-text">
                <ul class="list-unstyled dash-tab mb-0" id="menu">
                  <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard') }}"
                      class="nav-link @if($request->url() == url('user-dashboard')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-home"></i></span>
                        <span class="icons-text">Dashboard</span>
                      </div>
                    </a>
                  </li>

                  <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard/logo') }}"
                      class="nav-link @if($request->url() == url('user-dashboard/logo')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-shopping-cart"></i></span>
                        <span class="icons-text">My Logos</span>
                      </div>
                    </a>
                  </li>

                  <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard/favourites') }}"
                      class="nav-link @if($request->url() == url('user-dashboard/favourites')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-heart"></i></span>
                        <span class="icons-text">My Favorites</span>
                      </div>
                    </a>
                  </li>


                  <!-- +++++++++++++++++  Messages +++++++++++++++++++  -->
                  <!-- <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard/messages') }}"
                      class="nav-link @if($request->url() == url('user-dashboard/messages')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-envelope"></i></span>
                        <span class="icons-text">Messages</span>
                      </div>
                    </a>
                  </li> -->

                  <!-- ++++++++++++++++  configurations ++++++++++++++++++++ -->

                  <!-- <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard/configuration') }}"
                      class="nav-link @if($request->url() == url('user-dashboard/configuration')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-cog"></i></span>
                        <span class="icons-text">Configuration</span>
                      </div>
                    </a>
                  </li> -->

                  <!-- +++++++++++++ Subscription ++++++++++++ -->

                  <!-- <li class="nav-links">
                    <a href="{{ url(app()->getlocale().'/user-dashboard/subscriptions') }}"
                      class="nav-link @if($request->url() == url('user-dashboard/subscriptions')) active @endif">
                      <div class="side-links">
                        <span class="icons-links"><i class="fas fa-dollar-sign"></i></span>
                        <span class="icons-text">Subscriptions</span>
                      </div>
                    </a>
                  </li> -->

                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-9 p-0 content">
            <div class="right-text">
              <div class="container-fluid">
                @yield('content')
              </div>
              <!-- <div class="footer">
                <div class="ftr-content d-flex">
                  <div class="ftr-lft-txt">
                    <ul class="list-unstyled mb-0">
                      <li>Copyright ©2023 Logomax. All rights reserved.</li>
                    </ul>
                  </div>
                  <div class="ftr-ryt">
                    <select class="lang-selector" id="languages" name="languages">
                      <option>US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                      <option value="af">US - English</option>
                    </select>
                  </div>
                </div>
              </div> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- chat form  -->
  @if(isset($request))
  @if($request->segment(2) == 'user-dashboard' && $request->segment(3) == 'messages')

  <div class="message-form">
    <form action="" method="post" enctype="multipart/form-data" id="chatform">
      @csrf
      <input type="hidden" id="active_user" value="{{ $userdata->id ?? '' }}">
      <div class="write-msg d-flex justify-content-between">
        @if($chat == true)
        <div class="wrt-msg">
          <input id="message" placeholder="Write a messages....." />
        </div>
        @else
        <div class="wrt-msg text text-danger">
          Your chat session is over now.
        </div>
        @endif
        @if($chat == true)
        <div class="atch-file">
          <ul class="list-unstyled">
            <li>
              <label for="attachment"><i class="fa-solid fa-paperclip"></i></label>
              <input type="file" name="files[]" id="attachment">
            </li>
            <li><button type="submit" class="sendmessage btn btn-link"><img
                  src="{{ asset('logomax_pages/img/send.svg') }}" class="img-fluid" alt="..."></button></li>
          </ul>
        </div>
        @endif
      </div>
      <div>
        <p id="files-area">
          <span id="filesList">
            <span id="files-names"></span>
          </span>
        </p>
      </div>
    </form>
  </div>
  @endif
  @endif
  <!-- end  -->
  <!-- Footer Start -->

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
                <li> <a href="{{ url(app()->getLocale().'/designer-register') }}">{{ __('file.sell_your_logos_text')
                    }}</a></li> <!-- Register designer path  -->
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
                <li> <a href="{{ url(app()->getLocale().'/terms-and-conditions') }}">{{
                    __('file.terms_and_conditions_text') }}</a></li>
                <li> <a href="#">{{ __('file.privacy_policy_text') }}</a></li>
                <li> <a href="#">{{ __('file.cookie_policy_text') }}</a></li>
                <li> <a href="#">{{ __('file.cookies_setings_text') }}</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="business-text social-media-text">
              <h6>{{ __('file.contact_us_text') }}</h6>
              <ul>
                <li> <a href="#">{{ __('file.questions_and_answers_text') }}</a></li>
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
        <div class="site-footer d-flex justify-content-between">
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
                <div class="container">
                  <h2>Choose your Country/Region</h2>
                  <div class="cus_m_wrapper">
                    <?php $first = true; ?>
                    @foreach($siteLanguagesList as $key=>$value)
                    <a class="cus_dropdown-item @if($key == app()->getLocale()) selected @endif"
                      href="{{ url('changelagnuage/'.$key) }}">{{ $value ?? '' }}</a>
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

                <div class="cus_m_wrapper">
                  <?php $first = true; ?>
                  @foreach($currencies as $currency)

                  <a class="cus_dropdown-item @if($Currentcurrency == $currency) selected @endif"
                    href="{{ url('changeCurrency/'.$currency) }}">{{ $currency ?? '' }}</a>

                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer End -->
  <!-- chat form script -->
  <script>
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    $("#attachment").on('change', function (e) {
      for (var i = 0; i < this.files.length; i++) {
        let fileBloc = $('<span/>', { class: 'file-block' }),
          fileName = $('<span/>', { class: 'name', text: this.files.item(i).name });
        fileBloc.append('<span class="file-delete"><span class="px-4">X</span></span>')
          .append(fileName);
        $("#filesList > #files-names").append(fileBloc);
      };
      // Ajout des fichiers dans l'objet DataTransfer
      for (let file of this.files) {
        dt.items.add(file);
      }
      // Mise à jour des fichiers de l'input file après ajout
      this.files = dt.files;

      // EventListener pour le bouton de suppression créé
      $('span.file-delete').click(function () {
        let name = $(this).next('span.name').text();
        // Supprimer l'affichage du nom de fichier
        $(this).parent().remove();
        for (let i = 0; i < dt.items.length; i++) {
          // Correspondance du fichier et du nom
          if (name === dt.items[i].getAsFile().name) {
            // Suppression du fichier dans l'objet DataTransfer
            dt.items.remove(i);
            continue;
          }
        }
        // Mise à jour des fichiers de l'input file après suppression
        document.getElementById('attachment').files = dt.files;
      });

    });
  </script>
  <script>
    $(document).ready(function () {
      $("#button-addon5").click(function () {
        val = $('input[type="search"]').val();
        var currentUrl = window.location.href;
        var localeVal = "<?php echo app()->getLocale(); ?>";
        var position = currentUrl.indexOf(localeVal);

        // Extract the substring up to and including "lang-code"
        var extractedUrl =
          position !== -1
            ? currentUrl.substring(0, position + localeVal.length)
            : currentUrl;

        // console.log(result);
        // console.log(currentUrl);

        url = extractedUrl + "/logos/search?search=" + val;
        location.href = url;
      });
    });

    jQuery(window).scroll(function () {
      var scroll = jQuery(window).scrollTop();
      if (scroll >= 100) {
        jQuery(".main-header.sticky-header").addClass("fixed-header");
        jQuery(".custom-header").addClass("custom-header-2");
      } else {
        jQuery(".main-header.sticky-header").removeClass("fixed-header");
        jQuery(".custom-header").removeClass("custom-header-2");
      }
    });
  </script>
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script> -->

  <!--  -->
 
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script src="{{ asset('logomax_pages/js/script.js') }}"></script>

  <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
  <script>
    $(document).ready(function () {
      $(".dropdown-toggle").click(function () {

        $(this).toggleClass("toggle_show");
        $(this).parent().siblings().children().removeClass("toggle_show");
        $(".site").addClass("over");
      });

      $(".cus_dropdown-item, .cus_dropdown_menu").click(function (e) {
        e.stopPropagation();
        // e.preventDefault();
        // if ($(this).hasClass("cus_dropdown-item")) {
        $(this).addClass("selected").siblings().removeClass("selected");
        // }
      });

      $(document).click(function (e) {
        var drop = $(".dropdown-toggle");
        if (!drop.is(e.target) && drop.has(e.target).length === 0) {
          drop.removeClass("toggle_show");
        }
      });
    });


    $(document).ready(function () {
      $(".nav-item .cus-drop").click(function () {
        $(this).next(".custom-dropdown-menu").slideToggle('slow');
      });
    });

    $(document).ready(function () {
      $("#dropdownMenuButton4").click(function () {
        var currentDisplay = $("#search-input").css("display");
        $("#search-input").css("display", currentDisplay === "none" ? "block" : "none");
        $("#dropdownMenuButton4").html(currentDisplay === "none" ? '<i class="fas fa-times"></i>' : '<i class="fas fa-search"></i>');
      });
    });
  </script>
  @if(Session::get('error'))
  <script>
    iziToast.error({
      message: "{{ Session::get('error') }}",
      position: "topRight",
    });
  </script>
  @endif @if(Session::get('success'))
  <script>
    iziToast.success({
      message: "{{ Session::get('success') }}",
      position: "topRight",
    });
  </script>
  
  @endif
  <script>
    $(document).ready(function () {
      var w = window.innerWidth;
      if(w > 767){
        $('.niks-nav-li').attr('data-toggle','');
      }else{
        $('.niks-nav-li').attr('data-toggle','dropdown');
      }
    });
  </script>
</body>

</html>
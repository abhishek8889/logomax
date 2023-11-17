<!DOCTYPE html>
<html lang="{{ $meta_language ?? 'en' }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/style.css?khbkhsdfsdghgvgh')}}">
  <!-- <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/filter.css')}}"> -->
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/blog1.css')}}">
  <link rel="stylesheet" href="{{asset('/logomax-front-asset/css/custom.css')}}">

  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
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

  <!-- ================= header section start ====================== -->
<?php 
  $siteMeta = App\Models\SiteMeta::all();
  $homePageSiteLogo =  asset('logomax-front-asset/img/logo.png'); 
  $otherPageSiteLogo =    asset('logomax-front-asset/img/custom-logo.png');
  $footer_logo = asset('logomax-front-asset/img/Group 15.png');
  foreach($siteMeta as $metaData){
    if($metaData->meta_key == 'home-page-site-logo'){
      if(!empty($metaData->meta_value)){
        $homePageSiteLogo = asset('/siteMeta/'.$metaData->meta_value); 
      }else{
        $homePageSiteLogo =  asset('logomax-front-asset/img/logo.png'); 
      }
    }
    if($metaData->meta_key == 'other-pages-site-logo'){
      if(!empty($metaData->meta_value)){
        $otherPageSiteLogo = asset('/siteMeta/'.$metaData->meta_value);
      }else{
        $otherPageSiteLogo = asset('logomax-front-asset/img/custom-logo.png'); 
      }
      
    }
    if($metaData->meta_key == 'footer-logo'){
      if(!empty($metaData->meta_value)){
        $footer_logo = asset('/siteMeta/'.$metaData->meta_value);
      }else{
        $footer_logo = asset('logomax-front-asset/img/Group 15.png'); 
      }
    }
  }
  
?>
  <header class="header <?php if(isset($request)){if($request->url() != url('/')){ echo " custom-header"; }} ?> {{
    $request }}">
    <div class="top-header">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="ham">
              <div class="bars bar1"></div>
              <div class="bars bar2"></div>
              <div class="bars bar3"></div>
            </div>
          </button>
          <?php $categories = App\Models\Categories::all();
                    $styles = App\Models\Style::where('status',1)->get();
                    $branches = App\Models\Branch::where('status',1)->get();
                    
                ?>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Categories
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @if($categories->isNotEmpty())
                  @foreach($categories as $cat)
                  <a class="dropdown-item" href="{{ url('logos/search?categories=%5B"'.$cat->slug.'"%5D') }}">{{
                    $cat->name ?? '' }}</a>
                  @endforeach
                  @endif
                </div>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Branches
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                @if($branches->isNotEmpty())
                  @foreach($branches as $branch)
                  <a class="dropdown-item" href="{{ url('logos/search?categories=%5B"'.$branch->slug.'"%5D') }}">{{
                    $branch->name ?? '' }}</a>
                  @endforeach
                  @endif
                </div>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  Icons
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  @if($styles->isNotEmpty())
                  @foreach($styles as $style)
                  <a class="dropdown-item" href="{{ url('logos/search?styles=%5B"'.$style->slug.'"%5D') }}">{{
                    $style->name ?? '' }}</a>
                  @endforeach
                  @endif
                </div>
              </li>
            </ul>

            <div class="side-menu">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('reviews') }}">Reviews</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

    <div class="main-header">
      <div class="container-fluid">
        <div class="navbar navbar-expand-lg">
          <div class="logo">
            <a href="{{ url('/') ?? '' }}">
              <?php if(isset($request)){
                      if($request->url() != url('/')){?>
              <img src="{{ $otherPageSiteLogo}}" alt="" />
              <?php }else{?>
              <img src="{{ $homePageSiteLogo }}" alt="" />
              <?php }} ?>
            </a>
          </div>
          <?php if(isset($request)){
                      if($request->url() != url('/')){?>
          <div class="banner-content">
            <div class="Select-text">
              <div class="all-select">
                <div class="search">
                  <input type="search" name="search_field" class="form-control" value="{{ $request->search ?? '' }}"
                    placeholder="Search logo by branch or style">
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
          <div class="header-btn mr-1">
            <a class="login-btn" href="{{ url('/user-orders') }}">Orders</a>
          </div>
          <div class="header-btn">
            <a class="login-btn" href="{{ url('logout') }}">Log Out</a>
          </div>
          @else
          <div class="header-btn">
            <a class="login-btn cta-btn" href="{{ url('login') }}">Log In</a>
            <a class="login-btn cta-register" href="{{ url('register') }}">Sign Up</a>
          </div>
          @endif
        </div>
      </div>
    </div>
  </header>

  <!-- ================= header section end ====================== -->

  @yield('content')

  <!-- ================= footer section start ====================== -->

  <footer>
    <div class="container">
      <div class="top-footer p-110">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="footer-text">
              <div class="footer-logo">
                <img src="{{ $footer_logo }}" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="business-text social-media-text">
              <h6>Our company</h6>
              <ul>
                <li> <a href="#">Sell your logos</a></li> <!-- Register designer path  -->
                <li> <a href="#">About us </a></li>
                <li> <a href="#">Blog </a></li>
                <li> <a href="#">Affiliates</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="business-text social-media-text">
              <h6>Legal</h6>
              <ul>
                <li> <a href="#">Terms & conditions</a></li>
                <li> <a href="#">Privacy policy</a></li>
                <li> <a href="#">Cookie policy</a></li>
                <li> <a href="#">Cookies Setings</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="business-text social-media-text">
              <h6>Contact us</h6>
              <ul>
                <li> <a href="#">Questions & Answers</a></li>
                <li> <a href="#">Support</a></li>
                <li> <a href="#">Reviews</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="site-footer">
        <div class="Copyright-text">
          <p>Copyright ©2023 Logomax. All rights reserved.</p>
        </div>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
            US English
          </button>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="#">English</a>
            <a class="dropdown-item" href="#">US English</a>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <script>
    $(document).ready(function () {

      $('#button-addon5').click(function () {
        val = $('input[type="search"]').val();
        url = '{{ url("logos/search?search=") }}' + val;
        location.href = url;
      });
    })
  </script>


  <!-- ================= footer section start ====================== -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="https://alexandrebuffet.fr/codepen/slider/slick-animation.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>


  <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

  <script src="{{ asset('logomax-front-asset/js/script.js') }}"></script>


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

  <!-- session error end : -->
</body>

</html>
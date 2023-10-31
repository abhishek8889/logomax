<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
  
  <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- meta for fb : -->
    <meta property="og:url"        content="{{ url()->current() ?? '' }}" />
    <meta property="og:type"       content="article" />
    @if (isset($blog) && isset($blog->title))
    <meta property="og:image" content="{{ $blog->title ?? '' }}" />
    @endif
    @if (isset($blog) && isset($blog->sub_title))
    <meta property="og:image" content="{{ $blog->sub_title ?? '' }}" />
    @endif
    @if (isset($blog) && isset($blog->banner_img))
    <meta property="og:image" content="{{ asset('blog_images/' . $blog->banner_img) }}" />
    @endif

    <!-- end meta fb -->
  <title>home page </title>
</head>

<body>

  <!-- ================= header section start ====================== -->

  <header class="header <?php if(isset($request)){if($request->url() != url('/')){ echo "custom-header"; }} ?> {{ $request }}">
    <div class="top-header">
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <div class="ham">
                        <div class="bars bar1"></div>
                        <div class="bars bar2"></div>
                        <div class="bars bar3"></div>
                    </div>
                </button>
                <?php $categories = App\Models\Categories::all();
                    $styles = App\Models\Style::where('status',1)->get();
                    
                ?>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              @if($categories->isNotEmpty())
                                @foreach($categories as $cat)
                                <a class="dropdown-item" href="{{ url('logos/search?categories=%5B"'.$cat->slug.'"%5D') }}">{{ $cat->name ?? '' }}</a>
                                @endforeach
                              @endif
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Branches
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Styles
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                              @if($styles->isNotEmpty())
                                @foreach($styles as $style)
                                  <a class="dropdown-item" href="{{ url('logos/search?styles=%5B"'.$style->slug.'"%5D') }}">{{ $style->name ?? '' }}</a>
                                @endforeach
                              @endif
                            </div>
                        </li>
                    </ul>
               
                <div class="side-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about-us') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('reviews') }}">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('blogs') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('support') }}">Support</a>
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
                        <img src="{{ asset('/logomax-front-asset/img/custom-logo.png')}}" alt="" />
                      <?php }else{?>
                        <img src="{{ asset('/logomax-front-asset/img/logo.png')}}" alt="" />
                      <?php }} ?>
                    </a>
                </div>
                <?php if(isset($request)){
                      if($request->url() != url('/')){?>
                <div class="banner-content">
                            <div class="Select-text">
                                <div class="all-select">
                                    <div class="search">
                                        <input type="search" name="search_field" class="form-control" value="{{ $request->search ?? '' }}" placeholder="Search logo by branch or style">
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
                    <!-- <a class="login-btn cta-btn" data-toggle="modal" data-target="#exampleModal" href="#">Log in</a> -->
                    <!-- <a class="login-btn" href="{{ url('register') }}">Sign Up</a> -->
                    <a class="login-btn cta-btn" data-toggle="modal" data-target="#exampleloginModal" href="#">Log in</a>
                    <a class="login-btn cta-register" href="{{ url('register') }}">Sign Up</a>
                </div>
                @endif
            </div>

            <div class="popup_sec join-logo-sec">
                <!-- register modal -->
                <div class="modal fade" id="exampleloginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <div class="modal-body">
                                <!-- <div class="modl-img">
                                    <img src="{{ asset('logomax-front-asset/img/modal.png') }}" alt="" />
                                </div> -->
                                <div class="modal-text">
                                    <div class="login-modal">
                                        <h2>Log in to Logomax</h2>
                                        <div class="modal_form">
                                            <form action="{{ url('/login-process') }}" method="Post">
                                            @csrf
                                                <div class="form-group">
                                                    <input type="Email" class="form-control" name="login_email" placeholder="Email" />
                                                    @error('login_email')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group password">
                                                    <input type="Password" class="form-control" name="login_password" id="login_password" placeholder="Password" />
                                                  <a class="password" id="login_password"></a>
                                                    @error('login_password')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <!-- Here we use local host secret key we should change it with 6LetoOIlAAAAAMLtfUjMWwi82O070ZmLJZKk39s_  when our domain name logomax.com is working -->
                                                    <div class="g-recaptcha" data-sitekey="{{ env('GCAPTCHA_SITE_KEY') }}"></div>
                                                    
                                                    @if ($errors->has('g-recaptcha-response'))
                                                        <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                                    @endif
                                                </div> 
                                                <div class="form-group">
                                                    <div class="modal-btn">
                                                       <!-- <a href="">Log In</a>  -->
                                                        <button type="submit">Log In </button>
                                                    </div>
                                                </div>
                                                <div class="register-txt">
                                                    <div class="join-btn">
                                                        <a class="g-btn" href="{{ url('authorized/google') }}"><i class="fa-solid fa-g"></i>Register with <strong>Google</strong> </a>
                                                    </div>
                                                    <div class="join-btn">
                                                        <a class="fb-btn" href="{{ url('authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i>Register with <strong>Facebook</strong> </a>
                                                    </div>
                                                    <div class="join-btn">
                                                        <a class="email-btn" href="{{ url('register') }}"><i class="fa-solid fa-envelope"></i>Continue with email</a>
                                                    </div>

                                                    <div class="sign-account">
                                                        <p>Don’t you have an account? <a href="{{ url('register') }}" class="sign-up">Sign up</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="footer-text">
              <div class="footer-logo">
                <img src="{{ asset('logomax-front-asset/img/Group 15.png')}}" alt="">
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="business-text social-media-text">
              <h6>BUSINESS Logos</h6>
              <ul>
                <li> <a href="#">Restaurant</a></li>
                <li> <a href="#">Personal Trainer </a></li>
                <li> <a href="#">Coffee Shop </a></li>
                <li> <a href="#">Spa</a></li>
                <li> <a href="#">Real Estate </a></li>
                <li> <a href="#">Bakery</a></li>
                <li> <a href="#">Photographer </a></li>
                <li> <a href="#">Travel Agency</a></li>
                <li> <a href="#"> Beauty Salon</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="business-text social-media-text">
              <h6>HELP</h6>
              <ul>
                <li> <a href="#">Support</a></li>
                <li> <a href="#">About us</a></li>
                <li> <a href="#">Terms & conditions</a></li>
                <li> <a href="#">Cookie policy</a></li>
                <li> <a href="#"> Privacy policy</a></li>
                <li> <a href="#">Cookies Settings</a></li>
                <li> <a href="#">Digital Services Act</a></li>
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
    $(document).ready(function(){
                
                $('#button-addon5').click(function(){
                    val = $('input[type="search"]').val();
                    url = '{{ url("logos/search?search=") }}'+val;
                    location.href = url;
                });
            })
</script>


  <!-- ================= footer section start ====================== -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

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
  @if ($errors->has('email') || $errors->has('password') || $errors->has('name') || $errors->has('experience') || $errors->has('country') || $errors->has('address') || $errors->has('g-recaptcha-response'))
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
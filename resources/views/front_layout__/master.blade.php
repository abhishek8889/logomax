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
  
  <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('front/css/blog1.css') }}" />
  <title>home page </title>
</head>

<body>

  <!-- ================= header section start ====================== -->

  <header class="header <?php if(isset($request)){ if($request->url() !== url('/')){ echo 'custom-header'; }} ?>">
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
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categories
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
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
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                            </div>
                        </li>
                    </ul>
               
                <div class="side-menu">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('about-us') }}">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('review') }}">Reviews</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('blog') }}">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Support</a>
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
                    <a href="#">
                    <?php
                      if(isset($request)){
                        if($request->url() !== url('/')){ 
                          echo "<img src='/front/img/custom-logo.png' alt='' />";

                        }else{
                          echo "<img src='/front/img/logo.png' alt='' />";
                        }
                      } 
                    ?>
                        <img src="{{ asset('front/img/logo.png') }}" alt="" />
                    </a>
                </div>
                <div class="header-btn">
                    <a class="login-btn cta-btn" data-toggle="modal" data-target="#exampleModal" href="#">Log in</a>
                    <a class="login-btn" href="#">Sign Up</a>
                </div>
            </div>

            <div class="popup_sec join-logo-sec">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                            <div class="modal-body">
                                <div class="modl-img">
                                    <img src="img/modal.png" alt="" />
                                </div>
                                <div class="modal-text">
                                    <div class="login-modal">
                                        <h2>Log in to Logomax</h2>
                                        <div class="modal_form">
                                            <form>
                                                <div class="form-group">
                                                    <input type="Email" class="form-control" placeholder="Email" />
                                                </div>
                                                <div class="form-group password">
                                                    <input type="Password" class="form-control" placeholder="Password" />
                                                </div>
                                                <div class="form-group">
                                                    <div class="modal-btn">
                                                        <a href="">Log In</a>
                                                    </div>
                                                </div>
                                                <div class="register-txt">
                                                    <div class="join-btn">
                                                        <a class="g-btn" href="#"><i class="fa-solid fa-g"></i>Register with <strong>Google</strong> </a>
                                                    </div>
                                                    <div class="join-btn">
                                                        <a class="fb-btn" href="#"> <i class="fa-brands fa-facebook"></i>Register with <strong>Facebook</strong> </a>
                                                    </div>
                                                    <div class="join-btn">
                                                        <a class="email-btn" href="#"><i class="fa-solid fa-envelope"></i>Continue with email</a>
                                                    </div>

                                                    <div class="sign-account">
                                                        <p>Don’t you have an account? <a href="">Sign up</a></p>
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
                <img src="{{ asset('front/img/Group 15.png') }}" alt="">
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
                <li> <a href="{{ url('about-us') }}">About us</a></li>
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

  <!-- ================= footer section start ====================== -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <script src="{{ asset('front/js/script.js') }}"></script>
</body>

</html>
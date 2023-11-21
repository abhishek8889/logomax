<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Playball&family=Roboto:ital,wght@0,100;0,300;1,100;1,300&display=swap" rel="stylesheet">

  
    <link rel="stylesheet" href="{{ asset('logomax_pages/css/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('logomax_pages/css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Dashboard</title>
</head>

<body>
  <header class="header">
   <nav class="navbar main-navbar navbar-expand-lg navbar-dark">
      <div class="hd-logo">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('logomax_pages/img/logomax.png') }}" class="img-fluid" alt="....">
        </a>
      </div>
     <!-- <div class="d-flex hd-ryt-b"> -->
       <div class="srch-bb">
        <div class="notify-icons">
           <ul class="navbar-nav">
               <li class="nav-item align-content-center">
                 <a class="nav-link" href="#">
                    <i class="fas fa-bell"></i> 
                    <span class="badge custom-badge badge-success">6</span>
                 </a>
              </li>
              <li class="nav-item align-content-center">
                <a class="nav-link" href="#">
                    <i class="fas fa-envelope"></i>
                    <span class="badge custom-badge badge-success">6</span> 
                </a>
              </li>
              <li class="nav-item">
                <div class="col" id="dropdownMenuButton1" data-toggle="dropdown" aria-expanded="false">
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                        style="width: 50px;" alt="Avatar" />
                       
                    </div>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="margin-right:20px;">
                            <a class="dropdown-item" href="{{ url('/') }}">Go to Website</a>
                            <a class="dropdown-item" href="{{ url('logout') }}">Logout</a>
                    </div>
              </li>
              </ul>
         </div>
          <button class="navbar-toggler toggle" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
           <span class="navbar-toggler-icon"></span>
            <span class="navbar-toggler-icon"></span>
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse ryt-main-hd" id="collapsibleNavbar">
           <div class="search-bar">
             <div class="form-group fg--search">
               <input type="text" class="input" placeholder="Search for anything...">
               <a href="#" class="sg"><i class="fa fa-search"></i></a>
             </div>
          </div>
            
      </div>
         </div>
      </div>
    </nav>
  </header>
  <section class="new-sec">
    <div class="container-fluid">
        <div class="new-main-content">
            <div class="row">
                <div class="col-lg-3 bg-b pr-0" id="target">
                    <div class="left-text">
                        <ul class="list-unstyled dash-tab mb-0" id="menu">
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard') }}" class="nav-link @if($request->url() == url('user-dashboard')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-home"></i></span>
                                        <span class="icons-text">Dashboard</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard/favourites') }}" class="nav-link @if($request->url() == url('user-dashboard/favourites')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-heart"></i></span>
                                        <span class="icons-text">My Favorites</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard/logo') }}" class="nav-link @if($request->url() == url('user-dashboard/logo')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-shopping-cart"></i></span>
                                        <span class="icons-text">My Logos</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard/messages') }}" class="nav-link @if($request->url() == url('user-dashboard/messages')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-envelope"></i></span>
                                        <span class="icons-text">Messages</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard/configuration') }}" class="nav-link @if($request->url() == url('user-dashboard/configuration')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-cog"></i></span>
                                        <span class="icons-text">Configuration</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-links">
                                <a href="{{ url('user-dashboard/subscriptions') }}" class="nav-link @if($request->url() == url('user-dashboard/subscriptions')) active @endif">
                                    <div class="side-links">
                                        <span class="icons-links"><i class="fas fa-dollar-sign"></i></span>
                                        <span class="icons-text">Subscriptions</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 p-0">
                    <div class="right-text">
                       @yield('content')
                     <div class="footer">
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
                       </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
  </section>
 
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.usebootstrap.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
   <script src="{{ asset('logomax_pages/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>

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
  
</body>

</html>
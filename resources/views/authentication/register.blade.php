<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.png') }}">
    <!-- Page Title  -->
    <title>Register | Logomax</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                     

                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                            <div class="brand-logo pb-4 text-center">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img logo-img-lg" src="{{ asset('logomax-front-asset/img/custom-logo.png') }}" srcset="{{ asset('logomax-front-asset/img/custom-logo.png') }}" alt="logo">
                                    <img class="logo-dark logo-img logo-img-lg" src="{{ asset('logomax-front-asset/img/custom-logo.png') }}" srcset="{{ asset('logomax-front-asset/img/custom-logo.png') }}" alt="logo-dark">
                                </a>
                                <!-- <h3> <a href="{{ url('/') }}">LOGOMAX</a> </h3> -->
                            </div>
                            <hr>
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Register your account</h4>
                                    </div>
                                </div>
                                <form action="{{ url('/register-process') }}" method="Post">
                                    @csrf
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="name">Name</label>
                                            @error('name')
				                                <span class="text text-danger">{{ $message }}</span>
		                                    @enderror
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="text" name="name" class="form-control form-control-lg" id="name" placeholder="Enter your name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Email</label>
                                            @error('email')
				                                <span class="text text-danger">{{ $message }}</span>
		                                    @enderror
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Enter your email address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Password</label>
                                            @error('password')
				                                <span class="text text-danger">{{ $message }}</span>
		                                    @enderror
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Enter your password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password_confirmation">Confirm Password</label>
                                            @error('password_confirmation')
				                                <span class="text text-danger">{{ $message }}</span>
		                                    @enderror
                                        </div>
                                        <div class="form-control-wrap">
                                            <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password_confirmation" placeholder="Confirm your password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <!-- Here we use local host secret key we should change it with 6LetoOIlAAAAAMLtfUjMWwi82O070ZmLJZKk39s_  when our domain name logomax.com is working -->
                                        <div class="g-recaptcha" data-sitekey="6Le4mnImAAAAAJ4zsBLSenHpYgbUqfD6PkTOkzLd"></div>
                                        @if ($errors->has('g-recaptcha-response'))
                                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                                        @endif
                                    </div>  
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Sign Up</button>
                                    </div>
                                    <h6>Already have an account <a href="{{ url('login') }}">Go to login</a></h6>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="{{ asset('admin-theme/assets/js/bundle.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
    @if(Session::get('error'))
<script>
    toastr.clear();
    NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
</script>
@endif
@if(Session::get('success'))
<script>
    toastr.clear();
     NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
</script>
@endif
   

</html>
@extends('user_layout.master')
@section('content')
<style>
    .top-header li.nav-item.dropdown:before{
        top: 18px !important;
    }
</style>
    <link rel="stylesheet" href="{{ asset('/logomax-front-asset/css/style-auth.css?khbkhsdfsdghgvgh') }}">
    <section class="bann-sec p-100" style=" background-image: url(' {{ asset('logomax-front-asset/img/login-ban.png')}} '); ">
        <div>
        </div>
    </section>
    <section class="log-in p-100">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-accnt">
                        <h2>Log in to your account</h2>
                        <p>Welcome back! Select method to log in:</p>
                    </div>
                    <div class="social-links d-flex">
                        <div class="social-accnt">
                            <!-- <a href="{{-- url('authorized/google') --}}" class="login-gg gs-btn">
                                <span><img src="{{-- asset('logomax-front-asset/img/google.svg') --}}" class="img-fluid" alt=".."></span>
                                <span class="txt">Google</span>
                            </a> -->
                            <a class="g-btn login-gg gs-btn" href="{{ url('authorized/google') }}"><i class="fa-solid fa-g"></i> <strong>Google</strong> </a>

                        </div>
                        <div class="social-accnt">
                            <!-- <a href="{{-- url('authorized/facebook') --}}" class="login-gg fb-btn">
                                <span><img src="{{-- asset('logomax-front-asset/img/fb.svg') --}}" class="img-fluid" alt=".."></span>
                                <span class="txt">Facebook</span>
                            </a> -->
                            <a class="fb-btn login-gg fb-btn" href="{{ url('authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i> <strong>Facebook</strong></a>

                        </div>
                    </div>

                    <!--  -->
                    <!-- <div class="social-links d-flex">
                        <div class="social-accnt">
                            <a href="#" class="login-gg gs-btn">
                                <span><img src="./img/google.svg" class="img-fluid" alt=".."></span>
                                <span class="txt">Google</span>
                            </a>
                        </div>
                        <div class="social-accnt">
                            <a href="#" class="login-gg fb-btn">
                                <span><img src="./img/fb.svg" class="img-fluid" alt=".."></span>
                                <span class="txt">Facebook</span>
                            </a>
                        </div>
                    </div> -->
                    <!--  -->
                    <div class="continue-we">
                        <p class="small-p line-text1">or continue with email</p>
                    </div>
                    <form action="{{ url('/login-process') }}" method="Post" id="loginForm">
                        @csrf
                        <div class="mail-info">
                            <div class="form-group">
                                <input type="Email" class="form-control form-inp-box" name="login_email" placeholder="Email" />
                                @error('login_email')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password"  name="login_password" class="form-control form-inp-box hide_password" id="login_password" placeholder="Password" />
                                    <a href="javascript:void(0)" class="password_eye"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    @error('login_password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group form-check d-flex">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"> <Span class="pl-2 mt-2">Remember me</Span>
                                    </label>
                                    <p class="small-p"> <a href="{{ url('/account-recovery') }}"> Forget Password? </a></p>
                                </div>
                                <!-- <div class="form-group"> -->
                                    <!-- Here we use local host secret key we should change it with 6LetoOIlAAAAAMLtfUjMWwi82O070ZmLJZKk39s_  when our domain name logomax.com is working -->
                                    <!-- <div class="g-recaptcha" data-sitekey="{{ env('GCAPTCHA_SITE_KEY') }}" data-callback="onSubmit" data-size="invisible"></div> -->
                                    @if ($errors->has('g-recaptcha-response'))
                                        <!-- <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span> -->
                                    @endif
                                <!-- </div>  -->
                            <div class="btm-buttn">


                            
                                <button class="g-recaptcha cta btn" data-sitekey="{{ env('GCAPTCHA_SITE_KEY') }}" data-callback="onSubmit" data-size="invisible" type="submit" >Log In</button>
                            </div>
                            <div class="login-alert">
                                <p class="small-p">Don’t you have an account? <a href="{{ url('register') }}"> <strong>Sign up</strong></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        function onSubmit(token){
           document.getElementById('loginForm').submit();
        }
    </script>
@endsection
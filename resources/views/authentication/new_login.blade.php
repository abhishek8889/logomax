@extends('user_layout.master')
@section('content')
<style>
    .top-header li.nav-item.dropdown:before{
        top: 18px !important;
    }
</style>
    <link rel="stylesheet" href="{{ asset('/logomax-front-asset/css/style-auth.css?hsdfsffdghgvgh') }}">
    <section class="bann-sec p-100" style=" background-image: url(' {{ asset('logomax-front-asset/img/login-ban.png')}} '); ">
        <div>
        </div>
    </section>
    <section class="log-in p-100">
        <div class="container">
            <div class="login-content">
                <div class="login-form">
                    <div class="login-accnt">
                        <h2>{{ __('file.log_in_to_logomax_text') }}</h2>
                        <p>{{ __('file.choose_a_login_method') }}</p>
                    </div>
                    <div class="social-links d-flex">
                        <div class="social-accnt">
                            <a class="g-btn login-gg gs-btn" href="{{ url(app()->getLocale().'/authorized/google') }}"><i class="fa-solid fa-g"></i> <?php  echo __('file.login_with_google_text'); ?> </a>
                        </div>
                        <div class="social-accnt">
                            <a class="fb-btn login-gg fb-btn" href="{{ url(app()->getLocale().'/authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i> <?php echo __('file.login_with_fb_text'); ?> </a>
                        </div>
                    </div>
                    <div class="continue-we">
                        <p class="small-p line-text1">or</p>
                    </div>
                    <form action="{{ url('/login-process') }}" method="Post" id="loginForm">
                        @csrf
                        <div class="mail-info">
                            <div class="form-group">
                                <input type="Email" class="form-control form-inp-box" name="login_email" placeholder="{{ __('file.plchldr_email_text') }}" />
                                @error('login_email')
                                    <span class="text-left text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password"  name="login_password" class="form-control form-inp-box hide_password" id="login_password" placeholder="{{ __('file.plchldr_password_text') }}" />
                                    <a href="javascript:void(0)" class="password_eye"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                                @error('login_password')
                                        <span class="text-left text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                <div class="form-group form-check d-flex">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox"> <Span class="pl-2 mt-2">{{ __('file.remember_me_text') }}</Span>
                                    </label>
                                    <p class="small-p"> <a href="{{ url(app()->getLocale().'/account-recovery') }}"> {{ __('file.forgot_your_password_text') }}? </a></p>
                                </div>
                               
                            <div class="btm-buttn">
                                <button class="g-recaptcha cta btn" data-sitekey="{{ env('GCAPTCHA_SITE_KEY') }}" data-callback="onSubmit" data-size="invisible" type="submit" >{{ __('file.log_in_text') }}</button>
                            </div>
                            <div class="login-alert">
                                <p class="small-p">{{ __('file.dont_have_an_account_text') }}? <a href="{{ url(app()->getLocale().'/register') }}"> <strong>{{ __('file.sign_up_text') }}</strong></a></p>
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
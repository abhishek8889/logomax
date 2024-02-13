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
                        <!-- <h2></h2> -->
                        <h2>{{ __('file.recover_your_password') }}</h2>
                    </div>
                    <form action="{{ url('/send-recovery-email') }}" method="Post">
                        @csrf
                        <input type="hidden" name="recovery_token" value="$_get">
                        <div class="mail-info">
                            <div class="form-group">
                                <input type="Email" class="form-control form-inp-box" name="login_email" placeholder="{{ __('file.plchldr_email_text') }}" />
                                @error('login_email')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="btm-buttn">
                                <button  type="submit" class="cta btn">{{ __('file.send_mail_text') }}</button>
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
@endsection
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
                        <p>Enter your registered email</p>
                    </div>
                    <form action="{{ url('/send-recovery-email') }}" method="Post">
                        @csrf
                        <input type="hidden" name="recovery_token" value="$_get">
                        <div class="mail-info">
                            <div class="form-group">
                                <input type="Email" class="form-control form-inp-box" name="login_email" placeholder="Email" />
                                @error('login_email')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="btm-buttn">
                                <button  type="submit" class="cta btn">Recover</button>
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
@endsection
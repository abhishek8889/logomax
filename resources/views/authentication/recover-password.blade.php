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
                        <p>Enter your new password</p>
                    </div>
                    <form action="{{ url('/change-pass') }}" method="Post">
                        @csrf
                        <div class="mail-info">
                            <div class="form-group">
                                <input type="password" class="form-control form-inp-box" name="new_pass" placeholder="New Password" />
                                @error('new_pass')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-inp-box" name="confirm_new_pass" placeholder="Confirm New Password" />
                                @error('confirm_new_pass')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="btm-buttn">
                                <button  type="submit" class="cta btn">Change password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
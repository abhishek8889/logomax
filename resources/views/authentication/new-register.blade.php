@extends('user_layout.master')
@section('content')
<style>
    .top-header li.nav-item.dropdown:before{
        top: 18px !important;
    }
</style>
<link rel="stylesheet" href="{{ asset('/logomax-front-asset/css/style-auth.css?khbkhsdfsdghgvgh') }}">

<section class="bann-sec p-100" style="background-image: url('{{ asset('logomax-front-asset/img/login-ban.png') }}');">
    <div>

    </div>
</section>
<section class="log-in p-100">
    <div class="container">
        <div class="login-content">
            <div class="login-form">
                <div class="login-accnt">
                    <h2>Register to Logomax</h2>
                    <p>Create an account</p>
                </div>
                <div class="social-links d-flex">
                        <div class="social-accnt">
                            <a href="{{ url('authorized/google') }}" class="login-gg gs-btn">
                                <span><img src="{{ asset('logomax-front-asset/img/google.svg') }}" class="img-fluid" alt=".."></span>
                                <span class="txt">Google</span>
                            </a>
                        </div>
                        <div class="social-accnt">
                            <a href="{{ url('authorized/facebook') }}" class="login-gg fb-btn">
                                <span><img src="{{ asset('logomax-front-asset/img/fb.svg') }}" class="img-fluid" alt=".."></span>
                                <span class="txt">Facebook</span>
                            </a>
                        </div>
                </div>
                <div class="continue-we">
                    <p class="small-p line-text"> or </p>
                </div>
                <form action="{{ url('/register-process') }}" method="POST">
                    @csrf
                    <div class="mail-info">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-inp-box" name="name" placeholder="Name" />
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="Email" class="form-control form-inp-box" name="email" placeholder="Email" />
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-inp-box" name="experience" placeholder="Experience" />
                                    @error('experience')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror  
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-inp-box" name="country" placeholder="Country" />
                                    @error('country')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control form-inp-box" name="address" placeholder="Address" />
                                    @error('address')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group  ">
                                    <div class="input-group" id="show_hide_password">
                                        <input type="Password" class="form-control form-inp-box" name="password" placeholder="Password" />
                                        <div class="input-group-addon">
                                            <a href="javascript:void(0)" id="registerpassword"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12 col-12">
                                <div class="form-group ">
                                    <div class="input-group" id="show_hide_password">
                                    <input type="Password" class="form-control form-inp-box"  name="password_confirmation" placeholder="Confirm Password" />
                                        <div class="input-group-addon">
                                            <a href="javascript:void(0)"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                        <!-- Here we use local host secret key we should change it with 6LetoOIlAAAAAMLtfUjMWwi82O070ZmLJZKk39s_  when our domain name logomax.com is working -->
                        <div class="g-recaptcha" data-sitekey="{{ env('GCAPTCHA_SITE_KEY') }}"></div>
                        @if ($errors->has('g-recaptcha-response'))
                            <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                        @endif
                    </div> 
                        <div class="btm-buttn">
                            <button type="submit" class="cta btn">Sign Up</button>
                        </div>
                        <div class="login-alert text-center">
                            <p class="small-p text-center">Already have an account? <a href="{{url('login')}}"> <strong>Login</strong> </a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</section>
@endsection
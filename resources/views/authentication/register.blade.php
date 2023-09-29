@extends('user_layout.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6">
            <img src="{{ asset('logomax-front-asset/img/modal.png') }}" alt=""  width="100%"/>
        </div>
        <div class="col-lg-6">
        <h2>Register to Logomax</h2>
                                        <div class="modal_form">
                                            <form action="{{ url('/register-process') }}" method="Post">
                                            @csrf
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="name" placeholder="Name" />
                                                    @error('name')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="Email" class="form-control" name="email" placeholder="Email" />
                                                    @error('email')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="experience" placeholder="Experience" />
                                                    @error('experience')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="country" placeholder="Country" />
                                                    @error('country')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="address" placeholder="Address" />
                                                    @error('address')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group password">
                                                    <input type="Password" class="form-control" name="password" placeholder="Password" />
                                                    @error('password')
                                                     <span class="text text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group password">
                                                    <input type="Password" class="form-control" name="password_confirmation" placeholder="Confirm Password" />
                                                    @error('password_confirmation')
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
                                                        <button type="submit">Sign Up</button>
                                                    </div>
                                                </div>
                                                <div class="register-txt">
                                                    <div class="join-btn">
                                                        <a class="g-btn" href="{{ url('authorized/google') }}"><i class="fa-solid fa-g"></i>Register with <strong>Google</strong> </a>
                                                    </div>
                                                    <div class="join-btn">
                                                        <a class="fb-btn" href="{{ url('authorized/facebook') }}"> <i class="fa-brands fa-facebook"></i>Register with <strong>Facebook</strong> </a>
                                                    </div>
                                                    <div class="sign-account">
                                                        <p>Already have an account? <a data-toggle="modal" data-target="#exampleloginModal" href="#">Login</a></p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
        </div>
    </div>
</div>
@endsection
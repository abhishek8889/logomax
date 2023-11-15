@extends('user_dashboard_layout.master_layout')
@section('content')
<div class="row usr-row">
                           <div class="col-lg-5 col-md-5">
                               <div class="usr-img">
                                   <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle p-xl-1"
                                alt="Avatar" />
                               </div>
                           </div>
                            <div class="col-lg-7 col-md-7">
                                <div class="usr-cntc">
                                    <ul class="list-unstyled mb-0">
                                        <li>
                                            <h6>Name:</h6>
                                            <span>TOM XYZ</span>
                                        </li>
                                        <li>
                                            <h6>Email:</h6>
                                            <a href="mailto:tom@gmail.com">tom@gmail.com</a>
                                        </li>
                                        <li><h6>Number:</h6>
                                            <a href="tel:+123-12121213">+123-12121213</a></p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                       </div>
                       <div class="form-info">
                           <h4>change Password</h4>
                           <div class="row">
                               <form class="confirm-p pl-5" method="post" action="{{ url('changePassword') }}">
                                @csrf
                                <div class="form-group">
                                 <label for="exampleInputPassword1">Password</label>
                                  <input type="password" name="password" class="form-control p-cp" id="exampleInputPassword1"
                                 placeholder="Password">
                                 @error('password')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                               </div>
                              <div class="form-group">
                                 <label for="exampleInputPassword1">confirm Password</label>
                                 <input type="password" name="password_confirmation" class="form-control p-cp" id="exampleInputPassword1"
                                placeholder="confirm Password">
                                @error('confirmpassword')
                                 <span class="text-danger">{{ $message }}</span>
                                 @enderror
                             </div>
                             <div class="chng-butn">
                               <button type="submit" class="buttn">Change</button>
                             </div>
                    </form>
                           </div>
                       </div>
                   
                     </div>
@endsection

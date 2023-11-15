@extends('user_dashboard_layout.master_layout')
@section('content')
<div class="my-fav">
                            <h3>My Logos</h3>
                            <div class="my-fav-hd">
                                <div class="row rw">
                                    <div class="col-lg-5 col-md-5 col-sm-5">
                                        <div class="p-name"><h6>Product Name</h6></div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <div class="p-cost p-cntr"><h6>Price</h6></div>
                                    </div>
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="ad-dt p-cntr"><h6>Added Date</h6></div>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2"></div>
                                </div>
                            </div>
                            <div class="my-fav-btm">
                                <ul class="list-unstyled mb-0">
                                    @foreach($mylogos as $logo)
                                    <li> 
                                       <div class="row fav-prd">
                                              <div class="col-lg-5 col-md-5 col-sm-5">
                                                 <div class="p-name pd-txt">
                                                    <a href="{{ url('logo/'.$logo->logodetail->logo_slug ?? '') }}">
                                                     <div class="p-img"><img src="{{ asset($logo->logodetail->media->image_path ?? '') }}" class="img-fluid" alt="...."></div>
                                                     </a>
                                                     <div class="p-text inr-text">{{ $logo->logodetail->logo_name ?? '' }}</div>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2 col-md-2 col-sm-2">
                                                 <div class="p-cost p-cntr inr-text">${{ $logo->logodetail->price_for_customer ?? '' }}</div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-sm-3">
                                                 <div class="ad-dt p-cntr inr-text">{{ $logo->created_at ?? '' }}</div>
                                              </div>
                                              <div class="col-lg-2 col-md-2 col-sm-2">
                                                  <div class="heart-i p-cntr inr-text"><i class="fas fa-ellipsis-v"></i></div>
                                              </div>
                                         </div>
                                   </li>
                                   @endforeach
                                   
                                </ul>
                            </div>
                        </div>
                     </div>
@endsection

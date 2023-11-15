@extends('user_dashboard_layout.master_layout')
@section('content')
<div class="row row2">
                            <div class="col-lg-6 col-md-6">
                                <div class="wlcm-txt">
                                    <h4>Welcome To Dashboard</h4>
                                    <p class="wl-txt">Hello <strong>{{ auth()->user()->name ?? '' }}</strong>(not {{ auth()->user()->name ?? '' }}? <strong>Log out</strong>)
                                     From your account dashboard you can view your current membership,
                                     manage your <strong>password</strong> and <strong>account details</strong>
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                               <div class="recently-chat">
                                <h4 class="align-content-center">Recent Chats</h4>
                                <div id="wrapper">
                                 <div class="scrollbar" id="style-15">
                                  <div class="force-overflow">
                                  
                                  <!-- <ul class="list-unstyled mb-0 mt-4">
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                      <li class="recent-chat d-flex py-0">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="./img/p-img.png" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">Loren</P>
                                                  <p class="s-text">Lorem Ipsum is simply dummy</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat">6</span>
                                          </div>
                                      </li>
                                  </ul> -->
                                </div>
                                </div>
                               </div>
                            </div>
                          </div>
                          </div>

                           
                       
                        <div class="my-fav">
                            <h3>My Favorites</h3>
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
                                    @foreach($wishlist as $list)
                                    <li> 
                                        <div class="row fav-prd">
                                              <div class="col-lg-5 col-md-5 col-sm-5">
                                                 <div class="p-name pd-txt">
                                                     <div class="p-img"><img src="{{ asset($list->logos->media->image_path ?? '') }}" class="img-fluid" alt="...."></div>
                                                     <div class="p-text inr-text">{{ $list->logos->logo_name ?? '' }}</div>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2 col-md-2 col-sm-2">
                                                 <div class="p-cost p-cntr inr-text">${{ $list->logos->price_for_customer ?? '' }}</div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-sm-3">
                                                 <div class="ad-dt p-cntr inr-text">{{ $list->created_at ?? '' }}</div>
                                              </div>
                                              <div class="col-lg-2 col-md-2 col-sm-2">
                                                  <div class="heart-i p-cntr inr-text"><i style="color: red;" class="fas fa-heart"></i></div>
                                              </div>
                                         </div>
                                   </li>
                                   @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="my-fav my-logs">
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
                                    @foreach($mylogos as $logos)
                                    <li> 
                                       <div class="row fav-prd">
                                              <div class="col-lg-5 col-md-5 col-sm-5">
                                                 <div class="p-name pd-txt">
                                                     <div class="p-img"><img src="{{ asset($logos->logodetail->media->image_path ?? '') }}" class="img-fluid" alt="...."></div>
                                                     <div class="p-text inr-text">{{ $logos->logodetail->logo_name ?? '' }}</div>
                                                 </div>
                                              </div>
                                              <div class="col-lg-2 col-md-2 col-sm-2">
                                                 <div class="p-cost p-cntr inr-text">${{ $logos->logodetail->price_for_customer ?? '' }}</div>
                                              </div>
                                              <div class="col-lg-3 col-md-3 col-sm-3">
                                                 <div class="ad-dt p-cntr inr-text">{{ $logos->created_at ?? '' }}</div>
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

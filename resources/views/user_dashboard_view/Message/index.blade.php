@extends('user_dashboard_layout.master_layout')
@section('content')
<div class="">
    {{ Breadcrumbs::render('user-messages') }}
</div>
<div class="msg-content ">
                       <div class="row  row1">
                           <div class="col-lg-5 col-md-12" style="background: #fff;">
                            <div class="msg-box-lft-chat">
                              <div class="msg-box">
                                   <div class="d-block pt-3">
                                <div class="msg-search">
                                    <div class="msgs-sbar">
                                        <div>
                                        <form class="d-flex">
                                          <button class="btn " type="submit"><i style="color: #656F79;" class="fas fa-search"></i></button>
                                              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> 
                                        </form>
                                      </div>
                                        <div class="ryt-dots"><span><i class="fas fa-ellipsis-v"></i></span></div>
                                    </div>
                                    <!-- <div>
                                        <span></span>
                                    </div> -->
                                </div>
                                <div id="wrapper">
                                 <div class="scrollbar" id="style-15">
                                  <div class="force-overflow">
                                  
                                  <ul class="list-unstyled mb-0">
                                      <li class="recent-chat chat-b acti-chat d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                      <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                       <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                       <li class="recent-chat chat-b d-flex">
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
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
                                  </ul>
                                </div>
                                </div>
                            </div>
                           </div>
                              </div> 
                           </div>
                         </div>

                           <div class="col-lg-7 col-md-12 pl-0">
                               <div class="msg-ryt">
                                    <div class="msg-ryt-head">
                                    <div class="lp-info d-flex">
                                        <div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-img.png') }}" class="img-fluid" alt="..."></div>
                                        <div class="lp-text">
                                            <h6>Loren</h6>
                                            <span>Online</span>
                                        </div>
                                    </div>
                                    <div class="cntc-i">
                                        <ul class="list-unstyled d-flex">
                                            <li><img src="{{ asset('logomax_pages/img/phn-img.svg') }}" class="img-fluid" alt=".."></li>
                                             <li><img src="{{ asset('logomax_pages/img/ingo.svg') }}" class="img-fluid" alt=".."></li>
                                        </ul>
                                    </div>
                                    </div>
                                    <div class="msg-live-chat">
                                         <div id="wrapper">
                                        <div class="scrollbar" id="style-15">
                                          <div class="force-overflow">
                                       <div class="receiver-d">
                                           <div class="lp-info d-flex">
                                                 <div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="...">
                                                 </div>
                                               <div class="lp-text">
                                                <h6>Loren <span>10:00 am</span></h6>
                                                <div class="lv-chat">
                                                    <p class="b-text">Hlo.
                                                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500</p>

                                                    <p class="b-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                </div>
                                           </div>
                                       </div>
                                       
                                       </div>
                                       <div class="sender-d">
                                        <div class="s-ryt-img">
                                            <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"  class="img-fluid" alt="..."></span>
                                            <span><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"  class="img-fluid" alt="..."></span>
                                        </div>
                                            <div class="lp-info d-flex">
                                                 <div class="lp-img"><img src="{{ asset('logomax_pages/img/jord.png') }}"  class="img-fluid" alt="...">
                                                 </div>
                                               <div class="lp-text">
                                                <h6>Jordan <span>10:00 am</span></h6>
                                                <div class="lv-chat">
                                                    <p class="b-text">Hlo.
                                                     Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500</p>
                                                 </div>
                                           </div>
                                       </div>

                                        </div>
                                        <div class="receiver-d">
                                           <div class="lp-info d-flex">
                                                 <div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="...">
                                                 </div>
                                               <div class="lp-text">
                                                <h6>Loren <span>10:00 am</span></h6>
                                                <div class="lv-chat">
                                                    <p class="b-text">Hlo.
                                                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500</p>

                                                    <p class="b-text">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal.</p>
                                                </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                                    </div>
                                    <div class="write-msg">
                                        <div class="wrt-msg">
                                           <textarea placeholder="Write a messages....."></textarea>
                                        </div>
                                        <div class="attach-links d-flex">
                                            <div class="atch-file">
                                                <ul class="list-unstyled">
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/b-txt.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/i-txt.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/round-link.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/slash.svg') }}" class="img-fluid" alt="..."></a></li>
                                                </ul>
                                            </div>
                                            <div class="atch-file">
                                                <ul class="list-unstyled">
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/atch-f.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/atch-emoji.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/set.svg') }}" class="img-fluid" alt="..."></a></li>
                                                    <li><a href=""><img src="{{ asset('logomax_pages/img/send.svg') }}" class="img-fluid" alt="..."></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                 </div>
                           </div>
                       </div>
                     </div>
                   </div>
                        
                       </div>
@endsection
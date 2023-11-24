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
                                  
                                  <ul class="list-unstyled mb-0" id="chatboxuserslist{{ auth()->user()->id ?? '' }}">
                                    @foreach($users as $user) 
                                    <a href="{{ url('user-dashboard/messages/'.base64_encode($user->email) ?? '') }}">
                                    <li class="recent-chat chat-b acti-chat d-flex" userid = "{{ $user->id ?? '' }}">
                                        
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <P class="b-text">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</P>
                                                  <p class="s-text">{{ $user->messages[0]->message ?? '' }}</p>
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <span>11:00 am</span>
                                              <span class="num-chat" id="unseen_count{{ $user->id ?? '' }}">{{ count($user->unseenmessages) ?? 0 }}</span>
                                          </div>
                                         
                                      </li>
                                     </a>
                                    @endforeach
                                  </ul>
                                </div>
                                </div>
                            </div>
                           </div>
                              </div> 
                           </div>
                         </div>
                         @if($userdata)
                                    <div class="col-lg-7 col-md-12 pl-0 userbox user{{ $userdata->id ?? '' }} ">
                                      
                                        <div class="msg-ryt">
                                                <div class="msg-ryt-head">
                                                <div class="lp-info d-flex">
                                                    <div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-img.png') }}" class="img-fluid" alt="..."></div>
                                                    <div class="lp-text">
                                                        <h6>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</h6>
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
                                                    <div class="scrollbar" id="style-15" >
                                                    <div class="force-overflow" id="messagebox{{ $userdata->id ?? '' }}" >
                                                        @foreach($message as $m)
                                                        @if($m->sender_id == auth()->user()->id)
                                                        <div class="receiver-d">
                                                            <div class="lp-info d-flex">
                                                                <div class="lp-img">
                                                                    <img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="...">
                                                                </div>
                                                                <div class="lp-text">
                                                                    <h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>10:00 am</span></h6>
                                                                    <div class="lv-chat">
                                                                        <p class="b-text">{{ $m->message ?? '' }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @else
                                                        <div class="sender-d">
                                                            <div class="s-ryt-img">
                                                                <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"  class="img-fluid" alt="..."></span>
                                                                <span><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"  class="img-fluid" alt="..."></span>
                                                            </div>
                                                                <div class="lp-info d-flex">
                                                                    <div class="lp-img"><img src="{{ asset('logomax_pages/img/jord.png') }}"  class="img-fluid" alt="...">
                                                                    </div>
                                                                    <div class="lp-text">
                                                                        <h6>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }} <span>10:00 am</span></h6>
                                                                        <div class="lv-chat">
                                                                            <p class="b-text">{{ $m->message ?? '' }}</p>
                                                                        </div>
                                                                    </div>
                                                                 </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <input type="hidden" id="active_user" value="{{ $userdata->id ?? '' }}">
                                    <div class="write-msg d-flex justify-content-between">
                                        <div class="wrt-msg">
                                           <textarea id="message" placeholder="Write a messages....."></textarea>
                                        </div>
                                        <div class="atch-file">
                                                <ul class="list-unstyled">
                                                    <li><a class="sendmessage"><img src="{{ asset('logomax_pages/img/send.svg') }}" class="img-fluid" alt="..."></a></li>
                                                </ul>
                                        </div>
                                      <!--   <div class="attach-links d-flex">
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
                                        </div> -->
                                    </div>


                                 </div>
                                
                           </div>
                        @endif
                       </div>
                     </div>
                   </div>
                   
                       </div>
                       <script>
                        $('.sendmessage').on('click',function(e){
                            e.preventDefault();
                            message = $('#message').val();
                            if(message == '' || message == null){
                               
                                return false;
                            }
                            senderid = "{{ auth()->user()->id }}";
                            recieverid = "{{ $userdata->id ?? '' }}";
                            $('#message').val('');
                            $.ajax({
                                method: 'post',
                                data: { message:message,sender_id:senderid,reciever_id:recieverid,_token:"{{ csrf_token() }}" },
                                url: "{{ url('user-dashboard/messagesProcc') }}",
                                success: function(response){
                                    message = '<div class="receiver-d"><div class="lp-info d-flex"><div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="..."></div><div class="lp-text"><h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>10:00 am</span></h6><div class="lv-chat"><p class="b-text">'+message+'</p></div></div></div></div>';
                                    $('#messagebox'+recieverid).append(message);
                                    console.log('done');
                                    
                                }
                            })

                        }); 
                       </script>
@endsection
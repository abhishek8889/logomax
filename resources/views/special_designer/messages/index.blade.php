@extends('special_designer_layout.master')
@section('content')

<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-chat">
                                    <div class="nk-chat-aside">
                                        <div class="nk-chat-aside-head">
                                            <div class="nk-chat-aside-user">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle dropdown-indicator" data-bs-toggle="dropdown">
                                                        <div class="title">Chats</div>
                                                    </a>
                                                </div>
                                            </div><!-- .nk-chat-aside-user -->
                                        </div><!-- .nk-chat-aside-head -->
                                        <div class="nk-chat-aside-body" data-simplebar>
                                            <!-- <div class="nk-chat-aside-search">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <em class="icon ni ni-search"></em>
                                                        </div>
                                                        <input type="text" class="form-control form-round" id="default-03" placeholder="Search by name">
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- .nk-chat-aside-search -->
                                            
                                            <div class="nk-chat-list">
                                                <!-- <h6 class="title overline-title-alt">Messages</h6> -->
                                                <ul class="chat-list" id="userchatlist{{ auth()->user()->id ?? '' }}">
                                                @foreach($users as $user)
                                                    <li class="chat-item">
                                                        <a class="chat-link " href="{{ url('special-designer/messages/'.base64_encode($user->email) ?? '') }}">
                                                            <div class="chat-media user-avatar bg-purple">
                                                                <span>IH</span>
                                                                <span class="status dot dot-lg dot-gray"></span>
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from">
                                                                    <div class="name">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</div>
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="chat-info">
                                                                <div class="chat-from d-flex justify-content-end">
                                                                    <div class="name "><span id="unseenmessage_count{{ $user->id ?? '' }}">{{ count($user->unseenmessages) ?? 0 }}</span></div>
                                                                </div>
                                                               
                                                            </div>
                                                        </a>
                                                    </li><!-- .chat-item -->
                                                  @endforeach  
                                                </ul><!-- .chat-list -->
                                            </div><!-- .nk-chat-list -->
                                        </div>
                                    </div><!-- .nk-chat-aside -->
                                 @if($userdata)
                                    <div class="nk-chat-body profile-shown">
                                        <div class="nk-chat-head">
                                            <ul class="nk-chat-head-info">
                                                <li class="nk-chat-body-close">
                                                    <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em class="icon ni ni-arrow-left"></em></a>
                                                </li>
                                                <li class="nk-chat-head-user">
                                                    <div class="user-card">
                                                        <div class="user-avatar bg-purple">
                                                            <span>IH</span>
                                                        </div>
                                                        <div class="user-info">
                                                            <div class="lead-text">{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</div>
                                                           
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="nk-chat-head-tools">
                                                
                                                <li class="me-n1 me-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle"><em class="icon ni ni-alert-circle-fill"></em></a></li>
                                            </ul>
                                            <div class="nk-chat-head-search">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <div class="form-icon form-icon-left">
                                                            <!-- <em class="icon ni ni-search"></em> -->
                                                        </div>
                                                        <input type="text" class="form-control form-round" id="chat-search" placeholder="Search in Conversation">
                                                    </div>
                                                </div>
                                            </div><!-- .nk-chat-head-search -->
                                        </div><!-- .nk-chat-head -->
                                        <div class="nk-chat-panel" style="display:flex; flex-direction:column-reverse;">
                                        <div id="chatbox{{ $userdata->id ?? '' }}">   
                                        @foreach($message as $m)
                                            @if($m->reciever_id == auth()->user()->id)
                                            <div class="chat is-you">
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg"> {{ $m->message ?? '' }} </div>
                                                        </div>
                                                    </div>
                                                    <ul class="chat-meta">
                                                        <li>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</li>
                                                        <li>{{ $m->created_at ?? '' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @else
                                            <div class="chat is-me">
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg"> {{ $m->message ?? '' }} </div>
                                                        </div>
                                                    </div>
                                                    <ul class="chat-meta">
                                                        <li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li>
                                                        <li>{{ $m->created_at ?? '' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                           </div>
                                        </div><!-- .nk-chat-panel -->
                                        <div class="nk-chat-editor">
                                            <div class="nk-chat-editor-upload  ms-n1">
                                                <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary toggle-opt" data-target="chat-upload"><em class="icon ni ni-plus-circle-fill"></em></a>
                                                
                                            </div>
                                            <div class="nk-chat-editor-form">
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-simple no-resize" id="message" rows="1" id="default-textarea" placeholder="Type your message..."></textarea>
                                                </div>
                                            </div>
                                            <ul class="nk-chat-editor-tools g-2">
                                              
                                                <li>
                                                    <button class="btn btn-round btn-primary btn-icon" id="send"><em class="icon ni ni-send-alt"></em></button>
                                                </li>
                                            </ul>
                                        </div><!-- .nk-chat-editor -->
                                        <div class="nk-chat-profile visible" data-simplebar>
                                            <div class="user-card user-card-s2 my-4">
                                                <div class="user-avatar md bg-purple">
                                                    <span>IH</span>
                                                </div>
                                                <div class="user-info">
                                                    <h5>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</h5>
                                                    <input type="hidden" id="active_user" value="{{ $userdata->id ?? '' }}">
                                                    <!-- <span class="sub-text">Active 35m ago</span> -->
                                                </div>
                                                <div class="user-card-menu dropdown">
                                                    <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-eye"></em><span>View Profile</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-na"></em><span>Block Messages</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="chat-profile">
                                                <!-- <div class="chat-profile-group">
                                                    <a href="#" class="chat-profile-head" data-bs-toggle="collapse" data-bs-target="#chat-options">
                                                        <h6 class="title overline-title">Options</h6>
                                                        <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
                                                    </a>
                                                    <div class="chat-profile-body collapse show" id="chat-options">
                                                        <div class="chat-profile-body-inner">
                                                            <ul class="chat-profile-options">
                                                                <li><a class="chat-option-link" href="#"><em class="icon icon-circle bg-light ni ni-edit-alt"></em><span class="lead-text">Nickname</span></a></li>
                                                                <li><a class="chat-option-link chat-search-toggle" href="#"><em class="icon icon-circle bg-light ni ni-search"></em><span class="lead-text">Search In Conversation</span></a></li>
                                                                <li><a class="chat-option-link" href="#"><em class="icon icon-circle bg-light ni ni-circle-fill"></em><span class="lead-text">Change Theme</span></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- .chat-profile-group -->
                                                <!-- <div class="chat-profile-group">
                                                    <a href="#" class="chat-profile-head" data-bs-toggle="collapse" data-bs-target="#chat-settings">
                                                        <h6 class="title overline-title">Settings</h6>
                                                        <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
                                                    </a>
                                                    <div class="chat-profile-body collapse show" id="chat-settings">
                                                        <div class="chat-profile-body-inner">
                                                            <ul class="chat-profile-settings">
                                                                <li>
                                                                    <div class="custom-control custom-control-sm custom-switch">
                                                                        <input type="checkbox" class="custom-control-input" id="customSwitch2">
                                                                        <label class="custom-control-label" for="customSwitch2">Notifications</label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <a class="chat-option-link" href="#">
                                                                        <em class="icon icon-circle bg-light ni ni-bell-off-fill"></em>
                                                                        <div>
                                                                            <span class="lead-text">Ignore Messages</span>
                                                                            <span class="sub-text">You won’t be notified when message you.</span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a class="chat-option-link" href="#">
                                                                        <em class="icon icon-circle bg-light ni ni-alert-fill"></em>
                                                                        <div>
                                                                            <span class="lead-text">Something Wrong</span>
                                                                            <span class="sub-text">Give feedback and report conversion.</span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- .chat-profile-group -->
                                                <!-- <div class="chat-profile-group">
                                                    <a href="#" class="chat-profile-head" data-bs-toggle="collapse" data-bs-target="#chat-photos">
                                                        <h6 class="title overline-title">Shared Photos</h6>
                                                        <span class="indicator-icon"><em class="icon ni ni-chevron-down"></em></span>
                                                    </a>
                                                    <div class="chat-profile-body collapse show" id="chat-photos">
                                                        <div class="chat-profile-body-inner">
                                                            <ul class="chat-profile-media">
                                                                <li><a href="#"><img src="./images/slides/slide-a.jpg" alt=""></a></li>
                                                                <li><a href="#"><img src="./images/slides/slide-b.jpg" alt=""></a></li>
                                                                <li><a href="#"><img src="./images/slides/slide-c.jpg" alt=""></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div> -->
                                                <!-- .chat-profile-group -->
                                            </div> <!-- .chat-profile -->
                                        </div><!-- .nk-chat-profile -->
                                    </div><!-- .nk-chat-body -->
                                </div><!-- .nk-chat -->
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    $(document).ready(function(){
                        $('#send').on('click',function(){
                           
                            message = $('#message').val();
                            if(message == '' || message == null){
                                return false;
                            }
                            senderid = "{{ auth()->user()->id ?? '' }}";
                            recieverid = "{{ $userdata->id ?? '' }}";
                            $("#chatbox"+recieverid).scrollTop(1000);
                           $.ajax({
                            method: 'post',
                            url: "{{ url('special-designer/messagesProcc') }}",
                            data: { message:message,sender_id:senderid,reciever_id:recieverid,_token:"{{ csrf_token() }}" },
                            success: function(response){
                                html = '<div class="chat is-me"><div class="chat-content"><div class="chat-bubbles"><div class="chat-bubble"><div class="chat-msg"> '+message+'</div></div></div><ul class="chat-meta"><li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li><li>29 Apr, 2020 4:12 PM</li></ul></div></div>';
                               $('#chatbox'+recieverid).append(html);
                               $('#message').val('');
                            }
                           })
                        });
                    });
                </script>
@endsection
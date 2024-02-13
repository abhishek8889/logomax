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
                                    <a href="{{ url(app()->getlocale().'/user-dashboard/messages/'.base64_encode($user->email) ?? '') }}">
                                    <li class="recent-chat chat-b acti-chat d-flex" userid = "{{ $user->id ?? '' }}">
                                        
                                          <div class="chat-content">
                                              <div class="p-img"><img src="{{ asset('logomax_pages/img/p-img.png') }}" class="img-fluid" alt="..."></div>
                                              <div class="p-chat">
                                                  <p class="b-text">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}</p>
                                                  <!-- <p class="s-text">{{ $user->messages[0]->message ?? '' }}</p> -->
                                              </div>
                                          </div>
                                          <div class="chat-t">
                                              <!-- <span>11:00 am</span> -->
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
                                                        <!-- <span>Online</span> -->
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
                                                        <?php
                                                        $files = $m->files;
                                                        if($files != null){
                                                            $filesarray = json_decode($files);
                                                        }else{
                                                            $filesarray = [];
                                                        }
                                                       
                                                        ?>
                                                        @if($m->sender_id == auth()->user()->id)
                                                        <div class="sender-d message{{ $m->id ?? '' }}">
                                                             <div class="s-ryt-img">
                                                                    <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"  class="img-fluid" alt="..."></span>
                                                                    <span id="dropdownMenuButton{{ $m->id ?? '' }}" data-toggle="dropdown" aria-expanded="false"><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"  class="img-fluid" alt="..."></span>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $m->id ?? '' }}">
                                                                        <a class="dropdown-item edit-message" message-text="{{ $m->message ?? '' }}" message-id="{{ $m->id ?? '' }}" >Edit</a>
                                                                        <a class="dropdown-item remove-message" message-id="{{ $m->id ?? '' }}" >Remove</a>
                                                                    </div>
                                                            </div>
                                                            <div class="lp-info d-flex">
                                                                <div class="lp-img">
                                                                    <img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="...">
                                                                </div>
                                                                <div class="lp-text">
                                                                    <h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>{{ date('h:i A', strtotime($m->created_at)) }}</span></h6>
                                                                    @if(isset($m->message))
                                                                    <div class="lv-chat">
                                                                        <p class="b-text" id="message-text{{ $m->id ?? '' }}"><?php
                                                                         echo $m->message; ?></p>
                                                                    </div>
                                                                    @endif
                                                                    <form id="update-message{{ $m->id ?? '' }}" class="update-form" style="display:none;">
                                                                        @csrf
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" name="message" id="message-input{{ $m->id ?? '' }}">
                                                                            <div class="input-group-append">
                                                                                <input type="hidden" name="id" value="{{ $m->id ?? '' }}">
                                                                                <button type="submit" class="btn btn-success" type="submit">Send</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                    @foreach($filesarray as $array)
                                                                    <div class="lv-chat">
                                                                        <button><a href="{{ url(app()->getLocale().'/user-dashboard/download/'.$array) }}">{{ $array ?? '' }}</a></button>
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                
                                                            </div>
                                                            
                                                        </div>
                                                        @else
                                                        <div class="receiver-d message{{ $m->id ?? '' }}">
                                                            <!-- <div class="s-ryt-img">
                                                                <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"  class="img-fluid" alt="..."></span>
                                                                <span id="dropdownMenuButton{{ $m->id ?? '' }}" data-toggle="dropdown" aria-expanded="false"><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"  class="img-fluid" alt="..."></span>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $m->id ?? '' }}">
                                                                        <a class="dropdown-item edit-message" message-id="{{ $m->id ?? '' }}" >Edit</a>
                                                                        <a class="dropdown-item remove-message" message-id="{{ $m->id ?? '' }}" >Remove</a>
                                                                    </div>
                                                            </div> -->
                                                                <div class="lp-info d-flex">
                                                                    <div class="lp-img"><img src="{{ asset('logomax_pages/img/jord.png') }}"  class="img-fluid" alt="...">
                                                                    </div>
                                                                    <div class="lp-text">
                                                                        <h6>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }} <span>{{ date('h:i A', strtotime($m->created_at)) }}</span></h6>
                                                                        @if(isset($m->message))
                                                                        <div class="lv-chat">
                                                                            <p class="b-text" id="message-text{{ $m->id ?? '' }}"><?php echo $m->message;
                                                                            ?></p>
                                                                        </div>
                                                                        @endif
                                                                        @foreach($filesarray as $array)
                                                                        <div class="lv-chat">
                                                                            <button><a href="{{ url(app()->getLocale().'/user-dashboard/download/'.$array) }}">{{ $array ?? '' }}</a></button>
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                 </div>
                                                    </div>
                                                    @endif
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    @if($chat == true)
                                    <form action="" method="post" enctype="multipart/form-data" id="chatform">
                                        @csrf
                                    <input type="hidden" id="active_user" value="{{ $userdata->id ?? '' }}">
                                    <div class="write-msg d-flex justify-content-between">
                                        <div class="wrt-msg">
                                           <input id="message" placeholder="Write a messages....." />
                                        </div>
                                        <div class="atch-file">
                                                <ul class="list-unstyled">
                                                    <li><input type="file" name="files[]" id="attachment"></li>
                                                    <li><button type="submit" class="sendmessage btn btn-link"><img src="{{ asset('logomax_pages/img/send.svg') }}" class="img-fluid" alt="..."></button></li>
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
                                    <div>
                                        <p id="files-area">
                                            <span id="filesList">
                                                <span id="files-names"></span>
                                            </span>
                                        </p>
                                    </div>
                                    </form>
                                    @else
                                    <p>Your chat is closed Now!</p>
                                @endif
                                 </div>
                                
                           </div>
                        @endif
                       </div>
                     </div>
                   </div>
                   
                       </div>
                <script>
                    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

                $("#attachment").on('change', function(e){
                    for(var i = 0; i < this.files.length; i++){
                        let fileBloc = $('<span/>', {class: 'file-block'}),
                            fileName = $('<span/>', {class: 'name', text: this.files.item(i).name});
                        fileBloc.append('<span class="file-delete"><span class="px-4">X</span></span>')
                            .append(fileName);
                        $("#filesList > #files-names").append(fileBloc);
                    };
                    // Ajout des fichiers dans l'objet DataTransfer
                    for (let file of this.files) {
                        dt.items.add(file);
                    }
                    // Mise à jour des fichiers de l'input file après ajout
                    this.files = dt.files;

                    // EventListener pour le bouton de suppression créé
                    $('span.file-delete').click(function(){
                        let name = $(this).next('span.name').text();
                        // Supprimer l'affichage du nom de fichier
                        $(this).parent().remove();
                        for(let i = 0; i < dt.items.length; i++){
                            // Correspondance du fichier et du nom
                            if(name === dt.items[i].getAsFile().name){
                                // Suppression du fichier dans l'objet DataTransfer
                                dt.items.remove(i);
                                continue;
                            }
                        }
                        // Mise à jour des fichiers de l'input file après suppression
                        document.getElementById('attachment').files = dt.files;
                    });
                });
                </script>
                   
                       <script>
                        $(document).ready(function(){
                            active_user = $('#active_user').val();
                            $('#unseen_count'+active_user).html(0);
                            $('#chatform').on('submit',function(e){
                            e.preventDefault();
                            formdata = new FormData(this);
                            senderid = "{{ auth()->user()->id }}";
                            recieverid = "{{ $userdata->id ?? '' }}";
                            message = autoReadLinksAndEmails($('#message').val());

                            formdata.append("sender_id",senderid);
                            formdata.append('reciever_id',recieverid);
                            formdata.append('message',message);
                            $('#message').val('');
                            $('#files').val('');
                            $.ajax({
                            method: 'post',
                            url: "{{ url('user-dashboard/messagesProcc') }}",
                            data: formdata,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response){
                                file = response.files;
                                if(response.message != null){
                                    message_html = '<div class="lv-chat"><p class="b-text" id="message-text'+response[0].id+'" >'+message+'</p></div>';
                                }else{
                                    message_html = '';
                                }
                                fileshtml = [];
                                if(file.length != 0){
                                    $.each(file,function(key,value){
                                        filehtml = `<div class="lv-chat"><button><a href="{{ url(app()->getLocale().'/user-dashboard/download/${value}') }}">${value}</a></button></div>`;
                                        fileshtml.push(filehtml);
                                    });
                                }
                                form_html = `<form id="update-message${response[0].id}" class="update-form" style="display:none;">
                                                                        @csrf
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" class="form-control" name="message" id="message-input${response[0].id}">
                                                                            <div class="input-group-append">
                                                                                <input type="hidden" name="id" value="${response[0].id}">
                                                                                <button type="submit" class="btn btn-success" type="submit">Send</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>`;
                                buttons_html = `<div class="s-ryt-img">
                                                                    <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"  class="img-fluid" alt="..."></span>
                                                                    <span id="dropdownMenuButton${response[0].id}" data-toggle="dropdown" aria-expanded="false"><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"  class="img-fluid" alt="..."></span>
                                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton${response[0].id}">
                                                                        <a class="dropdown-item edit-message" message-id="${response[0].id}" message-text="${message}" >Edit</a>
                                                                        <a class="dropdown-item remove-message" message-id="${response[0].id}" >Remove</a>
                                                                    </div>
                                                            </div>`;
                                
                                message = `<div class="sender-d message${response[0].id}">${buttons_html}<div class="lp-info d-flex"><div class="lp-img"><img src="{{ asset('logomax_pages/img/lp-chat.png') }}"  class="img-fluid" alt="..."></div><div class="lp-text"><h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>${response.current_time}</span></h6>${message_html} ${form_html} ${fileshtml}</div></div></div>`;
                                $('#messagebox'+recieverid).append(message);
                                $("#chatboxuserslist"+active_user).load(location.href+" #chatboxuserslist"+active_user);
                            }
                            });
                        });
                    $("body").delegate('.remove-message','click',function(){
                        id = $(this).attr('message-id');
                        $('.message'+id).remove();
                        $.ajax({
                            method:'post',
                            url:'{{ url('user-dashboard/removeMessage') }}',
                            data: { message_id:id,_token:"{{ csrf_token() }}" },
                            success:function(repsonse){
                                console.log(repsonse);
                            }
                        })
                    });
                    $("body").delegate('.edit-message','click',function(){
                        id = $(this).attr('message-id');
                        $('#update-message'+id).show();
                        message = autoRemoveLinksAndEmails($(this).attr('message-text'));
                        $('#message-input'+id).val(message);
                    });
                    $('body').delegate('.update-form','submit',function(e){
                        e.preventDefault();
                        formdata = new FormData(this);
                        message = autoReadLinksAndEmails(formdata.get('message'));
                        formdata.set('message',message);
                        message_id = formdata.get('id');
                        $.ajax({
                            method: 'post',
                            url: "{{ url('user-dashboard/updateMessage') }}",
                            data: formdata,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response){
                                $('a[message-id="'+message_id+'"]').attr('message-text',message);
                               $('#message-text'+message_id).html(message); 
                               $('#update-message'+message_id).hide();
                            }
                            });

                    });

                    });
                        function autoReadLinksAndEmails(inputElement) {
                            const inputValue = inputElement;

                            // Regular expression to match URLs
                            const urlRegex = /(https?:\/\/[^\s]+)/g;
                            const messageWithLinks = inputValue.replace(urlRegex, '<a href="$1" target="_blank">$1</a>');

                            // Regular expression to match email addresses
                            const emailRegex = /(\S+@\S+\.\S+)/g;
                            const messageWithLinksAndEmails = messageWithLinks.replace(emailRegex, '<a href="mailto:$1">$1</a>');
                            return messageWithLinksAndEmails;
                        }
                        function autoRemoveLinksAndEmails(inputElement) {
                            const inputValue = inputElement;

                            // Regular expression to match URLs
                            const urlRegex = /(https?:\/\/[^\s]+)/g;
                            const messageWithLinks = inputValue.replace(urlRegex, '$1');

                            // Regular expression to match email addresses
                            const emailRegex = /(\S+@\S+\.\S+)/g;
                            const messageWithLinksAndEmails = messageWithLinks.replace(emailRegex, '$1');

                            // Remove HTML tags (including the mailto: part for emails)
                            const messageWithoutTags = messageWithLinksAndEmails.replace(/<\/?[^>]+(>|$)/g, '');

                            return messageWithoutTags;
                        }
                       </script>
@endsection
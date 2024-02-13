@extends('special_designer_layout.master')
@section('content')
<style>
    #files-area{
	width: 30%;
	margin: 0 auto;
}
.file-block{
	border-radius: 10px;
	background-color: rgba(144, 163, 203, 0.2);
	margin: 5px;
	color: initial;
	display: inline-flex;
	& > span.name{
		padding-right: 10px;
		width: max-content;
		display: inline-flex;
	}
}
.file-delete{
	display: flex;
	width: 24px;
	color: initial;
	background-color: #6eb4ff00;
	font-size: large;
	justify-content: center;
	margin-right: 3px;
	cursor: pointer;
	&:hover{
		background-color: rgba(144, 163, 203, 0.2);
		border-radius: 10px;
	}
	& > span{
		transform: rotate(45deg);
	}
}

</style>
<div class="nk-content mt-5">
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
                                                        <a class="chat-link " href="{{ url('internal-designer/messages/'.base64_encode($user->email) ?? '') }}">
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
                                        <?php 
                                        $files = $m->files;
                                        if($files != null){
                                            $filesarray = json_decode($files);
                                        }else{
                                            $filesarray = [];
                                        }
                                        ?>
                                            @if($m->reciever_id == auth()->user()->id)
                                            <div class="chat is-you message{{ $m->id ?? '' }}">
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        @if(isset($m->message))
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg message-box{{ $m->id ?? '' }}"> <?php echo $m->message; ?> </div>
                                                        </div>
                                                        @endif
                                                        @foreach($filesarray as $array)
                                                        <div class="file-box" file-name ="{{ $array ?? '' }}">
                                                                <button type="button" image-name="{{ $array ?? '' }}" class="download-file"><a href="{{ url('internal-designer/download-file/'.$array) }}">{{ $array ?? '' }}</a></button>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <ul class="chat-meta">
                                                        <li>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}</li>
                                                        <li>{{ date('h:i A', strtotime($m->created_at)) }}</li>
                                                    </ul>
                                                    
                                                </div>
                                            </div>
                                            @else
                                            <div class="chat is-me message{{ $m->id ?? '' }}">
                                                <div class="chat-content">
                                                    <div class="chat-bubbles">
                                                        @if(isset($m->message))
                                                        <div class="chat-bubble">
                                                            <div class="chat-msg message-box{{ $m->id ?? '' }}"> <?php echo $m->message; ?> </div>
                                                        </div>
                                                        @endif
                                                        @foreach($filesarray as $array)
                                                            <div class="file-box d-flex justify-content-between" file-name ="{{ $array ?? '' }}">
                                                                <button type="button" image-name="{{ $array ?? '' }}" class="download-file"><a href="{{ url('internal-designer/download-file/'.$array) }}" >{{ $array ?? '' }} </a></button>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <form  class="update-form" id="message-update{{ $m->id ?? '' }}" style="display:none;">
                                                    @csrf
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="message-input{{ $m->id ?? '' }}" name="message">
                                                            <div class="input-group-append">
                                                                <input type="hidden" name="id" value="{{ $m->id ?? '' }}">
                                                                <button type="submit" class="btn btn-outline-primary btn-dim"><em class="icon ni ni-send-alt"></em></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                    <ul class="chat-meta">
                                                        <li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li>
                                                        <li>{{ date('h:i A', strtotime($m->created_at)) }}</li>
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    @if(isset($m->message))
                                                                    <li><a class="edit-message" message-text="{{ $m->message ?? '' }}" message-id="{{ $m->id ?? '' }}">Edit</a></li>
                                                                    @endif
                                                                    <li><a class="remove-message" message-id="{{ $m->id ?? '' }}">Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                           </div>
                                        </div><!-- .nk-chat-panel -->
                                        @if($chat == true)
                                        <form action="chat-form" id="chat-form" action="enctype/multipart-formdata">
                                            @csrf
                                        <div class="nk-chat-editor">
                                            <div class="nk-chat-editor-upload  ms-n1">
                                                <a href="#" class="btn btn-sm btn-icon btn-trigger text-primary toggle-opt" data-target="chat-upload"><em class="icon ni ni-plus-circle-fill"></em></a>
                                                <div class="chat-upload-option" data-content="chat-upload">
                                                    <ul class="">
                                                        <li>
                                                            <label for="attachment">
                                                                <a><em class="icon ni ni-img-fill"></em></a>
                                                            </label>
                                                            <input type="file" name="file[]" id="attachment" style="display:none;">
                                                        </li>
                                                        <!-- <li><a href="#"><em class="icon ni ni-camera-fill"></em></a></li>
                                                        <li><a href="#"><em class="icon ni ni-mic"></em></a></li>
                                                        <li><a href="#"><em class="icon ni ni-grid-sq"></em></a></li> -->
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="nk-chat-editor-form">
                                                <div class="form-control-wrap">
                                                    <textarea class="form-control form-control-simple no-resize" id="message" name="message" rows="1" id="default-textarea" placeholder="Type your message..."></textarea>
                                                </div>
                                                <div>
                                                    <p id="files-area">
                                                        <span id="filesList">
                                                            <span id="files-names"></span>
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                            <ul class="nk-chat-editor-tools g-2">
                                              
                                                <li>
                                                    <button class="btn btn-round btn-primary btn-icon" type="submit" id="send"><em class="icon ni ni-send-alt"></em></button>
                                                </li>
                                                
                                            </ul>
                                          
                                        </div><!-- .nk-chat-editor -->
                                        </form>
                                        @else
                                        <p>Now Your are not able chat here.</p>
                                        @endif
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
                                @endif
                                </div><!-- .nk-chat -->
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
                fileBloc.append('<span class="file-delete"><span class="px-4">+</span></span>')
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
                    $('#unseenmessage_count'+active_user).html(0);
               
                    $('#chat-form').on('submit',function(e){
                        e.preventDefault();
                        formdata = new FormData(this);
                        messagetext = autoReadLinksAndEmails($('#message').val());
                        formdata.append('messagesend',messagetext);
                        formdata.append('reciever_id',"{{ $userdata->id ?? '' }}");
                        $('#message').val('');
                        $.ajax({
                            method: 'post',
                            url: "{{ url('special-designer/messagesProcc') }}",
                            data: formdata,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response){
                            
                                files = response.files;
                                $('#files-names').html('');
                                $('#attachment').val('');
                                if(response.message != null){
                                    text_html = '<div class="chat-bubble"><div class="chat-msg message-box'+response[0].id+'" > '+messagetext+'</div></div>';
                                }else{
                                    text_html = '';
                                }
                                fileshtml = [];
                                if(files.length != 0){
                                    $.each(files, function(key,value){
                                        filehtml = `<div class="file-box d-flex justify-content-between" file-name ="${value}">
                                                                <button type="button" image-name="${value}" class="download-file"><a href="{{ url('internal-designer/download-file/${value}') }}">${value}</a></button>
                                                    </div>`;
                                        fileshtml.push(filehtml);
                                    });
                                }
                                form_html = `<form  class="update-form" id="message-update${response[0].id}" style="display:none;">
                                                    @csrf
                                                    <div class="form-control-wrap">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" id="message-input${response[0].id}" name="message">
                                                            <div class="input-group-append">
                                                                <input type="hidden" name="id" value="${response[0].id}">
                                                                <button type="submit" class="btn btn-outline-primary btn-dim"><em class="icon ni ni-send-alt"></em></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>`;
                                edit_dropdown = `<div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a class="edit-message" message-id="${response[0].id}" message-text="${messagetext}">Edit</a></li>
                                                                    <li><a class="remove-message" message-id="${response[0].id}">Remove</a></li>
                                                                
                                                                </ul>
                                                            </div>
                                                        </div>`;
                                html = '<div class="chat is-me message'+response[0].id+'"><div class="chat-content"><div class="chat-bubbles">'+ text_html +' '+fileshtml+' </div> '+form_html+' <ul class="chat-meta"><li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li><li>'+response.current_time+'</li>'+edit_dropdown+'</ul></div></div>';
                                $('#chatbox{{ $userdata->id  ?? '' }}').append(html);
                                $("#userchatlist"+active_user).load(location.href+" #userchatlist"+active_user);
                            }
                        });
                    });

                    $('body').delegate('.remove-message','click',function(){
                        message_id = $(this).attr('message-id');
                        $('.message'+message_id).remove();
                        $.ajax({
                            method:'post',
                            url: '{{  url('special-designer/deleteMessage') }}',
                            data: { message_id:message_id,_token:"{{ csrf_token() }}" },
                            success:function(response){
                                console.log(response);
                            }
                        })
                    });
                    $("body").delegate('.edit-message','click',function(){
                        message_id = $(this).attr('message-id');
                        $('#message-update'+message_id).show();
                        message_text = autoRemoveLinksAndEmails($(this).attr('message-text'));
                        $('#message-input'+message_id).val(message_text);

                    });
                    // $('.update-form').on('submit',function(e){
                    $("body").delegate('.update-form','submit',function(e){
                        e.preventDefault();
                        formdata = new FormData(this);
                        message = autoReadLinksAndEmails(formdata.get('message'));
                        formdata.set('message',message);
                        message_id = formdata.get('id');
                        $.ajax({
                            method: 'post',
                            url: "{{ url('special-designer/updateMessage') }}",
                            data: formdata,
                            dataType: 'json',
                            contentType: false,
                            processData: false,
                            success: function(response){
                                $('a[message-id="'+message_id+'"]').attr('message-text',message);
                                $('.message-box'+message_id).html(message); 
                                $('#message-update'+message_id).hide();
                            }
                        });
                    })
                });
        </script>

         <script>
                //     $(document).ready(function(){
                //         $('#send').on('click',function(){
                           
                //             message = $('#message').val();
                //             if(message == '' || message == null){
                //                 return false;
                //             }
                //             senderid = "{{ auth()->user()->id ?? '' }}";
                //             recieverid = "{{ $userdata->id ?? '' }}";
                //             $("#chatbox"+recieverid).scrollTop(1000);
                //            $.ajax({
                //             method: 'post',
                //             url: "{{ url('special-designer/messagesProcc') }}",
                //             data: { message:message,sender_id:senderid,reciever_id:recieverid,_token:"{{ csrf_token() }}" },
                //             success: function(response){
                            //     html = '<div class="chat is-me"><div class="chat-content"><div class="chat-bubbles"><div class="chat-bubble"><div class="chat-msg"> '+message+'</div></div></div><ul class="chat-meta"><li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li><li>29 Apr, 2020 4:12 PM</li></ul></div></div>';
                            //    $('#chatbox'+recieverid).append(html);
                            //    $('#message').val('');
                //             }
                //            })
                //         });
                //     });
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
                <!-- <script>
                    $('.download-file').on('click',function(){
                        filename = $(this).attr('image-name');
                        $.ajax({
                            method: 'post',
                            url: "{{ url('download-file') }}",
                            data: { filename:filename,_token:"{{ csrf_token() }}" },
                            success: function(response){
                                // console.log(response);
                            }
                        });
                    });
                </script> -->
                
@endsection
@extends('special_designer_layout.master')
@section('content')
<style>
    
.nk-content {
  padding: 8px;
}
.nk-chat-head {
  padding: 13px 30px;
}
.nk-chat-editor {
  padding: 10px 30px;
}
.nk-content-body {
  height: 500px;
}
.nk-chat-panel {
  height: 368px;
  overflow-y: scroll;
}

.nk-content {
  margin-top: 65px;
}

.chat-msg a {
  color: #fffbfb;
  text-decoration: underline;
}
.is-you .chat-msg  a {
  color: #0d5ad2;
  text-decoration: underline;
}
</style>
<?php 
    // use Carbon\Carbon;
    $first_name = $taskDetails->order->user->first_name ;
    $last_name = $taskDetails->order->user->last_name ;
    $first_name_frstChar =  strtoupper(mb_substr($first_name, 0, 1));
    $last_name_frstChar = strtoupper(mb_substr($last_name, 0, 1));
    $fullName = $first_name . ' '. $last_name;
    $shortName = $first_name_frstChar.$last_name_frstChar;
    $customerEmail = $taskDetails->order->user->email ;
    $customerID = $taskDetails->order->user->id ;
    $recieverID = auth()->user()->id;
    $recieverName = auth()->user()->first_name . ' ' . auth()->user()->last_name;
    
    // dd($taskDetails);
    // dd($recieverID , $customerID);
?>

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <!-- <div class="nk-block-head nk-block-head-sm"> -->
                    <!-- <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Task Details -</h3>
                        </div>
                        <div>
                            
                        </div>
                    </div> -->
                <!-- </div> -->
                <!-- Task Details  -->
                <!-- ###################################### Chat  ###################################### -->
                <div class="nk-chat-body">
                    <div class="nk-chat-head">
                        <ul class="nk-chat-head-info">
                            <li class="nk-chat-body-close">
                                <a href="#" class="btn btn-icon btn-trigger nk-chat-hide ms-n1"><em class="icon ni ni-arrow-left"></em></a>
                            </li>
                            <li class="nk-chat-head-user">
                                <div class="user-card">
                                    <div class="user-avatar bg-purple">
                                        <span>{{ $shortName }}</span>
                                    </div>
                                    <div class="user-info">
                                        <div class="lead-text">{{ $fullName ?? '' }}</div>
                                        <!-- <div class="sub-text"><span class="d-none d-sm-inline me-1">Active </span> 35m ago</div> -->
                                    </div>
                                </div>
                            </li>
                            <li class="nk-chat-head-user">
                                <div class="user-card">
                                    <div class="text text-info">
                                        <span style="text-transform: capitalize;"><strong>{{ $taskDetails->what_you_revised }}</strong></span> revision request.
                                    </div>
                                </div>
                            </li>
                        </ul>
                      
                        

                        <ul class="nk-chat-head-tools">
                            @if($taskDetails->what_you_revised == 'favicon')
                                <li><a href="{{ url('special-designer/download/'.$taskDetails->logoDetail->media->id) }}" class="btn btn-danger" style="text-transform: capitalize;">Download Original Logo</a></li>
                                @if($last_accepted_revision)
                                <li><a href="{{ url('special-designer/download/'.$last_accepted_revision->updates_by_designer) }}" class="btn btn-danger" style="text-transform: capitalize;">Download Changed Logo</a></li>
                                @endif
                            @else
                            @if($last_accepted_revision)
                                <li><a href="{{ url('special-designer/download/'.$last_accepted_revision->updates_by_designer) }}" class="btn btn-danger" style="text-transform: capitalize;">Download  {{$taskDetails->what_you_revised}}</a></li>
                            @else
                                <li><a href="{{ url('special-designer/download/'.$taskDetails->logoDetail->media->id) }}" class="btn btn-danger" style="text-transform: capitalize;">Download  {{$taskDetails->what_you_revised}}</a></li>
                            @endif
                            @endif
                            <!-- <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-call-fill"></em></a></li>
                            <li><a href="#" class="btn btn-icon btn-trigger text-primary"><em class="icon ni ni-video-fill"></em></a></li> -->
                          
                            <!-- <li class="d-none d-sm-block">
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger text-primary" data-bs-toggle="dropdown"><em class="icon ni ni-more"></em></a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <ul class="link-list-opt no-bdr">
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-archive"></em><span>Make as Archive</span></a></li>
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-cross-c"></em><span>Remove Conversion</span></a></li>
                                            <li><a class="dropdown-item" href="#"><em class="icon ni ni-setting"></em><span>More Options</span></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li> -->
                            <!-- <li class="me-n1 me-md-n2"><a href="#" class="btn btn-icon btn-trigger text-primary chat-profile-toggle"><em class="icon ni ni-alert-circle-fill"></em></a></li> -->
                        </ul>
                    </div><!-- .nk-chat-head -->
                    <div class="nk-chat-panel"  style="display:flex; flex-direction:column-reverse;">
                        @if(!empty($allMessages))
                        <div id="chatbox{{ $customerID ?? '' }}">  
                            @foreach($allMessages as $ind => $message )
                            <?php 
                                /////////////// Get files ///////////////

                                $files = $message->files;

                                if($files != null){
                                    $filesarray = json_decode($files);
                                }else{
                                    $filesarray = [];
                                }
                                
                                ////////////////////////////////////////
                                
                                $chatDates = $message->created_at;
                                $timestampNew = strtotime($chatDates);
                                $formattedDate = date("d M ,Y",$timestampNew);
                                $chatDatesNew[] =$formattedDate; 
                                $dateArr = array_unique($chatDatesNew);
                         
                            ?>
                            @foreach($dateArr as $indDate =>  $dateA)
                                @if($indDate == $ind)
                                <div class="chat-sap">
                                    <div class="chat-sap-meta"><span>{{ $dateA }}</span></div>
                                </div>
                                @endif
                            @endforeach
                            @if($message->reciever_id == $recieverID)
                                <!-- Chat is yours -->
                                <div class="chat is-you message{{ $message->id ?? '' }}">
                                    <div class="chat-avatar">
                                        <div class="user-avatar bg-purple">
                                        
                                            <span>{{ $shortName }}</span>
                                        </div>
                                    </div>
                                    <div class="chat-content">
                                        @if($message->message !== null || !empty($message->message))
                                        <div class="chat-bubbles">
                                            <div class="chat-bubble">
                                                <div class="chat-msg message-box{{ $message->id ?? '' }}">  <?php echo $message->message; ?> </div>
                                                <ul class="chat-msg-more">
                                                    <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"></a></li>
                                                    <!-- <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <li><a class="edit-message" message-text="{{ $message->message ?? '' }}" message-id="{{ $message->id ?? '' }}"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                                                    <li><a  class="remove-message" message-id="{{ $message->id ?? '' }}"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li> -->
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        @foreach($filesarray as $array)
                                        <div class="file-box" file-name ="{{ $array ?? '' }}">
                                                <button type="button" image-name="{{ $array ?? '' }}" class="download-file"><a href="{{ url('internal-designer/download-file/'.$array) }}">{{ $array ?? '' }}</a></button>
                                        </div>
                                        @endforeach
                                        <?php 
                                        $messageTime = $message->created_at;
                                        $timestamp = strtotime($messageTime);
                                        // $formattedDate = date("d M, Y g:i A", $timestamp);  
                                        $formattedDate = date("g:i A", $timestamp);  
                                        ?>
                                        <ul class="chat-meta">
                                            <li>{{ $fullName ?? '' }}</li>
                                            <li>{{ $formattedDate }}</li>
                                        </ul>
                                    </div>
                                </div><!-- .chat -->
                                <!-- End -->
                                @else
                                <!-- Chat is Mine Sender -->
                                <div class="chat is-me message{{ $message->id ?? '' }}">
                                    <div class="chat-content">
                                        @if($message->message !== null || !empty($message->message))
                                        <div class="chat-bubbles">
                                            <div class="chat-bubble">
                                                <div class="chat-msg message-box{{ $message->id ?? '' }}"> <?php echo $message->message; ?> </div>
                                                <ul class="chat-msg-more">
                                                    <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"></a></li>
                                                    <li>
                                                        <div class="dropdown">
                                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-sm">
                                                                <ul class="link-list-opt no-bdr">
                                                                    <!-- <li class="d-sm-none"><a href="#"><em class="icon ni ni-reply-fill"></em> Reply</a></li> -->
                                                                    <li><a  class="edit-message" message-text="{{ $message->message ?? '' }}" message-id="{{ $message->id ?? '' }}"><em class="icon ni ni-pen-alt-fill"></em> Edit</a></li>
                                                                    <li><a class="remove-message" message-id="{{ $message->id ?? '' }}"><em class="icon ni ni-trash-fill"></em> Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                        @foreach($filesarray as $array)
                                        <div class="file-box d-flex justify-content-between" file-name ="{{ $array ?? '' }}">
                                            <button type="button" image-name="{{ $array ?? '' }}" class="download-file"><a href="{{ url('internal-designer/download-file/'.$array) }}" >{{ $array ?? '' }} </a></button>
                                        </div>
                                        @endforeach
                                        <!--  Edit form  -->
                                        <form  class="update-form" id="message-update{{ $message->id ?? '' }}" style="display:none;">
                                            @csrf
                                            <div class="form-control-wrap">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="message-input{{ $message->id ?? '' }}" name="message">
                                                    <div class="input-group-append">
                                                        <input type="hidden" name="id" value="{{ $message->id ?? '' }}">
                                                        <button type="submit" class="btn btn-outline-primary btn-dim"><em class="icon ni ni-send-alt"></em></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <?php 
                                            $messageTime = $message->created_at;
                                            $timestamp = strtotime($messageTime);
                                            $formattedDate = date("g:i A", $timestamp);  
                                        ?>
                                        <ul class="chat-meta">
                                            <li>{{ $recieverName }}</li>
                                            <li>{{ $formattedDate }}</li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- End -->
                                @endif
                            @endforeach
                            <!-- .chat -->
                        </div>
                        @endif
                    </div><!-- .nk-chat-panel -->
                    <form action="chat-form" id="chat-form" action="enctype/multipart-formdata">
                        @csrf
                        <div class="nk-chat-editor">
                            @if($taskDetails->status == 0)
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
                                    <textarea class="form-control form-control-simple no-resize" rows="1"  id="message" name="message" placeholder="Type your message..."></textarea>
                                    <p id="files-area">
                                        <span id="filesList">
                                            <span id="files-names"></span>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            @endif
                            <ul class="nk-chat-editor-tools g-2">
                                @if($taskDetails->status == 0)
                                <li>
                                    <button class="btn btn-round btn-primary btn-icon"  type="submit" id="send"><em class="icon ni ni-send-alt"></em></button>
                                </li>
                                <li>
                                    <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUploadImage" style="text-transform: capitalize;">Upload {{ $taskDetails->what_you_revised }} with changes</button>
                                </li>
                                @elseif($taskDetails->status == 1)
                                <li>
                                    <div class="text text-success p-2">Your job is approved.</div>
                                </li>
                                @elseif($taskDetails->status == 2)
                                <li>
                                    <div class="text text-info p-2">Wait for approval</div>
                                </li>
                                @endif
                            </ul>
                        </div><!-- .nk-chat-editor -->
                    </form>
                </div><!-- .nk-chat-body -->
                <!-- ######################################  Chat box end ###################################### -->
                <!-- End -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for uploda image  -->

<div class="modal fade" tabindex="-1" id="modalUploadImage">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Upload Icons</h5>
            </div>
            <form action="{{ url('special-designer/upload-icon') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="revision_id" value="{{ $taskDetails->id }}">
                <div class="modal-body">
                    <div class="form-file">
                        @if($taskDetails->what_you_revised == 'favicon')
                            <input type="file" class="form-file-input" name="icon_list[]" multiple id="customMultipleFiles">
                        @else
                            <input type="file" class="form-file-input" name="icon_list" id="customMultipleFiles">
                        @endif
                        <label class="form-file-label" for="customMultipleFiles">Choose files</label>
                    </div>
                </div>
             
                <div class="modal-footer bg-light">
                    <button class="text text-light btn btn-primary"  type="submit">Submit Job</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal end -->
<script>
      
</script>
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
    $('body').delegate('.deleteimage','click',function(e){
        e.preventDefault();
        mediaid = $(this).attr('data-id');
        imagename = $(this).attr('image-name');
    // console.log(imagename);
        $.ajax({
            method: 'post',
            url: "{{ url('special-designer/delete-image') }}",
            data: { mediaid:mediaid,imagename:imagename,_token:"{{ csrf_token() }}" },
            dataType: 'json',
            success: function(response)
            {
                html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
                $('.upload-zone').html(html);
                $('.upload-zone').removeClass('dz-started');
            }
        })
    })
</script>

<script>
    //////////// Send Message //////////////   

    $(document).ready(function(){
        active_user = $('#active_user').val();
        $('#unseenmessage_count'+active_user).html(0);
    
        $('#chat-form').on('submit',function(e){
            e.preventDefault();
            formdata = new FormData(this);
            messagetext = autoReadLinksAndEmails($('#message').val());
            formdata.append('messagesend',messagetext);
            formdata.append('reciever_id',"{{ $customerID ??'' }}");
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
                        text_html = '<div class="chat-msg message-box'+response[0].id+'" > '+messagetext+'</div>';
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
                    edit_dropdown = `<ul class="chat-msg-more">
                                        <li class="d-none d-sm-block"><a href="#" class="btn btn-icon btn-sm btn-trigger"></a></li>
                                        <li>
                                            <div class="dropdown">
                                            <a href="#" class="btn btn-icon btn-sm btn-trigger dropdown-toggle" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                <div class="dropdown-menu dropdown-menu-sm">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a class="edit-message" message-id="${response[0].id}" message-text="${messagetext}"><em class="icon ni ni-pen-alt-fill"></em>Edit</a></li>
                                                        <li><a class="remove-message" message-id="${response[0].id}"><em class="icon ni ni-trash-fill"></em>Remove</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>`;
         
                    html = '<div class="chat is-me message'+response[0].id+'"><div class="chat-content"><div class="chat-bubbles"><div class="chat-bubble">'+ text_html + edit_dropdown+'</div></div>'+ fileshtml + form_html + '<ul class="chat-meta"><li>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</li><li>'+response.current_time+'</li></ul></div></div>';

                    $('#chatbox{{ $customerID  ?? '' }}').append(html);
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

    ///////////////////////////////////////


    // Funcitons///////////////////

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

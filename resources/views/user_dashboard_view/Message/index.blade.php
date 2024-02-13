@extends('user_dashboard_layout.master_layout')
@section('content')
<style>
    .msg-content .lp-img {
        width: 50px;
        min-width: 50px;
        height: 50px;
        width: 50px;
        background: #4cce69;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        font-weight: 700;
    }
    .msg-content .myBox{
        background: #18181f;
    }
    .lp-img.chatbox {
        min-width: 47px;
        height: 47px;
        width: 47px;
    }

    .receiver-d {
        padding : 10px 30px;
    }
    .sender-d{
        padding : 10px 30px;
    }
</style>
<div class="msg-content ">
    <div class="row  row1">
        @if($userdata)
        <?php 
            $user_fname = $userdata->first_name; 
            $user_lname = $userdata->last_name;
            $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 1));
            $last_name_frstChar = strtoupper(mb_substr($user_lname, 0, 1));
            if(empty($last_name_frstChar)){
                $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 2));
            }
            $senderShortName = $first_name_frstChar.$last_name_frstChar;
            $recieverShorterName = '';
            // $messageAt = $message->created_at;
            // $dateObj = Carbon::parse($messageAt);
            // $messageFormatedTime =  $dateObj->format('d-M , H:i');
        ?>
        <div class="col-lg-12 col-md-12 userbox user{{ $userdata->id ?? '' }} ">
            <div class="msg-ryt">
                <div class="msg-ryt-head">
                    <div class="lp-info d-flex">
                        <div class="lp-img headBox">{{ $senderShortName }}</div>
                        <div class="lp-text">
                            <h6>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }} </h6>
                            <!-- <span>Online</span> -->
                        </div>
                    </div>
                    <div class="cntc-i">
                        <ul class="list-unstyled d-flex">
                            <!-- <li><img src="{{ asset('logomax_pages/img/phn-img.svg') }}" class="img-fluid" alt=".."></li>
                            <li><img src="{{ asset('logomax_pages/img/ingo.svg') }}" class="img-fluid" alt=".."></li> -->
                        </ul>
                    </div>
                </div>
                <div class="msg-live-chat">
                    <div id="wrapper">
                        <div class="scrollbar" id="style-15">
                            <div class="force-overflow" id="messagebox{{ $userdata->id ?? '' }}">
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
                                <?php 
                                    $user_fname = auth()->user()->first_name; 
                                    $user_lname = auth()->user()->last_name;
                                    $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 1));
                                    $last_name_frstChar = strtoupper(mb_substr($user_lname, 0, 1));
                                    if(empty($last_name_frstChar)){
                                        $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 2));
                                    }
                                    $recieverShorterName = $first_name_frstChar.$last_name_frstChar;

                                    // $messageAt = $message->created_at;
                                    // $dateObj = Carbon::parse($messageAt);
                                    // $messageFormatedTime =  $dateObj->format('d-M , H:i');
                                ?>
                                <div class="sender-d message{{ $m->id ?? '' }}">
                                    <div class="s-ryt-img">
                                        <!-- <span class="str"><img src="{{ asset('logomax_pages/img/star.svg') }}"
                                                class="img-fluid" alt="..."></span> -->
                                        <span id="dropdownMenuButton{{ $m->id ?? '' }}" data-toggle="dropdown"
                                            aria-expanded="false"><img src="{{ asset('logomax_pages/img/h-dot.svg') }}"
                                                class="img-fluid" alt="..."></span>
                                        <div class="dropdown-menu"
                                            aria-labelledby="dropdownMenuButton{{ $m->id ?? '' }}">
                                            <a class="dropdown-item edit-message" message-text="{{ $m->message ?? '' }}"
                                                message-id="{{ $m->id ?? '' }}">Edit</a>
                                            <a class="dropdown-item remove-message"
                                                message-id="{{ $m->id ?? '' }}">Remove</a>
                                        </div>
                                    </div>
                                    <div class="lp-info d-flex">
                                        <div class="lp-img myBox chatbox">
                                            {{ $recieverShorterName }}
                                        </div>
                                        <div class="lp-text">
                                            <h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>{{ date('h:i A', strtotime($m->created_at)) }}</span></h6>
                                            @if(isset($m->message))
                                            <div class="lv-chat">
                                                <p class="b-text" id="message-text{{ $m->id ?? '' }}">
                                                    <?php echo $m->message; ?>
                                                </p>
                                            </div>
                                            @endif
                                            <form id="update-message{{ $m->id ?? '' }}" class="update-form"
                                                style="display:none;">
                                                @csrf
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="message"
                                                        id="message-input{{ $m->id ?? '' }}">
                                                    <div class="input-group-append">
                                                        <input type="hidden" name="id" value="{{ $m->id ?? '' }}">
                                                        <button type="submit" class="btn btn-success"
                                                            type="submit">Send</button>
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
                                    <div class="lp-info d-flex">
                                        <div class="lp-img chatbox">
                                            {{ $senderShortName }}
                                        </div>
                                        <div class="lp-text">
                                            <h6>{{ $userdata->first_name ?? '' }} {{ $userdata->last_name ?? '' }}
                                                <span>{{ date('h:i A', strtotime($m->created_at)) }}</span></h6>
                                            @if(isset($m->message))
                                            <div class="lv-chat">
                                                <p class="b-text" id="message-text{{ $m->id ?? '' }}">
                                                    <?php echo $m->message; ?>
                                                </p>
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
            </div>
        </div>
        @endif
    </div>
</div>
</div>
</div>
<!-- <script>
    const dt = new DataTransfer(); // Permet de manipuler les fichiers de l'input file

    $("#attachment").on('change', function (e) {
        for (var i = 0; i < this.files.length; i++) {
            let fileBloc = $('<span/>', { class: 'file-block' }),
                fileName = $('<span/>', { class: 'name', text: this.files.item(i).name });
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
        $('span.file-delete').click(function () {
            let name = $(this).next('span.name').text();
            // Supprimer l'affichage du nom de fichier
            $(this).parent().remove();
            for (let i = 0; i < dt.items.length; i++) {
                // Correspondance du fichier et du nom
                if (name === dt.items[i].getAsFile().name) {
                    // Suppression du fichier dans l'objet DataTransfer
                    dt.items.remove(i);
                    continue;
                }
            }
            // Mise à jour des fichiers de l'input file après suppression
            document.getElementById('attachment').files = dt.files;
        });
        
    });
</script> -->

<script>
    $(document).ready(function () {
        active_user = $('#active_user').val();
        $('#unseen_count' + active_user).html(0);
        $('#chatform').on('submit', function (e) {
            e.preventDefault();
            formdata = new FormData(this);
            senderid = "{{ auth()->user()->id }}";
            recieverid = "{{ $userdata->id ?? '' }}";
            message = autoReadLinksAndEmails($('#message').val());

            formdata.append("sender_id", senderid);
            formdata.append('reciever_id', recieverid);
            formdata.append('message', message);
            $('#message').val('');
            $('#files').val('');
            $.ajax({
                method: 'post',
                url: "{{ url('user-dashboard/messagesProcc') }}",
                data: formdata,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function (response) {
                    file = response.files;
                    if (response.message != null) {
                        message_html = '<div class="lv-chat"><p class="b-text" id="message-text' + response[0].id + '" >' + message + '</p></div>';
                    } else {
                        message_html = '';
                    }
                    fileshtml = [];
                    if (file.length != 0) {
                        $.each(file, function (key, value) {
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

                    message = `<div class="sender-d message${response[0].id}">${buttons_html}<div class="lp-info d-flex"><div class="lp-img  myBox chatbox"> {{ $recieverShorterName }} </div><div class="lp-text"><h6>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} <span>${response.current_time}</span></h6>${message_html} ${form_html} ${fileshtml}</div></div></div>`;
                    $('#messagebox' + recieverid).append(message);
                    $("#chatboxuserslist" + active_user).load(location.href + " #chatboxuserslist" + active_user);
                }
            });
        });
        $("body").delegate('.remove-message', 'click', function () {
            id = $(this).attr('message-id');
            $('.message' + id).remove();
            $.ajax({
                method: 'post',
                url: '{{ url('user- dashboard / removeMessage') }}',
                data: { message_id: id, _token: "{{ csrf_token() }}" },
                success: function (repsonse) {
                    console.log(repsonse);
                }
                        })
    });
    $("body").delegate('.edit-message', 'click', function () {
        id = $(this).attr('message-id');
        $('#update-message' + id).show();
        message = autoRemoveLinksAndEmails($(this).attr('message-text'));
        $('#message-input' + id).val(message);
    });
    $('body').delegate('.update-form', 'submit', function (e) {
        e.preventDefault();
        formdata = new FormData(this);
        message = autoReadLinksAndEmails(formdata.get('message'));
        formdata.set('message', message);
        message_id = formdata.get('id');
        $.ajax({
            method: 'post',
            url: "{{ url('user-dashboard/updateMessage') }}",
            data: formdata,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (response) {
                $('a[message-id="' + message_id + '"]').attr('message-text', message);
                $('#message-text' + message_id).html(message);
                $('#update-message' + message_id).hide();
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
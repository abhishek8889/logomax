@extends('user_dashboard_layout.master_layout')
@section('content')
<!-- <div class="">
    {{-- Breadcrumbs::render('user-dashboard',app()->getlocale()) --}}
</div> -->
<?php 
use Carbon\Carbon;
?>
<div class="row row2">
    <h4>Dashboard</h4>
    <div class="col-lg-6 col-md-6">
        <div class="wlcm-txt">
            <!-- <p class="wl-txt">Hello <strong>{{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? ''
                    }}</strong>(not {{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }} ?
                <strong> <a href="{{ url('logout') }}">Log out</a></strong>)
                From your account dashboard you can view your current membership,
                manage your <strong>password</strong> and <strong>account details</strong>
            </p> -->
        </div>
    </div>
    <div class="col-lg-6 col-md-6">
        <div class="recently-chat">
            <h4 class="align-content-center">Recent Messages</h4>
            <div id="wrapper">
                <div class="scrollbar" id="style-15">
                    <div class="force-overflow">
                        <ul class="list-unstyled mb-0 ">
                            <!-- Recent Message List -->
                            @foreach($users as $user)
                            <?php 
                            $message = App\Models\Message::where([['sender_id',$user->id],['reciever_id',Auth::user()->id]])->orWhere([['sender_id',Auth::user()->id],['reciever_id',$user->id]])->orderBy('created_at','DESC')->first();
                            //  dd($message)
                            // $order_between_us = App\Models\LogoRevision::where('user_id',$user->id);
                            $desingermessage = App\Models\Message::where([['sender_id',$user->id],['reciever_id',Auth::user()->id]])->orderBy('created_at','DESC')->first();
                    
                            $user_fname = $user->first_name; 
                            $user_lname = $user->last_name;
                            $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 1));
                            $last_name_frstChar = strtoupper(mb_substr($user_lname, 0, 1));
                            if(empty($last_name_frstChar)){
                                $first_name_frstChar =  strtoupper(mb_substr($user_fname, 0, 2));
                            }
                             $shortName = $first_name_frstChar.$last_name_frstChar;
                            $messageAt = $message->created_at;
                            $dateObj = Carbon::parse($messageAt);
                            $messageFormatedTime =  $dateObj->format('d-M , H:i');
                            ?>
                            <li class="recent-chat  py-0" userid="{{ $user->id ?? '' }}">
                                <!-- <a href="{{ url(app()->getlocale().'/user-dashboard/messages/'.base64_encode($user->email) ?? '') }}"> -->
                                <div class="main-box">
                                    <div class="chat-listing">
                                        <div class="chat-content">
                                            <div class="p-img">{{ $shortName }}</div>
                                            <div class="p-chat">
                                                <p class="b-text">{{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="chat-t">
                                            <span>{{ $messageAt->diffForHumans() }}</span>
                                            <span class="num-chat" id="unseen_count{{ $user->id ?? '' }}">{{
                                                count($user->unseenmessages) ?? 0 }}</span>
                                        </div>
                                    </div>
                                    <!-- <div class="text hover-text">
                                        <p>open chat</p>
                                    </div> -->
                                </div>
                                <div class="opened-chat" style="display:none;">
                                    <p class="s-text">
                                        <?php if(isset($desingermessage->message)){ echo $desingermessage->message; } ?>
                                    </p>
                                    <div class="chat-option-box">
                                        <a href="javascript:void(0)">see chat <i
                                                class="fa-regular fa-comments"></i></a>
                                        <a href="javascript:void(0)" class="reply_button"
                                            user-id="{{ $user->id ?? '' }}">reply <i
                                                class="fa-solid fa-paper-plane"></i></a>
                                    </div>
                                    <?php $chat = true; ?>
                                    <div class="reply-box" style="display:none;">
                                        <div class="chat_input" userid="{{ $user->id ?? '' }}">
                                            <div class=" " userid="{{ $user->id ?? '' }}">
                                                <form action="" method="post" enctype="multipart/form-data" id="chatform">
                                                    @csrf
                                                    <input type="hidden" id="active_user" name="reciever_id" value="{{ $user->id ?? '' }}">
                                                    <div class="write-msg justify-content-between">
                                                        @if($chat == true)
                                                        <div class="wrt-msg">
                                                            <input id="message" sender-id="{{ $user->id ?? '' }}"
                                                                placeholder="Write a messages....." />
                                                        </div>
                                                        @else
                                                        <div class="wrt-msg text text-danger">
                                                            Your chat session is over now.
                                                        </div>
                                                        @endif
                                                        @if($chat == true)
                                                        <div class="atch-file">
                                                            <ul class="list-unstyled">
                                                                <li>
                                                                    <label for="attachment"><i
                                                                            class="fa-solid fa-paperclip"></i></label>
                                                                    <input type="file" name="files[]" id="attachment">
                                                                </li>
                                                                <li><button type="submit" class="sendmessage btn btn-link"><img
                                                                            src="{{ asset('logomax_pages/img/send.svg') }}"
                                                                            class="img-fluid" alt="..."></button></li>
                                                            </ul>
                                                        </div>
                                                        <div class="cross">
                                                            <i class="fa-solid fa-xmark"></i>
                                                        </div>

                                                        @endif
                                                    </div>
                                                    <div>
                                                        <p id="files-area">
                                                            <span id="filesList">
                                                                <span id="files-names"></span>
                                                            </span>
                                                        </p>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- </a> -->
                                <!-- <div class="hover_show_section d-none" data-id="{{ $user->id ?? '' }}">
                                                        <button class="reply_button" user-id="{{ $user->id ?? '' }}">Reply</button>
                                                        <button class="go_to_chat">Go to chat</button>
                                                    </div> -->
                                <?php //$chat = true; ?>
                            </li>
                            <!-- <li class="chat_input d-none" userid="{{ $user->id ?? '' }}">
                                <div class=" " userid="{{ $userdata->id ?? '' }}">
                                        <form action="" method="post" enctype="multipart/form-data" id="chatform">
                                                @csrf
                                            <input type="hidden" id="active_user" value="{{ $userdata->id ?? '' }}"> 
                                            <div class="write-msg d-flex justify-content-between">
                                                @if($chat == true)
                                                    <div class="wrt-msg">
                                                        <input id="message" sender-id="{{ $userdata->id ?? '' }}" placeholder="Write a messages....." />
                                                    </div>
                                                @else
                                                    <div class="wrt-msg text text-danger">
                                                        Your chat session is over now.
                                                    </div>
                                            @endif
                                            @if($chat == true)
                                            <div class="atch-file">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <label for="attachment"><i class="fa-solid fa-paperclip"></i></label>
                                                    <input type="file" name="files[]" id="attachment">
                                                </li>
                                                <li><button type="submit" class="sendmessage btn btn-link"><img
                                                    src="{{ asset('logomax_pages/img/send.svg') }}" class="img-fluid" alt="..."></button></li>
                                            </ul>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p id="files-area">
                                            <span id="filesList">
                                                <span id="files-names"></span>
                                            </span>
                                            </p>
                                        </div>
                                    </form>
                                </div> 
                                </li> -->
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- My Logo list  -->
@if($mylogos->isNotEmpty())
<div class="my-fav my-logs">
    <h3>My Logos</h3>
    <table>
        <tr>
            <th scope="col">Product Name</th>
            <!-- <th scope="col">Files</th> -->
            <th scope="col">Customization</th>
            <!-- <th scope="col"></th> -->
        </tr>
        @foreach($mylogos as $logos)

        <!-- ///////////////////////////////// Here Logo means Order detail /////////////////////////////////////  -->
        <?php 
            
            $orderMakeAt = $logos->created_at;
            $dateObj = Carbon::parse($orderMakeAt);
            
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');
            $downloadUptoDayLimit = 30 ;  //days 
            $logoBackupResponse = [];
            // dd($orderDetail);
            if($logos->logo_for_future_status == 1){
                // dd($currentDate , $dateObj);
                $logoBackupResponse = [
                    'status' => true,
                    'type' => 'paid_service',
                    'message' => '',
                ];

                $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);
                $dateObj3 = Carbon::parse($orderMakeAt);
                $checkRenewDateStatus  = $dateObj3->addDays($downloadUptoDayLimit + 30);
            
                if($checkRenewDateStatus > $currentDate ){
                    // One month is over after order now checking the further more payments .
                    $renewUpto = $checkRenewDateStatus->format('Y-m-d');
                    
                    if($donwloadUpTo < $currentDate){
                        
                        $logoBackupResponse = [
                            'status' => false,
                            'type' => 'paid_service',
                            'removed' => false,
                            'message' => "Your logo backup service has expired. Renew before $renewUpto to avoid service removal. Act now to continue enjoying our backup benefits. Thank you!",
                        ];

                        $paymentData = App\Models\Payment::where([['order_id','=',$logos->id],['payment_type','=','logo-backup']])->latest()->first();

                        if($paymentData){
                            $dateObj2 = Carbon::parse($paymentData->created_at);
                            $paymentDurValidUpto = $dateObj2->addDays($downloadUptoDayLimit);
                            if($paymentDurValidUpto > $currentDate){
                                $logoBackupResponse = [
                                    'status' => true,
                                    'type' => 'paid_service',
                                    'removed' => false,
                                    'message' => '',
                                ];
                            }
                        }
                    }else{
                        $logoBackupResponse = [
                            'status' => true,
                            'type' => 'paid_service',
                            'removed' => false,
                            'message' => "",
                        ];
                    }

                }else{

                    $logoBackupResponse = [
                        'status' => false,
                        'type' => 'paid_service',
                        'removed' => true,
                        'message' => "You have not renewed your logo backup service in given time, and as a result, it has been deleted.",
                    ];

                }

            }else{

                $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);

                if($donwloadUpTo < $currentDate){
                    // One month is over after order now and now no backup is there.
                    $logoBackupResponse = [
                        'status' => false,
                        'type' => 'free_service',
                        'removed' => true,
                        'message' => 'Your free logo backup service is over now .',
                    ];
                }else{
                    $logoBackupResponse = [
                        'status' => true,
                        'type' => 'free_service',
                        'removed' => false,
                        'message' => '',
                    ];
                }

            }
        
        ?>


        <tr>
            <td data-label=" Product Name">
                <div class="p-name pd-txt img-box">
                    <div class="p-img">
                        @if($logos->logodetail->media->directory_name != null ||
                        $logos->logodetail->media->directory_name != "")
                        <img src="{{ asset('LogoDirectory/'.$logos->logodetail->media->directory_name.'/'.$logos->logodetail->media->directory_name.'.png') }}"
                            class="img-fluid" alt="....">
                        @else
                        <img src="{{ asset($list->logos->media->image_path ?? '') }}" class="img-fluid" alt="....">
                        @endif
                    </div>
                    <div class="p-text inr-text"><a href="" order-id="{{ $logos->id ?? '' }}"
                            class="download-btn-head">{{ $logos->logodetail->logo_name ?? '' }}</a></div>

                </div>
            </td>
            <!-- <td data-label="Price">
                <a href="" order-id="{{ $logos->id ?? '' }}"  class="download-btn-head">
                    Download
                </a> 
            </td> -->
            <td data-label="Customization">
                <ul class="desktop2">
                    <li><a href="javascript:void(0)" type="logo" order_id="{{ $logos->id }}"
                            class="request-btn-new">Logo</a></li>
                    @if($logos->get_favicon_status == 1)
                    <li><a href="javascript:void(0)" type="favicon" order_id="{{ $logos->id }}"
                            class="request-btn-new">Favicon</a></li>
                    @endif
                </ul>
                <div class="tog-btn mobile2">
                    <div class="heart-i p-cntr inr-text" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a href="javascript:void(0)" type="logo" order_id="{{ $logos->id }}"
                            class="request-btn-new dropdown-item">Logo</a>
                        <a href="javascript:void(0)" type="favicon" order_id="{{ $logos->id }}"
                            class="request-btn-new dropdown-item">Favicon</a>
                    </div>
                </div>
            </td>
            <td data-label="">
                <div class="tog-btn">
                    <div class="heart-i p-cntr inr-text" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                            href="{{ url(app()->getlocale().'/order-details/'.$logos->logodetail->orderData->order_num ?? '') }}">View
                            Order</a>
                        <a class="dropdown-item"
                            href="{{ url(app()->getlocale().'/download-logo/'.$logos->logodetail->orderData->order_num ?? '') }}">Logo
                            Details</a>
                        <a class="dropdown-item download-btn-head" href="" order-id="{{ $logos->id ?? '' }}">Download
                            Logo</a>
                    </div>

                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endif
<!-- My Logo list End -->
<!-- Wishlist  -->
@if($wishlist->isNotEmpty())
<div class="my-fav niks-my-fav">
    <h3>My Favorites</h3>
    <table>
        <tr>
            <th scope="col">Product Name</th>

            <th scope="col"></th>
        </tr>
        @foreach($wishlist as $list)
        @if($list->logos->status == 1)
        <tr id="list{{ $list->id ?? '' }}">
            <td>
                <div class="img-box">
                    <a href="{{ url(app()->getlocale().'/logo/'.$list->logos->logo_slug ?? '') }}">
                        @if($list->logos->media->directory_name != null || $list->logos->media->directory_name != "")
                        <img src="{{ asset('LogoDirectory/'.$list->logos->media->directory_name.'/'.$list->logos->media->directory_name.'.png') }}"
                            class="img-fluid" alt="">
                        @else
                        <img src="{{ asset($list->logos->media->image_path) }}" alt="" />
                        @endif
                    </a>
                    <div class="p-text inr-text">{{ $list->logos->logo_name ?? '' }}</div>
                </div>
            </td>

            <!-- <td data-label="">
                <div class="heart-i p-cntr inr-text"><i style="color: red;" class="fas fa-heart"></i></div>
            </td> -->
            <td data-label="">
                <div class="heart-i p-cntr inr-text remove_btn" data-id="{{ $list->id ?? '' }}" style="cursor:pointer;">
                    <i class="fas fa-times"></i></div>
            </td>

        </tr>
        @endif
        @endforeach
    </table>
</div>
@endif
<!-- Wishlist end  -->

</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.download-btn-head').on('click', function (e) {
        e.preventDefault();
        order_id = $(this).attr('order-id');
        @if ($mylogos -> isNotEmpty())
            @if ($logoBackupResponse['status'] == true)
            location.href = "{{ url(app()->getLocale().'/user-dashboard/logo/download') }}/" + order_id;
        @else
        @if ($logoBackupResponse['type'] == 'free_service' || $logoBackupResponse['removed'] == true)
            Swal.fire({
                title: "Logo is removed",
                text: "{{ $logoBackupResponse['message'] }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
            });
        @else
        Swal.fire({
            title: "Need to Pay.",
            text: "{{ $logoBackupResponse['message'] }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok i'll pay"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ url(app()->getLocale().'/payments/logo-backup/'.$orderDetail->order_num) }}";
            }
        });
        @endif
        @endif
        @endif
    });

    //  Customization click 
    $(".request-btn-new").on('click', function (e) {
        e.preventDefault();
        let type = $(this).attr('type');
        let order_id = $(this).attr('order_id');

        $.ajax({
            method: 'post',
            url: '{{url(app()->getlocale()."/check-revision-status?".time())}}',
            data: {
                'request_type': type,
                'order_id': order_id,
            },
            success: function (response) {
                if (response.status == false) {
                    if (response.url !== undefined) {
                        Swal.fire({
                            title: response.title,
                            text: response.message,
                            icon: "warning",
                            showCancelButton: true,
                            cancelButtonColor: "#d33",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok i'll pay",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = response.url;
                            }
                        });
                    } else {
                        Swal.fire({
                            title: response.title,
                            text: response.message,
                            icon: "warning",
                        });
                    }
                } else {
                    window.location.href = response.url;
                }

            }
        });
    });

    // Remove from wishlist 
 

    $('.remove_btn').on('click', function () {
        id = $(this).attr('data-id');
        $.ajax({
            method: 'post',
            url: '{{ url('user-dahsboard/removeWhislist') }}',
            data: { id: id, _token: "{{ csrf_token() }}" },
            datatype: 'json',
            success: function (response) {
                if (response.success) {
                    $('#list' + id).hide();
                    iziToast.success({
                        message: response.success,
                        position: 'topRight'
                    });
                } else {
                    iziToast.error({
                        message: response.error,
                        position: 'topRight'
                    });
                }
            }
        })
    });
</script>
<script>
    $(document).ready(function () {
        $('.recent-chat').on("mouseenter", function () {
            user_id = $(this).attr('userid');
            $('div.hover_show_section[data-id="' + user_id + '"]').removeClass('d-none');
        })
        $('.recent-chat').on("mouseleave", function () {
            user_id = $(this).attr('userid');
            $('div.hover_show_section[data-id="' + user_id + '"]').addClass('d-none');
        })
        // yashuuuuuuuuuuuuuuuu
        // $('.reply_button').on('click', function () {
        //     user_id = $(this).attr('user-id');
        //     $('.chat_input[userid="' + user_id + '"]').toggleClass('d-none');
        // })
    });
    $('#chatform').on('submit', function (e) {
        e.preventDefault();
        formdata = new FormData(this);
        senderid = "{{ auth()->user()->id }}";
        message = autoReadLinksAndEmails($('#message').val());

        formdata.append("sender_id", senderid);
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
                // console.log(response);
                // file = response.files;
                // if (response.message != null) {
                //     message_html = '<div class="lv-chat"><p class="b-text" id="message-text' + response[0].id + '" >' + message + '</p></div>';
                // } else {
                //     message_html = '';
                // }
                // fileshtml = [];
                // if (file.length != 0) {
                //     $.each(file, function (key, value) {
                //         filehtml = `<div class="lv-chat"><button><a href="{{ url(app()->getLocale().'/user-dashboard/download/${value}') }}">${value}</a></button></div>`;
                //         fileshtml.push(filehtml);
                //     });
                // }

                // $("#chatboxuserslist" + active_user).load(location.href + " #chatboxuserslist" + active_user);
            }
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

    // recent chat js NT
    // $(document).ready(function () {
    //         $('.main').on('click', function () {
                
    //     })
    // });
    $(".main-box").on('click',function(){
        $(this).siblings(".opened-chat").toggle();
        $(this).children('.hover-text').html(`<p> close chat</p>`);
    });
    // cross 
    
    $('.cross').on('click', function () {
        $(this).parents('.reply-box').siblings('.chat-option-box').toggle();
        $(this).parents('.reply-box').toggle();
    })
   
    // reply
    $('.reply_button').on('click', function () {
        $(this).parent().siblings('.reply-box').toggle();
        $(this).parent().toggle();
    });
</script>


@endsection
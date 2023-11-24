@extends('user_dashboard_layout.master_layout')
@section('content')
<style>
    .loader {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .loader img{
        max-width: 120px;
    }
    .loader-box {
        display:none;
        width: 100%;
        height: 100%;
        background: #000;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100000;
        opacity: 72%;
    }
</style>
<div>
{{ Breadcrumbs::render('download-logo',$orderDetail->order_num) }}
</div>
<div class="loader-box">
    <div class="loader"><img src="{{ asset('logomax-front-asset/img/loading-loading-forever.gif') }}" alt=""></div>
</div>
<section class="logo-detail-sec download_sec">
    <div class="container">
        <!-- <div class="brand-logo">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Logos</a></li>
                    <li class="breadcrumb-item"><a href="#">Logos Templates</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $orderDetail->logodetail->logo_name ?? ''; }}</a>
                    </li>
                </ol>
            </nav>
        </div> -->
        <?php 
            $media = App\Models\Media::class;
            $mediaObj = $media::find($orderDetail->logodetail->media_id);
            $image_name = $mediaObj->image_name;
            $image_url = asset($mediaObj->image_path);
        ?>
        
        <div class="logo_wrapper download_page">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="vita-img">
                        <img src="{{ $image_url }}" alt="{{ $image_name }}">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="template_data">
                       <div class="hand_text">
                        <h4>{{ $orderDetail->logodetail->logo_name ?? ''; }}</h4>
                       </div>
                        @if(empty($completedTask))
                            <div class="cta_wrapp arrow-ct"> 
                                <div class="load-btn">
                                    <a href="#" class="download-btn">
                                        <img src="{{ asset('logomax-front-asset/img/download.svg') }}" alt="">
                                        Download
                                    <i class="fa-solid fa-angle-down"></i>
                                    </a>
                                </div><br>
                                <div class="load-btn free">
                                    <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" class="request-btn">Request Free Customization</a>
                                </div><br>
                                @if(isset($assigneDesginer))
                                <div class="load-btn free">
                                    <a data-toggle="modal" data-target="#messageModal" class="message-btn">Message</a>
                                </div>
                                @endif
                            </div>
                            @if($orderDetail->on_revision == 1)
                                <div class="alert alert-danger mt-5">
                                    Your Logo is on revision .
                                </div>
                            @endif
                        @else
                            @if($completedTask->status == 0)
                                <div class="alert alert-success">Your revision request is done.</div>
                                <div class="cta_wrapp arrow-ct">
                                    <div class="load-btn">
                                        <a href="{{ url('/downloadProcess/'.$completedTask->id) }}" class="download-btn" id="download_revised_logo">
                                            <img src="{{ asset('logomax-front-asset/img/download.svg') }}" alt="">
                                            Download Revised Logo
                                        </a>
                                    </div>
                                </div>
                                <div class="cta_wrapp arrow-ct"> 
                                    <div class="load-btn mr-2">
                                        <a href="{{ url('/disapprove-logo/'.$completedTask->id) }}" class="resp_btn">
                                            Diaspprove <i class="fa-solid fa-circle-xmark"></i>
                                        </a>
                                    </div>
                                    <div class="load-btn free">
                                        <a href="{{ url('/approve-logo/'.$completedTask->id) }}" class="resp_btn">
                                            Approve <i class="fa-solid fa-check"></i>
                                        </a>
                                    </div>
                                </div>
                            @elseif($completedTask->status == 1)
                                <div class="cta_wrapp arrow-ct"> 
                                    <div class="load-btn">
                                        <a href="{{ url('/downloadProcess/'.$completedTask->id) }}" class="download-btn" id="download_revised_logo">
                                            <img src="{{ asset('logomax-front-asset/img/download.svg') }}" alt="">
                                            Download
                                        </a>
                                    </div>
                                    <div class="load-btn free">
                                        <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" class="request-btn">Request Free Customization</a>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Revision request modal  -->
<!-- Modal -->
<div class="modal fade" id="revisionRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <div>
            <h5 class="modal-title text text-dark" id="exampleModalLabel">Enter Your Revision Request . </h5>
            <p class="text text-secondary">We can change only color, text and fonts.</p>
        </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="request_title" class="col-form-label">Request Title</label>
            <input type="text" class="form-control" id="request_title" />
          </div>
          <div class="form-group">
            <label for="request_desc" class="col-form-label">Description</label>
            <textarea class="form-control" id="request_desc"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send_request_btn">Send request</button>
      </div>
    </div>
  </div>
</div>
<!-- End -->
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('user-dashboard/directmessagesProcc') }}" method="post">
            @csrf
            <input type="hidden" name="sender_id" value="{{ auth()->user()->id ?? '' }}">
            <input type="hidden" name="reciever_id" value="{{ $assigneDesginer->assigned_designer_id ?? '' }}">
            <div class="form-group">
                <textarea name="message" id="message" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Send</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".request-btn").on('click',function(e){
        e.preventDefault();
        @if($previousRevisionCount == 3 || $previousRevisionCount > 3  )
        Swal.fire({
            title: "You have completed free revision request",
            text: "Your free revision request is over now you have to pay if you want more revision.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ok i'll pay"
            }).then((result) => {
            if (result.isConfirmed) {
                
            }
        });
        @endif
            @if($orderDetail->on_revision == 1)
                    Swal.fire({
                        icon: 'error',
                        title: 'Your logo is already on revision.',
                        footer: 'Please wait we have provide your logo as soon as possible !'
                    });
            @else
                @if($previousRevisionCount == 3 || $previousRevisionCount > 3  )
                Swal.fire({
                    title: "Need to Pay.",
                    text: "Your free revision request is over now you have to pay if you want more revision.",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok i'll pay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // need to pay to make more changes in logo .
                            
                            // $("#revisionRequestModal").modal('show');
                            // // Send request 
                            // $("#send_request_btn").on('click',function(e){
                            //     e.preventDefault();
                            //     $("#revisionRequestModal").modal('hide');
                            //     let request_title = $('#request_title').val();
                            //     let request_description = $('#request_desc').val();

                            //     // Send Ajax
                            //     $(".loader-box").show();

                            //     $.ajax({
                            //         url: "{{ url('/request-for-revision') }}",
                            //         method: 'GET',
                            //         data: {
                            //             'order_num' : '{{ $orderDetail->order_num }}',
                            //             'request_title' : request_title,
                            //             'request_description' :request_description 
                            //         },
                            //         dataType: 'JSON',
                            //         success:function(response)
                            //         {
                            //             setTimeout(()=>{
                            //                 $(".loader-box").hide();
                            //                 Swal.fire(
                            //                     'Request Sent!',
                            //                     'You have sent revision request succesfully !',
                            //                     'success'
                            //                 ).then((result) => {
                            //                     if (result.isConfirmed) {
                            //                         location.reload();
                            //                     }
                            //                 });
                            //             }, 1000);
                            //         },
                            //         error: function(response) {
                            //             console.log(error);
                            //         }
                            //     });
                            // })
                        }
                    });
                @else
                    $("#revisionRequestModal").modal('show');
                    // Send request 
                    $("#send_request_btn").on('click',function(e){
                        e.preventDefault();
                        $("#revisionRequestModal").modal('hide');
                        let request_title = $('#request_title').val();
                        let request_description = $('#request_desc').val();

                        // Send Ajax
                        $(".loader-box").show();

                        $.ajax({
                            url: "{{ url('/request-for-revision') }}",
                            method: 'GET',
                            data: {
                                'order_num' : '{{ $orderDetail->order_num }}',
                                'request_title' : request_title,
                                'request_description' :request_description 
                            },
                            dataType: 'JSON',
                            success:function(response)
                            {
                                setTimeout(()=>{
                                    $(".loader-box").hide();
                                    Swal.fire(
                                        'Request Sent!',
                                        'You have sent revision request succesfully !',
                                        'success'
                                    ).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }, 1000);
                            },
                            error: function(response) {
                                console.log(error);
                            }
                        });
                    })
                @endif
            @endif
    });
</script>
@endsection
@extends('user_layout/master')
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
<div class="loader-box">
    <div class="loader"><img src="{{ asset('logomax-front-asset/img/loading-loading-forever.gif') }}" alt=""></div>
</div>
<section class="logo-detail-sec download_sec">
    <div class="container">
        <div class="brand-logo">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Logos</a></li>
                    <li class="breadcrumb-item"><a href="#">Logos Templates</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ $orderDetail->logodetail->logo_name ?? ''; }}</a>
                    </li>
                </ol>
            </nav>
        </div>
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
                    <div class="file_box">
                        <div class="file_wrapper">
                           <div class="button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                               <span class="copy-asset-id__icon__container container-relative">
                                   <button class="copy-asset-id__icon js-copy-asset-id hover-trigger" data-t="asset-id-copy-icon" aria-label="Copy asset id" data-ingest-content-id="639521383" data-content-id="639521383" data-ingest-clicktype="copy-asset-id">
                                      <img src="{{ asset('logomax-front-asset/img/file.png') }}" alt="">
                                   </button>
                                   <div class="container-absolute container-above h-align in-front margin-bottom-medium hover-container copy-asset-id__tooltip">
                                       <div class="tooltip tooltip--primary tooltip--top left-align">
                                           <div class="text-small">
                                               <strong class="js-copy-asset-id-tooltip">Copy 639521383</strong>
                                           </div>
                                       </div>
                                   </div>
                               </span>
                               <a class="asset-id-link__button" href="#" data-t="detail-panel-file-id" data-ingest-clicktype="click-file-id" data-content-id="639521383" title="Go to content details page">
                                   <strong class="text-up">File #:&nbsp;</strong>
                                   <span>269827623</span>
                               </a>
                           </div>
                       </div>
                       <div class="file_wrapper">
                           <div class="button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                               <span class="copy-asset-id__icon__container container-relative">
                                   <button class="copy-asset-id__icon js-copy-asset-id hover-trigger" data-t="asset-id-copy-icon" aria-label="Copy asset id" data-ingest-content-id="639521383" data-content-id="639521383" data-ingest-clicktype="copy-asset-id">
                                      <img src="{{ asset('logomax-front-asset/img/camera.png') }}" alt="">
                                   </button>
                                   <div class="container-absolute container-above h-align in-front margin-bottom-medium hover-container copy-asset-id__tooltip">
                                       <div class="tooltip tooltip--primary tooltip--top left-align">
                                           <div class="text-small">
                                               <strong class="js-copy-asset-id-tooltip">Copy 639521383</strong>
                                           </div>
                                       </div>
                                   </div>
                               </span>
                               <a class="asset-id-link__button" href="#" data-t="detail-panel-file-id" data-ingest-clicktype="click-file-id" data-content-id="639521383" title="Go to content details page">
                                   <span>Find Similar</span>
                               </a>
                           </div>
                       </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="template_data">
                       <div class="hand_text">
                        <h4>{{ $orderDetail->logodetail->logo_name ?? ''; }}</h4>
                       </div>
                        <div class="cta_wrapp arrow-ct"> 
                            <div class="load-btn">
                                <a href="" class="download-btn">
                                    <img src="{{ asset('logomax-front-asset/img/download.svg') }}" alt="">
                                    Download
                                <i class="fa-solid fa-angle-down"></i></a>
                            </div>
                            <div class="load-btn free">
                                <a href="{{ url('/request-for-revision/'.$orderDetail->order_num) }}" class="request-btn">Request Free Customization</a>
                            </div>
                        </div>
                        @if($orderDetail->logodetail->status == 2)
                        <div class="alert alert-danger mt-5">
                            Your Logo is on revision .
                        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(".request-btn").on('click',function(e){
        e.preventDefault();
        @if($orderDetail->logodetail->status == 2)
                Swal.fire({
                    icon: 'error',
                    title: 'Your logo is already on revision.',
                    footer: 'Please wait we have provide your logo as soon as possible !'
                });
        @elseif($orderDetail->logodetail->status == 3)
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
    });
</script>
@endsection
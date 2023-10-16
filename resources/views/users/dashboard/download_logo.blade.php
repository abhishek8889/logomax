@extends('user_layout/master')
@section('content')

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
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
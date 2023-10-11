@extends('user_layout/master')
@section('content')

<section class="logo-detail-sec">
        <div class="container">
            <div class="brand-logo">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('logos-search') }}">Logos Search</a></li>
                        <li class="breadcrumb-item"><a > {{ $logo->logo_slug ?? '' }}</a>
                        </li>

                    </ol>
                </nav>


            </div>

            <div class="logo_wrapper">
                <div class="row custom-align">
                    <div class="col-lg-6 col-md-12">
                        @if(isset($logo->media['image_name']))
                        <div class="vita-img">
                            <img src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">

                        </div>
                        @endif

                    </div>

                    <div class="col-lg-6 col-md-12">
                        <div class="brand-text">
                            <h4>{{ $logo->logo_name ?? '' }}</h4>
                            <div class="template_content">
                                <div class="icon">
                                    <i class="fa-solid fa-file"></i>
                                </div>
                                <div class="">
                                    <p>AI, EPS, PDF, SVG, PNG, JPG, TIF</p>
                                </div>
                            </div>

                            <div class="num">
                                <h2>$
                                @if(auth()->check()) 
                                  @if(auth()->user()->role_id == 2)
                                    {{ $logo->price_for_designer ?? '' }}
                                  @else
                                    {{ $logo->price_for_customer ?? '' }}
                                  @endif
                                @else
                                  {{ $logo->price_for_customer ?? '' }}
                                @endif</h2>
                            </div>

                            <div class="dropdown_data">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-1">
                                            <h5>Rapid, Free Customization</h5>
                                        </div>
                                        <div id="collapse-1" class="collapse " data-parent="#accordion">
                                            <div class="card-body">
                                                Download your logo files instantly upon purchase. Need adjustments? Our
                                                complimentary customizaon
                                                service delivers changes within 1 business day. Enjoy up to 3 revisions,
                                                covering brand name, colors, and
                                                fonts to ensure your logo perfectly suits your vision. </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-2">
                                            <h5>Exclusivity Guaranteed</h5>
                                        </div>
                                        <div id="collapse-2" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                Each logo is designed to be one-of-a-kind and will only be sold to a
                                                single customer. This means your
                                                brand will have a unique identy that stands out from competors, and you
                                                can be confident in a logo
                                                that truly represents your business. </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-3">
                                            <h5>Immediate Use</h5>
                                        </div>
                                        <div id="collapse-3" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                As predesigned logos, they're ready to be used right away. No waing for
                                                designers to create something
                                                from scratch – you can start building your brand immediately. </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-4">
                                            <h5>Brand Registraon Allowed</h5>
                                        </div>
                                        <div id="collapse-4" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                We allow brand registraon, ensuring that your chosen logo is legally
                                                protected. This helps you establish
                                                your brand's authencity and safeguards it from potenal infringements.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-5">
                                            <h5>Affordable Pricing</h5>
                                        </div>
                                        <div id="collapse-5" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                Building a brand doesn't have to break the bank. Our logos offer a
                                                cost-effecve soluon for businesses
                                                looking to establish a strong visual identy. 
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card">
                                        <div class="card-header pointer" data-toggle="collapse"
                                            data-target="#collapse-6">
                                            <h5>Unrestricted License: Your Brand, Your Terms</h5>
                                        </div>
                                        <div id="collapse-6" class="collapse" data-parent="#accordion">
                                            <div class="card-body">
                                                Our licensing agreement grants you exclusive ownership of the logo. Feel
                                                free to ulize it in any manner
                                                you prefer, without the need to acknowledge us. Shape your brand identy
                                                on your terms. </div>
                                        </div>

                                    </div>


                                </div>

                                <div class="cta-btn">
                                    <a href="" class="now-btn">Buy Now</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="file_box">
                    <div class="file_wrapper">
                        <div
                            class="button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                            <span class="copy-asset-id__icon__container container-relative">
                                <button class="copy-asset-id__icon js-copy-asset-id hover-trigger"
                                    data-t="asset-id-copy-icon" aria-label="Copy asset id"
                                    data-ingest-content-id="639521383" data-content-id="639521383"
                                    data-ingest-clicktype="copy-asset-id">
                                    <img src="{{ asset('logomax-front-asset/img/file.png') }}" alt="">
                                </button>
                                <div
                                    class="container-absolute container-above h-align in-front margin-bottom-medium hover-container copy-asset-id__tooltip">
                                    <div class="tooltip tooltip--primary tooltip--top left-align">
                                        <div class="text-small">
                                            <strong class="js-copy-asset-id-tooltip">Copy 639521383</strong>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <a class="asset-id-link__button" href="#" data-t="detail-panel-file-id"
                                data-ingest-clicktype="click-file-id" data-content-id="639521383"
                                title="Go to content details page">
                                <strong class="text-up">File #:&nbsp;</strong>
                                <span>269827623</span>
                            </a>
                        </div>
                    </div>
                    <div class="file_wrapper">
                        <div
                            class="button button--action-v2 detail-panel-file-id__container js-details-hover-btn margin-bottom-xsmall">
                            <span class="copy-asset-id__icon__container container-relative">
                                <button class="copy-asset-id__icon js-copy-asset-id hover-trigger"
                                    data-t="asset-id-copy-icon" aria-label="Copy asset id"
                                    data-ingest-content-id="639521383" data-content-id="639521383"
                                    data-ingest-clicktype="copy-asset-id">
                                    <img src="{{ asset('logomax-front-asset/img/camera.png') }}" alt="">
                                </button>
                                <div
                                    class="container-absolute container-above h-align in-front margin-bottom-medium hover-container copy-asset-id__tooltip">
                                    <div class="tooltip tooltip--primary tooltip--top left-align">
                                        <div class="text-small">
                                            <strong class="js-copy-asset-id-tooltip">Copy 639521383</strong>
                                        </div>
                                    </div>
                                </div>
                            </span>
                            <a class="asset-id-link__button" href="#" data-t="detail-panel-file-id"
                                data-ingest-clicktype="click-file-id" data-content-id="639521383"
                                title="Go to content details page">

                                <span>Find Similar</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="similar-logos">
                    <div class="similar_text">
                        <h5>Similar Logos</h5>

                    </div>
                    <div class="similar_wrapper">
                        @foreach($similar_logos as $similar)
                        <a href="{{ url('logos-detail/'.$similar->logo_slug) }}">
                          <div class="similar_img_box">
                              <img src="{{ asset('logos/'.$similar->media['image_name']) }}" alt="">
                          </div>
                        </a>
                        @endforeach
                        @if(count($similar_logos) == 4)
                        <a href="{{ url('/logos-search?categories=%5B"'.$category_slug.'"%5D') }}">
                          <div class="similar_img_box white">
                              <img src="{{ asset('logomax-front-asset/img/similar5.png') }}" alt="">
                          </div>
                        </a>
                        @endif

                    </div>

                </div>
            </div>

    </section>

    <section class="slider-sec p-110">
    <div class="container">
      <div class="logomax-content">
        <h2>Why our customers love Logomax</h2>
        <p>Hundreds of customers have trusted Logomax logo maker and Brand Plan as a resource to set up, launch, and
          grow a brand they love.</p>
        <div class="logomax-img">
          <img src="{{ asset('logomax-front-asset/img/trustpilot.png') }}" alt="">
        </div>
      </div>
      <div class="slick-wrapper">
        <div class="slick-test">
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                into electronic typesetting, remaining essentially unchanged. It was popularised..</p>

            </div>
            <div class="choice_star">
              <h6>the choice was great</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
          <div class="slider-box">
            <div class="slider-content">
              <p>It is a long established fact that a reader will be distracted by the readable content of a page when
                looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution
                of letters, as opposed to using 'Content here, content here', making it look like readable English. Many
                desktop publishing packages and web page editors now use Lorem Ipsum as their default!!</p>

            </div>
            <div class="choice_star">
              <h6>I generally find what I am looking for</h6>

              <div class="choice-text">
                <div class="slick-img">
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                  <i class="fa-sharp fa-solid fa-star"></i>
                </div>
                <div class="Verified-content">
                  <i class="fa-solid fa-check"></i>
                  <p>Verified</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
@extends('user_layout/master')
@section('content')

<section class="logo-detail-sec">
          <div class="container">
            <div class="brand-logo">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('logos-search') }}">Logos</a></li>
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
                                <h2>${{ $logo->price_for_customer }}</h2>
                            </div>

                            <div class="dropdown_data">
                                <div id="accordion">
                                  @foreach($logoFacilities as $facility)
                                  <div class="card">
                                      <div class="card-header pointer" data-toggle="collapse"
                                          data-target="#collapse-{{ $facility->id }}">
                                          <h5 class="text text-dark">{{ $facility->facilities_name ?? '' }}</h5>
                                      </div>
                                      <div id="collapse-{{ $facility->id }}" class="collapse " data-parent="#accordion">
                                          <div class="card-body">
                                            {{ $facility->description ?? '' }}
                                          </div>
                                      </div>
                                  </div>
                                  @endforeach
                                </div>
                                <div class="cta-btn">
                                  <a href="{{ url('/logos/checkout/'.$logo->logo_slug) }}" class="now-btn">Buy Now</a>
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
                        <a href="{{ url('logo/'.$similar->logo_slug) }}">
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
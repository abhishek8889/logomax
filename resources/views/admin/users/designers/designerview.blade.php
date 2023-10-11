@extends('admin_layout.master')
@section('content')


                <div class="nk-content ">
              
                    <div class="container">
                        <div class="d-flex justify-content-between">
                                <h4>{{ $designer->name ?? '' }} Details</h4>
                                {{ Breadcrumbs::render('designer-view',$designer->name) }}
                        </div>
                        <div class="nk-content-inner">
                            <div class="nk-block">
                            <div class="card card-bordered">
                                                <div class="card-inner-group">
                                                    <div class="card-inner">
                                                        <h6 class="overline-title mb-2">Short Details</h6>
                                                        <!-- <div class="row g-3"> -->
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Desginer Name:</span>
                                                                <span>{{ $designer->name ?? '' }}</span>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Desginer Email:</span>
                                                                <span>{{ $designer->email ?? '' }}</span>
                                                            </div>
                                                            @if(isset($designer->address))
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Designer Address:</span>
                                                                <span>{{ $designer->address ?? '' }}</span>
                                                            </div>
                                                            @endif
                                                            @if(isset($designer->country))
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Region:</span>
                                                                <span>{{ $designer->country ?? '' }}</span>
                                                            </div>
                                                            @endif
                                                            @if(isset($designer->experience))
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Experience:</span>
                                                                <span>{{ $designer->experience ?? '' }} years</span>
                                                            </div>
                                                            @endif
                                                            <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-spaced">
                                                                <span class="sub-text">Register On:</span>
                                                                <span>{{ $designer->created_at ?? '' }}</span>
                                                            </div>
                                                        <!-- </div> -->
                                                    </div><!-- .card-inner -->
                                                    
                                                </div>
                                            </div>
                            </div>
                         @if($logos->isNotEmpty())
                            <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <h3 class="nk-block-title page-title">{{ $designer->name ?? '' }}'s  Logos</h3>
                                               
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="slider-init row" data-slick='{"slidesToShow": 1, "centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 1540,"settings":{"slidesToShow": 3}},{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 576,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($logos as $logo)    
                                        <div class="col">
                                            <div class="card card-bordered product-card">
                                                <div class="product-thumb">
                                                   
                                                        <img class="card-img-top" src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                                                        <ul class="product-badges">
                                                            <li>
                                                                @if($logo->approved_status == 0)
                                                                <span class="badge bg-info">Pending</span>
                                                                @elseif($logo->approved_status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                                @elseif($logo->approved_status == 2) 
                                                                <span class="badge bg-danger">Disapproved</span>
                                                                @endif
                                                            </li>
                                                        </ul>                                                   
                                                </div>
                                                <div class="card-inner text-center">
                                                    <ul class="product-tags">
                                                        <li><a href="{{ url('admin-dashboard/logo-detail/'.$logo->logo_slug) }}">View More</a></li>
                                                    </ul>
                                                    <h5 class="product-title"><a>{{ $logo->logo_name ?? '' }}</a></h5>
                                                    <!-- <div class="product-price text-primary h5"><small class="text-muted del fs-13px">$350</small> $324</div> -->
                                                </div>
                                            </div>
                                        </div><!-- .col -->
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
@endsection
@extends('admin_layout.master')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="card-aside-wrap">
                                            <div class="card-inner card-inner-lg">
                                                <div class="nk-block-head nk-block-head-lg">
                                                    <div class="nk-block-between">
                                                        <div class="nk-block-head-content">
                                                            <h4 class="nk-block-title">Designers Information</h4>
                                                            <div class="nk-block-des">
                                                              
                                                            </div>
                                                        </div>
                                                        <div class="nk-block-head-content align-self-start d-lg-none">
                                                            <a href="#" class="toggle btn btn-icon btn-trigger mt-n1" data-target="userAside"><em class="icon ni ni-menu-alt-r"></em></a>
                                                        </div>
                                                    </div>
                                                </div><!-- .nk-block-head -->
                                                <div class="nk-block">
                                                    <div class="nk-data data-list">
                                                        <div class="data-head">
                                                            <h6 class="overline-title">Basics</h6>
                                                        </div>
                                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">First Name</span>
                                                                <span class="data-value">{{ $designer->first_name ?? '' }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                        </div><!-- data-item -->
                                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Last Name</span>
                                                                <span class="data-value">{{ $designer->last_name ?? '' }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                        </div><!-- data-item -->
                                                        <div class="data-item">
                                                            <div class="data-col">
                                                                <span class="data-label">Email</span>
                                                                <span class="data-value">{{ $designer->email ?? '' }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more disable"><em class="icon ni ni-lock-alt"></em></span></div>
                                                        </div><!-- data-item -->
                                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Address/Additional Address</span>
                                                                <span class="data-value text-soft">{{ $designer->address ?? '' }}
                                                                    @if($designer->additional_address) /{{ $designer->additional_address ?? '' }} @endif
                                                                    @if($designer->organization) Organization: {{ $designer->organization ?? '' }} @endif
                                                                    @if($designer->city) City: {{ $designer->city ?? '' }} @endif
                                                                    @if($designer->state) State: {{ $designer->state ?? '' }} @endif
                                                                    @if($designer->country) Country: {{ $designer->country ?? '' }} @endif
                                                                    @if($designer->zip_code) Zipcodes: {{ $designer->zip_code ?? '' }} @endif
                                                                </span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                        </div><!-- data-item -->
                                                        <div class="data-item" data-bs-toggle="modal" data-bs-target="#profile-edit">
                                                            <div class="data-col">
                                                                <span class="data-label">Date of Registered</span>
                                                                <span class="data-value">{{ $designer->created_at ?? '' }}</span>
                                                            </div>
                                                            <div class="data-col data-col-end"><span class="data-more"><em class="icon ni ni-forward-ios"></em></span></div>
                                                        </div><!-- data-item -->
                                                    </div><!-- data-list -->
                                                </div><!-- .nk-block -->
                                            </div>
                                            <div class="card-aside card-aside-left user-aside toggle-slide toggle-slide-left toggle-break-lg" data-toggle-body="true" data-content="userAside" data-toggle-screen="lg" data-toggle-overlay="true">
                                                <div class="card-inner-group" data-simplebar>
                                                    <div class="card-inner">
                                                        <div class="user-card">
                                                            <div class="user-avatar bg-primary">
                                                                <span>{{ substr(strtoupper($designer->first_name) ,0,1) ?? '' }}{{ substr(strtoupper($designer->last_name) ,0,1) ?? '' }}</span>
                                                            </div>
                                                            <div class="user-info">
                                                                <span class="lead-text">{{ $designer->first_name ?? '' }} {{ $designer->last_name ?? '' }}</span>
                                                                <span class="sub-text">{{ $designer->email ?? '' }}</span>
                                                                <div class="user-balance">{{ count($on_sale_logos_current) ?? 0 }} logos <small class="currency currency-btc"> on Sale</small></div>
                                                            </div>
                                                            <!-- <div class="user-action">
                                                                <div class="dropdown">
                                                                    <a class="btn btn-icon btn-trigger me-n2" data-bs-toggle="dropdown" href="#"><em class="icon ni ni-more-v"></em></a>
                                                                    <div class="dropdown-menu dropdown-menu-end">
                                                                        <ul class="link-list-opt no-bdr">
                                                                            <li><a href="#"><em class="icon ni ni-camera-fill"></em><span>Change Photo</span></a></li>
                                                                            <li><a href="#"><em class="icon ni ni-edit-fill"></em><span>Update Profile</span></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div> -->
                                                        </div><!-- .user-card -->
                                                    </div><!-- .card-inner -->
                                                    <div class="card-inner">
                                                        <div class="user-account-info py-0">
                                                            <h6 class="overline-title-alt">Percentage of logos sold</h6>
                                                            <div class="user-balance">@if(count($total_site_sold_logos_month) != 0) {{ round((count($sold_logos_month)*100)/count($total_site_sold_logos_month),0,PHP_ROUND_HALF_DOWN) ?? 0 }}% @else 0% @endif <small class="currency currency-btc">this month</small></div>
                                                            <div class="user-balance-sub"><span>@if(count($total_site_sold_logos_year) != 0) {{ round((count($sold_logos_year)*100)/count($total_site_sold_logos_year),0,PHP_ROUND_HALF_DOWN) ?? 0 }}% @else 0% @endif <span class="currency currency-btc">this year</span></span></div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                    <div class="card-inner">
                                                        <div class="user-account-info py-0">
                                                            <h6 class="overline-title-alt">Total sold logos</h6>
                                                            <div class="user-balance">{{ count($sold_logos_month) ?? 0 }} logos <small class="currency currency-btc">this month</small></div>
                                                            <div class="user-balance-sub"><span>{{ count($sold_logos_year) ?? 0 }} logos <span class="currency currency-btc">this year</span></span></div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                    <div class="card-inner">
                                                        <div class="user-account-info py-0">
                                                            <h6 class="overline-title-alt">Total uploaded logos</h6>
                                                            <div class="user-balance">{{ count($uploaded_logos_month) ?? 0}} logos <small class="currency currency-btc">this month</small></div>
                                                            <div class="user-balance-sub"><span>{{ count($uploaded_logos_year) ?? 0 }} logos <span class="currency currency-btc">this year</span></span></div>
                                                        </div>
                                                    </div><!-- .card-inner -->
                                                </div><!-- .card-inner-group -->
                                            </div><!-- card-aside -->
                                        </div><!-- .card-aside-wrap -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                        @if($pending_logos->isNotEmpty())
                            <div class="nk-block nk-block-lg p-3">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <h3 class="nk-block-title page-title">{{ $designer->first_name ?? '' }}'s Pending Logos</h3>
                                               
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="slider-init row" data-slick='{"slidesToShow": 1, "centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 1540,"settings":{"slidesToShow": 3}},{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 576,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($pending_logos as $logo)    
                                        <div class="col">
                                            <div class="card card-bordered product-card">
                                                <div class="product-thumb">
                                                @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                                    <img src="{{ asset('LogoDirectory/'.$logo->media['directory_name'].'/'.$logo->media['directory_name'].'.png') }}" alt="">
                                                @else
                                                    <img class="card-img-top" src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                                                @endif
                                                        <ul class="product-badges">
                                                            <li>
                                                                @if($logo->status == 3 )
                                                                <span class="badge bg-info">Sold</span>
                                                                @else
                                                                @if($logo->approved_status == 0)
                                                                <span class="badge bg-info">Pending</span>
                                                                @elseif($logo->approved_status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                                @elseif($logo->approved_status == 2) 
                                                                <span class="badge bg-danger">Disapproved</span>
                                                                @endif
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
                        @if($approved_logos->isNotEmpty())
                            <div class="nk-block nk-block-lg p-3">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <h3 class="nk-block-title page-title">{{ $designer->first_name ?? '' }}'s On Sale Logos</h3>
                                               
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="slider-init row" data-slick='{"slidesToShow": 1, "centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 1540,"settings":{"slidesToShow": 3}},{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 576,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($approved_logos as $logo)    
                                        <div class="col">
                                            <div class="card card-bordered product-card">
                                                <div class="product-thumb">
                                                @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                                    <img src="{{ asset('LogoDirectory/'.$logo->media['directory_name'].'/'.$logo->media['directory_name'].'.png') }}" alt="">
                                                @else
                                                    <img class="card-img-top" src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                                                @endif
                                                        <ul class="product-badges">
                                                            <li>
                                                                @if($logo->status == 3 )
                                                                <span class="badge bg-info">Sold</span>
                                                                @else
                                                                @if($logo->approved_status == 0)
                                                                <span class="badge bg-info">Pending</span>
                                                                @elseif($logo->approved_status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                                @elseif($logo->approved_status == 2) 
                                                                <span class="badge bg-danger">Disapproved</span>
                                                                @endif
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
                         @if($rejected_logos->isNotEmpty())
                            <div class="nk-block nk-block-lg p-3">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <h3 class="nk-block-title page-title">{{ $designer->first_name ?? '' }}'s Rejected Logos</h3>
                                               
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="slider-init row" data-slick='{"slidesToShow": 1, "centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 1540,"settings":{"slidesToShow": 3}},{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 576,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($rejected_logos as $logo)    
                                        <div class="col">
                                            <div class="card card-bordered product-card">
                                                <div class="product-thumb">
                                                @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                                    <img src="{{ asset('LogoDirectory/'.$logo->media['directory_name'].'/'.$logo->media['directory_name'].'.png') }}" alt="">
                                                @else
                                                    <img class="card-img-top" src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                                                @endif
                                                        <ul class="product-badges">
                                                            <li>
                                                                @if($logo->status == 3 )
                                                                <span class="badge bg-info">Sold</span>
                                                                @else
                                                                @if($logo->approved_status == 0)
                                                                <span class="badge bg-info">Pending</span>
                                                                @elseif($logo->approved_status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                                @elseif($logo->approved_status == 2) 
                                                                <span class="badge bg-danger">Disapproved</span>
                                                                @endif
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
                         @if($sold_logos->isNotEmpty())
                            <div class="nk-block nk-block-lg p-3">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <h3 class="nk-block-title page-title">{{ $designer->first_name ?? '' }}'s Sold Logos</h3>
                                               
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="slider-init row" data-slick='{"slidesToShow": 1, "centerMode": false, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 1540,"settings":{"slidesToShow": 3}},{"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 576,"settings":{"slidesToShow": 1}} ]}'>
                                    @foreach($sold_logos as $logo)    
                                        <div class="col">
                                            <div class="card card-bordered product-card">
                                                <div class="product-thumb">
                                                @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                                    <img src="{{ asset('LogoDirectory/'.$logo->media['directory_name'].'/'.$logo->media['directory_name'].'.png') }}" alt="">
                                                @else
                                                    <img class="card-img-top" src="{{ asset('logos/'.$logo->media['image_name']) }}" alt="">
                                                @endif
                                                        <ul class="product-badges">
                                                            <li>
                                                                @if($logo->status == 3 )
                                                                <span class="badge bg-info">Sold</span>
                                                                @else
                                                                @if($logo->approved_status == 0)
                                                                <span class="badge bg-info">Pending</span>
                                                                @elseif($logo->approved_status == 1)
                                                                <span class="badge bg-success">Approved</span>
                                                                @elseif($logo->approved_status == 2) 
                                                                <span class="badge bg-danger">Disapproved</span>
                                                                @endif
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
@extends('designer_layout.master')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"> <a href="{{ url('designer-dashboard') }}">Logo Designer Dashboard</a></h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to Logo Designer dashboard</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div>
                            {{ Breadcrumbs::render('designer-dashboard') }}
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
                <div class="p-3 text-end">
                <div class="card-tools">
                    <div class="dropdown">
                        <a href="{{ url('logo-designer-dashboard/uploadlogo/')  }}" class="btn btn-primary btn-dim d-none d-sm-inline-flex" ><em class="icon ni ni-upload-cloud"></em><span><span class="d-none d-md-inline">Upload</span> Logo</span></a>
                    </div>
                </div>
                </div>
                <div class="nk-block">
                    <div class="row g-gs">
                        <div class="col-xxl-6">
                            <div class="row g-gs">
                                <div class="col-xxl-12 col-lg-6">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start gx-3 mb-3">
                                                        <div class="card-title">
                                                            <h6 class="title">Logos Uploads Overview</h6>                                                           
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                                    <div class="nk-sale-data">
                                                                        <span class="amount">@if(count($uploaded_logos_month) == 1) {{ count($uploaded_logos_month) }} logo @else {{ count($uploaded_logos_month) }} logos @endif <span class="change down text-danger"></span></span>
                                                                        <span class="sub-title">This Month</span>
                                                                    </div>
                                                    </div>
                                                    <div class="nk-sales-ck large pt-4">
                                                        <canvas class="sales-overview-chart" id="salesOverview"></canvas>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-xxl-6 col-lg-6">
                                            <div class="card card-bordered h-100">
                                                <div class="card-inner">
                                                    <div class="card-title-group align-start gx-3 mb-3">
                                                        <div class="card-title">
                                                            <h6 class="title">Logos Approved Overview</h6>                                                           
                                                        </div>
                                                    </div>
                                                    <div class="nk-sale-data-group flex-md-nowrap g-4">
                                                                    <div class="nk-sale-data">
                                                                        <span class="amount">@if(count($approved_logos_month) == 1) {{ count($approved_logos_month) }} logo @else {{ count($approved_logos_month) }} logos @endif<span class="change down text-danger"></span></span>
                                                                        <span class="sub-title">This Month</span>
                                                                    </div>
                                                    </div>
                                                    <div class="nk-sales-ck large pt-4">
                                                        <canvas class="sales-overview-chart1" id="salesOverview1"></canvas>
                                                    </div>
                                                </div>
                                            </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-lg-6 col-xxl-12">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="card-title-group align-start mb-2">
                                                                <div class="card-title">
                                                                    <h6 class="title">Previous 12 months approved logos overview</h6>
                                                                    <!-- <p>In last 30 days revenue from subscription.</p> -->
                                                                </div>
                                                                <div class="card-tools">
                                                                    <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
                                                                </div>
                                                            </div>
                                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                                        <div class="nk-sale-data">
                                                                            <span class="amount">@if(count($approved_logos_year) == 1) {{ count($approved_logos_year) }} logo @else {{ count($approved_logos_year) }} logos @endif</span>
                                                                            <span class="sub-title"><span class="change down text-danger"></span>since one year</span>
                                                                        </div>
                                                                        <div class="nk-sales-ck">
                                                                                 <canvas class="sales-bar-chart1" id="salesRevenue1"></canvas>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div><!-- .col -->
                                    <div class="col-lg-6 col-xxl-12">
                                                    <div class="card card-bordered">
                                                        <div class="card-inner">
                                                            <div class="card-title-group align-start mb-2">
                                                                <div class="card-title">
                                                                    <h6 class="title">Previous 12 months uploaded logos overview</h6>
                                                                    <!-- <p>In last 30 days revenue from subscription.</p> -->
                                                                </div>
                                                                <div class="card-tools">
                                                                    <em class="card-hint icon ni ni-help-fill" data-bs-toggle="tooltip" data-bs-placement="left" title="Revenue from subscription"></em>
                                                                </div>
                                                            </div>
                                                            <div class="align-end flex-sm-wrap g-4 flex-md-nowrap">
                                                                        <div class="nk-sale-data">
                                                                            <span class="amount">@if(count($uploaded_logos_year) == 1) {{ count($uploaded_logos_year) }} logo @else {{ count($uploaded_logos_year) }} logos @endif</span>
                                                                            <span class="sub-title"><span class="change down text-danger"></span>since one year</span>
                                                                        </div>
                                                                        <div class="nk-sales-ck">
                                                                                <canvas class="sales-bar-chart2" id="salesRevenue2"></canvas>
                                                                        </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </div><!-- .col -->
                            </div><!-- .row -->
                        </div><!-- .col -->
                    </div>
                    </div>
                    
                </div><!-- .nk-block -->
                @if($logos->isNotEmpty())
                            <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-between g-3">
                                            <div class="nk-block-head-content">
                                               
                                                <!-- <h3 class="nk-block-title page-title">Rejected Logos</h3> -->
                                               
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
                                                <div class="card-head">
                                                                <div class="logo-name">
                                                                    <span class="lead-text">{{ $logo->logo_name }} </span>
                                                                    
                                                                </div>
                                                                <div class="approve-status">
                                                                    <?php
                                                                        if($logo->approved_status == 0){
                                                                    ?>
                                                                        <span class="badge bg-warning">Pending</span>
                                                                    <?php 
                                                                        }elseif($logo->approved_status == 1){
                                                                    ?>
                                                                        <span class="badge bg-success">Approved</span>
                                                                    <?php }else{?>
                                                                        <span class="btn badge bg-danger" data-bs-toggle="modal" data-bs-target="#reasonForDisapproval-{{ $logo->id }}">Reason</span>
                                                                        <a class="btn badge bg-primary" href="{{ url('logo-designer-dashboard/uploadlogo/'.$logo->logo_slug) }}">Replace logo</a>
                                                                        <a class="btn badge bg-danger" href="{{ url('desinger-dashboard/deleteLogo/'.$logo->id) }}">Delete Logo</a>
                                                                    <?php }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                </div>
                                            </div>
                                            
                                        </div><!-- .col -->
                                       
                                        
                                    @endforeach
                                    </div>
                                </div>
                                @foreach($rejected_logos as $logos)
                                <div class="modal fade" id="reasonForDisapproval-{{ $logo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Disapproval reason</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <?php
                                                                    if(isset($logo->admin_review) && !empty($logo->admin_review)){
                                                                        echo "<p> $logo->admin_review </p>";
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                    </div>
                                                                </div>
                                        </div>        
                                @endforeach
                                @endif
                                
                
            </div>
        </div>
    </div>
</div>

@endsection

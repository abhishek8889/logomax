@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">My Logos</h3>
                                        </div>
                                        
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="row g-gs">
                                        @foreach($logos as $logo)
                                        <div class="col-sm-6 col-lg-4 col-xxl-3">
                                            <div class="gallery card card-bordered">
                                                <a class="gallery-image popup-image" href="{{ asset($logo->media['image_path']) }}">
                                                    <img class="w-100 rounded-top" src="{{ asset($logo->media['image_path']) }}" alt="">
                                                </a>
                                                <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            
                                                            <!-- <img src="{{ asset('admin-theme/images/avatar/a-sm.jpg') }}" alt=""> -->
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">{{ $logo->userdata['name'] ?? '' }}</span>
                                                            <span class="sub-text">{{ $logo->userdata['email'] ?? '' }}</span>

                                                        </div>
                                                    </div>
                                                    <div class="">
                                                         <button class="btn btn-primary"> @if($logo->approved_status == 0) Pending @elseif($logo->approved_status == 1) Approved @elseif($logo->approved_status == 2) disapproved @endif</button>
                                                      <!--  <button class="btn btn-danger">Delete</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        
                                    </div>
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>

@endsection
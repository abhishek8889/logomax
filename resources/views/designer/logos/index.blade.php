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
                                                <a class="gallery-image popup-image" href="{{ asset('admin-theme/images/stock/a.jpg') }}">
                                                    <img class="w-100 rounded-top" src="{{ asset('admin-theme/images/stock/a.jpg') }}" alt="">
                                                </a>
                                                <div class="gallery-body card-inner align-center justify-between flex-wrap g-2">
                                                    <div class="user-card">
                                                        <div class="user-avatar">
                                                            <img src="{{ asset('admin-theme/images/avatar/a-sm.jpg') }}" alt="">
                                                        </div>
                                                        <div class="user-info">
                                                            <span class="lead-text">Dustin Mock</span>
                                                            <span class="sub-text">mock@softnio.com</span>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <button class="btn btn-p-0 btn-nofocus"><em class="icon ni ni-heart"></em><span>34</span></button>
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
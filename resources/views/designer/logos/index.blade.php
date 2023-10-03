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
                                                
                                                <a class="gallery-image popup-image" href="{{ asset($logo->media->image_path) }}">
                                                    <img class="w-100 rounded-top" src="{{ asset($logo->media->image_path) }}" alt="">
                                                </a>
                                                <div class="gallery-body card-inner  g-2">
                                                    <div class="user-card d-block">
                                                        <!-- <div class="user-avatar">
                                                            <img src="{{ asset('admin-theme/images/avatar/a-sm.jpg') }}" alt="">
                                                        </div> -->
                                                        <div class="user-info">
                                                            <div class="card-head">
                                                                <div class="logo-name">
                                                                    <span class="lead-text">{{ $logo->logo_name }} ( {{ $logo->category->name }} )</span>
                                                                    
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
                                                                        <span class="badge bg-danger">Not Approved</span>
                                                                    <?php }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="card-tag">
                                                                <?php 
                                                                    $tagsString = $logo->tags;
                                                                    $tagsArr = json_decode($tagsString);
                                                                    if(is_array($tagsArr)){
                                                                        foreach($tagsArr as $ind => $k){
                                                                            $tag = DB::table('tags')->where('id',(int)$k)->value('name');
                                                                ?>
                                                                <span class="tags">
                                                                    {{ $tag }}
                                                                    <?php if($ind < count($tagsArr) - 1){ ?>
                                                                        ,
                                                                    <?php } ?>
                                                                </span>
                                                                <?php } } ?>
                                                            </div>

                                                            <!-- <button class="btn btn-p-0 btn-nofocus" style="margin-top:5px;"><em class="icon ni ni-eye"></em><span class="badge bg-primary">view</span></button> -->

                                                        </div>
                                                    </div>
                                                    <div>
                                                        
                                                        
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
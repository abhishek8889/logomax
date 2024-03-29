@extends('admin_layout/master')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3 d-flex justify-content-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Approved Logos</h3>
                                        </div>
                                        <div>
                                           {{ Breadcrumbs::render('approved-logos') }}
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
                                                        <div class="user-info" >
                                                            <span class="lead-text">{{ $logo->userdata['name'] ?? '' }}</span>
                                                            <span class="sub-text">{{ $logo->userdata['email'] ?? '' }}</span>
                                                                <div class="user-info" >
                                                                    <span class="lead-text">{{ $logo->logo_name ?? '' }}</span>
                                                                    <!-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleviewModal{{ $logo->id ?? '' }}" style="padding:0px;">
                                                                    View More
                                                                    </button> -->
                                                                    <a href="{{ url('admin-dashboard/logo-detail/'.$logo->logo_slug) }}">View More</a>
                                                                </div>

                                                        </div>
                                                    </div>
                                                    <!-- <div class="">
                                                         <a status="{{ $logo->approved_status ?? '' }}" action="approved" data-id="{{ $logo->id ?? '' }}"  class="btn btn-primary statusbutton">Approved</a>
                                                       <button status="{{ $logo->approved_status ?? '' }}" action="deapproved" data-id="{{ $logo->id ?? '' }}" class="btn btn-danger statusbutton">disapproved</button>
                                                    </div> -->
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
                  <!-- logo deatil  modal-->
                  @forelse($logos as $logo)
                <div class="modal fade" id="exampleviewModal{{ $logo->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Logo Detail</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <h5>Designer Detail</h5>
                          Name: {{ $logo->userdata['name'] ?? '' }} <br>
                          Email: {{ $logo->userdata['email'] ?? '' }} <br>
                          Experience: {{ $logo->userdata['experience'] ?? '' }} <br>
                          Address: {{ $logo->userdata['address'] ?? '' }} , {{ $logo->userdata['country'] ?? '' }} <br>
                          Uploaded on: {{ $logo->created_at ?? '' }}<br><br>

                          Logo_size: {{ $logo->media['image_size'] ?? '' }}<br>
                          Dimensions: {{ $logo->media['image_dimensions'] ?? '' }}<br>
                          Image Format : {{ $logo->media['image_format'] ?? '' }}<br><br>

                          Category: {{ $logo->category['name'] ?? '' }}<br>

                        @if($logo->tags !== null)
                        Tags: 
                        <?php
                        $tags = json_decode($logo->tags);
                        foreach($tags as $t){
                        $tagmodel =  App\Models\Tag::class;
                                        $tag = $tagmodel::find($t);
                               if($tag){
                                echo '#'.$tag->name.',';
                               }
                        }
                        ?>
                        @endif




                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                        </div>
                    </div>
                </div>
                @empty
                <h4 class="text-center">No approved logos found</h4>
                @endforelse

                
@endsection
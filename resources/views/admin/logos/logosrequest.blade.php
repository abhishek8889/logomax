@extends('admin_layout/master')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3 d-flex justify-content-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Logos Requests</h3>
                                        </div>
                                        <div>{{ Breadcrumbs::render('logos-request') }}</div>
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
                                                        <div class="user-info" >
                                                            <span class="lead-text">{{ $logo->logo_name ?? '' }}</span>
                                                            <!-- <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#exampleviewModal{{ $logo->id ?? '' }}" style="padding:0px;">
                                                               View More
                                                            </button> -->
                                                            <a href="{{ url('admin-dashboard/logo-detail/'.$logo->logo_slug) }}">View More</a>
                                                        </div>
                                                    </div>
                                                    <div class="">
                                                        <button status="{{ $logo->approved_status ?? '' }}" action="approved" data-id="{{ $logo->id ?? '' }}"  class="btn btn-primary statusbutton">Approve</button>
                                                        <button status="{{ $logo->approved_status ?? '' }}" action="deapproved" data-id="{{ $logo->id ?? '' }}" class="btn btn-danger statusbutton">Disapprove</button>
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
                <!-- Button trigger modal -->

                <!-- logo deatil  modal-->
                @foreach($logos as $logo)
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
                          Experience: {{ $logo->userdata['experience'] ?? 0 }} years <br>
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
                @endforeach
                <!-- logos review modal -->
                <!-- Modal -->
                <!-- Dissapproval modal -->
                    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ url('admin-dashboard/updatestatus') }}" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Reason for disapproval ?</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="logo_id" id="logo_id" value="">
                                    <div class="form-control-wrap">
                                        <textarea class="form-control no-resize" name="review" id="default-textarea"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button> -->
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>

                    <!-- Set price modal  -->
                    <div class="modal fade" id="setPrice" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ url('admin-dashboard/updatestatus') }}" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Price for logo </h5>
                                    <button type="button" class="close" data-dismiss="setPrice" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- <input type="hidden" name="logo_id" id="logo_id" value=""> -->
                                    <div class="form-control-wrap">
                                        <label class="" for="for-customer">For customer : </label>
                                        <input class="form-control no-resize" name="for-customer" id="for-customer" type="number" />
                                    </div>
                                    <hr>
                                    <div class="form-control-wrap">
                                        <label class="" for="for-designer">For designer : </label>
                                        <input class="form-control no-resize" name="for-designer" id="for-designer" type="number" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary close" data-dismiss="modal">Close</button> -->
                                    <button type="submit" id="approve-submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function(){
                        $('.spinner-container').hide();
                        $('.statusbutton').on('click',function(e){
                            e.preventDefault();
                            action = $(this).attr('action');
                            id = $(this).attr('data-id');
                            status = $(this).attr('status');
                            if(action == 'deapproved'){
                                $('input#logo_id').val(id);
                                $('#exampleModalCenter').modal("show","true");
                            }else{
                                $('#setPrice').modal("show","true");
                                $('input#logo_id').val(id);
                                $('#approve-submit').click(function(e){
                                    e.preventDefault();
                                    let customer_price = $("#for-customer").val();
                                    let designer_price = $("#for-designer").val();
                                    $('.spinner-container').show();
                                $.ajax({
                                    method: 'post',
                                    url: '{{ url('admin-dashboard/updatestatus') }}',
                                    data: { id:id,action:action,customer_price:customer_price,designer_price:designer_price,approved_status:status,_token:'{{ csrf_token() }}' },
                                    success: function(response){
                                        NioApp.Toast(response, 'info', {position: 'top-right'}); 
                                        setTimeout(() => {
                                            location.reload();
                                        }, 1000);    
                                    }
                                });

                                })
                                
                            }

                        });
                    });
                </script>
                <script>
                    $('.close').click(function(){
                        $('#exampleModalCenter').modal("hide");
                        $('#setPrice').modal("hide");
                    });
                </script>
@endsection
@extends('admin_layout/master')
@section('content')
<div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3 d-flex justify-content-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Sold Logos</h3>
                                        </div>
                                        <div>
                                           {{ Breadcrumbs::render('sold-logos') }}
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
                                                        <div class="user-info" >
                                                            <span class="lead-text">({{ $logo->logo_name ?? '' }})</span>
                                                            <span class="designer-name">{{ $logo->userdata['name'] ?? '' }}</span>
                                                            <span class="sub-text">{{ $logo->userdata['email'] ?? '' }}</span>
                                                            <div class="user-info mt-2" >
                                                                <a href="{{ url('admin-dashboard/logo-detail/'.$logo->logo_slug) }}" class="view-more action-btn btn btn-primary">View More</a>
                                                                <a href="#" class="add-review-btn action-btn btn btn-primary" logo_id="{{ $logo->id }}" >Add review</a>
                                                            </div>
                                                            
                                                        </div>
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
                <!-- Add Review Modal -->
                <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                         <form action="">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="title">Title</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="title" class="form-control" placeholder="Enter title" id="title" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Description</label>
                                    <div class="form-control-wrap">
                                        <textarea name="description" class="form-control" id="description" value="" placeholder="Enter your review" rows = "4" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="description">Star Rating</label>
                                    <div class="form-control-wrap">
                                        <input class="form-control" type="number" min="1" max="5" name="star_rating" value=""/>
                                    </div>
                                </div>
                            </div>
                         </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="submitReviewBtn">Submit Review</button>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- Review Modal End -->
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
                <h4 class="text-center">No disapproved logos found</h4>
                @endforelse
                <script>
                    let count = 0 ; 
                    $(document).on('click','.add-review-btn',function(e){
                        e.preventDefault();
                        let logo_id = $(this).attr('logo_id');
                        $("#reviewModal").modal('show');
                        $("#submitReviewBtn").on('click',function(e){
                            e.preventDefault();
                            logo_id = logo_id;
                            let title = $("input[name=title]").val();
                            let description = $("textarea[name=description]").val();
                            let star_rating = $("input[name=star_rating]").val();
                            let dataSent = false;
                            if((title !== '' || title !== undefined || title !== null) && (description !== '' || description !== undefined) && (star_rating !== '' || star_rating !== undefined) && (star_rating !== '' || star_rating !== undefined)){
                                dataSent = true;
                            }
                            if(dataSent == true && count < 1){
                                count = count + 1;
                                $.ajax({
                                    url: "{{ url('/admin-dashboard/add-review-process') }}",
                                    method: 'POST',
                                    data: {
                                    "_token": "{{ csrf_token() }}",
                                    "title" : title,
                                    "description" : description,
                                    "star_rating" : star_rating,
                                    "logo_id" : logo_id,
                                    "review_by" : "admin",
                                    },
                                    beforeSend: function() {
                                        $('.spinner-container').show();
                                    },
                                    success: function(data, status, xhr){
                                        if(xhr.status == 201){
                                            setTimeout(()=>{
                                            $('.spinner-container').hide();
                                                $(".loader-box").hide();
                                                Swal.fire(
                                                    'Review is added',
                                                    'You have added a review !',
                                                    'success'
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        location.reload();
                                                    }
                                                });
                                            }, 1000);
                                        }else{
                                            setTimeout(()=>{
                                            $('.spinner-container').hide();
                                                $(".loader-box").hide();
                                                Swal.fire(
                                                    'Error',
                                                    'There is an error in processing.',
                                                    'error'
                                                ).then((result) => {
                                                    if (result.isConfirmed) {
                                                        location.reload();
                                                    }
                                                });
                                            }, 1000);
                                        }
                                    },
                                    error: function(response) {
                                        $('.spinner-container').hide();
                                        console.log(error);
                                    }
                                });
                            }
                        });
                    })
                </script>
                
@endsection
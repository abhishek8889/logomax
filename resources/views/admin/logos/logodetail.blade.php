@extends('admin_layout/master')
@section('content') 
            <div class="nk-content ">
                    <div class="container">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between g-3 d-flex justify-content-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Logo Details</h3>
                                            <div class="nk-block-des text-soft">
                                                <p>{{ $logos->logo_name ?? '' }}</p>
                                            </div>
                                        </div>
                                        <div class="nk-block-head-content text-center">
                                            {{ Breadcrumbs::render('logos-detail',$logos->logo_slug) }}
                                        </div>
                                    </div>
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="card-inner">
                                            <div class="row ">
                                                <div class="col-lg-6">
                                                <img src="{{ asset('logos/'.$logos->media['image_name']) }}" class="w-100" alt="">
                                                </div><!-- .col -->
                                                <div class="col-lg-6">
                                                    <div class="product-info mt-5 me-xxl-5">
                                                        <h2 class="product-title">{{ $logos->logo_name ?? '' }}</h2>
                                                      
                                                        <div class="product-excrept text-soft">
                                                        <h5>Designer Detail</h5>
                                                            Name: {{ $logos->userdata['name'] ?? '' }} <br>
                                                            Email: {{ $logos->userdata['email'] ?? '' }} <br>
                                                            Experience: {{ $logos->userdata['experience'] ?? 0 }} years <br>
                                                            Address: {{ $logos->userdata['address'] ?? '' }} , {{ $logos->userdata['country'] ?? '' }} <br><br>
                                                            
                                                        <h5>Logo Details</h5>
                                                            Logo_size: {{ $logos->media['image_size'] ?? '' }}<br>
                                                            Dimensions: {{ $logos->media['image_dimensions'] ?? '' }}<br>
                                                            Image Format : {{ $logos->media['image_format'] ?? '' }}<br>
                                                            Uploaded on: {{ $logos->created_at ?? '' }}<br>
                                                            Category: {{ $logos->category['name'] ?? '' }}<br>

                                                            @if($logos->tags !== null)
                                                            Tags: 
                                                            <?php
                                                            $tags = json_decode($logos->tags);
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
                                                        <!-- <div class="product-meta">
                                                            <ul class="d-flex g-3 gx-5">
                                                                <li>
                                                                    <div class="fs-14px text-muted">Type</div>
                                                                    <div class="fs-16px fw-bold text-secondary">Watch</div>
                                                                </li>
                                                                <li>
                                                                    <div class="fs-14px text-muted">Model Number</div>
                                                                    <div class="fs-16px fw-bold text-secondary">Forerunner 290XT</div>
                                                                </li>
                                                            </ul>
                                                        </div> -->
                                                        <!-- <div class="product-meta">
                                                            <h6 class="title">Color</h6>
                                                            <ul class="custom-control-group">
                                                                <li>
                                                                    <div class="custom-control color-control">
                                                                        <input type="radio" class="custom-control-input" id="productColor1" name="productColor" checked>
                                                                        <label class="custom-control-label dot dot-xl" data-bg="#754c24" for="productColor1"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control color-control">
                                                                        <input type="radio" class="custom-control-input" id="productColor2" name="productColor">
                                                                        <label class="custom-control-label dot dot-xl" data-bg="#636363" for="productColor2"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control color-control">
                                                                        <input type="radio" class="custom-control-input" id="productColor3" name="productColor">
                                                                        <label class="custom-control-label dot dot-xl" data-bg="#ba6ed4" for="productColor3"></label>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="custom-control color-control">
                                                                        <input type="radio" class="custom-control-input" id="productColor4" name="productColor">
                                                                        <label class="custom-control-label dot dot-xl" data-bg="#ff87a3" for="productColor4"></label>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div> -->
                                                        <div class="product-meta">
                                                        @if($logos->approved_status == 0)
                                                            <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                                <li class="w-140px">
                                                                <button status="{{ $logos->approved_status ?? '' }}" action="approved" data-id="{{ $logos->id ?? '' }}"  class="btn btn-primary statusbutton">Approve</button>
                                                                </li>
                                                                <li>
                                                                <button status="{{ $logos->approved_status ?? '' }}" action="deapproved" data-id="{{ $logos->id ?? '' }}" class="btn btn-danger statusbutton">Disapprove</button>
                                                                </li>
                                                            </ul>
                                                        @else
                                                        <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                            @if($logos->status == 3)
                                                                <li class="w-140px">
                                                                    <button class="btn btn-danger">Sold</button>
                                                                </li>
                                                            @else
                                                                <li class="w-140px">
                                                                    @if($logos->approved_status == 1)<span class="badge bg-success">approved</span>@elseif($logos->approved_status == 2) <span class="badge bg-danger">Disapproved </span> @endif
                                                                </li>
                                                                @if($logos->approved_status == 2)
                                                                <li class="w-140px">
                                                                <button status="{{ $logos->approved_status ?? '' }}" action="approved" data-id="{{ $logos->id ?? '' }}"  class="btn btn-primary statusbutton">Approve</button>
                                                                </li>
                                                                @elseif($logos->approved_status == 1)
                                                                <li>
                                                                <button status="{{ $logos->approved_status ?? '' }}" action="deapproved" data-id="{{ $logos->id ?? '' }}" class="btn btn-danger statusbutton">Disapprove</button>
                                                                </li>
                                                                @endif
                                                            @endif
                                                        </ul>
                                                        @endif
                                                        </div><!-- .product-meta -->
                                                    </div><!-- .product-info -->
                                                </div><!-- .col -->
                                            </div><!-- .row -->
                                            <hr class="hr border-light">
                                          
                                        </div>
                                    </div>
                                </div><!-- .nk-block -->
                               
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- logos review modal -->
                <!-- Modal -->
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
                <!-- Set price for customers and Designers -->
                <div class="modal fade" id="setPrice" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{ url('admin-dashboard/updatestatus') }}" method="post">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Price for logo ?</h5>
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
                                    <hr>
                                    <div class="form-control-wrap">
                                        <label class="" for="logo_type">Logo Type : </label>
                                        <select name="logo_type" id="logo_type" class="form-control">
                                            <option value="low-price">Low Price logo</option>
                                            <option value="premium">Premium logo</option>
                                        </select>
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
                <!-- End -->
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
                                $('input#logo_id').val(id);
                                $('#setPrice').modal("show","true");
                                $("#approve-submit").on('click',function(e){
                                    e.preventDefault();
                                    let customer_price = $("#for-customer").val();
                                    let designer_price = $("#for-designer").val();
                                    let logo_type = $("#logo_type").val();
                                    console.log(logo_type);
                                    // console.log(customer_price + ' => ' + designer_price);
                                    $('.spinner-container').show();
                                    $.ajax({
                                        method: 'post',
                                        url: '{{ url('admin-dashboard/updatestatus') }}',
                                        data: { id:id,action:action,logo_type:logo_type,customer_price:customer_price,designer_price:designer_price,approved_status:status,_token:'{{ csrf_token() }}' },
                                        success: function(response){
                                            NioApp.Toast(response, 'info', {position: 'top-right'}); 
                                            setTimeout(() => {
                                                location.reload();
                                            }, 1000);    
                                        }
                                    });
                                });
                                
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
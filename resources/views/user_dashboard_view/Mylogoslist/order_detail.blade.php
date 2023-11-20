@extends('user_dashboard_layout.master_layout')
@section('content')
<style>
    .pricing-box {
    display: flex;
    gap: 14px;
}

/* .pricig_list {
    margin-top: 22px;
} */

.dashboard-section {
    padding: 73px 0px;
}
img {
    max-width: 100%;
    height: auto;
}

    #full-stars-example-two {

/* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
.rating-group {
  display: inline-flex;
}

/* make hover effect work properly in IE */
.rating__icon {
  pointer-events: none;
}

/* hide radio inputs */
.rating__input {
 position: absolute !important;
 left: -9999px !important;
}

/* hide 'none' input from screenreaders */
.rating__input--none {
  display: none
}

/* set icon padding and size */
.rating__label {
  cursor: pointer;
  padding: 0 0.1em;
  font-size: 2rem;
}

/* set default star color */
.rating__icon--star {
  color: orange;
}

/* if any input is checked, make its following siblings grey */
.rating__input:checked ~ .rating__label .rating__icon--star {
  color: #ddd;
}

/* make all stars orange on rating group hover */
.rating-group:hover .rating__label .rating__icon--star {
  color: orange;
}

/* make hovered input's following siblings grey on hover */
.rating__input:hover ~ .rating__label .rating__icon--star {
  color: #ddd;
}
}

/*  Calendar Css for box  */
.fc-content-skeleton {
    height: 100%;
}

.fc-row .fc-content-skeleton table {
    height: 100%;
}

td.fc-event-container a {
    height: 100%;
    display: flex;
    width: 100%;
    margin: 0px;
    align-items: center;
    padding: 5px 10px;
}

td.fc-event-container {}

td.fc-day-top {
    position: relative;
}

td.fc-day-top span.fc-day-number {
    position: absolute;
    right: 0;
    padding: 5px 11px;
}

.fc-content-skeleton * {
    box-sizing: border-box;
}
.fc-scroller.fc-day-grid-container {
    overflow: visible !important;
}
</style>
<div>
{{ Breadcrumbs::render('user-order-detail',$orderDetail[0]->order_num) }}
</div>
<section class="dashboard-section">
    <div class="container">
        @if($orderDetail)
            @foreach($orderDetail as $order)
            <?php 
                $media = App\Models\Media::class;
                $mediaObj = $media::find($order->logodetail->media_id);
                $image_name = $mediaObj->image_name;
                $image_url = asset($mediaObj->image_path);
            ?>
            <div class="card mb-3" >
                <div class="row">
                    <div class="col-md-4 ">
                        <img src="{{ $image_url ?? ''; }}" alt="{{ $image_name ?? ''; }}">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title text text-dark ">Order Number : #{{ $order->order_num }}</h5>
                        <p class="card-text">Order On : {{ $order->created_at }}</p>
                        
                            <div class="price_title">
                              <h6>  Pricing Detail : </h6>
                            </div>
                        <div class="pricing-box">
                            <div class="pricig_list">
                                                Price : ${{ $order->price }} <br>
                                                Taxes : VAT/GST/Sales taxes ({{ (int)$order->tax_percent }}%) : ${{ $order->taxes }} <br>
                                                <?php if($order->logo_for_future_status == 1){ ?>
                                                Save your logo for later in account <i class="bi-check2"></i> : ${{ $order->logo_for_future_price }} <br>
                                                <?php } ?>
                                                <?php if($order->get_favicon_status == 1){ ?>
                                                Get favicon of logo : ${{ $order->get_favicon_price }} <br>
                                                <?php } ?>
                                                Total payment : ${{ $order->total_payment_amount }} 
                            </div>
                        </div>
                        <p class="mt-3">Order Status : <span class="badge badge-success">Success</span></p>
                        <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#exampleModalCenter{{ $order->id ?? '' }}">Add Review</button>
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        @endif
    </div>
</section>
@if($orderDetail)
            @foreach($orderDetail as $order)
    <div class="modal fade" id="exampleModalCenter{{ $order->id ?? '' }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Add Review</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ url('user-dashboard/reviewSubmit') }}" method="post" class="review_form">
                @csrf
                <input type="hidden" name="logo_id" value="{{ $order->logodetail->id ?? '' }}">
                <div class="form-group">
                   <label for="title">Title</label>
                   <input type="text" class="form-control" id="title" name="title">
                </div>
                @error('title')
                            <span class="text text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                   <label for="description">description</label>
                   <textarea class="form-control" id="description" name="description" ></textarea>
                @error('description')
                         <span class="text text-danger">{{ $message }}</span>
                 @enderror
                </div>
                <div>Rating</div>
                <div id="full-stars-example-two">
                    <div class="rating-group">
                        <input disabled checked class="rating__input rating__input--none" name="rating" id="rating3-none" value="0" type="radio">
                        <label aria-label="1 star" class="rating__label" for="rating3-1" data-toggle="tooltip" data-placement="top" title="Very Bad"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-1" value="1" type="radio" >
                        <label aria-label="2 stars" class="rating__label" for="rating3-2" data-toggle="tooltip" data-placement="top" title="Bad"><i class="rating__icon rating__icon--star fa fa-star" ></i></label>
                        <input class="rating__input" name="rating" id="rating3-2" value="2" type="radio">
                        <label aria-label="3 stars" class="rating__label" for="rating3-3" data-toggle="tooltip" data-placement="top" title="Nice"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-3" value="3" type="radio">
                        <label aria-label="4 stars" class="rating__label" for="rating3-4" data-toggle="tooltip" data-placement="top" title="Very Nice"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-4" value="4" type="radio">
                        <label aria-label="5 stars" class="rating__label" for="rating3-5" data-toggle="tooltip" data-placement="top" title="Brilliant"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                        <input class="rating__input" name="rating" id="rating3-5" value="5" type="radio" checked>
                    </div>
                </div>
                @error('rating')
                            <span class="text text-danger">{{ $message }}</span>
                    @enderror
                <div class="form-group">
                    <button type="button" class="btn btn-primary submitbutton">Submit</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    </div>
    
    @endforeach
@endif
<script>
$('.submitbutton').on('click',function(e){
    e.preventDefault();
    title = $('input[name="title"]').val();
    description = $('textarea[name="description"]').val();
    rating = $('input[name="rating"]').val();

   if(title == "" || description == ""){
    iziToast.error({
      message: "Fill all the field below!",
      position: 'topRight'
    });
   }else{

    $('.review_form').submit();
   }
    return false;
});
</script>
@endsection
@extends('user_layout/master')
@section('content')
<style>
    .pricing-box {
    display: flex;
    gap: 14px;
}

.pricig_list {
    margin-top: 22px;
}

.dashboard-section {
    padding: 73px 0px;
}
img {
    max-width: 100%;
    height: auto;
}
</style>
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

                        <div class="pricing-box">
                           
                            <div class="price_title">
                                Pricing Detail :
                            </div>
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
                    </div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
        @endif
    </div>
</section>

@endsection
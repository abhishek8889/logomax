@extends('user_layout/master')
@section('content')
<style>
    .dashboard-section {
        padding: 73px 0px;
    }
</style>
<section class="dashboard-section">
    <div class="container">
        <h3>Order list</h3>
        <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Order Num</th>
            <th scope="col">Image</th>
            <th scope="col">Logo Name</th>
            <th scope="col">Price</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            
            @if($orderDetail)
            <?php 
            $count = 0;
            ?>
            @foreach($orderDetail as $order)
            <tr>
                <?php 
                    $count = $count + 1;
                    $media = App\Models\Media::class;
                    $mediaObj = $media::find($order->logodetail->media_id);
                    $image_name = $mediaObj->image_name;
                    $image_url = asset($mediaObj->image_path);
                    // dd($media_all);
                ?>
                <th scope="row">{{ $count }}</th>
                <td>{{ $order->order_num }}</td>
                <th><img src="{{ $image_url }}" alt="{{ $image_name }}" height="70px" width="75px"></th>
                <td>{{ $order->logodetail->logo_name }}</td>
                <td>${{ $order->price }}</td>
                <td><a class="btn btn-warning" href="{{ url('/order-details/'.$order->order_num) }}">View Order</a></td>
            </tr>
            @endforeach
            @endif
        </tbody>
        </table>
    </div>
</section>

@endsection
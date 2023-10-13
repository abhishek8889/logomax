@extends('user_layout/master')
@section('content')
<section class="dashboard-section">
    <div class="container">
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
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <th><img src="data:image/png;base64,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" alt="" height="40px" width="45px"></th>
                <td>Otto</td>
                <td>@mdo</td>
                <td><button class="btn btn-warning">View Order</button></td>
            </tr>
            
        </tbody>
        </table>
    </div>
</section>

@endsection
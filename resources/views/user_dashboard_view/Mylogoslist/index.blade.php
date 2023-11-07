@extends('user_dashboard_layout.master_layout')
@section('content')
    <div style="display: block;">
        <h3>My Logos</h3>
        <table class="table p-3 table-borderless">
            <thead class="p-5">
                <tr>
                    <th scope="col"></th>
                    <th scope="col-4">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Added Date</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td class="align-content-center" scope="row-4">
                        <div style="display: flex;">
                            <div class="">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="fa-square"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="p-lg-4">
                                <p>Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>

                            </div>
                    </td>
                    <td class="p-lg-4">$130</td>
                    <td class="p-lg-4">27 oct, 2013</td>
                    <td> <i class="fas fa-ellipsis-v"></i></td>
                </tr>
                <tr>
                    <td></td>
                    <td scope="row-4">
                        <div style="display: flex;">
                            <div class="">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="fa-square"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="p-lg-4">
                                <p>Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>

                            </div>
                    </td>
                    <td class="p-lg-4">$130</td>
                    <td class="p-lg-4">27 oct, 2013</td>
                    <td> <i class="fas fa-ellipsis-v"></i></td>
                </tr>
                <tr>
                    <td></td>
                    <td scope="row-4">
                        <div style="display: flex;">
                            <div class="">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="fa-square"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="p-lg-4">
                                <p>Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>

                            </div>
                    </td>
                    <td class="p-lg-4 align-content-center">$130</td>
                    <td class="p-lg-4 align-content-center">27 oct, 2013</td>
                    <td><i class="fas fa-ellipsis-v"></i></td>
                </tr>
            </tbody>
        </table>

    </div>
@endsection

@extends('user_dashboard_layout.master_layout')
@section('content')
    <div style="display: flex;" class="col py-3">
        <div style="display: inline;" class="col-5 py-3">
            <h4>Welcome to Dashboard</h4>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quis deserunt accusamus dolor?
                Officia,
                quae doloremque voluptatum saepe animi ipsum iste assumenda, sapiente, rem dicta dolores
                iusto
                voluptate sint qui velit.
            </p>
        </div>

        <div class="d-inline-block col-6 py-3">

            <div style="float: right;" class="d-inline-block col-8 py-3 border border-dark bg-white">
                <h4 class="align-content-center">Recent Chats</h4>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li>
                        <div style="display: flex;">
                            <div class="col">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="">
                                <h6>lorem</h6>
                                <p style="font-size: small;">Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <div class="col">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="">
                                <h6>lorem</h6>
                                <p style="font-size: small;">Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div style="display: flex;">
                            <div class="col">
                                <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                                    style="width: 50px;" alt="Avatar" />
                            </div>
                            <div class="">
                                <h6>lorem</h6>
                                <p style="font-size: small;">Lorem ipsum, dolor sit amet consectetur
                                    adipisicing
                                    elit. </p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

        </div>

    </div>
    <div style="display: block;">
        <h3>My Favorites</h3>
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
                    <td> <i style="color: red;" class="fas fa-heart"></i></td>
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
                    <td> <i style="color: red;" class="fas fa-heart"></i></td>
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
                    <td><i style="color: red;" class="fas fa-heart"></i></td>
                </tr>
            </tbody>
        </table>

    </div>
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

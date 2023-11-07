<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <title>Dashboard</title>
</head>

<body class="d-flex flex-column min-vh-100" style="background-color: rgb(246, 252, 250);">
    <nav class="navbar navbar-expand-lg navbar-light bg-white p-lg-2">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand" style="font-size: 50px;" href="#"><strong>LOGO</strong><strong
                    style="color: rgb(105, 241, 105);">MAX</strong></a>

        </div>
        <div st class="col-2 ">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-success" type="submit"><i style="color: white;"
                        class="fas fa-search"></i></button>
            </form>
        </div>
        &nbsp;&nbsp;
        <ul class="navbar-nav mr-auto">
            <li class="nav-item align-content-center">
                <a class="nav-link" href="#"><i class="fas fa-bell"></i> </a>
            </li>
            <li class="nav-item align-content-center">
                <a class="nav-link" href="#"><i class="fas fa-envelope"></i> </a>
            </li>
            <li class="nav-item">
                <div class="col">
                    <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle"
                        style="width: 50px;" alt="Avatar" />
                </div>
            </li>


        </ul>

    </nav>
    <div class="container-fluid ">
        <div>
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 bg-dark">

                        <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">

                            <li class="nav-link  px-0 align-middle">
                                <a href="/dashboard" style="transition: color 0.2s;" data-bs-toggle="collapse"
                                    class="nav-link  px-0 align-middle  text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-home"></i></span>&nbsp;&nbsp;<span
                                        class="ms-1 d-none d-sm-inline">
                                        Dashboard</span> </a>

                            </li>
                            <li class="nav-link  px-0 align-middle">
                                <a href="/favourites" class="nav-link px-0 align-middle text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-heart"></i></span>&nbsp;&nbsp;<span
                                        class="ms-1 d-none d-sm-inline">my
                                        favorites</span></a>
                            </li>
                            <li class="nav-link  px-0 align-middle">
                                <a href="/logo" data-bs-toggle="collapse"
                                    class="nav-link px-0 align-middle text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-shopping-cart"></i></span>&nbsp;&nbsp; <span
                                        class="ms-1 d-none d-sm-inline">MY Logos</span></a>

                            </li>
                            <li class="nav-link  px-0 align-middle">
                                <a href="/messages" data-bs-toggle="collapse"
                                    class="nav-link px-0 align-middle text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-envelope"></i></span>&nbsp;&nbsp;<span
                                        class="ms-1 d-none d-sm-inline">messages</span>
                                </a>

                            </li>
                            <li class="nav-link  px-0 align-middle">
                                <a href="/configuration" class="nav-link px-0 align-middle text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-cog"></i></span>&nbsp;&nbsp; <span
                                        class="ms-1 d-none d-sm-inline">Configurations</span> </a>
                            </li>
                            <li class="nav-link  px-0 align-middle">
                                <a href="/subscriptions" class="nav-link px-0 align-middle text-white">
                                    <span class="rounded border p-2">
                                        <i class="fas fa-dollar-sign"></i> </span>&nbsp;&nbsp;<span
                                        class="ms-1 d-none d-sm-inline">subscriptions</span> </a>
                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>
                <div class="col py-3">
                    @yield('content')
            
                
                <footer class="mt-5 text-lg-start bg-white text-muted  ">
                    <div class=" p-4" style="background-color: #f7f3f3;">
                        Copyright © 2023
                        <a class="text-reset fw-bold" href="#">LOGOMAX</a>
                        .All rights reserved
                    </div>
                    <div class="text-lg-right p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                        

                    </div>
                    <!-- Copyright -->
                </footer>

            </div>

        </div>
    </div>
   

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>

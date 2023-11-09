@extends('user_dashboard_layout.master_layout')
@section('content')
    <div style="display: flex;">
        <div class="d-block p-lg-5">
            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle p-xl-1" alt="Avatar" />
        </div>
        <br>
        <div class="p-lg-5">
            <p>Name:
            <h5>TOM XYZ</h5>
            </p>
            <br>
            <p>Email:
            <h5>tom@gmail.com</h5>
            </p>
            <br>
            <p>Number:
            <h5>123-12121213</h5>
            </p>
           <button class="btn btn-success">edit</button>
        </div>
    </div>
    <h3 class="d-block"> change Password</h3>
    <form class="col py-3 p-lg-5">
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">confirm Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="confirm Password">
        </div>

        <button type="submit" class="btn btn-primary">Change</button>
    </form>
@endsection

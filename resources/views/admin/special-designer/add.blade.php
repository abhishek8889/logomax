@extends('admin_layout/master')
@section('content')
    <div class="d-flex justify-content-end">
    </div>
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">In-House Designer</h5>
            </div>
            <form action="{{ url('admin-dashboard/add-special-designer') }}" method="POST" enctype="">
                @csrf
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="name" class="form-control" id="name" value="">
                        </div>
                        @error('name')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="email">Email</label>
                        <div class="form-control-wrap">
                            <input type="email" name="email" class="form-control" id="email" value="">
                        </div>
                        @error('email')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="form-control-wrap">
                            <input type="password" name="password" class="form-control" id="password" >
                        </div>
                        @error('password')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
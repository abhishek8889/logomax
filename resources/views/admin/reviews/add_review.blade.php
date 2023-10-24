@extends('admin_layout/master')
@section('content')
    <div class="d-flex justify-content-end">
        {{-- Breadcrumbs::render('add-special-desinger') --}}
    </div>
    <div class="card card-bordered h-100">
        <div class="card-inner">
            <div class="card-head">
                <h5 class="card-title">In-House Designer</h5>
            </div>
            <form action="" method="POST" enctype="">
              @csrf
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="title">Title</label>
                        <div class="form-control-wrap">
                            <input type="text" name="title" class="form-control" id="title" value="">
                        </div>
                        @error('title')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <div class="form-control-wrap">
                            <input type="email" name="description" class="form-control" id="description" value="">
                        </div>
                        @error('email')
                            <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="logo">Select Logo</label>
                        <div class="form-control-wrap">
                            <select name="" id="">
                                <option value=""></option>
                            </select>
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
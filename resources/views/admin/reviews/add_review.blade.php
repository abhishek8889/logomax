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
            <form action="{{ url('/admin-dashboard/add-review-process') }}" method="POST" enctype="">
              @csrf
                <div class="col-lg-6">
                    <input type="hidden" name="id" value="{{ $review->id ?? '' }}">
                    <div class="form-group">
                        <label class="form-label" for="title">Title</label>
                        <div class="form-control-wrap">
                            <input type="text" name="title" class="form-control" id="title" value="{{ $review->title ?? ''  }}" max=5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <div class="form-control-wrap">
                            <textarea name="description" class="form-control" id="description" >{{ $review->description ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="logo">Select Logo</label>
                        <div class="form-control-wrap">
                            <select name="logo_id" id="select_logo" class="form-control">
                                @if(isset($soldLogoList))
                                <option value="select-logo">Select Logo</option>
                                @foreach($soldLogoList as $logo)
                                <option value="{{ $logo->id }}" @if($review->logo_id == $logo->id) selected @endif>{{ $logo->logo_name }}</option>
                                @endforeach
                                @else
                                <option value="no-logo">No logo is there</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <div class="form-control-wrap">
                            <input type="number" class="form-control" name="rating" value="{{ $review->rating ?? '' }}">
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
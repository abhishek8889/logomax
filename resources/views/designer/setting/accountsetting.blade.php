@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
            <div class="nk-block nk-block-lg p-4">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Account Settings</h4>
                                            </div>
                                            <div>
                                                {{ Breadcrumbs::render('account-setting') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <form action="{{ url('designer-dashboard/setting/submitProc') }}" method="post">
                                                    @csrf
                                                <div class="preview-block">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="first_name">First Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="first_name" id="first_name" value="{{ $user->first_name ?? '' }}">
                                                                </div>
                                                                @error('first_name')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="last_name">Last Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="last_name" id="last_name" value="{{ $user->last_name ?? '' }}">
                                                                </div>
                                                            </div>
                                                            @error('last_name')
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <!-- <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="country">Country</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="country" name="country" value="{{ $user->country ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="address">Address</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" id="address" name="address" value="{{ $user->address ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div> -->
                                                        <div class="col-sm-6 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>
                    </div>
</div>

@endsection
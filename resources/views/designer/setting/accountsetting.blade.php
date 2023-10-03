@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
            <div class="nk-block nk-block-lg p-4">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Account Setting</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <form action="{{ url('designer-dashboard/setting/submitProc') }}" method="post">
                                                    @csrf
                                                <div class="preview-block">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="experience">Experience</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="experience" id="experience" value="{{ $user->experience ?? '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
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
                                                        </div>
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
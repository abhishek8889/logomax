@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
            <div class="nk-block nk-block-lg p-4">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Change Password</h4>
                                            </div>
                                            <div>
                                                {{ Breadcrumbs::render('change-password') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <form action="{{ url('/designer-dashboard/change-password-procc') }}" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="new-pass">New Password</label>
                                                            <div class="form-control-wrap">
                                                                <input type="password" class="form-control" name="new_pass"  id="new-pass" >
                                                            </div>
                                                            @error('new_pass')
                                                            <div class="text text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="confirm_pass">Confirm New Password</label>
                                                            <div class="form-control-wrap">
                                                                <input type="password" class="form-control" id="confirm_pass"  name="confirm_pass">
                                                            </div>
                                                            @error('confirm_pass')
                                                            <div class="text text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 mt-3">
                                                        <button type="submit" class="btn btn-primary">Change Password</button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>
                    </div>
</div>

@endsection
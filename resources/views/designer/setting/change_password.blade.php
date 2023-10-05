@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
            <div class="nk-block nk-block-lg p-4">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Change Password</h4>
                                            </div>
                                            <div>
                                                {{ Breadcrumbs::render('account-setting') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <form action="" method="post">
                                                @csrf
                                                <div class="preview-block">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="new-pass">New Password</label>
                                                            <div class="form-control-wrap">
                                                                <input type="password" class="form-control" name="new_pass" autocomplete="off" id="new-pass" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="confirm_pass">Confirm New Password</label>
                                                            <div class="form-control-wrap">
                                                                <input type="password" class="form-control" id="confirm_pass" autocomplete="off" name="confirm_pass" value="">
                                                            </div>
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
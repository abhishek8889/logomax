@extends('special_designer_layout.master')
@section('content')
<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
            <div class="card card-bordered card-preview">
                    <div class="nk-block nk-block-lg">                     
                        <div class="card card-bordered card-preview p-4">
                            <h4>Change Password</h4>
                            <div class="row col-8">
                                <form class="info-form" method="post" action="{{ url('special-designer/change-password') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Current Password</label>
                                        <input type="password" name="current_password" class="form-control"
                                            id="exampleInputPassword1" placeholder="Current Password">
                                        @error('current_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">New Password</label>
                                        <input type="password" name="new_password" class="form-control" id="exampleInputPassword1"
                                            placeholder="Password">
                                        @error('new_password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Confirm Password</label>
                                        <input type="password" name="new_password_confirmation" class="form-control"
                                            id="exampleInputPassword1" placeholder="confirm Password">
                                        @error('confirmpassword')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="chng-butn">
                                        <button type="submit" class="btn btn-primary buttn">Change</button>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>
                     </div>
            </div>
        </div>
    </div>
</div>
@endsection
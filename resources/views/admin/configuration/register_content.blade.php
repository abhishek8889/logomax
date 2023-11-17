@extends('admin_layout/master')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content d-flex justify-content-between">
                                                <h4 class="title nk-block-title">Register Page Content</h4>
                                                {{ Breadcrumbs::render('support-setting') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                               <form action="{{ url('admin-dashboard/register-page-submit') }}" method="post">
                                                @csrf
                                                @foreach($content as $data)
                                                <div class="form-group">
                                                    <label class="form-label" for="default-01">{{ $data->name ?? '' }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea type="text" class="form-control" name="{{ $data->id ?? '' }}" id="default-01" >{{ $data->value ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="form-group ">
                                                    <button type="submit" class="btn btn-primary" class="form-control">Update</button>
                                                </div>
                                               </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                    
                                    </div>

@endsection
@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Add Site Meta</h4>
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/sitemeta/addprocc') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" name="id" value="{{ $meta->id ?? '' }}">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Meta Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="meta_name" id="meta_name" value="{{ $meta->meta_name ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_type">Meta Type</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-control" name="meta_type" id="meta_type" >
                                                                        <option @if(isset($meta)) @if($meta != null) @if($meta->meta_type == 'textarea') selected @endif @endif @endif value="textarea">Text</option>
                                                                        <option @if(isset($meta)) @if($meta != null) @if($meta->meta_type == 'image') selected @endif @endif @endif value="image">Image</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Meta Value</label>
                                                                <div class="form-control-wrap" id="meta_value_box">
                                                            
                                                                    @if($meta != null)
                                                                    @if($meta->meta_type == 'textarea')
                                                                        <textarea name="meta_value" id="" class="form-control">{{ $meta->meta_value ?? '' }}</textarea>
                                                                    @elseif($meta->meta_type == 'image')
                                                                        <input type="file" name="meta_value" class="form-control">                                                                      
                                                                    @endif
                                                                    @else
                                                                        <textarea name="meta_value" id="" class="form-control"></textarea>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                @if($meta == null)
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                @else
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                <a href="{{ url('admin-dashboard/sitemeta/add/') }}" class="btn btn-primary">Add New</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if(isset($meta))
                                                        @if($meta != null && $meta->meta_type == 'image')
                                                            <div class="col-lg-6">
                                                                <img src="#" alt="">
                                                            </div>
                                                        @endif
                                                        @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>
                                    
@endsection
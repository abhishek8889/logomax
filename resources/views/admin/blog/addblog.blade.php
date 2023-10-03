@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Add Blog</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/blogs/addProcc') }}" method="post" enctype="multipart/form-data"  >  
                                                    @csrf
                                                    <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="title">title</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="title" id="title" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="subtitle">subtitle</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="banner_image">Banner Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" name="banner_image" id="banner_image" placeholder="">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="default-textarea">Textarea</label>
                                                                <div class="form-control-wrap">
                                                                    <textarea class="form-control no-resize" id="default-textarea">Large text area content</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Post</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>

@endsection
@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Translate Blog</h4>
        </div>
        <div>
            {{-- Breadcrumbs::render('blog-update',$blogs->slug) --}}
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <form action="{{ url('admin-dashboard/blogs/translate') }}" method="post" >  
                    @csrf
                    <input type="hidden" name="blog_id" value="{{ $blogs->id ?? '' }}">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="title">Title</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="" value="{{ $blogs->title ?? '' }}">
                                </div>
                                @error('title')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label class="form-label" for="subtitle">Subtitle</label>
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="" value="{{ $blogs->sub_title ?? '' }}">
                                </div>
                                @error('subtitle')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 mt-3">
                            <div class="form-group">
                                <label class="form-label" for="editor10">Description</label>
                                <div class="form-control-wrap">
                                    <textarea class="form-control no-resize" name="description" id="editor10" >{{ $blogs->description ?? '' }}</textarea>
                                </div>
                                @error('description')
                                    <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-primary">Translate</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    ClassicEditor.create( document.querySelector( '#editor10' ) ); 
</script>
@endsection
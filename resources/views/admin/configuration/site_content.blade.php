@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Home Content Setting</h4>
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <form action="{{ url('/admin-dashboard/update-site-content') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            @if(isset($sitecontent))
                            @foreach($sitecontent as $meta)
                                    @if($meta->key == 'register-background-image')
                                        <div class="col-lg-10">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $meta->name  }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->value ?? '' }}">
                                                </div>
                                                @if(isset($meta->value))
                                                <div class="mt-3">
                                                    <img src="{{ asset('siteMeta/'.$meta->value) }}" alt="{{ $meta->name }}" width="250px;" height="100 px;">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    @if($meta->key == 'unique-logos-from-text')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}"  value="{{ $meta->value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'professional-logos-title')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'professional-logos-text')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">

                                                <textarea type="text" id="textEditor1" class="form-control" name="{{ $meta->id }}" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'register-banner-title-desc')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'register-banner-title-text-desc')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor2" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'registerbanner-title')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'customer-review-title')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'customer-review-text')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor3" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'meta-title')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor3" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'meta-description')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor3" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'meta-language')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor3" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if($meta->key == 'meta-country')
                                    <div class="col-lg-10 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->name }}</label>
                                            <div class="form-control-wrap">
                                                <textarea type="text" class="form-control" name="{{ $meta->id }}" id="textEditor3" >{{ $meta->value }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                            @endforeach
                        </div>

                        @endif
                    </div>
                    <button class="btn btn-primary mt-3" type="submit">Update</button>
                </form>
            </div>
        </div>
    </div><!-- .card-preview -->
    
</div>
<script>
tinymce.init({
        selector: "#textEditor1",
        plugins: "code",
        toolbar: "code",
    });
tinymce.init({
        selector: "#textEditor2",
        plugins: "code",
        toolbar: "code",
    });
tinymce.init({
        selector: "#textEditor3",
        plugins: "code",
        toolbar: "code",
    });



</script>
                                    
@endsection
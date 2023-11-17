@extends('admin_layout/master')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content d-flex justify-content-between">
                <h4 class="title nk-block-title">About Page Content</h4>
                {{ Breadcrumbs::render('about-setting') }}
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="{{ url('/admin-dashboard/about-page-update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-10">
                                @if (isset($aboutdata))
                                    @foreach ($aboutdata as $data)
                                    
                                    @if ($data->key == 'upper-text-title')
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                <div class="form-control-wrap">
                                                    <textarea  name="{{ $data->id }}" id="content_text" class="form-control">{{ $data->value }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($data->key == 'upper-text-left')
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea  name="{{ $data->id }}" id="content_text" class="form-control">{{ $data->value }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                       
                                        @elseif ($data->key == 'upper-text-right')
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea  name="{{ $data->id }}" id="content_text" class="form-control">{{ $data->value }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'facebook-link')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            name="{{ $data->id }}" id="meta_name"
                                                            value="{{ $data->value }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'instagram-link')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            name="{{ $data->id }}" id="meta_name"
                                                            value="{{ $data->value }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'pinterest-link')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            name="{{ $data->id }}" id="meta_name"
                                                            value="{{ $data->value }}">
                                                    </div>
                                                </div>
                                            </div>
                                       @elseif ($data->key == 'linked-in-link')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control"
                                                            name="{{ $data->id }}" id="meta_name"
                                                            value="{{ $data->value }}">
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'video-link')
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control"
                                                        name="{{ $data->id }}" id="meta_name"
                                                        value="{{ $data->value }}">
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($data->key == 'contact-us')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea name="{{ $data->id }}" id="contact_us" class="form-control">{{ $data->value }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'join-us')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea name="{{ $data->id }}" id="join_us" class="form-control">{{ $data->value }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'video-text-title')
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                <div class="form-control-wrap">
                                                    <textarea name="{{ $data->id }}" id="video_text" class="form-control">{{ $data->value }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @elseif ($data->key == 'video-text')
                                            <div class="col-lg-12 mt-2">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea name="{{ $data->id }}" id="video_text" class="form-control">{{ $data->value }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($data->key == 'video-image')
                                            <br>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control"
                                                            name="{{ $data->id }}" id="meta_name"
                                                            value="{{ $data->value ?? '' }}">
                                                    </div>
                                                    @if (isset($data->value))
                                                        <div class="mt-3">
                                                            <img src="{{ asset('/siteMeta/' . $data->value) }}"
                                                                alt="{{ $data->name }}" width="250px;" height="100 px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                        @elseif ($data->key == 'join-us-image')
                                        <br>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" class="form-control"
                                                        name="{{ $data->id }}" id="meta_name"
                                                        value="{{ $data->value ?? '' }}">
                                                </div>
                                                @if (isset($data->value))
                                                    <div class="mt-3">
                                                        <img src="{{ asset('/siteMeta/' . $data->value) }}"
                                                            alt="{{ $data->name }}" width="250px;" height="100 px;">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <br>
                                    @else
                                         <div class="form-group">
                                                    <label class="form-label" for="default-01">{{ $data->name ?? '' }}</label>
                                                    <div class="form-control-wrap">
                                                        <textarea type="text" class="form-control" name="{{ $data->id ?? '' }}" id="default-01" >{{ $data->value ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                    @endif
                                     @endforeach
                                @endif
                            </div>
                        </div>
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- .card-preview -->
<!---------------- text editor------------------------------------->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
                    tinymce.init({
                        selector: 'textarea#contact_us',
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                     });
                    tinymce.init({
                        selector: 'textarea#content_text',
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                    });
                    tinymce.init({
                        selector: 'textarea#video_text',
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                    });
                    tinymce.init({
                        selector: 'textarea#join_us',
                        plugins: 'code table lists',
                        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                    });    
        
    </script>
@endsection

@extends('admin_layout/master')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">About Page Content</h4>
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="{{ url('/admin-dashboard/about-page-update') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8">
                                @if (isset($aboutdata))
                                    @foreach ($aboutdata as $data)
                                        {{-- <input type="hidden" name="key[]" value="{{ $data->id }}" > --}}
                                        {{-- @if ($data->key == 'image-part') --}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $data->name }}</label>
                                                @if ($data->type == 'file')
                                                    <div class="form-control-wrap">
                                                        <input type="file" class="form-control"
                                                            name="{{ $data->id}}" id="content_image"
                                                            value="{{ $data->value ?? '' }}">
                                                    </div>
                                                    @if (isset($data->value))
                                                        <div class="mt-3">
                                                            <img src="{{ asset('siteMeta/' . $data->value) }}"
                                                                alt="{{ $data->name }}" width="250px;" height="100 px;">
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($data->type == 'textarea')
                                                        <div class="form-control-wrap">
                                                            <textarea style="display:inline-block" name="{{ $data->id }}" id="content_text" class="form-control">{{ $data->value }}</textarea>
                                                        </div>
                                                  
                                                       
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                        <br><br>
                                        {{-- @endif --}}
                                        {{-- @if ($meta->meta_key == 'facebook-link')
                                    <div class="col-lg-12 mt-2">
                                        <div class="form-group">
                                            <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                            <div class="form-control-wrap">
                                                <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                            </div>
                                        </div>
                                    </div>
                                    @endif --}}
                                    @endforeach
                            </div>
                            {{-- <div class="col-lg-4">
                            @foreach ($siteMetas as $meta)
                                @if ($meta->meta_key == 'home-page-site-logo')
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                        </div>
                                        @if (isset($meta->meta_value))
                                            <div class="mt-3 p-2" style="background:grey;">
                                                <img src="{{ asset('siteMeta/'.$meta->meta_value) }}" alt="{{ $meta->meta_name }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if ($meta->meta_key == 'other-pages-site-logo')
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                        </div>
                                        @if (isset($meta->meta_value))
                                            <div class="mt-3 p-2" style="background:grey;">
                                                <img src="{{ asset('siteMeta/'.$meta->meta_value) }}" alt="{{ $meta->meta_name }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                        </div> --}}
                            @endif
                        </div>
                        <button class="btn btn-primary mt-3" type="submit">Update</button>
                    </form>
                </div>
            </div>
        </div><!-- .card-preview -->

    </div>
    <script>
        editor = ClassicEditor.create(document.querySelector(".content_text"));
    </script>
@endsection

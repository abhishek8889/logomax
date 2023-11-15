@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content d-flex justify-content-between">
            <h4 class="title nk-block-title">Site Setting <i class="fa fa-cog" aria-hidden="true"></i></h4>
            {{ Breadcrumbs::render('site-setting') }}
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <form action="{{ url('/admin-dashboard/update-site-setting') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            @if(isset($siteMetas))
                            @foreach($siteMetas as $meta)
                                    <!-- Home banner -->
                                    @if($meta->meta_key == 'home-banner')
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" class="form-control file-box"  name="{{ $meta->id }}"  id="meta_name" value="{{ $meta->meta_value ?? '' }}">
                                                </div>
                                                @if(isset($meta->meta_value))
                                                <div class="mt-3">
                                                    <img src="{{ asset('siteMeta/'.$meta->meta_value) }}" alt="{{ $meta->meta_name }}" width="250px;" height="100 px;">
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Footer Logo -->
                                    @if($meta->meta_key == 'footer-logo')
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="file" class="form-control file-box"  name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                                </div>
                                                @if(isset($meta->meta_value))
                                                    <div class="mt-3 p-2" style="background:#80808052;">
                                                        <img src="{{ asset('siteMeta/'.$meta->meta_value) }}" class="file-box" alt="{{ $meta->meta_name }}">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Facebook Link -->
                                    @if($meta->meta_key == 'facebook-link')
                                        <div class="col-lg-12 mt-2">
                                            <div class="form-group">
                                                <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                                <div class="form-control-wrap">
                                                    <input type="text" class="form-control" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                            @endforeach
                        </div>
                        <div class="col-lg-4">
                            @foreach($siteMetas as $meta)
                                @if($meta->meta_key == 'home-page-site-logo')
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-control file-box"  name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                        </div>
                                        @if(isset($meta->meta_value))
                                            <div class="mt-3 " >
                                                <img style="background:#80808052;" src="{{ asset('siteMeta/'.$meta->meta_value) }}" class=" p-2 img-fluid" alt="{{ $meta->meta_name }}">
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if($meta->meta_key == 'other-pages-site-logo')
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group">
                                        <label class="form-label" for="meta_name">{{ $meta->meta_name }}</label>
                                        <div class="form-control-wrap">
                                            <input type="file" class="form-control file-box" name="{{ $meta->id }}" id="meta_name" value="{{ $meta->meta_value }}">
                                        </div>
                                        @if(isset($meta->meta_value))
                                            <div class="mt-3 p-2" style="background:#80808052;">
                                                <img src="{{ asset('siteMeta/'.$meta->meta_value) }}" class="p-2 img-fluid"  alt="{{ $meta->meta_name }}">
                                            </div>
                                        @endif
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
    $(document).ready(function(){
        $('input[type="file"]').on('change',function(e){
            e.preventDefault();
            let thisObj = $(this);
            let uploadBtn = $('<button>');
            uploadBtn.attr('class','btn btn-primary mt-2 upload-btn');
            uploadBtn.text('Upload');
            thisObj.parent().append(uploadBtn);
        })
        $(document).on('click','.upload-btn',function(e){
            e.preventDefault();
            let fileObj = $(this).siblings('input[type="file"]');
            let file = fileObj[0].files[0];
            let fileID = fileObj.attr('name'); // ID
            var formData = new FormData();

            formData.append('image', fileObj[0].files[0]);
            formData.append('fileID', fileID);
            formData.append('_token',"{{ csrf_token() }}");

            $.ajax({
                method: 'post',
                url: '{{ url("/update-image") }}',
                data: formData,
                processData: false,
                contentType: false,
                dataType:'json',
                success: function(data, status, xhr)
                {
                    if(xhr.status == 201){
                       location.reload(); 
                    }
                }
            });
        })
    });
</script>
                                    
@endsection
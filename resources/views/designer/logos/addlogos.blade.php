@extends('designer_layout.master')
@section('content')
<div class="nk-content ">
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Upload Logos</h4>
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('designer-dashboard/uploadprocc') }}" method="post">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="">Logo Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="logo_name" id="name">
                                                                </div>
                                                            </div>
                                                            @error('logo_name')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-label" for="slug">Logo Slug</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="logo_slug" id="slug">
                                                                </div>
                                                            </div>
                                                            @error('logo_slug')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                            <div class="form-group">
                                                            <label class="form-label">Logo Category</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2" name="categories">
                                                                    @foreach($categories as $cat)
                                                                    <option value="{{ $cat->id ?? '' }}">{{ $cat->name ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('categories')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Tags</label>
                                                            <div class="form-control-wrap">
                                                                <select class="form-select js-select2 tagsslectbox" multiple="multiple" name="tags[]" data-placeholder="Select Multiple Tags">
                                                                    <option value="default_option">Default Option</option>
                                                                    @foreach($tags as $t)
                                                                    <option value="{{ $t->id ?? '' }}">{{ $t->name ?? '' }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('tags')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                        </div>
                                                        </div>
                                                        <div class="col-sm-6" id="logodiv">
                                                            <label class="form-label">Upload Logo</label>
                                                            <div class="upload-zone" id="upload-zone">
                                                                <div class="dz-message" data-dz-message>
                                                                    <span class="dz-message-text">Drag and drop file</span>
                                                                    <span class="dz-message-or">or</span>
                                                                    <button type="button" class="btn btn-primary">SELECT</button>
                                                                </div>
                                                            </div>
                                                            @error('media_id')
                                                                <span class="text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 mt-3">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>
                                                    </form>
                                                   
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                        </div>
                                    </div>
<script>
    $('body').delegate('input.select2-search__field','keyup',function(){     
        val = $(this).val();
        result = $('.select2-results__message');
        result.html(val);
       
        // console.log(result);
    });
    $('body').delegate('.select2-results__message','click',function(e){  
        e.preventDefault();   
     val = $(this).html();
     slug = convertToSlug(val);
    $.ajax({
         method: 'post',
         url: '{{ url('designer-dashboard/addtag') }}',
         data: { name:val,slug:slug,_token:"{{ csrf_token() }}" },
         dataType: 'json',
         success: function(response)
         {
            // console.log(response);
            $(".tagsslectbox").append('<option value="'+response.id+'" Selected>'+response.name+'</option>');
            $('input.select2-search__field').val('');
            $('input.select2-search__field').click();
         }
    });
});
        </script>
        <script>
            $('body').delegate('.deleteimage','click',function(e){
                e.preventDefault();
                mediaid = $(this).attr('data-id');
                imagename = $(this).attr('image-name');
            console.log(imagename);
                $.ajax({
                    method: 'post',
                    url: '{{ url('designer-dashboard/deleteimage') }}',
                    data: { mediaid:mediaid,imagename:imagename,_token:"{{ csrf_token() }}" },
                    dataType: 'json',
                    success: function(response)
                    {
                        html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
                        $('.upload-zone').html(html);
                        $('.upload-zone').removeClass('dz-started');
                    }
                })
                

            })
        </script>
        <script>
            $('input[name="logo_name"]').on('keyup',function(){
                val = $(this).val();
                slug = convertToSlug(val);
                $('input[name="logo_slug"]').val(slug);
            });
        </script>
<script>
             function convertToSlug(str){
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                            .toLowerCase();
                   str = str.replace(/^\s+|\s+$/gm,'');
                   str = str.replace(/\s+/g, '-');   
                  return str;
                }
</script>
@endsection
@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Edit Blog</h4>
                                            </div>
                                            <div>
                                                {{ Breadcrumbs::render('blog-update',$blogs->slug) }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/blogs/addProcc') }}" method="post" enctype="multipart/form-data" >  
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $blogs->id ?? '' }}">
                                                    <div class="row">
                                                         <div class="col-sm-6">
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
                                                        <div class="col-sm-6">
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
                                                        </div>
                                                        <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="banner_image">Banner Image</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="file" class="form-control" name="banner_image" id="banner_image" placeholder="">
                                                                </div>                                                               
                                                                @error('banner_image')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="image mt-3">
                                                                        <img src="{{ asset('blog_images/'.$blogs->banner_img) }}" alt="" width="60%">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="category">Banner Category</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select" name="category" id="category">
                                                                        @foreach($category as $cat)
                                                                        <option value="{{ $cat->id ?? '' }}" <?php  if($cat->id == $blogs->category_id){ echo 'selected'; } ?>>{{ $cat->category_name ?? '' }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                @error('category')
                                                                            <span class="text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                                <div class="form-group">
                                                                <label class="form-label">Tags</label>
                                                                <?php 
                                                                $tagss = json_decode($blogs->tags);
                                                               
                                                                ?>
                                                             
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select js-select2 tagsslectbox" multiple="multiple" name="tags[]" data-placeholder="Type here to add new tag">
                                                                        <!-- <option value="default_option">Default Option</option> -->
                                                                       
                                                                            @foreach($tags as $t)
                                                                            <option value="{{ $t->id ?? '' }}"  @if($tagss) <?php if(in_array($t->id,$tagss)){ echo 'selected'; } ?> @endif>{{ $t->name ?? '' }}</option>
                                                                            @endforeach
                                                                       
                                                                    </select>
                                                                </div>
                                                                @error('tags')
                                                                                <span class="text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>  
                                                        </div>
                                                        </div>
                                                            <div class="col-sm-12">
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
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>
                                    <script>
                                            ClassicEditor.create( document.querySelector( '#editor10' ) ); 
                                         
                                    </script>
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
                                            url: '{{ url('admin-dashboard/addtags/addProcc') }}',
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
                                                function convertToSlug(str){
                                                    str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                                                                .toLowerCase();
                                                    str = str.replace(/^\s+|\s+$/gm,'');
                                                    str = str.replace(/\s+/g, '-');   
                                                    return str;
                                                    }
                                    </script>

@endsection
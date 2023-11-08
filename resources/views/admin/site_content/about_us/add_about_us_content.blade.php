@extends('admin_layout/master')
@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head">
            <div class="nk-block-head-content">
                <h4 class="title nk-block-title">Add About Page Content</h4>

            </div>
        </div>
        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <div class="preview-block">
                    <form action="{{ url('admin-dashboard/about-page-content/addprocess') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- <input type="hidden" name="id" value="{{ $meta->id ?? '' }}"> --}}
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="meta_name"> Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="content_name" id="content_name"
                                            value="{{ $meta->meta_name ?? '' }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_name"> Slug</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="slug" id="Slug"
                                            value="">
                                    </div>
                                    <div class="text text-danger">
                                        @error('Slug')
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="content-type"> Type</label>
                                    <div class="form-control-wrap">
                                        <select class="form-control" name="content_type" id="content-type">
                                            <option value="">Select Type</option>
                                            <option value="textarea">Text</option>
                                            <option value="file">file</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="meta_name">content</label>
                                    <div class="form-control-wrap" id="meta_value_box">
                                        {{-- @if ($meta != null)
                                @if ($meta->meta_type == 'textarea') --}}
                                        <textarea style="display: none" name="content_value" id="content_text" class="form-control">{{ $meta->meta_value ?? '' }}</textarea>
                                        {{-- @elseif($meta->meta_type == 'image') --}}
                                        <input style="display:none" id="content_file" type="file" name="content_value"
                                            class="form-control">
                                        {{-- @endif
                                @else --}}
                                        {{-- <textarea name="meta_value" class="form-control"></textarea> --}}
                                        {{-- @endif --}}
                                    </div>
                                </div>
                                <div class="form-group">
                                    @if ($meta == null)
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    @else
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ url('admin-dashboard/sitemeta/add/') }}" class="btn btn-primary">Add
                                            New</a>
                                    @endif
                                </div>
                            </div>
                            @if ($meta != null && $meta->meta_type == 'image')
                                <div class="col-lg-6">
                                    <img src="#" alt="">
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .card-preview -->

    </div>
    <script>
        const select = document.getElementById('content-type');
        const textarea = document.getElementById('content_text');
        const file = document.getElementById('content_file');
        let editor;
        select.addEventListener('change', function() {
            const selectvalue = select.value;
            if (selectvalue === 'textarea') {
              
                if (!editor) {
                     editor = ClassicEditor.create( textarea );
	
                    file.style.display = 'none';
                }
            } else if (selectvalue === 'file') {
                file.style.display = 'block';
                textarea.style.display = 'none';
                if (editor) {
                    editor.then(ckeditor => {
                        ckeditor.destroy()
                            .then(() => {
                                editor = null;
                                textarea.style.display = 'none';
                            })
                    });
                    textarea.style.display = 'none';
             }
               

            } else {
                file.style.display = 'none';
                textarea.style.display = 'none';
                if (editor) {
                    editor.then(ckeditor => {
                        ckeditor.destroy()
                            .then(() => {
                                editor = null;
                                textarea.style.display = 'none';
                            })
                    });
                    
             }
           
        }
        });


        // function toggleEditorVisibility(isVisible) {
        //     if (isVisible) {
        //         textarea.style.display = 'block';
        //         if (!editor) {
        //             file.style.display = 'none';
        //             editor = ClassicEditor.create(textarea);
        //         }
        //     } else {
        //         if (editor) {
        //             file.style.display = 'block';
        //             editor.destroy();
        //             editor = null;
        //         }
        //         textarea.style.display = 'none';
        //     }
        // }
    </script>
    <script>
        $(document).ready(function() {
            $('#content_name').on('keyup', function() {
                let name = $(this).val().toLowerCase();
                let slug = name.replace(/\s+/g, "-"); // Replace consecutive spaces with a single dash
                $('#Slug').val(slug);
            });
        });
    </script>
    <script></script>
@endsection

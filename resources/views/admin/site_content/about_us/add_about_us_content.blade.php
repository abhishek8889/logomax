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
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-label" for="content_name"> Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="content_name" id="content_name"
                                            value="">
                                    </div>
                                    <div class="text text-danger">
                                        @error('content_name')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="Slug"> Slug</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="slug" id="Slug"
                                            value="">
                                    </div>
                                    <div class="text text-danger">
                                        @error('Slug')
                                            {{ $message }}
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
                                            <option value="link">link</option>
                                        </select>
                                    </div>
                                    <div class="text text-danger">
                                        @error('content_type')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="content_name">content</label>
                                    <div class="form-control-wrap" id="meta_value_box">
                                        <textarea style="display:none " name="content_value" id="content_text" class="form-control"></textarea>
                                    </div>
                                    <div class="form-control-wrap" id="meta_value_box">
                                        <input style="display:none" id="content_file" type="file" name="content_value"
                                            class="form-control">
                                    </div>
                                    <div class="text text-danger">
                                        @error('content_value')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- .card-preview -->

    </div>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        const select = document.getElementById('content-type');
        const textarea = document.getElementById('content_text');
        const file = document.getElementById('content_file');
        let editor;
        select.addEventListener('change', function() {
            if (select.value === 'textarea') {
                textarea.style.display = 'block';
                editor = tinymce.init({
                    selector: 'textarea#content_text',
                    plugins: 'code table lists',
                    toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
                });

                file.style.display = 'none';

            } else if (select.value === 'file') {
                file.style.display = 'block';
                textarea.style.display = 'none';
                if (editor) {
                    tinymce.remove();
                    textarea.style.display = 'none';
                }


            } else {
                if (select.value === 'link') {
                    file.style.display = 'none';
                    textarea.style.display = 'block';
                    if (editor) {
                        tinymce.remove();
                        textarea.style.display = 'block';
                    }


                } else {
                    file.style.display = 'none';
                    textarea.style.display = 'none';
                    if (editor) {
                        tinymce.remove();
                        textarea.style.display = 'none';
                    }


                }
            }
        });
    </script>

    <script></script>
    <script>
        $(document).ready(function() {
            $('#content_name').on('keyup', function() {
                let name = $(this).val().toLowerCase();
                let slug = name.replace(/\s+/g, "-"); // Replace consecutive spaces with a single dash
                $('#Slug').val(slug);
            });
        });
    </script>
@endsection

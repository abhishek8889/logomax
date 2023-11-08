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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="content_name"> Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control" name="content_name" id="content_name"
                                            value="">
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
                                <label class="form-label" for="content_name">content</label>
                                <div class="form-control-wrap" id="meta_value_box">
                                    <textarea style="display: none" name="content_value" id="content_text" class="form-control" ></textarea>
                                </div>
                                <div class="form-control-wrap" id="meta_value_box">
                                    <input style="display:none" id="content_file" type="file" name="content_file"
                                        class="form-control">
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
    <script>
        const select = document.getElementById('content-type');
        const textarea = document.getElementById('content_text');
        const file = document.getElementById('content_file');
        let editor;
        select.addEventListener('change', function() {
            if (select.value === '') {
                if (editor) {

                    editor.destroy()
                        .then(() => {
                            editor = null;

                        });

                }
                textarea.style.display = 'none';
                file.style.display = 'none';

            } else {
                if (select.value === 'file') {
                    if (editor) {

                        editor.destroy()
                            .then(() => {
                                editor = null;

                            });

                    }
                    textarea.style.display = 'none';
                    file.style.display = 'block';

                } else {


                    if (!editor) {
                        editor = ClassicEditor.create(textarea);
                    }
                    textarea.style.display = 'block';
                    file.style.display = 'none';


                }
            }
        });
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
@endsection

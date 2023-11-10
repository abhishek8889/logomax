@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h4 class="title nk-block-title">Add Home Content</h4>
            
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="preview-block">
                <form action="{{ route('addHomeContent') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="id" >
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="form-label" for="field_name">Field Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="field_name" id="field_name" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="field_type">Slug</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" name="field_slug" id="field_slug" >

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="field_type">Field Type</label>
                            <div class="form-control-wrap">
                                <select  id="typeSelected" class="form-control" name="field_type" id="field_type" >
                                    <option value="" disabled selected>Select an option</option>
                                    <option   value="image">Image</option>
                                    <option  value="textarea">Text</option>
                                </select>
                            </div>
                            
                        <div class="form-group">
                            <label class="form-label my-2" for="field_name">Field Value</label>
                            <div class="form-control-wrap" id="field_value_box"> 
                                <div class="my-2" id="fieldInput">
                                </div>

                            </div>
                        </div>

                    </div>
                    <button class="btn btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- .card-preview -->
    
</div>

{{-- Script to select type of field --}}
<script>
    $('#typeSelected').on('change', function () {
        var $val = $(this).val();
        
        if ($val === 'textarea') {
            $('#fieldInput').html('<textarea id="textEditor1" col="60" placeholder="Enter Text" name="field_value"></textarea>');
            // tinymce.init({
            //         selector: "#textEditor1",
            //         plugins: 'codesample',
            //         toolbar: 'codesample',
            //         valid_elements: '*[*]',
            //      });
            // ClassicEditor
            //     .create(document.querySelector('#textEditor1')),{
            //         plugins: [ 'code' ],
            //     }
            //     .catch(error => {
            //         console.error(error);
            //     });
        } else {
            $('#fieldInput').html('<input type="file" name="field_value" id="image">');
        }
    });
</script>
<script>

</script>
<script>
$('#field_name').keyup(function (e) {
var fieldName = $(this).val();
var slug = fieldName.replace(/ /g, '-');
$('#field_slug').val(slug);
});
</script>
                 
                                    
@endsection
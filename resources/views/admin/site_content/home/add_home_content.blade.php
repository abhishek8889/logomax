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
                                                                    {{-- @if( != null)
                                                                    @if(->meta_type == 'textarea')
                                                                        <textarea name="meta_value" id="" class="form-control">{{ ->meta_value ?? '' }}</textarea>
                                                                    @elseif(->meta_type == 'image')
                                                                        <input type="file" name="meta_value" class="form-control">                                                                      
                                                                    @endif
                                                                    @else
                                                                        <textarea name="meta_value" id="" class="form-control"></textarea>
                                                                    @endif --}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                {{-- @if( == null)
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                @else
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                <a href="{{ url('admin-dashboard/sitemeta/add/') }}" class="btn btn-primary">Add New</a>
                                                                @endif --}}
                                                            </div>
                                                        </div>
                                                        {{-- @if( != null && ->meta_type == 'image')
                                                            <div class="col-lg-6">
                                                                <img src="#" alt="">
                                                            </div>
                                                        @endif --}}
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
                                                $('#fieldInput').html('<textarea placeholder="Enter Text Here" name="field_value" id="textEditor"></textarea>')
                                                
                                            }else{
                                                $('#fieldInput').html('<input type="file" name="field_value" id="image">')
                                            }
                                        })
                                    
                                    //   $(document).ready(function () {
                                    //     $('#typeSelected').on('change', function () {
                                    //         var $val = $(this).val();
                                    //         if ($val === 'text') {
                                    //             // Check if the TinyMCE editor is already initialized
                                    //             if (!tinymce.get('textEditor')) {
                                    //                 // Initialize TinyMCE and replace the basic textarea
                                    //                 tinymce.init({
                                    //                     selector: "#textEditor",
                                    //                 });
                                    //             }
                                    //             // Show the TinyMCE textarea and hide the input file
                                    //             $('#textEditor').show();
                                    //             $('#image').hide();
                                    //         } else if ($val === 'image') {
                                    //             // Remove the TinyMCE editor and replace it with the basic textarea
                                    //             tinymce.EditorManager.execCommand('mceRemoveEditor', true, 'textEditor');
                                    //             // Show the input file and hide the TinyMCE textarea
                                    //             $('#image').show();
                                    //             $('#textEditor').hide();
                                    //         }
                                    //     });
                                    // });
                                    </script>
                                <script>
                                $('#field_name').keyup(function (e) {
                                    var fieldName = $(this).val();
                                    var slug = fieldName.replace(/ /g, '-');
                                    $('#field_slug').val(slug);
                                });

                                </script>
                 
                                    
@endsection
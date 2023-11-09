@extends('admin_layout/master')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Support Page Content</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                               <form action="{{ url('admin-dashboard/site-content/support/submit') }}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <input type="hidden" value="{{ $support_text->id ?? '' }}" name="id">
                                                    <input type="hidden" name="meta_type" value="textarea">
                                                    <label class="form-label" for="default-01">Support Text</label>
                                                    <div class="form-control-wrap">
                                                        <textarea type="text" class="form-control" name="meta_value" id="default-01" >{{ $support_text->meta_value ?? '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <button type="submit" class="btn btn-primary" class="form-control">Update</button>
                                                </div>
                                               </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                    
                                    </div>
                                    <script>
                                    ClassicEditor.create(document.querySelector(`#default-01`))
                                 </script>

@endsection
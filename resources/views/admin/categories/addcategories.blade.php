@extends('admin_layout/master')
@section('content')
<style>
    .translate_modal .modal-dialog {
    max-width: 850px;
    }

    .translate_modal .modal-body {
        height: 55vh;
        overflow: auto;
    }


</style>
<div class="d-flex justify-content-end">
     {{ Breadcrumbs::render('categories-add') }}
</div>
        <!-- <div class="col-lg-6"> -->
                 <div class="card card-bordered h-100">
                     <div class="card-inner">
                         <div class="card-head">
                             <h5 class="card-title">Add Categories</h5>
                         </div>
                         <form action="{{ route('add-category') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name ="id" value="{{$edit_category->id ?? ''}}">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-label" for="name">Category Name</label>
                                    <div class="form-control-wrap">
                                        <input type="text" name="name"  onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"  class="form-control" id="name" value="{{$edit_category->name ?? ''}}">
                                    </div>
                                    @error('name')
                                                    <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="translate_btn" data-bs-toggle="modal" data-bs-target="#modalDefault" class=" btn btn-primary">Translate</div>
                            </div>
                            
                            <div class="col-lg-6">
                             <div class="form-group">
                                 <label class="form-label" for="slug">Slug</label>
                                 <div class="form-control-wrap">
                                     <input type="text" name="slug" class="form-control" id="slug" value="{{ $edit_category->slug ?? '' }}">
                                 </div>
                                 @error('slug')
				                                <span class="text text-danger">{{ $message }}</span>
		                          @enderror
                             </div>
                             </div>
                            <div class="row">
                                    <div class="col-lg-7">
                                    <div class="form-group">
                                    <label class="form-label" for="cat_img">Category Image</label>
                                        <div class="form-control-wrap">
                                            <input type="file" name="category_image" class="form-control" id="cat_img" >
                                        </div>
                                        @error('category_image')
                                                        <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    </div>
                                    @if(isset($edit_category->image))
                                    <div class="col-lg-5">
                                        <img src="{{ asset('category_images/'.$edit_category->image) }}" width="60%" alt="">
                                    </div>
                                    @endif
                            </div>
                            <div class="col-lg-6">
                             <div class="form-group">
                                <label for="parent-category">Parent Category</label>
                                <div class="from-control-wrap">
                                    <select name="parent_category" class="form-control" id="parent-category">
                                        <option value="">--NONE--</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id ?? '' }}" @if($edit_category !== null) @if($edit_category->parent_category == $cat->id ) Selected @endif @endif> {{ $cat->name ?? '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                             </div>
                             </div>
                           
                             <div class="form-group mt-3">
                                 <button type="submit" class="btn btn-lg btn-primary">Save</button>
                             </div>
                         </form>
                     </div>
                 </div>
        <!-- </div> -->
        
            <!-- Modal Content Code -->
            <div class="translate_modal modal fade" tabindex="-1" id="modalDefault">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                        <div class="modal-header">
                            <!-- <h5 class="modal-title">Translate Name</h5> -->
                            <h5 class="modal-title">Category Name : {{$edit_category->name ?? ''}}</h5>
                        </div>
                        <form action="{{ url('/add-translate-val') }}" method="POST">
                            @csrf
                            <input type="hidden" name="referenceID" value="{{$edit_category->id ?? ''}}" />
                            <input type="hidden" name="type" value="categories"/>
                        <div class="modal-body">
                            <?php 
                            $count = 0;
                            ?>
                            <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">Sr no.</th>
                                <th scope="col">Language</th>
                                <th scope="col">Translate text</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($siteLanguagesList as $key => $value)
                            <?php $count = $count + 1; ?>
                                <tr>
                                <th scope="row">{{ $count }}</th>
                                <td>{{ $value ?? '' }}</td>
                                @if(isset($edit_category->translationBackend) && count($edit_category->translationBackend) > 0)
                                    @foreach($edit_category->translationBackend as $translation)
                                        @if($translation->lang_code == $key)
                                        <input type="hidden" name="req_type" value="update" />
                                        <td><input type="text" class="form-control" name="lang_code[{{ $translation->id }}]" value="{{ $translation->name ?? $edit_category->name }}"/></td>
                                        @endif
                                    @endforeach
                                @else
                                <input type="hidden" name="req_type" value="add" />
                                <td><input type="text" class="form-control" name="lang_code[{{ $key }}]" value="{{ $edit_category->name ?? ''}}"/></td>
                                @endif
                                </tr>
                            @endforeach
                            </tbody>
                            </table>
                            
                        </div>
                        <div class="modal-footer bg-light">
                            <button class="btn btn-success" type="submit">Save</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

        <script>
             function convertToSlug(str){
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                            .toLowerCase();
                   str = str.replace(/^\s+|\s+$/gm,'');
                   str = str.replace(/\s+/g, '-');   
                   $('#slug').val(str);
                }
        </script>
@endsection
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
<div class="d-flex justify-content-end my-4"> 
    {{ Breadcrumbs::render('branches') }}
</div>
        <div class="col-lg-6 d-none" id="add-section">
                 <div class="card card-bordered h-100">
                     <div class="card-inner">
                         <div class="card-head d-flex justify-content-between">
                             <h5 class="card-title">Add Branches</h5>
                             <button class="remove btn btn-link" ><i class="fas fa-times"></i></button>
                         </div>
                         <form action="{{ url('admin-dashboard/branches/addProcc') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="">
                             <div class="form-group">
                                 <label class="form-label" for="name">Branch Name</label>
                                 <div class="form-control-wrap">
                                     <input type="text" name="name"  onload="convertToSlug(this.value)" onkeyup="convertToSlug(this.value)"  class="form-control" id="name" value="">
                                 </div>
                                 @error('name')
				                        <span class="text text-danger">{{ $message }}</span>
		                          @enderror
                             </div>
                             <div class="form-group">
                                <div class="form-control-wrap">
                                    <input type="hidden" name="slug" class="form-control" id="slug" value="">
                                </div>
                             </div>
                             <div class="form-group">
                                 <button type="submit" class="btn btn-lg btn-primary savebtn">Save</button>
                                 <div class="updatediv" style="display:none;">
                                 <button type="submit" class="btn btn-lg btn-primary">Update</button>
                                 <button type="button" class="btn btn-lg btn-primary addnew">Add New</button>
                                 </div>
                             </div>
                         </form>
                     </div>
                 </div>
        </div>
        <div class="nk-block nk-block-lg">
                    <div class="nk-block-head">
                        <div class="nk-block-head-content d-flex justify-content-between">
                            <h4 class="nk-block-title">Branches List</h4>
                            <button class="btn btn-primary" id="addnewsecitonbutton">Add new</button>
                        </div>
                    </div>
                    <div class="card card-bordered card-preview">
                        <table class="table table-tranx">
                   <thead class="text-center">
                       <tr class="tb-tnx-head ">
                           <th class="tb-tnx-id"><span class="">#</span></th>
                           <th class="tb-tnx-info text-center">
                               <span class="tb-tnx-desc d-none d-sm-inline-block">
                                   <span>Name</span>
                               </span>
                           </th>
                           <th class="tb-tnx-info text-center">
                               <span class="tb-tnx-desc d-none d-sm-inline-block">
                                   <span>Translate</span>
                               </span>
                           </th>
                           <th class="tb-tnx-action text-center">
                               <span>Action</span>
                           </th>
                       </tr>
                   </thead>
                   <tbody>
                    <?php $count = 1 ?>
                    @foreach($branches as $branch)
                       <tr class="tb-tnx-item">
                           <td class="tb-tnx-id text-center">
                               <a href="#"><span>{{ $count++ }}</span></a>
                           </td>
                           <td class="tb-tnx-info text-center">
                               <div class="tb-tnx-desc">
                                   <span class="title">{{ $branch->name ?? '' }}</span>
                               </div>
                           </td>
                           <td class="tb-tnx-info text-center">
                               <div class="tb-tnx-desc">
                                   <!-- <span class="title">translate</span> -->
                                <div data-bs-toggle="modal" style_name="{{  $branch->name ?? '' }}" style_id="{{ $branch->id ?? '' }}" data-bs-target="#modalDefault" class="translate_btn btn btn-primary">Translate</div>
                               </div>
                           </td>
                           <td class="tb-tnx-amount is-alt text-center">
                            <div class="dropdown">
                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                    <ul class="link-list-plain">
                                        <li><a class="edit-btn" tag-name="{{ $branch->name ?? '' }}" tag-slug="{{ $branch->slug ?? '' }}" tag-id="{{ $branch->id ?? '' }}" href="{{ url('/admin-dashboard/branches/') }}/{{ $branch->slug ?? '' }}">Edit</a></li>
                                        <li><a href="{{ url('/admin-dashboard/branches/delete') }}/{{ $branch->id ?? '' }}">delete</a></li>
                                    </ul>
                                </div>
                            </div>
                           </td>
                       </tr>
                    @endforeach
                   </tbody>
               </table>
               @if($branches->isEmpty())
               <div class="p-3"><h5 class="text-center">No styles found</h5></div>
               @endif
           </div>
  </div>

  <!-- Modal for translate  -->
    <div class="translate_modal modal fade" tabindex="-1" id="modalDefault">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                    <div class="modal-header">
                        <h5 class="modal-title">Branch Name : </h5>
                    </div>
                    <div class="modal-data-new"></div>
                </div>
            </div>
        </div>
  <!-- Modal end -->
        @error('name')
            <script>
                $('div#add-section').removeClass('d-none');
            </script>
        @enderror
        @error('slug')
        <script>
            $(document).ready(function(){
                $('div#add-section').removeClass('d-none');
                NioApp.Toast('Name must be unique and required !', 'info', {position: 'top-right'});
            });
        </script>
        @enderror
        <script>
             function convertToSlug(str){
                str = str.replace(/[`~!@#$%^&*()_\-+=\[\]{};:'"\\|\/,.<>?\s]/g, ' ')
                            .toLowerCase();
                   str = str.replace(/^\s+|\s+$/gm,'');
                   str = str.replace(/\s+/g, '-');   
                   $('#slug').val(str);
                }
        </script>
        <script>
            $('.edit-btn').on('click',function(e){
                e.preventDefault();
                $('div#add-section').removeClass('d-none');
                name = $(this).attr('tag-name');
                slug = $(this).attr('tag-slug');
                id = $(this).attr('tag-id');
                // console.log(name+slug+id);
                $('input[name="name"]').val(name);
                $('input[name="slug"]').val(slug);
                $('input[name="id"]').val(id);

                $('.savebtn').hide();
                $('.updatediv').show();
            });
            $('.addnew').click(function(){
                $('input[name="name"]').val('');
                $('input[name="slug"]').val('');
                $('input[name="id"]').val('');

                $('.savebtn').show();
                $('.updatediv').hide();
            })
            $('button#addnewsecitonbutton').on('click',function(){
                $('div#add-section').removeClass('d-none');
            })
            $('.remove').on('click',function(){
                $('div#add-section').addClass('d-none');
                $('input[name="name"]').val('');
                $('input[name="slug"]').val('');
                $('input[name="id"]').val('');
            })

            $(".translate_btn").on('click',function(){
                let thisObj = $(this);
                let modalHead = $(".translate_modal .modal-header");
                let headName = thisObj.attr('style_name');
                let styleID = thisObj.attr('style_id');
                console.log(headName + styleID);
                // console.log('style id -> ' + styleID);
                modalHead.html(`<h5 class="modal-title">Style Name : ${headName} </h5>`);  
                let modalHtml = '';
                $.ajax({
                    type:'POST',
                    url:'{{ url("/get-data-in-details") }}',
                    data:{
                        '_token' : "{{ csrf_token() }}",
                        'table' : 'branches_translation',
                        'dataID' : styleID,
                    },
                    success:function(response) {
                        if(response == 'no-data'){
                            modalHtml = `<form action="{{ url('/add-translate-val') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="referenceID" value="${styleID}" />
                                            <input type="hidden" name="type" value="branches"/>
                                            <input type="hidden" name="req_type" value="add" />
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
                                                
                                                <td><input type="text" class="form-control" name="lang_code[{{ $key }}]" value="${headName}"/></td>
                                               
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            </table>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </form>`;
                        }else{
                            @foreach($siteLanguagesList as $key => $value)
                                var languageData = response.find(item => item.lang_code === '{{ $key }}');
                                var translatedText = languageData ? languageData.name : headName ;
                                var lang_id = languageData ? languageData.id : '';
                                modalHtml += `
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $value }}</td>
                                        <td><input type="text" class="form-control" name="lang_code[${lang_id}]" value="${translatedText}" /></td>
                                    </tr>
                                `;
                            @endforeach
                            modalHtml = `<form action="{{ url('/add-translate-val') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="referenceID" value="${styleID}" />
                                            <input type="hidden" name="type" value="branches"/>
                                            <input type="hidden" name="req_type" value="update" />
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
                                            ${modalHtml}
                                            </tbody>
                                            </table>
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                        </form>`;
                        }
                        $(".modal-data-new").html(modalHtml);
                    }
                });
            });
        </script>
@endsection
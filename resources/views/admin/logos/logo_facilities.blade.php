@extends('admin_layout/master')
@section('content')
    <div class="d-flex justify-content-end my-4"> 
        {{ Breadcrumbs::render('additional-options') }}
    </div>
    <div class="col-lg-6 d-none" id="add-section">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-head d-flex justify-content-between">
                    <h5 class="card-title">Add Logo Facilities</h5>
                    <button class="remove btn btn-link" ><i class="fas fa-times"></i></button>
                </div>
                <form action="{{ url('admin-dashboard/logo-facilities') }}" method="POST">
                @csrf
                <input type="hidden" name="id"/>
                <div class="form-group">
                    <label class="form-label" for="name">Name</label>
                    <div class="form-control-wrap">
                        <input type="text" name="name" class="form-control" id="name"
                         placeholder="Enter Facility Name"/>
                    </div>
                    @error('name')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label" for="desc">Description</label>
                    <div class="form-control-wrap">
                        <input type="textarea" rows="4" cols="50" name="description" class="form-control" id="desc" placeholder="Enter Description Here." />
                    </div>
                    @error('name')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
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
                <h4 class="nk-block-title">Feature List</h4>
                <button class="btn btn-primary" id="addnewsecitonbutton">Add new</button>
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <table class="table table-tranx">
                <thead>
                    <tr class="tb-tnx-head ">
                        <th class="tb-tnx-id"><span class="">#</span></th>
                        <th class="tb-tnx-info text-center">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>Name</span>
                            </span>
                        </th>
                        <th class="tb-tnx-action text-center">
                            <span>Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count = 1 ?>
                    <!-- ############################################### -->
                    @foreach($logoFacilities as $facility)
                    <tr class="tb-tnx-item">
                        <td class="tb-tnx-id text-center">
                            <a href="#"><span>{{ $count++ }}</span></a>
                        </td>
                        <td class="tb-tnx-info text-center">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $facility->facilities_name ?? '' }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-amount is-alt text-center">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a class="edit-btn" fac-name="{{$facility->facilities_name ?? ''}}" fac-desc="{{ $facility->description ?? '' }}" fac-id="{{$facility->id ?? ''}}" href="{{ url('/admin-dashboard/') }}">Edit</a></li>
                                    <li><a href="{{ url('admin-dashboard/logo-facilities-dlt/'.$facility->id) }}">delete</a></li>
                                </ul>
                            </div>
                        </div>
                        </td>
                    </tr>
                    @endforeach
                    <!-- ############################################### -->
                </tbody>
            </table>
        </div>
    </div>
  
    <script>
        $('.edit-btn').on('click',function(e){
            e.preventDefault();
            $('div#add-section').removeClass('d-none');
            name = $(this).attr('fac-name');
            description = $(this).attr('fac-desc');
            id = $(this).attr('fac-id');
            $('input[name="name"]').val(name);
            $('input[name="description"]').val(description);
            $('input[name="id"]').val(id);

            $('.savebtn').hide();
            $('.updatediv').show();
        });
        $('.addnew').click(function(){
            $('input[name="name"]').val('');
            $('input[name="description"]').val('');
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
            $('input[name="description"]').val('');
            $('input[name="id"]').val('');
        })
    </script>
@endsection
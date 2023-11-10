@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="title nk-block-title">Add Site Meta</h4>
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/site-meta/support/submitProcc') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" name="id" value="{{ $meta->id ?? '' }}">
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Meta Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="meta_name" id="meta_name" value="{{ $meta->meta_name ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_type">Meta Type</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-control" name="meta_type" id="meta_type" >
                                                                        <option @if($meta != null) @if($meta->meta_type == 'textarea') selected @endif @endif value="textarea">Text</option>
                                                                        <option @if($meta != null) @if($meta->meta_type == 'image') selected @endif @endif value="image">Image</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Meta Value</label>
                                                                <div class="form-control-wrap" id="meta_value_box">
                                                                    @if($meta != null)
                                                                    @if($meta->type == 'textarea')
                                                                        <textarea name="meta_value" id="" class="form-control">{{ $meta->meta_value ?? '' }}</textarea>
                                                                    @elseif($meta->type == 'image')
                                                                        <input type="file" name="meta_value" class="form-control">                                                                      
                                                                    @endif
                                                                    @else
                                                                        <textarea name="meta_value" id="" class="form-control"></textarea>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                @if($meta == null)
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                @else
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                <a href="{{ url('admin-dashboard/site-meta/support') }}" class="btn btn-primary">Add New</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @if($meta != null && $meta->meta_type == 'image')
                                                            <div class="col-lg-6">
                                                                <img src="{{ asset('siteMeta') }}/{{ $meta->meta_value ?? '' }}" alt="">
                                                            </div>
                                                        @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>

                                <div class="nk-block nk-block-lg">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h4 class="nk-block-title">Site Metas</h4>
                                        </div>
                                    </div>
                                    <div class="card card-bordered card-preview">
                                        <table class="table table-tranx">
                                            <thead>
                                                <tr class="tb-tnx-head">
                                                    <th class="tb-tnx-id"><span class="">#</span></th>
                                                    <th class="tb-tnx-info">
                                                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                            <span>Meta Value</span>
                                                        </span>
                                                        <span class="tb-tnx-date d-md-inline-block d-none">
                                                            <span class="d-md-none">Date</span>
                                                            <span class="d-none d-md-block">
                                                                <span>Meta Name</span>
                                                                <span>Meta Type</span>
                                                            </span>
                                                        </span>
                                                    </th>
                                                    <th class="tb-tnx-action">
                                                        <span>&nbsp;</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $count = 1; ?>
                                            @foreach($supportmeta as $meta)
                                                <tr class="tb-tnx-item">
                                                    <td class="tb-tnx-id">
                                                        {{ $count++ }}
                                                    </td>
                                                    <td class="tb-tnx-info">
                                                        <div class="tb-tnx-desc">
                                                            @if($meta->type == 'image')
                                                                <span class="title"><img src="{{ asset('siteMeta') }}/{{ $meta->meta_value ?? '' }}" alt="{{ $meta->meta_key ?? '' }}" class="p-3" style="background:#8080808f;" width="50%"></span>
                                                            @elseif($meta->type == 'textarea')
                                                                <span class="title">{{ $meta->meta_value ?? '' }}</span>
                                                            @endif
                                                        </div>
                                                        <div class="tb-tnx-date">
                                                            <span class="date">{{ $meta->meta_name ?? '' }}</span>
                                                            <span class="date">{{ $meta->type ?? '' }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="tb-tnx-action">
                                                        <div class="dropdown">
                                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                <ul class="link-list-plain">
                                                                    <li><a href="{{ url('admin-dashboard/site-meta/support') }}/{{ $meta->meta_key ?? '' }}">Edit</a></li>
                                                                    <li><a href="{{ url('admin-dashboard/site-meta/support/delete/'.$meta->meta_key ?? '') }}">Remove</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div><!-- .card-preview -->
</div>
                                    <script>
                                        $('select[name="meta_type"]').on('change',function(){
                                            textarea = '<textarea name="meta_value" id="" class="form-control"></textarea>';
                                            image = '<input type="file" name="meta_value" class="form-control">';
                                            val = $(this).val();
                                            $('#meta_value_box').html('');
                                            if(val == 'image'){
                                                $('#meta_value_box').html(image);
                                            }else if(val == 'textarea'){
                                                $('#meta_value_box').html(textarea);
                                            }
                                        });
                                    </script>
@endsection
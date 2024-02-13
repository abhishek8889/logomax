@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content d-flex justify-content-between">
                                                <h4 class="title nk-block-title">Terms and Conditions content</h4>
                                               
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/configuration/terms-conditions/submitProcc') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $edit_term->id ?? '' }}">
                                                    <div class="row">
                                                    <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="title">Title</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="title" id="title" value="{{ $edit_term->title ?? '' }}">
                                                                </div>
                                                                @error('title')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="parent">Parent</label>
                                                                <div class="form-control-wrap">
                                                                    <select class="form-control" name="parent" id="parent" >
                                                                        <option value="">-none-</option>
                                                                        @foreach($terms as $t)
                                                                        <option value="{{ $t->id ?? '' }}" @if($edit_term) @if($edit_term->parent != null) @if($t->id == $edit_term->id) selected  @endif @endif @endif>{{ $t->title ?? ''  }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="description">Description</label>
                                                                <div class="form-control-wrap" id="meta_value_box">
                                                                        <textarea name="description" id="description" class="form-control">{{ $edit_term->description ?? '' }}</textarea>
                                                                </div>
                                                                @error('description')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
</div>
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Terms and Conditions List</h4>
                                                  </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-orders">
                                                <thead class="tb-odr-head">
                                                    <tr class="tb-odr-item">
                                                        <th class="tb-odr-info">
                                                            <span class="tb-odr-id">#</span>
                                                            <span class="tb-odr-date d-none d-md-inline-block">Title</span>
                                                        </th>
                                                        <th class="tb-odr-amount">
                                                            <span class="tb-odr-total">Description</span>
                                                            <!-- <span class="tb-odr-status d-none d-md-inline-block">Status</span> -->
                                                        </th>
                                                        <th class="tb-odr-action">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tb-odr-body">
                                                  <?php  $count = 1; ?>
                                                    @foreach($terms as $t)
                                                    <tr class="tb-odr-item">
                                                        <td class="tb-odr-info">
                                                            <span class="tb-odr-id">{{ $count++ }}</span>
                                                            <span class="tb-odr-date">{{ $t->title ?? '' }}</span>
                                                        </td>
                                                        <td class="tb-odr-amount">
                                                            <span class="tb-odr-total">
                                                                <span class="amount">{{ $t->description ?? '' }}</span>
                                                            </span>
                                                            <!-- <span class="tb-odr-status">
                                                                <span class="badge badge-dot bg-success">Complete</span>
                                                            </span> -->
                                                        </td>
                                                        <td class="tb-odr-action">
                                                            <div class="tb-odr-btns d-none d-md-inline">
                                                                <a  class="btn btn-sm btn-primary"  data-bs-toggle="modal" data-bs-target="#modalDefault{{ $t->id ?? '' }}">View</a>
                                                            </div>
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/configuration/terms-conditions/'.$t->id) }}" class="text-primary">Edit</a></li>
                                                                        <li><a href="{{ url('admin-dashboard/configuration/deleteTerms/'.$t->id) }}" class="text-danger">Remove</a></li>
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

                                    @foreach($terms as $t)

                                        <!-- Modal Content Code -->
                                        <div class="modal fade" tabindex="-1" id="modalDefault{{ $t->id ?? '' }}">
                                            <div class="modal-dialog modal-xl" role="document">
                                                <div class="modal-content">
                                                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                        <em class="icon ni ni-cross"></em>
                                                    </a>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" >{{ $t->title ?? '' }}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    <table class="table table-orders">
                                                            <thead class="tb-odr-head">
                                                                <tr class="tb-odr-item">
                                                                    <th class="tb-odr-info">
                                                                        <span class="tb-odr-id">#</span>
                                                                        <span class="tb-odr-date d-none d-md-inline-block">Title</span>
                                                                    </th>
                                                                    <th class="tb-odr-amount">
                                                                        <span class="tb-odr-total">Description</span>
                                                                        <!-- <span class="tb-odr-status d-none d-md-inline-block">Status</span> -->
                                                                    </th>
                                                                    <th class="tb-odr-action">&nbsp;</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="tb-odr-body">
                                                            <?php  $count = 1; ?>
                                                                @foreach($t->childs as $child)
                                                                <tr class="tb-odr-item">
                                                                    <td class="tb-odr-info">
                                                                        <span class="tb-odr-id">{{ $count++ }}</span>
                                                                        <span class="tb-odr-date">{{ $child->title ?? '' }}</span>
                                                                    </td>
                                                                    <td class="tb-odr-amount">
                                                                        <span class="tb-odr-total">
                                                                            <span class="amount">{{ $child->description ?? '' }}</span>
                                                                        </span>
                                                                        <!-- <span class="tb-odr-status">
                                                                            <span class="badge badge-dot bg-success">Complete</span>
                                                                        </span> -->
                                                                    </td>
                                                                    <td class="tb-odr-action">
                                                                        <div class="dropdown">
                                                                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                                                                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                                <ul class="link-list-plain">
                                                                                    <li><a href="{{ url('admin-dashboard/configuration/terms-conditions/'.$child->id) }}" class="text-primary">Edit</a></li>
                                                                                    <li><a href="{{ url('admin-dashboard/configuration/deleteTerms/'.$child->id) }}" class="text-danger">Remove</a></li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
@endsection
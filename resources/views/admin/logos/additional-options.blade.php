@extends('admin_layout/master')
@section('content')
<?php 
$option_type_arr = array( 
                    'save-logo-for-future',
                    'taxes',
                    'get-favicon'
                );

?>
    <div class="col-lg-12 " id="add-section">
        <div class="card card-bordered h-100">
            <div class="card-inner">
                <div class="card-head d-flex justify-content-between">
                    <h5 class="card-title">Additional options for logos</h5>
                    <!-- <button class="remove btn btn-link" ><i class="fas fa-times"></i></button> -->
                </div>
                <form action="{{ url('admin-dashboard/logo-optionssave') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $editoption->id ?? ''  }}"/>
                <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-label" for="text">Option Text</label>
                    <div class="form-control-wrap">
                        <input type="text" name="text" class="form-control" id="text"
                         placeholder="Enter Text For Additional Option" value="{{ $editoption->option_text ?? '' }}"/>
                    </div>
                    @error('name')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="option_type">Option Type</label>
                    <div class="form-control-wrap">
                         <select class="form-control" name="option_type" id="option_type">
                            @foreach($option_type_arr as $option)
                            <option value="{{ $option }}" <?php if(isset($editoption->option_type)){if($option == $editoption->option_type ){ echo 'selected';}}?>>{{ $option }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('name')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="duration">Pricing Duration</label>
                    <div class="form-control-wrap">
                        <select class="form-control" name="duration" id="duration">
                            <option @if(isset($editoption->duration)) @if($editoption->duration == 'fixed') selected @endif @endif value="fixed">Fixed</option>
                            <option @if(isset($editoption->duration)) @if($editoption->duration == 'monthly') selected @endif @endif value="monthly">Monthly</option>
                        </select>
                    </div>
                    @error('duration')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="amount">Option Amount</label>
                    <div class="form-control-wrap">
                        <input type="number" name="amount" class="form-control" id="amount"
                         placeholder="Enter Amount For Additional Option" value="{{ $editoption->amount ?? '' }}"/>
                    </div>
                    @error('amount')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="percentage">Option Percentage</label>
                    <div class="form-control-wrap">
                        <input type="number" name="percentage" class="form-control" id="percentage"
                         placeholder="Enter percentage For Additional Option" value=""/>
                    </div>
                    @error('percentage')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="currency">Option Currency</label>
                    <div class="form-control-wrap">
                        <input type="text" name="currency" class="form-control" id="currency"
                         placeholder="Enter Currency For Additional Option" value="{{ $editoption->currency ?? '' }}"/>
                    </div>
                    @error('currency')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    @if($editoption)
                    <button type="submit" class="btn btn-lg btn-primary savebtn">Update</button>
                    <a href="{{ url('admin-dashboard/logo-options/') }}" class="btn btn-lg btn-primary">Add New</a>
                    @else
                    <button type="submit" class="btn btn-lg btn-primary savebtn">Save</button>
                    @endif
                   
                   
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="nk-block nk-block-lg mt-4">
        <div class="nk-block-head">
            <div class="nk-block-head-content d-flex justify-content-between">
                <h4 class="nk-block-title">Additional Options List</h4>
            </div>
        </div>
        <div class="card card-bordered card-preview">
            <table class="table table-tranx">
                <thead>
                    <tr class="tb-tnx-head ">
                        <th class="tb-tnx-id"><span class="">#</span></th>
                        <th class="tb-tnx-info text-center">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>Text</span>
                            </span>
                        </th>
                        <th class="tb-tnx-info text-center">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>amount</span>
                            </span>
                        </th>
                        <th class="tb-tnx-info text-center">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>duration</span>
                            </span>
                        </th>
                        <th class="tb-tnx-info text-center">
                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                <span>currency</span>
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
                    @foreach($addtionaloption as $option)
                    <tr class="tb-tnx-item">
                        <td class="tb-tnx-id text-center">
                            <a href="#"><span>{{ $count++ }}</span></a>
                        </td>
                        <td class="tb-tnx-info text-center">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $option->option_text ?? '' }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-info text-center">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $option->amount ?? '' }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-info text-center">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $option->duration ?? '' }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-info text-center">
                            <div class="tb-tnx-desc">
                                <span class="title">{{ $option->currency ?? '' }}</span>
                            </div>
                        </td>
                        <td class="tb-tnx-amount is-alt text-center">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" data-offset="-8,0"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a class="edit-btn" href="{{ url('/admin-dashboard/logo-options/'.$option->id) }}">Edit</a></li>
                                    <li><a href="{{ url('admin-dashboard/delete-options/'.$option->id) }}">delete</a></li>
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
  


@endsection
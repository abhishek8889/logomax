@extends('admin_layout/master')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Blogs List </h4>
                                             </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead class="text-center">
                                                   
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Banner image</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Date</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Title</span>
                                                                    <span>Sub title</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount">
                                                            <span class="tb-tnx-total"></span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Action</span>
                                                        </th>
                                                </tr></thead>
                                                <tbody class="text-center">
                                                    <?php $count = 1; ?>
                                                @foreach($blogs as $b)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>{{ $count++ }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">
                                                                <img src="{{ asset('blog_images/') }}/{{ $b->banner_img ?? '' }}" alt="" width="50%">    
                                                                </span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $b->title ?? '' }}</span>
                                                                <span class="date">{{ $b->sub_title ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount">
                                                            <div class="tb-tnx-total">
                                                                <!-- <span class="amount">$599.00</span> -->
                                                            </div>
                                                            <div class="tb-tnx-status">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/blogs/edit/'.$b->slug) }}">Edit</a></li>
                                                                        <li><a href="{{ url('admin-dashboard/blogs/delete/'.$b->id) }}">Remove</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                   @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- .card-preview -->
                                    </div>
@endsection
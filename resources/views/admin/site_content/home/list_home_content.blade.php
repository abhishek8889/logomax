@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Site Content</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Content Value</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Date</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Content Name</span>
                                                                    <span>Content Type</span>
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
                                                @foreach($sitecontent as $content)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            {{ $count++ }}
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                @if($content->type == 'image')
                                                                 <span class="title"><img src="{{ asset('siteMeta') }}/{{ $content->value ?? '' }}" alt="{{ $content->key ?? '' }}" width="50%"></span>
                                                                @elseif($content->type == 'textarea')
                                                                    <span class="title">{{ $content->value ?? '' }}</span>
                                                                @endif
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $content->name ?? '' }}</span>
                                                                <span class="date">{{ $content->type ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/sitemeta/add') }}/{{ $content->key ?? '' }}">Edit</a></li>
                                                                        <li><a href="#">Remove</a></li>
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
@endsection
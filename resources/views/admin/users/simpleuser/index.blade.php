@extends('admin_layout.master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Users List - </h4>
                                            </div>
                                            <div>
                                               {{ Breadcrumbs::render('guests-list') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Name</span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Email</span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount is-alt">
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                                        </th>
                                                       
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php $i=1; ?>
                                                    @foreach ($users as $user)
                                                        
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>{{$i++ ?? ''}}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{$user->name ?? ''}}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{$user->email ?? ''}}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount is-alt">
                                                            <div class="tb-tnx-status">
                                                                <span class="badge badge-dot bg-{{ $user->is_approved ? 'success' : 'warning' }} changestatus{{$user->id}}">{{ $user->is_approved ? 'Paid' : 'Un-Paid' }}</span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    

@endsection
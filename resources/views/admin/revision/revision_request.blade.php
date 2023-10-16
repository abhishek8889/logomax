@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Logo Revision Request - </h4>
        </div>
        <div>
                <!-- Breadcrumbs::render('desingers-list') -->
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <table class="table table-tranx" id="table">
            <thead>
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Logo Name</span>
                        </span>
                    </th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Order Num</span>
                        </span>
                    </th>
                    <th class="tb-tnx-amount is-alt">
                        <span class="tb-tnx-status d-none d-md-inline-block">Revision Time</span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>Action</span>
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="tb-tnx-id">
                        <a href="#"><span>1</span></a>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title">dgfsf</span>
                        </div>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title">dxzasf</span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-status">
                            sdf
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-status">
                            sdf
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
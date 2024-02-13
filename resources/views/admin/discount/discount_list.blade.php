@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content d-flex justify-content-between">
            <h4 class="nk-block-title">Discount</h4>
            {{ Breadcrumbs::render('discount-list') }}
        </div>
    </div>
    <div class="card card-bordered card-preview">
        <table class="table table-tranx">
            <thead class="text-center">
                <tr class="tb-tnx-head">
                    <th class="tb-tnx-id"><span class="">#</span></th>
                    <th class="tb-tnx-info">
                        <span class="tb-tnx-desc d-none d-sm-inline-block">
                            <span>Discount Name</span>
                        </span>
                        <span class="tb-tnx-date d-md-inline-block d-none">
                            <span class="d-md-none">Date</span>
                            <span class="d-none d-md-block">
                                <span>Date From</span>
                                <span>Date To</span>
                            </span>
                        </span>
                    </th>
                    <th class="tb-tnx-amount is-alt">
                        <span class="tb-tnx-total">Normal logo percentage off</span>
                        <span class="tb-tnx-status d-none d-md-inline-block">Premium logo percentage off</span>
                    </th>
                    <th class="tb-tnx-action">
                        <span>&nbsp;</span>
                    </th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php $count = 1; ?>
                @if($discounts->isNotEmpty())
                @foreach($discounts as $discount)
                <tr class="tb-tnx-item">
                    <td class="tb-tnx-id">
                        <a href="#"><span>{{ $count++ }} </span></a>
                    </td>
                    <td class="tb-tnx-info">
                        <div class="tb-tnx-desc">
                            <span class="title">{{ $discount->name ?? '' }}</span>
                        </div>
                        <div class="tb-tnx-date">
                            <span class="date">{{ $discount->from_date ?? '-' }}</span>
                            <span class="date">{{ $discount->to_date ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="tb-tnx-amount is-alt">
                        <div class="tb-tnx-total">
                            <span class="amount">{{ $discount->normal_logo_price ?? '' }}%</span>
                        </div>
                        <div class="tb-tnx-status">
                            <span class="amount">{{ $discount->premium_logo_price ?? '' }}%</span>
                        </div>
                    </td>
                    <td class="tb-tnx-action">
                        <div class="dropdown">
                            <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                <ul class="link-list-plain">
                                    <li><a href="{{ url('/admin-dashboard/add-discount/'.$discount->id) }}">Edit</a></li>
                                    @if($discount->default_discount == 0)
                                        <li><a href="{{ url('/admin-dashboard/discount/delete/'.$discount->id) }}">Remove</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div><!-- .card-preview -->
</div>
@endsection
@extends('admin_layout/master')
@section('content')

<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content d-flex justify-content-between">
                                                <h4 class="nk-block-title">Reviews List </h4>
                                                {{ Breadcrumbs::render('reviews') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead>
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Title</span>
                                                            </span>
                                                            <span class="tb-tnx-date d-md-inline-block d-none">
                                                                <span class="d-md-none">Date</span>
                                                                <span class="d-none d-md-block">
                                                                    <span>Review by</span>
                                                                    <span>Logo Name</span>
                                                                </span>
                                                            </span>
                                                        </th>
                                                        <th class="tb-tnx-amount is-alt">
                                                            <span class="tb-tnx-total">Rating</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Show on Home Page</span>
                                                        </th>
                                                        <th class="tb-tnx-action">
                                                            <span>&nbsp;</span>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $count = 1; ?>
                                                    @foreach($reviews as $review)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>{{ $count++ }}</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{ $review->title ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-date">
                                                                <span class="date">{{ $review->user_id ?? ''  }}</span>
                                                                <span class="date"><a href="{{ url('admin-dashboard/logo-detail/'.$review->logo->logo_slug ?? '') }}">{{ $review->logo->logo_name ?? '' }}</a></span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount is-alt">
                                                            <div class="tb-tnx-total">
                                                                <span class="amount">{{ $review->rating ?? 0 }} Star</span>
                                                            </div>
                                                            <div class="tb-tnx-status text-center">
                                                            <div class="custom-control custom-switch checked">
                                                                <input type="checkbox" name="checkbox{{ $review->id ?? '' }}" class="custom-control-input checkbox" value="{{ $review->id ?? '' }}" id="customSwitch{{ $review->id ?? '' }}" @if($review->home_page_status == 1) checked @endif>
                                                                <label class="custom-control-label" for="customSwitch{{ $review->id ?? '' }}"></label>
                                                            </div>
                                                                
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-action">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a href="{{ url('admin-dashboard/edit-review/'.$review->id ?? '') }}">Edit</a></li>
                                                                        <li><a href="{{ url('admin-dashboard/review/delete/'.$review->id) }}">Remove</a></li>
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
                                        $(document).ready(function(){
                                            $('input.checkbox').on('change',function(){
                                                id = $(this).val();
                                                if($(this).prop('checked')){
                                                   status = 1;
                                                }else{
                                                   status = 0;                   
                                                }
                                                $.ajax({
                                                    method:'post',
                                                    url: '{{ url('admin-dashboard/update-review-status') }}',
                                                    data: { id:id,status:status,_token:"{{ csrf_token() }}" },
                                                    success:function(response){
                                                        NioApp.Toast('Successfully updated home page status', 'info', {position: 'top-right'});
                                                    }
                                                })
                                                
                                            });
                                        });
                                    </script>
@endsection
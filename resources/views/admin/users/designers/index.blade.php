@extends('admin_layout.master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head d-flex justify-content-between">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Designers List - </h4>
                                            </div>
                                            <div>
                                                {{ Breadcrumbs::render('desingers-list') }}
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
                                                        <th class="tb-tnx-action">
                                                            <span>Action</span>
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
                                                        @if($user->is_approved == 0)
                                                        <td class="tb-tnx-action tdispay{{$user->id ?? ''}}">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                    <li>
                                                                        <a href="#" class="is_approve" payment-status="1" data-id="{{$user->id ?? ''}}" action="approve">
                                                                            Approve
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="is_approve" payment-status="1" data-id="{{$user->id ?? ''}}" action="remove">
                                                                            Remove
                                                                        </a>
                                                                    </li>
                                                                    </ul>
                                                                </div>  
                                                            </div>
                                                        </td>
                                                        @else
                                                        <td class="tb-tnx-action">
                                                            <h4 class="text-info ni ni-check "data-bs-toggle="tooltip" data-bs-placement="top" title="Approved"></h4>
                                                        </td>
                                                       @endif
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    

<script>
    $(document).ready(function (){
        $('.is_approve').on('click', function(e){
            toastr.clear();
            e.preventDefault();
            var action = $(this).attr('action');
            var payment_status = $(this).attr('payment-status');

            var user_id = $(this).attr('data-id');
            if(payment_status == 0){
                toastr.clear();
                NioApp.Toast('Payment not done by user please approve him later !', 'error', {position: 'top-right'});
                return false;
            }else{
                $.ajax({
                url: "{{ url('admin-dashboard/users-list/approve-user') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "user_id": user_id,
                    "action" : action,
                },
                type: "POST",
                beforeSend: function() {
                    $('.spinner-container').show();
                },
                success: function(data) {
                    $('.spinner-container').hide();
                    if (data['success']){

                      NioApp.Toast(data['success'], 'success', { position: 'top-right' });
                      $('.tdispay' + user_id).html('').html('<h4 class="text-info ni ni-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Approved" ></h4>');
                      $('.changestatus' + user_id).removeClass('bg-warning').addClass('bg-success').html('').html('Paid');
                    }
                    else{
                        NioApp.Toast(data['error'], 'error', {position: 'top-right'});
                    }
                },
                error: function(xhr) {
                    $('.spinner-container').hide();
                    NioApp.Toast(xhr.responseText, 'error', {position: 'top-right'});
                    }
                });
            }


        });
    });
</script>
@endsection
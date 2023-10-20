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
                                            <table class="table table-tranx" id="table">
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
                                                        
                                                    <tr class="">
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
                                                                @if($user->is_approved == 0)
                                                                <span class="badge badge-dot bg-warning changestatus{{$user->id}}">Pending</span>
                                                                @elseif($user->is_approved == 1)
                                                                <span class="badge badge-dot bg-success changestatus{{$user->id}}">Approved</span>
                                                                @elseif($user->is_approved == 2)
                                                                <span class="badge badge-dot bg-danger changestatus{{$user->id}}">Disapproved</span>
                                                                @endif
                                                            </div>
                                                        </td>
                                                       
                                                        <td class="tb-tnx-action tdispay{{$user->id ?? ''}}">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                    <li>
                                                                        @if($user->is_approved == 0 || $user->is_approved == 2)
                                                                        <a href="#" class="is_approve" is-approved="{{ $user->is_approved ?? '' }}" data-id="{{$user->id ?? ''}}" action="approve">
                                                                            Approve
                                                                        </a>
                                                                        @elseif($user->is_approved == 1)
                                                                        <a href="#" class="is_approve" is-approved="{{ $user->is_approved }}" data-id="{{$user->id ?? ''}}" action="approve">
                                                                            Disapprove
                                                                        </a>
                                                                        @endif
                                                                    </li>
                                                                    <li>
                                                                        <a href="#" class="remove" is-approved="{{ $user->is_approved }}" link="{{ url('admin-dashboard/designers-list/delete/'.$user->id) }}" action="remove">
                                                                            Remove
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{ url('/admin-dashboard/designers-view/'.$user->id) }}" action="remove">
                                                                            View
                                                                        </a>
                                                                    </li>
                                                                    </ul>
                                                                </div>  
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                            @if(!($users->isNotEmpty()))

                                           <h5 class="text-center">No designers found</h5>
                                           
                                            @endif
                                        </div>
                                    </div>
                                    

<script>
    $(document).ready(function (){
        $('body').delegate('.is_approve','click',function(e){
        // $('.is_approve').on('click', function(e){
            toastr.clear();
            e.preventDefault();
            var action = $(this).attr('action');
            var is_approved = $(this).attr('is-approved');

            var user_id = $(this).attr('data-id');
                $.ajax({
                url: "{{ url('admin-dashboard/users-list/approve-user') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    user_id: user_id,
                    is_approved:is_approved,
                    action: action,
                },
                type: "POST",
                beforeSend: function() {
                    $('.spinner-container').show();
                },
                success: function(data) {
                    // console.table(data);
                    $('.spinner-container').hide();
                    if (data['success']){

                      NioApp.Toast(data['success'], 'success', { position: 'top-right' });
                      $("#table").load(location.href + " #table");
                    //   $('.tdispay' + user_id).html('').html('<h4 class="text-info ni ni-check" data-bs-toggle="tooltip" data-bs-placement="top" title="Approved" ></h4>');
                    //   $('.changestatus' + user_id).removeClass('bg-warning').addClass('bg-success').html('').html('Paid');
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


        });
    });

    $('body').delegate('.remove','click',function(e){
        e.preventDefault();
        link = $(this).attr('link');
                Swal.fire({
                    title: 'Do you want to delete this designer permanently ?',
                    icon: 'info',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonColor: '#008000',
                    allowOutsideClick: false,
                    allowEscapeKey: false
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link;
                    } 
                    });
                });

</script>
@endsection
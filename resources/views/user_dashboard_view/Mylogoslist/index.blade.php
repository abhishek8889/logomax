@extends('user_dashboard_layout.master_layout')
@section('content')

<?php 
    use Carbon\Carbon;
?>
<div class="my-fav">
    <h3>My Logos</h3>
    @if($mylogos->isNotEmpty())
    <!-- My Logo list  -->
    <table>
        <tr>
            <!-- <th>Product Name</th> -->
            <!-- <th scope="col">Files</th> -->
            <!-- <th scope="col">Customization</th> -->
            <th></th>
        </tr>
        @foreach($mylogos as $logos)
   
        <!-- ///////////////////////////////// Here Logo means Order detail /////////////////////////////////////  -->
        <?php 
            
            $orderMakeAt = $logos->created_at;
            $dateObj = Carbon::parse($orderMakeAt);
            $freeRevisionDaysLimit = 14;
            $newDateObj = Carbon::parse($orderMakeAt);
           
            $freeRevisionValidUpto = $newDateObj->addDays($freeRevisionDaysLimit);
            //  dd($orderMakeAt);
            $currentDate = Carbon::now()->format('Y-m-d H:i:s');
            $downloadUptoDayLimit = 30 ;  //days 
            $logoBackupResponse = [];
            // dd($orderDetail);
            if($logos->logo_for_future_status == 1){
                // dd($currentDate , $dateObj);
                $logoBackupResponse = [
                    'status' => true,
                    'type' => 'paid_service',
                    'message' => '',
                ];

                $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);
                $dateObj3 = Carbon::parse($orderMakeAt);
                $checkRenewDateStatus  = $dateObj3->addDays($downloadUptoDayLimit + 30);
            
                if($checkRenewDateStatus > $currentDate ){
                    // One month is over after order now checking the further more payments .
                    $renewUpto = $checkRenewDateStatus->format('Y-m-d');
                    
                    if($donwloadUpTo < $currentDate){
                        
                        $logoBackupResponse = [
                            'status' => false,
                            'type' => 'paid_service',
                            'removed' => false,
                            'message' => "Your logo backup service has expired. Renew before $renewUpto to avoid service removal. Act now to continue enjoying our backup benefits. Thank you!",
                        ];

                        $paymentData = App\Models\Payment::where([['order_id','=',$logos->id],['payment_type','=','logo-backup']])->latest()->first();

                        if($paymentData){
                            $dateObj2 = Carbon::parse($paymentData->created_at);
                            $paymentDurValidUpto = $dateObj2->addDays($downloadUptoDayLimit);
                            if($paymentDurValidUpto > $currentDate){
                                $logoBackupResponse = [
                                    'status' => true,
                                    'type' => 'paid_service',
                                    'removed' => false,
                                    'message' => '',
                                ];
                            }
                        }
                    }else{
                        $logoBackupResponse = [
                            'status' => true,
                            'type' => 'paid_service',
                            'removed' => false,
                            'message' => "",
                        ];
                    }

                }else{

                    $logoBackupResponse = [
                        'status' => false,
                        'type' => 'paid_service',
                        'removed' => true,
                        'message' => "You have not renewed your logo backup service in given time, and as a result, it has been deleted.",
                    ];

                }

            }else{

                $donwloadUpTo = $dateObj->addDays($downloadUptoDayLimit);

                if($donwloadUpTo < $currentDate){
                    // One month is over after order now and now no backup is there.
                    $logoBackupResponse = [
                        'status' => false,
                        'type' => 'free_service',
                        'removed' => true,
                        'message' => 'Your free logo backup service is over now .',
                    ];
                }else{
                    $logoBackupResponse = [
                        'status' => true,
                        'type' => 'free_service',
                        'removed' => false,
                        'message' => '',
                    ];
                }
            }
        ?>
        <tr>
            <td data-label="Name">
                <div class="p-name pd-txt img-box">
                    <div class="p-img">
                        @if($logos->logodetail->media->directory_name != null ||
                        $logos->logodetail->media->directory_name != "")
                        <img src="{{ asset('LogoDirectory/'.$logos->logodetail->media->directory_name.'/'.$logos->logodetail->media->directory_name.'.png') }}"
                            class="img-fluid" alt="....">
                        @else
                        <img src="{{ asset($list->logos->media->image_path ?? '') }}" class="img-fluid" alt="....">
                        @endif
                    </div>
                    <div class="p-text inr-text"><a href=""  order-id="{{ $logos->id ?? '' }}"  class="download-btn-head">{{ $logos->logodetail->logo_name ?? '' }}</a></div>
                </div>
            </td>
            <!-- <td data-label="Price">
                <a href="" order-id="{{ $logos->id ?? '' }}"  class="download-btn-head">
                      <i class="fas fa-file-download"></i> 
                    Download
                </a> 
            </td> -->
            <td data-label="Customization">
                <ul class="desktop2">
                    <li><a href="javascript:void(0)" type="logo" order_id="{{ $logos->id }}" class="request-btn-new">Request customisation</a></li>
                    @if($logos->get_favicon_status == 1)
                    <li><a href="javascript:void(0)" type="favicon" order_id="{{ $logos->id }}" class="request-btn-new">Request favicon</a></li>
                    @endif
                </ul>
                <div class="tog-btn mobile2">
                    <div class="heart-i p-cntr inr-text" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a href="javascript:void(0)" type="logo" order_id="{{ $logos->id }}" class="request-btn-new dropdown-item">Request customisation</a>
                    <a href="javascript:void(0)" type="favicon" order_id="{{ $logos->id }}" class="request-btn-new dropdown-item">Request favicon</a>
                    </div>
                </div>
            </td>
            @if($currentDate < $freeRevisionValidUpto)
            <td>
                <div class="text">You have {{ $freeRevisionDaysLimit }} days left to request our<a href="javascript:void(0)" type="logo" order_id="{{ $logos->id }}" class="request-btn-new"> free logo customization </a>service</div>
            </td>
            @endif
            <td data-label="">
                <div class="tog-btn">
                    <div class="heart-i p-cntr inr-text" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-expanded="false"><i class="fas fa-ellipsis-v"></i></div>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item"
                            href="{{ url(app()->getlocale().'/order-details/'.$logos->logodetail->orderData->order_num ?? '') }}">View
                            Order</a>
                        <a class="dropdown-item"
                            href="{{ url(app()->getlocale().'/download-logo/'.$logos->logodetail->orderData->order_num ?? '') }}">Logo
                            Details</a>
                        <a class="dropdown-item download-btn-head" href="" order-id="{{ $logos->id ?? '' }}" >Download Logo</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
    <!-- My Logo list End -->
    @else
    <p>Currently you don't have any logo!</p>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.download-btn-head').on('click',function(e){
        e.preventDefault();
        order_id = $(this).attr('order-id');
       
        @if($mylogos->isNotEmpty())
        @if($logoBackupResponse['status'] == true)
            location.href = "{{ url(app()->getLocale().'/user-dashboard/logo/download') }}/"+order_id;
        @else
            @if($logoBackupResponse['type'] == 'free_service' || $logoBackupResponse['removed'] == true)
                Swal.fire({
                    title: "Logo is removed",
                    text: "{{ $logoBackupResponse['message'] }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    });
            @else
                Swal.fire({
                    title: "Need to Pay.",
                    text: "{{ $logoBackupResponse['message'] }}",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ok i'll pay"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href= "{{ url(app()->getLocale().'/payments/logo-backup/'.$orderDetail->order_num) }}";  
                        }
                    });
            @endif
        @endif   
        @endif
    });

    //  Customization click 
    $(".request-btn-new").on('click',function(e){
        e.preventDefault();
        let type = $(this).attr('type');
        let order_id = $(this).attr('order_id');
       
        $.ajax({
            method: 'post',
            url: '{{url(app()->getlocale()."/check-revision-status?".time())}}',
            data: {
                'request_type' : type,
                'order_id' : order_id,
            },
            success: function(response)
            {
                if(response.status== false){
                    if(response.url !== undefined ){
                        Swal.fire({
                            title: response.title,
                            text: response.message,
                            icon: "warning",
                            showCancelButton: true,
                            cancelButtonColor: "#d33",
                            confirmButtonColor: "#3085d6",
                            confirmButtonText: "Ok i'll pay",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href= response.url;  
                            }
                        });
                    }else{
                        Swal.fire({
                            title: response.title,
                            text: response.message,
                            icon: "warning",
                        });
                    }
                }else{
                    window.location.href= response.url;
                }
                
            }
        });
    });


</script>
@endsection


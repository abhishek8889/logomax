@extends('user_dashboard_layout.master_layout')
@section('content')
<div>
{{-- Breadcrumbs::render('subscriptions') --}}
</div>
<!-- <pre> -->
   <?php // print_r($orders_with_memberships); ?>
<!-- </pre> -->
<style>

button.swal2-cancel.swal2-styled.swal2-default-outline {
    color: #000 !important;
    background: #fff !important;
    border-radius: 130px;
    border: 1px solid #000000;
    padding: 10px 26px;
}

button.swal2-confirm.swal2-styled.swal2-default-outline {
    color: #fff !important;
    background: #000 !important;
    border-radius: 130px;
    border: 1px solid #000000;
    padding: 10px 26px;
    }

button.swal2-cancel.swal2-styled.swal2-default-outline:hover {
    background: #000 !important;
    color: #fff !important;
    transition: 0.5s;
}

button.swal2-confirm.swal2-styled.swal2-default-outline:hover {
    background: #fff !important;
    color: #000 !important;
    transition: 0.5s;
}
</style>

<div class="dash-ryt-content">
                             <div style="display: block;" class="subs-text ">
                                  <h3> Subscriptions</h3>
                              </div>
                              @foreach($orders_with_memberships as $orders)
                              <?php 
                              $currency = $orders->currency;
                              $price_with_format = Akaunting\Money\Money::$currency($orders->get_favicon_price,true);
                              $decimal_value = $price_with_format->getCurrency()->getDecimalMark().'00';

                          ?>
                              <div class="plans">
                                     <div class="d-block mnth-plan">
                                        <div class="chck"><img src="{{ asset('logomax_pages/img/check.svg') }}" class="img-fluid" alt=".."></div>
                                       <div class="month-plan">
                                          <img src="{{ asset('LogoDirectory/'.$orders->logodetail->media['directory_name'].'/'.$orders->logodetail->media['directory_name'].'.png') }}" alt="">
                                         <div class="subs_name">{{ $logo_backup_data->option_text ?? '' }} <span>{{ str_replace($decimal_value,"",$price_with_format) }}/{{ __('file.month_text') }} </span></div>
                                         
                                       </div>
                                       @if($orders->subscription_renew_status == 1)
                                        <button class=" cancel_subscription bta cta" order-id="{{ $orders->id ?? '' }}" active-status={{ $orders->subscription_renew_status ?? 0 }} >Cancel subscription</button>
                                        @else
                                        <button class=" cancel_subscription bta cta" active-status={{ $orders->subscription_renew_status ?? 0 }} disbaled>Cancelled</button>
                                        @endif
                                        <a href="{{ url(app()->getLocale().'/order-details/'.$orders->order_num) }}"><button class=" bta cta light">View Details</button></a>
                                     </div>
                                    </div>
                              </div>
                              @endforeach
             </div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
             <script>
               $(document).ready(function(){
                  $('.cancel_subscription').on('click',function(){
                     order_id = $(this).attr('order-id');
                     status = $(this).attr('active-status');
                     if(status == 0){
                        iziToast.error({
                                 message: 'Subscription already being cancelled',
                                 position: "topRight",
                              });
                        return false;
                     }

                     Swal.fire({
                title: 'Are you sure you want to cancel your subscription?',
               //  text: "Do you want to cancel your subscription ?",
                // icon: 'info',
                showCancelButton: true,
               //  showCloseButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Yes',
                confirmButtonText: 'No',
                reverseButtons:true,
                customClass: {
                    popup: 'swal_custom_class', // Add your custom class for additional styling
                },
                }).then((result) => {
                if (result.isConfirmed) {
                   return false;
                }else if(result.dismiss == "cancel"){
                  $.ajax({
                        method:'post',
                        url:"{{ url('user-dahsboard/updateStatus/') }}",
                        data:{order_id:order_id,_token:"{{ csrf_token() }}"},
                        success:function(response){
                          if(response.success){
                           iziToast.success({
                                 message: response.success,
                                 position: "topRight",
                              });
                              $('button[order-id="'+order_id+'"]').html('cancelled');
                              $('button[order-id="'+order_id+'"]').attr('active-status',0);
                          }else if(response.error){
                           iziToast.error({
                                 message: response.error,
                                 position: "topRight",
                              });
                          }
                        }
                     })
                  }
            })
                     
                  })
               })
             </script>
@endsection

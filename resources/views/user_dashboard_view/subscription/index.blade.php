@extends('user_dashboard_layout.master_layout')
@section('content')
<div>
{{ Breadcrumbs::render('subscriptions') }}
</div>
<div class="dash-ryt-content">
                             <div style="display: block;" class="subs-text pl-5">
                                  <h3> subscriptions</h3>
                                  <p><i
                                 style="color: rgb(71, 167, 71);"  class="fas fa-info-circle"></i> your basic subscription id vaild till 10 oct, 2023</p>
                              </div>
                              <div class="plans">
                                 <h6 class="d-block pl-5"> plan</h6>
                                  <div class="d-flex pl-5 ">
                                     <div class="d-block mnth-plan">
                                        <div class="chck"><img src="{{ asset('logomax_pages/img/check.svg') }}" class="img-fluid" alt=".."></div>
                                       <div class="month-plan">
                                        <p class="d-inline-block text-black">Save for later</p>
                                        <p class="d-flex float-right">$5/month</p>
                                       </div>
                                       <p>save your logo for later in account</p>
                                        <button class="sub-butn">cancel subscription</button>
                                     </div>
                                 </div>
                              </div>
                         </div>
             </div>
@endsection

@extends('user_dashboard_layout.master_layout')
@section('content')
    <div style="display: block;">
        <h3> subscriptions</h3>
        <h6 style="display: inline-block;" class="border border-success p-lg-3 rounded"><i style="color: rgb(71, 167, 71);"
                class="fas fa-info-circle"></i> your basic subscription id vaild till 10 oct, 2023</h6>


    </div>
    <br><br><br>
    <h3 class="d-block"> plan</h3>
    <div class="d-flex">
        <div class="d-block col-5 py-3 border border-success bg-white rounded ">
            <div>

                <h4 class="d-inline-block text-black">Save for later</h4>
                <p class="d-flex float-right">$5/month</p>
            </div>
            <p>save your logo for later in account</p>
            <button class="btn btn-outline-dark rounded-pill">cancel subscription</button>
        </div>
        <!-- <span class="d-flex"><i class="fas fa-check-circle"></i></span> -->
    </div>
@endsection

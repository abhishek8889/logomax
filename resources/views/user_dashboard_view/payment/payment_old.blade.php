@extends('user_dashboard_layout.master_layout')
@section('content')
<style>
    div#card-elements {
        padding: 10px 0px;
        border: 1px solid #ced4da;
        border-radius: 3px;
        margin-bottom: 17px;
    }
</style>
<?php
$price = '';
$currency = '';

$additionalOptionAmount = App\Models\AdditionalOptions::where('option_type','save-logo-for-future')->select('amount','currency')->first();

if($request->payment_type == 'logo-backup'){
    $price = $additionalOptionAmount->amount;
    $currency = $additionalOptionAmount->currency; 
}

if($request->payment_type == 'logo_revision' || $request->payment_type == 'favicon_revision'){
    if($request->session()->get('currency')){
        $currency = $request->session()->get('currency');
       
    }else{
        $currency = 'USD';
        
    }

    if($request->payment_type == 'logo_revision'){
        $logo_revision_price = App\Models\AdditionalOptions::where('option_type','addition-logo-revision-price')->pluck('amount')->first();
        $price = $logo_revision_price;
    }
    if($request->payment_type == 'favicon_revision'){
        $favicon_revision_price = App\Models\AdditionalOptions::where('option_type','addition-favicon-revision-price')->pluck('amount')->first();
        $price = $favicon_revision_price;
    }
}

?>

<h5>{{ __('file.payment_method_text') }}</h5>
<form action="{{ url(app()->getLocale().'/purchase-revision-process') }}" id="progress-form" method="POST">
    @csrf
    <input type="hidden" name="price" value="{{ $price }}">
    <input type="hidden" name="currency" value="{{ $currency }}">
    <input type="hidden" name="order_id" value="{{ $orderDetail->id }}">
    <input type="hidden" name="payment_type" value="{{ $request->payment_type }}" />
    <div class="pay_form_data">
        <div class="card_wrapper" id="cardPayment">
            <div class="form-group">
                <span></span>
                <p>{{ __('file.credit_card_text') }}</p>
            </div>
            <div class="crad_img">
                <img src="{{ asset('logomax-front-asset/img/card-img-icon.svg') }}" alt="">
            </div>
        </div>
        <div class="card_detail">
            <div class='form-row row'>
                <div class='col-lg-12 form-group'>
                    <label class='control-label'>{{ __('file.name_on_card') }}</label>
                        <input class='form-control' id="name_on_card" name="name_on_card" placeholder="{{ __('file.name_on_card') }}" type='text'>
                </div>
            </div>
            <!-- ################### Show Card ######################### -->
            <div id="card-elements"></div>
            <!-- ################### ######### ######################### -->
        </div>
    </div>
    <button type="button" class="formSubmitBtn continue_btn btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}" >Pay {{$price}} {{ $currency }}</button>
</form>
                    
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
    const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
    const elements= stripe.elements();
    const cardElement= elements.create('card');
    cardElement.mount('#card-elements');
    
    //////##################################//////////
    //When Clicked on card button//     
        // $('#cardPayment').on('click',function(){
        //     $('#cardImage').hide();
        //     $('#nopaymethod').show();
        //      // Show Entered Card icons on the confirmation page
        //     cardElement.on('change', function (event) {
        //     const card = event.brand === 'Unknown' ? (event.complete ? event : null) : event;
            
        //     if (card) {
        //         let brand = card.brand;
        //         if(brand ==='unknown' || brand.length === 0 )
        //         {
        //             $('#cardImage').hide();
        //             $('#nopaymethod').show();          
        //         }
        //         else{
        //             $('#nopaymethod').hide();
        //             $('#cardImage').show();
        //             $('#cardImage').attr('src', `{{-- asset('logomax-front-asset/img/card-images/') --}}/${brand}.png`);
                    
        //         }
        //     }
        //     }); 
        // })
        // When Clicked on Paypal Button
        // $('#paypalPayment').on('click',function(){
        //     $('#cardImage').show();
        //     $('#nopaymethod').hide();
        //     // Show Paypal Icon on the Confirmation page
        //     $('#cardImage').attr('src', `{{-- asset('logomax-front-asset/img/card-images/paypal.png') --}}`);
        // })
    //////##################################//////////
    const formSubmitBtn = document.querySelector('.formSubmitBtn');
    formSubmitBtn.addEventListener('click', async (e) => {
        e.preventDefault()
        const form = document.getElementById('progress-form');
        const cardBtn = document.getElementById('card-button');
        const cardHolderName = document.getElementById('name_on_card'); 
        
        const { setupIntent, error } = await stripe.confirmCardSetup(
            cardBtn.dataset.secret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        ) 
        console.log(cardElement);
        if(error){
            cardBtn.disable = false
            if(error.message != ''){
                $("#card-error-message").html(error.message);
            }
        }else{
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            let payment_gateway = document.createElement('input')
            payment_gateway.setAttribute('type','hidden')
            payment_gateway.setAttribute('name', 'payment_gateway')
            payment_gateway.setAttribute('value', 'stripe')

            form.appendChild(token)
            form.appendChild(payment_gateway)

            form.submit();
        }
    });
    </script>
@endsection
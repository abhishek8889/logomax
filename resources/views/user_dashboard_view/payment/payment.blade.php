@extends('user_dashboard_layout.master_layout')
@section('content')

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
<div class="pay-box">
    <h5>{{ __('file.payment_method_text') }}</h5>
    <form action="{{ url(app()->getLocale().'/purchase-revision-process') }}" id="progress-form" method="POST">
        @csrf
        <input type="hidden" name="price" value="{{ $price }}">
        <input type="hidden" name="currency" value="{{ $currency }}">
        <input type="hidden" name="order_id" value="{{ $orderDetail->id }}">
        <input type="hidden" name="payment_type" value="{{ $request->payment_type }}" />
        <!-- <div class="pay_form_data">
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

                <div id="card-elements"></div>

            </div>
        </div> -->
        <div id="payment_form_error" class="text text-danger"></div>
            <div class="pay_form_data">
                <div class="card_wrapper clicked" id="cardPayment">
                    <div class="form-group">
                        <span></span>
                        <p>{{ __('file.credit_card_text') }}</p>
                    </div>
                    <div class="crad_img">
                        <img src="{{ asset('logomax-front-asset/img/card-img-icon.svg') }}" alt="">
                    </div>
                </div>
                <div class="card_detail " style="display:block;">
                    <div class='form-row row'>
                        <div class='col-lg-12 form-group'>
                            <label class='control-label' for="name_on_card">{{ __('file.name_on_card') }}</label>
                            <input class='form-control' id="name_on_card" name="name_on_card" placeholder="{{ __('file.name_on_card') }}" type='text'>
                        </div>
                    </div>
                    <!-- ################### Show Card ######################### -->
                
                    <!-- <label class='control-label' for="card-elements">Enter your card</label>
                    <div id="card-elements"></div>
                     -->

                    <div class="">
                        <label class='control-label' for="card-number">Card number</label>
                        <div id="card-number" class="form-control"></div>
                    </div>
                    <div class="row address_data">
                        <div class="col-md-6">
                            <label class='control-label' for="card-expiry">Expire on</label>
                            <div id="card-expiry" class="form-control"></div>
                        </div>
                        <div class=" col-md-6 code">
                            <label class='control-label' for="card-cvc">CVC</label>
                            <div id="card-cvc" class="form-control"></div>
                        </div>
                    </div>

                    <!-- ################### ######### ######################### -->
                    <div id="card-error-message" class="text text-danger"></div> 
                </div>
            </div>
        <div class="pay_form_data">
            <div class="card_wrapper" id="paypalPayment">
                <div class="form-group">
                    <span></span>
                    <p>{{ __('file.paypal_text') }}</p>
                </div>
                <div class="crad_img">
                    <img src="{{ asset('logomax-front-asset/img/paypal-svg.svg') }}" alt="">
                </div>
            </div>
            <div class="card_detail">
                <!-- Paypal form  -->
                <!-- <div id="paypal-buttons-container"></div> -->
                <!-- End -->
                <!-- <div id="paypal-button-container-P-3GP4923023592193FMWZBOOA"></div> -->
                <a href="{{ route('make.payment',['locale'=>app()->getLocale(),'payment_type' => $request->payment_type,'order_num' => $orderDetail->order_num  ]) }}" class="w-full  uppercase rounded-xl font-extrabold text-white px-6 h-8" style="background:#003087;">Pay with PayPal</a>
            </div>
        </div>
        <div class="payment-btn-box">
            <button type="button" class="formSubmitBtn continue_btn btn cta mt-3" id="card-button" data-secret="{{ $intent->client_secret }}" >Pay {{$price}} {{ $currency }}</button>
        </div>
    </form>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id={{-- env('PAYPAL_SANDBOX_CLIENT_ID') --}}"></script> -->

<script src="https://www.paypal.com/sdk/js?client-id=Aa2H8BIlAz5IjzD8rf3utzhY4Wc8khjwpKGTswET3h46vX_47bFxjl3QNomPeYmbwxmGxjZB6w8pUSBM&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
   
 <!-- Paypal JS -->
    <script>
        // Render the PayPal buttons
        // paypal.Buttons().render('');
        // paypal.Buttons({
        //     createOrder: function(data, actions) {
        //         var price = 400;

        //         return actions.order.create({
        //             purchase_units: [{
        //                 amount: {
        //                     value: price
        //                 }
        //             }]
        //         });
        //     },
        //     onApprove: function(data, actions) {
        //         return actions.order.capture().then(function(details) {
        //             console.log(details);
        //             updateDatabase(details);
        //         });
        //     },
        //     onCancel: function(data) {
        //         console.log('Payment cancelled');
        //     }
        // }).render('#paypal-buttons-container');
    </script>
 <!-- End -->
<script>
    const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
    const elements= stripe.elements();
    // const cardElement= elements.create('card');
    // cardElement.mount('#card-elements');

    var cardNumber = elements.create('cardNumber',{
        showIcon: true,
    });
   
    cardNumber.mount('#card-number');

    var cardExpiry = elements.create('cardExpiry');
    cardExpiry.mount('#card-expiry');

    var cardCvc = elements.create('cardCvc');
    cardCvc.mount('#card-cvc');
    
    //////##################################//////////
    //When Clicked on card button//     
        $('#cardPayment').on('click',function(){
            $('#cardImage').hide();
            $('#nopaymethod').show();
             // Show Entered Card icons on the confirmation page
        })
        // When Clicked on Paypal Button
        $('#paypalPayment').on('click',function(){
            $('#cardImage').show();
            $('#nopaymethod').hide();
            // Show Paypal Icon on the Confirmation page
            $('#cardImage').attr('src', `{{-- asset('logomax-front-asset/img/card-images/paypal.png') --}}`);
        })
        cardNumber.on('change', function (event) {
            const card = event.brand === 'Unknown' ? (event.complete ? event : null) : event;
            
            if (card) {
                let brand = card.brand;
                if(brand ==='unknown' || brand.length === 0 )
                {
                    $('#cardImage').hide();
                    $('#nopaymethod').show();          
                }
                else{
                    $('#nopaymethod').hide();
                    $('#cardImage').show();
                    $('#cardImage').attr('src', `{{-- asset('logomax-front-asset/img/card-images/') --}}/${brand}.png`);
                }
            }
        }); 
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
                    card: cardNumber,
                    billing_details: {
                        name: cardHolderName.value
                    }   
                }
            }
        ) 
        // console.log(cardNumber);
        if(error){
            cardBtn.disable = false
            if(error.message != ''){
                $("#card-error-message").html(error.message);
            }
            console.log(error);
        }else{
            let token = document.createElement('input')
            // console.log(setupIntent.payment_method);
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
    <script>
        // =================
        jQuery(document).ready(function (e) {
        $(".card_wrapper").on("click", function () {
            var otherCardWrappers = $(".card_wrapper").not(this);
            otherCardWrappers.each(function () {
            var cardDetail = $(this).next(".card_detail");
            if($(this).hasClass('clicked')){
                $(this).removeClass('clicked');
            }
            if (cardDetail.is(":visible")) {
                cardDetail.slideUp();
            }
            });
            $(this).next(".card_detail").slideToggle();
            $(this).toggleClass("clicked");
        })

        }) 

        // =======
    </script>


<script>
//   paypal.Buttons({
//       style: {
//           shape: 'rect',
//           color: 'blue',
//           layout: 'vertical',
//           label: 'subscribe'
//       },
//       createSubscription: function(data, actions) {
//         return actions.subscription.create({
//           /* Creates the subscription */
//           plan_id: 'P-3GP4923023592193FMWZBOOA'
//         });
//       },createOrder: function(data, actions) {
//             var price = 200;

//             return actions.order.create({
//                 purchase_units: [{
//                     amount: {
//                         value: price
//                     }
//                 }]
//             });
//         },
//       onApprove: function(data, actions) {
//         alert(data.subscriptionID); // You can add optional success message for the subscriber here
//       }
//   }).render('#paypal-button-container-P-3GP4923023592193FMWZBOOA'); // Renders the PayPal button



// paypal.Buttons({
//         style: {
//             shape: 'rect',
//             color: 'blue',
//             layout: 'vertical',
//             label: 'subscribe'
//         },
//         createOrder: function(data, actions) {
//         // Set up the payment details for one-time paymentreturn actions.order.create({
//             purchase_units: [{
//                 amount: {
//                     value: '10.00', // Replace with the amount for the one-time payment
//                 },
//             }],
//         },
//         onApprove: function(data, actions) {
//         // Capture the funds for the one-time paymentreturn actions.order.capture().then(function(details) {
//             // Optionally, handle the success of the one-time paymentconsole.log(details);
//         }),
//         commit: true,
//         // Add the subscription button to the same containercreateSubscription: function(data, actions) {
//             return actions.subscription.create({
//                 plan_id: 'YOUR_PLAN_ID', // Replace with the PayPal plan ID for subscription
//             });
        
//         onSubscription: function(data) {
//             // Optionally, handle the success of the subscriptionconsole.log(data);
//         },
//     }).render('#paypal-buttons-container');


// </script>
@endsection
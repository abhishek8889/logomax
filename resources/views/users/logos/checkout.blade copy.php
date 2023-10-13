@extends('user_layout/master')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<?php 
    $countries = [
        'America' => "USA",
    ];
?>
<section class="banner-sec checkout_banner" style="background-image: url('{{ asset('logomax-front-asset/img/check_banner.png') }}');">
    <div class="container-fluid"></div>
  </section>
  <section class="checkout_sec p-110">
    <div class="container">
        <form id="progress-form" action="{{ url('logo-checkout') }}" method="post">
            @csrf
            <div class="step_form_head" role="tablist">
                <div class="box_step">
                    <button id="progress-form__tab-1" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 1 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/checkout.png') }}" alt="">
                            </span>
                        </div>
                        <p> Information</p>
                    </button>
                </div>
                <div class="box_step">
                    <button id="progress-form__tab-2" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 2 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/checkout.png') }}" alt="">
                            </span>
                        </div>
                        <p> Payment</p>
                    </button>
                </div>
                <div class="box_step border_last">
                    <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 3 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/checkout.png') }}" alt="">
                            </span>
                        </div>
                        <p> Confirmation</p>
                    </button>
                </div>
            </div>
            <section id="progress-form__panel-1" class="data_wrapper one" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
                <div class="custom_step_form">
                    <div class="step_form">
                        <div class="step_form_content">
                            <h5>Billing address</h5>
                            <div class="form-group">
                            <select name="country">
                                @foreach($countries as $k => $v)
                                <option value="{{$k}}">{{ $v }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="mt-3 sm:mt-0 form__field">
                            <label for="last-name">
                            <span  aria-hidden="true"></span>
                            </label>
                            <input  type="text" name="Address-1" placeholder="Address Line 1" />
                        </div>
                        <div class="mt-3 sm:mt-0 form__field">
                            <label for="last-name">
                            <span aria-hidden="true"></span>
                            </label>
                            <input  type="text" name="Address-2"  placeholder="Address Line 2" />
                        </div>
                        <div class="mt-3 form__field">
                            <label for="city-address">
                            <span  aria-hidden="true"></span>
                            </label>
                            <input id="city-address" type="text" name="city" placeholder="City" />
                        </div>
                        <div class="mt-3 form__field">
                            <label for="state-address">
                            <span  aria-hidden="true"></span>
                            </label>
                            <input id="state" type="text" name="state" placeholder="State / Province / Region" />
                        </div>
                        <div class="mt-3 form__field">
                            <label for="zip">
                            <span aria-hidden="true"></span>
                            </label>
                            <input id="zip" type="text" name="zip-code" placeholder="Zip / Postal Code" />
                        </div>
                        <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <button type="button" data-action="next" class="continue_btn">
                                Continue
                            </button>
                        </div>
                    </div>

                    <div class="checkout_summary">
                    <h5>Order summary</h5>
                    <div class="templete_wrapper">
                        <div class="summary_wrapp">
                            <div class="img">
                                <img src="{{ asset($logo->media->image_path) }}" alt="" />
                            </div>
                            <div class="drawn_data">
                                <p>{{ $logo->logo_name }}</p>
                                <span><b>${{ $logo->price_for_customer }}</b></span>
                            </div>
                        </div>
                        <div class="additional_content">
                            <h6>Additional options:</h6>
                        </div>
                        <?php 
                        $additional_options = App\Models\AdditionalOptions::class::all();
                        ?>
                        <?php
                            $gst_prcnt = 12;
                        ?>
                        @foreach($additional_options as $option)
                            <?php 
                            $gst_prcnt = '';
                                if($option->option_type == 'gst-tax'){
                                    $gst_prcnt = $option->percentage;
                                }
                            ?>
                            @if($option->option_type == 'save-logo-for-future')
                            <div class="add_account_wrapp">
                                <div class="save_data">
                                    <p>{{ $option->option_text }}</p>
                                    @if($option->pricing_duration == 'monthly')
                                    <span><b>${{ $option->amount }} /month</b></span>
                                    @else
                                    <span><b>${{ $option->amount }}</b></span>
                                    @endif
                                </div>
                                <div class="add_btn">
                                    <a href="" data-id="option-{{ $option->id }}" class="add_btn">Add</a>
                                </div>
                            </div>
                            @endif
                            @if($option->option_type == 'get-favicon')
                            <div class="add_account_wrapp">
                                <div class="save_data">
                                    <p>{{ $option->option_text }}</p>
                                    @if($option->pricing_duration == 'monthly')
                                    <span><b>${{ $option->amount }} /month</b></span>
                                    @else
                                    <span><b>${{ $option->amount }}</b></span>
                                    @endif
                                </div>
                                <div class="add_btn">
                                    <a href=""  data-id="option-{{ $option->id }}" class="add_btn">Add</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                        <?php 
                            dd($gst_prcnt);
                            $logo_price = (float)$logo->price_for_customer;
                            $gst_cut = ($logo_price * $gst_prcnt) / 100;
                            $total_price = $logo_price + $gst_cut;
                        ?>
                        <div class="table_data">
                        <div class="total_data">
                            <p>Subtotal</p>
                            <p>${{ $logo->price_for_customer }}</p>
                        </div>
                        <div class="total_data">
                            <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                            <p>${{ $gst_cut }}</p>
                        </div>
                        <div class="total_data num">
                            <p><b>Total</b></p>
                            <p><b>${{ $total_price }}</b></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <section id="progress-form__panel-2" class="data_wrapper one" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
                <div class="custom_step_form">
                    <div class="step_form">
                    <h5>Payment method</h5>
                        <!-- Stripe Credit Card -->
                        <div class="pay_form_data">
                            <div class="card_wrapper">
                                <div class="form-group">
                                    <span></span>
                                    <p>Credit card</p>
                                </div>
                                <div class="crad_img">
                                    <img src="{{ asset('logomax-front-asset/img/payment.png') }}" alt="">
                                </div>
                            </div>
                            <div class="card_detail">
                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group'>
                                        <label class='control-label'>Name on Card</label>
                                         <input class='form-control' id="name_on_card" type='text'>
                                    </div>
                                </div>
                                <!-- ################### Show Card ######################### -->
                                <div id="card-elements"></div>
                                <!-- ################### ######### ######################### -->
                            </div>
                        </div>
                    <div class="pay_form_data">
                        <div class="card_wrapper">
                        <div class="form-group">
                            <span></span>
                            <p>PayPal</p>
                        </div>
                        <div class="crad_img">
                            <img src="{{ asset('logomax-front-asset/img/pay.png') }}" alt="">
                        </div>
                        </div>
                        <div class="card_detail">
                            <!-- <div class="mt-3 form__field">
                                <input id="address-2" type="text" name="" placeholder="Card Number">
                            </div>
                            <div class="mt-3 form__field">
                                <input id="address-2" type="text" name=""  placeholder="Name On Card">
                            </div>
                            <div class="row address_data">
                                <div class="col-md-6">
                                    <input id="address-2" type="text" name="" placeholder="Expiration Date(MM/YY)">
                                </div>
                                <div class=" col-md-6 code">
                                    <input id="address-2" type="text" name="" placeholder="Security Code">
                                </div>
                            </div> -->
                        </div>
                        </div>
                    <div class="chk_btn">
                        <button type="button" data-action="next" class="continue_btn">
                        Continue
                        </button>
                    </div>
                    </div>
                    <div class="checkout_summary">
                    <h5>Order summary</h5>
                    <div class="templete_wrapper">
                        <div class="summary_wrapp">
                        <div class="img">
                            <img src="{{ asset($logo->media->image_path) }}" alt="" />
                        </div>
                        <div class="drawn_data">
                            <p>{{ $logo->logo_name }}</p>
                            <span><b>${{ $logo->price_for_customer }}</b></span>
                        </div>
                        </div>
                        <div class="additional_content">
                        <h6>Additional options:</h6>
                        </div>
                        <div class="add_account_wrapp">
                        <div class="save_data">
                            <p>Save your logo for later in account.</p>
                            <span><b>$5 /month</b></span>
                        </div>
                        <div class="add_btn">
                            <a href="" class="add_btn">Add</a>
                        </div>
                        </div>
                        <div class="add_account_wrapp">
                        <div class="save_data">
                            <p>Get favicon of logo</p>
                            <span><b>$29</b></span>
                        </div>
                        <div class="add_btn">
                            <a href="" class="add_btn">Add</a>
                        </div>
                        </div>
                        <?php 
                            $logo_price = (float)$logo->price_for_customer;
                            $gst_prcnt = 18;
                            $gst_cut = ($logo_price * 18) / 100;
                            $total_price = $logo_price + $gst_cut;
                        ?>
                        <div class="table_data">
                        <div class="total_data">
                            <p>Subtotal</p>
                            <p>${{ $logo->price_for_customer }}</p>
                        </div>
                        <div class="total_data">
                            <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                            <p>${{ $gst_cut }}</p>
                        </div>
                        <div class="total_data num">
                            <p><b>Total</b></p>
                            <p><b>${{ $total_price }}</b></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
            <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
                <div class="custom_step_form">
                    <div class="billing_address step_form">
                    <h5>Order Confirmation</h5>
                    <div class="billing_content">
                        <div class="billing_wrapper">
                        <div class="billing_text">
                            <h6>Billing Address</h6>
                            <p>80191 Blaise Street Apt. 110 Boganland, Arkansas USA 893804</p>
                        </div>
                        <div class="bill-icon">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        </div>
                        <div class="billing_wrapper">
                        <div class="billing_text">
                            <h6>Payment Method</h6>
                            <div class="img_visa">
                            <img src="{{ asset('logomax-front-asset/img/visa.png') }}" alt="" />
                            </div>
                            <p>Visa card ending in 1234</p>
                        </div>
                        <div class="bill-icon">
                            <i class="fa-solid fa-pen"></i>
                        </div>
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                        <div class="text text-warning mt-2" id="card-error-message"></div>
                        <div class="checkout_btn">
                            <!-- <a href="logo-download-page.html" class="continue_btn">
                            Continue & Download
                            </a> -->
                            <button type="button" class="formSubmitBtn" id="card-button" data-secret="{{ $intent->client_secret }}">Continue & Download</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="checkout_summary">
                    <h5>Order summary</h5>
                    <div class="templete_wrapper">
                        <div class="summary_wrapp">
                        <div class="img">
                            <img src="{{ asset($logo->media->image_path) }}" alt="" />
                        </div>
                        <div class="drawn_data">
                            <p>{{ $logo->logo_name }}</p>
                            <span><b>${{ $logo->price_for_customer }}</b></span>
                        </div>
                        </div>
                        <div class="additional_content">
                        <h6>Additional options:</h6>
                        </div>
                        <div class="add_account_wrapp">
                        <div class="save_data">
                            <p>Save your logo for later in account.</p>
                            <span><b>$5 /month</b></span>
                        </div>
                        <div class="add_btn">
                            <a href="" class="add_btn">Add</a>
                        </div>
                        </div>
                        <div class="add_account_wrapp">
                        <div class="save_data">
                            <p>Get favicon of logo</p>
                            <span><b>$29</b></span>
                        </div>
                        <div class="add_btn">
                            <a href="" class="add_btn">Add</a>
                        </div>
                        </div>
                        <?php 
                            $logo_price = (float)$logo->price_for_customer;
                            $gst_prcnt = 18;
                            $gst_cut = ($logo_price * 18) / 100;
                            $total_price = $logo_price + $gst_cut;
                        ?>
                        <div class="table_data">
                        <div class="total_data">
                            <p>Subtotal</p>
                            <p>${{ $logo->price_for_customer }}</p>
                        </div>
                        <div class="total_data">
                            <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                            <p>${{ $gst_cut }}</p>
                        </div>
                        <div class="total_data num">
                            <p><b>Total</b></p>
                            <p><b>${{ $total_price }}</b></p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
  </section>
  
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env('STRIPE_PUB_KEY') }}');
    const elements= stripe.elements();
    const cardElement= elements.create('card');
    cardElement.mount('#card-elements');

    // const form = document.getElementById('progress-form');
    
    const formSubmitBtn = document.querySelector('.formSubmitBtn');

    formSubmitBtn.addEventListener('click', async (e) => {

        console.log('hello');
           
        const form = document.getElementById('progress-form');

        const cardBtn = document.getElementById('card-button');

        const cardHolderName = document.getElementById('name_on_card'); 
            e.preventDefault()
            if($('input#agreement1').is(':checked')){
            
            }else{
            return false;
            }
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
            // if(error) {
            //     cardBtn.disable = false
            //     if(error.message != ''){
            //         $("#card-error-message").html(error.message);
            //     }
            // } else {
            //     let token = document.createElement('input')
            //     token.setAttribute('type', 'hidden')
            //     token.setAttribute('name', 'token')
            //     token.setAttribute('value', setupIntent.payment_method)
            //     form.appendChild(token)
            //     form.submit();
            // }
            console.log(error);
            console.log('adfsfsfsfsfsfsfsfsfsfsfsfsfs');
            console.log(setupIntent.payment_method);
    });
</script>
@endsection
@extends('user_dashboard_layout.master_layout')
@section('content')
<?php 
    $countries = array(
        "AF" => "Afghanistan",
        "AL" => "Albania",
        "DZ" => "Algeria",
        "AS" => "American Samoa",
        "AD" => "Andorra",
        "AO" => "Angola",
        "AI" => "Anguilla",
        "AQ" => "Antarctica",
        "AG" => "Antigua and Barbuda",
        "AR" => "Argentina",
        "AM" => "Armenia",
        "AW" => "Aruba",
        "AU" => "Australia",
        "AT" => "Austria",
        "AZ" => "Azerbaijan",
        "BS" => "Bahamas",
        "BH" => "Bahrain",
        "BD" => "Bangladesh",
        "BB" => "Barbados",
        "BY" => "Belarus",
        "BE" => "Belgium",
        "BZ" => "Belize",
        "BJ" => "Benin",
        "BM" => "Bermuda",
        "BT" => "Bhutan",
        "BO" => "Bolivia",
        "BA" => "Bosnia and Herzegovina",
        "BW" => "Botswana",
        "BV" => "Bouvet Island",
        "BR" => "Brazil",
        "BQ" => "British Antarctic Territory",
        "IO" => "British Indian Ocean Territory",
        "VG" => "British Virgin Islands",
        "BN" => "Brunei",
        "BG" => "Bulgaria",
        "BF" => "Burkina Faso",
        "BI" => "Burundi",
        "KH" => "Cambodia",
        "CM" => "Cameroon",
        "CA" => "Canada",
        "CT" => "Canton and Enderbury Islands",
        "CV" => "Cape Verde",
        "KY" => "Cayman Islands",
        "CF" => "Central African Republic",
        "TD" => "Chad",
        "CL" => "Chile",
        "CN" => "China",
        "CX" => "Christmas Island",
        "CC" => "Cocos [Keeling] Islands",
        "CO" => "Colombia",
        "KM" => "Comoros",
        "CG" => "Congo - Brazzaville",
        "CD" => "Congo - Kinshasa",
        "CK" => "Cook Islands",
        "CR" => "Costa Rica",
        "HR" => "Croatia",
        "CU" => "Cuba",
        "CY" => "Cyprus",
        "CZ" => "Czech Republic",
        "CI" => "Côte d’Ivoire",
        "DK" => "Denmark",
        "DJ" => "Djibouti",
        "DM" => "Dominica",
        "DO" => "Dominican Republic",
        "NQ" => "Dronning Maud Land",
        "DD" => "East Germany",
        "EC" => "Ecuador",
        "EG" => "Egypt",
        "SV" => "El Salvador",
        "GQ" => "Equatorial Guinea",
        "ER" => "Eritrea",
        "EE" => "Estonia",
        "ET" => "Ethiopia",
        "FK" => "Falkland Islands",
        "FO" => "Faroe Islands",
        "FJ" => "Fiji",
        "FI" => "Finland",
        "FR" => "France",
        "GF" => "French Guiana",
        "PF" => "French Polynesia",
        "TF" => "French Southern Territories",
        "FQ" => "French Southern and Antarctic Territories",
        "GA" => "Gabon",
        "GM" => "Gambia",
        "GE" => "Georgia",
        "DE" => "Germany",
        "GH" => "Ghana",
        "GI" => "Gibraltar",
        "GR" => "Greece",
        "GL" => "Greenland",
        "GD" => "Grenada",
        "GP" => "Guadeloupe",
        "GU" => "Guam",
        "GT" => "Guatemala",
        "GG" => "Guernsey",
        "GN" => "Guinea",
        "GW" => "Guinea-Bissau",
        "GY" => "Guyana",
        "HT" => "Haiti",
        "HM" => "Heard Island and McDonald Islands",
        "HN" => "Honduras",
        "HK" => "Hong Kong SAR China",
        "HU" => "Hungary",
        "IS" => "Iceland",
        "IN" => "India",
        "ID" => "Indonesia",
        "IR" => "Iran",
        "IQ" => "Iraq",
        "IE" => "Ireland",
        "IM" => "Isle of Man",
        "IL" => "Israel",
        "IT" => "Italy",
        "JM" => "Jamaica",
        "JP" => "Japan",
        "JE" => "Jersey",
        "JT" => "Johnston Island",
        "JO" => "Jordan",
        "KZ" => "Kazakhstan",
        "KE" => "Kenya",
        "KI" => "Kiribati",
        "KW" => "Kuwait",
        "KG" => "Kyrgyzstan",
        "LA" => "Laos",
        "LV" => "Latvia",
        "LB" => "Lebanon",
        "LS" => "Lesotho",
        "LR" => "Liberia",
        "LY" => "Libya",
        "LI" => "Liechtenstein",
        "LT" => "Lithuania",
        "LU" => "Luxembourg",
        "MO" => "Macau SAR China",
        "MK" => "Macedonia",
        "MG" => "Madagascar",
        "MW" => "Malawi",
        "MY" => "Malaysia",
        "MV" => "Maldives",
        "ML" => "Mali",
        "MT" => "Malta",
        "MH" => "Marshall Islands",
        "MQ" => "Martinique",
        "MR" => "Mauritania",
        "MU" => "Mauritius",
        "YT" => "Mayotte",
        "FX" => "Metropolitan France",
        "MX" => "Mexico",
        "FM" => "Micronesia",
        "MI" => "Midway Islands",
        "MD" => "Moldova",
        "MC" => "Monaco",
        "MN" => "Mongolia",
        "ME" => "Montenegro",
        "MS" => "Montserrat",
        "MA" => "Morocco",
        "MZ" => "Mozambique",
        "MM" => "Myanmar [Burma]",
        "NA" => "Namibia",
        "NR" => "Nauru",
        "NP" => "Nepal",
        "NL" => "Netherlands",
        "AN" => "Netherlands Antilles",
        "NT" => "Neutral Zone",
        "NC" => "New Caledonia",
        "NZ" => "New Zealand",
        "NI" => "Nicaragua",
        "NE" => "Niger",
        "NG" => "Nigeria",
        "NU" => "Niue",
        "NF" => "Norfolk Island",
        "KP" => "North Korea",
        "VD" => "North Vietnam",
        "MP" => "Northern Mariana Islands",
        "NO" => "Norway",
        "OM" => "Oman",
        "PC" => "Pacific Islands Trust Territory",
        "PK" => "Pakistan",
        "PW" => "Palau",
        "PS" => "Palestinian Territories",
        "PA" => "Panama",
        "PZ" => "Panama Canal Zone",
        "PG" => "Papua New Guinea",
        "PY" => "Paraguay",
        "YD" => "People's Democratic Republic of Yemen",
        "PE" => "Peru",
        "PH" => "Philippines",
        "PN" => "Pitcairn Islands",
        "PL" => "Poland",
        "PT" => "Portugal",
        "PR" => "Puerto Rico",
        "QA" => "Qatar",
        "RO" => "Romania",
        "RU" => "Russia",
        "RW" => "Rwanda",
        "RE" => "Réunion",
        "BL" => "Saint Barthélemy",
        "SH" => "Saint Helena",
        "KN" => "Saint Kitts and Nevis",
        "LC" => "Saint Lucia",
        "MF" => "Saint Martin",
        "PM" => "Saint Pierre and Miquelon",
        "VC" => "Saint Vincent and the Grenadines",
        "WS" => "Samoa",
        "SM" => "San Marino",
        "SA" => "Saudi Arabia",
        "SN" => "Senegal",
        "RS" => "Serbia",
        "CS" => "Serbia and Montenegro",
        "SC" => "Seychelles",
        "SL" => "Sierra Leone",
        "SG" => "Singapore",
        "SK" => "Slovakia",
        "SI" => "Slovenia",
        "SB" => "Solomon Islands",
        "SO" => "Somalia",
        "ZA" => "South Africa",
        "GS" => "South Georgia and the South Sandwich Islands",
        "KR" => "South Korea",
        "ES" => "Spain",
        "LK" => "Sri Lanka",
        "SD" => "Sudan",
        "SR" => "Suriname",
        "SJ" => "Svalbard and Jan Mayen",
        "SZ" => "Swaziland",
        "SE" => "Sweden",
        "CH" => "Switzerland",
        "SY" => "Syria",
        "ST" => "São Tomé and Príncipe",
        "TW" => "Taiwan",
        "TJ" => "Tajikistan",
        "TZ" => "Tanzania",
        "TH" => "Thailand",
        "TL" => "Timor-Leste",
        "TG" => "Togo",
        "TK" => "Tokelau",
        "TO" => "Tonga",
        "TT" => "Trinidad and Tobago",
        "TN" => "Tunisia",
        "TR" => "Turkey",
        "TM" => "Turkmenistan",
        "TC" => "Turks and Caicos Islands",
        "TV" => "Tuvalu",
        "UM" => "U.S. Minor Outlying Islands",
        "PU" => "U.S. Miscellaneous Pacific Islands",
        "VI" => "U.S. Virgin Islands",
        "UG" => "Uganda",
        "UA" => "Ukraine",
        "SU" => "Union of Soviet Socialist Republics",
        "AE" => "United Arab Emirates",
        "GB" => "United Kingdom",
        "US" => "United States",
        "ZZ" => "Unknown or Invalid Region",
        "UY" => "Uruguay",
        "UZ" => "Uzbekistan",
        "VU" => "Vanuatu",
        "VA" => "Vatican City",
        "VE" => "Venezuela",
        "VN" => "Vietnam",
        "WK" => "Wake Island",
        "WF" => "Wallis and Futuna",
        "EH" => "Western Sahara",
        "YE" => "Yemen",
        "ZM" => "Zambia",
        "ZW" => "Zimbabwe",
        "AX" => "Åland Islands",
        );
?>
<div class="card custom-card">
    <div class="niks-row">
        <div class="custom-sec-head customize-sec ">
            <h4>Personal Information</h4>
            <a href="javascript:void(0)" id="updateinfo" type="edit"><i class="fa-solid fa-pen"></i></a>
        </div>
        <div class="col-md-7" id="userdetails">
            <div class="d-flex">
                <h6>Name:</h6>
                <p> {{ auth()->user()->first_name ?? '' }} {{ auth()->user()->last_name ?? '' }}</p>
            </div>
            <div class="d-flex">
                <h6>Email:</h6>
                <p> {{ auth()->user()->email ?? '' }}</p>
            </div>
        </div>
        <div class="col-md-12" id="updateuserdetails" style="display: none;">
            <form action="{{url('user-dashboard/updatePersonalInfo')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="f_name" id="f_name" value="{{ auth()->user()->first_name ?? '' }}"
                        placeholder="First name" class="form-control">
                    @error('f_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="l_name" id="l_name" value="{{ auth()->user()->last_name ?? '' }}"
                        placeholder="Last name" class="form-control">
                    @error('f_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="{{ auth()->user()->email ?? '' }}"
                        placeholder="Email" class="form-control">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="chng-butn">
                    <button type="submit" class="btn cta">Update </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="card custom-card">
    <div class="customize-sec">
        <div class="left-box-niks">
            <div class="contact-info">
                <div class="form-group">
                    <div class="custom-sec-head">
                        <h4>Contact Information</h4>
                        <a href="javascript:void(0)" id="updatecontact" type="edit"><i class="fa-solid fa-pen"></i></a>
                    </div>
                    <div class="">
                        <form action="{{url('user-dashboard/updateUserConfiguration')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->first_name ?? '' }}"
                                    class="form-control  contact-input-form" name="first_name" id="first_name"
                                    placeholder="First name" readonly>
                                @error('first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->last_name ?? '' }}"
                                    class="form-control contact-input-form" name="last_name" id="last_name"
                                    placeholder="Last name" readonly>
                                @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->organization ?? '' }}"
                                    class="form-control contact-input-form" name="organization" id="organization"
                                    placeholder="Organization(optional)" readonly>
                                @error('organization')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->address ?? '' }}"
                                    class="form-control contact-input-form" name="address" id="address"
                                    placeholder="Street Address 1" readonly>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->additional_address ?? '' }}"
                                    class="form-control contact-input-form" name="additional_address"
                                    id="additional_address" placeholder="Street Address 2" readonly>
                                @error('additional_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->zip_code ?? '' }}"
                                    class="form-control contact-input-form" name="zip_code" id="zip_code"
                                    placeholder="ZIP/Postal code" readonly>
                                @error('zip_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->city ?? '' }}"
                                    class="form-control contact-input-form" name="city" id="city" placeholder="City"
                                    readonly>
                                @error('city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->state ?? '' }}"
                                    class="form-control contact-input-form contact-input-form" name="state" id="state"
                                    placeholder="State/Province/Region" readonly>
                                @error('state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="country" id="country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option @if(isset($userIPDetails['countryCode'])) @if($userIPDetails['countryCode']==$k)
                                        selected @endif @endif value="{{$k}}">{{
                                        $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="chng-butn" id="updateContactInfoBtn" style="display:none;">
                                <button type="submit" class="btn cta">Update Contact Information</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- start -->
            <div class="contact-info">
                <div class="form-group">
                    <div class="custom-sec-head">
                        <h4>Billing Address</h4>
                        <a href="javascript:void(0)" id="updatebillingaddress" type="edit"><i
                                class="fa-solid fa-pen"></i></a>
                    </div>
                    <div class="">
                        <form action="{{url('user-dashboard/updateUserBillingAddress')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->first_name ?? '' }}"
                                    class="form-control  address-input-form" name="address_first_name" id="address_first_name"
                                    placeholder="First name" readonly>
                                @error('address_first_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->last_name ?? '' }}"
                                    class="form-control address-input-form" name="address_last_name" id="last_name"
                                    placeholder="Last name" readonly>
                                @error('address_last_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->organization ?? '' }}"
                                    class="form-control address-input-form" name="address_organization" id="organization"
                                    placeholder="Organization(optional)" readonly>
                                @error('address_organization')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->address_1 ?? '' }}"
                                    class="form-control address-input-form" name="address_1" id="address"
                                    placeholder="Street Address 1" readonly>
                                @error('address_1')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->address_2 ?? '' }}"
                                    class="form-control address-input-form" name="address_2"
                                    id="additional_address" placeholder="Street Address 2" readonly>
                                @error('address_2')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->zip_code ?? '' }}"
                                    class="form-control address-input-form " name="address_zip_code" id="zip_code"
                                    placeholder="ZIP/Postal code" readonly>
                                @error('address_zip_code')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->city ?? '' }}"
                                    class="form-control address-input-form" name="address_city" id="city" placeholder="City"
                                    readonly>
                                @error('address_city')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->state ?? '' }}"
                                    class="form-control address-input-form " name="address_state" id="state"
                                    placeholder="State/Province/Region" readonly>
                                @error('address_state')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" value="{{ auth()->user()->billingaddress->tax_id ?? '' }}"
                                    class="form-control address-input-form " name="tax_id" id="tax_id" placeholder="Tax ID"
                                    readonly>
                                @error('tax_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <select name="country" id="country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option @if(isset($userIPDetails['countryCode'])) @if($userIPDetails['countryCode']==$k)
                                        selected @endif @endif value="{{$k}}">{{
                                        $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="chng-butn" id="updatebillingAddressBtn" style="display:none;">
                                <button type="submit" class="btn cta">Update billing address</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-sec">
            <div class="paymentInfo">
                <div class="custom-sec-head">
                    <h4>Payment Detail</h4>
                    <a href="javascript:void(0)" id="updatePaymentInfo" type="edit"><i class="fa-solid fa-pen"></i></a>
                </div>
                <div class="save-payment-detail">
                    <div class="brand ">
                        <?php $cardImage = '';  ?>
                        @if($paymentMethodDetailArr['brand'] == 'visa')
                        <?php 
                            $cardImage =  asset('logomax-front-asset/img/card-images/'.$paymentMethodDetailArr['brand'].'.svg') ;
                        ?>
                        @endif
                        @if($paymentMethodDetailArr['brand'] == 'mastercard')
                        <?php 
                            $cardImage =  asset('logomax-front-asset/img/card-images/'.$paymentMethodDetailArr['brand'].'.svg') ;
                        ?>
                        @endif
                        @if($paymentMethodDetailArr['brand'] == 'amex')
                        <?php 
                            $cardImage =  asset('logomax-front-asset/img/card-images/'.$paymentMethodDetailArr['brand'].'.svg') ;
                        ?>
                        @endif

                        <div><img src="{{ $cardImage }}" alt=""> {{ $paymentMethodDetailArr['brand'] }} <span> {{
                                $paymentMethodDetailArr['last4'] }} </span></div>
                    </div>
                    <div class="expireOn ">
                        {{ $paymentMethodDetailArr['exp_month'].'/'.$paymentMethodDetailArr['exp_year'] }}
                    </div>
                </div>

                <div class="update-payment-info " style="display:none;">
                    <form action="{{ url('user-dashboard/updateSubscriptionPaymentMethod') }}" id="progress-form"
                        method="POST">
                        @csrf
                        <div class="card_detail">
                            <div class=''>
                                <div class='form-group'>
                                    <label class='control-label'>{{ __('file.name_on_card') }}</label>
                                    <input class='form-control' id="name_on_card" name="name_on_card"
                                        placeholder="{{ __('file.name_on_card') }}" type='text'>
                                </div>
                            </div>
                            <div class="card-box">
                                <label class='control-label' for="card-elements">Enter your card</label>
                                <!-- ################### Show Card ######################### -->
                                <div id="card-elements"></div>
                                <!-- ################### ######### ######################### -->
                            </div>
                            <div id="card-error-message" class="text text-danger"></div>
                        </div>
                        <button type="button" class="formSubmitBtn continue_btn btn cta" id="card-button"
                            data-secret="{{ $intent->client_secret }}">Update card</button>
                    </form>
                </div>
            </div>
            <!--  Password change section  -->
            <div class="password-change-sec">
                <div class="custom-sec-head">
                    <h4>Change Password </h4>
                    <a href="javascript:void(0)" id="editPassword" type="edit"><i class="fa-solid fa-pen"></i></a>
                </div>

                <div class="updatePassForm" style="display:none">
                    <form class="confirm-p" method="post" action="{{ url('user-dashboard/changePassword') }}">
                        @csrf
                        <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="old_password"
                                placeholder="Old Password">
                            @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password"
                                placeholder="New Password">
                            @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password_confirmation">Confirm Password</label>
                            <input type="password" name="new_password_confirmation" class="form-control"
                                id="new_password_confirmation" placeholder="Confirm Password">
                            @error('new_password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="chng-butn">
                            <button type="submit" class="btn cta">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>

    const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-elements');

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
        if (error) {
            cardBtn.disable = false
            if (error.message != '') {
                $("#card-error-message").html(error.message);
            }
        } else {
            let token = document.createElement('input')
            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', setupIntent.payment_method)

            let payment_gateway = document.createElement('input')
            payment_gateway.setAttribute('type', 'hidden')
            payment_gateway.setAttribute('name', 'payment_gateway')
            payment_gateway.setAttribute('value', 'stripe')

            form.appendChild(token)
            form.appendChild(payment_gateway)

            form.submit();
        }
    });
</script>
<script>
    $("#editPassword").on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('type') == 'edit') {
            $(".updatePassForm").show();
            $(this).attr('type', 'cancel');
            $(this).html('<i class="fa-solid fa-circle-xmark"></i>');
        } else {
            $(".updatePassForm").hide();
            $(this).attr('type', 'edit');
            $(this).html('<i class="fa-solid fa-pen"></i>');
        }
    });

    $("#updatePaymentInfo").on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('type') == 'edit') {
            $(".save-payment-detail").hide();
            $(".update-payment-info").show();
            $(this).attr('type', 'cancel');
            $(this).html('<i class="fa-solid fa-circle-xmark"></i>');
        } else {
            $(".save-payment-detail").show();
            $(".update-payment-info").hide();
            $(this).attr('type', 'edit');
            $(this).html('<i class="fa-solid fa-pen"></i>');
        }
    })

    $("#updateinfo").on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('type') == 'edit') {
            $("#userdetails").hide();
            $("#updateuserdetails").show();
            $(this).attr('type', 'cancel');
            $(this).html('<i class="fa-solid fa-circle-xmark"></i>');
        } else {
            $("#userdetails").show();
            $("#updateuserdetails").hide();
            $(this).attr('type', 'edit');
            $(this).html('<i class="fa-solid fa-pen"></i>');
        }
    })

    $("#updatecontact").on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('type') == 'edit') {
            $('.contact-input-form').removeAttr('readonly');
            $("#updateContactInfoBtn").show();
            $('#first_name').focus();
            $(this).attr('type', 'cancel');
            $(this).html('<i class="fa-solid fa-circle-xmark"></i>');
        } else {
            $("#updateContactInfoBtn").hide();
            $('.contact-input-form').attr('readonly', 'readonly');
            $(this).attr('type', 'edit');

            $(this).html('<i class="fa-solid fa-pen"></i>');
        }

    })

    $("#updatebillingaddress").on('click', function (e) {
        e.preventDefault();
        if ($(this).attr('type') == 'edit') {
            $('.address-input-form').removeAttr('readonly');
            $("#updatebillingAddressBtn").show();
            $('#address_first_name').focus();
            $(this).attr('type', 'cancel');
            $(this).html('<i class="fa-solid fa-circle-xmark"></i>');
        } else {
            $("#updatebillingAddressBtn").hide();
            $('.address-input-form').attr('readonly', 'readonly');
            $(this).attr('type', 'edit');

            $(this).html('<i class="fa-solid fa-pen"></i>');
        }

    })
</script>
@endsection
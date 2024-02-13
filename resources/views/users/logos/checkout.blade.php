@extends('user_layout/master')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<style>
    .add_btn {
        position: relative;
    }

    .add_btn input[type="checkbox"] {
        position: absolute;
        width: 0;
    }
    .img-box {
        background: #80808057;
    }
    .address-confirm-check {
        width: auto !important;
    }

    button.swal2-confirm.swal2-styled.swal2-default-outline {
        color: #000 !important;
        background: #fff !important;
        border-radius: 130px;
        border: 1px solid #000000;
        padding: 10px 26px;
    }

    button.swal2-cancel.swal2-styled.swal2-default-outline {
        color: #fff !important;
        background: #000 !important;
        border-radius: 130px;
        border: 1px solid #000000;
        padding: 10px 26px;
        }

    button.swal2-confirm.swal2-styled.swal2-default-outline:hover {
        background: #000 !important;
        color: #fff !important;
        transition: 0.5s;
    }

    button.swal2-cancel.swal2-styled.swal2-default-outline:hover {
        background: #fff !important;
        color: #000 !important;
        transition: 0.5s;
    }
    .swal_custom_class #swal2-title {
        color: #18181F !important;
    }
    .swal_custom_class #swal2-html-container{
        color: #18181F !important;
    }
</style>
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
<style>
    #backButton2:hover {
        color: white;
    }
    #backButton1:hover {
        color: white;
    }
    #updateChanges:hover {
        color: white;
    }
</style>
<?php 
$logo_wihtout_discount_price = round($price*$coversion_price);
if($logo->logo_type == 'low-price'){
    $logo_discount_price = round($logo_wihtout_discount_price * $active_discount->normal_logo_price/100);
    $discount_percentage = $active_discount->normal_logo_price;
  }else{
    $logo_discount_price = round($logo_wihtout_discount_price * $active_discount->premium_logo_price/100);
    $discount_percentage = $active_discount->normal_logo_price;
  }
$logo_real_price = $logo_wihtout_discount_price - $logo_discount_price;
?>

<section class="banner-sec checkout_banner" style="background-image: url('{{ asset('logomax-front-asset/img/check_banner.png') }}');">
    <div class="container-fluid"></div>
  </section>
  <section class="checkout_sec p-110">
    <div class="container">
        <form id="progress-form" action="{{ url('logo-checkout') }}" method="post">
            @csrf
            <input type="hidden" name="logo_id" value="{{ $logo->id }}"/>
            <div class="step_form_head" role="tablist">
                <div class="box_step">
                    <button id="progress-form__tab-1" style="outline:none" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true" disabled>
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 1 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
                            </span>
                        </div>
                        <p> {{ __('file.information_text') }} </p>
                    </button>
                </div>
                <div class="box_step">
                    <button id="progress-form__tab-2" style="outline:none;" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true" disabled>
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 2 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
                            </span>
                        </div>
                        <p> {{ __('file.payment_text') }} </p>
                    </button>
                </div>
                <div class="box_step border_last">
                    <button id="progress-form__tab-3" style="outline:none" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true" disabled>
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 3 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
                            </span>
                        </div>
                        <p> {{ __('file.confirmation_text') }} </p>
                    </button>
                </div>
            </div>
            
            <section id="progress-form__panel-1" class="data_wrapper one" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
                <div class="custom_step_form">
                    <div class="step_form">
                        <div class="step_form_content">
                            <h5>{{ __('file.contact_information_text') }}</h5>
                        </div>
                        <div class="text text-danger error-text"></div>
                        <!-- Email -->      
                        <div class="form__field form-row form__field ">
                            <div class="col-md-12 ">
                                <input id="email" type="text" class="input-box" name="email" value="{{ auth()->user()->email ?? ''; }}" placeholder="{{ __('file.plchldr_email_text') }}" <?php if(isset(auth()->user()->id)){ echo 'readonly'; }  ?>  />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="first_name" class="input-box" type="text" name="first_name" value="{{ auth()->user()->first_name ?? '' }}" placeholder="{{ __('file.plchldr_first_name') }}"  />
                            </div>
                            <div class="col-md-6">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="last_name" type="text" class="input-box" name="last_name" value="{{ auth()->user()->last_name ?? '' }}" placeholder="{{ __('file.plchldr_last_name') }}"   />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-12 ">
                                <label for="organization">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="organization" class="input-box" type="text" name="organization" value="{{ auth()->user()->organization ?? '' }}" placeholder="{{ __('file.plchldr_organization_text') }}"   />
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="address" type="text" class="input-box" name="address" value="{{ auth()->user()->address ?? '' }}" placeholder="{{ __('file.plchldr_street_address_1') }}" />
                            </div>
                        </div>
                        <!-- address line 1 -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="additional-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="additional-address" type="text" class="input-box" name="additional_address" value="{{ auth()->user()->additional_address ?? '' }}" placeholder="{{ __('file.plchldr_street_address_2') }}" />
                            </div>
                        </div>
                        
                        <!-- City and zip  -->
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="zip">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="zip" type="text" class="input-box" name="zip_code" value="{{ auth()->user()->zip_code ?? '' }}" placeholder="{{ __('file.plchldr_zip_text') }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="city-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="city-address" class="input-box" type="text" name="city" value="{{ auth()->user()->city ?? '' }}" placeholder="{{ __('file.plchldr_city_text') }}"/>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="state-address">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="state" type="text" class="input-box" name="state" value="{{ auth()->user()->state ?? '' }}" placeholder="{{ __('file.plchldr_state_province_text') }}" />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0" >
                            <div class="col-md-12 ">
                                <label for="country">
                                <span  aria-hidden="true"></span>
                                </label>
                                <select name="country"  id="country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option @if(isset($userIPDetails['countryCode'])) @if($userIPDetails['countryCode'] == $k) selected  @endif @endif value="{{$k}}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row form__field mt-4 sm:mt-0" >
                            <div class="col-md-12 ">
                                <label for="">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input type="checkbox" class="address-confirm-check" id="address-confirm" name="billing_address_confirm" checked>
                                <label for="address-confirm" class="address-confirm-label" >{{ __('file.use_contact_address_as_billing_address_text') }}</label>
                            </div>
                        </div>
                    <div id="billing-address" style="display:none;">
                            <h5>{{ __('file.billing_address_text') }}</h5>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_first_name" class="input-box" type="text" name="billing_first_name" value="{{ auth()->user()->billingaddress->first_name ?? '' }}" placeholder="{{ __('file.plchldr_first_name') }}"   />
                            </div>
                            <div class="col-md-6">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_last_name" type="text" class="input-box" name="billing_last_name" value="{{ auth()->user()->billingaddress->last_name ?? '' }}" placeholder="{{ __('file.plchldr_last_name') }}"   />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-12 ">
                                <label for="organization">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_organization" class="input-box" type="text" name="billing_organization" value="{{  auth()->user()->billingaddress->organization ?? '' }}" placeholder="{{ __('file.plchldr_organization_text') }}"   />
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_address" type="text" class="input-box" name="billing_address" value="{{ auth()->user()->billingaddress->address_1 ?? '' }}" placeholder="{{ __('file.plchldr_street_address_1') }}" />
                            </div>
                        </div>
                        <!-- address line 1 -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="additional-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_additional_address" type="text" class="input-box" name="billing_additional_address" value="{{ auth()->user()->billingaddress->address_2 ?? '' }}" placeholder="{{ __('file.plchldr_street_address_2') }}" />
                            </div>
                        </div>
                        
                        <!-- City and zip  -->
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="zip">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_zip_code" type="text" class="input-box" name="billing_zip_code" value="{{ auth()->user()->billingaddress->zip_code ?? '' }}" placeholder="{{ __('file.plchldr_zip_text') }}" />
                            </div>
                            <div class="col-md-6">
                                <label for="city-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_city" class="input-box" type="text" name="billing_city" value="{{ auth()->user()->billingaddress->city ?? '' }}" placeholder="{{ __('file.plchldr_city_text') }}"/>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="state-address">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_state" type="text" class="input-box" name="billing_state" value="{{ auth()->user()->billingaddress->state ?? '' }}" placeholder="{{ __('file.plchldr_state_province_text') }}" />
                            </div>
                        </div>
                        
                        <div class="form-row form__field mt-3 sm:mt-0" >
                            <div class="col-md-12 ">
                                <label for="billing_country">
                                    <span aria-hidden="true"></span>
                                </label>
                                <select name="billing_country"  id="billing_country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option value="{{$k}}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="taxid">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="taxid" type="text" class="input-box" name="taxid" value="{{ auth()->user()->billingaddress->tax_id ?? '' }}" placeholder="{{ __('file.plchldr_tax_ID') }}" />
                            </div>
                        </div>
                    </div>

                        <!--  -->
                        <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <div class="chk_btn add_btn">
                                <a href="{{ url(app()->getLocale().'/logo/'.$logo->logo_slug) }}" type="button" class="check-back-btn" id="backButton0"  >{{ __('file.back_text') }}</a>
                                <button type="button" data-action="next" class="continue_btn" id="add_billing_address">
                                    {{ __('file.continue_text') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Checkout sumary  -->
                    <div class="checkout_summary">
                        <h5>{{ __('file.order_summary_text') }}</h5>
                        <div class="templete_wrapper">
                        
                            <div class="summary_wrapp">
                                <div class="img">
                                    <!-- <p><br></p> -->
                                    <div class="img-box">
                                    @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                    <img src="{{ asset('LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.png') }}" alt="">
                                    @else
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    @endif
                                    </div>
                                </div>
                                <div class="img-text-list">
                                    <p><strong>{{ __('file.logo_text') }} </strong><br>{{ __('file.id_text') }}: {{ $logo->logo_unique_id ?? '' }}</p>
                                    <ul>
                                        <li>{{ __('file.exclusive_license_text') }}</li>
                                        <li>{{ __('file.customization_text') }}</li>
                                        <li>{{ __('file.immediate_use_text') }}</li>
                                    </ul>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                <!-- <p><br></p> -->
                                <?php 
                          $logo_real_price_with_format = Akaunting\Money\Money::$currency($logo_real_price,true);
                          $decimal_value = $logo_real_price_with_format->getCurrency()->getDecimalMark().'00';

                          ?>
                                    <span class="text text-dark"><b>{{ str_replace($decimal_value,"",$logo_real_price_with_format) ?? 0 }}</b></span>
                                   
                                </div>
                            </div>
                            <div class="additional_content mt-3">
                            <!-- <h6>Additional options:</h6> -->
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::orderBy('created_at','desc')->get();
                            ?>
                            <?php
                                $gst_prcnt = 12;
                              
                            ?>
                            @foreach($additional_options as $option)
                                <?php 
                                    if($option->option_type == 'taxes'){
                                        $gst_prcnt = $option->percentage;
                                    }
                                ?>
                                @if($option->option_type == 'save-logo-for-future')
                                <div class = "add_para"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.protect_logo_from_loss_text') }}<br>
                               
                                </small>
                            </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="save-logo-for-future-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                         <?php 
                                         $pricing_amount_decimal = round($option->amount*$coversion_price);
                                          $pricing_duration_amount = Akaunting\Money\Money::$currency($pricing_amount_decimal,true);  ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>1 month FREE</b></span><br>
                                        <span style="font-size:14px;">then {{ str_replace($decimal_value,"",$pricing_duration_amount) }}/{{ __('file.month_text') }}</span>
                                        @else
                                        <span><b>{{ str_replace($decimal_value,"",$pricing_duration_amount) }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class = "add_para mt-3"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.receive_favicon_of_logo_text') }}<br>
                                </small>
                                </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                     
                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="get-favicon-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                    <?php 
                                    $option_amount_round = round($option->amount*$coversion_price);
                                     $pricing_favicon_amount = Akaunting\Money\Money::$currency($option_amount_round,true);  ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span ><b>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}/{{ __('file.month_text') }}</b></span>
                                        @else
                                        <span>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo_real_price;
                            
                                
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ round($logo_price) }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data ">
                            
                            
                            <!-- Selected additional options value are here  -->
                            <div class="subtotal-top-border additional_service_line"  style="display:none;"></div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                           
                            <!-- Subtotal  -->
                            <!-- <div class="total_data subtotal-box">
                                <p>{{ __('file.subtotal_text') }}</p>
                                <p>{{ $logo_real_price_with_format ?? 0 }}</p>
                            </div> -->
                            <!-- Tax -->
                            <?php 
                          $gst_cut_amount_with_format  = Akaunting\Money\Money::$currency($gst_cut,true);
                          ?>
                        @if($gst_prcnt != 0)
                            <div class="total_data">
                                <p>{{ __('file.vat_text') }} ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">{{ $gst_cut_amount_with_format }}</p>
                            </div>
                        @endif
                            <!-- END -->
                            <?php 
                          $total_amount_with_format  = Akaunting\Money\Money::$currency($total_price,true);
                          ?>
                            <div class="total_data num total_price_box subtotal-top-border" >
                                <p><b>{{ __('file.total_text') }}</b></p>
                                <p><b>{{ str_replace($decimal_value,"",$total_amount_with_format) }}</b></p>
                            </div>
                            <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- Checkout summary End -->
                </div>
            </section>
            <section id="progress-form__panel-2" class="data_wrapper one" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
                <div class="custom_step_form">
                    <div class="step_form">
                    <h5>{{ __('file.payment_method_text') }}</h5>
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
                               <div id="card-elements"></div> -->
                               
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
                                <div id="card-errors" class="text text-danger"></div>
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
                    <div class="chk_btn add_btn mt-4">
                        <a type="button" class="check-back-btn " id="backButton1" >{{ __('file.back_text') }}</a>
                        <button type="button" data-action="next" class="continue_btn " id="payment_section_btn">
                        {{ __('file.continue_text') }}
                        </button>
                    </div>
                    </div>
                    <!-- Checkout sumary  -->
                    <div class="checkout_summary">
                        <h5>{{ __('file.order_summary_text') }}</h5>
                        <div class="templete_wrapper">
                            <div class="summary_wrapp">
                                <div class="img">
                                    <div class="img-box">
                                    @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                    <img src="{{ asset('LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.png') }}" alt="">
                                    @else
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    @endif
                                    </div>
                                </div>
                                <div class="img-text-list">
                                    <p><strong>{{ __('file.logo_text') }} </strong><br>{{ __('file.id_text') }}: {{ $logo->logo_unique_id ?? '' }}</p>
                                    <ul>
                                        <li>{{ __('file.exclusive_license_text') }}</li>
                                        <li>{{ __('file.customization_text') }}</li>
                                        <li>{{ __('file.immediate_use_text') }}</li>
                                    </ul>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                <?php 
                          $logo_real_price_with_format = Akaunting\Money\Money::$currency($logo_real_price,true);
                          ?>
                                    <span class="text text-dark"><b>{{ str_replace($decimal_value,"",$logo_real_price_with_format) ?? 0 }}</b></span>
                                   
                                </div>
                            </div>
                            <div class="additional_content mt-3">
                            <!-- <h6>Additional options:</h6> -->
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::orderBy('created_at','desc')->get();
                            ?>
                            <?php
                                $gst_prcnt = 12;
                              
                            ?>
                            @foreach($additional_options as $option)
                                <?php 
                                    if($option->option_type == 'taxes'){
                                        $gst_prcnt = $option->percentage;
                                    }
                                ?>
                                @if($option->option_type == 'save-logo-for-future')
                                <div class = "add_para"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.protect_logo_from_loss_text') }}<br>
                               
                                </small>
                            </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="save-logo-for-future-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                         <?php $pricing_amount_decimal = round($option->amount*$coversion_price);
                                          $pricing_duration_amount = Akaunting\Money\Money::$currency($pricing_amount_decimal,true);  ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>1 month FREE</b></span><br>
                                        <span style="font-size:14px;">then {{ str_replace($decimal_value,"",$pricing_duration_amount) }}/{{ __('file.month_text') }}</span>
                                        @else
                                        <span><b>{{ str_replace($decimal_value,"",$pricing_duration_amount) }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class = "add_para mt-3"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.receive_favicon_of_logo_text') }}<br>
                                </small>
                                </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                     
                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="get-favicon-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                    <?php 
                                    $option_amount_round = round($option->amount*$coversion_price);
                                    $pricing_favicon_amount = Akaunting\Money\Money::$currency($option_amount_round,true); 
                                    ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}/{{ __('file.month_text') }}</b></span>
                                        @else
                                        <span>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo_real_price;
                            
                                
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ round($logo_price) }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data ">
                            
                            
                            <!-- Selected additional options value are here  -->
                            <div class="subtotal-top-border additional_service_line" style="display:none;"></div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                            <!-- Subtotal  -->
                            <!-- <div class="total_data subtotal-box">
                                <p>{{ __('file.subtotal_text') }}</p>
                                <p>{{ $logo_real_price_with_format ?? 0 }}</p>
                            </div> -->
                            <!-- Tax -->
                            <?php 
                          $gst_cut_amount_with_format  = Akaunting\Money\Money::$currency($gst_cut,true);
                          ?>
                        @if($gst_prcnt != 0)
                            <div class="total_data">
                                <p>{{ __('file.vat_text') }} ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">{{ $gst_cut_amount_with_format }}</p>
                            </div>
                        @endif
                            <!-- END -->
                            <?php 
                          $total_amount_with_format  = Akaunting\Money\Money::$currency($total_price,true);
                          ?>
                            <div class="total_data num total_price_box subtotal-top-border" >
                                <p><b>{{ __('file.total_text') }}</b></p>
                                <p><b>{{ str_replace($decimal_value,"",$total_amount_with_format) }}</b></p>
                            </div>
                            <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- Checkout summary End -->
                </div>
            </section>
            <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
                <div class="custom_step_form">
                    <div class="billing_address step_form">
                    <h5>{{ __('file.order_confirmation') }}</h5>
                    <div class="billing_content">
                        <div class="billing_wrapper">
                        <div class="billing_text " id="billing_address_box">
                            <!-- <h6>Billing Address</h6>
                            <p>80191 Blaise Street Apt. 110 Boganland, Arkansas USA 893804</p> -->
                        </div>
                         <div class="bill-icon">
                            <i id="editAddress" class="fa-solid fa-pen"></i>
                        </div> 

                    </div>

                        <div class="billing_wrapper">
                        <div class="billing_text" id="payment_method_box">
                            <h6>{{ __('file.payment_method_text') }}</h6>
                            <div class="img_visa">
                                <p id="nopaymethod">{{-- __('file.no_payment_method_selected_text') --}}</p>
                                <img id="cardImage" src='' style="display: none"  />
                            </div>
                        </div>
                        <div class="bill-icon">
                            <i id="editPayment" class="fa-solid fa-pen"></i>
                        </div> 
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                        <div class="text text-danger mt-2" id="card-error-message"></div>

                            <div class="form-row form__field mt-3 sm:mt-0" >
                            <div class="col-md-12 ">
                                <label for="">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input type="checkbox" class="address-confirm-check" id="term-conditions" name="term_conditions">
                                <label for="term-conditions" class="address-confirm-label" >  {{ __('file.order_confirmation_text') }} <a href="{{ url(app()->getlocale().'/legal/terms-and-conditions/') }}" target=”_blank”><u>{{ __('file.terms_and_conditions_text') }}</u></a></label>
                            </div>
                        </div>
                        <div class="checkout_btn  add_btn mt-4">
                            <!-- <a href="logo-download-page.html" class="continue_btn">
                            Continue & Download
                            </a> -->

                            <a  id="backButton2"  class="check-back-btn" >{{ __('file.back_text') }}</a>
                            <button type="button" class="formSubmitBtn continue_btn " style="display:none;" id="paypal-button" data-secret="" >{{ __('file.continue_and_download_text') }}</button>
                            <button type="button" class="formSubmitBtn continue_btn " style="display:none;" id="card-button" data-secret="{{ $intent->client_secret }}" >{{ __('file.continue_and_download_text') }}</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <!-- Checkout sumary  -->
                    <div class="checkout_summary">
                        <h5>{{ __('file.order_summary_text') }}</h5>
                        <div class="templete_wrapper">
                            <div class="summary_wrapp">
                                <div class="img">
                                    <div class="img-box">
                                    @if($logo->media->directory_name != null || $logo->media->directory_name != "")
                                    <img src="{{ asset('LogoDirectory/'.$logo->media->directory_name.'/'.$logo->media->directory_name.'.png') }}" alt="">
                                    @else
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    @endif
                                    </div>
                                </div>
                                <div class="img-text-list">
                                    <p><strong>{{ __('file.logo_text') }} </strong><br><span>{{ __('file.id_text') }}: {{ $logo->logo_unique_id ?? '' }}</span></p>
                                    <ul>
                                        <li>{{ __('file.exclusive_license_text') }}</li>
                                        <li>{{ __('file.customization_text') }}</li>
                                        <li>{{ __('file.immediate_use_text') }}</li>
                                    </ul>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                <?php 
                          $logo_real_price_with_format = Akaunting\Money\Money::$currency($logo_real_price,true);
                          ?>
                                    <span class="text text-dark"><b>{{ str_replace($decimal_value,"",$logo_real_price_with_format) ?? 0 }}</b></span>
                                   
                                </div>
                            </div>
                            <div class="additional_content mt-3">
                            <!-- <h6>Additional options:</h6> -->
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::orderBy('created_at','desc')->get();
                            
                            ?>
                            
                            <?php
                                $gst_prcnt = 12;
                              
                            ?>
                            @foreach($additional_options as $option)
                                <?php 
                                    if($option->option_type == 'taxes'){
                                        $gst_prcnt = $option->percentage;
                                    }
                                ?>
                                @if($option->option_type == 'save-logo-for-future')
                                <div class = "add_para"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.protect_logo_from_loss_text') }}<br>
                               
                                </small>
                            </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="save-logo-for-future-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                         <?php $pricing_amount_decimal = round($option->amount*$coversion_price);
                                          $pricing_duration_amount = Akaunting\Money\Money::$currency($pricing_amount_decimal,true);  ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>1 month FREE</b></span><br>
                                        <span style="font-size:14px;">then {{ str_replace($decimal_value,"",$pricing_duration_amount) }}/{{ __('file.month_text') }}</span>
                                        @else
                                        <span><b>{{ str_replace($decimal_value,"",$pricing_duration_amount) }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class = "add_para mt-3"><p><strong>{{ $option->option_text }}</strong> ({{ __('file.optional_text') }})</p>
                                <small>{{ __('file.receive_favicon_of_logo_text') }}<br>
                                </small>
                                </div>
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                     
                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ round($option->amount*$coversion_price) }}" class="get-favicon-btn">{{ __('file.add_btn_text') }}</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ round($option->amount*$coversion_price) }}" />
                                    </div>
                                    <div class="save_data">
                                    <?php 
                                    $option_amount_round = round($option->amount*$coversion_price);
                                    $pricing_favicon_amount = Akaunting\Money\Money::$currency($option_amount_round,true); 
                                    ?>
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}/{{ __('file.month_text') }}</b></span>
                                        @else
                                        <span>{{ str_replace($decimal_value,"",$pricing_favicon_amount) }}</span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo_real_price;
                            
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ round($logo_price) }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data ">
                            
                            
                            <!-- Selected additional options value are here  -->
                            <div class="subtotal-top-border additional_service_line" style="display:none;"></div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                            <!-- Subtotal  -->
                            <!-- <div class="total_data subtotal-box">
                                <p>{{ __('file.subtotal_text') }}</p>
                                <p>{{ $logo_real_price_with_format ?? 0 }}</p>
                            </div> -->
                            <!-- Tax -->
                            <?php 
                          $gst_cut_amount_with_format  = Akaunting\Money\Money::$currency($gst_cut,true);
                          ?>
                        @if($gst_prcnt != 0)
                            <div class="total_data">
                                <p>{{ __('file.vat_text') }} ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">{{ $gst_cut_amount_with_format }}</p>
                            </div>
                        @endif
                            <!-- END -->
                            <?php 
                          $total_amount_with_format  = Akaunting\Money\Money::$currency($total_price,true);
                          ?>
                            <div class="total_data num total_price_box subtotal-top-border" >
                                <p><b>{{ __('file.total_text') }}</b></p>
                                <p><b>{{ str_replace($decimal_value,"",$total_amount_with_format) }}</b></p>
                            </div>
                            <!--  -->
                            </div>
                        </div>
                    </div>
                    <!-- Checkout summary End -->
                </div>
            </section>
        </form>
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    let allcountries = <?php print_r(json_encode($countries)); ?>;
    console.log(allcountries['AF']);
    $("#add_billing_address").on('click',function(){
        let address = $("#address").val() ;    
        let email = $("#email").val();
        let organization = $('#organization').val();
        let additional_address = $('#additional-address').val();
        let city_address = $("#city-address").val();
        let country = $("#country").val();
        let state = $("#state").val() ; 
        let zip = $("#zip").val();
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        if($('input#address-confirm').prop('checked')){
         console.log('done');
        if(address == '' || address ==  undefined || email == "" || email == undefined || city_address == "" || city_address == undefined || country == "" || country == undefined || state == "" || state == undefined || zip == "" || zip == undefined || additional_address =="" || additional_address == undefined){
            $(".error-text").html('All fields are required');
        
            return false;
        
        }else{
            $("#billing_address_box").html(`<h6>{{ __('file.billing_address_text') }}</h6>
                    <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                    <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                    <p>{{ __('file.plchldr_organization_text') }}: ${organization}</p>
                    <p>{{ __('file.plchldr_street_address_1') }}: ${address}</p>
                    <p>{{ __('file.plchldr_street_address_2') }}: ${additional_address}</p>
                    <p>{{ __('file.plchldr_city_text') }}: ${city_address}</p>
                    <p>{{ __('file.plchldr_state_province_text') }}: ${state}</p>
                    <p>{{ __('file.plchldr_zip_text') }}: ${zip}</p>
                    <p>{{ __('file.plchldr_country_text') }}: ${allcountries[country]}</p>`);
        }
    }else{
        let billing_address = $("#billing_address").val() ;
        let billing_organization = $('#billing_organization').val();
        let billing_additional_address = $('#billing_additional_address').val();
        let billing_city = $("#billing_city").val();
        let billing_country = $("#billing_country").val();
        let billing_state = $("#billing_state").val() ; 
        let billing_zip_code = $("#billing_zip_code").val();
        let taxid = $('#taxid').val();
        if(taxid == '' || taxid ==  undefined || billing_zip_code == '' || billing_zip_code ==  undefined || billing_state == '' || billing_state ==  undefined || billing_country == '' || billing_country ==  undefined || billing_city == '' || billing_city ==  undefined || billing_additional_address == '' || billing_additional_address ==  undefined || billing_address == '' || billing_address ==  undefined || address == '' || address ==  undefined || email == "" || email == undefined || city_address == "" || city_address == undefined || country == "" || country == undefined || state == "" || state == undefined || zip == "" || zip == undefined || additional_address =="" || additional_address == undefined ){
        $(".error-text").html('All fields are required');
        return false;
        }else{
            $("#billing_address_box").html(`<h6>{{ __('file.billing_address_text') }}</h6>
                <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                <p>{{ __('file.plchldr_organization_text') }}: ${billing_organization}</p>
                <p>{{ __('file.plchldr_street_address_1') }}: ${billing_address}</p>
                <p>{{ __('file.plchldr_street_address_2') }}: ${billing_additional_address}</p>
                <p>{{ __('file.plchldr_city_text') }}: ${billing_city}</p>
                <p>{{ __('file.plchldr_state_province_text') }}: ${billing_state}</p>
                <p>{{ __('file.plchldr_zip_text') }}: ${billing_zip_code}</p>
                <p>{{ __('file.plchldr_country_text') }}: ${allcountries[billing_country]}</p>
                <p>{{ __('file.plchldr_tax_ID') }}: ${taxid}<p>`);
        }
    }
    });

    // Check validation data is filled or not .
    
    $("#payment_section_btn").on('click',function(e){
        e.preventDefault();
        if($("#cardPayment").hasClass('clicked')){
            let name_on_card = $("#name_on_card").val();
            $("#paypal-button").hide();
            $("#card-button").show();
            // let input_card = $("input['name=cardnumber']").val();
            if($("#card-number").hasClass('StripeElement--empty') || name_on_card == '' || name_on_card == undefined){
                $("#payment_form_error").html('All fields are required');
                $("#card-errors").html('');
                return false;
            }else{
                $("#payment_form_error").html('');
            }
            if($("#card-number").hasClass('StripeElement--invalid')){
                $("#card-errors").html('Your card number is wrong.');
                return false;
            }else{
                $("#card-errors").html('');
            }
        }else{
            $("#card-button").hide();
            $("#paypal-button").show();
        }
    });
  
</script>

<script >
    const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
    const elements= stripe.elements();
    // const cardElement= elements.create('card');
    // cardElement.mount('#card-elements');

    // :::::::::::::::: Mounting Cards ::::::::::::::::
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
        $('#cardImage').attr('src', `{{ asset('logomax-front-asset/img/card-images/paypal.png') }}`);
    })

    cardNumber.on('change', function (event) {
        // console.log('hello');
        const card = event.brand === 'Unknown' ? (event.complete ? event : null) : event;
     
        if (card) {
            // console.log('brand -> ' + brand)
            // console.log(card);
            let brand = card.brand;
            if(brand === 'unknown' || brand.length === 0 )
            {
                $('#cardImage').hide();
                $('#nopaymethod').show();          
            }
            else{
                $('#nopaymethod').hide();
                $('#cardImage').show();
                $('#cardImage').attr('src', `{{ asset('logomax-front-asset/img/card-images/') }}/${brand}.png`);
            }
        }
    }); 

    ///////////////////// STRIPE CARD PAYMENT BUTTON //////////////////////// 

    const stripeCardSubmitButton = document.querySelector('#card-button');
    stripeCardSubmitButton.addEventListener('click', async (e) => {
        if($('input[name="term_conditions"]').prop('checked') !== true){
            
            Swal.fire({
                title: 'Terms and conditions',
                text: "Please accept the terms and conditions to confirm this order.",
                confirmButtonText: "OK",
                confirmButtonColor: '#3085d6',
                // titleColor: '#ff0000',
                customClass: {
                    popup: 'swal_custom_class', // Add your custom class for additional styling
                },
            })
            return false;
        }
        
        
        const form = document.getElementById('progress-form');

        const cardBtn = document.getElementById('card-button');

        const cardHolderName = document.getElementById('name_on_card'); 
        e.preventDefault()
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
        // console.log(cardElement);
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

            // console.log(setupIntent.payment_method);
            let payment_gateway = document.createElement('input')
            payment_gateway.setAttribute('type','hidden')
            payment_gateway.setAttribute('name', 'payment_gateway')
            payment_gateway.setAttribute('value', 'stripe')

            form.appendChild(token)
            form.appendChild(payment_gateway)

            form.submit();
            // console.log(setupIntent);
        }
    });

    ////////////////////////// END  ////////////////////////////////////
   
    ///////////////////////// Paypal Payment Button ///////////////////
    const paypalSubmitButton = document.querySelector('#paypal-button');
    paypalSubmitButton.addEventListener('click', async (e) => {
        
        if($('input[name="term_conditions"]').prop('checked') !== true){
            Swal.fire({
                title: 'Terms and conditions',
                text: "Please accept the terms and conditions to confirm this order.",
                confirmButtonText: "OK",
                confirmButtonColor: '#3085d6',
                // titleColor: '#ff0000',
                customClass: {
                    popup: 'swal_custom_class', // Add your custom class for additional styling
                },
            })
            return false;
        }
        const form = document.getElementById('progress-form');
        let payment_gateway = document.createElement('input')
            payment_gateway.setAttribute('type','hidden')
            payment_gateway.setAttribute('name', 'payment_gateway')
            payment_gateway.setAttribute('value', 'paypal')
            form.appendChild(payment_gateway)

            form.submit();
        
        // window.location.href="{{ route('make.payment',['locale'=>app()->getLocale()]) }}"; // handlepayment rooute for paypal 

    });
    ////////////////////////  END  ///////////////////////////////////
    $(".save-logo-for-future-btn").on('click',function(e){
        // gst_cut_val
        e.preventDefault();
        let price = parseFloat($(this).attr('data-price'));
        let logo_price_for_customer = parseFloat("{{ $logo_real_price }}");
        let data_enabled = $(this).attr('data-enabled');
        let total_price = parseFloat(<?php echo $total_price; ?>);
        let gst_prcnt = parseFloat("{{ $gst_prcnt }}");
        let favicon_enabled_status = $(".get-favicon-btn").attr('data-enabled');
        let favicon_enabled_price = parseFloat($(".get-favicon-btn").attr('data-price'));
   
        if(data_enabled == 'false'){
            let new_total = 0;
            if(favicon_enabled_status == 'false'){
                prcnt_cut = ((logo_price_for_customer + price) *  gst_prcnt) / 100; 
                // console.log(logo_price_for_customer + '<- totoal price current-> '  +  price + 'gst_prcnt_cut ' + prcnt_cut );
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);
                // new_total = logo_price_for_customer + price + prcnt_cut;
                new_total = logo_price_for_customer + prcnt_cut;
           
                // subtotal_price = logo_price_for_customer + price;
                subtotal_price = logo_price_for_customer;
                // if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                //    $(".subtotal-box").addClass('subtotal-top-border');
                // }
                $(".additional_service_line").show();
            }else{
                prcnt_cut = ((logo_price_for_customer + price + favicon_enabled_price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);
                // subtotal_price = logo_price_for_customer + price + favicon_enabled_price;
                // new_total = logo_price_for_customer + price + favicon_enabled_price + prcnt_cut;

                subtotal_price = logo_price_for_customer + favicon_enabled_price;
                new_total = logo_price_for_customer + favicon_enabled_price + prcnt_cut;
               
                // if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").addClass('subtotal-top-border');
                // }
                $(".additional_service_line").show();
            }
            // console.log('new_total'+new_total);
            formateschange = chnagecurrency(prcnt_cut,subtotal_price,price,new_total);
            $(".gst_cut_val").html(`${formateschange.format_prcnt_cut}`);
            $(".subtotal-box").html(`<p>{{ __('file.subtotal_text') }}</p><p>${formateschange.format_subtotal_price}</p>`);
            $('.save-logo-for-future-btn').attr('data-enabled','true');
            $(".save-logo-future-box").html(`<p><b>{{ __('file.logo_backup_service_text') }}</b></p><p><b>${formateschange.format_price}/{{ __('file.month_text') }}</b></p>`);
            $('.save-logo-for-future-btn').html('{{ __("file.remove_btn_text") }}');
            $(".total_price_box").html(`<p><b>{{ __('file.total_text') }}</b></p><p><b>${formateschange.format_new_total}</b></p>`);
            $(".save-logo-check").attr('checked','checked');
            

        }else{
            let new_total = 0;
            if(favicon_enabled_status == 'false'){
                prcnt_cut = (logo_price_for_customer  *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);

                new_total = logo_price_for_customer + prcnt_cut;
                subtotal_price = logo_price_for_customer;
                // if($(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").removeClass('subtotal-top-border');
                // }
                $(".additional_service_line").hide();
            }else{
                prcnt_cut = ((logo_price_for_customer + favicon_enabled_price)  *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);
                subtotal_price = logo_price_for_customer + favicon_enabled_price;
                new_total = logo_price_for_customer + favicon_enabled_price + prcnt_cut;

                // if($(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").removeClass('subtotal-top-border');
                // }
            }
            price = 0;
            formateschange = chnagecurrency(prcnt_cut,subtotal_price,price,new_total);

            $(".gst_cut_val").html(`${formateschange.format_prcnt_cut}`);
            $('.save-logo-for-future-btn').attr('data-enabled','false');
            $(".save-logo-future-box").html('');
            $('.save-logo-for-future-btn').html('{{ __("file.add_btn_text") }}');
            $(".total_price_box").html(`<p><b>{{ __('file.total_text') }}</b></p><p><b>${formateschange.format_new_total}</b></p>`);
            $(".save-logo-check").removeAttr('checked');
            $(".subtotal-box").html(`<p>{{ __('file.subtotal_text') }}</p><p>${formateschange.format_subtotal_price}</p>`);
            
        }
    });
    $(".get-favicon-btn").on('click',function(e){
        // gst_cut_val
        e.preventDefault();
        

        let price = parseFloat($(this).attr('data-price'));
        let data_enabled = $(this).attr('data-enabled');
        let total_price = parseFloat(<?php echo $total_price; ?>);
        let logo_future_enabled_status = $(".save-logo-for-future-btn").attr('data-enabled');
        let logo_future_enabled_price = parseFloat($(".save-logo-for-future-btn").attr('data-price'));
        let gst_prcnt = parseFloat("{{ $gst_prcnt }}");
        let logo_price_for_customer = parseFloat("{{ $logo_real_price }}");


        if(data_enabled == 'false'){
            let new_total = 0;
            if(logo_future_enabled_status == 'false'){
                prcnt_cut = ((logo_price_for_customer + price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);

                new_total = logo_price_for_customer + price + prcnt_cut;

                subtotal_price = logo_price_for_customer + price;

                // if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").addClass('subtotal-top-border');
                // }
                $(".additional_service_line").show();

            }else{
                prcnt_cut = ((logo_price_for_customer + price + logo_future_enabled_price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);

                // new_total = logo_price_for_customer + price + logo_future_enabled_price + prcnt_cut;
                
                // subtotal_price = logo_price_for_customer + price + logo_future_enabled_price;

                new_total = logo_price_for_customer + price + prcnt_cut;
                
                subtotal_price = logo_price_for_customer + price ;

                // if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").addClass('subtotal-top-border');
                // }
                $(".additional_service_line").show();
            }
            formateschange = chnagecurrency(prcnt_cut,subtotal_price,price,new_total);
            
            $(".gst_cut_val").html(`${formateschange.format_prcnt_cut}`);
            $(".subtotal-box").html(`<p>{{ __('file.subtotal_text') }}</p><p>${formateschange.format_subtotal_price}</p>`);
            $('.get-favicon-btn').attr('data-enabled','true');
            $(".favicon-logo-box").html(`<p><b>{{ __('file.favicon_design_text') }}</b></p><p><b>${formateschange.format_price}</b></p>`);
            $('.get-favicon-btn').html('{{ __("file.remove_btn_text") }}');
            $(".total_price_box").html(`<p><b>{{ __("file.total_text") }}</b></p><p><b>${formateschange.format_new_total}</b></p>`);

            $(".get-favicon-check").attr('checked','checked');

        }else{
            let new_total = 0;
            if(logo_future_enabled_status == 'false'){
                prcnt_cut = (logo_price_for_customer *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);

                new_total = logo_price_for_customer + prcnt_cut ;

                subtotal_price = logo_price_for_customer;

                // if($(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").removeClass('subtotal-top-border');
                // }
                $(".additional_service_line").hide();
            }else{
                prcnt_cut = ((logo_price_for_customer + logo_future_enabled_price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                // $(".gst_cut_val").html(`${chnagecurrency(prcnt_cut)}`);

                // subtotal_price = logo_price_for_customer + logo_future_enabled_price;

                // new_total = logo_price_for_customer + logo_future_enabled_price + prcnt_cut;

                subtotal_price = logo_price_for_customer ;

                new_total = logo_price_for_customer + prcnt_cut;
            }
            price = 0;
            formateschange = chnagecurrency(prcnt_cut,subtotal_price,price,new_total);
            
            $(".gst_cut_val").html(`${formateschange.format_prcnt_cut}`);
            $('.get-favicon-btn').attr('data-enabled','false');
            $(".favicon-logo-box").html(``);
            $('.get-favicon-btn').html('{{ __("file.add_btn_text") }}');
            $(".total_price_box").html(`<p><b>{{ __('file.total_text') }}</b></p><p><b>${formateschange.format_new_total}</b></p>`);
            $(".subtotal-box").html(`<p>{{ __('file.subtotal_text') }}</p><p>${formateschange.format_subtotal_price}</p>`);
            $(".get-favicon-check").removeAttr('checked');
        }
        
    });
    
</script>

<script>
    // Edit Address form fields 

        $('#editAddress').on('click',function(){

            let address = $("#address").val() ;    
            let email = $("#email").val();
            let organization = $('#organization').val();
            let additional_address = $('#additional-address').val();
            let city_address = $("#city-address").val();
            let country = $("#country").val();
            let state = $("#state").val() ; 
            let zip = $("#zip").val();

            let billing_address = $("#billing_address").val() ;
            let billing_organization = $('#billing_organization').val();
            let billing_additional_address = $('#billing_additional_address').val();
            let billing_city = $("#billing_city").val();
            let billing_country = $("#billing_country").val();
            let billing_state = $("#billing_state").val() ; 
            let billing_zip_code = $("#billing_zip_code").val();
            let taxid = $('#taxid').val();

        if($('#address-confirm').prop('checked')){
            $("#billing_address_box").html(`
    <h6>{{ __('file.billing_address_text') }}</h6>
        <div class="form-row">
            <div class="form-group col-md-12">
                <label for="inputEmail">{{ __('file.plchldr_email_text') }}</label>
                <input type="email" class="form-control" id="inputEmail" name='email' value='${email}' placeholder="{{ __('file.plchldr_email_text') }}">
                <p id='emailError' style='display:none; color:red;'> {{ __('file.enter_valid_email_text') }}  </p>
            </div>
            <div class="form-group col-md-12">
                <label for="inputOrganization">{{ __('file.plchldr_organization_text') }}</label>
                <input type="text" class="form-control" id="inputOrganization" name="organization" value='${organization}'>
            </div>
            <div class="form-group col-md-12">
                <label for="inputAddress">{{ __('file.plchldr_street_address_1') }}</label>
                <input type="text" class="form-control" id="inputAddress" name="address" value='${address}' >
            </div>
            <div class="form-group col-md-12">
                <label for="inputAdditionalAddress">{{ __('file.plchldr_street_address_2') }}</label>
                <input type="text" class="form-control" id="inputAdditionalAddress" name="additionaladdress" value='${additional_address}' >
            </div>
            <div class="form-group col-md-6">
                <label for="inputZip">{{ __('file.plchldr_zip_text') }}</label>
                <input type="text" class="form-control" id="inputZip" name="zip_code" value='${zip}' >
            </div>
            <div class="form-group col-md-6">
                <label for="inputCity">{{ __('file.plchldr_city_text') }}</label>
                <input type="text" class="form-control" id="inputCity" name="city" value='${city_address}' >
            </div>
            <div class="form-group col-md-12">
                <label for="inputState">{{ __('file.plchldr_state_province_text') }}</label>
                <input type="text" class="form-control" id="inputState" name="state" value='${state}' >
            </div>
            <div class="form-group col-md-12">
            <label for="inputCountry">{{ __('file.plchldr_country_text') }}</label>
            <select name="country" id="inputCountry" class="form-control" >
                                @foreach($countries as $k => $v ) 
                                <option value='{{$k}}' ${country === '{{$k}}' ? 'selected' : ''} >{{ $v }}</option>
                                @endforeach
             </select>
        </div>
        </div>
        
        <div class="add_btn mt-4">
                <a type="button" id="cancel-btn">
                Cancel
                </a>
                <button class="continue_btn" id='updateChanges' >{{ __('file.save_text') }}</button>
        
        </div>
    `);
        }else{

            $("#billing_address_box").html(`
                    <h6>{{ __('file.billing_address_text') }}</h6>
                        <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="inputEmail">{{ __('file.plchldr_email_text') }}</label>
                            <input type="email" class="form-control" id="inputEmail" name='email' value='${email}' placeholder="{{ __('file.plchldr_email_text') }}">
                            <p id='emailError' style='display:none; color:red;'> {{ __('file.enter_valid_email_text') }}  </p>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputOrganization">{{ __('file.plchldr_organization_text') }}</label>
                            <input type="text" class="form-control" id="inputOrganization" name="organization" value='${billing_organization}' >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputAddress">{{ __('file.plchldr_street_address_1') }}</label>
                            <input type="text" class="form-control" id="inputAddress" name="address" value='${billing_address}' >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputAdditionalAddress">{{ __('file.plchldr_street_address_2') }}</label>
                            <input type="text" class="form-control" id="inputAdditionalAddress" name="additionaladdress" value='${billing_additional_address}' >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputZip">{{ __('file.plchldr_zip_text') }}</label>
                            <input type="text" class="form-control" id="inputZip" name="zip_code" value='${billing_zip_code}' >
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">{{ __('file.plchldr_city_text') }}</label>
                            <input type="text" class="form-control" id="inputCity" name="city" value='${billing_city}' >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputState">{{ __('file.plchldr_state_province_text') }}</label>
                            <input type="text" class="form-control" id="inputState" name="state" value='${billing_state}' >
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputCountry">{{ __('file.plchldr_country_text') }}</label>
                            <select name="country" class="form-control" id="inputCountry" >
                                                @foreach($countries as $k => $v ) 
                                                <option value='{{$k}}' ${billing_country === '{{$k}}' ? 'selected' : ''} >{{ $v }}</option>
                                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="inputTaxid">{{ __('file.plchldr_tax_ID') }}</label>
                            <input type="text" class="form-control" id="inputTaxid" name='inputTaxid' value='${taxid}' placeholder="Tax ID">
                           
                        </div>
                        </div>
                       
                        <div class="add_btn mt-4">
                        <a type="button" id="cancel-btn">
                        Cancel
                        </a>
                        <button id='updateChangesBilling' class="continue_btn ">{{ __('file.save_text') }}</button>
                        
                        </div>
                    `);
            
        }

        })
        
</script>
<script>
    $("body").delegate('#cancel-btn','click',function(){
            let address = $("#address").val() ;    
            let email = $("#email").val();
            let organization = $('#organization').val();
            let additional_address = $('#additional-address').val();
            let city_address = $("#city-address").val();
            let country = $("#country").val();
            let state = $("#state").val() ; 
            let zip = $("#zip").val();
            let first_name = $('#first_name').val();
            let last_name = $('#last_name').val();

            let billing_address = $("#billing_address").val() ;
            let billing_organization = $('#billing_organization').val();
            let billing_additional_address = $('#billing_additional_address').val();
            let billing_city = $("#billing_city").val();
            let billing_country = $("#billing_country").val();
            let billing_state = $("#billing_state").val() ; 
            let billing_zip_code = $("#billing_zip_code").val();
            let taxid = $('#taxid').val();

            if($('#address-confirm').prop('checked')){ 
                    $("#billing_address_box").html(`<h6>{{ __('file.billing_address_text') }}</h6>
                    <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                    <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                    <p>{{ __('file.plchldr_organization_text') }}: ${organization}</p>
                    <p>{{ __('file.plchldr_street_address_1') }}: ${address}</p>
                    <p>{{ __('file.plchldr_street_address_2') }}: ${additional_address}</p>
                    <p>{{ __('file.plchldr_city_text') }}: ${city_address}</p>
                    <p>{{ __('file.plchldr_state_province_text') }}: ${state}</p>
                    <p>{{ __('file.plchldr_zip_text') }}: ${zip}</p>
                    <p>{{ __('file.plchldr_country_text') }}: ${allcountries[country]}</p>`);
            }else{
                $("#billing_address_box").html(`<h6>{{ __('file.billing_address_text') }}</h6>
                <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                <p>{{ __('file.plchldr_organization_text') }}: ${billing_organization}</p>
                <p>{{ __('file.plchldr_street_address_1') }}: ${billing_address}</p>
                <p>{{ __('file.plchldr_street_address_2') }}: ${billing_additional_address}</p>
                <p>{{ __('file.plchldr_city_text') }}: ${billing_city}</p>
                <p>{{ __('file.plchldr_state_province_text') }}: ${billing_state}</p>
                <p>{{ __('file.plchldr_zip_text') }}: ${billing_zip_code}</p>
                <p>{{ __('file.plchldr_country_text') }}: ${allcountries[billing_country]}</p>
                <p>{{ __('file.plchldr_tax_ID') }}: ${taxid}<p>`);
            }

    });
</script>
<script>
   
    // On clicking the update button it updates the values of the address
    $(document).on('click', '#updateChangesBilling', function(e) {
        email = $('#inputEmail').val();
        //   Check for Valid Email Address
      var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if(isValidEmail){
            $('#emailError').hide();
            address = $('#inputAddress').val();
            additionaladdress = $('#inputAdditionalAddress').val();
            organization = $('#inputOrganization').val();
            city = $('#inputCity').val();
            zip = $('#inputZip').val();
            state = $('#inputState').val();
            country = $('#inputCountry').val();
            taxid = $('#inputTaxid').val();
            first_name = $('#first_name').val();
            last_name = $('#last_name').val();
            if(address == "" || address == null || additionaladdress == "" || additionaladdress == null || organization == null || organization == "" || city == null || city == "" || zip == null || zip == "" || state == null || state == "" || country == null || country == "" || taxid == "" || taxid == null){
                return false;
            }
    
   
        // update the values of the fields in first page
            $('#billing_address').val(address);
            $('#billing_city').val(city);
            $('#billing_zip_code').val(zip);
            $('#billing_state').val(state);
            $('#billing_country').val(country);
            $('#email').val(email);
            $('#billing_organization').val(organization);
            $('#billing_additional_address').val(additionaladdress);
            $('#taxid').val(taxid);
        
            // $("#billing_address_box").html(`<h6>Billing Address</h6><p>${address},${organization} ,${city} ${state} ${zip},${country}</p><p>${email}</p><p>Additional address:${additionaladdress}<p><p>Tax ID: ${taxid}</p>`);
            $("#billing_address_box").html(`<h6>{{ __('file.billing_address_text') }}</h6>
                <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                <p>{{ __('file.plchldr_organization_text') }}: ${organization}</p>
                <p>{{ __('file.plchldr_street_address_1') }}: ${address}</p>
                <p>{{ __('file.plchldr_street_address_2') }}: ${additionaladdress}</p>
                <p>{{ __('file.plchldr_city_text') }}: ${city}</p>
                <p>{{ __('file.plchldr_state_province_text') }}: ${state}</p>
                <p>{{ __('file.plchldr_zip_text') }}: ${zip}</p>
                <p>{{ __('file.plchldr_country_text') }}: ${allcountries[country]}</p>
                <p>{{ __('file.plchldr_tax_ID') }}: ${taxid}<p>`);
        }
        else{
            $('#emailError').show();
        }
        });
        $(document).on('click', '#updateChanges', function(e) {
        email = $('#inputEmail').val();
        //   Check for Valid Email Address
      var isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if(isValidEmail){
            $('#emailError').hide();
            address = $('#inputAddress').val();
            additionaladdress = $('#inputAdditionalAddress').val();
            organization = $('#inputOrganization').val();
            city = $('#inputCity').val();
            zip = $('#inputZip').val();
            state = $('#inputState').val();
            country = $('#inputCountry').val();
            first_name = $('#first_name').val();
            last_name = $('#last_name').val();

            if(address == "" || address == null || additionaladdress == "" || additionaladdress == null  || city == null || city == "" || zip == null || zip == "" || state == null || state == "" || country == null || country == ""){
                return false;
            }
   
        // update the values of the fields in first page
            $('#address').val(address);
            $('#city-address').val(city);
            $('#zip').val(zip);
            $('#state').val(state);
            $('#country').val(country);
            $('#email').val(email);
            $('#organization').val(organization);
            $('#additional-address').val(additionaladdress);
        
            // $("#billing_address_box").html(`<h6>Billing Address</h6><p>${address},${organization} ,${city} ${state} ${zip},${country}</p><p>${email}</p><p>Additional address:${additionaladdress}<p>`);
            $("#billing_address_box").html(`<h6>Billing Address</h6>
                    <p>{{ __('file.plchldr_email_text') }}: ${email}</p>
                    <p>{{ __('file.plchldr_name_text') }}: ${first_name} ${last_name}</p>
                    <p>{{ __('file.plchldr_organization_text') }}: ${organization}</p>
                    <p>{{ __('file.plchldr_street_address_1') }}: ${address}</p>
                    <p>{{ __('file.plchldr_street_address_2') }}: ${additionaladdress}</p>
                    <p>{{ __('file.plchldr_city_text') }}: ${city}</p>
                    <p>{{ __('file.plchldr_state_province_text') }}: ${state}</p>
                    <p>{{ __('file.plchldr_zip_text') }}: ${zip}</p>
                    <p>{{ __('file.plchldr_country_text') }}: ${allcountries[country]}</p>`);

        }
        else{
            $('#emailError').show();
        }
        });
      
        function chnagecurrency(prcnt_cut,subtotal_price,price,new_total){
           $.ajax({
            method: 'post',
            url: "{{ url(app()->getLocale().'/change-format') }}",
            data: { _token:"{{ csrf_token() }}",prcnt_cut:prcnt_cut,subtotal_price:subtotal_price,price:price,new_total:new_total },
            cache:false,
            dataType:"json",
            async:false,
            success: function(response){
                res = response;
            }
            
           })
           return res;
        }
</script>
    <script>    
        $('#backButton1').on('click', function() {
            $('#progress-form__tab-1').removeAttr('disabled');
            $('#progress-form__tab-1').click();
            $('#progress-form__tab-1').attr('disabled','');
        });
        $('#backButton2').on('click', function() {
            $('#progress-form__tab-2').removeAttr('disabled');
            $('#progress-form__tab-2').click();
            $('#progress-form__tab-2').attr('disbaled','');
        });
    </script>

    <script>
    $('#editPayment').on('click', function () {
        $('#progress-form__tab-2').removeAttr('disabled');
        $('#progress-form__tab-2').click();
        $('#progress-form__tab-2').attr('disabled','');  
    });
</script>
<script>
    $('#address-confirm').on('change',function(){
        if($(this).prop('checked')){
            $('#billing-address').hide();
        }else{
           $('#billing-address').show();
           // Firstname 
           @if(isset(auth()->user()->billingaddress->first_name) && !empty(auth()->user()->billingaddress->first_name))
            $('input[name="billing_first_name"]').val("{{ auth()->user()->billingaddress->first_name ?? '' ;}}");
           @else
            $('input[name="billing_first_name"]').val($('input[name="first_name"]').val());
           @endif
            // Last name
           @if(isset(auth()->user()->billingaddress->last_name) && !empty(auth()->user()->billingaddress->last_name))
            $('input[name="billing_last_name"]').val("{{ auth()->user()->billingaddress->last_name ?? '' ; }}");
           @else
            $('input[name="billing_last_name"]').val($('input[name="last_name"]').val());
           @endif
           
           @if(isset(auth()->user()->billingaddress->organization	) && !empty(auth()->user()->billingaddress->organization))
            $('input[name="billing_organization"]').val("{{ auth()->user()->billingaddress->organization ?? '' ; }}");
           @else
            $('input[name="billing_organization"]').val($('input[name="organization"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->address_1	) && !empty(auth()->user()->billingaddress->address_1))
            $('input[name="billing_address"]').val("{{ auth()->user()->billingaddress->address_1 ?? '' ; }}");
           @else
            $('input[name="billing_address"]').val($('input[name="address"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->address_2	) && !empty(auth()->user()->billingaddress->address_2))
            $('input[name="billing_additional_address"]').val("{{ auth()->user()->billingaddress->address_2 ?? '' ; }}");
           @else
           $('input[name="billing_additional_address"]').val($('input[name="additional_address"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->zip_code ) && !empty(auth()->user()->billingaddress->zip_code))
            $('input[name="billing_zip_code"]').val("{{ auth()->user()->billingaddress->zip_code ?? '' ; }}");
           @else
            $('input[name="billing_zip_code"]').val($('input[name="zip_code"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->city ) && !empty(auth()->user()->billingaddress->city))
            $('input[name="billing_city"]').val("{{ auth()->user()->billingaddress->city ?? '' ; }}");
           @else
            $('input[name="billing_city"]').val($('input[name="city"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->state ) && !empty(auth()->user()->billingaddress->state))
            $('input[name="billing_state"]').val("{{ auth()->user()->billingaddress->state ?? '' ; }}");
           @else
            $('input[name="billing_state"]').val($('input[name="state"]').val());
           @endif

           @if(isset(auth()->user()->billingaddress->country ) && !empty(auth()->user()->billingaddress->country))
            $('input[name="billing_country"]').val("{{ auth()->user()->billingaddress->country ?? '' ; }}");
           @else
            $('select[name="billing_country"]').val($('select[name="country"]').val()).change();
           @endif
        }
    });
</script>
<!-- <script>
    $('.continue_btn').on('click', function() {
        var scrollAmount = 80; 

        $('html, body').animate({
            scrollTop: $('.step_form').offset().top + scrollAmount
        }, 'slow');
    });
</script> -->


@endsection
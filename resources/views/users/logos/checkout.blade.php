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
                    <button id="progress-form__tab-1" style="outline:none" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 1 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
                            </span>
                        </div>
                        <p> Information</p>
                    </button>
                </div>
                <div class="box_step">
                    <button id="progress-form__tab-2" style="outline:none" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 2 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
                            </span>
                        </div>
                        <p> Payment</p>
                    </button>
                </div>
                <div class="box_step border_last">
                    <button id="progress-form__tab-3" style="outline:none" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
                        <div class="box_studio">
                            <span class="true_num" aria-hidden="true"> 3 </span>
                            <span class="true_img">
                            <img src="{{ asset('logomax-front-asset/img/check-mark-checkout.svg') }}" alt="">
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
                            <h5>Contact information</h5>
                        </div>
                        <div class="text text-danger error-text"></div>
                        <!-- Email -->      
                        <div class="form__field form-row form__field ">
                            <div class="col-md-12 ">
                                <label for="email">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="email" type="text" class="input-box" name="email" value="{{ auth()->user()->email ?? ''; }}" placeholder="Email" <?php if(isset(auth()->user()->id)){ echo 'readonly'; }  ?>  />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="first_name" class="input-box" type="text" name="first_name" value="" placeholder="First name"   />
                            </div>
                            <div class="col-md-6">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="name" type="text" class="input-box" name="last_name" value="" placeholder="Last name"   />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-12 ">
                                <label for="organization">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="organization" class="input-box" type="text" name="organization" value="" placeholder="Organization"   />
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="address" type="text" class="input-box" name="address" placeholder="Street, number" />
                            </div>
                        </div>
                        <!-- address line 1 -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="additional-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="additional-address" type="text" class="input-box" name="additional_address" placeholder="Additional address line" />
                            </div>
                        </div>
                        
                        <!-- City and zip  -->
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="zip">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="zip" type="text" class="input-box" name="zip_code" placeholder="Zip / Postal Code" />
                            </div>
                            <div class="col-md-6">
                                <label for="city-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="city-address" class="input-box" type="text" name="city" placeholder="City"/>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="state-address">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="state" type="text" class="input-box" name="state" placeholder="State / Province / Region" />
                            </div>
                        </div>
                        
                        <div class="form-row form__field mt-3 sm:mt-0" >
                            <div class="col-md-12 ">
                                <select name="country"  id="country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option value="{{$k}}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 ">
                                <input type="checkbox" class="address-confirm-check" id="address-confirm" name="billing_address_confirm" checked>
                                <label for="address-confirm" class="address-confirm-label" >Use contact address as billing address</label>
                            </div>
                        </div>
                    <div id="billing-address" style="display:none;">
                            <h5>Billing Address</h5>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_first_name" class="input-box" type="text" name="billing_first_name" value="" placeholder="First name"   />
                            </div>
                            <div class="col-md-6">
                                <label for="name">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_last_name" type="text" class="input-box" name="billing_last_name" value="" placeholder="Last name"   />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-12 ">
                                <label for="organization">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_organization" class="input-box" type="text" name="billing_organization" value="" placeholder="Organization"   />
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_address" type="text" class="input-box" name="billing_address" placeholder="Street, number" />
                            </div>
                        </div>
                        <!-- address line 1 -->
                        <div class="form-row mt-3 sm:mt-0 form__field">
                            <div class="col-md-12 ">
                                <label for="additional-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_additional_address" type="text" class="input-box" name="billing_additional_address" placeholder="Additional address line" />
                            </div>
                        </div>
                        
                        <!-- City and zip  -->
                        <div class="form-row form__field mt-3 sm:mt-0 ">
                            <div class="col-md-6 ">
                                <label for="zip">
                                    <span aria-hidden="true"></span>
                                </label>
                                <input id="billing_zip_code" type="text" class="input-box" name="billing_zip_code" placeholder="Zip / Postal Code" />
                            </div>
                            <div class="col-md-6">
                                <label for="city-address">
                                    <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_city" class="input-box" type="text" name="billing_city" placeholder="City"/>
                            </div>
                        </div>
                        <!--  -->
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="state-address">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="billing_state" type="text" class="input-box" name="billing_state" placeholder="State / Province / Region" />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0">
                            <div class="col-md-12 ">
                                <label for="taxid">
                                <span  aria-hidden="true"></span>
                                </label>
                                <input id="taxid" type="text" class="input-box" name="taxid" placeholder="Tax Id" />
                            </div>
                        </div>
                        <div class="form-row form__field mt-3 sm:mt-0" >
                            <div class="col-md-12 ">
                                <select name="billing_country"  id="billing_country" style="cursor:pointer;">
                                    @foreach($countries as $k => $v)
                                    <option value="{{$k}}">{{ $v }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                        <!--  -->
                        <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
                            <div class="chk_btn add_btn">
                                <a href="{{ url('logo/'.$logo->logo_slug) }}" type="button" class="check-back-btn" id="backButton0"  >Back</a>
                                <button type="button" data-action="next" class="continue_btn" id="add_billing_address">
                                    Continue
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="checkout_summary">
                        <h5>Order summary</h5>
                        <div class="templete_wrapper">
                            <div class="summary_wrapp">
                                <div class="img">
                                    <div class="img-box">
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    </div>
                                </div>
                                <div class="img-text-list">
                                    <ul>
                                        <li>Exclusive License</li>
                                        <li>Rapid, Free Customization</li>
                                        <li>Immediate Use</li>
                                    </ul>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                    <span class="text text-dark"><b>${{ $logo->price_for_customer }}</b></span>
                                </div>
                            </div>
                            <div class="additional_content mt-5">
                            <h6>Additional options:</h6>
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::all();
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
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="save-logo-for-future-btn">Add </a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>

                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="get-favicon-btn">Add</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo->price_for_customer;
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ $logo_price }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data">
                            
                            
                            <!-- Selected additional options value are here  -->
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <!-- Subtotal  -->
                            <div class="total_data subtotal-box">
                                <p>Subtotal</p>
                                <p>${{ $logo->price_for_customer }}</p>
                            </div>
                            <!-- Tax -->
                            <div class="total_data">
                                <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">${{ $gst_cut }}</p>
                            </div>
                            <!-- END -->
                            <div class="total_data num total_price_box subtotal-top-border">
                                <p><b>Total</b></p>
                                <p><b>${{ $total_price }}</b></p>
                            </div>
                            <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="progress-form__panel-2" class="data_wrapper one" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
                <div class="custom_step_form">
                    <div class="step_form">
                    <h5>Payment method</h5>
                        <div class="pay_form_data">
                            <div class="card_wrapper" id="cardPayment">
                                <div class="form-group">
                                    <span></span>
                                    <p>Credit card</p>
                                </div>
                                <div class="crad_img">
                                    <img src="{{ asset('logomax-front-asset/img/card-img-icon.svg') }}" alt="">
                                </div>
                            </div>
                            <div class="card_detail">
                                <div class='form-row row'>
                                    <div class='col-lg-12 form-group'>
                                        <label class='control-label'>Name on Card</label>
                                         <input class='form-control'  id="name_on_card" name="name_on_card" type='text'>
                                    </div>
                                </div>
                                <!-- ################### Show Card ######################### -->
                                <div id="card-elements"></div>
                                <!-- ################### ######### ######################### -->
                            </div>
                        </div>
                    <div class="pay_form_data">
                        <div class="card_wrapper" id="paypalPayment">
                        <div class="form-group">
                            <span></span>
                            <p>PayPal</p>
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
                    <div class="chk_btn add_btn">
                        <a type="button" class="check-back-btn" id="backButton1"  >Back</a>
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
                                    <div class="img-box">
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    </div>
                                    <p>{{ $logo->logo_name }}</p>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                    <span class="text text-dark"><b>${{ $logo->price_for_customer }}</b></span>
                                </div>
                            </div>
                            <div class="additional_content mt-5">
                            <h6>Additional options:</h6>
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::all();
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
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="save-logo-for-future-btn">Add </a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>

                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="get-favicon-btn">Add</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo->price_for_customer;
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ $logo_price }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data">
                            
                            
                            <!-- Selected additional options value are here  -->
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <!-- Subtotal  -->
                            <div class="total_data subtotal-box">
                                <p>Subtotal</p>
                                <p>${{ $logo->price_for_customer }}</p>
                            </div>
                            <!-- Tax -->
                            <div class="total_data">
                                <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">${{ $gst_cut }}</p>
                            </div>
                            <!-- END -->
                            <div class="total_data num total_price_box">
                                <p><b>Total</b></p>
                                <p><b>${{ $total_price }}</b></p>
                            </div>
                            <!--  -->
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
                        <div class="billing_text col-10" id="billing_address_box">
                            <!-- <h6>Billing Address</h6>
                            <p>80191 Blaise Street Apt. 110 Boganland, Arkansas USA 893804</p> -->
                        </div>
                         <div class="bill-icon">
                            <i id="editAddress" class="fa-solid fa-pen"></i>
                        </div> 

                    </div>

                        <div class="billing_wrapper">
                        <div class="billing_text" id="payment_method_box">
                            <h6>Payment Method</h6>
                            <div class="img_visa">
                                <p id="nopaymethod">No Payment Method Selected</p>
                                <img id="cardImage" src='' style="display: none"  />
                            </div>
                            {{-- <p>Visa card ending in 1234</p> --}}
                        </div>
                        <div class="bill-icon">
                            <i id="editPayment" class="fa-solid fa-pen"></i>
                        </div> 
                        </div>
                    </div>
                    <div>
                        <div class="form-group">
                        <div class="text text-warning mt-2" id="card-error-message"></div>
                        <p style="font-size: 83%;"><b>Note:</b> To get free logo customization, simply request it on the logo's download page in your Logomax
                            account, within 7 days after buying</p>
                        <div class="checkout_btn  add_btn">
                            <!-- <a href="logo-download-page.html" class="continue_btn">
                            Continue & Download
                            </a> -->

                            <a  id="backButton2"  class="check-back-btn" >Back</a>
                            <button type="button" class="formSubmitBtn continue_btn" id="card-button" data-secret="{{ $intent->client_secret }}" >Continue & Download</button>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="checkout_summary">
                        <h5>Order summary</h5>
                        <div class="templete_wrapper">
                            <div class="summary_wrapp">
                                <div class="img">
                                    <div class="img-box">
                                        <img src="{{ asset($logo->media->image_path) }}" alt="" />
                                    </div>
                                    <p>{{ $logo->logo_name }}</p>
                                </div>
                                <!-- Logo Price -->
                                <div class="drawn_data">
                                    <span class="text text-dark"><b>${{ $logo->price_for_customer }}</b></span>
                                </div>
                            </div>
                            <div class="additional_content mt-5">
                            <h6>Additional options:</h6>
                            </div>
                            <!--  -->
                            <?php 
                            $additional_options = App\Models\AdditionalOptions::class::all();
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
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>
                                        <a href="#" data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="save-logo-for-future-btn">Add </a>
                                        <input type="checkbox" name="save_logo_for_future_status" class="save-logo-check"/>
                                        <input type="hidden" name="save_logo_for_future_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                @if($option->option_type == 'get-favicon')
                                <div class="add_account_wrapp">
                                    <div class="add_btn">
                                        <p>{{ $option->option_text }}</p>

                                        <a href=""  data-id="option-{{ $option->id }}" data-enabled="false" data-price="{{ $option->amount }}" class="get-favicon-btn">Add</a>
                                        <input type="checkbox" name="get_favicon_status" class="get-favicon-check" />
                                        <input type="hidden" name="get_favicon_price" value="{{ $option->amount }}" />
                                    </div>
                                    <div class="save_data">
                                        @if($option->pricing_duration == 'monthly')
                                        <span><b>${{ $option->amount }} /month</b></span>
                                        @else
                                        <span><b>${{ $option->amount }}</b></span>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            @endforeach
                            <?php 
                                $logo_price = (float)$logo->price_for_customer;
                                $gst_cut = ($logo_price * $gst_prcnt) / 100;
                                $total_price = $logo_price + $gst_cut;
                            ?>
                            <!-- price -->
                            <input type="hidden" name="logo_price" value="{{ $logo_price }}" />
                            <input type="hidden" name="taxes" value="{{ $gst_cut }}" />
                            <input type="hidden" name="taxe_percent" value="{{ $gst_prcnt }}" />
                            <input type="hidden" name="total_price" value="{{ $total_price }}" />
                            <!-- End -->
                            <div class="table_data">
                            <!-- Selected additional options value are here  -->
                            <div class="total_data save-logo-future-box">
                                
                            </div>
                            <div class="total_data favicon-logo-box">
                                
                            </div>
                            <!-- Subtotal  -->
                            <div class="total_data subtotal-box">
                                <p>Subtotal</p>
                                <p>${{ $logo->price_for_customer }}</p>
                            </div>
                            <!-- Tax -->
                            <div class="total_data">
                                <p>VAT/GST/Sales taxes ({{ $gst_prcnt }}%)</p>
                                <p class="gst_cut_val">${{ $gst_cut }}</p>
                            </div>
                            <!-- END -->
                            <div class="total_data num total_price_box">
                                <p><b>Total</b></p>
                                <p><b>${{ $total_price }}</b></p>
                            </div>
                            <!--  -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
  </section>
  
<script src="https://js.stripe.com/v3/"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    $("#add_billing_address").on('click',function(){
        let address = $("#address").val() ;    
        let email = $("#email").val();
        let organization = $('#organization').val();
        let additional_address = $('#additional-address').val();
        let city_address = $("#city-address").val();
        let country = $("#country").val();
        let state = $("#state").val() ; 
        let zip = $("#zip").val();
        if($('input#address-confirm').prop('checked')){
         console.log('done');
        if(address == '' || address ==  undefined || email == "" || email == undefined || city_address == "" || city_address == undefined || country == "" || country == undefined || state == "" || state == undefined || zip == "" || zip == undefined || additional_address =="" || additional_address == undefined || organization == "" || organization == undefined){
            $(".error-text").html('All fields are required');
            return false;
        }else{
            $("#billing_address_box").html(`<h6>Billing Address</h6><p>${address} ,${city_address} ${state} ${zip},${country}</p><p>${email}</p>`);
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
        if(taxid == '' || taxid ==  undefined || billing_zip_code == '' || billing_zip_code ==  undefined || billing_state == '' || billing_state ==  undefined || billing_country == '' || billing_country ==  undefined || billing_city == '' || billing_city ==  undefined || billing_additional_address == '' || billing_additional_address ==  undefined || billing_organization == '' || billing_organization ==  undefined || billing_address == '' || billing_address ==  undefined || address == '' || address ==  undefined || email == "" || email == undefined || city_address == "" || city_address == undefined || country == "" || country == undefined || state == "" || state == undefined || zip == "" || zip == undefined || additional_address =="" || additional_address == undefined || organization == "" || organization == undefined){
        $(".error-text").html('All fields are required');
        return false;
        }else{
            $("#billing_address_box").html(`<h6>Billing Address</h6><p>${billing_address} ,${billing_city} ${billing_state} ${billing_zip_code},${billing_country}</p><p>${email}</p><p>Additional address:${billing_additional_address}<p><p>Tax id: ${taxid}<p>`);
        }
    }
    });
</script>

<script>
    const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
    const elements= stripe.elements();
    const cardElement= elements.create('card');
    cardElement.mount('#card-elements');
    
    //////##################################//////////
    //When Clicked on card button//     
    $('#cardPayment').on('click',function(){
            $('#cardImage').hide();
            $('#nopaymethod').show();
             // Show Entered Card icons on the confirmation page
            cardElement.on('change', function (event) {
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
                    $('#cardImage').attr('src', `{{ asset('logomax-front-asset/img/card-images/') }}/${brand}.png`);
                    
                }
            }
            }); 
        })
        // When Clicked on Paypal Button
            $('#paypalPayment').on('click',function(){
                $('#cardImage').show();
                $('#nopaymethod').hide();
                // Show Paypal Icon on the Confirmation page
                $('#cardImage').attr('src', `{{ asset('logomax-front-asset/img/card-images/paypal.png') }}`);
            })
    //////##################################//////////
    const formSubmitBtn = document.querySelector('.formSubmitBtn');
    formSubmitBtn.addEventListener('click', async (e) => {
           
        const form = document.getElementById('progress-form');

        const cardBtn = document.getElementById('card-button');

        const cardHolderName = document.getElementById('name_on_card'); 
        e.preventDefault()
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
            // console.log(setupIntent);
        }
    });

    $(".save-logo-for-future-btn").on('click',function(e){
        // gst_cut_val
        e.preventDefault();
        let price = parseFloat($(this).attr('data-price'));
        let logo_price_for_customer = parseFloat("{{ $logo->price_for_customer }}");
        let data_enabled = $(this).attr('data-enabled');
        let total_price = parseFloat(<?php echo $total_price; ?>);
        let gst_prcnt = parseFloat("{{ $gst_prcnt }}");
        let favicon_enabled_status = $(".get-favicon-btn").attr('data-enabled');
        let favicon_enabled_price = parseFloat($(".get-favicon-btn").attr('data-price'));
        // console.log('favicon_enabled_status'  + favicon_enabled_status);
        // console.log('favicon_enabled_price'  + favicon_enabled_price);
        // console.log('gst prcnt is there => ' + gst_prcnt);
        // get-favicon-check save-logo-check

        if(data_enabled == 'false'){
            let new_total = 0;
            if(favicon_enabled_status == 'false'){
                prcnt_cut = ((logo_price_for_customer + price) *  gst_prcnt) / 100; 
                // console.log(logo_price_for_customer + '<- totoal price current-> '  +  price + 'gst_prcnt_cut ' + prcnt_cut );
                $(".gst_cut_val").html(`$${prcnt_cut}`);
                new_total = logo_price_for_customer + price + prcnt_cut;
                
                if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").addClass('subtotal-top-border');
                }
            }else{
                prcnt_cut = ((logo_price_for_customer + price + favicon_enabled_price) *  gst_prcnt) / 100; 
                console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + price + favicon_enabled_price + prcnt_cut;

                if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").addClass('subtotal-top-border');
                }
            }
            // console.log('new_total'+new_total);
            $('.save-logo-for-future-btn').attr('data-enabled','true');
            $(".save-logo-future-box").html(`<p>Price for saving logo for future use</p><p>$${price}</p>`);
            $('.save-logo-for-future-btn').html('Remove');
            $(".total_price_box").html(`<p><b>Total</b></p><p><b>$${new_total}</b></p>`);
            $(".save-logo-check").attr('checked','checked');
            

        }else{
            let new_total = 0;
            if(favicon_enabled_status == 'false'){
                prcnt_cut = (logo_price_for_customer  *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + prcnt_cut;

                if($(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").removeClass('subtotal-top-border');
                }
            }else{
                prcnt_cut = ((logo_price_for_customer + favicon_enabled_price)  *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + favicon_enabled_price + prcnt_cut;

                // if($(".subtotal-box").hasClass('subtotal-top-border')){
                //     $(".subtotal-box").removeClass('subtotal-top-border');
                // }
            }
            $('.save-logo-for-future-btn').attr('data-enabled','false');
            $(".save-logo-future-box").html('');
            $('.save-logo-for-future-btn').html('Add');
            $(".total_price_box").html(`<p><b>Total</b></p><p><b>$${new_total}</b></p>`);
            $(".save-logo-check").removeAttr('checked');

            
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
        let logo_price_for_customer = parseFloat("{{ $logo->price_for_customer }}");


        if(data_enabled == 'false'){
            let new_total = 0;
            if(logo_future_enabled_status == 'false'){
                prcnt_cut = ((logo_price_for_customer + price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + price + prcnt_cut;

                if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").addClass('subtotal-top-border');
                }

            }else{
                prcnt_cut = ((logo_price_for_customer + price + logo_future_enabled_price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + price + logo_future_enabled_price + prcnt_cut;
                
                if(!$(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").addClass('subtotal-top-border');
                }

            }
            $('.get-favicon-btn').attr('data-enabled','true');
            $(".favicon-logo-box").html(`<p>Favicon logo price</p><p>$${price}</p>`);
            $('.get-favicon-btn').html('Remove');
            $(".total_price_box").html(`<p><b>Total</b></p><p><b>$${new_total}</b></p>`);

            $(".get-favicon-check").attr('checked','checked');

            

        }else{
            let new_total = 0;
            if(logo_future_enabled_status == 'false'){
                prcnt_cut = (logo_price_for_customer *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + prcnt_cut ;

                if($(".subtotal-box").hasClass('subtotal-top-border')){
                    $(".subtotal-box").removeClass('subtotal-top-border');
                }

            }else{
                prcnt_cut = ((logo_price_for_customer + logo_future_enabled_price) *  gst_prcnt) / 100; 
                // console.log(prcnt_cut);
                $(".gst_cut_val").html(`$${prcnt_cut}`);

                new_total = logo_price_for_customer + logo_future_enabled_price + prcnt_cut;
            }
            $('.get-favicon-btn').attr('data-enabled','false');
            $(".favicon-logo-box").html(``);
            $('.get-favicon-btn').html('Add');
            $(".total_price_box").html(`<p><b>Total</b></p><p><b>$${new_total}</b></p>`);

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
    <h6>Billing Address</h6>
        <div class="form-row">
        <div class="form-group col-md-10">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="address" value='${address}' placeholder="123 Main St">
        </div>
        <div class="form-group col-md-10">
            <label for="inputAdditionalAddress">Additional Address</label>
            <input type="text" class="form-control" id="inputAdditionalAddress" name="additionaladdress" value='${additional_address}' placeholder="123 Main St">
        </div>
        <div class="form-group col-md-6">
            <label for="inputCity">City</label>
            <input type="text" class="form-control" id="inputCity" name="city" value='${city_address}' placeholder="City">
        </div>
        <div class="form-group col-md-6">
            <label for="inputOrganization">Organization</label>
            <input type="text" class="form-control" id="inputOrganization" name="organization" value='${organization}' placeholder="organization">
        </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="inputZip">Zip</label>
            <input type="text" class="form-control" id="inputZip" name="zip_code" value='${zip}' placeholder="Zip">
            </div>
        <div class="form-group col-md-6">
            <label for="inputState">State</label>
            <input type="text" class="form-control" id="inputState" name="state" value='${state}' placeholder="State">
        </div>
        </div>
        <div class="form-row">
        <div class="form-group col-md-4">
            <label for="inputCountry">Country</label>
            <select name="country" id="inputCountry" style="cursor:pointer;">
                                @foreach($countries as $k => $v ) 
                                <option value='{{$k}}' ${country === '{{$k}}' ? 'selected' : ''} >{{ $v }}</option>
                                @endforeach
             </select>
        </div>
        <div class="form-group col-md-8">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name='email' value='${email}' placeholder="Email">
            <p id='emailError' style='display:none; color:red;'> Enter a Valid Email  </p>
        </div>
        </div>
        <div class="add_btn">

        <a id='updateChanges' class=''>Update</a>
        </div>
    `);
        }else{

            $("#billing_address_box").html(`
                    <h6>Billing Address</h6>
                        <div class="form-row">
                        <div class="form-group col-md-10">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" name="address" value='${billing_address}' placeholder="123 Main St">
                        </div>
                        <div class="form-group col-md-10">
                            <label for="inputAdditionalAddress">Additional Address</label>
                            <input type="text" class="form-control" id="inputAdditionalAddress" name="additionaladdress" value='${billing_additional_address}' placeholder="123 Main St">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputCity">City</label>
                            <input type="text" class="form-control" id="inputCity" name="city" value='${billing_city}' placeholder="City">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputOrganization">Organization</label>
                            <input type="text" class="form-control" id="inputOrganization" name="organization" value='${billing_organization}' placeholder="organization">
                        </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputZip">Zip</label>
                            <input type="text" class="form-control" id="inputZip" name="zip_code" value='${billing_zip_code}' placeholder="Zip">
                            </div>
                        <div class="form-group col-md-6">
                            <label for="inputState">State</label>
                            <input type="text" class="form-control" id="inputState" name="state" value='${billing_state}' placeholder="State">
                        </div>
                        </div>
                        <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCountry">Country</label>
                            <select name="country" id="inputCountry" style="cursor:pointer;">
                                                @foreach($countries as $k => $v ) 
                                                <option value='{{$k}}' ${billing_country === '{{$k}}' ? 'selected' : ''} >{{ $v }}</option>
                                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputEmail">Email</label>
                            <input type="email" class="form-control" id="inputEmail" name='email' value='${email}' placeholder="Email">
                            <p id='emailError' style='display:none; color:red;'> Enter a Valid Email  </p>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="inputTaxid">Tax Id</label>
                            <input type="text" class="form-control" id="inputTaxid" name='inputTaxid' value='${taxid}' placeholder="taxid">
                           
                        </div>
                        </div>
                        <div class="add_btn">

                        <a id='updateChangesBilling' class=''>Update</a>
                        </div>
                    `);
            
        }

        })
        
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
        
            $("#billing_address_box").html(`<h6>Billing Address</h6><p>${address},${organization} ,${city} ${state} ${zip},${country}</p><p>${email}</p><p>Additional address:${additionaladdress}<p><p>Tax Id: ${taxid}</p>`);

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

    
   
        // update the values of the fields in first page
            $('#address').val(address);
            $('#city-address').val(city);
            $('#zip').val(zip);
            $('#state').val(state);
            $('#country').val(country);
            $('#email').val(email);
            $('#organization').val(organization);
            $('#additional-address').val(additionaladdress);
        
            $("#billing_address_box").html(`<h6>Billing Address</h6><p>${address},${organization} ,${city} ${state} ${zip},${country}</p><p>${email}</p><p>Additional address:${additionaladdress}<p>`);

        }
        else{
            $('#emailError').show();
        }
        });
</script>
    <script>    
        $('#backButton1').on('click', function() {
            $('#progress-form__tab-1').click();
        });
        $('#backButton2').on('click', function() {
            $('#progress-form__tab-2').click();
        });
    </script>

    <script>
    $('#editPayment').on('click', function () {
        $('#progress-form__tab-2').click();
        // nameOnCard = $('#name_on_card').val();
        // let cardNumber = $('#card-elements input[name="cardnumber"]').val();

        // console.log(cardNumber)
        // $('#payment_method_box').html(`
        //     <h6>Payment Method</h6>
        //     <div class='form-row row'>
        //         <div class='col-lg-12 form-group'>
        //             <label class='control-label'>Name on Card</label>
        //             <input class='form-control' id="name_on_edit_card" value='${nameOnCard}' name="name_on_card" type='text'>
        //         </div>
        //     </div>
        //     <!-- ################### Show Card ######################### -->
        //     <div id="edit-card-elements"></div>
        //     <!-- ################### ######### ######################### -->
        // `);

        // // Mount the Stripe card element 
        // const stripe = Stripe('{{ env("STRIPE_PUB_KEY") }}');
        // const elements = stripe.elements();
        // const cardElement = elements.create('card');
        // cardElement.mount('#edit-card-elements');
    });
</script>
<script>
    $('#address-confirm').on('change',function(){
        if($(this).prop('checked')){
            $('#billing-address').hide();
        }else{
           $('#billing-address').show();
           $('input[name="billing_first_name"]').val($('input[name="first_name"]').val());
           $('input[name="billing_last_name"]').val($('input[name="last_name"]').val());
           $('input[name="billing_organization"]').val($('input[name="organization"]').val());
           $('input[name="billing_address"]').val($('input[name="address"]').val());
           $('input[name="billing_additional_address"]').val($('input[name="additional_address"]').val());
           $('input[name="billing_zip_code"]').val($('input[name="zip_code"]').val());
           $('input[name="billing_city"]').val($('input[name="city"]').val());
           $('input[name="billing_state"]').val($('input[name="state"]').val());
            $('select[name="billing_country"]').val($('select[name="country"]').val()).change();
        }
    });
</script>
@endsection
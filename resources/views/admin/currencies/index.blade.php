@extends('admin_layout/master')
@section('content')
<?php
$currencies = ['USD','AED','AUD','CAD','CHF','CLP','COP','EUR','GBP','HKD','ILS','INR','MYR','MXN','NZD','PEN','PHP','PKR','SGD','ZAR'];
$countries = [ 'es-ar' =>'Argenina - Espanol' , 'en-au'=>'Australia - English' , 'en-ca'=>'Canada-English' , 'es-ch'=>'Chile-Espanol' ,'es-co'=>'Colombia-Espanol' , 'de-de'=>'Deutschland-Deutsch' , 'es-es'=>'Espana-Espanol' , 'es-esu'=>'Estados Unidos-Espanol' , 'en-hok'=>'Hong Kong-English' , 'en-in'=>'India->English' , 'en-ir'=>'Ireland-English' , 'en-is'=>'Israel-English' , 'en-ma'=>'Malaysia-English', 'es-me'=>'Mexico-Espanol' , 'en-nez'=>'New Zealand-English' ,'de-os'=>'Osterreich-Deutsch' ,'en-pak'=>'Pakistan-English' , 'es-pe'=>'Peru-Espanol' ,'en-ph'=>'Philippines-English' ,'de-sc'=>'Schweiz-Deutsch' , 'en-sin'=>'Singapore-English' , 'en-sa'=>'South Africa-English' , 'en-uae'=>'United Arab  Emirates-English' ,' en-uk'=>'United Kingdom-English' , 'en-us'=>'United States-English' ,' es-ven'=>'Venezuela-Espanol' ];
?>
<div class="nk-content ">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="components-preview wide-md mx-auto">
                                    <div class="card card-bordered card-preview">
                                    <div class="card-inner">
                                                <div class="preview-block">
                                                    <span class="preview-title-lg overline-title">Add Prices</span>
                                                    <div class="row gy-4">
                                                        <form action="{{ url('admin-dashboard/prices/addProcc') }}" method="post">
                                                            @csrf
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="form-label" for="currency">Currency</label>
                                                                <div class="form-control-wrap">
                                                                    <select name="currency" class="form-control" id="currency">
                                                                        @foreach($currencies as $currency)
                                                                        <option value="{{ $currency ?? '' }}">{{ $currency ?? '' }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label class="form-label" for="symbol">Currency Symbols</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="symbol" id="symbol">
                                                                </div>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label class="form-label" for="low_priced">Simple Logos Price</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="low_priced" id="low_priced">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="premium_price">Premium Logo Price</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" name="premium_price" id="premium_price" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <button class="btn btn-primary" type="submit">Submit</button>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                    </div>
                                    </div>
                                </div><!-- .components-preview -->
                            </div>
                        </div>
                </div>
                <div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content">
                                                <h4 class="nk-block-title">Price List</h4>
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <table class="table table-tranx">
                                                <thead class="text-center">
                                                    <tr class="tb-tnx-head">
                                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                                        <th class="tb-tnx-info">
                                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                                <span>Currency</span>
                                                            </span>
                                                           <!--   <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                               <span>Currency Symbol</span>
                                                            </span> -->
                                                        </th>
                                                        <th class="tb-tnx-amount">
                                                            <span class="tb-tnx-total">Simple Logo Price</span>
                                                        </th>
                                                        <th class="tb-tnx-amount">
                                                            <span class="tb-tnx-total">Premium Logo Price</span>
                                                            <span class="tb-tnx-status d-none d-md-inline-block">Action</span>
                                                        </th>
                                                </tr></thead>
                                                <tbody class="text-center">
                                                    <?php $count = 1; ?>
                                                    @foreach($prices as $price)
                                                    <tr class="tb-tnx-item">
                                                        <td class="tb-tnx-id">
                                                            <a href="#"><span>{{ $count++ }}.</span></a>
                                                        </td>
                                                        <td class="tb-tnx-info">
                                                            <div class="tb-tnx-desc">
                                                                <span class="title">{{ $price->currency ?? '' }}</span>
                                                            </div>
                                                            <!-- <div class="tb-tnx-desc">
                                                                <span class="title">{{-- $price->symbols ?? '' --}}</span>
                                                            </div> -->
                                                        </td>
                                                        <td class="tb-tnx-amount">
                                                            <div class="tb-tnx-total">
                                                                <?php 
                                                                $currency = $price->currency;
                                                                $simple_price = Akaunting\Money\Money::$currency($price->simple_price,true);
                                                                 
                                                                ?>
                                                                <span class="amount">{{ $simple_price ?? '' }}</span>
                                                            </div>
                                                        </td>
                                                        <td class="tb-tnx-amount">
                                                            <div class="tb-tnx-total">
                                                                <?php 
                                                                $premium_price =Akaunting\Money\Money::$currency($price->premium_price,true);
                                                                
                                                                ?>
                                                                <span class="amount">{{ $premium_price ?? '' }}</span>
                                                            </div>
                                                            <div class="tb-tnx-status">
                                                            <div class="dropdown">
                                                                <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                    <ul class="link-list-plain">
                                                                        <li><a currency="{{ $price->currency ?? '' }}" class="update" simple_price="{{ $price->simple_price ?? '' }}" premium_price="{{ $price->premium_price ?? '' }}" currency_symbols="{{ $price->symbols ?? '' }}">Edit</a></li>
                                                                        <li><a href="{{ url('admin-dashboard/prices/remove/'.$price->id) }}">Remove</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div><!-- .card-preview -->
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('.update').on('click',function(){
                                                currency = $(this).attr('currency');
                                                simple_price= $(this).attr('simple_price');
                                                premium_price =$(this).attr('premium_price');
                                                currency_symbols = $(this).attr('currency_symbols');
                                              

                                                $('select[name="currency"]').val(currency).change();
                                                $('input[name="symbol"]').val(currency_symbols);
                                                $('input[name="low_priced"]').val(simple_price);
                                                $('input[name="premium_price"]').val(premium_price);
                                                $(document).scrollTop(0);
                                            });
                                        }); 
                                    </script>

@endsection
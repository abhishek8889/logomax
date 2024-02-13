@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
                                        <div class="nk-block-head">
                                            <div class="nk-block-head-content d-flex justify-content-between">
                                                <h4 class="title nk-block-title">Add Discount</h4>
                                               {{ Breadcrumbs::render('discount-add') }}
                                            </div>
                                        </div>
                                        <div class="card card-bordered card-preview">
                                            <div class="card-inner">
                                                <div class="preview-block">
                                                    <form action="{{ url('admin-dashboard/discount/addProcc') }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="hidden" name="id" value="{{ $discount->id ?? '' }}">
                                                        <div class="col-lg-6">
                                                            <div class="row form-group">
                                                                <label class="form-label" for="from_date">Date From</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="date" class="form-control" name="from_date" id="from_date" value="{{ $discount->from_date ?? '' }}">
                                                                </div>
                                                                <label class="form-label" for="to_date">Date To</label>
                                                                <div class="form-control-wrap ">
                                                                    <input type="date" class="form-control" name="to_date" id="to_date" value="{{ $discount->to_date ?? '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="discount_type">Discount Name</label>
                                                                <div class="form-control-wrap">
                                                                    <input type="text" class="form-control" name="discount_name" id="discount_name" value="{{ $discount->name ?? '' }}">

                                                                </div>
                                                                <div id="translate_btn" data-bs-toggle="modal" data-bs-target="#modalDefault" class=" btn btn-primary mt-3">Translate</div>
                                                            </div>
                                                            
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Percentage discount for normal logos</label>
                                                                <div class="form-control-wrap" id="meta_value_box">
                                                                    <input type="number" class="form-control" name="normal_price" id="normal_price" value="{{ $discount->normal_logo_price ?? '' }}" max="99">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="form-label" for="meta_name">Percentage discount for premium logos</label>
                                                                <div class="form-control-wrap" id="meta_value_box">
                                                                    <input type="number" class="form-control" name="premium_price" id="premium_price" value="{{ $discount->premium_logo_price ?? '' }}" max="99">

                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                @if($discount)
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                @else
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                                @endif
                                                            </div>
                                                        </div>
                                                      
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div><!-- .card-preview -->
                                        
                                    </div>
                                    <div class="translate_modal modal fade" tabindex="-1" id="modalDefault">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                                                <em class="icon ni ni-cross"></em>
                                            </a>
                                            <div class="modal-header">
                                                <!-- <h5 class="modal-title">Translate Name</h5> -->
                                                <h5 class="modal-title">Discount Name : {{$discount->name ?? ''}}</h5>
                                            </div>
                                            <form action="{{ url('/add-translate-val') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="referenceID" value="{{$discount->id ?? ''}}" />
                                                <input type="hidden" name="type" value="discount"/>
                                            <div class="modal-body">
                                                <?php 
                                                $count = 0;
                                                ?>
                                                <table class="table">
                                                <thead>
                                                    <tr>
                                                    <th scope="col">Sr no.</th>
                                                    <th scope="col">Language</th>
                                                    <th scope="col">Translate text</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($siteLanguagesList as $key => $value)
                                                <?php $count = $count + 1; ?>
                                                    <tr>
                                                    <th scope="row">{{ $count }}</th>
                                                    <td>{{ $value ?? '' }}</td>
                                                    @if(isset($discount->translationBackend) && count($discount->translationBackend) > 0)
                                                        @foreach($discount->translationBackend as $translation)
                                                            @if($translation->lang_code == $key)
                                                            <input type="hidden" name="req_type" value="update" />
                                                            <td><input type="text" class="form-control" name="lang_code[{{ $translation->id }}]" value="{{ $translation->name ?? $edit_category->name }}"/></td>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                    <input type="hidden" name="req_type" value="add" />
                                                    <td><input type="text" class="form-control" name="lang_code[{{ $key }}]" value="{{ $discount->name ?? ''}}"/></td>
                                                    @endif
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                </table>
                                                
                                            </div>
                                            <div class="modal-footer bg-light">
                                                <button class="btn btn-success" type="submit">Save</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                    <script>
                                        $('select[name="meta_type"]').on('change',function(){
                                            textarea = '<textarea name="meta_value" id="" class="form-control"></textarea>';
                                            image = '<input type="file" name="meta_value" class="form-control">';
                                            val = $(this).val();
                                            $('#meta_value_box').html('');
                                            if(val == 'image'){
                                                $('#meta_value_box').html(image);
                                            }else if(val == 'textarea'){
                                                $('#meta_value_box').html(textarea);
                                            }
                                        });
                                    </script>
@endsection
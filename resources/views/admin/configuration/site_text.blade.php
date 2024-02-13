@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content d-flex justify-content-between">
            <h4 class="title nk-block-title">Site Text</h4>
        </div>
    </div>
    <div class="row">
        @foreach(__('file') as $key => $val )
        <div class="form-group col-md-6">
            <label class="form-label" for="{{ $key }}">{{ $key }}</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control site_text_input" id="{{ $key }}" name="{{ $key }}" value="{{ $val ?? '' }}" />
                <!-- <button class="btn btn-primary mt-3">save</button> -->
                <div style="display:none;" class="spinner-border mt-2" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<script>
    $(".site_text_input").on('keyup',function(e){
        e.preventDefault();
        var buttonElement = $('<button>', {
            'text': 'save', 
            'class': 'btn btn-primary mt-2 save_btn'
        });
        thisObj = $(this);
        // console.log(thisObj.next('button').length < 1);
        if(thisObj.next('button').length < 1){
            thisObj.after(buttonElement);
        }
    });
    $(document).on('click','.save_btn',function(e){
        e.preventDefault();
        btnObj = $(this);
        let textVal = btnObj.siblings('.site_text_input').val();
        let textID = btnObj.siblings('.site_text_input').attr('id');
        btnObj.siblings('.spinner-border').show();
        btnObj.hide();
        $.ajax({
            url : '{{ url("/admin-dashboard/configuration/site-text-update") }}',
            method : "POST",
            data : {
                _token : "{{ csrf_token() }}",
                data : {
                    'textVal' : textVal,
                    'textID' : textID,
                } 
            },
            success: function(response){
                btnObj.siblings('.spinner-border').hide();
                btnObj.remove();
            }
        });
    })
</script>
@endsection
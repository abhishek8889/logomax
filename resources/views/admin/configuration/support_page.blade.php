@extends('admin_layout/master')
@section('content')
<div class="nk-block nk-block-lg">
    <div class="nk-block-head">
        <div class="nk-block-head-content d-flex justify-content-between">
            <h4 class="title nk-block-title">Support Page Content</h4>
            {{ Breadcrumbs::render('support-setting') }}
        </div>
    </div>
    <?php $languages = [ 'en-au'=>'Australia - English' , 'es-ar' =>'Argenina - Español' , 'en-ca'=>'Canada-English' , 'es-ch'=>'Chile-Español' ,'es-co'=>'Colombia-Español' , 'de-de'=>'Deutschland-Deutsch' , 'es-es'=>'España-Español' , 'es-esu'=>'Estados Unidos-Español' , 'en-hok'=>'Hong Kong-English' , 'en-in'=>'India-English' , 'en-ir'=>'Ireland-English' , 'en-is'=>'Israel-English' , 'en-ma'=>'Malaysia-English', 'es-me'=>'México-Español' , 'en-nez'=>'New Zealand-English' ,'de-os'=>'Österreich-Deutsch' ,'en-pak'=>'Pakistan-English' , 'es-pe'=>'Perú-Español' ,'en-ph'=>'Philippines-English' ,'de-sc'=>'Schweiz-Deutsch' , 'en-sin'=>'Singapore-English' , 'en-sa'=>'South Africa-English' , 'en-uae'=>'United Arab  Emirates-English' ,' en-uk'=>'United Kingdom-English' , 'en-us'=>'United States-English' ,' es-ven'=>'Venezuela-Español' ];  ?>
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <form action="{{ url('admin-dashboard/site-content/support/submit') }}" method="post">
            @csrf
            @foreach($support_text as $support)
            <div class="form-group">
                <label class="form-label" for="default-01">{{ $support->meta_name ?? '' }}</label>
                <div class="form-control-wrap">
                    <textarea type="text" class="form-control" name="{{ $support->id ?? '' }}" id="default-01" >{{ $support->meta_value ?? '' }}</textarea>
                </div>
            </div>
            @endforeach
            <div class="form-group ">
                <button type="submit" class="btn btn-primary" class="form-control">Update</button>
            </div>
            </form>
        </div>
    </div><!-- .card-preview -->
</div>
<script>
ClassicEditor.create(document.querySelector(`#default-01`))
</script>
 <script>
        $(document).ready(function(){
            // $('#language').on('change',function(){
            //     val = $(this).val();
            //     url = "{{ url('/admin-dashboard/site-content/support') }}";
            //    location.href = url;
            // });
        });
    </script>
@endsection
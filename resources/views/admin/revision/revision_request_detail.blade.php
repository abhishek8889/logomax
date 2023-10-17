@extends('admin_layout/master')
@section('content')
<?php 
    $media_id = $revisionDetail->logoDetail->media_id;
    $mediaObj = App\Models\Media::class::find($media_id);
    $imageName = '';
    $imageUrl = '';
    if(isset($mediaObj) && !empty($mediaObj)){
        $imageName = $mediaObj->image_name;
        $imageUrl = asset($mediaObj->image_path);
    }
?>
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="row">
            <div class="col-lg-4">
                <img src="{{ $imageUrl ?? '' }}" class="card-img-top" alt="{{ $imageName??'' }}">
            </div>
            <div class="col-lg-8">
                <div class="card-inner">
                    <h5 class="card-title">{{ $revisionDetail->logoDetail->logo_name ?? '' }}</h5>
                    <p class="card-text">Order No. #{{ $revisionDetail->order_num }}</p>
                    <p class="card-text">Change Title : {{ $revisionDetail->request_title }}</p>
                    <p class="card-text">Change Description : {{ $revisionDetail->request_description }}</p>
                    <p>Select Designer :    <select class=" form-control" name="" id="">
                                            @if(isset($specialDesigners) && (count($specialDesigners) > 0) )
                                            @foreach($specialDesigners as $special_designer)   
                                                <option value="{{ $special_designer->id }}">{{ $special_designer->name }} </option>
                                            @endforeach
                                            @else
                                                <option value="">No Special designer in list</option>
                                            @endif
                                            </select>
                    </p>
                    
                    <a href="#" class="btn btn-primary">Assign work</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
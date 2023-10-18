@extends('special_designer_layout.master')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Task Details -</h3>
                        </div>
                        <div>
                            <!-- Breadcrumbs::render('designer-dashboard')  -->
                        </div>
                    </div>
                </div>
                <!-- Task Details  -->
                <?php 
                    $mediaObj = App\Models\Media::class::find($taskDetails->logoDetail->media_id);
                    $image_url = asset($mediaObj->image_path);
                    $image_name = $mediaObj->image_name;
                ?>
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="row">
                                <div class="col-lg-4">
                                    <img src="{{ $image_url }}" class="card-img-top" alt="{{ $image_name }}">
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-inner">
                                        <h5 class="card-title">{{ $taskDetails->logoDetail->logo_name ?? ''}}</h5>
                                        <p class="card-text">Change Title : {{ $taskDetails->revisionRequestDetail->request_title }}</p>
                                        <p class="card-text">Change Description : {{ $taskDetails->revisionRequestDetail->request_description }}</p>
                                        <p class="card-text">Given Time : {{ $taskDetails->task_duration }} (in minutes)</p>
                                        <p class="card-text">Customer Name : {{ $taskDetails->clientDetail->name }} </p>
                                        <p class="card-text">Customer Email : {{ $taskDetails->clientDetail->email }} </p>
                                    </div>
                                    <div class="task-buttons">
                                        <button class="btn btn-danger">Downlaod logo</button>
                                        <button class="btn btn-info">Upload With change</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
</div>
@endsection

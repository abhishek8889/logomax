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
                                        <p class="card-text">Time Left : <span class="text text-danger" id="time_left"></span> </p>
                                    </div>
                                    <!--  |||||||||||||||||||||||||  Time Calculate |||||||||||||||||||  -->
                                    <?php 
                                    
                                        use Carbon\Carbon;
                                        $durationForTask = (int)$taskDetails->task_duration;
                                        $assignAt = $taskDetails->created_at;
                                        
                                        // :::::::::::: Current time with my timezone :::::::::::::::
                                        
                                        $currentTime = Carbon::now();
                                        $currentTime = $currentTime->setTimezone($siteData['user_timezone']);
                                        
                                        // :::::::::::: Assign time with my timezone :::::::::::::::

                                        $carbonTime =  Carbon::parse($assignAt);
                                        $assignAtMyTz = $carbonTime->setTimezone($siteData['user_timezone']);
                                        $taskValidUpto = $assignAtMyTz->addMinutes($durationForTask);


                                        $taskValidStatus = true;
                                        if($currentTime  > $taskValidUpto || $taskDetails->status == 3){
                                            $taskValidStatus = false;
                                        }
                                    ?>
                                    
                                    @if($taskDetails->status == 0)
                                    <div class="task-buttons">
                                        <a class="btn btn-danger" href="{{ url('download-file/'.$mediaObj->id) }}">Download logo</a>
                                        <?php 
                                            if($taskValidStatus == true){
                                        ?>
                                                <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUploadImage">Upload With change</button>
                                        <?php
                                            }else{
                                        ?>
                                            <div class="alert alert-danger mt-3">You missed this task , your task duration is over now.</div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    @elseif($taskDetails->status == 1)
                                        <a class="btn btn-danger" href="{{ url('download-file/'.$mediaObj->id) }}">Download logo</a>
                                        <div class="alert alert-warning mt-3">Wait for customer approval.</div>
                                    @elseif($taskDetails->status == 4)
                                    <div class="alert alert-danger mt-3">You have skipped this task.</div>
                                    @elseif($taskDetails->status == 3)
                                    <div class="alert alert-danger mt-3">Customer disapproved your changes.</div>
                                    @endif
                                </div>
                        </div>
                    </div>
                </div>
                <!-- End -->
            </div>
        </div>
    </div>
</div>
<!-- Modal for uploda image  -->

<div class="modal fade" tabindex="-1" id="modalUploadImage">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Upload Icons</h5>
            </div>
            <form action="{{ url('special-designer/upload-icon') }}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="task_id" value="{{ $taskDetails->id }}"> 
                <input type="hidden" name="order_id" value="{{ $taskDetails->revisionRequestDetail->order_id }}" />
                <input type="hidden" name="revision_id" value="{{ $taskDetails->revisionRequestDetail->id }}">
                <div class="modal-body">
                    <div class="form-file">
                        <input type="file" multiple class="form-file-input" name="icon_list[]" id="customMultipleFiles">
                        <label class="form-file-label" for="customMultipleFiles">Choose files</label>
                    </div>
                </div>
                @error('icon_list')
                    {{ $message }}
                @enderror
                <div class="modal-footer bg-light">
                    <button class="text text-light btn btn-primary"  type="submit">Submit Job</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal end -->
<script>
    @if($taskValidStatus == true) 
        let validUpto = "{{ $taskValidUpto }}";
        let newValidUpto = new Date(validUpto);  

        function checkTimeLeft( validUpto){
            var  currentTime = new Date();
            let timeLeft = (validUpto.getTime() - currentTime.getTime())/1000;
            var minutesLeft = Math.abs(Math.floor(timeLeft / 60));
            var secondsLeft = Math.floor(timeLeft % 60);
            if(currentTime > validUpto){
                $("#time_left").html(`00:00`);
            }else{
                $("#time_left").html(`${ minutesLeft.toString().padStart(2, '0') }:${ secondsLeft.toString().padStart(2, '0') }`);
            }
        }
        setInterval(function(){
            checkTimeLeft( newValidUpto );
        }, 1000);
    @else
        $("#time_left").html(`00:00`);
    @endif
</script>
<script>
    $('body').delegate('.deleteimage','click',function(e){
        e.preventDefault();
        mediaid = $(this).attr('data-id');
        imagename = $(this).attr('image-name');
    // console.log(imagename);
        $.ajax({
            method: 'post',
            url: "{{ url('special-designer/delete-image') }}",
            data: { mediaid:mediaid,imagename:imagename,_token:"{{ csrf_token() }}" },
            dataType: 'json',
            success: function(response)
            {
                html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
                $('.upload-zone').html(html);
                $('.upload-zone').removeClass('dz-started');
            }
        })
    })
</script>
@endsection

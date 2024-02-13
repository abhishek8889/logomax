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
                    // $mediaObj = App\Models\Media::class::find($taskDetails->logoDetail->media_id);
                    // $image_url = asset($mediaObj->image_path);
                    // $image_name = $mediaObj->image_name;

                    
                    if($taskDetails->logoDetail->media->directory_name != null || $taskDetails->logoDetail->media->directory_name != ""){
                        $image_url = asset('LogoDirectory/'.$taskDetails->logoDetail->media->directory_name.'/'.$taskDetails->logoDetail->media->directory_name.'.png');
                    }else{
                        $image_url = asset($taskDetails->logoDetail->media->image_path);
                    }

                ?>
                <div class="card card-bordered card-preview">
                    <div class="card-inner">
                        <div class="row">
                                <div class="col-lg-4">
                                    <img src="{{ $image_url ?? '' }}" class="card-img-top" alt="{{ $taskDetails->logoDetail->media->directory_name.'.png' }}">
                                </div>
                                <div class="col-lg-8">
                                    <div class="card-inner">
                                        <h5 class="card-title">{{ $taskDetails->logoDetail->logo_name ?? ''}}</h5>
                                        <p class="card-text"><strong>Request For : </strong> <span style="text-transform:uppercase;"><b>{{ $taskDetails->what_you_revised ?? '' }}</b></span></p>

                                        <p class="card-text"><strong>Change Title : </strong> {{ $taskDetails->request_title ?? '' }}</p>
                                        <p class="card-text"><strong>Company Name: </strong> {{ $taskDetails->company_name ?? '' }}</p>
                                        <?php 
                                        if(isset($taskDetails->colors)){
                                            $colors = json_decode($taskDetails->colors);
                                            ?>
                                            <p class="card-text"><strong>Colors: </strong> @foreach($colors as $color) {{ $color.',' ?? '' }} @endforeach</p>
                                            <?php
                                        }
                                        ?>
                                        
                                       @if(isset($taskDetails->file_path)) <p class="card-text"><strong>file: </strong> <a href="{{ asset($taskDetails->file_path) }}">download</a></p>  @endif
                                        <p class="card-text"><strong>Change Description : </strong>{{ $taskDetails->request_description ?? '' }}</p>
                                        <p class="card-text"><strong>Customer Name : </strong>{{ $taskDetails->order->user->first_name ?? '' }} {{ $taskDetails->order->user->last_name ?? ''}}</p>
                                        <p class="card-text"><strong>Customer Email : </strong>  {{ $taskDetails->order->user->email ?? ''}} </p>
                                        <!-- <p class="card-text">Time Left : <span class="text text-danger" id="time_left"></span> </p> -->
                                    </div>
                                  
                                    <!--  |||||||||||||||||||||||||  Time Calculate |||||||||||||||||||  -->
                                    <?php 
                                    
                                        // use Carbon\Carbon;
                                        // $durationForTask = (int)$taskDetails->task_duration;
                                        // $assignAt = $taskDetails->created_at;
                                        
                                        // // :::::::::::: Current time with my timezone :::::::::::::::
                                        
                                        // $currentTime = Carbon::now();
                                        // $currentTime = $currentTime->setTimezone($siteData['user_timezone']);
                                        
                                        // // :::::::::::: Assign time with my timezone :::::::::::::::

                                        // $carbonTime =  Carbon::parse($assignAt);
                                        // $assignAtMyTz = $carbonTime->setTimezone($siteData['user_timezone']);
                                        // $taskValidUpto = $assignAtMyTz->addMinutes($durationForTask);


                                        // $taskValidStatus = true;
                                        // if($currentTime  > $taskValidUpto || $taskDetails->status == 3){
                                        //     $taskValidStatus = false;
                                        // }
                                    ?>
                                    <!-- // 0  When request on revision // 1 approved by customer // 2 sent for approval // 3 denied by designer -->
                               
                                    @if($taskDetails->status == 0)
                                    <!-- Request On revision -->
                                    <div class="task-buttons">
                                        <a class="btn btn-danger" href="{{ url('download-file/'.$taskDetails->logoDetail->media->id) }}">Download logo</a>
                                        <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalUploadImage">Upload With change</button>
                                        <a href="{{ url('send-denied-request') }}" class="btn btn-warning">Denied to job</a>
                                        @if(isset($taskDetails->order))
                                            @if($taskDetails->order->on_revision == 1)
                                                <a class="btn btn-success" href="{{ url('internal-designer/messages') }}/{{ base64_encode($taskDetails->order->user->email) }}">Message</a>
                                            @endif
                                        @endif
                                    </div>
                                    @elseif($taskDetails->status == 1)
                                    <!-- Job in done approved by customer -->
                                        <a class="btn btn-danger" href="{{ url('download-file/'.$taskDetails->logoDetail->media->id) }}">Download logo</a>
                                        <div class="alert alert-success mt-3">Job is approved by customer</div>
                                    @elseif($taskDetails->status == 2)
                                    <div class="task-buttons">
                                        <a class="btn btn-danger" href="{{ url('download-file/'.$taskDetails->logoDetail->media->id) }}">Download logo</a>
                                        <div class="alert alert-warning mt-3">Wait for approval</div>
                                    </div>
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
                <input type="hidden" name="revision_id" value="{{ $taskDetails->id }}">
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
    // if($taskValidStatus == true) 
    //     let validUpto = "{{-- $taskValidUpto --}}";
    //     let newValidUpto = new Date(validUpto);  

    //     function checkTimeLeft( validUpto){
    //         var  currentTime = new Date();
    //         let timeLeft = (validUpto.getTime() - currentTime.getTime())/1000;
    //         var minutesLeft = Math.abs(Math.floor(timeLeft / 60));
    //         var secondsLeft = Math.floor(timeLeft % 60);
    //         if(currentTime > validUpto){
    //             $("#time_left").html(`00:00`);
    //         }else{
    //             $("#time_left").html(`${ minutesLeft.toString().padStart(2, '0') }:${ secondsLeft.toString().padStart(2, '0') }`);
    //         }
    //     }
    //     setInterval(function(){
    //         checkTimeLeft( newValidUpto );
    //     }, 1000);
    // else
    //     $("#time_left").html(`00:00`);
    // endif
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

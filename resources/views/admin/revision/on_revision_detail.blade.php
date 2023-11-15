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
<div class="d-flex justify-content-end p-3">
    {{ Breadcrumbs::render('on-revision-detail') }}
</div>
<div class="card card-bordered card-preview">
    <div class="card-inner">
        <div class="row">
                <div class="col-lg-4">
                    <img src="{{ $imageUrl ?? '' }}" class="card-img-top" alt="{{ $imageName ?? '' }}">
                </div>
                <div class="col-lg-8">
                    <div class="card-inner">
                        <h5 class="card-title">{{ $revisionDetail->logoDetail->logo_name ?? '' }}</h5>
                        <p class="card-text">Order No. #{{ $revisionDetail->orderDetail->order_num }}</p>
                        <p class="card-text">Revision Title : {{ $revisionDetail->request_title }}</p>
                        <p class="card-text">Revision Description : {{ $revisionDetail->request_description }}</p>
                        <p class="card-text">Revision Description : {{ $revisionDetail->request_description }}</p>
                        <p class="card-text">Assigned Designer</p>
                        @php 
                        $count = 0;
                        @endphp 
                        @if(isset($revisionDetail->assignedTaskList))
                            @if(!empty($revisionDetail->assignedTaskList))
                                @foreach($revisionDetail->assignedTaskList as $ind => $task)
                                    <div>
                                    <?php 
                                        $count = $count + 1;
                                        $assignedDesigner = App\Models\User::find($task->assigned_designer_id);
                                        $taskStatus = $task->status;
                                    ?>
                                    <b>{{ $count  }} : </b> <strong> <a href="{{ url('/admin-dashboard/designers-view/'.$assignedDesigner->id) }}" >{{ $assignedDesigner->name ?? '' }}</a></strong>
                                    <p>
                                    <?php 
                                        switch ($taskStatus) {
                                            case 0:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-primary'> On Working </spam>";
                                                break;
                                            case 1:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-warning'>On Approval </span>  ";
                                                break;
                                            case 2:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-success'> Approved </span>";
                                                break;
                                            case 3:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-danger'> Disapproved  </span>";
                                                break;
                                            case 4:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-danger'>Terminated </span>";
                                                break;
                                            case 5:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-info'>No backup designer left </span>";
                                                break;
                                            default:
                                                echo "<span class='text text-dark'> Work Status :</span> <span class='badge rounded-pill bg-primary'>No response </span>";
                                        }
                                    ?>
                                    </p>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                       
                    </div>
                </div>
            
        </div>
    </div>
</div>
<!-- Modal to select designers -->
<div class="modal fade" tabindex="-1" id="modalDefault">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
            <div class="modal-header">
                <h5 class="modal-title">Select Backup Designers</h5>
            </div>
            <div class="modal-body">
                <!--  -->
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Designer</th>
                        <!-- <th scope="col">Experience</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $count = 0;
                    ?>
                    @if(isset($specialDesigners) && (count($specialDesigners) > 0) )
                        @foreach($specialDesigners as $backup_designer)
                        <?php 
                            $count = $count + 1;
                        ?>
                        <tr id="designer_{{ $backup_designer->id }}_row" class="backup_designer_class">
                            <th scope="row">{{ $count }}</th>
                            <td>                      
                                <input type="checkbox" class="backup_designer_list" name="backup_designer_id[]" value="{{ $backup_designer->id }}" id="designer_{{ $backup_designer->id }}"/> <label for="designer_{{ $backup_designer->id }}">{{ $backup_designer->name }}</label> <br>
                            </td>
                            <!-- <td> $backup_designer->experience </td> -->
                        </tr>
                        @endforeach
                    @endif
                        
                    </tbody>
                </table>
                <!--  -->
            </div>
            <div class="modal-footer bg-light">
                <span class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Save</span>
            </div>
        </div>
    </div>
</div>
<!-- End -->
<script>
   
    $("#select_designer").on('change',function(e){
        let designer_id = $(this).val();
        $(".backup_designer_class").show();
        $(`#designer_${designer_id}_row`).hide();
        $("input[name='backup_designer_id[]']:checkbox").prop('checked', false);
    });
    $("#selectBackupDesigner").on('click',function(e){
        e.preventDefault();
    });
    // ::::::::::::::::: Assign work ajax ::::::::::::::::::::: 
    $("#assign_work").on('click',function(e){
        e.preventDefault();
        let designerList = $(`.backup_designer_list`).val();
        var selectDesigner = $("#select_designer").val();
        let revision_request_id = "{{ $revisionDetail->id }}";
        var selectedBackupDesigner = [];
        var duration_for_complete = $("#commplete_with_in").val();

        $('input[name="backup_designer_id[]"]:checked').each(function() {
            selectedBackupDesigner.push($(this).val());
        });

        $.ajax({
            url: "{{ url('assign-work') }}",
            method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'logo_id' : "{{ $revisionDetail->logo_id }}",
                'client_id' : "{{ $revisionDetail->orderDetail->user_id }}" ,
                'backup_designer_list' : selectedBackupDesigner,
                'duration_for_complete' : duration_for_complete,
                'revision_request_id' : revision_request_id,
                'selectedDesigner' : selectDesigner,
            },
            // dataType: 'JSON',
            beforeSend: function() {
                $('.spinner-container').show();
            },
            success:function(response)
            {
                // console.log(response);
                setTimeout(()=>{
                $('.spinner-container').hide();
                    $(".loader-box").hide();
                    Swal.fire(
                        'Request Sent!',
                        'You have sent revision request succesfully !',
                        'success'
                    ).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                }, 1000);
            },
            error: function(response) {
                $('.spinner-container').hide();
                console.log(error);
            }
        });
    });
</script>
@endsection
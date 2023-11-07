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

@endsection
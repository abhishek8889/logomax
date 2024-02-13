@extends('special_designer_layout.master')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Pending Tasks -</h3>
                        </div>
                        <div>
                            <!-- Breadcrumbs::render('designer-dashboard')  -->
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card card-bordered card-preview">
                    <div class="nk-block nk-block-lg">                     
                        <div class="card card-bordered card-preview">
                            <table class="table table-tranx">
                                <thead>
                                    <tr class="tb-tnx-head">
                                        <th class="tb-tnx-id"><span class="">#</span></th>
                                        <th class="tb-tnx-info">
                                            <span class="tb-tnx-desc d-none d-sm-inline-block">
                                                <span>Logo Name</span>
                                            </span>
                                            <!-- <span class="tb-tnx-date d-md-inline-block d-none">
                                                <span class="d-none d-md-block">
                                                    <span>Change Title</span>
                                                </span>
                                            </span> -->
                                        </th>
                                        <th class="tb-tnx-amount is-alt">
                                            <span class="d-none d-md-block">
                                                <span>Revision Type</span>
                                            </span>
                                        </th>
                                        <th class="tb-tnx-amount is-alt">
                                            <span class="tb-tnx-total"></span>
                                            <span class="tb-tnx-status d-none d-md-inline-block">Status</span>
                                        </th>
                                        <th class="tb-tnx-action">
                                            <span>&nbsp;</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $count = 0;
                                    ?>
                                    @forelse ($taskList as $task)
                                        <?php 
                                        $count = $count + 1;
                                        // $task->logoDetail->media->image_path
                                        
                                        if($task->logoDetail->media->directory_name != null || $task->logoDetail->media->directory_name != ""){
                                            $image_url = asset('LogoDirectory/'.$task->logoDetail->media->directory_name.'/'.$task->logoDetail->media->directory_name.'.png');
                                        }else{
                                            $image_url = asset($task->logoDetail->media->image_path);
                                        }

                                        
                                        ?>
                                        <tr class="tb-tnx-item">
                                            <td class="tb-tnx-id">
                                                <a href="#"><span>{{ $count }}</span></a>
                                            </td>
                                            <td class="tb-tnx-info">
                                                <div class="tb-tnx-desc">
                                                    <a href="{{ url('internal-designer/task-detail/'.$task->id) }}">
                                                        <img src="{{ $image_url }}" alt="{{ $image_url }}" height="80px" >
                                                        <span class="title">{{ $task->logoDetail->logo_name }}</span>
                                                    </a>
                                                </div>
                                                <!-- <div class="tb-tnx-date">
                                                    <span class="date"><strong>{{-- $task->request_title --}}</strong></span>
                                                </div> -->
                                            </td>
                                            <td class="tb-tnx-info">
                                                <div class="tb-tnx-date">
                                                    <span class="date"><strong>{{ strtoupper($task->what_you_revised) }}</strong></span>
                                                </div>
                                            </td>
                                            <td class="tb-tnx-amount is-alt">
                                                <div class="tb-tnx-total">
                                                    <span class="amount">{{ date_format($task->created_at,"d-m-Y h:i:s"); }}</span>
                                                </div>
                                                <div class="tb-tnx-status">
                                                    <span class="badge badge-dot bg-danger">Pending</span>
                                                </div>
                                            </td>
                                            <td class="tb-tnx-action">
                                                <div class="dropdown">
                                                    <a class="text-soft dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                        <ul class="link-list-plain">
                                                            <li><a href="{{ url('internal-designer/task-detail/'.$task->id) }}">View</a></li>
                                                            <!-- <li><a href="#">Edit</a></li>
                                                            <li><a href="#">Remove</a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td class="text text-danger">
                                        No request found
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
        </div>
    </div>
</div>
@endsection

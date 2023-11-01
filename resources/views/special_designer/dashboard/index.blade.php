@extends('special_designer_layout.master')
@section('content')

<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title"> <a href="{{ url('designer-dashboard') }}">Special Designer Dashboard </a></h3>
                            <div class="nk-block-des text-soft">
                                <p>Welcome to Special Designer Dashboard</p>
                            </div>
                        </div><!-- .nk-block-head-content -->
                        <div>
                            <!-- Breadcrumbs::render('designer-dashboard')  -->
                        </div>
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->
            </div>
        </div>
    </div>
</div>
@endsection

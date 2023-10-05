<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.png') }}">
    <title>Designer Dashbaord</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- vite(['resources/css/app.css' ,'resources/js/designer_notification.js']) -->
    <script type="module" src="{{ asset('/build/assets/app-4ed993c7.js') }}"></script>
    <script type="module" src="{{ asset('/build/assets/bootstrap-93e32d00.js') }}"></script> 

</head>
<style>
    .icon-active {
    position: absolute;
    width: 9px;
    height: 9px;
    background: #1ee1c8;
    border-radius: 50%;
    top: 0;
    right: 0;
}
.icon-status:after{
    display: none;
}
</style>

<body class="nk-body bg-lighter npc-general has-sidebar ">
    <input type="hidden" id="page_id" value="{{ auth()->user()->id }}">
<div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- sidebar @s -->
            <div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                    </div>
                    <div class="nk-sidebar-brand">
                        <a href="html/index.html" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('logomax-front-asset/img/logo.png') }}" srcset="{{ asset('logomax-front-asset/img/logo.png') }}" alt="logo">
                            <img class="logo-dark logo-img" src="{{ asset('logomax-front-asset/img/logo.png') }}" srcset="{{ asset('logomax-front-asset/img/logo.png') }}" alt="logo-dark">
                        </a>
                        <!-- <h4><a href="{{ url('designer-dashboard') }}">LOGOMAX</a></h4> -->
                    </div>
                </div><!-- .nk-sidebar-element -->
                <div class="nk-sidebar-element nk-sidebar-body">
                    <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                            <ul class="nk-menu">
                                <!-- Dashboard -->
                                <li class="nk-menu-heading">
                                    <h6 class="overline-title text-primary-alt"><a href="{{ url('designer-dashboard') }}">Designer-Dashboard</a></h6>
                                </li>
                               @if(auth()->user()->is_approved == 1)
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">Logos</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('designer-dashboard/mylogos') }}" class="nk-menu-link"><span class="nk-menu-text">My Logos</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('designer-dashboard/uploadlogo') }}" class="nk-menu-link"><span class="nk-menu-text">Upload Logo</span></a>
                                        </li>
                                    </ul>
                                </li>
                                @endif
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">User Manage</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="html/user-list-regular.html" class="nk-menu-link"><span class="nk-menu-text">User List - Regular</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="html/user-list-compact.html" class="nk-menu-link"><span class="nk-menu-text">User List - Compact</span></a>
                                        </li>
                                    </ul>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar @e -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <div class="nk-header nk-header-fixed is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-menu-trigger d-xl-none ms-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                            <!-- <div class="nk-header-brand d-xl-none">
                                <a href="html/index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('admin-theme/images/logo.png') }}" srcset="{{ asset('admin-theme/images/logo2x.png 2x') }}" alt="logo">
                                    <img class="logo-dark logo-img" src="{{ asset('admin-theme/images/logo-dark.png') }}" srcset="{{ asset('admin-theme/images/logo-dark2x.png 2x') }}" alt="logo-dark">
                                </a>
                            </div> -->
                            <div class="nk-header-tools">
                                <ul class="nk-quick-nav">
                                    <!-- <li class="dropdown language-dropdown d-none d-sm-block me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="quick-icon border border-light">
                                                <img class="icon" src="{{ asset('admin-theme/images/flags/english-sq.png') }}" alt="">
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-s1">
                                            <ul class="language-list">
                                                <li>
                                                    <a href="#" class="language-item">
                                                        <img src="{{ asset('admin-theme/images/flags/english.png') }}" alt="" class="language-flag">
                                                        <span class="language-name">English</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </li> -->
                                    <!-- .dropdown -->
                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                                            <div class="user-toggle">
                                                <div class="user-avatar sm">
                                                    <em class="icon ni ni-user-alt"></em>
                                                </div>
                                                <div class="user-info d-none d-md-block">
                                                    <div class="user-status">Designer</div>
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->name ?? ''}}</div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-inner user-card-wrap bg-lighter d-none d-md-block">
                                                <div class="user-card">
                                                    <div class="user-avatar">
                                                        <span>AB</span>
                                                    </div>
                                                    <div class="user-info">
                                                        <span class="lead-text">{{ Auth::user()->name ?? ''}}</span>
                                                        <span class="sub-text">{{ Auth::user()->email ?? ''}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <!-- <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li> -->
                                                    <li><a href="{{ url('/designer-dashboard/setting') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                                                    <!-- <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li> -->
                                                    <li><a class="dark-switch" href="#"><em class="icon ni ni-moon"></em><span>Dark Mode</span></a></li>
                                                </ul>
                                            </div>
                                            <div class="dropdown-inner">
                                                <ul class="link-list">
                                                    <li><a href="{{ url('/logout') }}"><em class="icon ni ni-signout"></em><span>Sign out</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                    <!-- notifications -->

                                    <?php
                                        $notifictations =  App\Models\Notifications::class;
                                        $newNotifications = $notifictations::where([['is_read','=',0],['reciever_id','=',auth()->user()->id]])->get();
                                    ?>
                                    <li class="dropdown notification-dropdown me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="icon-status icon-status-info" id="admin-icon-status">
                                                <?php if(isset($newNotifications) && count($newNotifications) > 0){ ?>   
                                                    <em class="icon ni ni-bell"></em> <span class="icon-active"></span>
                                                <?php }else{?>
                                                    <em class="icon ni ni-bell"></em> <span class="icon-active" style="display:none;"></span>
                                                <?php } ?>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="#">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification " id="host-notification">
                                                    <!-- Notification list -->
                                                    <?php 
                                                    if(count($newNotifications) > 0){
                                                       foreach($newNotifications as $notification){ 
                                                    ?>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text"><?php  echo $notification->message; ?><span> <a href="{{ url('read-notification/'.$notification->id) }}"> see </a></span></div>
                                                            <div class="nk-notification-time">2 hrs ago</div>
                                                        </div>
                                                    </div>
                                                    <?php }} ?>
                                                </div>
                                            </div>
                                        </div>
                                    </li> 

                                    <!-- notifications end  -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- content @start -->
                @yield('content')
                <!-- content @end -->
                <!-- footer @s -->

                <div class="nk-footer">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap">
                            <div class="nk-footer-copyright"> &copy; 2023 by <a href="https://softnio.com" target="_blank">Logomax</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- footer @e -->
            </div>
        </div>
    </div>
    @if(auth()->user()->address == null || auth()->user()->experience == null || auth()->user()->country == null)
    @if(isset($request))
    @if($request->url() != url('designer-dashboard/setting'))
<script>
    $(document).ready(function(){
    Swal.fire({
        title: 'Your account is not complete for approval please complete your profile !',
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#008000',
        allowOutsideClick: false,
        allowEscapeKey: false
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ url('designer-dashboard/setting') }}';
        } 
        });
    });
</script>

@endif
@else
<script>
    $(document).ready(function(){
    Swal.fire({
        title: 'Your account is not complete for approval please complete your profile !',
        icon: 'info',
        showCancelButton: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#008000',
        allowOutsideClick: false,
        allowEscapeKey: false
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ url('designer-dashboard/setting') }}';
        } 
        });
    });
</script>
    @endif
    @elseif(auth()->user()->is_approved == 0)
    <script>
    $(document).ready(function(){
    Swal.fire({
        title: 'Your account is not approved wait for approval, Currently you are not able to upload logos !',
        icon: 'info',
        showCancelButton: false,
        showConfirmButton: true,
        confirmButtonText: 'Ok',
        confirmButtonColor: '#008000',
        allowOutsideClick: false,
        allowEscapeKey: false
        });
    });
</script>
@endif
    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('admin-theme/assets/js/bundle.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/charts/gd-default.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
    @if(Session::get('error'))
<script>
    toastr.clear();
    NioApp.Toast('{{ Session::get("error") }}', 'error', {position: 'top-right'});
</script>
@endif
@if(Session::get('success'))
<script>
    toastr.clear();
     NioApp.Toast('{{ Session::get("success") }}', 'info', {position: 'top-right'});
</script>
@endif

<script>
     NioApp.Dropzone.init = function () {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        NioApp.Dropzone('.upload-zone', { 
            url: "{{ url('designer-dashboard/uploadprocc') }}" ,
            headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success:function(file, response){
            html = '<div class="deletebuttondiv"><input type="hidden" name="media_id" value="'+response.id+'"><button type="button" class="btn btn-danger deleteimage" data-id="'+response.id+'" image-name="'+response.image_name+'">Delete</button></div>';
            $('.upload-zone').append(html);
           
        },
        error: function(jqXHR, textStatus, errorThrown) {
            html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
            $('.upload-zone').html(html);
            // $(".upload-zone").load(location.href + " .upload-zone");
            $('.upload-zone').removeClass('dz-started');
            NioApp.Toast('This format is not compatible for upload please uplaod png or AI format!', 'info', {position: 'top-right'});
            }
        });
    };
</script>

</body>

</html>
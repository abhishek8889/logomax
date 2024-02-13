<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="designer-id" content="{{ Auth::user()->id ?? '' }}">
    <meta name="base-url" content="{{ url('') }}">
    <link rel="icon" href="{{ asset('Logomax-Favicon/favicon.ico') ?? '' }}" type="image/x-icon">
    <title>Designer Dashbaord</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/coustam.css?'.time())}}" >
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2fddfgdsfgsdf') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- vite(['resources/css/app.css' ,'resources/js/designer_notification.js']) -->
    <script type="module" src="{{ asset('/build/assets/app-4ed993c7.js') }}"></script>
    <script type="module" src="{{ asset('/build/assets/designer_notification-65b9e5db.js?'.time()) }}"></script> 

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

img.mfp-img {
  height: 100%;
  width: 100%;
  object-fit: cover;
}

.mfp-figure::after{
  height: 100%;
  width: 100%;
  bottom: 0;
  top: 0;
}


</style>

<body class="nk-body bg-lighter npc-general has-sidebar ">
<div class="spinner-container">
  <div class="spinner"></div>
</div>
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
                        <a href="{{ url('logo-designer-dashboard') ?? '' }}" class="logo-link nk-sidebar-logo">
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
                                    <h6 class="overline-title text-primary-alt"><a href="{{ url('logo-designer-dashboard') }}">Logo Designer-Dashboard</a></h6>
                                </li>
                               @if(auth()->user()->is_approved == 1)
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-tile-thumb"></em></span>
                                        <span class="nk-menu-text">Logos</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('logo-designer-dashboard/uploadlogo') }}" class="nk-menu-link"><span class="nk-menu-text">Upload Logo</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('logo-designer-dashboard/pending-logos') }}" class="nk-menu-link"><span class="nk-menu-text">Pending Logos</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('logo-designer-dashboard/rejected-logos') }}" class="nk-menu-link"><span class="nk-menu-text">Rejected Logos</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('logo-designer-dashboard/approved-logos') }}" class="nk-menu-link"><span class="nk-menu-text">Approved Logos</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('logo-designer-dashboard/sold-logos') }}" class="nk-menu-link"><span class="nk-menu-text">Sold Logos</span></a>
                                        </li>
                                        <!-- <li class="nk-menu-item">
                                            <a href="{{ url('designer-dashboard/mylogos') }}" class="nk-menu-link"><span class="nk-menu-text">My Logos</span></a>
                                        </li> -->
                                      
                                    </ul>
                                </li>
                                @endif
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">Setting</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/logo-designer-dashboard/setting') }}" class="nk-menu-link"><span class="nk-menu-text">Account settings</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="{{ url('/logo-designer-dashboard/change-password') }}" class="nk-menu-link"><span class="nk-menu-text">Change password</span></a>
                                        </li>
                                    </ul>
                                </li>
                                <!-- <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon"><em class="icon ni ni-users"></em></span>
                                        <span class="nk-menu-text">Setting</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        <li class="nk-menu-item">
                                            <a href="" class="nk-menu-link"><span class="nk-menu-text">Account setting</span></a>
                                        </li>
                                        <li class="nk-menu-item">
                                            <a href="" class="nk-menu-link"><span class="nk-menu-text">Change password</span></a>
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
                                                    <div class="user-status">Logo Designer</div>
                                                    <div class="user-name dropdown-indicator">{{ Auth::user()->first_name ?? ''}} {{ Auth::user()->last_name ?? '' }}</div>
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
                                                    <li><a href="{{ url('/logo-designer-dashboard/setting') }}"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
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
                                    <!-- <li class="dropdown notification-dropdown me-n1">
                                        <a href="#" class="dropdown-toggle nk-quick-nav-icon" data-bs-toggle="dropdown">
                                            <div class="icon-status icon-status-info" id="admin-icon-status">
                                                <?php 
                                                // if(isset($newNotifications) && count($newNotifications) > 0){ ?>   
                                                    <em class="icon ni ni-bell"></em> <span class="icon-active"></span>
                                                <?php
                                              //  }else{?>
                                                    <em class="icon ni ni-bell"></em> <span class="icon-active" style="display:none;"></span>
                                                <?php
                                              // } ?>
                                            </div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-xl dropdown-menu-end dropdown-menu-s1">
                                            <div class="dropdown-head">
                                                <span class="sub-title nk-dropdown-title">Notifications</span>
                                                <a href="{{ url('read-notification/all-read') }}">Mark All as Read</a>
                                            </div>
                                            <div class="dropdown-body">
                                                <div class="nk-notification " id="host-notification">
                                                 
                                                    <?php 
                                                    if(count($newNotifications) > 0){
                                                       foreach($newNotifications as $notification){ 
                                                    ?>
                                                    <div class="nk-notification-item dropdown-inner">
                                                        <div class="nk-notification-icon">
                                                            <em class="icon icon-circle bg-warning-dim ni ni-curve-down-right"></em>
                                                        </div>
                                                        <div class="nk-notification-content">
                                                            <div class="nk-notification-text"><?php // echo $notification->message; ?><span> <a href="{{-- url('read-notification/'.$notification->id) --}}"> see </a></span></div>
                                                            
                                                            @if($notification->created_at)
                                                                <div class="nk-notification-time">
                                                                <?php
                                                                    $notificationTime = $notification->created_at;
                                                                    $currentTime = now();
                                                                    $minutesDiff = $currentTime->diffInMinutes($notificationTime);
                                                                ?>
                                                                    @if ($minutesDiff < 1)
                                                                        a few seconds ago
                                                                    @elseif ($minutesDiff < 60)
                                                                        {{-- $minutesDiff --}} minute{{-- $minutesDiff > 1 ? 's' : '' --}} ago
                                                                    @else
                                                                        {{-- $notificationTime->diffForHumans($currentTime) --}}
                                                                    @endif.
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <?php }} ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </li> --> 

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
    <?php 
        $notifications = App\Models\Notifications::class::where([['reciever_id','=',auth()->user()->id],['type','=','designer-approve'],['is_read','=',0]])->first();
        if($notifications){?>
        <script>
            $(document).ready(function(){
            Swal.fire({
                title: 'Congratulations Your account is approved by admin !',
                icon: 'info',
                showCancelButton: false,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#008000',
                allowOutsideClick: false,
                allowEscapeKey: false
                }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ url('designer-dashboard') }}';
                } 
                });
            });
        </script>
    <?php 
        $notifications->is_read = 1;
        $notifications->update();
          }
    ?>
    @if(auth()->user()->address == null || auth()->user()->experience == null || auth()->user()->country == null )
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
    @elseif(auth()->user()->is_approved == 0) <!-- Account is not approved still pending  -->
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
    @elseif(auth()->user()->is_approved == 2)  <!-- Disapproved by admin  -->
        <script>
            $(document).ready(function(){
            Swal.fire({
                title: 'Your account is disapproved by admin, Currently you are not able to upload logos !',
                icon: 'Warning',
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
    <script src="{{ asset('admin-theme/assets/js/charts/gd-default.js?'.time()) }}"></script>
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
        sending: function(file, xhr, formData) {
            $('.spinner-container').show();
        },
        success:function(file, response){
       if(response.error){
            html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
            $('.upload-zone').html(html);
            $('.upload-zone').removeClass('dz-started');
            NioApp.Toast(response.error, 'info', {position: 'top-right'});
       }else{
            html = '<div class="deletebuttondiv"><input type="hidden" name="media_id" value="'+response.id+'"><button type="button" class="btn btn-danger deleteimage" data-id="'+response.id+'" image-name="'+response.image_name+'">Delete</button></div>';
            $('.upload-zone').append(html);   
            NioApp.Toast('Logo successfully uploaded! Please proceed to fill in the remaining fields and save your logo.', 'success', {position: 'top-right'});

       }
       $('.spinner-container').hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {
        //    console.log(errorThrown);
            html = '<div class="dz-message" data-dz-message=""><span class="dz-message-text">Drag and drop file</span><span class="dz-message-or">or</span><button type="button" class="btn btn-primary">SELECT</button></div>';
            $('.upload-zone').html(html);
            // $(".upload-zone").load(location.href + " .upload-zone");
            $('.upload-zone').removeClass('dz-started');
            NioApp.Toast('Upload failed! An error occurred. Kindly reattempt the upload, ensuring that the file is in EPS format.', 'info', {position: 'top-right'});
            $('.spinner-container').hide();
        }
        });
    };

</script>

@if(isset($request))
    @if($request->url() == url('logo-designer-dashboard'))


    <script>

let user_id = $('meta[name="designer-id"]').attr('content');
    let base_url = $('meta[name="base-url"]').attr('content');
    
    dataStatics = getData(user_id,base_url);
        
    var salesOverview = {
    labels: dataStatics[1],
    dataUnit: 'logos',
    lineTension: 0.1,
    datasets: [{
      label: "Uploaded Logos Overview",
      color: "#798bff",
      background: NioApp.hexRGB('#798bff', .3),
      data: dataStatics[0]
    }]
  };

  approvedStatics = getApprovedData(user_id,base_url);
  var salesOverview1 = {
    labels: approvedStatics[1],
    dataUnit: 'logos',
    lineTension: 0.1,
    datasets: [{
      label: "Uploaded Logos Overview",
      color: "#798bff",
      background: NioApp.hexRGB('#798bff', .3),
      data: approvedStatics[0]
    }]
  };
     function getData(user_id,base_url){
            $.ajax({
            method: 'post',
            url: base_url+'/designer-dashboard/getStatics',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { user_id:user_id,for:'uploaded_logo' },
            cache:false,
            dataType:"json",
            async:false,
            success:function(response){
            res = response;
            }
            })
            return res;
        }
        function getApprovedData(user_id,base_url){
            $.ajax({
            method: 'post',
            url: base_url+'/designer-dashboard/getStatics',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { user_id:user_id,for:'approved_logo' },
            cache:false,
            dataType:"json",
            async:false,
            success:function(response){
            res = response;
            }
            })
            return res;
        }
  function lineSalesOverview(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-overview-chart');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          tension: _get_data.lineTension,
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].color,
          pointBorderColor: "transparent",
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: _get_data.datasets[i].color,
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBorderWidth: 2,
          pointRadius: 3,
          pointHitRadius: 3,
          data: _get_data.datasets[i].data
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'line',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 13,
            titleFontColor: '#6783b8',
            titleMarginBottom: 6,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: false,
                fontSize: 11,
                fontColor: '#9eaecf',
                padding: 10,
                callback: function callback(value, index, values) {
                  return value+' logos';
                },
                min: 0,
                stepSize: 10
              },
              gridLines: {
                color: NioApp.hexRGB("#526484", .2),
                tickMarkLength: 0,
                zeroLineColor: NioApp.hexRGB("#526484", .2)
              }
            }],
            xAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                fontSize: 9,
                fontColor: '#9eaecf',
                source: 'auto',
                padding: 10,
                reverse: NioApp.State.isRTL
              },
              gridLines: {
                color: "transparent",
                tickMarkLength: 0,
                zeroLineColor: 'transparent'
              }
            }]
          }
        }
      });
    });
}
function lineSalesOverview1(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-overview-chart1');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          tension: _get_data.lineTension,
          backgroundColor: _get_data.datasets[i].background,
          borderWidth: 2,
          borderColor: _get_data.datasets[i].color,
          pointBorderColor: "transparent",
          pointBackgroundColor: "transparent",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: _get_data.datasets[i].color,
          pointBorderWidth: 2,
          pointHoverRadius: 3,
          pointHoverBorderWidth: 2,
          pointRadius: 3,
          pointHitRadius: 3,
          data: _get_data.datasets[i].data
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'line',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return data['labels'][tooltipItem[0]['index']];
              },
              label: function label(tooltipItem, data) {
                return data.datasets[tooltipItem.datasetIndex]['data'][tooltipItem['index']] + ' ' + _get_data.dataUnit;
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 13,
            titleFontColor: '#6783b8',
            titleMarginBottom: 6,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 12,
            bodySpacing: 4,
            yPadding: 10,
            xPadding: 10,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              position: NioApp.State.isRTL ? "right" : "left",
              ticks: {
                beginAtZero: false,
                fontSize: 11,
                fontColor: '#9eaecf',
                padding: 10,
                callback: function callback(value, index, values) {
                  return value+' logos';
                },
                min: 0,
                stepSize: 10
              },
              gridLines: {
                color: NioApp.hexRGB("#526484", .2),
                tickMarkLength: 0,
                zeroLineColor: NioApp.hexRGB("#526484", .2)
              }
            }],
            xAxes: [{
              display: true,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                fontSize: 9,
                fontColor: '#9eaecf',
                source: 'auto',
                padding: 10,
                reverse: NioApp.State.isRTL
              },
              gridLines: {
                color: "transparent",
                tickMarkLength: 0,
                zeroLineColor: 'transparent'
              }
            }]
          }
        }
      });
    });
}


            
mapprovedStatics = getMonthsApprovedStatics(base_url,user_id);
var salesRevenue1 = {
    labels: mapprovedStatics[1],
    dataUnit: 'USD',
    stacked: true,
    datasets: [{
      label: "Sales Revenue",
      color: ["#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff"],
      //@v2.0
      data: mapprovedStatics[0]
    }]
  };
  function getMonthsApprovedStatics(base_url,user_id){
        $.ajax({
            method: 'post',
            url: base_url+'/designer-dashboard/getStatics',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { user_id:user_id,for:'previous_months_logo_approved' },
            cache:false,
            dataType:"json",
            async:false,
            success:function(response){
            res = response;
            }
            })
            return res;
        }
function salesBarChart1(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-bar-chart1');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          // Styles
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: .7,
          categoryPercentage: .7
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'bar',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return false;
              },
              label: function label(tooltipItem, data) {
                return data['labels'][tooltipItem['index']]+' '+data['datasets'][0]['data'][tooltipItem['index']]+' logos';
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 11,
            titleFontColor: '#6783b8',
            titleMarginBottom: 4,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 10,
            bodySpacing: 3,
            yPadding: 8,
            xPadding: 8,
            footerMarginTop: 0,
            displayColors: true
          },
          scales: {
            yAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                beginAtZero: true
              }
            }],
            xAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                reverse: NioApp.State.isRTL
              }
            }]
          }
        }
      });
    });
  }
   
  muploadStatics = getMonthsUploadStatics(base_url,user_id);
var salesRevenue2 = {
    labels: muploadStatics[1],
    dataUnit: 'USD',
    stacked: true,
    datasets: [{
      label: "Sales Revenue",
      color: ["#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff", "#6576ff"],
      //@v2.0
      data: muploadStatics[0]
    }]
  };
  function getMonthsUploadStatics(base_url,user_id){
        $.ajax({
            method: 'post',
            url: base_url+'/designer-dashboard/getStatics',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { user_id:user_id,for:'previous_months_logo_upload' },
            cache:false,
            dataType:"json",
            async:false,
            success:function(response){
            res = response;
            }
            })
            return res;
        }
function salesBarChart2(selector, set_data) {
    var $selector = selector ? $(selector) : $('.sales-bar-chart2');
    $selector.each(function () {
      var $self = $(this),
        _self_id = $self.attr('id'),
        _get_data = typeof set_data === 'undefined' ? eval(_self_id) : set_data,
        _d_legend = typeof _get_data.legend === 'undefined' ? false : _get_data.legend;
      var selectCanvas = document.getElementById(_self_id).getContext("2d");
      var chart_data = [];
      for (var i = 0; i < _get_data.datasets.length; i++) {
        chart_data.push({
          label: _get_data.datasets[i].label,
          data: _get_data.datasets[i].data,
          // Styles
          backgroundColor: _get_data.datasets[i].color,
          borderWidth: 2,
          borderColor: 'transparent',
          hoverBorderColor: 'transparent',
          borderSkipped: 'bottom',
          barPercentage: .7,
          categoryPercentage: .7
        });
      }
      var chart = new Chart(selectCanvas, {
        type: 'bar',
        data: {
          labels: _get_data.labels,
          datasets: chart_data
        },
        options: {
          legend: {
            display: _get_data.legend ? _get_data.legend : false,
            labels: {
              boxWidth: 30,
              padding: 20,
              fontColor: '#6783b8'
            }
          },
          maintainAspectRatio: false,
          tooltips: {
            enabled: true,
            rtl: NioApp.State.isRTL,
            callbacks: {
              title: function title(tooltipItem, data) {
                return false;
              },
              label: function label(tooltipItem, data) {
                return data['labels'][tooltipItem['index']]+' '+data['datasets'][0]['data'][tooltipItem['index']]+' logos';
              }
            },
            backgroundColor: '#eff6ff',
            titleFontSize: 11,
            titleFontColor: '#6783b8',
            titleMarginBottom: 4,
            bodyFontColor: '#9eaecf',
            bodyFontSize: 10,
            bodySpacing: 3,
            yPadding: 8,
            xPadding: 8,
            footerMarginTop: 0,
            displayColors: false
          },
          scales: {
            yAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                beginAtZero: true
              }
            }],
            xAxes: [{
              display: false,
              stacked: _get_data.stacked ? _get_data.stacked : false,
              ticks: {
                reverse: NioApp.State.isRTL
              }
            }]
          }
        }
      });
    });
  }
   

  // init chart
  NioApp.coms.docReady.push(function () {
    lineSalesOverview();
    lineSalesOverview1();
    salesBarChart1();
    salesBarChart2();
  });
</script>


    @endif
@endif

</body>

</html>
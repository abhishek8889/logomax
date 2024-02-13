<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('favicon/favicon.png') }}">
    <!-- Page Title  -->
    <title>Admin-Login | Logomax</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
</head>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="container col-lg-6 nk-block">
        <div class="card card-bordered">
            <div class="card-inner">
                <h4 class="title text-soft mb-4 overline-title"></h4>
                <table class="email-wraper">
                    <tbody>
                        <tr>
                            <td class="py-5">
                                <table class="email-body text-center">
                                    <tbody>
                                        <tr>
                                            <td class="px-3 px-sm-5 pt-3 pt-sm-5 pb-4">
                                                <img class="w-100px" src="{{ asset('admin-theme/images/email/kyc-progress.png') }}" alt="In Process">
                                            </td>
                                        </tr>
                                        <?php 
                                        if(!empty($mailData)){
                                                if(isset($mailData['user_role']) ){
                                                    if($mailData['user_role']== 'Special Designer'){
                                                ?>
                                                <tr>
                                                    <td class="px-3 px-sm-5 pb-3 pb-sm-5">
                                                        <h5 class="text-primary mb-3">Congratulations ! {{ $mailData['name'] ?? '' }} You are registered as special designer in logomax.</h5>
                                                    </td>
                                                </tr>
                                        <?php    }}else{ ?>
                                            <tr>
                                                <td class="px-3 px-sm-5 pb-3 pb-sm-5">
                                                    <h5 class="text-primary mb-3">Your application is under the verification process. Please verify your email by clicking the link below.</h5>
                                                    <a href="{{ url('register-verify/' . ($mailData['token'] ?? '')) }}" class="btn btn-info">Verify Email</a>
                                                </td>
                                            </tr>
                                        <?php }
                                        }
                                        ?>
                                        
                                    </tbody>
                                </table>
                                <table class="email-footer">
                                    <tbody>
                                        <tr>
                                            <td class="text-center pt-4">
                                                <p class="email-copyright-text">Copyright © 2020 Logomax. All rights reserved. <br> Template Made By <a href="#">logomax</a>.</p>
                                                <ul class="email-social">
                                                    <li><a href="#"><img src="./images/socials/facebook.png" alt=""></a></li>
                                                    <li><a href="#"><img src="./images/socials/twitter.png" alt=""></a></li>
                                                    <li><a href="#"><img src="./images/socials/youtube.png" alt=""></a></li>
                                                    <li><a href="#"><img src="./images/socials/medium.png" alt=""></a></li>
                                                </ul>
                                                <p class="fs-12px pt-4">This email was sent to you as a registered member of <a href="https://softnio.com">softnio.com</a>. To update your emails preferences <a href="#">click here</a>.</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

    <script src="{{ asset('admin-theme/assets/js/bundle.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
</html>
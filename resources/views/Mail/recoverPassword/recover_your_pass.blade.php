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
    <title>Confirmation | Logomax</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="{{ asset('admin-theme/assets/css/dashlite.css?ver=3.1.2') }}">
    <link id="skin-default" rel="stylesheet" href="{{ asset('admin-theme/assets/css/theme.css?ver=3.1.2') }}">
</head>
<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-block container col-lg-6 ">
            <div class="card card-bordered">
                <div class="card-inner">
                    <h4 class="title text-soft mb-4 overline-title">Please click in the given below link to recover your password.</h4>
                    <table class="email-wraper">
                        <tbody><tr>
                            <td class="py-5">
                                <table class="email-header">
                                    <tbody>
                                        <tr>
                                            <td class="text-center pb-4">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="email-body text-center">
                                    <tbody>
                                        <tr>
                                            <td class="px-3 px-sm-5 pt-3 pt-sm-5 pb-4">
                                                <img class="w-100px" src="{{ asset('admin-theme/images/email/kyc-success.png') }}" alt="Verified">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-3 px-sm-5 pb-3 pb-sm-5">
                                                <h5 class="text-success mb-3">Your Designer Account Verified.</h5>
                                                <p>Hi,<span class="text-success mb-3">{{ $mailData['name']}} </span> One fo our team verified your indentity. You are now ready for upload logo on logomax.</p>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody></table>
                </div>
            </div>
    </div>
</body>

    <script src="{{ asset('admin-theme/assets/js/bundle.js?ver=3.1.2')}}"></script>
    <script src="{{ asset('admin-theme/assets/js/scripts.js?ver=3.1.2') }}"></script>
    <script src="{{ asset('admin-theme/assets/js/example-toastr.js?ver=3.1.2') }}"></script>
   

</html>
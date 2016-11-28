<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="../bower_components/ngstorage/ngStorage.min.js"></script>

    <script src="development/app/auth/Auth.js"></script>
    <script src="../development/app/auth/logger/LoggerController.js"></script>
    <script src="../development/app/auth/logger/LoggerDirective.js"></script>
    <script src="../development/app/auth/logger/LoggerService.js"></script>

    <script src="../development/app/auth/Register/RegisterController.js"></script>
    <script src="../development/app/auth/Register/RegisterDirective.js"></script>
    <script src="../development/app/auth/Register/RegisterService.js"></script>


    <script src="../development/js/effects.js"></script>

    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,700" media="all" />
    <link rel="stylesheet" href="../development/fonts/themify/themify-icons.css">
    <link rel="stylesheet" href="../development/css/font-awesome.css">

    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../development/css/login.css">

    <base href="/">
</head>

<script type="text/javascript">
    $( document ).ready(function() {
        $('#test').on('click', function () {
            console.log(12);
            sessionStorage.setItem('fio', '{{Session::get('fio')}}');
            sessionStorage.setItem('post', '{{Session::get('post')}}');
        });
    });
</script>
{{--{{Session::get('fio')}}--}}
<body  id='bg_change' class="transition-1">
    <div  class="login-container">
        <div ng-app="authApp">
            <ui-view></ui-view>
        </div>
    </div>
</body>


</html>
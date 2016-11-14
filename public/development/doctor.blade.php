<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>

    <script src="development/app/doctor/Doctor.js"></script>

    <script src="../development/app/doctor/emergency/EmergencyController.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyDirective.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyService.js"></script>

    <link rel="stylesheet" href="development/css/style.css">
    <link rel="stylesheet" href="development/css/font-awesome.css">
 {{--   <link rel="stylesheet" href="development/fonts/themify/themify-icons.css">--}}
    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,700" media="all" />
</head>
<body ng-app="doctorApp">
    <div class="wrapper">
        <div ng-include src="'/development/components/header.html'"></div>
    </div>
    <div class="main-content">
        <ui-view></ui-view>
    </div>


</body>
</html>
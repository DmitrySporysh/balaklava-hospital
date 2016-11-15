<!DOCTYPE html>
<html lang="en"  >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>


    <script src="development/app/doctor/HeadPhysician.js"></script>


    <script src="../development/app/doctor/emergency/EmergencyDirective.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyController.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyService.js"></script>

    <script src="../development/app/doctor/inpatients/InpatientsDirective.js"></script>
    <script src="../development/app/doctor/inpatients/InpatientsController.js"></script>
    <script src="../development/app/doctor/inpatients/InpatientsService.js"></script>

    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,700" media="all" />
    <link rel="stylesheet" href="../development/fonts/themify/themify-icons.css">
    <link rel="stylesheet" href="../development/css/font-awesome.css">


    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../development/css/style.css">
</head>

<body ng-app="headPhysicianApp">
<div class="wrapper">
    {{--@include('components.doctor_header')--}}
    <div class='wrapper' ng-include src="'/development/components/doctor_header.html'"></div>
    <div class="main-content">
        <ui-view></ui-view>
    </div>
</div>





</body>
</html>
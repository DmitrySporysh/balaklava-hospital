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
</head>
<body ng-app="doctorApp">

<ng-include src="components/header.html"></ng-include>

    <ui-view></ui-view>




</body>
</html>
<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>

    <script src="development/app/auth/Auth.js"></script>
    <script src="../development/app/auth/logger/LoggerController.js"></script>
    <script src="../development/app/auth/logger/LoggerDirective.js"></script>
    <script src="../development/app/auth/logger/LoggerService.js"></script>
    <style>.active { color: red; font-weight: bold; }</style>
</head>
{{--<body ng-app="doctor">
    <ui-view></ui-view>
</body>--}}
<body >
    <h1>doctor</h1>
</body>
</html>
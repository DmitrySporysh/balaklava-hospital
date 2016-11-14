<!DOCTYPE html>
<html lang="en" >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script src="bower_components/angular/angular.min.js"></script>
    <script src="/public/development/app/auth/logger/Logger.js"></script>
</head>
<body ng-app="LoginRouteApp">
    <div ng-view></div>
</body>
</html>
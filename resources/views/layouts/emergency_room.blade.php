<!DOCTYPE html>
<html lang="en" ng-app="emergencyRoomApp">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Book Wishlist Application</title>

    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="bower_components/angular/angular.min.js"></script>
    <script src="bower_components/lodash/lodash.js"></script>
    <script src="bower_components/angular-route/angular-route.min.js"></script>
    <script src="bower_components/angular-local-storage/dist/angular-local-storage.min.js"></script>
    <script src="bower_components/restangular/dist/restangular.min.js"></script>
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="app/js/app.js"></script>
    <script src="app/js/controllers.js"></script>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,700" media="all" />
</head>

<body>


<div class="wrapper">
    @include('components.header')



    <div ng-view></div>


</div>



</body>
</html>
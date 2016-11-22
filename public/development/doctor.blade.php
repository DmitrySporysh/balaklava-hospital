<!DOCTYPE html>
<html lang="en"  >
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="../bower_components/angular/angular.min.js"></script>
    <script src="../bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
    <script src="../bower_components/angular-material/angular-material.min.js"></script>
    <script src="../bower_components/angular-aria/angular-aria.js"></script>
    <script src="../bower_components/angular-animate/angular-animate.js"></script>
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>


    <script src="development/app/doctor/Doctor.js"></script>


    <script src="../development/app/doctor/emergency/EmergencyDirective.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyController.js"></script>
    <script src="../development/app/doctor/emergency/EmergencyService.js"></script>

    <script src="../development/app/doctor/archive/ArchiveDirective.js"></script>
    <script src="../development/app/doctor/archive/ArchiveController.js"></script>
    <script src="../development/app/doctor/archive/ArchiveService.js"></script>

    <script src="../development/app/doctor/Archive_person/ArchivePersonDirective.js"></script>
    <script src="../development/app/doctor/Archive_person/ArchivePersonController.js"></script>
    <script src="../development/app/doctor/Archive_person/ArchivePersonService.js"></script>

    <script src="../development/app/doctor/Operations/OperationsDirective.js"></script>
    <script src="../development/app/doctor/Operations/OperationsController.js"></script>
    <script src="../development/app/doctor/Operations/OperationsService.js"></script>

    <script src="../development/app/doctor/emergency_person/Emergency_pDirective.js"></script>
    <script src="../development/app/doctor/emergency_person/Emergency_pController.js"></script>
    <script src="../development/app/doctor/emergency_person/Emergency_pService.js"></script>


    <script src="../development/app/doctor/inpatients/InpatientsDirective.js"></script>
    <script src="../development/app/doctor/inpatients/InpatientsController.js"></script>
    <script src="../development/app/doctor/inpatients/InpatientsService.js"></script>

    <script src="../development/app/doctor/InpatientTreatment/InpTreatmentDirective.js"></script>
    <script src="../development/app/doctor/InpatientTreatment/InpTreatmentController.js"></script>
    <script src="../development/app/doctor/InpatientTreatment/InpTreatmentService.js"></script>

    <link type="text/css" rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:400,300,700" media="all" />
    <link rel="stylesheet" href="../development/fonts/themify/themify-icons.css">
    <link rel="stylesheet" href="../development/css/font-awesome.css">


    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../bower_components/angular-material/angular-material.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../development/css/style.css">
</head>

<body ng-app="doctorApp">
<div class="wrapper">
    @include('components.doctor_header')
    {{--<div class='wrapper' ng-include src="'/development/components/doctor_header.html'"></div>--}}
    <div class="main-content">
        <ui-view></ui-view>
    </div>
</div>





</body>
</html>
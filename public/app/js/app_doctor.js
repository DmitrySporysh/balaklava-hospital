var doctorApp = angular.module('doctorApp', [
    'ngRoute',
    'doctorAppControllers'
]);

doctorApp.config(['$routeProvider', function($routeProvider) {

    $routeProvider.
    when('/patients', {
        templateUrl: 'app/templates/doctor/patients.html',
        controller: 'PatientsController'
    }).
    when('/emergency', {
        templateUrl: 'app/templates/doctor/emergency.html',
        controller: 'EmergencyController'
    }).
    when('/patient_full', {
        templateUrl: 'app/templates/doctor/patient_full.html'
    }).
    when('/emergency_person', {
        templateUrl: 'app/templates/doctor/emergency_person.html',
        controller: 'EmergencyPersonController'
    }).
    when('/archive', {
        templateUrl: 'app/templates/doctor/archive.html'
    }).
    when('/archive_patient', {
        templateUrl: 'app/templates/doctor/archive_patient.html',
    }).
        /*--------------*/
    otherwise({
        redirectTo: '/'
    });

}]);
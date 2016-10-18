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
    when('/dash', {
        templateUrl: 'app/templates/doctor/patients.html',
        controller: 'DashController'
    }).
    when('/reports', {
        templateUrl: 'app/templates/doctor/patients.html',
        controller: 'ReportsController'
    }).
    when('/emergency_person', {
        templateUrl: 'app/templates/doctor/emergency_person.html',
        controller: 'EmergencyPersonController'
    }).
    otherwise({
        redirectTo: '/'
    });

}]);
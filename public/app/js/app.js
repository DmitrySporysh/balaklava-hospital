var emergencyRoomApp = angular.module('emergencyRoomApp', [
    'ngRoute',
    'emergencyRoomAppControllers'
]);

emergencyRoomApp.config(['$routeProvider', function($routeProvider) {

    $routeProvider.
    when('/archive', {
        templateUrl: 'app/templates/emergency/login.html',
        controller: 'LoginController'
    }).
    when('/new_patient', {
        templateUrl: 'app/templates/emergency/new_patient.html',
        controller: 'NewPatientController'
    }).
    when('/patients', {
        templateUrl: 'app/templates/emergency/patients.html',
        controller: 'MainController'
    }).
    when('/', {
        templateUrl: 'app/templates/emergency/patients.html',
        controller: 'MainController'
    }).
    otherwise({
        redirectTo: '/'
    });

}]);
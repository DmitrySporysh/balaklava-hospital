var emergencyRoomApp = angular.module('emergencyRoomApp', [
    'ngRoute',
    'bookWishlistAppControllers'
]);

emergencyRoomApp.config(['$routeProvider', function($routeProvider) {

    $routeProvider.
    when('/login', {
        templateUrl: 'app/templates/login.html',
        controller: 'LoginController'
    }).
    when('/signup', {
        templateUrl: 'app/templates/signup.html',
        controller: 'SignupController'
    }).
    when('/', {
        templateUrl: 'app/templates/index.html',
        controller: 'MainController'
    }).
    otherwise({
        redirectTo: '/'
    });

}]);
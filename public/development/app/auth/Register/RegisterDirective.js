angular
    .module('authApp')
    .directive('registerForm', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/Register/Register.html",
            controller: 'RegisterCtrl',
            controllerAs: 'registerCtrl'
        };
    });



angular
    .module('authApp')
    .directive('registerForm', function (PATHDIR) {
        return {
            restrict: "AE",
            templateUrl: PATHDIR+"/Register/Register.html",
            controller: 'RegisterCtrl',
            controllerAs: 'registerCtrl'
            /*link: function(scope, element, attrs, loginCtrl) {
             console.log(loginCtrl.name) ;//'myCtrl'
             }*/
        };
    });



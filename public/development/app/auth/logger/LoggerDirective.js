angular
 .module('authApp')
     .directive('loginForm', function (PATHDIR) {
         return {
             restrict: "AE",
             templateUrl: PATHDIR+"/logger/Logger.html",
             controller: 'LoginCtrl',
             controllerAs: 'loginCtrl'
             /*link: function(scope, element, attrs, loginCtrl) {
                 console.log(loginCtrl.name) ;//'myCtrl'
             }*/
         };
     });



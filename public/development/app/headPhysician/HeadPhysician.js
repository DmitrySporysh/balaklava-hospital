angular
    .module('headPhysicianApp', ['ui.router'])
    .constant('PATHDIR', 'development/app/headPhysician')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('inpatients',{
                url: '/inpatients',
                template: '<inpatients></inpatients>'
            })
            .state('inpatient_info',{
                url: '/inpatients/:id',
                template: '<inpatient-info></inpatient-info>'
            })
                .state('inpatient_info.general',{
                    url: '/general',
                    template: '<general></general>'
                })

        
        
    })
    .controller('headPhysicianAppController', function (headPhysicianAppService, $scope) {
        var self = this;

        $scope.logout = function () {
            headPhysicianAppService.logout();
        }
    })
    .service('headPhysicianAppService', function ($http, $q) {

        function logout() {
            var defer=$q.defer();

            $http.post('/logout',{})
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                })
                .then(function(){
                $window.location.href =  "/login#/login";
            });
            console.log(defer.promise);
        }

        return {
            logout: logout
        }

    });





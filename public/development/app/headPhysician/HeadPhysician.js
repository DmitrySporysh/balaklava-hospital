angular
    .module('headPhysicianApp', ['ui.router'])
    .constant('PATHDIR', 'development/app/headPhysician')
    .config(function($stateProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
        $stateProvider
            .state('null',{
                url: '',
                template: '<inpatients></inpatients>'
            })
            .state('inpatients',{
                url: '/inpatients',
                template: '<inpatients></inpatients>'
            })
                .state('inpatients.id',{
                    url: '/{id}',
                    template: '<inpatient-info></inpatient-info>'
                })
            .state('inpatients.id.general',{
                url: '/general',
                template: '<general></general>'
            })
            .state('archive',{
                url: '/archive',
                template: '<archive></archive>'
            })
            .state('archive.id',{
                url: '/{id}',
                template: '<archive-person></archive-person>'
            })
    })
    .controller('headPhysicianAppController', function (headPhysicianAppService, $scope) {
        var self = this;

        $scope.logout = function () {
            headPhysicianAppService.logout();
        }
    })
    .service('headPhysicianAppService', function ($http, $q, $window) {

        function logout() {
            var defer=$q.defer();

            $http.post('/api/logout',{})
                .success(function(response) {
                    defer.resolve(response);
                })
                .error(function(err) {
                    defer.reject(err);
                })
                .then(function(){
                $window.location.href =  "/";
            });
            console.log(defer.promise);
        }

        return {
            logout: logout
        }

    });





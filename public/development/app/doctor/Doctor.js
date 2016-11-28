angular
    .module('doctorApp', ['ui.router','ngMaterial'])
    .constant('PATHDIR', 'development/app/doctor')
    .config(function($stateProvider, $locationProvider) { //Because $stateProvider is an Angular Provider, you must inject it into a .config() block using Angular 1 Dependency Injection.
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
                template: '<inpatient-treatment></inpatient-treatment>'
            })
                .state('inpatients.id.general',{
                    url: '/general',
                    template: '<general></general>'
                })
                .state('inpatients.id.analyzes',{
                    url: '/analyzes',
                    template: '<analyzes></analyzes>'
                })
                .state('inpatients.id.dynamic',{
                    url: '/dynamic',
                    template: '<dynamic></dynamic>'
                })
                .state('inpatients.id.prescriptions',{
                    url: '/prescriptions',
                    template: '<prescriptions></prescriptions>'
                })
                .state('inpatients.id.first_inspect',{
                    url: '/inspections',
                    template: '<first-inspect></first-inspect>'
                })

            .state('emergency',{
                url: '/emergency',
                template: '<emergency></emergency>'
            })
                .state('emergency.id',{
                    url: '/{id}',
                    template: '<emergency-person></emergency-person>'
                })

            .state('archive',{
                url: '/archive',
                template: '<archive></archive>'
            })
            .state('archive_person',{
                url: '/archive/:id',
                template: '<archive-person></archive-person>'
            })
            .state('operations',{
                url: '/operations',
                template: '<operations></operations>'
            });
      /*  $locationProvider.html5Mode(true);*/
    })
    .controller('doctorAppController', function (doctorAppService, $scope) {
        var self = this;

        $scope.logout = function () {
            doctorAppService.logout();
        }
    })
    .service('doctorAppService', function ($http, $q, $window) {

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
                    $window.location.href =  "/";
                });
            console.log(defer.promise);
        }

        return {
            logout: logout
        }

    });

    


